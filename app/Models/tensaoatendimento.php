<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tensaoatendimento extends Model
{
    public $timestamps = false;
    protected $table = "tabtensaoatendimento";
    use HasFactory;
}
