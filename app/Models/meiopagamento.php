<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meiopagamento extends Model
{
    public $timestamps = false;
    protected $table = "tabmeiopagamento";
    use HasFactory;
}
