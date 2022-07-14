<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website2post extends Model
{
 //   use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_web2post";
    protected $fillable = ['title','description'];
}
