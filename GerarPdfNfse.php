<?php

ini_set("default_socket_timeout", 60);
define('DS', DIRECTORY_SEPARATOR);

include './vendor/autoload.php';


// require_once('vendor/setasign/fpdf/fpdf.php');
// require_once('vendor/setasign/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Ginfes\V1_00\Request\RecepcionarLoteRpsRequest; 
use EmissorNfse\Providers\Ginfes\V1_00\Request\Rps;





// PARA CERTIFICADO VÁLIDO
$options = [
    'soapOptions' => [
        'ssl' => [ 'cafile' =>
        __dir__ . DS . '..'. DS . 'cacert-2021-01-pem',
              "verify_peer" => true,
              "verify_host" => true,
              "verify_peer_name" => true,
              "ssl_method" => SOAP_SSL_METHOD_TLS,
              "soap_version" => SOAP_1_1,
        ] 
    ]
];

/*
$certificate = new Certificate(__dir__ . DS . '..' . DS . 'COOPEERE.pfx', '27242982');
$config = new Config($options); $config->setCertificate($certificate);

$config->setTmpDirectory(__dir__ . DS . '..'. DS . 'tmp');
$config->setCaInfoPath(__dir__ . DS . '..'. DS . 'cacert-2021-01-19.pem');
$config->setWsdl('https://homologacao.ginfes.com.br/ServiceGinfesImpl?wsdl');
// (OPCIONAL) Faz os arquivos XML de envio e retorno serem salvos em disco
$config->setXmlDirectory(__dir__ . DS . 'tmp' . DS . 'xml');
// (OPCIONAL) Faz o trace da conexão ser gravado em arquivo de LOG
$config->setLogDirectory(__dir__ .DS . 'tmp' . DS . 'logs');
//$config->setTraceInBrowser(false); 

$config->setTraceInBrowser(true);
$connection = new Connection($config);
 
$request = new RecepcionarLoteRpsRequest(); 
// $request->setInscricaoMunicipalPrestador('101010');
$request->setCnpjPrestador('40409711000139');
//$request->setNumeroLote(1); 
$rps = new Rps();
$rps->setCnpjPrestador('40409711000139');
// $rps->setInscricaoMunicipalPrestador('101010');

 */
/*
* Tenha em mente que o sistema Ginfes utiliza a combinação da serie e do numero do RPS para identificar se o mesmo já foi emitido.
* Neste sentido, por exemplo, se a nota fiscal referente ao RPS 1 da Série 1 for emitido COM SUCESSO, então estes números
* não poderão mais ser usados para emitir uma nova nota fiscal. O ideal é que para as demais notas você vá incrementando
* o número do RPS
 */
/*
$rps->setSerieRps('1'); // ?
$rps->setNumeroRps('5'); // incremetar para cada nfse emitida
$rps->setTipoRps('1');
$rps->setRegimeEspecialTributacao(4); // 4 - Cooperativa

$rps->setStatusRps(1);
$rps->setDataEmissaoRps(date('Y-m-d H:i:s'));
$rps->setNaturezaOperacao(2); // 1 - dentro do municipio / 2 - fora do municipio
$rps->setOptanteSimplesNacional(2); //? 1 - optante, 2 - nao optante
$rps->setIncentivadorCultural(2); //? 1- participa, 2 - nao participa 

$rps->setCpfCnpjTomador('08796011750');
$rps->setRazaoSocialTomador('Túlio Almeida Peixoto');
$rps->setCodigoMunicipioTomador('3305000'); //3305000 (SJB-RJ) Preencher código do municipio do cliente (Ter banco de dados)
$rps->setEnderecoTomador('Rua Gregorio Prudencio de Azevedo');
$rps->setNumeroEnderecoTomador('105');
$rps->setBairroTomador('Barcelos');
$rps->setCepTomador('28220000');
$rps->setUfTomador('RJ');
$rps->setEmailTomador('tulio.ap@hotmail.com');

$rps->setValorServicos(1.50);
$rps->setAliquota(0.0200); //
$rps->setIssRetido(2); //
$rps->setValorIss(2.00); //
$rps->setValorIssRetido(0.00); //

$rps->setItemListaServico('0701'); //?
$rps->setCodigoTributacaoMunicipio('0701'); //?
$rps->setCodigoMunicipioPrestacao('3301009'); // Campos dos Goyacazes - fixo

$rps->setDiscriminacao('Descrição da nota fiscal'); 
$request->addRps($rps);

$response = $connection->dispatch($request);

var_dump($response);
file_put_contents('notafiscal.xml', $response->xmlEnvio);

if(!empty($response->erros)){
     // Possui erros
     foreach ($response->erros as $erro){
         print_r($erro['codigo']);
         print_r($erro['mensagem']);
         print_r($erro['correcao']);
     }
 }else{
     if(!empty($response->protocolo)){
         echo 'Nota enviada com sucesso. Número do protocolo: '. $response->protocolo;
     }else{
         echo 'Erro indefinido. Verifique o trace para maiores informações';
     }
 }

 */

