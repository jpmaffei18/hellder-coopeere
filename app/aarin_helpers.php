<?php

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


if (! function_exists('aarin_oauth_token')) {

    function aarin_oauth_token() {

        //$financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
        $AARIN_SENHA = env('AARIN_SENHA');
        $AARIN_URL = env('AARIN_URL');


        $url = "$AARIN_URL/oauth/token";
        $auth_escopo = array("cobv.write", "cobv.read", "pix.write","pix.read","webhook.write", "webhook.read", 
                                "account.write", "account.read", "destiny.account.read", "destiny.account.write");
        $auth = array("empresaId"=>$AARIN_EMPRESA_ID, "senha"=>$AARIN_SENHA, "escopo"=>$auth_escopo);

        $content = json_encode($auth);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
        return $response; //returns token
    }

}

if (! function_exists('aarin_oauth_token_refresh')) {

    function aarin_oauth_token_refresh($token) {

        //$financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
        $AARIN_SENHA = env('AARIN_SENHA');
        $AARIN_URL = env('AARIN_URL');


        $url = "$AARIN_URL/oauth/token/refresh";
        
        $refresh_token = array("refreshToken"=>$token->{"refreshToken"});

        $content = json_encode($refresh_token);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
        return $response;
    }
}

if (! function_exists('aarin_cobv')) {

    function aarin_cobv($usuario, $cobranca, $aarin_token) {

        //$financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
        $AARIN_SENHA = env('AARIN_SENHA');
        $AARIN_URL = env('AARIN_URL');
        $AARIN_CHAVE_PIX = env('AARIN_CHAVE_PIX');

        $access_token = $aarin_token['accessToken'];

        $cod_parcela = $cobranca->cod_parcela;
        $dt_vencimento = $cobranca->dt_vencimento;

        $url = "$AARIN_URL/cobv/$cod_parcela";
        //$auth_escopo = array("cobv.write", "cobv.read", "pix.write","pix.read","webhook.write", "webhook.read", "account.write", "account.read", "destiny.account.read", "destiny.account.write");
        //$auth = array("empresaId"=>$AARIN_EMPRESA_ID, "senha"=>$AARIN_SENHA, "escopo"=>$auth_escopo);

        $calendario = array("dataDeVencimento"=>$dt_vencimento, "validadeAposVencimento"=>30);

        if (strlen($usuario->cooperado->cpf_cnpj) == 11) {
            $devedor = array("email"=>$usuario->email, "logradouro"=>$usuario->cooperado->endereco, "cidade"=>$usuario->cooperado->cidade,  
                            "uf"=>$usuario->cooperado->estado, "cep" =>$usuario->cooperado->cep, "telefone"=>$usuario->cooperado->telefone_celular, 
                            "nome"=>$usuario->cooperado->nome , "cpf"=> $usuario->cooperado->cpf_cnpj);
        } else {
            $devedor = array("email"=>$usuario->email, "logradouro"=>$usuario->cooperado->endereco, "cidade"=>$usuario->cooperado->cidade,  
                            "uf"=>$usuario->cooperado->estado,  "cep" =>$usuario->cooperado->cep, "telefone"=>$usuario->cooperado->telefone_celular, 
                            "nome"=>$usuario->cooperado->nome , "cnpj"=> $usuario->cooperado->cpf_cnpj);
        }


    
        //$descontoDataFixa =array("data"=> $cobranca->dt_vencimento, "valorPerc"=>"1.00");
        //$desconto =array("modalidade"=> "1", "valorPerc"=>"1.00", "descontoDataFixa"=>array($descontoDataFixa));
        $desconto =array("modalidade"=> "2", "valorPerc"=>"0.01");
        $abatimento =array("modalidade"=> "1", "valorPerc"=>"0.00");
        $juros =array("modalidade"=> "1", "valorPerc"=>"1.00");
        $multa =array("modalidade"=> "1", "valorPerc"=>"0.50");
        $valor =array("original"=> $cobranca->valor_a_pagar,"multa"=> $multa, "juros"=>$juros, "abatimento"=>$abatimento, "desconto"=>$desconto);

        $payload = array("calendario"=>$calendario, "devedor"=>$devedor, "valor"=>$valor);

        $content = json_encode($payload);
        //echo("PIX COBV     ".$content);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json",
                    "Authorization: Bearer $access_token"));
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,  CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
        return $response; 
    }
}


