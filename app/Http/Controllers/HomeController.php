<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Category;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::listExpense(Auth::user()->id)->get();
        $categories = Category::pluck('name', 'id');
        $category_all = Category::all();
        $currentUser = Auth::user();

        return view('expense.index', compact('expenses', 'categories', 
            'category_all', 'currentUser'));
    }
}
