<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;



use App\Models\usuario;
use App\Models\cooperado;
use App\Models\operadora;
use App\Models\prodist;
use App\Models\emailconfig;
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
use Illuminate\Support\Facades\Validator;

class CooperadosController extends Controller
{
    //
    public function cooperados(){
        $cooperados = cooperado::all();
        return view('admin.cooperados', ['cooperados' => $cooperados]);
    }

    public function create(){
        return view('cooperados.create');
    }

    public function insert(Request $request) {
        $cooperado = new Cooperado();
        $cooperado->nome = $request->nome;
        $cooperado->nome = $request->nome;
        $cooperado->cep = $request->cep;
        $cooperado->endereco = $request->endereco;
        $cooperado->bairro = $request->bairro;
        $cooperado->sorteio = 2;
        $cooperado->tipo = 'cadastrado';
        $cooperado->save();
        return redirect()->route('cooperados');
    }
/*
    public function show($idcooperado) {
        $cooperado = cooperado::find($idcooperado);
        return view('cooperados.show', ['cooperado' => $cooperado]);
    }
*/
    public function detalhe($idcooperado) {
        $cooperado = cooperado::find($idcooperado);
        return view('admin.detalhe_cooperado', ['cooperado' => $cooperado]);
    }

    public function dashboard() {
        $cota_comprada_total = prodist::where('statusreg','=','F')->sum('cota_comprada');
        $cota_a_ser_comprada_total = prodist::where('statusreg','<>','F')->sum('cota_comprada');
        $cota_comprada_total_alto_consumo = prodist::where('statusreg','=','F')
                                                            ->join('tabcooperado','tabprodist.idcooperadoprodist', '=', 'tabcooperado.id')
                                                            ->where('tabcooperado.tipo_conta', '=', 'alto consumo')->sum('cota_comprada');
        $cota_a_ser_comprada_total_alto_consumo = prodist::where('statusreg','<>','F')
                                                            ->join('tabcooperado','tabprodist.idcooperadoprodist', '=', 'tabcooperado.id')
                                                            ->where('tabcooperado.tipo_conta', '=', 'alto consumo')->sum('cota_comprada');
        $cota_comprada_total_alto_consumo_grupo_conta_1 = prodist::where('statusreg','=','F')
                                                            ->join('tabcooperado','tabprodist.idcooperadoprodist', '=', 'tabcooperado.id')
                                                            ->where('tabcooperado.tipo_conta', '=', 'alto consumo')
                                                            ->where('tabcooperado.grupo_conta', '=', '1')
                                                            ->sum('cota_comprada');

        //$cooperado = cooperado::find($idcooperado);
        return view('cooperados.dashboard', compact('cota_comprada_total','cota_comprada_total_alto_consumo','cota_a_ser_comprada_total',
                                                'cota_a_ser_comprada_total_alto_consumo','cota_comprada_total_alto_consumo_grupo_conta_1'));
        //return view('dashboard');
    }

