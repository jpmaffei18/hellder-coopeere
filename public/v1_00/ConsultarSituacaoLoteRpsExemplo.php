<?php


ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Ginfes\V1_00\Request\ConsultarSituacaoLoteRpsRequest;



$certificate = new Certificate(__dir__ . DS . '..' . DS . 'certificado.pfx', 'senha');

$config = new Config();
$config->setCertificate($certificate);
$config->setTmpDirectory(__dir__ . DS . '..'. DS . 'tmp');
$config->setCaInfoPath(__dir__ . DS . '..'. DS . 'cacert-2021-01-19.pem');
$config->setWsdl('https://homologacao.ginfes.com.br/ServiceGinfesImpl?wsdl');

// (OPCIONAL) Faz os arquivos XML de envio e retorno serem salvos em disco
//$config->setXmlDirectory(__dir__ . '/../tmp/xml');
// (OPCIONAL) Faz o trace da conexão ser gravado em arquivo de LOG
//$config->setLogDirectory(__dir__ . '/../tmp/logs');

//(OPCIONAL, default false.... SE true, faz com que o trace da conexão HTTP seja capturado e apresentado na resposta do $connection->dispatch
$config->setTraceInBrowser(true);


$connection = new Connection($config);

$request = new ConsultarSituacaoLoteRpsRequest();

$request->setInscricaoMunicipalPrestador('101010');
$request->setCnpjPrestador('18291369000166');
$request->setProtocolo('802208');


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
    if(! empty($response->situacao)){
        // Se $response->situacao for igual a 1 é porque o número de protocolo não existe
        // caso seja 2, ele foi recebido pela a Prefeitura, porém ainda não foi processado
        // 3 - Indica que já foi processado porém gerou erros devido ha algum preenchimento incorreto de informações da nota
        // 4 - Processado com sucesso. Indica que a nota foi emitida com sucesso
        // ........

    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}