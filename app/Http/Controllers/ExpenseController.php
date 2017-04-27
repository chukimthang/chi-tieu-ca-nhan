<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;
use App\Expense;
use App\Category;
use App\User;
use Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::listExpense(Auth::user()->id)->get();
        $categories = Category::listCategory(Auth::user()->id)
            ->pluck('name', 'id');
        $category_all = Category::listCategory(Auth::user()->id)->get();
        $currentUser = Auth::user();

        return view('expense.index', compact('expenses', 'categories', 
            'category_all', 'currentUser'));
    }

    public function postAddAjax(ExpenseRequest $request)
    {
        $data = $request->only('name', 'price', 'category_id', 
            'user_id', 'description');
        $data['user_id'] = Auth::user()->id;
        $currentUser = Auth::user();
        if ($data['price'] > $currentUser->total_money) {
            return 'fails';
        }
        $expense = Expense::create($data);
        $expenses = Expense::listExpense(Auth::user()->id)->get();

        $currentUser->total_money -= $expense->price;
        $currentUser->update([
            'total_money' => $currentUser->total_money
        ]);
        $currentUser = Auth::user();

        return view('expense.list', compact('expenses', 'currentUser'));
    }

    public function postUpdateAjax(ExpenseRequest $request)
    {
        $id = $request->id;
        if ($id) {
            $data = $request->only('name', 'price', 'category_id', 
                'description');
            $expense = Expense::find($id);
            $oldPrice = $expense->price;
            $expense->update($data);
            $expenses = Expense::listExpense(Auth::user()->id)->get();

            $currentUser = Auth::user();
            $currentUser->total_money = $currentUser->total_money + $oldPrice 
                - $expense->price;
            $currentUser->update([
                'total_money' => $currentUser->total_money
            ]);
            $currentUser = Auth::user();

            return view('expense.list', compact('expenses', 'currentUser'));
        }
    }

    public function postDeleteAjax(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $expense = Expense::find($id);
            $expense->delete();
            $expenses = Expense::listExpense(Auth::user()->id)->get();

            $currentUser = Auth::user();
            $currentUser->total_money += $expense->price;
            $currentUser->update([
                'total_money' => $currentUser->total_money
            ]);
            $currentUser = Auth::user();

            return view('expense.list', compact('expenses', 'currentUser'));
        }
    }

    public function postFilterCategory(Request $request)
    {
        $categoryId = $request->categoryId;

        $expenses = Expense::filterByCategory($categoryId, 
            Auth::user()->id)->get();
        $currentUser = Auth::user();

        return view('expense.list', compact('expenses', 'currentUser'));
    }

    public function postFilterCategoryDate(Request $request)
    {
        $categoryId = $request->categoryId;
        $start = $request->start;
        $finish = $request->finish;
        $expenses = Expense::filterCategoryDate($categoryId, $start, $finish,
            Auth::user()->id)->get();
        $currentUser = Auth::user();

        return view('expense.list', compact('expenses', 'currentUser'));
    }
}