// initiate FPDI
  $pdf = new Fpdi();
  // add a page
  $pdf->AddPage();
  // set the source file
  $pdf->setSourceFile('layout-nfse.pdf');
  // import page 1
  $tplIdx = $pdf->importPage(1);
  // use the imported page and place it at position 10,10 with a width of 100 mm
  //$pdf->useTemplate($tplIdx, 10, 10, 100);
  $pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
  // now write some text above the imported page
  $pdf->SetFont('Times');
  $pdf->SetFontSize(9);
  $pdf->SetTextColor(0,0,0);



$nota_fiscal = "notafiscal.xml";
if (file_exists($nota_fiscal)) {
    $xml = simplexml_load_file($nota_fiscal);
    //print_r($xml->{'n1:EnviarLoteRpsEnvio'});
    //print_r($xml);
    //$data_e_hora_da_emissao = $xml->LoteRps->ListaRps->Rps->DataEmissao;
    //print_r($xml->LoteRps);
    foreach ($xml->LoteRps->ListaRps as $rps)
    {
        //print_r($rps->Rps->InfRps);
        $nfse = $rps->Rps->InfRps;

        $numero = $nfse->IdentificacaoRps->Numero;
        $data_emissao = $nfse->DataEmissao;
        //$competencia = 2021;
        //$codigo_de_verificacao = "";
        $numero_do_rps = "";
        $no_da_nfse_substituida = "";
        $local_da_prestacao=  ""; // municipio e UF do cooperado? 
        $prestador_razao_social = "COOPEERE -COOPERATIVA DOS PRODUTORES DE ENERGIA EOLICA REGIONAL";
        $prestador_nome_fantasia = "COOPEERE";
        $prestador_cpf_cnpj = $nfse->Prestador->Cnpj;
        $prestador_incricao_municipal = "";
        $prestador_municipio = "Campos dos Goytacazes/RJ";
        $prestador_endereco_cep = "R PROFESSORA AGRICOLINA DE FREITAS N 23 Bairro Centro - CEP 28013-015, ";
        $prestador_complemento = "";
        $prestador_telefone = "22 99842-4346";
        $prestador_email = "helrov@hotmail.com";

        $tomador_cpf_cnpj = $nfse->Tomador->IdentificacaoTomador->CpfCnpj->Cpf;
        $tomador_razao_social = $nfse->Tomador->RazaoSocial;
        $tomador_endereco_logradouro =  $nfse->Tomador->Endereco->Endereco;
        $tomador_endereco_numero =  $nfse->Tomador->Endereco->Numero;
        $tomador_endereco_bairro =  $nfse->Tomador->Endereco->Bairro;
        $tomador_endereco_codigo_municipio =  $nfse->Tomador->Endereco->CodigoMunicipio;
        $tomador_endereco_uf =  $nfse->Tomador->Endereco->Uf;
        $tomador_endereco_cep =  $nfse->Tomador->Endereco->Cep;
        $tomador_email = $nfse->Tomador->Contato->Email;
        //$tomador_telefone = $nfse->Tomador->Contato->Telefone;

        $servico_item_lista_servico = $nfse->Servico->ItemListaServico;
        $servico_codigo_tributacao_municipio = $nfse->Servico->CodigoTributacaoMunicipio;
        $servico_discriminacao = $nfse->Servico->Discriminacao;
        $servico_codigo_municipio = $nfse->Servico->CodigoMunicipio;

        $valor_servicos = $nfse->Servico->Valores->ValorServicos;
        $valor_aliquota = $nfse->Servico->Valores->Aliquota;
        $iss_retido = $nfse->Servico->Valores->IssRetido; // 1 - Sim, 2 - Nao
        $valor_iss = $nfse->Servico->Valores->ValorIss;
	$valor_iss_retido = $nfse->Servico->Valores->ValorIssRetido;

	$natureza_operacao = $nfse->NaturezaOperacao;
	$regime_especial_tributacao = $nfse->RegimeEspecialTributacao;
	$optante_simples_nacional = $nfse->OptanteSimplesNacional;
	$incentivador_cultural = $nfse->IncentivadorCultural;

        print("Número: $numero\n");
        print("data_emissao: $data_emissao\n");
        print("prestador_razao_social: $prestador_razao_social\n");
        print("prestador_nome_fantasia: $prestador_nome_fantasia\n");
        print("prestador_cpf_cnpj: $prestador_cpf_cnpj\n");
        print("prestador_municipio: $prestador_municipio\n");
        print("prestador_endereco_cep: $prestador_endereco_cep\n");
        print("prestador_telefone: $prestador_telefone\n");
        print("prestador_email: $prestador_email\n");

        print("tomador_cpf_cnpj: $tomador_cpf_cnpj\n");
        print("tomador_razao_social: $tomador_razao_social\n");
        print("tomador_endereco_logradouro: $tomador_endereco_logradouro\n");
        print("tomador_endereco_numero: $tomador_endereco_numero\n");
        print("tomador_endereco_bairro: $tomador_endereco_bairro\n");
        print("tomador_endereco_codigo_municipio: $tomador_endereco_codigo_municipio\n");
        print("tomador_endereco_uf: $tomador_endereco_uf\n");
        print("tomador_endereco_cep: $tomador_endereco_cep\n");
        print("tomador_email: $tomador_email\n");

        print("servico_codigo_municipio: $servico_codigo_municipio\n");
        print("servico_discriminacao: $servico_discriminacao\n");
        print("servico_codigo_tributacao_municipio: $servico_codigo_tributacao_municipio\n");
        print("servico_item_lista_servico: $servico_item_lista_servico\n");
        
        
        printf("NaturezaOperacao: $natureza_operacao \n"); 
        printf("RegimeEspecialTributacao: $regime_especial_tributacao \n"); 
        printf("OptanteSimplesNacional: $optante_simples_nacional \n"); 
        printf("IncentivadorCultural: $incentivador_cultural \n"); 

        print("valor_servicos: $valor_servicos\n");
        print("valor_aliquota: $valor_aliquota\n");
        print("iss_retido: $iss_retido\n");
        print("valor_iss: $valor_iss\n");
        print("valor_iss_retido: $valor_iss_retido\n");
        print("valor_liquido: $valor_servicos\n");

        tag_numero_nfse($pdf, $numero);

        $pdf->SetFontSize(8);
        tag_data_emissao($pdf, $data_emissao);

        tag_prestador_razao_social($pdf, $prestador_razao_social);
        tag_prestador_nome_fantasia($pdf, $prestador_nome_fantasia);
        tag_prestador_cpf_cnpj($pdf, $prestador_cpf_cnpj);
        tag_prestador_municipio($pdf, $prestador_municipio);
        tag_prestador_endereco_cep($pdf, $prestador_endereco_cep);
        tag_prestador_telefone($pdf, $prestador_telefone);
        tag_prestador_email($pdf, $prestador_email);
        
        tag_tomador_razao_social($pdf, $tomador_razao_social);
        tag_tomador_cpf_cnpj($pdf, $tomador_cpf_cnpj);
        tag_tomador_municipio($pdf, $tomador_endereco_codigo_municipio);

        $tomador_endereco_cep = $tomador_endereco_logradouro." - ".$tomador_endereco_numero. 
        "- ".$tomador_endereco_bairro." - CEP: ".$tomador_endereco_cep;
        tag_tomador_endereco_cep($pdf, $tomador_endereco_cep);
        tag_tomador_complemento($pdf, "-");
        tag_tomador_telefone($pdf, "-");
        tag_tomador_email($pdf, $tomador_email);

        tag_servico_discriminacao($pdf, $servico_discriminacao);
        tag_servico_codigo_tributacao_municipio($pdf, $servico_codigo_tributacao_municipio." / ".$servico_item_lista_servico);
        //tag_servico_servico_item_lista_servico($pdf, $servico_item_lista_servico);

	tag_natureza_operacao($pdf, $natureza_operacao);
	tag_regime_especial_tributacao($pdf, $regime_especial_tributacao);
	tag_optante_simples_nacional($pdf, $optante_simples_nacional);
	tag_incentivador_cultural($pdf, $incentivador_cultural);

	tag_valor_servicos($pdf, $valor_servicos);
        tag_valor_aliquota($pdf, $valor_aliquota);
        //tag_iss_retido($pdf, 1);
        tag_iss_retido($pdf, $iss_retido);
        tag_valor_iss_retido($pdf, $valor_iss_retido);
        tag_valor_iss($pdf, $valor_iss);
	tag_valor_liquido($pdf, $valor_servicos);
        $pdf->Output('F','generated_nfse.pdf');
    }
   
} else {
    exit("Falha ao abrir: ". $nota_fiscal. "\n");
}





