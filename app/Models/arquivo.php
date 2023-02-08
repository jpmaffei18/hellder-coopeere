<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arquivo extends Model
{
    public $timestamps = false;
    protected $table = "tabarquivo";
    use HasFactory;
}
