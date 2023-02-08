<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('vendor/setasign/fpdf/fpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');

// initiate FPDI
$pdf = new Fpdi();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile('formulario-prodist-microgeracao-sup10kw.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
//$pdf->useTemplate($tplIdx, 10, 10, 100);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetFontSize(10);
$pdf->SetTextColor(0,0,0);

$codigo_uc = "1111111111";
$classe_uc = "222222222";
$titular_uc = "Fulano da Silva";
$rua_av = "Rua do Cão Feroz";
$numero = 100;
$cep="28200000";
$bairro="Grussaí";
$cidade_uf="São João da Barra-RJ"; 
$email="admin@gmail.com";
$telefone="2221003000";
$celular="22991003000";
$cpf_cnpj="24485269310";
// $cpf_cnpj="07139282000151";
$potencia_instalada_uc_kw=9.1;
$tensao_atendimento=220;
$potencia_instalada_geracao_kw=5.2;
tag_codigo_uc($pdf, $codigo_uc);
tag_classe_uc($pdf, $classe_uc);
tag_titular_uc($pdf, $titular_uc);
tag_rua_av($pdf, $rua_av);
tag_numero($pdf, $numero);
tag_cep($pdf, $cep);
tag_bairro($pdf, $bairro);
tag_cidade($pdf, $cidade_uf);
tag_email($pdf, $email);
tag_telefone($pdf, $telefone);
tag_celular($pdf, $celular);
tag_cidade($pdf, $cidade_uf);
tag_cpf_cnpj($pdf, $cpf_cnpj);
tag_potencia_instalada_uc_kw($pdf, $potencia_instalada_uc_kw);
tag_tensao_atendimento($pdf, $tensao_atendimento);
tag_tipo_conexao($pdf, "monofásica"); 
tag_tipo_conexao($pdf, "bifásica"); 
tag_tipo_conexao($pdf, "trifásica"); 
tag_tipo_ramal($pdf, "aéreo");
tag_tipo_ramal($pdf, "subterrâneo");
tag_potencia_instalada_geracao_kw($pdf,$potencia_instalada_geracao_kw);
tag_tipo_fonte_geracao($pdf, "hidráulica");
tag_tipo_fonte_geracao($pdf, "solar");
tag_tipo_fonte_geracao($pdf, "eólica");
tag_tipo_fonte_geracao($pdf, "biomassa");
tag_tipo_fonte_geracao($pdf, "cogeração qualificada");
tag_tipo_fonte_geracao($pdf, "lunar");
$pdf->Output('I', 'generated.pdf');


function mask($val, $mask)
{
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

function tag_codigo_uc($pdf, $codigo_uc) 
{
    $pdf->SetXY(67+3, 75-7);
    $pdf->Write(0, $codigo_uc);
}

function tag_classe_uc($pdf, $classe_uc) 
{
    $pdf->SetXY(118, 75-7);
    $pdf->Write(0, $classe_uc);
}

function tag_titular_uc($pdf, $titular_uc) 
{
    $pdf->SetXY(66+3, 79-7);
    $str = iconv('UTF-8', 'windows-1252', $titular_uc);
    $pdf->Write(0, $str);
}

function tag_rua_av($pdf, $rua_av) 
{
    $pdf->SetXY(57+4, 84-8);
    $str = iconv('UTF-8', 'windows-1252', $rua_av);
    $pdf->Write(0, $str);
}

function tag_numero($pdf, $numero) 
{
    $pdf->SetXY(132-3, 84-8);
    $pdf->Write(0, $numero);
}

function tag_cep($pdf, $cep) 
{
    $look = array( "/",".", "-", "(", ")" ," ");
    $str = str_replace($look, "", $cep);
    $pdf->SetXY(153+1, 84-8);
    $str2 = mask($str,'#####-###');
    $pdf->Write(0, $str2);
}

function tag_bairro($pdf, $bairro) 
{
    $pdf->SetXY(54+4, 88-8);
    $str = iconv('UTF-8', 'windows-1252', $bairro);
    $pdf->Write(0, $str);
}

function tag_cidade($pdf, $cidade) 
{
    $pdf->SetXY(130-4, 88-8);
    $str = iconv('UTF-8', 'windows-1252', $cidade);
    $pdf->Write(0, $str);
}

function tag_email($pdf, $email) 
{
    $pdf->SetXY(54+5, 92-8);
    $pdf->Write(0, $email);
}

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

function tag_potencia_instalada_uc_kw($pdf, $potencia_instalada_uc_kw) 
{
    $pdf->SetXY(80+4, 110-10);
    $pdf->Write(0, $potencia_instalada_uc_kw);
}

function tag_tensao_atendimento($pdf, $tensao_atendimento) 
{
    $pdf->SetXY(160-3, 110-10);
    $pdf->Write(0, $tensao_atendimento);
}

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

function tag_potencia_instalada_geracao_kw($pdf,       $potencia_instalada_geracao_kw) 
{
    $pdf->SetXY(104, 123-7);
    $pdf->Write(0, $potencia_instalada_geracao_kw);
}

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



?>
