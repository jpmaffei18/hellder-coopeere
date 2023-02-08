<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Models\usuario;
use App\Models\cooperado;
use App\Models\operadora;
use App\Models\emailconfig;
use App\Models\prodist;
use App\Models\arquivo;
use App\Models\tensaoatendimento;
use App\Models\tipoconexao;
use App\Models\tiporamal;
use App\Models\tipofontegeracao;
use App\Models\periodicidade;
use App\Models\meiopagamento;
use App\Models\periodicidademeiopagamento;
use App\Models\diadevencimento;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    //
    public function login(Request $request) {
        $email = $request->email;
        $senha = $request->senha;

        $usuarios = usuario::where('email','=',$email)->where('senha','=',md5($senha))->first();

        if(@$usuarios->id != null) {
            @session_start();
            $_SESSION['id_usuario'] = $usuarios->id;
            $_SESSION['email_usuario'] = $usuarios->email;
            $_SESSION['nivel_usuario'] = $usuarios->nivel;
            $_SESSION['token_email_usuario'] = $usuarios->token_email;
            $_SESSION['cpf_cnpj_usuario'] = $usuarios->cpf_cnpj;
            $_SESSION['telefone_celular_usuario'] = $usuarios->telefone_celular;

            if (@$usuarios->email_verificado_em == null && $usuarios->token_email != null)
            {
                echo "<script language='javascript'> window.alert('Email não confirmado.') </script>";
                return view('precadastro.confirm');
            }
            if (@$usuarios->telefone_verificado_em == null && $usuarios->token_telefone != null)
            {
                $msg = "Telefone não confirmado. Insira o código que foi enviado via SMS para seu celular e coloque na tela de confirmação de celular e faça sua segunda autenticação.";
                echo "<script language='javascript'> window.alert('$msg') </script>";
                return view('precadastro.confirm_tel');
            }
            if ($_SESSION['nivel_usuario'] == 'admin') {
                // admin: lista cooperados
                //$cooperados = cooperado::orderby('idcooperado')->paginate();
                $cooperados = cooperado::all();
                //echo $cooperados;
                return view('admin.cooperados', ['cooperados' => $cooperados]);
            } else {
                $cooperado = cooperado::where('cpf_cnpj','=',$usuarios->cpf_cnpj)->first();
                $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
                
                //$usuario = usuario::where('cpf_cnpj','=',$usuarios->cpf_cnpj)->first();
                //echo $cooperado;
                 // user: editar dados do proprio cooperado.
                if ($cooperado->tipo == 'deletado')
                {
                   echo "<script language='javascript'> window.alert('Usuário deletado') </script>";
                   return view('home');
                }
                $operadoras = operadora::all(['id', 'nome']);
                $_SESSION['cooperado'] = $cooperado;

                $tel_vef = date_create(@$usuarios->telefone_verificado_em);
                $today = date_create("now");
                $interval = date_diff($today,$tel_vef);
                $days = $interval->format("%a");

                if ($days <= 365) {
                   $msg = " Meus parabéns! Agora você faz parte de um grupo de milhares de famílias que desejam se unir para produzir sua própria energia, diminuindo o custo, trazendo oportunidades de emprego técnico e novas tecnologias para a nossa região!                      Hellder Benjamim,                                                                              Presidente";
                   echo "<script language='javascript'> window.alert('$msg') </script>";
                }
                 //return view('precadastro.edit', ['cooperado' => $cooperado], ['operadoras' => $operadoras]);
                 //return view('prodist.change_operator', ['cooperado' => $cooperado], compact('prodist','operadoras'));
                $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
                
                $readonly = "";

                if($prodist == null)
                {
                    
                    return view('prodist.create', 
                                compact('cooperado')
                            );
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
                    //    return view('prodist.edit', $prodist, 
                      //         compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','readonly')
                        //);
            }
        } else {
            echo "<script language='javascript'> window.alert('Erro de login/senha.') </script>";
            return view('home');
        }
    }

    public function logout() {
        @session_start();
        @session_destroy();
        return view('home');
    }

    public function senha_esquecida(){
        return view('usuarios.forgotten_password');
    }

    public function trocar_senha(){
        return view('usuarios.change_password');
    }

    public function forgotten_password(Request $request) {
        $email = $request->email;
        $usuario = usuario::where('email','=',$email)->first();
        if(@$usuario->id != null) {
            $usuario->token_change_psw = $this->getToken(8);
            $usuario->save();
            $this->enviar_email($usuario->email, $usuario->nome, $usuario->token_change_psw);
            echo "<script language='javascript'> window.alert('Clique no link enviado para seu e-mail para a troca de senha.') </script>";
            return view('home');
        }
    }

    public function change_password(Request $request) {

        $token_change_psw = $request->token_change_psw;
        $usuario = usuario::where('token_change_psw','=',$token_change_psw)->first();
        if ($request->senha != $request->confirma_senha)
        {
            echo "<script language='javascript'> window.alert('Confima Senha incorreta') </script>";
            return redirect()->route('home');
        }
        if(@$usuario->id != null) {
            $usuario->token_change_psw = null;
            $usuario->senha = md5($request->senha);
            $usuario->save();
            echo "<script language='javascript'> window.alert('Senha alterada com sucesso.') </script>";
            return view('home');
        } else {
            return view('home');
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
            $mail->Subject = 'Esqueci minha Senha';
            $webhost = request()->getHttpHost();
            $url = 'http://'.$webhost.'/usuario/trocar_senha?token_change_psw='.$token;
            $mail->Body    = 'Clique em <a href="'.$url.'">'.$url.'</a> para efetuar a troca da senha.';
            $mail->AltBody = 'Clique em '.$url.' para efetuar a troca da senha.';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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

    private function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
}