    public function editar( int $id_cooperado){
        @session_start();
        $params = request()->all();
        
        $operadoras = operadora::all(['id', 'nome']);
        
        $cooperado = cooperado::find($id_cooperado);
        $usuario = usuario::find($cooperado->usuario->id);
        //$usuario = usuario::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->first();
        $prodist = prodist::where('idcooperadoprodist','=',$id_cooperado)->first();
        //$prodist = prodist::where('id','=',$prodist->id)->first();
        $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
        $tipoconexao= tipoconexao::all(['tipo']);
        $tiporamal= tiporamal::all(['tipo']);
        $tipofontegeracao= tipofontegeracao::all(['tipo']);
        $periodicidade= periodicidade::all(['periodicidade','valor']);
        $meio_pagamento= meiopagamento::all(['meio_pagamento']);
        $periodicidademeiopagamento= periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
        $dia_vencimento = diadevencimento::all(['dia_vencimento']);
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
        /*
            if ($prodist->statusreg == 'F')
            {
                $readonly = "readonly";
            }
        */

        return view('admin.editar_cooperado', ['prodist' => $prodist], 
                                compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','periodicidade','meio_pagamento','periodicidademeiopagamento','readonly','arquivo_prodist_ico','arquivo_prodist','dia_vencimento')
                       );
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
        $validator = Validator::make($request->all(), [
            'codigo_uc' => ['nullable','max:20'],
            'classe_uc' => ['nullable', 'max:20'],
            'potencia_inst_uc' => ['nullable','numeric'],
            //'potencia_inst_gerada' => ['nullable','numeric'],
            'menor_consumo' => ['nullable', 'numeric'],
            'maior_consumo' => ['nullable', 'numeric'],
            'cota_comprada' => ['nullable', 'numeric'] 
        ]);

        if ($validator->fails())
        {
            @session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $usuario = usuario::find($id_usuario);
            $cooperado = cooperado::find($usuario->cooperado->id);
            //$prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();
            $prodist = prodist::where('id','=',$id)->first();
            $operadoras = operadora::all(['id', 'nome']);
            $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
            $tipoconexao= tipoconexao::all(['tipo']);
            $tiporamal = tiporamal::all(['tipo']);
            $tipofontegeracao= tipofontegeracao::all(['tipo']);
            $periodicidade= periodicidade::all(['periodicidade','valor']);
            $meio_pagamento= meiopagamento::all(['meio_pagamento']);
            $periodicidademeiopagamento= periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
            //return redirect()->back()->withErrors($validator)->withInput();
            $dia_vencimento = diadevencimento::all(['dia_vencimento']);
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
            /*
                if ($prodist->statusreg == 'F')
                {
                    $readonly = "readonly";
                }
                */

            return view('cooperados.edit', ['prodist' => $prodist], 
                                compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','periodicidade','meio_pagamento','periodicidademeiopagamento','arquivo_prodist','arquivo_prodist_ico','readonly','dia_vencimento')
                       )->withErrors($validator);
        }

        

        if($request->btn_submit == 'imprimir')
        {
            echo "<script language='javascript'> window.print(); </script>";
            $operadoras = operadora::all(['id', 'nome']);
            $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
            $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
            $tipoconexao= tipoconexao::all(['tipo']);
            $tiporamal= tiporamal::all(['tipo']);
            $tipofontegeracao= tipofontegeracao::all(['tipo']);
            $periodicidade= periodicidade::all(['periodicidade','valor']);
            $meio_pagamento= meiopagamento::all(['meio_pagamento']);
            $periodicidademeiopagamento= periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
            $readonly = "";
            $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
            $arquivo_prodist_ico = "null_icon.png";
            $arquivo_prodist = "null_icon.png";
            $dia_vencimento = diadevencimento::all(['dia_vencimento']);
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
            /*
                if ($prodist->statusreg == 'F')
                {
                    $readonly = "readonly";
                }
            */

            return view('admin.editar_cooperados', ['prodist' => $prodist], 
                                compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','periodicidade','meio_pagamento','periodicidademeiopagamento','arquivo_prodist','arquivo_prodist_ico','readonly','dia_vencimento')
                       );
        }

        $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();

        $target_dir = "/var/www/coopeere/uploads/";
        
        try {
   
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error'])
            ) {
                throw new Exception('Parâmetro inválido.');
            }
        
            // Check $_FILES['upfile']['error'] value.
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
                    throw new Exception('Erro desconhecido.');
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
        } catch (Exception $e) {
        
            @session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $usuario = usuario::find($id_usuario);
            $cooperado = cooperado::find($usuario->cooperado->id);
            //$prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();
            //$prodist = $request->old('prodist');
            $operadoras = operadora::all(['id', 'nome']);
            $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
            $tipoconexao= tipoconexao::all(['tipo']);
            $tiporamal = tiporamal::all(['tipo']);
            $tipofontegeracao= tipofontegeracao::all(['tipo']);
            $periodicidade= periodicidade::all(['periodicidade','valor']);
            $meio_pagamento= meiopagamento::all(['meio_pagamento']);
            $periodicidademeiopagamento= periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
            $dia_vencimento = diadevencimento::all(['dia_vencimento']);
            $readonly='';
            //return redirect()->back()->withErrors($validator)->withInput();
            return view('admin.editar_cooperados', ['prodist' => $prodist], 
                                compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','periodicidade','meio_pagamento','periodicidademeiopagamento','readonly','dia_vencimento')
                       )->withErrors($e->getMessage());
        
        }

