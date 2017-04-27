<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollectRequest;
use App\Collect;
use App\User;
use App\Activity;
use Auth;

class CollectController extends Controller
{
    public function index()
    {
        $collects = Collect::listCollect(Auth::user()->id)->get();
        $currentUser = Auth::user();

        return view('collect.index', compact('collects', 'currentUser'));
    }

    public function postAddAjax(CollectRequest $request)
    {
        $data = $request->only('price');
        $data['user_id'] = Auth::user()->id;
        $collect = Collect::create($data);
        $collects = Collect::listCollect(Auth::user()->id)->get();

        $currentUser = Auth::user();
        $currentUser->total_money += $collect->price;
        $currentUser->update([
            'total_money' => $currentUser->total_money
        ]);
        $currentUser = Auth::user();

        return view('collect.list', compact('collects', 'currentUser'));
    }

    public function postDeleteAjax(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $collect = Collect::find($id);
            $collect->delete();
            $collects = Collect::listCollect(Auth::user()->id)->get();
            
            $currentUser = Auth::user();
            $currentUser->total_money -= $collect->price;
            $currentUser->update([
                'total_money' => $currentUser->total_money
            ]);
            $currentUser = Auth::user();

            return view('collect.list', compact('collects', 'currentUser'));
        }
    }

    public function postFilterDate(Request $request)
    {
        $start = $request->start;
        $finish = $request->finish;
        $collects = Collect::filterDate($start, $finish)->get();
        $currentUser = Auth::user();

        return view('collect.list', compact('collects', 'currentUser'));
    }
}
