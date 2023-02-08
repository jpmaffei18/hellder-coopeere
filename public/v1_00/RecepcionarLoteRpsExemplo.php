<?php

ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Ginfes\V1_00\Request\RecepcionarLoteRpsRequest;
use EmissorNfse\Providers\Ginfes\V1_00\Request\Rps;

$certificate = new Certificate(__dir__ .  '/../COOPEERE.pfx', '27242982');

$config = new Config();
$config->setCertificate($certificate);
$config->setTmpDirectory(__dir__ . '/../tmp');
$config->setCaInfoPath(__dir__ . '/../cacert-2021-01-19.pem');
$config->setWsdl('https://homologacao.ginfes.com.br/ServiceGinfesImpl?wsdl');

// (OPCIONAL) Faz os arquivos XML de envio e retorno serem salvos em disco
//$config->setXmlDirectory(__dir__ . '/../tmp/xml');
// (OPCIONAL) Faz o trace da conexão ser gravado em arquivo de LOG
//$config->setLogDirectory(__dir__ . '/../tmp/logs');

$config->setTraceInBrowser(true);


$connection = new Connection($config);
//$config->setTraceInBrowser(true);

$request = new RecepcionarLoteRpsRequest();

// $request->isProduction = true; // Para produção, além de alterar a URL do WSDL você precisa ativar esta propriedade para que seja usada a msg SOAP correta

//$request->setInscricaoMunicipalPrestador('101010');
$request->setCnpjPrestador('40409711000139');
//$request->setNumeroLote(1);


$rps = new Rps();
$rps->setCnpjPrestador('40409711000139');
//$rps->setInscricaoMunicipalPrestador('101010');

$rps->setSerieRps('1');
$rps->setNumeroRps('2');
$rps->setTipoRps('1');

$rps->setStatusRps(1);
$rps->setDataEmissaoRps(date('Y-m-d H:i:s'));
$rps->setNaturezaOperacao(2);
$rps->setOptanteSimplesNacional(2);
$rps->setIncentivadorCultural(2);

$rps->setCpfCnpjTomador('08796011750');
$rps->setRazaoSocialTomador('Túlio Almeida Peixoto');
$rps->setCodigoMunicipioTomador('3305000'); //3305000 (SJB-RJ) Preencher        código do municipio do cliente (Ter banco de dados)
$rps->setEnderecoTomador('Rua Gregorio Prudencio de Azevedo');
$rps->setNumeroEnderecoTomador('105');
$rps->setBairroTomador('Barcelos');
$rps->setCepTomador('28220000');
$rps->setUfTomador('RJ');
$rps->setEmailTomador('tulio.ap@hotmail.com');

$rps->setValorServicos(3.50);
$rps->setAliquota(0.0200);
$rps->setIssRetido(2);
$rps->setValorIss(2.00);
$rps->setValorIssRetido(0.00);

$rps->setItemListaServico('0701');
$rps->setCodigoTributacaoMunicipio('0701');
$rps->setCodigoMunicipioPrestacao('3100401');

$rps->setDiscriminacao('Descrição da nota fiscal');

$request->addRps($rps);


$response = $connection->dispatch($request);

var_dump($response);
exit;

// Conforme os atributos da Response (Ver manual). Você pode capturar os resultados da seguinte forma
if(! empty($response->erros)){
    // Possui erros
    foreach ($response->erros as $erro){
        print_r($erro['codigo']);
        print_r($erro['mensagem']);
        print_r($erro['correcao']);
    }
}else{
    if(! empty($response->protocolo)){
        echo 'Nota enviada com sucesso. Número do protocolo: '. $response->protocolo;
    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}


