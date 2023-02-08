<?php

ini_set("default_socket_timeout", 60);
define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';
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
/*
* Tenha em mente que o sistema Ginfes utiliza a combinação da serie e do numero do RPS para identificar se o mesmo já foi emitido.
* Neste sentido, por exemplo, se a nota fiscal referente ao RPS 1 da Série 1 for emitido COM SUCESSO, então estes números
* não poderão mais ser usados para emitir uma nova nota fiscal. O ideal é que para as demais notas você vá incrementando
* o número do RPS
*/
$rps->setSerieRps('1'); // ?
$rps->setNumeroRps('1'); // incremetar para cada nfse emitida
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

$rps->setValorServicos(3.50);
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
