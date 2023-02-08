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

require_once env('ROOT').'/app/helpers.php';
require_once env('ROOT').'/app/aarin_helpers.php';
require_once env('ROOT').'/app/asaas_helpers.php';

class CobrancasController extends Controller
{
    //
    public function cobrancas(){
        $cobrancas = cobranca::where('status','=', 'aberto')->orderBy('dt_processamento', 'ASC')->get();
        return view('admin.cobrancas', ['cobrancas' => $cobrancas]);
    }

    public function massDelete(Request $request)
    {
        
    }

    public function gerar_cobranca(Request $request){

       //if($request->btn_submit == 'gerar_novas_cobrancas') {
            

            $cooperados = cooperado::where('tipo' ,'=', 'cooperado')->orWhere('tipo' ,'=', 'apoiador')->get();
            {
                foreach ($cooperados as $cooperado )
                {

                    $cobrancas_nao_abertas_no_ano = cobranca::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->get();
                    $cobrancas = cobranca::where('cpf_cnpj','=', $cooperado->cpf_cnpj)->whereYear('dt_processamento','=', date('Y'))->whereMonth('dt_processamento','=', date('m'))->first();
                    if ($cobrancas == null && eh_preciso_gerar_cobranca_este_mes($cooperado))
                    {
                        //echo ("nova cobranca-----------------------------------");
                        // Gerar nova cobranca para o cooperado X
                        $cobranca = new Cobranca();
                        $cobranca->dt_processamento = date("Y-m-d");
                        $periodicidade = periodicidade::all(['periodicidade','valor']);
                        $parcela_periodicidade = $cooperado->periodicidade;
                        $parcela_num_parcelas = periodicidade::where('periodicidade', '=', $parcela_periodicidade)->first();
                        $_num_parcelas = $parcela_num_parcelas->{'num_parcelas'};
                        $i=0;
                        foreach ($cobrancas_nao_abertas_no_ano as $cob)
                        {
                            $i++;
                        }
                        $i = ($i % $_num_parcelas) +1;
                        //echo ("i     $i------/------${_num_parcelas}-----------------------");
                        $Date = date("Y-m-d");
                        $cobranca->parcela = "$i/$_num_parcelas";
                        //$cobranca->parcela = "1/12";
                        $cobranca->dt_processamento = date("Y-m-d");
                        //$cobranca->dt_vencimento = date('Y-m-d', strtotime($Date. ' + 10 days'));
                        
                        $day_number = date("d");
                        //echo ("------pegar vencimento no proximo mes $day_number < $cooperado->dia_vencimento ?"); 
                        if ($day_number < $cooperado->dia_vencimento)
                        {
                            // pegar vencimento neste mes
                            $d = $cooperado->dia_vencimento;
                            $m = date('m');
                            $y = date('Y');
                            $cobranca->dt_vencimento = "$y-$m-$d";
                        } else {
                            //echo ("------pegar vencimento no proximo mes"); 
                            // pegar vencimento no proximo mes
                            $d = $cooperado->dia_vencimento;
                            

                            $effectiveDate = strtotime("+1 month", strtotime($Date));
                            //$effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
                            $m = date("m", $effectiveDate);
                            $y = date("Y", $effectiveDate);
                            $cobranca->dt_vencimento = "$y-$m-$d";
                        }
                        
                        $cobranca->cod_parcela = gerar_cod_parcela($cooperado);
                        $cobranca->cpf_cnpj = $cooperado->cpf_cnpj;
                        foreach($periodicidade as $itemi)  
                        {
                            if ($itemi->periodicidade == $cooperado->periodicidade)
                            {
                                $cobranca->valor_a_pagar = $itemi->valor;
                                break;
                            } 
                        }
                        $cobranca->status = 'aberto';

                        $cobranca->save();
                        
                    }
                }
            }
            
                
            $cobrancas = cobranca::where('status','=', 'aberto')->orderBy('dt_processamento', 'ASC')->get();
            return view('admin.cobrancas', ['cobrancas' => $cobrancas]);
        //}
    
/*
        if($request->btn_submit == 'delete_cobrancas') {

           $ids = $request->ids;
           print_r($ids);
        //Product::whereIn('id',explode(",",$ids))->delete();
        //return response()->json(['success'=>"Products Deleted successfully."]);
        //$cobrancas = cobranca::where('status','=', 'aberto')->orderBy('dt_processamento', 'ASC')->get();
        $cobrancas = cobranca::whereIn('id',explode(",",$ids))->orderBy('dt_processamento', 'ASC')->get();
            return view('admin.cobrancas', ['cobrancas' => $cobrancas]);
        }
        
*/
    }

    // AJAX
    // https://web-tuts.com/laravel-multiple-checkbox-with-delete-rows-example
    public function delete_all(Request $request)
    {
        $ids = $request->ids;

        file_put_contents("meu-arquivo-log.txt", $ids);
        //print_r($ids);
        //Product::whereIn('id',explode(",",$ids))->delete();
        //$cobrancas = cobranca::where('status','=', 'aberto')->orderBy('dt_processamento', 'ASC')->get();
        $cobrancas = cobranca::whereIn('id',explode(",",$ids))->orderBy('dt_processamento', 'ASC')->get();
        
        foreach ($cobrancas as $cobranca)
        {
            if (str_contains($cobranca->cod_parcela,"BOL"))
            {
                $cooperado = cooperado::where('cpf_cnpj' ,'=', $cobranca->cpf_cnpj)->first();
                $response = asaas_get_customer($cooperado);
                $obj_get_customer = $response;
                $customer_id = null;
                $customer_id = $obj_get_customer['data'][0]['id'];
                if ($customer_id!= null){
                    $response = asaas_get_boleto_em_aberto($customer_id, $cobranca);
                    $obj_get_boleto_em_aberto = $response;
                    if ($obj_get_boleto_em_aberto['totalCount'] != 0)
                    {
                        $id = $obj_get_boleto_em_aberto['id'];
                        asaas_remover_boleto($id);

                    }
                }
                
            }
            if (str_contains($cobranca->cod_parcela,"PIX"))
            {
                $aarin_token = aarin_oauth_token();
                if (!empty($aarin_token['description']))
                {
                    $errors_aarin = $aarin_token;
                    return response()->json(['error'=>"$errors_aarin"]);
                }

                $usuario = usuario::where('cpf_cnpj' ,'=', $cobranca->cpf_cnpj)->first();
                $response = aarin_get_cobv($usuario, $cobranca, $aarin_token,"ATIVA");

                if ($response == null)
                {
                    $response = aarin_cobv($usuario, $cobranca, $aarin_token);
                } else if (!empty($response['description'])) {
                    $errors_aarin = $response;
                    return response()->json(['error'=>"$errors_aarin"]);
                }

                if (!empty($response['pix']['id']))
                {
                    $response = aarin_remove_cobv($response['pix']['id']);
                    if (!empty($response['description'])) {
                        $errors_aarin = $response;
                        return response()->json(['error'=>"$errors_aarin"]);
                    }
                } 
                
            }
        }

        foreach ($cobrancas as $cobranca)
        {
            $cobranca->delete();
        }
            //return view('admin.cobrancas', ['cobrancas' => $cobrancas]);
            return response()->json(['success'=>"Cobranças [$ids] removidas com sucesso."]);
    }
    
}