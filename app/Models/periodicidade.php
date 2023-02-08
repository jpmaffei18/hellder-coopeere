<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periodicidade extends Model
{
    public $timestamps = false;
    protected $table = "tabperiodicidade";
    use HasFactory;
}
