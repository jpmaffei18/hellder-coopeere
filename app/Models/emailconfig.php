<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailconfig extends Model
{
    public $timestamps = false;
    protected $table = "tabemailconfig";
    use HasFactory;
}