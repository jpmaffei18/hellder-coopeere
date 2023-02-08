<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

use Piggly\Pix\DynamicPayload;
use Piggly\Pix\Parser;
use Piggly\Pix\Exceptions\EmvIdIsRequiredException;
use Piggly\Pix\Exceptions\InvalidEmvFieldException;
use Piggly\Pix\Exceptions\InvalidPixKeyException;
use Piggly\Pix\Exceptions\InvalidPixKeyTypeException;
use Piggly\Pix\StaticPayload;

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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

require_once env('ROOT').'/app/helpers.php';
require_once env('ROOT').'/app/aarin_helpers.php';
require_once env('ROOT').'/app/asaas_helpers.php';
require_once env('ROOT').'/app/form_prodist_helpers.php';

class ProdistsController extends Controller
{
    public function show($idcooperado) {
        @session_start();
        $look = array( "/",".", "-", "(", ")" ," ");
        $params = request()->all();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        


        // initiate FPDI
        $pdf = new Fpdi();
        // add a page
        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile('/var/www/coopeere/formulario-prodist-microgeracao-sup10kw.pdf');
        // import page 1
        $tplIdx = $pdf->importPage(1);
        // use the imported page and place it at position 10,10 with a width of 100 mm
        //$pdf->useTemplate($tplIdx, 10, 10, 100);
        $pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
        // now write some text above the imported page
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->SetTextColor(0,0,0);

        $codigo_uc = $prodist->codigo_uc;
        $classe_uc = $prodist->classe_uc;
        $titular_uc = $cooperado->nome;
        $rua_av = $cooperado->endereco;
        $numero = $cooperado->numero;
        $cep = $cooperado->cep;
        $bairro = $cooperado->bairro;
        $cidade_uf = $cooperado->cidade."-".$cooperado->estado;
        $email = $cooperado->usuario->email;
        $telefone_fixo = $cooperado->usuario->telefone_fixo;
        $telefone_celular = $cooperado->usuario->telefone_celular;
        $cpf_cnpj = $cooperado->cpf_cnpj;

        $potencia_instalada_uc_kw= $prodist->potencia_inst_uc;
        $tipo_conexao = $prodist->tipo_conexao;
        $tipo_ramal = $prodist->tipo_ramal;
        $tensao_atendimento = $prodist->tensao_atendimento;
        $potencia_instalada_geracao_kw = $prodist->potencia_inst_gerada;
        $tipo_fonte_geracao = $prodist->tipo_fonte_geracao;

        tag_codigo_uc($pdf, $codigo_uc);
        tag_classe_uc($pdf, $classe_uc);
        tag_titular_uc($pdf, $titular_uc);
        tag_rua_av($pdf, $rua_av);
        tag_numero($pdf, $numero);
        tag_cep($pdf, $cep);
        tag_bairro($pdf, $bairro);
        tag_cidade($pdf, $cidade_uf);
        tag_email($pdf, $email);
        tag_telefone($pdf, $telefone_fixo);
        tag_celular($pdf, $telefone_celular);
        tag_cidade($pdf, $cidade_uf);
        tag_cpf_cnpj($pdf, $cpf_cnpj);
        tag_potencia_instalada_uc_kw($pdf, $potencia_instalada_uc_kw);
        tag_tensao_atendimento($pdf, $tensao_atendimento);
        tag_tipo_conexao($pdf, $tipo_conexao); 

        tag_tipo_ramal($pdf, $tipo_ramal);

        tag_potencia_instalada_geracao_kw($pdf,$potencia_instalada_geracao_kw);
        tag_tipo_fonte_geracao($pdf, $tipo_fonte_geracao);

        $pdf->Output('I', 'formulario_prodist.pdf');

    }

    public function reedit_prodist_confirm(Request $request) {

        $token_reedit_prodist = $request->token_reedit_prodist;
        $usuario = usuario::where('token_reedit_prodist','=',$token_reedit_prodist)->first();
        
        if(@$usuario->id != null) {
            $usuario->token_reedit_prodist = null;
            $usuario->save();
            echo "<script language='javascript'> window.alert('Formulário pronto para ser reeditado, entre novamente no sistema') </script>";
            return view('home');
        } else {
            return view('home');
        }

    }

    public function reedit_prodist_edit(Request $request)
    {
        @session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        $token = getToken(8);
        $usuario->token_reedit_prodist = $token;
        $this->enviar_email($usuario->email,$cooperado->nome, $token);
        $prodist->statusreg = 'A';
        $usuario->save();
        $prodist->save();
        echo "<script language='javascript'> window.alert('Foi enviado um código para seu e-mail, clique no link , autentique-se, e digite o código para desbloquear formulário.') </script>";
        return view('home');
    }

