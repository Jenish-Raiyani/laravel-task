<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
class SubscriberController extends Controller
{
    public function create(Request $request) {
        $request->validate(
            [
                'email' => 'required | email',
            ]

        );
        $email =  $request->input('email');
        $subsciber = DB::table('tbl_subscribers')-> where(['email'=>$email,'website_id'=>1])->get();

        if(count($subsciber) == 0)
        {
            $tbl_subsciber = new Subscriber();
            $tbl_subsciber->email =$email;
            $tbl_subsciber->website_id = 1;
            $tbl_subsciber->save();
            //return response()->json($tbl_subsciber);
            return redirect('/website1');
        }
        else
        {
            echo "<script>alert('User is already exits');window.location.href = '/website1'; </script>";
        }

    }


    public function insert(Request $request) {

        $request->validate(
            [
                'email' => 'required | email',
            ]

        );
        $email =  $request->input('email');
        $subsciber = DB::table('tbl_subscribers')-> where(['email'=>$email,'website_id'=>2])->get();

        if(count($subsciber) == 0)
        {
            $tbl_subsciber = new Subscriber();
            $tbl_subsciber->email =$email;
            $tbl_subsciber->website_id = 2;
            $tbl_subsciber->save();
            //return response()->json($tbl_subsciber);
            return redirect('/website2');
        }
        else
        {
            echo "<script>alert('User is already exits');window.location.href = '/website2'; </script>";
        }

    }
}
