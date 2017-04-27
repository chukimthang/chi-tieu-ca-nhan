<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    public function postDeleteAjax(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $user = User::find($id);
            $user->delete();
            $users = User::all();

            return view('admin.user.list', compact('users'));
        }
    }
}
