<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmoDav\Models\PettyCash;
use Excel;
use Vinn\Repository\ReportsRepo;

class ExpensesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $from =  date("Y-m-d",strtotime($request->from));
        $to =  date("Y-m-d",strtotime($request->to));
        $expenses = PettyCash::whereBetween('created_at', [$from, $to])->get();

        return view('reports.expenses.index',compact('from','to','expenses'));
    }


public function expenseSummary($from,$to) {
    $expenses = ReportsRepo::init()->getExpenses($from,$to);
     return Excel::create('Expenses', function ($excel) use ($expenses) {

        $excel->sheet('mySheet', function ($sheet) use ($expenses) {

            $sheet->fromArray($expenses);

        });

    })->download('xls');

}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
