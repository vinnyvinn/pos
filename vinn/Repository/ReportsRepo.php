<?php
/**
 * Created by PhpStorm.
 * User: vinnyvinny
 * Date: 1/25/19
 * Time: 4:10 PM
 */

namespace Vinn\Repository;


use Carbon\Carbon;
use SmoDav\Models\PettyCash;

class ReportsRepo
{
static function init(){
    return new self();
}

    public function getExpenses($from,$to)
    {
        $expenses = PettyCash::whereBetween('created_at', [$from, $to])->get();
        return $expenses->map(function ($expense){
          return [
              'Created by' => $expense->user->full_name,
              'Expense Type' => $expense->pettyCashType->name,
              'Amount' => $expense->amount,
              'Reference' => $expense->reference,
              'Remarks' => $expense->remarks,
              'Date' => Carbon::parse($expense->created_at)->format('d F Y')
          ];
        });



}
}
