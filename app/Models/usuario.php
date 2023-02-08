<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table = "tabusuario";
    public $timestamps = false;
    use HasFactory;
    
    //protected $fillable = ['email', 'nivel', 'senha', 'token', 'cpf_cnpj', 'telefone', 'email_verificado_em'];

    public function cooperado()
    {
        return $this->belongsTo(cooperado::class, 'cpf_cnpj','cpf_cnpj');
    }
}
