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


use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;


if (! function_exists('mask')) {
    function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
        }
    }


if (! function_exists('tag_codigo_uc')) {
    function tag_codigo_uc($pdf, $codigo_uc) 
    {
        $pdf->SetXY(67+3, 75-7);
        $pdf->Write(0, $codigo_uc);
    }
}

if (! function_exists('tag_classe_uc')) {
    function tag_classe_uc($pdf, $classe_uc) 
    {
        $pdf->SetXY(118, 75-7);
        $pdf->Write(0, $classe_uc);
    }
}

if (! function_exists('tag_titular_uc')) {
    function tag_titular_uc($pdf, $titular_uc) 
    {
        $pdf->SetXY(66+3, 79-7);
        $str = iconv('UTF-8', 'windows-1252', $titular_uc);
        $pdf->Write(0, $str);
    }
}

if (! function_exists('tag_rua_av')) {
    function tag_rua_av($pdf, $rua_av) 
    {
        $pdf->SetXY(57+4, 84-8);
        $str = iconv('UTF-8', 'windows-1252', $rua_av);
        $pdf->Write(0, $str);
    }
}

if (! function_exists('tag_numero')) {
    function tag_numero($pdf, $numero) 
    {
        $pdf->SetXY(132-3, 84-8);
        $pdf->Write(0, $numero);
    }
}

if (! function_exists('tag_cep')) {
    function tag_cep($pdf, $cep) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $str = str_replace($look, "", $cep);
        $pdf->SetXY(153+1, 84-8);
        $str2 = mask($str,'#####-###');
        $pdf->Write(0, $str2);
    }
}

if (! function_exists('tag_bairro')) {
    function tag_bairro($pdf, $bairro) 
    {
        $pdf->SetXY(54+4, 88-8);
        $str = iconv('UTF-8', 'windows-1252', $bairro);
        $pdf->Write(0, $str);
    }
}

if (! function_exists('tag_cidade')) {
    function tag_cidade($pdf, $cidade) 
    {
        $pdf->SetXY(130-4, 88-8);
        $str = iconv('UTF-8', 'windows-1252', $cidade);
        $pdf->Write(0, $str);
    }
}

if (! function_exists('tag_email')) {
    function tag_email($pdf, $email) 
    {
        $pdf->SetXY(54+5, 92-8);
        $pdf->Write(0, $email);
    }
}

if (! function_exists('tag_telefone')) {
    function tag_telefone($pdf, $telefone) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $tel = str_replace($look, "", $telefone);
        $ddd = substr($tel,0,2);
        $num = substr($tel,2);
        $pdf->SetXY(61+3, 97-9);
        $pdf->Write(0, $ddd);
        $pdf->SetXY(67+3, 97-9);
        if (strlen($num) > 8)
        {
            $str = mask($num,'#####-####');
            $pdf->Write(0, $str);
        } else {
            $str = mask($num,'####-####');
            $pdf->Write(0, $str);
        }
    }
}

if (! function_exists('tag_celular')) {
    function tag_celular($pdf, $celular) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $tel = str_replace($look, "", $celular);
        $ddd = substr($tel,0,2);
        $num = substr($tel,2);
        $pdf->SetXY(120-2, 97-9);
        $pdf->Write(0, $ddd);
        $pdf->SetXY(127-2, 97-9);
        if (strlen($num) > 8)
        {
            $str = mask($num,'#####-####');
            $pdf->Write(0, $str);
        } else {
            $str = mask($num,'####-####');
            $pdf->Write(0, $str);
        }
    }
}

if (! function_exists('tag_cpf_cnpj')) {
    function tag_cpf_cnpj($pdf, $cpf_cnpj) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $str = str_replace($look, "", $cpf_cnpj);
        if (strlen($str) == 11){
        $str = mask($str,'###.###.###-##');
        } else {
        $str = mask($str,'##.###.###/####-##');
        }
        $pdf->SetXY(62+4, 101-9);
        $pdf->Write(0, $str);
    }
}

if (! function_exists('tag_potencia_instalada_uc_kw')) {
    function tag_potencia_instalada_uc_kw($pdf, $potencia_instalada_uc_kw) 
    {
        $pdf->SetXY(80+4, 110-10);
        $pdf->Write(0, $potencia_instalada_uc_kw);
    }
}

if (! function_exists('tag_tensao_atendimento')) {
    function tag_tensao_atendimento($pdf, $tensao_atendimento) 
    {
        $pdf->SetXY(160-3, 110-10);
        $pdf->Write(0, $tensao_atendimento);
    }
}

if (! function_exists('tag_tipo_conexao')) {
    function tag_tipo_conexao($pdf, $tipo_conexao) 
    {
        if ($tipo_conexao == 'monofásica')
        {
            $pdf->SetXY(97, 114-10);
        }
        if ($tipo_conexao == 'bifásica')
        {
            $pdf->SetXY(126-2, 114-10);
        }
        if ($tipo_conexao == 'trifásica')
        {
            $pdf->SetXY(154-4, 114-10);
        }
        $pdf->Write(0, 'X');
    }
}

if (! function_exists('tag_tipo_ramal')) {
    function tag_tipo_ramal($pdf, $tipo_ramal)
    {
        if ($tipo_ramal == 'aéreo')
        {
            $pdf->SetXY(81, 108);
        }
        if ($tipo_ramal == 'subterrâneo')
        {
            $pdf->SetXY(129, 108);
        }
        $pdf->Write(0, 'X');

    } 
}

if (! function_exists('tag_potencia_instalada_geracao_kw')) {
    function tag_potencia_instalada_geracao_kw($pdf, $potencia_instalada_geracao_kw) 
    {
        $pdf->SetXY(104, 123-7);
        $pdf->Write(0, $potencia_instalada_geracao_kw);
    }
}

if (! function_exists('tag_tipo_fonte_geracao')) {
    function tag_tipo_fonte_geracao($pdf, $tipo_fonte_geracao) 
    {
        if ($tipo_fonte_geracao == 'hidráulica')
        {
            $pdf->SetXY(60+3, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'solar')
        {
            $pdf->SetXY(81+2, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'eólica')
        {
            $pdf->SetXY(103, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'biomassa')
        {
            $pdf->SetXY(131-3, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'cogeração qualificada')
        {
            $pdf->SetXY(180-8, 131-8);
            $pdf->Write(0, 'X');
        } else {
            $pdf->SetXY(76+2, 136-9);
            $pdf->Write(0, $tipo_fonte_geracao);
        }
    }
}

?>