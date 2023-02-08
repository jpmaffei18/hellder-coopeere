<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\usuario;
use App\Models\cooperado;
use App\Models\operadora;
use App\Models\prodist;
use App\Models\emailconfig;
use App\Models\arquivo;
use App\Models\tensaoatendimento;
use App\Models\tipoconexao;
use App\Models\tiporamal;
use App\Models\tipofontegeracao;
use App\Models\periodicidade;
use App\Models\meiopagamento;
use App\Models\periodicidademeiopagamento;
use App\Models\diadevencimento;

class AdminController extends Controller
{
    //
    public function admin() {
        $cota_comprada_total = prodist::where('statusreg','=','F')->sum('cota_comprada');
        $cota_a_ser_comprada_total = prodist::where('statusreg','<>','F')->sum('cota_comprada');
        $cota_comprada_total_alto_consumo = prodist::where('statusreg','=','F')
                                                            ->join('tabcooperado','tabprodist.idcooperadoprodist', '=', 'tabcooperado.id')
                                                            ->where('tabcooperado.tipo_conta', '=', 'alto consumo')->sum('cota_comprada');
        $cota_a_ser_comprada_total_alto_consumo = prodist::where('statusreg','<>','F')
                                                            ->join('tabcooperado','tabprodist.idcooperadoprodist', '=', 'tabcooperado.id')
                                                            ->where('tabcooperado.tipo_conta', '=', 'alto consumo')->sum('cota_comprada');
        $cota_comprada_total_alto_consumo_grupo_conta_1 = prodist::where('statusreg','=','F')
                                                            ->join('tabcooperado','tabprodist.idcooperadoprodist', '=', 'tabcooperado.id')
                                                            ->where('tabcooperado.tipo_conta', '=', 'alto consumo')
                                                            ->where('tabcooperado.grupo_conta', '=', '1')
                                                            ->sum('cota_comprada');

        //$cooperado = cooperado::find($idcooperado);
        return view('admin.dashboard', compact('cota_comprada_total','cota_comprada_total_alto_consumo','cota_a_ser_comprada_total',
                                                'cota_a_ser_comprada_total_alto_consumo','cota_comprada_total_alto_consumo_grupo_conta_1'));
        
        
    }
}
