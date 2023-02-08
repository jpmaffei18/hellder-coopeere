<?php


ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Ginfes\V1_00\Request\CancelarNfseRequest;


$certificate = new Certificate(__dir__ . DS . '..' . DS . 'certificado.pfx', 'senha');

$config = new Config();
$config->setCertificate($certificate);
$config->setTmpDirectory(__dir__ . DS . '..'. DS . 'tmp');
$config->setCaInfoPath(__dir__ . DS . '..'. DS . 'cacert-2021-01-19.pem');
$config->setWsdl('https://homologacao.ginfes.com.br/ServiceGinfesImpl?wsdl');


// (OPCIONAL) Faz os arquivos XML de envio e retorno serem salvos em disco
//$config->setXmlDirectory(__dir__ . DS . 'tmp' . DS . 'xml');
// (OPCIONAL) Faz o trace da conexão ser gravado em arquivo de LOG
//$config->setLogDirectory(__dir__ . DS . 'tmp' . DS . 'logs');

$config->setTraceInBrowser(true);


$connection = new Connection($config);

$request = new CancelarNfseRequest();

$request->setInscricaoMunicipalPrestador('101010');
$request->setCnpjPrestador('18291369000166');
$request->setNumeroNfse('200300000000001');
$request->setCodigoMunicipio('3100401');
$request->setCodigoCancelamento('1');


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
    if(! empty($response->numeroNfseCancelada)){
        // A nota foi cancelada
        echo 'A nota fiscal de número '. $response->numeroNfseCancelada . ' foi cancelada com sucesso';
        echo 'Cancelada em'. $response->dataHoraCancelamento;
        // existem mais campos conforme especificado no manual de uso

    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}


