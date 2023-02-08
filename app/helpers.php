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

if (! function_exists('crypto_rand_secure')) {
    function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }
}

if (! function_exists('getNumToken')) {
    function getNumToken($length)
    {
        $token = "";
        $codeAlphabet = "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
}

if (! function_exists('getToken')) {
    function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
}

if (! function_exists('getSmsToken')) {
    function getSmsToken($length)
    {
        $token = "";
        $codeAlphabet = "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
}

if (! function_exists('dayNumber')) {
    function dayNumber($date=''){
        if($date==''){
            $t=date('d-m-Y');
        } else {
            $t=date('d-m-Y',strtotime($date));
        }

        $dayName = strtolower(date("D",strtotime($t)));
        $dayNum = strtolower(date("d",strtotime($t)));
        $return = floor(($dayNum - 1) / 7) + 1;
        return $return;
    }
}


if (! function_exists('gerar_cod_parcela')) {
    function gerar_cod_parcela(cooperado $cooperado)
    {
        $periodiciadade_map = array(
            "mensal" => "M",
            "bimestral" => "B",
            "trimestral" => "T",
            "semestral" => "S",
            "anual" => "A",
        );
        $meio_pagamento_map = array(
            "pix" => "PIX",
            "boleto bancário" => "BOL",
            "depósito bancário" => "DEP",
            "cartão de crédito" => "CRD",
            "cartão de débito" => "DEB",
        );
        $periodicidade_cod = $periodiciadade_map[$cooperado->periodicidade];
        $meio_pagamento_cod = $meio_pagamento_map[$cooperado->meio_pagamento];
        $cooperado_cod = $cooperado->id;
        $cod_nosso_numero = getNumToken(15);
        $cod_parcela = str_pad($cooperado_cod, 16, '0', STR_PAD_LEFT).$periodicidade_cod.$meio_pagamento_cod.str_pad($cod_nosso_numero, 15, '0', STR_PAD_LEFT);
        return $cod_parcela;
    }
}

if (! function_exists('eh_preciso_gerar_cobranca_este_mes')) {
    function eh_preciso_gerar_cobranca_este_mes($cooperado) {
        //echo ("gerar cobranca este mes");
        // pegar mes do vencimento atual e subtrair do mes da ultima cobranca
        $ultima_cobranca = cobranca::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->orderBy('dt_processamento','DESC')->first();
        if ($cooperado->status == "suspenso" || $cooperado->status == "deletado")
        {
            return false;
        }
        if ($ultima_cobranca == null)
        {
            return true;
        }
        $data_processamento_ultima_cobranca = $ultima_cobranca->dt_processamento;

        $data_hoje = date("Y-m-d");

        $data_hoje = strtotime($data_hoje);
        //$effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
        $m_atual = date("m", $data_hoje);
        $y_atual = date("Y", $data_hoje);

        $data_processamento_ultima_cobranca = strtotime($data_processamento_ultima_cobranca);

        $m_passado = date("m", $data_processamento_ultima_cobranca);
        $y_passado = date("Y", $data_processamento_ultima_cobranca);

        if ($y_atual == $y_passado)
        {
            $m_diferenca = $m_atual - $m_passado;
           
        }
        else if ($y_atual > $y_passado)
        {
            $m_diferenca = 12 + $m_atual - $m_passado;
        }
        $log =  "mes de diferenca  -------------------------------- $m_diferenca";

        
        //echo ($log);
        if ($cooperado->periodicidade == "mensal" && $m_diferenca >= 1)
        {
            return true;
        }
        if ($cooperado->periodicidade == "bimestral" && $m_diferenca >= 2)
        {
            return true;
        }
        if ($cooperado->periodicidade == "trimestral" && $m_diferenca >= 3)
        {
            return true;
        }
        if ($cooperado->periodicidade == "semestral" && $m_diferenca >= 6)
        {
            return true;
        }
        if ($cooperado->periodicidade == "anual" && $m_diferenca >= 12)
        {
            return true;
        }
        return false;
    }
}


?>