        $cooperado->meio_pagamento = $request->meio_pagamento;
        $cooperado->periodicidade = $request->periodicidade;
        $cooperado->idoperadora = $request->idoperadora;
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
        $cooperado->save();

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
                $operadoras = operadora::all(['id', 'nome']);
                $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
                $tipoconexao= tipoconexao::all(['tipo']);
                $tiporamal = tiporamal::all(['tipo']);
                $tipofontegeracao= tipofontegeracao::all(['tipo']);
                $periodicidade= periodicidade::all(['periodicidade','valor']);
                $meio_pagamento= meiopagamento::all(['meio_pagamento']);
                $periodicidademeiopagamento= periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
                $dia_vencimento = diadevencimento::all(['dia_vencimento']);
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
                $readonly = "";
                // Formulario fechado
                /*
                    if ($prodist->statusreg == 'F')
                    {
                        $readonly = "readonly";
                    }
                */
    
                return view('admin.editar_cooperados', ['prodist' => $prodist], 
                                compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','periodicidade','meio_pagamento','periodicidademeiopagamento','arquivo_prodist','arquivo_prodist_ico','readonly','dia_vencimento')
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
            
            
        }
        $cooperado->save();

        if($request->btn_submit == 'deletar') {
            echo "<script language='javascript'> window.alert('Não será mais possivel que o usuário entre na conta do coopeere.') </script>";
            $prodist->statusreg = 'D';
            $cooperado->tipo = 'deletado';
            $cooperado->save();
            $prodist->save();
            return view('home');
        }

        $prodist->save();
        $operadoras = operadora::all(['id', 'nome']);
        $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
        $tipoconexao= tipoconexao::all(['tipo']);
        $tiporamal= tiporamal::all(['tipo']);
        $tipofontegeracao= tipofontegeracao::all(['tipo']);
        $periodicidade= periodicidade::all(['periodicidade','valor']);
        $meio_pagamento= meiopagamento::all(['meio_pagamento']);
        $periodicidademeiopagamento= periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
        $dia_vencimento = diadevencimento::all(['dia_vencimento']);
        $readonly = "";
        // Formulario fechado
        /*
            if ($prodist->statusreg == 'F')
            {
                $readonly = "readonly";
            }
            */
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

            return view('admin.editar_cooperados', ['prodist' => $prodist], 
                                compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','periodicidade','meio_pagamento','periodicidademeiopagamento','arquivo_prodist','arquivo_prodist_ico','readonly','dia_vencimento')
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
        $operadoras = operadora::all(['id', 'nome']);
        $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
        $tipoconexao= tipoconexao::all(['tipo']);
        $tiporamal = tiporamal::all(['tipo']);
        $tipofontegeracao= tipofontegeracao::all(['tipo']);
        $periodicidade= periodicidade::all(['periodicidade','valor']);
        $meio_pagamento= meiopagamento::all(['meio_pagamento']);
        $periodicidademeiopagamento= periodicidademeiopagamento::all(['periodicidade','meio_pagamento','valor']);
        //return redirect()->back()->withErrors($validator)->withInput();
        $dia_vencimento = diadevencimento::all(['dia_vencimento']);
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
        return view('admin.editar_cooperados', ['prodist' => $prodist], 
           compact('cooperado','operadoras','tensaoatendimento','tipoconexao','tiporamal','tipofontegeracao','periodicidade','meio_pagamento','periodicidademeiopagamento','readonly','arquivo_prodist','arquivo_prodist_ico','id','dia_vencimento')
        );
     }


    public function delete(cooperado $cooperado){
        //$cooperado->delete();
        $cooperado = cooperado::find($cooperado->id);
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        $usuario = usuario::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->first();

        if(@$prodist->id != null) {
            $arquivo = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_conta', '<>', null)->first();
            if (@$arquivo != null)
            {
                unlink($arquivo->doc_conta); 
                $arquivo->delete();
            }
            $arquivos = arquivo::where('cpf_cnpj','=',$cooperado->cpf_cnpj)->where('doc_comprovante', '<>', null);
            if (@$arquivos != null)
            {
                foreach ($arquivos as $arquivo) {
                    unlink($arquivo->doc_conta); 
                    $arquivo->delete();
                }
            }
            $prodist->delete();
        }
        if(@$usuario->id != null) {
            $usuario->delete();
        }
        if(@$cooperado->id != null) {
            $cooperado->delete();
        }
        return redirect()->route('admin.cooperados');
     }