if (! function_exists('aarin_get_cobv')) {

    function aarin_get_cobv($usuario, $cobranca, $aarin_token, $status) {

        //$financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
        $AARIN_SENHA = env('AARIN_SENHA');
        $AARIN_URL = env('AARIN_URL');
        $AARIN_CHAVE_PIX = env('AARIN_CHAVE_PIX');

        $access_token = $aarin_token['accessToken'];

        $cod_parcela = $cobranca->cod_parcela;
        $dt_vencimento = $cobranca->dt_vencimento;

        
        //$auth_escopo = array("cobv.write", "cobv.read", "pix.write","pix.read","webhook.write", "webhook.read", "account.write", "account.read", "destiny.account.read", "destiny.account.write");
        //$auth = array("empresaId"=>$AARIN_EMPRESA_ID, "senha"=>$AARIN_SENHA, "escopo"=>$auth_escopo);

       
        $url = $AARIN_URL."/cobv";

        if (strlen($usuario->cooperado->cpf_cnpj) == 11) {
            $url = $AARIN_URL."/cobv?Status=".$status."&Cpf=".$usuario->cooperado->cpf_cnpj;
            
        } else {
            $url = $AARIN_URL."/cobv?Status=".$status."&Cpf=".$usuario->cooperado->cpf_cnpj;
        }

        
        //echo("PIX COBV     ".$content);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json",
                    "Authorization: Bearer $access_token"));
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($curl,  CURLOPT_CUSTOMREQUEST, "PUT");
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }


        curl_close($curl);

        $response = json_decode($json_response, true);


        $cobs= $response["cobs"];

        $id = null;
        foreach ($cobs as $cob)
        {
            if ($cob["txId"] === $cobranca->cod_parcela)
            {
                $id = $cob["id"];
            }
        }
        
        if ( $id == null ) {
            /*
            $error = "Erro ao chamar $url falhou cobranca não localizada para txId: ".$cobranca->cod_parcela.", curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            */
            return null;
        }

        // consultar cobranca

        $url = $AARIN_URL."/cobv/$id";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json",
                    "Authorization: Bearer $access_token"));
        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }
        
        curl_close($curl);

        $response = json_decode($json_response, true);
        return $response; 
    }
}





if (! function_exists('aarin_remove_cobv')) {

    function aarin_remove_cobv($id, $aarin_token) {

        //$financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
        $AARIN_SENHA = env('AARIN_SENHA');
        $AARIN_URL = env('AARIN_URL');
        $AARIN_CHAVE_PIX = env('AARIN_CHAVE_PIX');

        $access_token = $aarin_token['accessToken'];

        
        //$auth_escopo = array("cobv.write", "cobv.read", "pix.write","pix.read","webhook.write", "webhook.read", "account.write", "account.read", "destiny.account.read", "destiny.account.write");
        //$auth = array("empresaId"=>$AARIN_EMPRESA_ID, "senha"=>$AARIN_SENHA, "escopo"=>$auth_escopo);

       
        $url = $AARIN_URL."/cobv/".$id;

        
        //echo("PIX COBV     ".$content);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json",
                    "Authorization: Bearer $access_token"));
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($curl,  CURLOPT_CUSTOMREQUEST, "PUT");
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }


        curl_close($curl);

        $response = json_decode($json_response, true);

        return $response; 
    }
}

if (! function_exists('aarin_list_cobv')) {

    function aarin_list_cobv($usuario, $cobranca, $aarin_token) {

        //$financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
        $AARIN_SENHA = env('AARIN_SENHA');
        $AARIN_URL = env('AARIN_URL');
        $AARIN_CHAVE_PIX = env('AARIN_CHAVE_PIX');

        $access_token = $aarin_token['accessToken'];

        $cod_parcela = $cobranca->cod_parcela;
        $dt_vencimento = $cobranca->dt_vencimento;

        
        //$auth_escopo = array("cobv.write", "cobv.read", "pix.write","pix.read","webhook.write", "webhook.read", "account.write", "account.read", "destiny.account.read", "destiny.account.write");
        //$auth = array("empresaId"=>$AARIN_EMPRESA_ID, "senha"=>$AARIN_SENHA, "escopo"=>$auth_escopo);

       
        $url = $AARIN_URL."/cobv";

        if (strlen($usuario->cooperado->cpf_cnpj) == 11) {
            $url = $AARIN_URL."/cobv?Status=ATIVA&Cpf=".$usuario->cooperado->cpf_cnpj;
            
        } else {
            $url = $AARIN_URL."/cobv?Status=ATIVA&Cpf=".$usuario->cooperado->cpf_cnpj;
        }

        
        //echo("PIX COBV     ".$content);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json",
                    "Authorization: Bearer $access_token"));
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($curl,  CURLOPT_CUSTOMREQUEST, "PUT");
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }


        curl_close($curl);

        $response = json_decode($json_response, true);

        return $response; 
    }
}

if (! function_exists('aarin_webhook')) {
    function aarin_webhook($usuario, $cobranca, $aarin_token) {

        $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
        $AARIN_SENHA = env('AARIN_SENHA');
        $AARIN_URL = env('AARIN_URL');
        $AARIN_CHAVE_PIX = env('AARIN_CHAVE_PIX');

        $access_token = $aarin_token['accessToken'];

        $cod_parcela = $cobranca->cod_parcela;


        $url = "$AARIN_URL/webhook";

        $pixWebhookUrl = env('APP_URL')."/api/webook/pix/$cod_parcela"; 
        $payload = array("pixWebhookUrl"=>$pixWebhookUrl);

        $content = json_encode($payload);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json",
                    "Authorization: Bearer $access_token"));
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Erro ao chamar $url falhou com status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) ;
            $payload = array("description"=>$error);

            $json_response = json_encode($payload);
            
            $response = json_decode($json_response, true);
            return $response;
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
        return $response; //returns token
    }
}

?>