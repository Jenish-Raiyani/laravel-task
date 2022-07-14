<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website1post extends Model
{
    public $timestamps = false;
    protected $table = "tbl_web1post";
    protected $fillable = ['title','description'];
}