     public function undelete($id){
        $cooperado = cooperado::find($id);
        //$prodist = prodist::where('idcooperadoprodist','=',$usuario->cooperado->id)->first();
        
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();

        if (@$prodist->id != null) {

            if ($prodist->statusreg == 'D') {
                $prodist->statusreg = 'E';
            }
            if ($cooperado->tipo == 'deletado')
            {
                $cooperado->tipo = 'cooperado';
            }
            $prodist->save();
        } else {

            if ($cooperado->tipo == 'deletado')
            {
                $cooperado->tipo = 'cadastrado';
            }
        }
        $cooperado->save();
        
        return redirect()->route('admin.cooperados');
     }

     public function modal($id){
        //$cooperados = cooperado::orderby('idcooperado')->paginate();
        $cooperados = cooperado::all();
        return view('admin.cooperados', ['cooperados' => $cooperados, 'id' => $id]);

     }


     public function show($idcooperado) {
        @session_start();
        $look = array( "/",".", "-", "(", ")" ," ");
        $params = request()->all();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = usuario::find($id_usuario);
        $cooperado = cooperado::find($usuario->cooperado->id);
        $prodist = prodist::where('idcooperadoprodist','=',$cooperado->id)->first();
        $tensaoatendimento = tensaoatendimento::all(['tensao_atendimento']);
        $tipoconexao= tipoconexao::all(['tipo']);
        $tiporamal= tiporamal::all(['tipo']);
        $tipofontegeracao= tipofontegeracao::all(['tipo']);


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

        $this->tag_codigo_uc($pdf, $codigo_uc);
        $this->tag_classe_uc($pdf, $classe_uc);
        $this->tag_titular_uc($pdf, $titular_uc);
        $this->tag_rua_av($pdf, $rua_av);
        $this->tag_numero($pdf, $numero);
        $this->tag_cep($pdf, $cep);
        $this->tag_bairro($pdf, $bairro);
        $this->tag_cidade($pdf, $cidade_uf);
        $this->tag_email($pdf, $email);
        $this->tag_telefone($pdf, $telefone_fixo);
        $this->tag_celular($pdf, $telefone_celular);
        $this->tag_cidade($pdf, $cidade_uf);
        $this->tag_cpf_cnpj($pdf, $cpf_cnpj);
        $this->tag_potencia_instalada_uc_kw($pdf, $potencia_instalada_uc_kw);
        $this->tag_tensao_atendimento($pdf, $tensao_atendimento);
        $this->tag_tipo_conexao($pdf, $tipo_conexao); 

        $this->tag_tipo_ramal($pdf, $tipo_ramal);

        $this->tag_potencia_instalada_geracao_kw($pdf,$potencia_instalada_geracao_kw);
        $this->tag_tipo_fonte_geracao($pdf, $tipo_fonte_geracao);

        $pdf->Output('I', 'formulario_prodist.pdf');

    }

    private function mask($val, $mask)
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

    private function tag_codigo_uc($pdf, $codigo_uc) 
    {
        $pdf->SetXY(67+3, 75-7);
        $pdf->Write(0, $codigo_uc);
    }

    private function tag_classe_uc($pdf, $classe_uc) 
    {
        $pdf->SetXY(118, 75-7);
        $pdf->Write(0, $classe_uc);
    }

    private function tag_titular_uc($pdf, $titular_uc) 
    {
        $pdf->SetXY(66+3, 79-7);
        $str = iconv('UTF-8', 'windows-1252', $titular_uc);
        $pdf->Write(0, $str);
    }

    private function tag_rua_av($pdf, $rua_av) 
    {
        $pdf->SetXY(57+4, 84-8);
        $str = iconv('UTF-8', 'windows-1252', $rua_av);
        $pdf->Write(0, $str);
    }

    private function tag_numero($pdf, $numero) 
    {
        $pdf->SetXY(132-3, 84-8);
        $pdf->Write(0, $numero);
    }

