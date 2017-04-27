<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use Auth;
use Charts;

class ChartController extends Controller
{
    public function index()
    {
        $chart = Charts::database(Expense::listExpense(Auth::user()->id)->get(), 
            'bar', 'highcharts')
            ->title("Biểu đồ thống kê 2017")
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupByMonth('2017', true);

        return view('chart.index', ['chart' => $chart]);
    }
}