    private function enviar_email($email_para, $nome,$token) {
        $mail = new PHPMailer(true);
        $emailconfig = emailconfig::where('id','=',1)->first();

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->Host       = $emailconfig->servidor;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $emailconfig->usuario;                     //SMTP username
            $mail->Password   = $emailconfig->senha;
            if ($emailconfig->tls) {                             //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer:: ENCRYPTION_SMTPS` encouraged
            }
            $mail->Port       = $emailconfig->porta;                                    //TCP port to connect     to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($emailconfig->email_remetente, 'Coopeere');
            $mail->addAddress($email_para, $nome);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Confirmação de Reedição de Formulário';
            $webhost = request()->getHttpHost();
            $link = "http://$webhost";
            $msg_http = "Por favor, clique neste link <a href=\"$link\">$link</a>, logue e digite o código <b>$token</b> e faça, em seguida, uma nova autenticação e siga para reeditar o formulário.";
        
            $msg_txt = "Por favor, clique neste link ($link), logue e digite o código ($token) e faça, em seguida, uma nova autenticação e siga para reeditar o formulário.";
            $mail->Body    = $msg_http;
            $mail->AltBody = $msg_txt;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    public function webhook_pagamento_pix($cod_parcela)
    {
        $cobranca = cobranca::where('cod_parcela','=',$cod_parcela)->where('status', '=', 'aberto')->first();
        $cobranca->status = "pago";
        // setar dt de pagamento
        $cobranca->save();
        
    }

    public function pagamento(){
        @session_start();
        $look = array( "/",".", "-", "(", ")" ," ");
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);

        $cobrancas = cobranca::where('cpf_cnpj','=',$usuario->cooperado->cpf_cnpj)->where('status', '=', 'aberto')->get();
       
        //$pix_code;
        $pix_code = null;
        $qr_code = null;
        $boleto_pdf = null;
        $fatura_url = null;
        $errors_asaas = null;
        $errors_aarin = null;
        $cobrancas_boletos = null;
        $cobrancas_pix = null;
        $name = $cooperado->nome;
        $postal_code = $cooperado->cep;
        $phone = $usuario->telefone_fixo;
        $mobile_phone = $usuario->telefone_celular;
        $email = $usuario->email;
        

        if (!$cobrancas->isEmpty()) {

        if ($usuario->cooperado->meio_pagamento == "pix")
        {

            $cobrancas_pix = $cobrancas->toArray();
            $i = 0;
            foreach($cobrancas as $cobranca) {
                $AARIN_EMPRESA_ID = env('AARIN_EMPRESA_ID');
                $AARIN_SENHA = env('AARIN_SENHA');
                $AARIN_URL = env('AARIN_URL');
                $customer_id = "";
                // gerar token de autenticação
                $obj_aarin_token = aarin_oauth_token();

                if (!empty($obj_aarin_token['description']))
                {
                    $charge = true;
                    $errors_aarin = $obj_aarin_token;
                    return view('prodist.payment', 
                            compact('cooperado','charge','cobrancas_pix', 'errors_aarin')
                        );
                }
                //echo('--------------------------------------');
                //print_r( $obj_aarin_token);
                // TODO verificar cobranca aberta dentro do AARIN

                // Se nao tem cobranca no AARIN, gerar uma

                //$obj_cobv = aarin_cobv($usuario, $cobrancas[0], $obj_aarin_token);

                $obj_cobv = aarin_get_cobv($usuario, $cobranca, $obj_aarin_token,"ATIVA");
                if ($obj_cobv == null)
                {
                    $obj_cobv = aarin_cobv($usuario, $cobranca, $obj_aarin_token);
                } else if (!empty($obj_cobv['description'])) {
                    $charge = true;
                    $errors_aarin = $obj_cobv;
                    return view('prodist.payment', 
                            compact('cooperado','charge','cobrancas_pix', 'errors_aarin')
                        );
                }
                if (!empty($obj_cobv['description']))
                {
                    $charge = true;
                    $errors_aarin = $obj_cobv;
                    return view('prodist.payment', 
                            compact('cooperado','charge','cobrancas_pix', 'errors_aarin')
                        );
                }
                //$pix_code = $obj_cobv['links']['emv'];
                //$qr_code = $obj_cobv['links']['linkQrCode'];

                $charge = true;

                $cobrancas_pix[$i]['pix_code'] = $obj_cobv['links']['emv'];
                $cobrancas_pix[$i]['qr_code'] = $obj_cobv['links']['linkQrCode'];
                $i++;
                // cadastrar webhook via api //TODO
                //aarin_webhook($usuario, $cobrancas[0], $obj_aarin_token);
            }
        }

        if ($usuario->cooperado->meio_pagamento == "boleto bancário") {
            $customer_id = "";
                // verificar se tem usuario (customer)
                $response = asaas_get_customer($cooperado);
                //echo __LINE__.":";var_dump($response);
                $obj_get_customer = $response;
                if ($obj_get_customer['totalCount'] == 0) {
                    // criar customer se nao existir
                    $response = asaas_criar_customer($cooperado);
                    
                    $obj_create_customer = $response;
                    $customer_id = $obj_create_customer['id'];
                } else {
                    $response = asaas_get_customer($cooperado);
                    $obj_get_customer = $response;
                    $customer_id = $obj_get_customer['data'][0]['id'];
                }
                
                // gerar cobrança

                $response = asaas_get_boleto_em_aberto($customer_id, $cobrancas[0]);
                $obj_get_boleto_em_aberto = $response;
                
                if ($obj_get_boleto_em_aberto['totalCount'] == 0)
                {
                    $response = asaas_criar_boleto($customer_id, $cobrancas[0]);
                    if (!empty($response['errors']))
                    {
                        $charge = true;
                        $errors_asaas = $response['errors'];
                        return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas', 'errors_asaas')
                            );
                    }
                    $obj_get_boleto_em_aberto = $response;

                    //$boleto_pdf = $obj_get_boleto_em_aberto->{'data'}[0]['bankSlipUrl'];
                    $boletos_pdf = $obj_get_boleto_em_aberto['data'];
                    //$fatura_url = $obj_get_boleto_em_aberto->{'data'}[0]['invoiceUrl'];
                } else {

                    $boletos_pdf = $obj_get_boleto_em_aberto['data'];
                    //$fatura_url = $obj_get_boleto_em_aberto['data'][0]['invoiceUrl'];

                }
                $charge = true;

                $cobrancas_boletos = $cobrancas->toArray();
                for ($i = 0; $i < count($cobrancas_boletos); $i++)
                {
                    $cobrancas_boletos[$i]['bankSlipUrl'] = $boletos_pdf[$i]['bankSlipUrl'];

                }
                
                //print_r($cobrancas_boletos);
                return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_boletos','boletos_pdf', 'errors_asaas')
                            );
        }
        if ($usuario->cooperado->meio_pagamento == "cartão de crédito") {
  
            /*
            $holder_name = $request->holder_name;
            $number = $request->number;
            $expiry_mounth = $request->expiry_mounth;
            $expiry_year = $request->expiry_year;
            $cvv = $request->cvv;
            $name = $request->name;
            $email = $request->email;
            $cpf_cnpj = $request->cpf_cnpj;
            $postal_code = $request->postal_code;
            $address_number = $request->address_number;
            $address_complement = $request->address_complement;
            $phone = $request->phone;
            $mobile_phone = $request->mobile_phone;
            $remote_ip = getIp();
            $credit_card_token = uniqid("");
            $customer_id = "";
            // verificar se tem usuario (customer)
            $response = get_customer($cooperado);
            //echo __LINE__.":";var_dump($response);
            $obj_get_customer = json_decode($response);
            if ($obj_get_customer->{'totalCount'} == 0) {
                // criar customer se nao existir
                $response = criar_customer($cooperado);
                
                $obj_create_customer = json_decode($response);
                $customer_id = $obj_create_customer->{'id'};
            } else {
                $response = get_customer($cooperado);
                $obj_get_customer = json_decode($response);
                $customer_id = $obj_get_customer->{'data'}[0]->{'id'};
            }
            
            // gerar cobrança

            $response = get_cobranca_cartao_de_credito_em_aberto($customer_id, $cobrancas);
            $obj_get_boleto_em_aberto = json_decode($response);
            
            if ($obj_get_boleto_em_aberto->{'totalCount'} == 0)
            {
                $response = criar_cobranca_cartao_de_credito($customer_id, $cobranca,
                $holder_name, $number, $expiry_mounth, $expiry_year, $cvv,
                $name,$email,$cpf_cnpj,$postal_code,$address_number,$address_complement,
                $phone,$mobile_phone,$credit_card_token,$remote_ip);
                
                $obj_get_boleto_em_aberto = json_decode($response);
                $boleto_pdf = $obj_get_boleto_em_aberto->{'bankSlipUrl'};
                $fatura_url = $obj_get_boleto_em_aberto->{'invoiceUrl'};
            } else {
                $boleto_pdf = $obj_get_boleto_em_aberto->{'data'}[0]->{'bankSlipUrl'};
                $fatura_url = $obj_get_boleto_em_aberto->{'data'}[0]->{'invoiceUrl'};
            }
            */

        }
        }
        if ($cobrancas->isEmpty())
        {
            $charge = false;
        } else {
            $charge = true;
        }
        //$tensaoatendimento,$tipoconexao,$tiporamal,$tipofontegeracao
        if ($usuario->cooperado->meio_pagamento == "pix") {
            return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_pix','pix_code')
                            );
        }
        if ($usuario->cooperado->meio_pagamento == "boleto bancário") {
            return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_boletos','boleto_pdf', 'fatura_url')
                            );
        }

        if ($usuario->cooperado->meio_pagamento == "cartão de crédito") {
            return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas','name','postal_code','phone', 'mobile_phone', 'email')
                            );
        }
        return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas','name','postal_code')
                            );
    }


    public function payment(Request $request){
        @session_start();
        $look = array( "/",".", "-", "(", ")" ," ");
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        $pix_code = null;
        $qr_code = null;
        $boleto_pdf = null;
        $boletos_pdf = null;
        $fatura_url = null;
        $errors_asaas = null;
        $errors_aarin = null;
        $cobrancas_pix = null;
        $cobrancas_boletos = null;
        /* gerar cobrança */
        //$tensaoatendimento,$tipoconexao,$tiporamal,$tipofontegeracao
        
        $cobrancas_nao_abertas_no_ano = cobranca::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->get();
            $cobrancas = cobranca::where('cpf_cnpj','=', $cooperado->cpf_cnpj)->whereYear('dt_processamento','=', date('Y'))->whereMonth('dt_processamento','=', date('m'))->get();
            if ($cobrancas->isEmpty() && eh_preciso_gerar_cobranca_este_mes($cooperado))
            {
                    //echo ("nova cobranca-----------------------------------");
                    // Gerar nova cobranca para o cooperado X
                $cobranca = new Cobranca();
                $cobranca->dt_processamento = date("Y-m-d");
                $periodicidade = periodicidade::all(['periodicidade','valor']);
                $parcela_periodicidade = $cooperado->periodicidade;
                $parcela_num_parcelas = periodicidade::where('periodicidade', '=', $parcela_periodicidade)->first();
                $_num_parcelas = $parcela_num_parcelas->{'num_parcelas'};
                $i=0;
                foreach ($cobrancas_nao_abertas_no_ano as $cob)
                {
                    $i++;
                }
                $i = ($i % $_num_parcelas) +1;
                //echo ("i     $i------/------${_num_parcelas}-----------------------");
                $Date = date("Y-m-d");
                $cobranca->parcela = "$i/$_num_parcelas";
                //$cobranca->parcela = "1/12";
                $cobranca->dt_processamento = date("Y-m-d");
                //$cobranca->dt_vencimento = date('Y-m-d', strtotime($Date. ' + 10 days'));
                
                $day_number = date("d");
                //echo ("------pegar vencimento no proximo mes $day_number < $cooperado->dia_vencimento ?"); 
                if ($day_number < $cooperado->dia_vencimento)
                {
                    // pegar vencimento neste mes
                    $d = $cooperado->dia_vencimento;
                    $m = date('m');
                    $y = date('Y');
                    $cobranca->dt_vencimento = "$y-$m-$d";
                } else {
                    //echo ("------pegar vencimento no proximo mes"); 
                    // pegar vencimento no proximo mes
                    $d = $cooperado->dia_vencimento;
                    

                    $effectiveDate = strtotime("+1 month", strtotime($Date));
                    //$effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
                    $m = date("m", $effectiveDate);
                    $y = date("Y", $effectiveDate);
                    $cobranca->dt_vencimento = "$y-$m-$d";
                }
                
                $cobranca->cod_parcela = gerar_cod_parcela($cooperado);
                $cobranca->cpf_cnpj = $cooperado->cpf_cnpj;
                foreach($periodicidade as $itemi)  
                {
                    if ($itemi->periodicidade == $cooperado->periodicidade)
                    {
                        $cobranca->valor_a_pagar = $itemi->valor;
                        break;
                    } 
                }
                $cobranca->status = 'aberto';

                $cobranca->save(); 
                $cobrancas = cobranca::where('cpf_cnpj','=',$usuario->cooperado->cpf_cnpj)->where('status', '=', 'aberto')->get();
            }   
        
        if (!$cobrancas->isEmpty()) {
            if ($usuario->cooperado->meio_pagamento == "pix")
            {
                $pixconfig = pixconfig::where('id','=',1)->first();
                //try
                $cobrancas_pix = $cobrancas->toArray();
                $i = 0;
                foreach ($cobrancas as $cobranca)
                {

                    $aarin_token = aarin_oauth_token();
                    if (!empty($aarin_token['description']))
                    {
                        $charge = true;
                        $errors_aarin = $aarin_token;
                        return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_pix', 'errors_aarin')
                            );
                    }

                    $response = aarin_get_cobv($usuario, $cobranca, $aarin_token,"ATIVA");

                    if ($response == null)
                    {
                        $response = aarin_cobv($usuario, $cobranca, $aarin_token);
                    } else if (!empty($obj_cobv['description'])) {
                        $charge = true;
                        $errors_aarin = $obj_cobv;
                        return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_pix', 'errors_aarin')
                            );
                    }
                    
                    if (!empty($response['description']))
                    {
                        $charge = true;
                        $errors_aarin = $response;
                        return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_pix', 'errors_aarin')
                            );
                    }
                    //print_r($response);

                    //$pix_code = $obj_cobv['links']['emv'];
                    //$qr_code = $obj_cobv['links']['linkQrCode'];
                
                    $charge = true;

                    $cobrancas_pix[$i]['pix_code'] = $obj_cobv['links']['emv'];
                    $cobrancas_pix[$i]['qr_code'] = $obj_cobv['links']['linkQrCode'];
                    $i++;
                }
                
            }
            if ($usuario->cooperado->meio_pagamento == "boleto bancário") {
                $customer_id = "";
                // verificar se tem usuario (customer)
                $response = asaas_get_customer($cooperado);
                //echo __LINE__.":";var_dump($response);
                $obj_get_customer = $response;
                if ($obj_get_customer['totalCount'] == 0) {
                    // criar customer se nao existir
                    $response = asaas_criar_customer($cooperado);
                    
                    $obj_create_customer = $response;
                    $customer_id = $obj_create_customer['id'];
                } else {
                    $response = asaas_get_customer($cooperado);
                    $obj_get_customer = $response;
                    $customer_id = $obj_get_customer['data'][0]['id'];
                }
                
                // gerar cobrança

                $response = asaas_get_boleto_em_aberto($customer_id, $cobrancas[0]);
                $obj_get_boleto_em_aberto = $response;
                
                if ($obj_get_boleto_em_aberto['totalCount'] == 0)
                {
                    $response = asaas_criar_boleto($customer_id, $cobrancas[0]);
                    if (!empty($response['errors']))
                    {
                        $charge = true;
                        $errors_asaas = $response['errors'];
                        return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas', 'errors_asaas')
                            );
                    }
                    $obj_get_boleto_em_aberto = $response;

                    //$boleto_pdf = $obj_get_boleto_em_aberto->{'data'}[0]['bankSlipUrl'];
                    if(!empty($obj_get_boleto_em_aberto['data'])) {
                        $boletos_pdf = $obj_get_boleto_em_aberto['data'];
                    }
                    //$fatura_url = $obj_get_boleto_em_aberto->{'data'}[0]['invoiceUrl'];
                } else {

                    $boletos_pdf = $obj_get_boleto_em_aberto['data'];
                    //$fatura_url = $obj_get_boleto_em_aberto['data'][0]['invoiceUrl'];

                    //echo ("------------------------- boleto $boleto_pdf   $fatura_url");
                }
                $charge = true;

                $cobrancas_boletos = $cobrancas->toArray();

                if(!empty($boletos_pdf)) {
                    for ($i = 0; $i < count($cobrancas_boletos); $i++)
                    {
                        $cobrancas_boletos[$i]['bankSlipUrl'] = $boletos_pdf[$i]['bankSlipUrl'];

                    }
                }
                
                //print_r($cobrancas_boletos);
                return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_boletos','boletos_pdf', 'fatura_url', 'errors_asaas')
                            );
            }
            if ($usuario->cooperado->meio_pagamento == "cartão de crédito") {
    
                $holder_name = $request->holder_name;
                $number = str_replace($look, "", $request->number);
                $expiry_mounth = $request->expiry_mounth;
                $expiry_year = $request->expiry_year;
                $cvv = $request->cvv;
                $name = $request->name;
                $email = $request->email;
                $cpf_cnpj = str_replace($look, "", $request->cpf_cnpj);
                $postal_code = $request->postal_code;
                $address_number = $request->address_number;
                $address_complement = $request->address_complement;
                $phone = str_replace($look, "", $request->phone);
                $mobile_phone = str_replace($look, "", $request->mobile_phone);
                $remote_ip = $this->getIp();
                $credit_card_token = uniqid("");
                $customer_id = "";
                // verificar se tem usuario (customer)
                $response = asaas_get_customer($cooperado);
                //echo __LINE__.":";var_dump($response);
                $obj_get_customer = $response;
                if ($obj_get_customer->{'totalCount'} == 0) {
                    // criar customer se nao existir
                    $response = asaas_criar_customer($cooperado);
                    
                    $obj_create_customer = json_decode($response);
                    $customer_id = $obj_create_customer->{'id'};
                } else {
                    $response = asaas_get_customer($cooperado);
                    $obj_get_customer = json_decode($response);
                    $customer_id = $obj_get_customer->{'data'}[0]->{'id'};
                }
                
                // gerar cobrança

                $response = asaas_get_cobranca_cartao_de_credito_em_aberto($customer_id, $cobrancas);
                $obj_get_boleto_em_aberto = json_decode($response);
                
                if ($obj_get_boleto_em_aberto->{'totalCount'} == 0)
                {
                    $response = asaas_criar_cobranca_cartao_de_credito($customer_id, $cobranca,
                    $holder_name, $number, $expiry_mounth, $expiry_year, $cvv,
                    $name,$email,$cpf_cnpj,$postal_code,$address_number,$address_complement,
                    $phone,$mobile_phone,$credit_card_token,$remote_ip);
                    
                    $obj_get_boleto_em_aberto = json_decode($response);
                    $boleto_pdf = $obj_get_boleto_em_aberto->{'bankSlipUrl'};
                    $fatura_url = $obj_get_boleto_em_aberto->{'invoiceUrl'};
                } else {
                    $boleto_pdf = $obj_get_boleto_em_aberto->{'data'}[0]->{'bankSlipUrl'};
                    $fatura_url = $obj_get_boleto_em_aberto->{'data'}[0]->{'invoiceUrl'};
                }
                
                
            }
        }

        if ($cobrancas->isEmpty())
        {
            $charge = false;
        } else {
            $charge = true;
        }


        if ($usuario->cooperado->meio_pagamento == "pix") {
            return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_pix','pix_code')
                            );
        }
        if ($usuario->cooperado->meio_pagamento == "boleto bancário") {
            return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas_boleto','boleto_pdf', 'fatura_url', 'errors_asaas')
                            );
        }
        return view('prodist.payment', 
                                compact('cooperado','charge','cobrancas')
                            );
    }


    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public function create(){
        @session_start();
        
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);

        return view('prodist.create',compact('cooperado'));
    }

    public function inserir(){
        @session_start();
        
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        
        return view('prodist.create',compact('cooperado'));
        
                                  
    }

    public function convidar(){
        return view('prodist.invite');
    }

    public function change(cooperado $cooperado){
        $operadoras = operadora::all(['id', 'nome']);
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        return view('prodist.change_operator', [ 'cooperado' => $cooperado], compact( 'prodist', 'operadoras'));
    }

    public function alterar_operadora(cooperado $cooperado){
        $operadoras = operadora::all(['id', 'nome']);
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        return view('prodist.change_operator', [ 'cooperado' => $cooperado], compact( 'prodist', 'operadoras'));
    }

    public function change_operator(Request $request, cooperado $cooperado) {
    
        @session_start();
        $look = array( "/",".", "-", "(", ")" ," ");
        $params = request()->all();
        $cooperado = cooperado::find($request->id);
        //$cooperado->fill($params->except('id'));
        
        $usuario = usuario::find($request->idusuario);

        $cooperado->idoperadora = $request->idoperadora;

        $cooperado->save();
        $usuario->save();
        $_SESSION['cooperado'] = $cooperado;
        //return view('precadastro.confirm');
        if ($_SESSION['nivel_usuario'] == 'admin') {
            echo "<script language='javascript'> window.alert('Atualizado.') </script>";
            return redirect()->route('cooperados');
        } else {
            $operadoras = operadora::all(['id', 'nome']);
            $_SESSION['operadoras'] = $operadoras;
            $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
            return view('prodist.change_operator', [ 'cooperado' => $cooperado], compact( 'prodist', 'operadoras'));
        }
    }

    
    public function insert(Request $request) {
    
        @session_start();

        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        $prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();

        $validator = Validator::make($request->all(), [
            'codigo_uc' => ['nullable','max:20'],
            'classe_uc' => ['nullable', 'max:20'],
            'potencia_inst_uc' => ['nullable','numeric'],
            //'potencia_inst_gerada' => ['nullable', 'numeric'],
            'menor_consumo' => ['nullable','numeric'],
            'maior_consumo' => ['nullable','numeric'],
            'cota_comprada' => ['nullable', 'numeric'] 
        ]);

        if ($validator->fails())
        {
            @session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $usuario = usuario::find($id_usuario);
            $cooperado = cooperado::find($usuario->cooperado->id);

            return view('prodist.create', compact('cooperado')
                            )->withErrors($validator);
        }
       
        if ($prodist == null)
        { 
            
            if ($request->eh_titular == false)
            {
                $cooperado->eh_titular = false;
                $cooperado->idoperadora = $request->idoperadora;
                $cooperado->save();
                return view('home');
            } else 
            {
                $prodist = new Prodist();
                $cooperado->eh_titular = true;
                $cooperado->idoperadora = $request->idoperadora;
            }
        }
        $cooperado->eh_titular = $request->eh_titular;
        $cooperado->idoperadora = $request->idoperadora;
        $cooperado->meio_pagamento = $request->meio_pagamento;
        $cooperado->periodicidade = $request->periodicidade;
        $cooperado->dia_vencimento = $request->dia_vencimento;

        //if ($request->idoperadora != 1)
        {
            $prodist->idcooperadoprodist = $usuario->cooperado->id;
            $prodist->idoperadoraprodist = $request->idoperadora;
            $prodist->form_tab = ($request->form_tab >=8) ? 7 : $request->form_tab;
            $prodist->codigo_uc = $request->codigo_uc;
            $prodist->classe_uc = $request->classe_uc;
            $prodist->potencia_inst_uc = $request->potencia_inst_uc;
            //$prodist->potencia_inst_gerada = $request->potencia_inst_gerada; //so adm
            $prodist->tensao_atendimento = $request->tensao_atendimento;
            $prodist->tipo_conexao = $request->tipo_conexao;
            $prodist->tipo_ramal = $request->tipo_ramal;
            $prodist->tipo_fonte_geracao = $request->tipo_fonte_geracao;
            $prodist->menor_consumo = $request->menor_consumo;
            $prodist->maior_consumo = $request->maior_consumo;
            $prodist->cota_comprada = $request->cota_comprada;
            $prodist->save();
        }

        $cooperado->save();

        if ($_SESSION['nivel_usuario'] == 'admin') {
            echo "<script language='javascript'> window.alert('Atualizado.') </script>";
            return redirect()->route('cooperados');
        } else {

            $cooperado = cooperado::find($usuario->cooperado->id);
            
            $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
            
            $readonly = "";
            $convidados = cooperado::where('token_convidado','=',$cooperado->token_convite)->get();
            // Formulario fechado
            
                if ($prodist->statusreg == 'F')
                {
                    $readonly = "readonly";
                }
            
            //return view('home');
            $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
            $arquivo_prodist_ico = "null_icon.png";
            $arquivo_prodist = "null_icon.png";
            if (@$arquivo != null)
            {
                $arquivo_prodist_ico = $arquivo->doc_conta;
                $arquivo_prodist = $arquivo->doc_conta;
                if (str_contains($arquivo->doc_conta,"pdf"))
                {
                    $arquivo_prodist_ico = "file_pdf_icon.png";
                }
            }
            
            return view('prodist.edit', ['prodist' => $prodist], 
                    compact('cooperado','arquivo_prodist','arquivo_prodist_ico','readonly')
                );
            
        }
    }

    public function editar( prodist $prodist){
        @session_start();
        $params = request()->all();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        
        $cooperado = cooperado::find($usuario->cooperado->id);
        //$prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        $prodist = prodist::where('id','=',$prodist->id)->first();
        $readonly = "";
        $convidados = cooperado::where('token_convidado','=',$cooperado->token_convite)->get();
        // Formulario fechado
        
            if ($prodist->statusreg == 'F')
            {
                $readonly = "readonly";
            }
        

        return view('prodist.edit', ['prodist' => $prodist], compact('cooperado','readonly' ));
    }

    public function edit(Request $request, int $id) {

        @session_start();
        
        $look = array( "/",".", "-", "(", ")" ," ");
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
        $arquivo_prodist_ico = "null_icon.png";
        $arquivo_prodist = "null_icon.png";
        if (@$arquivo != null)
        {
            $arquivo_prodist_ico = $arquivo->doc_conta;
            $arquivo_prodist = $arquivo->doc_conta;
            if (str_contains($arquivo->doc_conta,"pdf"))
            {
                $arquivo_prodist_ico = "file_pdf_icon.png";
            }
        }
        //$prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        $prodist = prodist::where('id','=',$id)->first();

        if ($request->eh_titular == "false")
        {
           // echo ("eh_titular  -------sem validator-----".$request->eh_titular);

        } else {

        //echo ("eh_titular  -------com validator-----".$request->eh_titular);
            $validator = Validator::make($request->all(), [
                'codigo_uc' => ['nullable','max:20'],
                'classe_uc' => ['nullable', 'max:20'],
                'potencia_inst_uc' => ['nullable','numeric'],
                //'potencia_inst_gerada' => ['nullable','numeric'],
                'menor_consumo' => ['nullable', 'numeric'],
                'maior_consumo' => ['nullable', 'numeric'],
                'cota_comprada' => ['nullable', 'numeric'],
                'upfile' => ['nullable', 'max:1999'] 
            ]);
            if ($validator->fails())
            {
                @session_start();
                $id_usuario = $_SESSION['id_usuario'];
                $usuario = usuario::find($id_usuario);
                $cooperado = cooperado::find($usuario->cooperado->id);
                //$prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();
                $prodist = prodist::where('id','=',$id)->first();
                
                //return redirect()->back()->withErrors($validator)->withInput();
                $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
                $arquivo_prodist_ico = "null_icon.png";
                $arquivo_prodist = "null_icon.png";
                if (@$arquivo != null)
                {
                    $arquivo_prodist_ico = $arquivo->doc_conta;
                    $arquivo_prodist = $arquivo->doc_conta;
                    if (str_contains($arquivo->doc_conta,"pdf"))
                    {
                        $arquivo_prodist_ico = "file_pdf_icon.png";
                    }
                }
                $convidados = cooperado::where('token_convidado','=',$cooperado->token_convite)->get();
                $readonly = "";
                // Formulario fechado
                
                    if ($prodist->statusreg == 'F')
                    {
                        $readonly = "readonly";
                    }
            

                return view('prodist.edit', ['prodist' => $prodist], 
                                    compact('cooperado','arquivo_prodist','arquivo_prodist_ico','readonly')
                        )->withErrors($validator);
            }
        }
        


        if($request->btn_submit == 'imprimir')
        {
            echo "<script language='javascript'> window.print(); </script>";
            $operadoras = operadora::all(['id', 'nome']);
            $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
            $readonly = "";
            $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
            $arquivo_prodist_ico = "null_icon.png";
            $arquivo_prodist = "null_icon.png";
            $convidados = cooperado::where('token_convidado','=',$cooperado->token_convite)->get();
            if (@$arquivo != null)
            {
                $arquivo_prodist_ico = $arquivo->doc_conta;
                $arquivo_prodist = $arquivo->doc_conta;
                if (str_contains($arquivo->doc_conta,"pdf"))
                {
                    $arquivo_prodist_ico = "file_pdf_icon.png";
                }
                
            }
            // Formulario fechado
            
                if ($prodist->statusreg == 'F')
                {
                    $readonly = "readonly";
                }
            

            return view('prodist.edit', ['prodist' => $prodist], 
                                compact('cooperado','arquivo_prodist','arquivo_prodist_ico','readonly')
                       );
        }

        $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();

        $target_dir = "/var/www/coopeere/uploads/";
        
        try {
   
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.

            /* TODO tratar este erro
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error'])
            ) {
                throw new Exception('Parâmetro inválido. Erro ao enviar arquivo.');
            }
            */
        
            // Check $_FILES['upfile']['error'] value.
            if (isset($_FILES['upfile'])) {
                switch ($_FILES['upfile']['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        //throw new RuntimeException('Nenhum arquivo enviado.');
                        break;
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new Exception('Arquivo excede limite de tamanho.');
                    default:
                        throw new Exception('Erro desconhecido. ao enviar aquivo.');
                }
            
           
            if ($_FILES['upfile']['tmp_name'] != '') {
                // You should also check filesize here.
                if ($_FILES['upfile']['size'] > 1000000) {
                    throw new Exception('Arquivo excede limite de tamanho: 1MB');
                }
            
                // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
                // Check MIME Type by yourself.

                /*
                FIX-ME
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if (false === $ext = array_search(
                    finfo_file($finfo, $_FILES['upfile']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                        'pdf' => 'application/pdf',
                    ),
                    true
                )) {
                    throw new Exception('Formato do arquivo inválido.');
                }
                */

                // You should name it uniquely.
                // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
                // On this example, obtain safe unique name from its binary data.
                $path_parts = pathinfo($_FILES['upfile']['name']);
                $basename = sha1_file($_FILES['upfile']['tmp_name']);
                $ext = $path_parts['extension'];
                if (!move_uploaded_file(
                    $_FILES['upfile']['tmp_name'],
                    sprintf('%s/%s.%s',
                        $target_dir,
                        $basename,
                        $ext
                    ))
                ) 
                {
                    new Exception('Erro ao carregar arquivo.');
                }
                
            
                if ($arquivo == null)
                {
                    $arquivo = new Arquivo();
                } else {
                    if ($arquivo->doc_conta != $basename.'.'.$ext)
                    {
                        $filename = "/var/www/coopeere/uploads/".$arquivo->doc_conta;
                        unlink($filename);
                    }
                }
                $arquivo->doc_conta = $basename.'.'.$ext;
                $arquivo->cpf_cnpj = $cooperado->cpf_cnpj;
                $arquivo->save();

                echo "<script language='javascript'> window.alert('Arquivo carregado com sucesso.') </script>";
        }
            }
        } catch (Exception $e) {
        
            @session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $usuario = usuario::find($id_usuario);
            $cooperado = cooperado::find($usuario->cooperado->id);

            $readonly='';
            $convidados = cooperado::where('token_convidado','=',$cooperado->token_convite)->get();
            //return redirect()->back()->withErrors($validator)->withInput();
            return view('prodist.edit', ['prodist' => $prodist], 
                                compact('cooperado','readonly')
                       )->withErrors($e->getMessage());
        
        }

        //echo ("\nedit !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!".$request->eh_titular);
        if ($request->eh_titular == "false")
        {
            //echo ("\napoiador !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
            $cooperado->eh_titular=false;
            $cooperado->tipo = 'apoiador';
        } else {
            //echo ("\ncadastrado !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
            $cooperado->tipo = 'cadastrado';
            $cooperado->eh_titular=true;
        }
        
        $cooperado->meio_pagamento = $request->meio_pagamento;
        $cooperado->periodicidade = $request->periodicidade;
        $cooperado->dia_vencimento = $request->dia_vencimento;
        $cooperado->idoperadora = $request->idoperadora;
        $cooperado->save();
        //echo ("eh_titular !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! ".$request->eh_titular);
        

        $prodist->form_tab = ($request->form_tab >=8) ? 7 : $request->form_tab;
        $prodist->codigo_uc = $request->codigo_uc;
        $prodist->classe_uc = $request->classe_uc;
        $prodist->potencia_inst_uc = $request->potencia_inst_uc;
        //$prodist->potencia_inst_gerada = $request->potencia_inst_gerada; //so adm
        $prodist->tensao_atendimento = $request->tensao_atendimento;
        $prodist->tipo_conexao = $request->tipo_conexao;
        $prodist->tipo_ramal = $request->tipo_ramal;
        $prodist->tipo_fonte_geracao = $request->tipo_fonte_geracao;
        $prodist->menor_consumo = $request->menor_consumo;
        $prodist->maior_consumo = $request->maior_consumo;
        $prodist->cota_comprada = $request->cota_comprada;
        

        if($request->btn_submit == 'salvar') {
            // faz nada, exceto salvar formulario prodist
        }

        if($request->btn_submit == 'enviar') {

            $look = array( "/",".", "-", "(", ")" ," ");
            $id_usuario = $_SESSION['id_usuario'];
            $usuario = usuario::find($id_usuario);
            $cooperado = cooperado::find($usuario->cooperado->id);
            $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
    
            //$prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
            $prodist = prodist::where('id','=',$id)->first();
            $validator = Validator::make($request->all(), [
                'codigo_uc' => ['required','max:20'],
                'classe_uc' => ['required', 'max:20'],
                'potencia_inst_uc' => ['required', 'numeric'],
                //'potencia_inst_gerada' => ['required', 'numeric'],
                'menor_consumo' => ['required', 'numeric'],
                'maior_consumo' => ['required', 'numeric'],
                'cota_comprada' => ['required', 'numeric'] 
            ]);
    
            if ($validator->fails())
            {
                @session_start();
                $id_usuario = $_SESSION['id_usuario'];
                $usuario = usuario::find($id_usuario);
                $cooperado = cooperado::find($usuario->cooperado->id);
                //$prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();
                $prodist = prodist::where('id','=',$id)->first();
                
                $convidados = cooperado::where('token_convidado','=',$cooperado->token_convite)->get();
                $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
                $arquivo_prodist_ico = "null_icon.png";
                $arquivo_prodist = "null_icon.png";
                if (@$arquivo != null)
                {
                    $arquivo_prodist_ico = $arquivo->doc_conta;
                    $arquivo_prodist = $arquivo->doc_conta;
                    if (str_contains($arquivo->doc_conta,"pdf"))
                    {
                        $arquivo_prodist_ico = "file_pdf_icon.png";
                    }
                    
                }
                $readonly = "";
                // Formulario fechado
                
                    if ($prodist->statusreg == 'F')
                    {
                        $readonly = "readonly";
                    }
                
    
                return view('prodist.edit', ['prodist' => $prodist], 
                                compact('cooperado','arquivo_prodist','arquivo_prodist_ico','readonly')
                       )->withErrors($validator);
            }

            
            echo "<script language='javascript'> window.alert('Não será mais possivel editar o formulário prodist.') </script>";
            $prodist->statusreg = 'F';
            $cooperado->tipo = 'cooperado';
            
            $prodists = prodist::where('statusreg','=','F');
            
            $cooperado->tipo_conta = $this->classificar_tipo_cooperado($prodist->tipo_conexao, 
                                                                        $prodist->cota_comprada);
            $i = 1;
            if ($cooperado->tipo_conta == 'alto consumo')
            {
                for ($i=1; $i < 8;$i++)
                {
                    $total_grupo_kwh = 0;
                    foreach ($prodists as $p)
                    {
                        if ($p->cooperado->tipo_conta == 'alto consumo' &&
                        $p->cooperado->grupo_conta == $i)
                        {
                            $total_grupo_kwh = $total_grupo_kwh + $p->cota_comprada;
                        }
                    }
                    if ($total_grupo_kwh < 700000)
                    {
                        $cooperado->grupo_conta = $i;
                        break;
                    }
                }
            }
            if ($i >=8)
            {
                echo "<script language='javascript'> window.alert('Limite do sistema alcançado.') </script>";
            }
            
            $cooperado->save();
        }

        if($request->btn_submit == 'deletar') {
            echo "<script language='javascript'> window.alert('Não será mais possivel entrar na sua conta do coopere.') </script>";
            $prodist->statusreg = 'D';
            $cooperado->tipo = 'deletado';
            $cooperado->save();
            $prodist->save();
            return view('home');
        }

        $prodist->save();


            $readonly = "";
            // Formulario fechado
            
                if ($prodist->statusreg == 'F')
                {
                    $readonly = "readonly";
                }
                $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
                $arquivo_prodist_ico = "null_icon.png";
                $arquivo_prodist = "null_icon.png";
                if (@$arquivo != null)
                {
                    $arquivo_prodist_ico = $arquivo->doc_conta;
                    $arquivo_prodist = $arquivo->doc_conta;
                    if (str_contains($arquivo->doc_conta,"pdf"))
                    {
                        $arquivo_prodist_ico = "file_pdf_icon.png";
                    }
                    
                }

            return view('prodist.edit', ['prodist' => $prodist], 
                                compact('cooperado','arquivo_prodist','arquivo_prodist_ico','readonly')
                       );
           // }
    }

    public function modal_status($cooperado){
        @session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($cooperado);
        $id = $cooperado->id;
        //$prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();
        
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        $readonly = "";
        // Formulario fechado
        
            if ($prodist->statusreg == 'F')
            {
                $readonly = "readonly";
            }
            $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
            $arquivo_prodist_ico = "null_icon.png";
            $arquivo_prodist = "null_icon.png";
            if (@$arquivo != null)
            {
                $arquivo_prodist_ico = $arquivo->doc_conta;
                $arquivo_prodist = $arquivo->doc_conta;
                if (str_contains($arquivo->doc_conta,"pdf"))
                {
                    $arquivo_prodist_ico = "file_pdf_icon.png";
                }
            }
        //return view('prodist.edit', ['cooperados' => $cooperados, 'id' => $id]);
        return view('prodist.edit', ['prodist' => $prodist], 
                    compact('cooperado','readonly','arquivo_prodist','arquivo_prodist_ico','id')
        );
     }

     public function delete_status($id){
        $cooperado = cooperado::find($id);
        //$prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();
        
        $prodist = prodist::where('idcooperadoprodist','=',$id)->first();
        $prodist->statusreg = 'D';
        $cooperado->tipo = 'deletado';
        $cooperado->save();
        $prodist->save();
        return view('home');
     }

    public function invite(Request $request) {
    
        @session_start();
        $look = array( "/",".", "-", "(", ")" ," ");
        $params = request()->all();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        
        if (empty($cooperado->token_convite))
        {
            $cooperado->token_convite = getToken(8);
        }

        $webhost = request()->getHttpHost();
        $invite_url = 'http://'.$webhost.'/precadastro/inserir?token_convite='.$cooperado->token_convite;
        $nome_convidado = $request->nome;
        $email = $request->email;
        $nome_cooperado = $cooperado->nome;
        $cooperado->save();
        //$usuario->save();
        $this->enviar_convite_via_email($nome_cooperado, $email, $nome_convidado, $invite_url);

        if ($_SESSION['nivel_usuario'] == 'admin') {
            echo "<script language='javascript'> window.alert('Atualizado.') </script>";
            return redirect()->route('cooperados');
        } else {
            echo "<script language='javascript'> window.alert('".$invite_url."') </script>";
            if ($cooperado->tipo == 'cadastrado')
            {
                $cooperado->tipo = 'apoiador';
                $cooperado->save();
            }
            $operadoras = operadora::all(['id', 'nome']);
            $_SESSION['invite_url'] = $invite_url;
            $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();

            if (@$prodist->id != null)
            {
                $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
                
                $readonly = "";
                $convidados = cooperado::where('token_convidado','=',$cooperado->token_convite)->get();
                    // Formulario fechado
                if ($prodist->statusreg == 'F')
                {
                    $readonly = "readonly";
                }
                $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
                $arquivo_prodist_ico = "null_icon.png";
                $arquivo_prodist = "null_icon.png";
                if (@$arquivo != null)
                {
                    $arquivo_prodist_ico = $arquivo->doc_conta;
                    $arquivo_prodist = $arquivo->doc_conta;
                    if (str_contains($arquivo->doc_conta,"pdf"))
                    {
                        $arquivo_prodist_ico = "file_pdf_icon.png";
                    }
                }
                return view('prodist.edit', ['prodist' => $prodist], 
                                    compact('cooperado','arquivo_prodist','arquivo_prodist_ico','readonly')
                        );
            } else {
                $id_usuario = $_SESSION['id_usuario'];
                $usuario = usuario::find($id_usuario);
                $cooperado = cooperado::find($usuario->cooperado->id);
                
                //$tensaoatendimento,$tipoconexao,$tiporamal,$tipofontegeracao

                return view('prodist.create', compact('cooperado') );
            }
        }
    }

    private function enviar_convite_via_email($nome_cooperado, $email_para, $nome,$url) {
        $mail = new PHPMailer(true);
        $emailconfig = emailconfig::where('id','=',1)->first();

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->Host       = $emailconfig->servidor;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $emailconfig->usuario;                     //SMTP username
            $mail->Password   = $emailconfig->senha;
            if ($emailconfig->tls) {                             //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer:: ENCRYPTION_SMTPS` encouraged
            }
            $mail->Port       = $emailconfig->porta;                                    //TCP port to connect     to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($emailconfig->email_remetente, 'Coopeere');
            $mail->addAddress($email_para, $nome);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Olá, '.$nome.'! Um e-mail especial de '.$nome_cooperado.' para você.';
            $mail->Body    = $nome_cooperado.' está te convidando para participar da cooperativa Coopeere. Tenha mais descontos em sua conta de luz. Clique em: <a href="'.$url.'">'.$url.'</a> para se afiliar a Cooperativa de Energia Eólica Coopeere.';
            $mail->AltBody = $nome_cooperado.' está te convidando para participar da cooperativa Coopeere. Tenha mais descontos em sua conta de luz. Clique em: '.$url.'  para se afiliar a Cooperativa de Energia Eólica Coopeere.';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function classificar_tipo_cooperado($conexao, $consumo)
    {
        $tipo = "baixo consumo";
        /* Se o cooperado marcar Tipo de Conexão/Fornecimento ´´monofásico``, 
        e responder que quer comprar entre 0 a 69 kwh, o sistema deve aloca-lo na lista No 2 que 
        chamaremos de ´´Baixo Consumo``. */
        if ($conexao == 'monofásica' && $consumo >= 0 && $consumo < 70) {
            $tipo = "baixo consumo";
        }

        /* Se o cooperado marcar Tipo de Conexão/Fornecimento ´´Bifásico``, e responder que 
        quer comprar entre 0 a 109 kwh, o sistema deve aloca-lo na lista No 2 que 
        chamaremos de ´´Baixo Consumo``. */
        if ($conexao == 'bifásica' && $consumo >= 0 && $consumo < 110) {
            $tipo = "baixo consumo";
        }        
        /* Se o cooperado marcar Tipo de Conexão/Fornecimento ´´trifásico``, e responder que 
        quer comprar entre 0 a 209 kwh, o sistema deve aloca-lo na lista No 2 que 
        chamaremos de ´´Baixo Consumo`` */
        if ($conexao == 'trifásica' && $consumo >= 0 && $consumo < 210) {
            $tipo = "baixo consumo";
        }
        
        /* Se o cooperado marcar Tipo de Conexão/Fornecimento ´´monofásico``, e responder que 
        quer comprar 70 kwh ou mais, o sistema deve aloca-lo na lista No 1 ou a mesma onde se encontra, 
        que chamaremos de ´´Alto Consumo``. */
        if ($conexao == 'monofásica' && $consumo >= 70 ) {
            $tipo = "alto consumo";
        }

        /* ??? */
        if ($conexao == 'bifásica' && $consumo >= 110 ) {
            $tipo = "alto consumo";
        }
        /* Se o cooperado marcar Tipo de Conexão/Fornecimento ´´trifásico``, e responder que 
        quer comprar 210 kwh ou mais, o sistema deve aloca-lo na lista No 1 ou a mesma onde se encontra, 
        que chamaremos de ´´Alto Consumo``. */
        if ($conexao == 'trifásica' && $consumo >= 210 ) {
            $tipo = "alto consumo";
        }

        return $tipo;
    }
}
