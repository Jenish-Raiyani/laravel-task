<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website2post;
use Illuminate\Support\Facades\DB;

class Website2Controller extends Controller
{
    public function index()
    {
        $totalpost = DB::table('tbl_web2post')->count();
        return view('website2',['totalpost'=>$totalpost]);
    }

    public function create()
    {
        return view('web2-post');
    }
    public function insert(Request $request) {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
            ]);
        $addpost = new Website2post();
        $addpost->title = $request->input('title');
        $addpost->description = $request->input('description');
        $addpost->save();

        return redirect('/website2');


    }
}
