@extends('layouts.template')
@section('title', 'Editar Cooperado')
@section('content')

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<div class="container mt-4">
    @empty($prodist)
    <form method="GET" action="{{route('prodist.change_operator',$cooperado)}}">
        @csrf
        
            <input type="hidden" name="id" value="{{$cooperado->id}}">
            <input type="hidden" name="tipo" value="{{$cooperado->tipo}}">
            <input type="hidden" name="tipo_conta" value="{{$cooperado->tipo_conta}}">
            <input type="hidden" name="sorteio" value="{{$cooperado->sorteio}}">
            <input type="hidden" name="status" value="{{$cooperado->status}}">
            <input type="hidden" name="idusuario" value="{{$cooperado->usuario->id}}">
             <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="" name="nome" readonly value="{{$cooperado->nome}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cpf_cnpj">CPF/CNPJ</label>
                        <input type="text" class="form-control cpfcnpj_mask" id="cpf_cnpj" readonly name="cpf_cnpj" value="{{$cooperado->cpf_cnpj}}" size="15" required>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="form-group">
                <label for="operadora">Operadora</label>
                <select class="form-control" id="idoperadora" name="idoperadora">
                  @foreach($operadoras as $item)
                    <?php $selected = '';
                    if($item->id == $cooperado->operadora->id)
                    {
                        $selected = 'selected';
                    }
                    ?>
                    <option value="{{$item->id}}" {{$selected}} >{{$item->nome}}</option>
                  @endforeach
                </select>
            </div>
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
    </form>
    @endempty

    @if ($_SESSION['nivel_usuario'] == 'user')

    <?php
    if ($cooperado->operadora->id > 1) {
        if ($prodist == null) {
    $mensagem_prodist = "Tenho uma conta ".$cooperado->operadora->nome." em meu nome. (Cadastre-se com os dados desta conta ). Mantenha-se em dia com suas mensalidades para obter sua cota de energia escolhida no Formulário PRODIST e participar de todos os nossos sorteios. Apenas R$ 2,00 (dois reais por mês). " ;
    $mensagem_prodist = "Tenho uma conta ".$cooperado->operadora->nome." em meu nome. (Preencha o formulário PRODIST ANEEL com os dados desta conta). Mantenha-se em dia com suas mensalidades para obter sua cota de energia escolhida no Formulário PRODIST que irá preencher e participar de todos os nossos sorteios. Apenas R$ 3,50 por mês (Três reais e cinquenta centavos). Ao entrar em sua conta, clique no botão ´´Gerar Link Convite`` e convide seus amigos e fature 20% dos prêmios todas as vezes que eles forem sorteados. Seus amigos devem ter uma conta de energia em seus nomes, ou se não tem, devem seguir nossas regras de cadastro para os não titulares de conta de energia.";
    ?>
    <div class="row" id="prodist_form">
        <div class="form-group">
        <label for="minha_conta"><?php echo $mensagem_prodist; ?></label><br/>
            <a class="btn btn-primary btn-lg" href="{{route('prodist.inserir')}}" role="button">Preencher Formulário Prodist</a>
        </div>
    </div>
    <?php 
        } else {
    ?>
    <div class="row" id="prodist_form">
        <div class="form-group">
        <label for="minha_conta">Reeditar cadastro Prodist</label><br/>
            <a class="btn btn-primary btn-lg" href="{{route('prodist.editar')}}" role="button">Reeditar</a>
        </div>
    </div>
    <?php
        }
    } else {
        $mensagem_apoiador = "Não sou titular de uma conta, mas me cadastrarei com o Link convite que me foi enviado ou o farei sem convite por livre e espontânea vontade para apoiar a cooperativa. (você será um Cooperado Apoiador)." ;
        ?>
        <div class="row" id="prodist_form">
            <div class="form-group">
            <label for="minha_conta"><?php echo $mensagem_apoiador; ?></label><br/>
                
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="form-group">
        <label for="minha_conta">Não tenho uma conta de energia em meu nome. Convide seus amigos e fature 20% dos prêmios todas as vezes que eles forem sorteados.</label><br/>
            <a class="btn btn-primary btn-lg" href="{{route('prodist.convidar')}}" role="button">Gerar Link Convite</a>
        </div>
    </div>
    @isset($cooperado->token_convite)
    <div class="row">
        <div class="form-group">
            <label for="minha_conta">Link the convite para seu amigo:</label><br/>
            http://{{request()->getHttpHost()}}/precadastro/inserir?token_convite={{$cooperado->token_convite}}
        </div>
    </div>
    @endisset
    @endif
</div>
@endsection
