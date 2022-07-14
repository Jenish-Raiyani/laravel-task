<?php

use App\Http\Controllers\SendmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website1Controller;
use App\Http\Controllers\Website2Controller;
use App\Http\Controllers\SubscriberController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/website1',[Website1Controller::class,'index']);
Route::get('/website2',[Website2Controller::class,'index']);
Route::post('/subscribeweb1',[SubscriberController::class,'create']);
Route::post('/subscribeweb2',[SubscriberController::class,'insert']);
Route::get('/postweb1',[Website1Controller::class,'create']);
Route::get('/postweb2',[Website2Controller::class,'create']);
Route::post('/web1post',[Website1Controller::class,'insert']);
Route::post('/web2post',[Website2Controller::class,'insert']);
Route::get('sending-queue-emails', [SendmailController::class,'sendTestEmails']);
