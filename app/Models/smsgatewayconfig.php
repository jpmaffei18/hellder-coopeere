<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class smsgatewayconfig extends Model
{
    public $timestamps = false;
    protected $table = "tabsmsgatewayconfig";
    use HasFactory;
}