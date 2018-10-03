<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SmoDav\Models\Transaction;
use SmoDav\Models\UnitOfMeasure;
use SmoDav\Models\StockItem;
use SmoDav\Models\Stock;
use SmoDav\Models\Sale;
use SmoDav\Models\Order;
use SmoDav\Models\UnitConversion;
use SmoDav\Models\Customer;
use SmoDav\Models\PaymentTypes;
use SmoDav\Models\Tax;
use App\ProductSubcategory;
use PDF;

class SaleController extends Controller
{
    public function fileopen(Request $request)
    {
        try {
            $contents = File::get(storage_path('app/test.txt'));

            return response($contents, 200);
        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }
    }

    public function index()
    {
        //dd(ProductSubcategory::all());
        return view(
            'sale.index',
            ['sales'=> Order::with(['stall', 'customer', 'paymentType'])
                ->where('document_type', Order::INVOICE)
                ->orderBy('id', 'desc')
                ->get(), 'stall_id' => session()->get('stall_id')]);

       // return view('sale.create_index')->with('products', ProductSubcategory::paginate(6));
    }

    public function create()
    {
        $stallId = session()->get('stall_id');

        if (request()->ajax()) {
            $stockItems = StockItem::forSale($stallId);

            return response()->json(
                [
                    'stock' => $stockItems,
                    'uoms' => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
                    'customers' => Customer::get(
                        ['name', 'account_balance', 'account_number', 'credit_limit', 'id', 'is_credit']),
                    'payment_types' => PaymentTypes::get(['name', 'slug', 'id', 'is_credit']),
                    'taxes' => Tax::active()->get(['id', 'code', 'rate']),
                    'products' => StockItem::all()
                ]);
        }

        return view('sale.create');
    }

