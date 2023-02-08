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


if (! function_exists('asaas_existe_customer')) {
    function asaas_existe_customer(cooperado $cooperado) {

        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/customers?cpfCnpj=$cooperado->cpf_cnpj");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "access_token: $financeiroconfig->api_key"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        //echo "490:";
        var_dump($response);
        $obj = json_decode($response);
        return ($obj['totalCount'] != 0);
        //return $response;
    }    
}

if (! function_exists('asaas_get_customer')) {
    function asaas_get_customer(cooperado $cooperado) {

        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/customers?cpfCnpj=$cooperado->cpf_cnpj");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "access_token: $financeiroconfig->api_key"
        ));

        $json_response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($json_response, true);
        //var_dump($response);
        return $response;
    }
}

if (! function_exists('asaas_criar_customer')) {
    function asaas_criar_customer(cooperado $cooperado)
    {
        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/customers");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"name\": \"$cooperado->nome\",
        \"email\": \"$cooperado->email\",
        \"phone\": \"$cooperado->telefone_fixo\",
        \"mobilePhone\": \"$cooperado->telefone_celular\",
        \"cpfCnpj\": \"$cooperado->cpf_cnpj\",
        \"postalCode\": \"$cooperado->cep\",
        \"address\": \"$cooperado->endereco\",
        \"addressNumber\": \"$cooperado->numero\",
        \"complement\": \"\",
        \"province\": \"$cooperado->estado\",
        \"externalReference\": \"$cooperado->id\",
        \"notificationDisabled\": false,
        \"additionalEmails\": \"\",
        \"municipalInscription\": \"$cooperado->inscricao_municipal\",
        \"stateInscription\": \"$cooperado->inscricao_estadual\",
        \"observations\": \"\"
        }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "access_token: $financeiroconfig->api_key"
        ));

        $json_response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($json_response, true);
        return $response;
    }
}

if (! function_exists('asaas_criar_boleto')) {
    function asaas_criar_boleto($customer_id, cobranca $cobranca)
    {
        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/payments");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"customer\": \"$customer_id\",
        \"billingType\": \"BOLETO\",
        \"dueDate\": \"$cobranca->dt_vencimento\",
        \"value\": $cobranca->valor_a_pagar,
        \"description\": \"$cobranca->cod_parcela\",
        \"externalReference\": \"$cobranca->cod_parcela\",
        \"discount\": {
            \"value\": 0,
            \"dueDateLimitDays\": 0
        },
        \"fine\": {
            \"value\": 0
        },
        \"interest\": {
            \"value\": 0
        },
        \"postalService\": false
        }");
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: $financeiroconfig->api_key"
        ));
        
        $json_response = curl_exec($ch);
        curl_close($ch);
        
        //var_dump($response);
        $response = json_decode($json_response, true);
        return $response;
    }
}


if (! function_exists('asaas_get_boleto_em_aberto')) {
    function asaas_get_boleto_em_aberto($customer_id, cobranca $cobranca) {
        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/payments?customer=$customer_id&billingType=BOLETO&status=PENDING&externalReference=$cobranca->cod_parcela");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "access_token: $financeiroconfig->api_key"
        ));

        $json_response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($json_response, true);
        //var_dump($response);

        return $response;
    }
}

if (! function_exists('asaas_remover_boleto')) {
    function asaas_remover_boleto(int $id) {
        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/payments/$id");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "access_token: $financeiroconfig->api_key"
        ));

        $json_response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($json_response, true);
        //var_dump($response);

        return $response;
    }
}

if (! function_exists('asaas_criar_cobranca_cartao_de_credito')) {
    function asaas_criar_cobranca_cartao_de_credito($customer_id, cobranca $cobranca,
        $holder_name, $number, $expiry_mounth, $expiry_year, $cvv,
        $name,$email,$cpf_cnpj,$postal_code,$address_number,$address_complement,
        $phone,$mobile_phone,$credit_card_token,$remote_ip)
    {
        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/payments");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_POST, TRUE);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"customer\": \"$customer_id\",
        \"billingType\": \"CREDIT_CARD\",
        \"dueDate\": \"$cobranca->dt_vencimento\",
        \"value\": $cobranca->valor_a_pagar,
        \"description\": \"$cobranca->cod_parcela\",
        \"externalReference\": \"$cobranca->cod_parcela\",
        \"creditCard\": {
            \"holderName\": \"$holder_name\",
            \"number\": \"$number\",
            \"expiryMonth\": \"$expiry_mounth\",
            \"expiryYear\": \"$expiry_year\",
            \"ccv\": \"$cvv\"
        },
        \"creditCardHolderInfo\": {
            \"name\": \"$name\",
            \"email\": \"$email\",
            \"cpfCnpj\": \"$cpf_cnpj\",
            \"postalCode\": \"$postal_code\",
            \"addressNumber\": \"$address_number\",
            \"addressComplement\": \"$address_complement\",
            \"phone\": \"$phone\",
            \"mobilePhone\": \"$mobile_phone\"
        },
        \"creditCardToken\": \"$credit_card_token\",
        \"remoteIp\": \"$remote_ip\"
        }");
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "access_token: $financeiroconfig->api_key"
        ));
        
        $json_response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($json_response, true);
        //var_dump($response);
        return $response;
    }
}


if (! function_exists('asaas_get_cobranca_cartao_de_credito_em_aberto')) {
    function asaas_get_cobranca_cartao_de_credito_em_aberto($customer_id, cobranca $cobranca) {
        $financeiroconfig = financeiroconfig::where('id','=',1)->first();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$financeiroconfig->base_url/payments?customer=$customer_id&billingType=CREDIT_CARD&status=PENDING&externalReference=$cobranca->cod_parcela");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "access_token: $financeiroconfig->api_key"
        ));

        $json_response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($json_response, true);
        //var_dump($response);
        
        return $response;
    }
}

?>