<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::listCategory(Auth::user()->id)->paginate(5);

        return view('category.index', compact('categories'));
    }

    public function postAddAjax(CategoryRequest $request)
    {
        $data = $request->only('name');
        $data['user_id'] = Auth::user()->id;
        $category = Category::create($data);

        return response()->json(['status' => 200]);
    }

    public function postUpdateAjax(CategoryRequest $request)
    {
        $id = $request->id;
        if ($id) {
            $data = $request->only('name');
            $category = Category::find($id);
            $category->update($data);

            return response()->json(['status' => 200]);
        }
    }

    public function postDeleteAjax(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $category = Category::find($id);
            $category->delete();

            return 'success';
        }
    }
}