    public function store(Request $request)
    {
        // TODO: Change this to use session
        $customer = Customer::findOrfail($request->customer_id);
        $sale_id = null;
        $sale = \DB::transaction(function () use ($request, $customer) {
            if ($customer->is_credit == 1) {
                $balance = $request->credit;
                $balance += $customer->account_balance;
                $customer->update(['account_balance' => $balance]);
            }

            //return "hvhv";
            //dd($request->session()->get('stall_id'));

            $sale = Order::create(
                [
                    'user_id' => \Auth::user()->id,
                    'account_id' => $request->customer_id,
                    'stall_id' => session()->get('stall_id'),
                    'description' => $request->description,
                    'document_type' => Order::INVOICE,
                    'total_exclusive' => $request->total_exclusive,
                    'total_inclusive' => $request->total_inclusive,
                    'total_tax' => $request->total_tax,
                    'mpesa' => json_encode($request->mpesa),
                    'cash' => $request->cash,
                    'credit' => $request->credit,
                    'balance' => $request->balance,
                    'notes' => $request->notes
                ]);
//                $sale_id = $sale->id;
            $sales = [];

            foreach ($request->salesLines as $index => $value) {
                $item_in_stock = Stock::where('item_id', $value['id'])->where('stall_id', 1);
                $conversion = UnitConversion::where('stock_item_id', $value['id'])
                    ->where('converted_unit_id', $value['unit_conversion_id'])
                    ->get(['stocking_unit_id', 'stocking_ratio', 'converted_ratio'])->first();

                if (!$conversion) {
                    $stock_quantity = ($item_in_stock->first()) ? $item_in_stock->first()->quantity_on_hand : null;
                    //TODO: Accomodate quantity
                    $new_stock_quantity = ($item_in_stock->first()) ?
                        $item_in_stock->first()->quantity_on_hand - $value['weight'] :
                        null;
                    if ($new_stock_quantity < 0) {
                        $new_stock_quantity = 0;
                    }
                    $item_in_stock->update(['quantity_on_hand' => $new_stock_quantity]);
                } else {
                    $stock_quantity = $item_in_stock->first()->quantity_on_hand;
                    $units_sold = ($value['weight'] * ($conversion->converted_ratio / $conversion->stocking_ratio));
                    $new_stock_quantity = $item_in_stock->first()->quantity_on_hand - $units_sold;
//                        if ($new_stock_quantity < 0) {
//                            $new_stock_quantity = 0;
//                        }
                    $item_in_stock->update(['quantity_on_hand' => $new_stock_quantity]);
                }

                $sales[] = [
                    'sale_id' => $sale->id,
                    'unit_conversion_id' => $value['unit_conversion_id'],
                    'stock_item_id' => $value['id'],
                    'stock_name' => $value['name'],
                    'code' => $value['code'],
                    'quantity' => $value['quantity'],
                    'tax_rate' => $value['tax_rate'],
                    'unit_tax' => $value['unitInclPrice'] - $value['unitExclPrice'],
                    'unitExclPrice' => $value['unitExclPrice'],
                    'unitInclPrice' => $value['unitInclPrice'],
                    'totalInclPrice' => $value['totalIncl'],
                    'totalExclPrice' => $value['totalExcl'],
                    'total_tax' => $value['totalTax'],
                    'stall_id' => session()->get('stall_id'),
                    'created_at' => Carbon::now()
                ];
            }

            Sale::insert($sales);

            $this->createTransactions($request, $sale);

            return $sale;
        });

        if (isset($customer) && isset($sale)) {
            return response()->json(['message' => 'Sale Made Successfully!']);
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function receipt($id)
    {
        $pdf = PDF::loadView(
            'sale.receipt',
            ['sale' => Order::with(['sale.stock', 'customer'])->findOrfail($id),
                'taxes' => Tax::active()->get(['id', 'code', 'rate'])]);

        // return $pdf->stream(Carbon::now().'_receipt.pdf');
        return view(
            'sale.receipt',
            ['sale' => Order::with(['sale.stock', 'customer'])->findOrfail($id),
                'taxes' => Tax::active()->get(['id', 'code', 'rate'])]);
    }

    public function credit()
    {
        return view('sale.credit-sale-receipt');
    }

    public function test()
    {
        return view('');
    }

    protected function createTransactions(Request $request, $originalSale)
    {
        $payments = $request->get('payments');

        if (isset($payments['cash']) && (float)$payments['cash'] > 0) {
            $this->createCashTransaction((float)$payments['cash'], $request->get('balance'), $originalSale);
        }

        if (isset($payments['credit']) && (float)$payments['credit'] > 0) {
            $this->createCreditTransaction((float)$payments['credit'], $originalSale);
        }

        if (isset($payments['creditCards']) && count($payments['creditCards']) > 0) {
            $this->createCreditCardTransactions($payments['creditCards'], $originalSale);
        }

        if (isset($payments['mpesa']) && count($payments['mpesa']) > 0) {
            $this->createMpesaTransactions($payments['mpesa'], $originalSale);
        }
    }

    private function createCashTransaction($cashAmount, $balance, $originalSale)
    {
        Transaction::create([
            'type' => 'Cashbox',
            'amount' => (float)$cashAmount - (float)$balance,
            'transactionable_id' => $originalSale->id,
            'transactionable_type' => Order::class
        ]);
    }

    private function createCreditTransaction($amount, $originalSale)
    {
        Transaction::create([
            'type' => 'Credit',
            'amount' => (float)$amount,
            'transactionable_id' => $originalSale->id,
            'transactionable_type' => Order::class
        ]);
    }

    private function createCreditCardTransactions($creditCards, $originalSale)
    {
        foreach ($creditCards as $card) {
            if ((float)$card['credit_card_amount'] < 1) {
                continue;
            }

            Transaction::create([
                'type' => 'Credit Card',
                'amount' => (float)$card['credit_card_amount'],
                'transactionable_id' => $originalSale->id,
                'transactionable_type' => Order::class
            ]);
        }
    }

    private function createMpesaTransactions($mpesa, $originalSale)
    {
        foreach ($mpesa as $item) {
            if ((float)$item['m_pesa_amount'] < 1) {
                continue;
            }

            Transaction::create([
                'type' => 'Mpesa',
                'amount' => (float)$item['m_pesa_amount'],
                'transactionable_id' => $originalSale->id,
                'transactionable_type' => Order::class
            ]);
        }
    }


    public function cartDetails()
    {

        $products = ProductSubcategory::join('product_categories', 'product_subcategories.category_id', '=', 'product_categories.id')
            ->select('product_subcategories.name', 'product_subcategories.price','product_subcategories.id')
            ->where('category_id',1)
            ->get();


        return view('sale.shop_index')->with('products', $products);

    }

    public function viewCart()
    {
        return view('sale.view_cart');
    }

    public function Drinks()
    {
        $products = ProductSubcategory::where('category_id',1)->orderBy('name','asc')->get();

   //dd();
        return view('sale.shop_index')->with('products',$products);

    }
    public function Snacks()
    {
        $products = ProductSubcategory::where('category_id',2)->orderBy('name','asc')->get();

        return view('sale.shop_index')->with('products',$products);
    }
    public function mainDish()
    {
        $products = ProductSubcategory::where('category_id',3)->orderBy('name','asc')->get();
        return view('sale.shop_index')->with('products',$products);
    }

    public function Specials()
    {
        $products = ProductSubcategory::where('category_id',4)->orderBy('name','asc')->get();
        return view('sale.shop_index')->with('products',$products);
    }
}