function tag_numero_nfse($pdf, $numero_nfse)
{
    $pdf->SetXY(117, 23);
    $pdf->Cell(0,0,$numero_nfse,0,0,'C');
    //$pdf->Write(0, $numero_nfse);
}

function tag_data_emissao($pdf, $data_emissao)
{
    $data = explode('T', $data_emissao."");
    $pdf->SetXY(35, 31);
    $pdf->Write(0, $data[0]);
    $pdf->SetXY(35, 33);
    $pdf->Write(0, $data[1]);

}

function tag_prestador_razao_social($pdf, $prestador_razao_social)
{
    $pdf->SetXY(70, 48);
    $pdf->Cell(0,0,$prestador_razao_social,0,0,'L');
    //$pdf->Write(0, $numero_nfse);
}

function tag_prestador_nome_fantasia($pdf, $prestador_nome_fantasia)
{
    $pdf->SetXY(70, 53);
    $pdf->Cell(0,0,$prestador_nome_fantasia,0,0,'L');
}

function tag_prestador_cpf_cnpj($pdf, $prestador_cpf_cnpj)
{
    $look = array( "/",".", "-", "(", ")" ," ");
     $str = str_replace($look, "", $prestador_cpf_cnpj);
     if (strlen($str) == 11){
        $str = mask($str,'###.###.###-##');
     } else {
        $str = mask($str,'##.###.###/####-##');
     }
    $pdf->SetXY(50, 58);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_prestador_municipio($pdf, $prestador_municipio)
{
    $pdf->SetXY(150, 58);
    $pdf->Cell(0,0,$prestador_municipio,0,0,'L');
}

function tag_prestador_endereco_cep($pdf, $endereco_cep)
{
    $pdf->SetXY(60,64);
    $pdf->Cell(0,0,$endereco_cep,0,0,'L');
}

function tag_prestador_telefone($pdf, $prestador_telefone)
{
    $pdf->SetXY(113,69);
    $pdf->Cell(0,0,$prestador_telefone,0,0,'L');
}

function tag_prestador_email($pdf, $prestador_email)
{
    $pdf->SetXY(150,69);
    $pdf->Cell(0,0,$prestador_email,0,0,'L');
}

function tag_tomador_cpf_cnpj($pdf, $tomador_cpf_cnpj)
{
    $look = array( "/",".", "-", "(", ")" ," ");
    $str = str_replace($look, "", $tomador_cpf_cnpj);
    if (strlen($str) == 11){
        $str = mask($str,'###.###.###-##');
    } else {
        $str = mask($str,'##.###.###/####-##');
    }
    $pdf->SetXY(38, 85);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_tomador_razao_social($pdf, $tomador_razao_social)
{
    $pdf->SetXY(50, 80);
    $str = iconv('UTF-8', 'windows-1252', $tomador_razao_social);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_tomador_municipio($pdf, $tomador_endereco_codigo_municipio)
{
    $pdf->SetXY(140, 85);
    $str = iconv('UTF-8', 'windows-1252', $tomador_endereco_codigo_municipio);
    $pdf->Cell(0,0,$str,0,0,'L');
}


function tag_tomador_endereco_cep($pdf, $tomador_endereco_cep)
{
    $pdf->SetXY(38, 90);
    $str = iconv('UTF-8', 'windows-1252', $tomador_endereco_cep);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_tomador_complemento($pdf, $tomador_complemento)
{
    $pdf->SetXY(36, 96);
    $str = iconv('UTF-8', 'windows-1252', $tomador_complemento);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_tomador_telefone($pdf, $tomador_telefone)
{
    $pdf->SetXY(70, 96);
    $str = iconv('UTF-8', 'windows-1252', $tomador_telefone);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_tomador_email($pdf, $tomador_email)
{
    $pdf->SetXY(140, 96);
    $str = iconv('UTF-8', 'windows-1252', $tomador_email);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_servico_discriminacao($pdf, $servico_discriminacao)
{
    $pdf->SetXY(10, 106);
    $str = iconv('UTF-8', 'windows-1252', $servico_discriminacao);
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_servico_codigo_tributacao_municipio($pdf, $servico_codigo_tributacao_municipio)
{
    $pdf->SetXY(2, 144);
    $str = iconv('UTF-8', 'windows-1252', $servico_codigo_tributacao_municipio);
    $pdf->Cell(0,0,$str,0,0,'C');
}

function tag_servico_servico_item_lista_servico($pdf, $servico_item_lista_servico)
{
    
}

function tag_natureza_operacao($pdf, $natureza_operacao)
{
    $array_natureza_operacao = array(
    				1 => 'Tributação no Município',
				2 => 'Tributação fora do Município',
			        );
    $pdf->SetXY(22, 182);
    $str="";
    if ($natureza_operacao == 1)
    	$str = iconv('UTF-8', 'windows-1252', $array_natureza_operacao[1]);
    if ($natureza_operacao == 2)
    	$str = iconv('UTF-8', 'windows-1252', $array_natureza_operacao[2]);
    $pdf->Cell(0,0,$natureza_operacao."-".$str,0,0,'C');
}

function tag_regime_especial_tributacao($pdf, $regime_especial_tributacao)
{

    $array_regime_especial_tributacao = array(
    				1 => 'Microempresa municipal',
				2 => 'Estimativa',
				3 => 'Sociedade de profissionais',
				4 => 'Cooperativa',
			        );
    $pdf->SetXY(22, 192);
    $str="";
    if ($regime_especial_tributacao == 1)
    	$str = iconv('UTF-8', 'windows-1252', $array_regime_especial_tributacao[1]);
    if ($regime_especial_tributacao == 2)
    	$str = iconv('UTF-8', 'windows-1252', $array_regime_especial_tributacao[2]);
    if ($regime_especial_tributacao == 3)
    	$str = iconv('UTF-8', 'windows-1252', $array_regime_especial_tributacao[3]);
    if ($regime_especial_tributacao == 4)
    	$str = iconv('UTF-8', 'windows-1252', $array_regime_especial_tributacao[4]);
    $pdf->Cell(0,0,$regime_especial_tributacao."-".$str,0,0,'C');
}

function tag_optante_simples_nacional($pdf, $optante_simples_nacional)
{
    $array_optante_simples_nacional = array(
    				1 => 'Optante',
				2 => 'Não Optante',
			        );
    $pdf->SetXY(22, 202);
    $str="";
    if ($optante_simples_nacional == 1)
    	$str = iconv('UTF-8', 'windows-1252', $array_optante_simples_nacional[1]);
    if ($optante_simples_nacional == 2)
    	$str = iconv('UTF-8', 'windows-1252', $array_optante_simples_nacional[2]);
    $pdf->Cell(0,0,$optante_simples_nacional."-".$str,0,0,'C');
}

function tag_incentivador_cultural($pdf, $incentivador_cultural)
{
    $array_incentivador_cultural = array(
    				1 => 'Sim',
				2 => 'Não',
			        );
    $pdf->SetXY(22, 213);
    $str="";
    if ($incentivador_cultural == 1)
    	$str = iconv('UTF-8', 'windows-1252', $array_incentivador_cultural[1]);
    if ($incentivador_cultural == 2)
    	$str = iconv('UTF-8', 'windows-1252', $array_incentivador_cultural[2]);
    $pdf->Cell(0,0,$incentivador_cultural."-".$str,0,0,'C');
}


function tag_valor_servicos($pdf, $valor_servicos)
{
    $pdf->SetXY(65, 176);
    $valor = sprintf("%.2f",$valor_servicos);
    $str = str_replace(".", ",", $valor."");
    $pdf->Cell(0,0,$str,0,0,'L');
    $pdf->SetXY(160, 176);
    $pdf->Cell(0,0,$str,0,0,'C');
}

function tag_valor_liquido($pdf, $valor_liquido)
{
    $pdf->SetXY(65, 208);
    $valor = sprintf("%.2f",$valor_liquido);
    $str = str_replace(".", ",", $valor."");
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_valor_iss_retido($pdf, $valor_iss_retido)
{
    $pdf->SetXY(65, 203);
    $valor = sprintf("%.2f",$valor_iss_retido);
    $str = str_replace(".", ",", $valor."");
    $pdf->Cell(0,0,$str,0,0,'L');
}

function tag_valor_iss($pdf, $valor_iss)
{
    $pdf->SetXY(160, 208);
    $valor = sprintf("%.2f",$valor_iss);
    $str = str_replace(".", ",", $valor."");
    $pdf->Cell(0,0,$str,0,0,'C');
}

function tag_valor_aliquota($pdf, $valor_aliquota)
{
    $valor_aliquota = $valor_aliquota*100;
    $pdf->SetXY(160, 198);
    $valor = sprintf("%.2f",$valor_aliquota);
    $str = str_replace(".", ",", $valor."");
    $pdf->Cell(0,0,$str,0,0,'C');
}

function tag_iss_retido($pdf, $iss_retido)
{
   if ($iss_retido == 1)
   {
      $pdf->SetXY(176, 202);
   }
   if ($iss_retido == 2)
   {
      $pdf->SetXY(183, 202);
   }
   $pdf->Cell(0,0,'x',0,0,'L');
}


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
