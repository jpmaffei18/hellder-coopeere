<?php


ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Ginfes\V1_00\Request\ConsultarLoteRpsRequest;


$certificate = new Certificate(__dir__ . DS . '..' . DS . 'COOPEERE.pfx', '27242982');

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

$request = new ConsultarLoteRpsRequest();

//$request->setInscricaoMunicipalPrestador('101010');
$request->setCnpjPrestador('40409711000139');
$request->setProtocolo('802208');


$response = $connection->dispatch($request);

var_dump($response);
//exit;

// Conforme os atributos da Response (Ver manual). Você pode capturar os resultados da seguinte forma
if(! empty($response->erros)){
    // Possui erros
    foreach ($response->erros as $erro){
        print_r($erro['codigo']);
        print_r($erro['mensagem']);
        print_r($erro['correcao']);
    }
}else{
    if(! empty($response->listaNfse)){
        foreach ($response->listaNfse as $nfse){
            echo 'Numero da nota: ' . $nfse->numeroNfse;
            echo 'Codigo de verificação: '. $nfse->codigoVerificacao;
            echo 'Valor da base de cálculo: '. $nfse->baseCalculo;

            if(! empty($nfse->dataHoraCancelamento)){
                echo 'Esta nota está cancelada';
            }

            if(! empty($nfse->numeroNfseSubstituidora)){
                echo 'Esta nota foi substituída pela nota número '. $nfse->numeroNfseSubstituidora;
            }

            // O que mais desejar fazer .....................
        }

    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}


