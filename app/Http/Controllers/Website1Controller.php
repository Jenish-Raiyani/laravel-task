<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website1post;
use Illuminate\Support\Facades\DB;
class Website1Controller extends Controller
{
    public function index()
    {
        $totalpost = DB::table('tbl_web1post')->count();
        return view('website1',['totalpost'=>$totalpost]);
    }

    public function create()
    {
        return view('web1-post');
    }
    public function insert(Request $request) {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
            ]);
        $addpost = new Website1post();
        $addpost->title = $request->input('title');
        $addpost->description = $request->input('description');
        $addpost->save();

        return redirect('/website1');


    }
}
