<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cobranca extends Model
{
    public $timestamps = false;
    protected $table = "tabcobranca";
    use HasFactory;
    public function arquivo()
    {
        return $this->hasOne(arquivo::class,"id","idarquivo");
    }
}