    private function tag_cep($pdf, $cep) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $str = str_replace($look, "", $cep);
        $pdf->SetXY(153+1, 84-8);
        $str2 = $this->mask($str,'#####-###');
        $pdf->Write(0, $str2);
    }

    private function tag_bairro($pdf, $bairro) 
    {
        $pdf->SetXY(54+4, 88-8);
        $str = iconv('UTF-8', 'windows-1252', $bairro);
        $pdf->Write(0, $str);
    }

    private function tag_cidade($pdf, $cidade) 
    {
        $pdf->SetXY(130-4, 88-8);
        $str = iconv('UTF-8', 'windows-1252', $cidade);
        $pdf->Write(0, $str);
    }

    private function tag_email($pdf, $email) 
    {
        $pdf->SetXY(54+5, 92-8);
        $pdf->Write(0, $email);
    }

    private function tag_telefone($pdf, $telefone) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $tel = str_replace($look, "", $telefone);
        $ddd = substr($tel,0,2);
        $num = substr($tel,2);
        $pdf->SetXY(61+3, 97-9);
        $pdf->Write(0, $ddd);
        $pdf->SetXY(67+3, 97-9);
        if (strlen($num) > 8)
        {
            $str = $this->mask($num,'#####-####');
            $pdf->Write(0, $str);
        } else {
            $str = $this->mask($num,'####-####');
            $pdf->Write(0, $str);
        }
    }

    private function tag_celular($pdf, $celular) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $tel = str_replace($look, "", $celular);
        $ddd = substr($tel,0,2);
        $num = substr($tel,2);
        $pdf->SetXY(120-2, 97-9);
        $pdf->Write(0, $ddd);
        $pdf->SetXY(127-2, 97-9);
        if (strlen($num) > 8)
        {
            $str = $this->mask($num,'#####-####');
            $pdf->Write(0, $str);
        } else {
            $str = $this->mask($num,'####-####');
            $pdf->Write(0, $str);
        }
    }

    private function tag_cpf_cnpj($pdf, $cpf_cnpj) 
    {
        $look = array( "/",".", "-", "(", ")" ," ");
        $str = str_replace($look, "", $cpf_cnpj);
        if (strlen($str) == 11){
        $str = $this->mask($str,'###.###.###-##');
        } else {
        $str = $this->mask($str,'##.###.###/####-##');
        }
        $pdf->SetXY(62+4, 101-9);
        $pdf->Write(0, $str);
    }

    private function tag_potencia_instalada_uc_kw($pdf, $potencia_instalada_uc_kw) 
    {
        $pdf->SetXY(80+4, 110-10);
        $pdf->Write(0, $potencia_instalada_uc_kw);
    }

    private function tag_tensao_atendimento($pdf, $tensao_atendimento) 
    {
        $pdf->SetXY(160-3, 110-10);
        $pdf->Write(0, $tensao_atendimento);
    }

    private function tag_tipo_conexao($pdf, $tipo_conexao) 
    {
        if ($tipo_conexao == 'monofásica')
        {
            $pdf->SetXY(97, 114-10);
        }
        if ($tipo_conexao == 'bifásica')
        {
            $pdf->SetXY(126-2, 114-10);
        }
        if ($tipo_conexao == 'trifásica')
        {
            $pdf->SetXY(154-4, 114-10);
        }
        $pdf->Write(0, 'X');
    }

    private function tag_tipo_ramal($pdf, $tipo_ramal)
    {
        if ($tipo_ramal == 'aéreo')
        {
            $pdf->SetXY(81, 108);
        }
        if ($tipo_ramal == 'subterrâneo')
        {
            $pdf->SetXY(129, 108);
        }
        $pdf->Write(0, 'X');

    } 

    private function tag_potencia_instalada_geracao_kw($pdf, $potencia_instalada_geracao_kw) 
    {
        $pdf->SetXY(104, 123-7);
        $pdf->Write(0, $potencia_instalada_geracao_kw);
    }

    private function tag_tipo_fonte_geracao($pdf, $tipo_fonte_geracao) 
    {
        if ($tipo_fonte_geracao == 'hidráulica')
        {
            $pdf->SetXY(60+3, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'solar')
        {
            $pdf->SetXY(81+2, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'eólica')
        {
            $pdf->SetXY(103, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'biomassa')
        {
            $pdf->SetXY(131-3, 131-8);
            $pdf->Write(0, 'X');
        }
        else if ($tipo_fonte_geracao == 'cogeração qualificada')
        {
            $pdf->SetXY(180-8, 131-8);
            $pdf->Write(0, 'X');
        } else {
            $pdf->SetXY(76+2, 136-9);
            $pdf->Write(0, $tipo_fonte_geracao);
        }
    }
}
