<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodist extends Model
{
    public $timestamps = false;
    protected $table = "tabprodist";
    use HasFactory;

    public function cooperado()
    {
        return $this->hasOne(cooperado::class,"id","idcooperadoprodist");
    }

    public function operadora()
    {
        return $this->hasOne(operadora::class,"id","idoperadoraprodist");
    }

    public static function lista_tensaoatendimento()
    {   
        $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
        return $tensaoatendimento ;
    }

    public static function lista_tipoconexao()
    {
        $tipoconexao= tipoconexao::all(['tipo']);
        return $tipoconexao;
    }
    
    public static function lista_tiporamal() 
    {
        $tiporamal= tiporamal::all(['tipo']);
        return $tiporamal;
    }

    public static function lista_tipofontegeracao()
    {
        $tipofontegeracao= tipofontegeracao::all(['tipo']);
        return $tipofontegeracao;
    }
        
}
