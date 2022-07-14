<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use App\Jobs\QueueSendEmail;
class SendmailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //php artisan tinker
    //app()->call('App\Http\Controllers\SendmailController@sendTestEmails');
    public function sendTestEmails()
    {
        $emailJobs = new QueueSendEmail();
        $this->dispatch($emailJobs);
    }



}
