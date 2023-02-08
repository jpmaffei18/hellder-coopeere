<?php

namespace App\Http\Controllers;
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use LaravelLegends\PtBrValidator\Rules\CpfOuCnpj;
use LaravelLegends\PtBrValidator\Rules\FormatoCep;
use LaravelLegends\PtBrValidator\Rules\Uf;

use App\Models\emailconfig;
use App\Models\smsgatewayconfig;
use App\Models\usuario;
use App\Models\cooperado;
use App\Models\operadora;
use App\Models\prodist;
use Illuminate\Http\Request;
 
 
require_once env('ROOT').'/app/helpers.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';

class PrecadastroController extends Controller
{

    public function create(){
        return view('precadastro.create');
    }

    public function inserir(){
        return view('precadastro.create');
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome completo obrigatório',
            
        ];
    }

    public function insert(Request $request) {

        $validated = $request->validate([
            'nome' => ['required','max:255', 'min:8'],
            'cep' => ['required', 'max:9'],
            'numero' => ['required', 'max:5'],
            'endereco' => ['required', 'max:200'],
            'bairro' => ['required', 'max:200'],
            'cidade' => ['required', 'max:200'],
            'cpf_cnpj' => ['required', new CpfOuCnpj, 'unique:tabusuario,cpf_cnpj'],
            'estado' => ['required', new Uf],
            'email' => ['required', 'unique:tabusuario,email'],
            'senha' => ['min:6','required_with:confirma_senha','same:confirma_senha'],
            'confirma_senha' => ['min:6']
        ]);
/*
        if ($validator->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors(['campo cpfcnpj', 'CPF/CNPJ já existente']);
        }*/
        $look = array( "/",".", "-", "(", ")" ," ");
        $cpf_cnpj = str_replace($look, "", $request->cpf_cnpj);
        $usuarios = usuario::where('cpf_cnpj','=',$cpf_cnpj)->first();
        
        if(@$usuarios->id != null) {
            return redirect()->back()->withInput($request->input())->withErrors(['campo cpfcnpj', 'CPF/CNPJ já existente']);
            
        }

        $telefone_celular = str_replace($look, "", $request->telefone_celular);
        $usuarios = usuario::where('telefone_celular','=',$telefone_celular)->first();
        
        if(@$usuarios->id != null) {
            return redirect()->back()->withInput($request->input())->withErrors(['campo telefone celular', 'Telefone já existente']);
            //return redirect()->route('precadastro.inserir',$errors);
        }

        if (strlen($cpf_cnpj) > 11) {
            if ( (strlen($request->inscricao_estadual)) < 4) {
                return redirect()->back()->withInput($request->input())->withErrors(['campo inscrição estadual', 'Inscrição Estadual incompleta ou inexistente']);
            } else {
                $cooperado->inscricao_estadual = $request->inscricao_estadual;
            }
        }
        
        if (strlen($cpf_cnpj) > 11) {
            if ( (strlen($request->inscricao_municipal)) < 4) {
                return redirect()->back()->withInput($request->input())->withErrors(['campo inscrição municipal', 'Inscrição Municipal incompleta ou inexistente']);
            } else {
                $cooperado->inscricao_municipal = $request->inscricao_municipal;
            }
        }
        $telefone_celular = str_replace($look, "", $request->telefone_celular);
        if (strlen($telefone_celular) < 11) {
            return redirect()->back()->withInput($request->input())->withErrors(['campo telefone celular', 'Telefone Celular sem DDD']);
        }

        $cooperado = new Cooperado();
        
        $cooperado->nome = $request->nome;
        $cooperado->tipo = "cadastrado";
        $cooperado->cpf_cnpj = str_replace($look, "", $request->cpf_cnpj);
        
        $cooperado->cep = str_replace($look, "", $request->cep);
        $cooperado->endereco = $request->endereco;
        $cooperado->numero = $request->numero;
        $cooperado->bairro = $request->bairro;
        $cooperado->cidade = $request->cidade;
        $cooperado->estado = $request->estado;
        $cooperado->idoperadora = 1;
        $cooperado->tipo_conta = null;
        $cooperado->sorteio = 2;
        $cooperado->status = 'cadastrado';
        if (isset($request->token_convite ))
        {
            $cooperado->token_convidado = $request->token_convite;
        }

        $usuario = new Usuario();
        $usuario->email = $request->email;
        $usuario->email_verificado_em = null;
        $usuario->senha = md5($request->senha);
        $usuario->nivel = 'user';
        $usuario->cpf_cnpj = str_replace($look, "", $request->cpf_cnpj);
        $usuario->telefone_fixo = str_replace($look, "", $request->telefone_fixo);
        $usuario->telefone_celular = str_replace($look, "", $request->telefone_celular);
        $usuario->token_email = getToken(8);
        if ($this->is_mobile_phone($usuario->telefone_celular )){
            $usuario->token_telefone = getSmsToken(6);
            $usuario->telefone_verificado_em = null;
        }

        $telefone_celular = str_replace($look, "", $request->telefone_celular);
        $token_telefone = getSmsToken(6);
        $msg_tel = "";
        if ($this->is_mobile_phone($telefone_celular)){
            $ret = $this->enviar_sms($telefone_celular, $cooperado->nome, $token_telefone);
            //echo $telefone_celular;
            //echo print_r($ret);
            if ($ret->{"status"} == "Sucesso"){
                    $msg_tel = "Enviamos um SMS para seu celular com o código para confirmar seu telefone.";
                    $usuario->telefone_celular = $telefone_celular;
                    $usuario->telefone_verificado_em = null;
                    $usuario->token_telefone = $token_telefone;
            } else {
                echo print_r($ret);
            }
        } else {
            $usuario->telefone_celular = str_replace($look, "", $request->telefone_celular);
        }
        

        $cooperado->eh_titular = null;
        $cooperado->save();
        $usuario->save();
        

        $this->enviar_email($usuario->email,$cooperado->nome, $usuario->token_email);
        $msg = "Enviamos um link e código para seu e-mail (veja também a caixa de spam). Por favor, clique neste link, digite o código e siga para a segunda etapa do cadastro.";
        echo "<script language='javascript'> window.alert('$msg$msg_tel') </script>";
        return view('precadastro.confirm');
    }

    public function confirmar(){
        return view('precadastro.confirm');
    }

    public function confirmar_telefone(){
        return view('precadastro.confirm_tel');
    }
    
    public function confirm(Request $request) {

        $token_email = $request->token_email;
        $usuario = usuario::where('token_email','=',$token_email)->first();
        if(@$usuario->id != null) {
            $usuario->email_verificado_em = date("Y-m-d H:i:s");
            $usuario->token_email = null;
            $cooperado = cooperado::where('cpf_cnpj','=',$usuario->cpf_cnpj)->first();
            $cooperado->tipo = 'cadastrado';
            $usuario->save();
            $cooperado->save();

            
            $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
            if (!isset($prodist))
            {
                $prodist = new Prodist();
                $prodist->idcooperadoprodist = $cooperado->id;
                $prodist->form_tab = 0;
                $prodist->save();
            }
            if ($usuario->token_telefone != null)
            {
                return view('precadastro.confirm_tel');
            }
            echo "<script language='javascript'> window.alert('Token correto! Ir para login.') </script>";
            return view('home');
        } else {
            echo "<script language='javascript'> window.alert('Código incorreto: $token_email'. Se já digitou o código anteriormente, então entre na tela de login.) </script>";
            return view('precadastro.confirm');
        }
    }

    public function confirm_tel(Request $request) {

        $token_telefone = $request->token_telefone;
        $usuario = usuario::where('token_telefone','=',$token_telefone)->first();
        if(@$usuario->id != null) {
            $usuario->telefone_verificado_em = date("Y-m-d H:i:s");
            $usuario->token_telefone = null;
            $cooperado = cooperado::where('cpf_cnpj','=',$usuario->cpf_cnpj)->first();
            $cooperado->tipo = 'cadastrado';
            
            $usuario->save();
            $cooperado->save();

            echo "<script language='javascript'> window.alert('Token correto! Ir para login.') </script>";
            return view('home');
        } else {
            echo "<script language='javascript'> window.alert('Token incorreto: $token_telefone'. Se já digitou o código, então entre na tela de login.) </script>";
            return view('precadastro.confirm_tel');
        }
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
            $mail->Subject = 'Confirmação de E-mail';
            $webhost = request()->getHttpHost();
            $link = "http://$webhost/precadastro/confirmar";
            $msg_http = "Por favor, clique neste link <a href=\"$link\">$link</a>, digite o código <b>$token</b> e faça, em seguida, a primeira autenticação e siga a segunda etapa do cadastro.";
        
            $msg_txt = "Por favor, clique neste link ($link), digite o código ($token) e faça, em seguida, a primeira autenticação e siga a segunda etapa do cadastro.";
            $mail->Body    = $msg_http;
            $mail->AltBody = $msg_txt;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function enviar_sms($telefone_celular, $nome, $token) {
        $smsgatewayconfig = smsgatewayconfig::where('id','=',1)->first();
        $base_url = $smsgatewayconfig->base_url;
        $hash_integracao = $smsgatewayconfig->hash_integracao;
        $webhost = request()->getHttpHost();
        $msg    = 'Coopeere. Ola. Digite o codigo:'.$token;
        $msg_encoded = urlencode($msg);

        $url = $base_url.'?'.'hash='.$hash_integracao.'&'.'numero='.$telefone_celular.'&'.'mensagem='.$msg_encoded;
        return json_decode(file_get_contents($url));
    }

    private function consultar_saldo() {
        $smsgatewayconfig = smsgatewayconfig::where('id','=',1)->first();
        $base_url = $smsgatewayconfig->base_url;
        $hash_integracao = $smsgatewayconfig->hash_integracao;
        $msg = "Teste";
        $msg_encoded = urlencode($msg);
        $telefone = '22998698455';
        $url = $base_url.'?'.'hash='.$hash_integracao.'&acao=consultar&'.'numero='.$telefone.'&'.'mensagem='.$msg_encoded;
        return json_decode(file_get_contents($url));
    }

    private function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }



    

    public function edit( cooperado $cooperado){
        $operadoras = operadora::all(['id', 'nome']);
        return view('precadastro.edit', [ 'cooperado' => $cooperado], [ 'operadoras' => $operadoras ]);
    }

    public function editar(Request $request, cooperado $cooperado) {


        $validated = $request->validate([
            'nome' => ['required','max:255', 'min:8'],
            'cep' => ['required', 'max:9'],
            'numero' => ['required', 'max:5'],
            'endereco' => ['required', 'max:200'],
            'bairro' => ['required', 'max:200'],
            'cidade' => ['required', 'max:200'],
            'cpf_cnpj' => ['required', new CpfOuCnpj],
            'estado' => ['required', new Uf]
        ]);
        
        $look = array( "/",".", "-", "(", ")" ," ");
        $cpf_cnpj = str_replace($look, "", $request->cpf_cnpj);

        if (strlen($cpf_cnpj) > 11) {
            if ( (strlen($request->inscricao_estadual)) < 4) {
                return redirect()->back()->withInput($request->input())->withErrors(['campo inscrição estadual', 'Inscrição Estadual incompleta ou inexistente']);
            } else {
                $cooperado->inscricao_estadual = $request->inscricao_estadual;
            }
        }
        
        if (strlen($cpf_cnpj) > 11) {
            if ( (strlen($request->inscricao_municipal)) < 4) {
                return redirect()->back()->withInput($request->input())->withErrors(['campo inscrição municipal', 'Inscrição Municipal incompleta ou inexistente']);
            } else {
                $cooperado->inscricao_municipal = $request->inscricao_municipal;
            }
        }

        $telefone_celular = str_replace($look, "", $request->telefone_celular);
        if (strlen($telefone_celular) < 11) {
            return redirect()->back()->withInput($request->input())->withErrors(['campo telefone celular', 'Telefone Celular sem DDD']);
        }

        $usuarios = usuario::where('cpf_cnpj','=',$cpf_cnpj)->first();
        /*
        if(@$usuarios->id != null) {
            return redirect()->back()->withErrors(['campo cpfcnpj', 'CPF/CNPJ já existente']);
            //return redirect()->route('precadastro.inserir',$errors);
        }*/
        
        @session_start();
        $look = array( "/",".", "-", "(", ")" ," ");
        $cooperado = cooperado::find($request->id);
        
        $cooperado->nome = $request->nome;
        $cooperado->cpf_cnpj = str_replace($look, "", $request->cpf_cnpj);
        $cooperado->cep = $request->cep;
        $cooperado->endereco = $request->endereco;
        $cooperado->numero = $request->numero;
        $cooperado->bairro = $request->bairro;
        $cooperado->cidade = $request->cidade;
        $cooperado->estado = $request->estado;

        $cooperado->sorteio = $request->sorteio;
        
        $usuario = usuario::find($request->idusuario);
        $usuario->email = $request->email;
        $usuario->cpf_cnpj = str_replace($look, "", $request->cpf_cnpj);

        $usuario->telefone_fixo = str_replace($look, "", $request->telefone_fixo);
        



        $token_telefone = getSmsToken(6);

        if (strcmp($usuario->telefone_celular, $telefone_celular) != 0) {
            if ($this->is_mobile_phone($telefone_celular)){
                $ret = $this->enviar_sms($telefone_celular, $cooperado->nome, $token_telefone);
                //echo $telefone_celular;
                //echo print_r($ret);
                if ($ret->{"status"} == "Sucesso"){

                        $usuario->telefone_celular = $telefone_celular;
                        $usuario->telefone_verificado_em = null;
                        $usuario->token_telefone = $token_telefone;
                } else {
                    echo print_r($ret);
                }
            } else {
                $usuario->telefone_celular = str_replace($look, "", $request->telefone_celular);
            }
        }
        
        $cooperado->save();
        $usuario->save();
        $_SESSION['cooperado'] = $cooperado;
        //return view('precadastro.confirm');
        if ($_SESSION['nivel_usuario'] == 'admin') {
            echo "<script language='javascript'> window.alert('Atualizado.') </script>";
            return redirect()->route('cooperados');
        } else {
            if ($usuario->telefone_verificado_em == null)
            {
                $msg = "Telefone não confirmado. Insira o código que foi enviado via SMS para seu celular e coloque na tela de confirmação de celular e faça sua segunda autenticação.";
                echo "<script language='javascript'> window.alert('$msg') </script>";
                return view('precadastro.confirm_tel');
            } else {

                //echo "<script language='javascript'> window.alert('Atualizado.') </script>";
                //return view('cooperados.show', [ 'cooperado' => $cooperado] );


                $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();

                $readonly = "";

                if($prodist == null)
                {
                    return view('prodist.create', compact('cooperado'));
                }

                if(@$usuarios->token_reedit_prodist != null)
                {
                    echo "<script language='javascript'> window.alert('Confirmar Reedicao de Formulario Prodist, verifique código no seu email') </script>";
                    return view('prodist.confirm_reedit');
                }
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
            }
            
        }
    }

    private function is_mobile_phone( $phone ) {
        $look = array( "/",".", "-", "(", ")" ," ");
        $number = str_replace($look, "", $phone);
        $len = strlen($number);
        return ($len >= 11);
    }
}

