<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use App\Models\cooperado;
use App\Models\prodist;
use App\Models\operadora;
use App\Models\emailconfig;
use App\Models\pixconfig;
use App\Models\financeiroconfig;
use App\Models\arquivo;
use App\Models\cobranca;
use App\Models\tensaoatendimento;
use App\Models\tipoconexao;
use App\Models\tiporamal;
use App\Models\tipofontegeracao;
use App\Models\periodicidade;
use App\Models\meiopagamento;
use App\Models\periodicidademeiopagamento;
use App\Models\diadevencimento;

class FinanceiroController extends Controller
{
    public function financeiro(){
        $cobrancas = cobranca::orderBy('dt_processamento', 'ASC')->get();
        return view('admin.financeiro', ['cobrancas' => $cobrancas]);
    }
}
