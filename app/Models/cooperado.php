<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cooperado extends Model
{
    public $timestamps = false;
    
    protected $table = "tabcooperado";
    
    use HasFactory;
    //protected $fillable = ['tipo', 'nome', 'cep', 'endereco', 'bairro', 'cidade',
      // 'estado', 'cpf_cnpj', 'idoperadora', 'tipo_conta', 'sorteio', 'status' ];

    public function usuario()
    {
        return $this->hasOne(usuario::class,"cpf_cnpj","cpf_cnpj");
    }

    public function operadora()
    {
        return $this->hasOne(operadora::class,"id","idoperadora");
    }

    public function convidados()
    {
        if ($this->token_convite != null)
            return cooperado::where('token_convidado','=',$this->token_convite)->get();
        else
            return cooperado::where('token_convidado','=','x')->get();
        
    }
    
    public static function lista_operadoras()
    {
        $operadoras = operadora::all(['id', 'nome']);
        return $operadoras;
    }

    public static function lista_periodicidade() 
    {
        $periodicidade = periodicidade::all(['periodicidade','valor']);
        return $periodicidade;
    }

    public static function lista_meio_pagamento()
    {
        $meio_pagamento = meiopagamento::all(['meio_pagamento']);
        return $meio_pagamento;
    }

    public static function lista_periodicidademeiopagamento()
    {
        $periodicidademeiopagamento = periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
        return $periodicidademeiopagamento;
    }

    public static function lista_dia_vencimento()
    {
        $dia_vencimento = diadevencimento::all(['dia_vencimento']);
        return $dia_vencimento;
    }


}
