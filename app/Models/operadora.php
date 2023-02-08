<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operadora extends Model
{
    public $timestamps = false;
    protected $table = "taboperadora";
    use HasFactory;
}
