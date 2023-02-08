{{-- @section('title', 'Reeditar Formulário Cooperado') --}}
@extends('layouts.template')
{{--@extends('admin_layout.admin')--}}
@section('content')
<?php /*
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
*/  ?>
<style  type="text/css">
    /* Style the form */
    #regForm {
     background-color: #ffffff;
     margin: 100px auto;
     padding: 40px;
     width: 70%;
     min-width: 300px;
   }
   
   /* Style the input fields */
   input {
     padding: 10px;
     width: 100%;
     font-size: 17px;
     font-family: Raleway;
     border: 1px solid #aaaaaa;
   }
   
   /* Mark input boxes that gets an error on validation: */
   input.invalid {
     background-color: #ffdddd;
   }
   
   /* Hide all steps by default: */
   .tab {
     display: none;
   }
   
   /* Make circles that indicate the steps of the form: */
   .step {
    height: 20px;
    width: 20px;
    margin: 4px 4px;
    margin-top:6px;
    padding-left: 20px;
    margin-right: 90px;
    font-size: 14px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
    cursor:pointer;
    
   }
   
   /* Mark the active step: */
   .step.active {
     opacity: 1;
   }
   
   /* Mark the steps that are finished and valid: */
   .step.finish {
    /*background-color: #bbbbbb;*/
    background-color: #04AA6D;
   } 
</style>
<script type="text/javascript">
/*
window.location.hash = "no-back-button";

// Again because Google Chrome doesn't insert
// the first hash into the history
window.location.hash = "Again-No-back-button"; 

window.onhashchange = function(){
    window.location.hash = "no-back-button";
}
*/
</script>

<?php
if(!isset($id)){
  $id = ""; 
}
?>

<div style="text-align:center;margin-bottom:20px;margin-left:40px;">
    <!-- Informações Pessoais # 
        Informações Preenchimento #  
        Triagem # Formulário PRODIST # 
        Pagamento # Regulamento, Sorteios e Convite-->
        <table>
            <tr><td class="step" onclick="showCurrentTab(0)">&nbsp;Informações Pessoais</td>
                <td class="step" onclick="showCurrentTab(1)">&nbsp;Informações Preenchimento</td>
                <td class="step" onclick="showCurrentTab(2)">&nbsp;Triagem</td>
                <td class="step" onclick="showCurrentTab(3)">&nbsp;Formulário PRODIST</td>
                <td class="step" onclick="showCurrentTab(4)">&nbsp;Forma de Pagamento</td>
                <td class="step" onclick="showCurrentTab(5)">&nbsp;Regulamento</td>
                <td class="step" onclick="showCurrentTab(6)">&nbsp;Sorteio</td>
                <td class="step" onclick="showCurrentTab(7)">&nbsp;Convite</td></tr>
        </table>
</div>
<div class="container mt-4">
    <form method="POST" id="regForm" action="{{route('cooperados.editar',$cooperado)}}"  enctype="multipart/form-data">
        @csrf
        @method('post')
        <input type="hidden" value="{{$cooperado->id}}" name="id">
        <input type="hidden" id="form_tab" value="" name="form_tab">
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <fieldset class="fieldset">
        <div class="tab">
        <h3>1 - Informações Pessoais</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Número do Cooperado</label>
                    <input type="text" class="form-control" id="" readonly  name="id" value="{{$cooperado->id}}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="" readonly  name="nome" value="{{$cooperado->nome}}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cpf_cnpj">CPF/CNPJ</label>
                    <input type="text" class="form-control" readonly id="cpfcnpj" name="cpf_cnpj" value="{{$cooperado->cpf_cnpj}}" size="15" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" readonly id="cep" name="cep"  value="{{$cooperado->cep}}" size="10" required >
                </div>
            </div>
        </div>
        <fieldset class="inscricaofieldset">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="incricaoestadual">Inscrição Estadual</label>
                        <input readonly type="text" class="form-control" id="inscricaoestadual" name="inscricao_estadual" size="20"  value="{{$cooperado->inscricao_estadual }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inscricaomunicipal">Inscrição Municipal</label>
                        <input readonly type="text" class="form-control" id="inscricaomunicipal" name="inscricao_municipal"  size="20" value="{{ $cooperado->inscricao_municipal }}">
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">   
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" readonly id="endereco" name="endereco" value="{{$cooperado->endereco}}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" readonly id="numero" name="numero" value="{{$cooperado->numero}}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" readonly id="bairro" name="bairro" value="{{$cooperado->bairro}}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" readonly id="cidade" name="cidade" value="{{$cooperado->cidade}}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" readonly id="estado" name="estado"  value="{{$cooperado->estado}}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefone_celular">Telefone Celular</label>
                    <input type="text" readonly class="form-control" id="fone1" name="telefone_celular"  value="{{$cooperado->usuario->telefone_celular}}"   size="16" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefone_fixo">Telefone Fixo</label>
                    <input type="text" readonly class="form-control" id="fone2" name="telefone_fixo"  value="{{$cooperado->usuario->telefone_fixo}}"   size="16">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Email</label>
                    <input type="text" class="form-control" readonly id="" name="email" readonly value="{{$cooperado->usuario->email}}" required>
                </div>
            </div>
        </div>
        
        </div>
        <div class="tab">
            <h3>2 -  Informações de Preenchimento</h3>
            <p>
            Pedimos que use as funções a seguir durante o preenchimento: 
            </p>
            <p>
            A função ´´Enviar`` deverá ser utilizada somente quando todo formulário estiver preenchido e ao menos uma mensalidade for paga clicando no último item da barra de opções. Havendo necessidade de mudança nos dados enviados, clique na função ´´Reeditar`` e todas as lacunas de preenchimento estarão aptas a serem modificadas. Um link será enviado para o e-mail ou um código para o celular. Siga as instruções. 
            </p>
            <p>
            A função ´´Salvar`` poderá ser utilizada a qualquer momento durante o preenchimento e assim garantir o que já foi preenchido não será perdido. Usando esta função, você poderá concluir o preenchimento novamente quando desejar. 
            </p>
            <p>
            A função ´´Visualizar/Imprimir`` encontrará o Formulário PRODIST  padrão ANEEL pag. 73. Será neste formulário que enviaremos seus dados a Distribuidora de Energia responsável pelo seu município. 
            </p>
            <p>
            A  função ´´Reeditar`` Clique em reeditar quando for fazer alterações nos dados já enviados a cooperativa. Será enviado um link para o e-mail usado no ato do cadastro. No caso de mudança de celular, será necessário o envio de link para o mesmo e-mail usado no cadastro. Mudança de e-mail enviaremos código via SMS para o celular usado no ato do cadastro. 
            </p>
            <p>
            A função ´´Deletar`` conta. Clique em deletar conta para remover todos seus dados e sair da cooperativa. Agradecemos se deixar um feedback sobre as razões de sua saída.
            </p>

            
        </div>
    
        <div class="tab">
            <fieldset class="fieldset">
            <h3>3 - Triagem</h3>
            <div class="row">
                <div class="col-md-12">
                <p for="operadora">Escolha a sua distribuidora (de acordo com sua conta de luz):</p>
                </div>
            </div>

            @foreach($operadoras as $item)

            <div class="form-row ">
            <?php $checked = '';

            if($item->id == $cooperado->operadora->id)
            {
                $checked = 'checked';
            }
            ?>
            <div class="col-sm-1">
            <input  class="form-check-input"  type="radio" id="operadora{{$item->id}}" {{$checked}} name="idoperadora" value="{{$item->id}}">
            </div>

            <div class="col-sm-4">
                <label class="form-check-label"  for="operadora{{$item->id}}" id="operadora{{$item->id}}_nome">{{$item->nome}}</label>
            </div>
            </div>
            @endforeach
                  <br/>
                  <br/>
                    <?php 
                    $checked_titular = '';
                    $checked_ntitular = '';
                    if($cooperado->eh_titular)
                    {
                        $checked_titular = 'checked';
                    } else {
                        $checked_ntitular = 'checked';
                    }
                    ?>
                    
                    <div class="form-row align-items-left">
                        <div class="col-sm-1">
                            <input  class="form-check-input" type="radio" id="ntitular" {{$checked_ntitular}} name="eh_titular" value="false">&nbsp;
                        </div>
                        
                        <div class="col-sm-12">                         
                            <label class="form-check-label"  for="titular" id="mensagem_triagem_ntitular"></label>
                        </div>
                        <div class="col-sm-1">
                            <input  class="form-check-input" type="radio" id="titular" {{$checked_titular}} name="eh_titular" value="true">&nbsp;
                        </div>
                        
                        <div class="col-sm-12">
                            <label class="form-check-label"  for="titular" id="mensagem_triagem_titular"></label>
                        </div>
                        
                    </div>
                    

            </fieldset>
            @if($readonly != "readonly")
              <button title="Salvar formulário Prodist" type="submit" name="btn_submit" value="salvar" class="btn btn-primary">Salvar</button>
            @endif
        </div>
        <div class="tab">
        <h3>3 - Formulário PRODIST</h3>
            <h5>1 - Identificação da Unidade Consumidora</h5>
            <div class="row">
                <div class="form-group">
                    <label for="codigo_uc">Código UC/Número do Cliente</label>
                    <input type="text" class="form-control" readonly id="codigo_uc"  name="codigo_uc" size="15" value="{{$prodist->codigo_uc ?? ''}}" title="Código da Unidade Consumidora ou Número do Cliente na sua conta" >
                  </div>
            </div>
            <div class="row">
                  <div class="form-group">
                    <label for="classe_uc">Classe UC</label>
                    <input type="text" class="form-control"  readonly id="classe_uc" name="classe_uc" size="15" value="{{$prodist->classe_uc ?? ''}}"  title="Classe da Unidade Consumidora">
                  </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="maior_consumo">Upload da conta de luz (últimos 3 meses)</label>
                    <a target="_blank" href="/uploads/{{$arquivo_prodist ?? 'null_icon.png'}}"><img src="/uploads/{{$arquivo_prodist_ico ?? 'null_icon.png'}}" height="128"  width="128" /></a>
                    <input type="file" name="upfile" id="arquivo">       
                </div>
            </div>
            <h5>2 - Dados da Unidade Consumidora</h5>
            <div class="row">
                <div class="form-group">
                    <label for="cota_comprada">Cota (em kWh) que deseja comprar mensalmente.</label>
                    <input  readonly type="text" class="form-control" id="cota_comprada" name="cota_comprada"  value="{{$prodist->cota_comprada ?? ''}}"  size="15" title="Cota (em kWh) que deseja comprar mensalmente da cooperativa. Preço estimado em 50% menor do que a operadora.">
                  </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="potencia_inst_uc">Potência instalada (kW)</label>
                    <input type="text" class="form-control"  readonly id="potencia_inst_uc" name="potencia_inst_uc" value="{{$prodist->potencia_inst_uc ?? ''}}" size="15" title="Em função da Cota, ou seja, potência instalada = cota/360">
                  </div>
            </div>
            <div class="row">
                  <div class="form-group">
                    <label for="tensao">Tensão de atendimento (V)             </label>
                    <br/>
                    @foreach($tensaoatendimento as $item)
                    <?php $checked = '';
                    if (!empty($prodist)) {
                        if($item->tensao_atendimento == $prodist->tensao_atendimento)
                        {
                            $checked = 'checked';
                        }
                    }
                    ?>
                    
                    <label for="tensao{{$item->tensao_atendimento}}"><input  {{$readonly}} type="radio" id="tensao{{$item->tensao_atendimento}}" {{$checked}} name="tensao_atendimento" value="{{$item->tensao_atendimento}}">{{$item->tensao_atendimento}}V</label>
                
                    @endforeach
                  </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="tipo_conexao">Tipo de conexão</label>
                    <select  {{$readonly}} name="tipo_conexao" id="tipo_conexao" title="Esta informação tem em sua conta de energia.">
                        @foreach($tipoconexao as $item)
                        <?php $selected = '';
                        if (!empty($prodist)) {
                            if($item->tipo == $prodist->tipo_conexao)
                            {
                                $selected = 'selected';
                            }
                        }
                        ?>
                        <option value="{{$item->tipo}}" {{$selected}} >{{$item->tipo}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="tipo_ramal">Tipo de Ramal</label>
                    <select  {{$readonly}} name="tipo_ramal" id="tipo_ramal" title="A energia chega até você via postes ou debaixo da terra?">
                        @foreach($tiporamal as $item)
                        <?php $selected = '';

                        if (!empty($prodist)) {
                            if($item->tipo == $prodist->tipo_ramal)
                            {
                                $selected = 'selected';
                            }
                        }
                        ?>
                        <option value="{{$item->tipo}}" {{$selected}} >{{$item->tipo}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
            <h5>3 - Dados da Geração</h5>

            <div class="row">
                <div class="form-group">
                    <label for="potencia_inst_gerada">Potencia instalada (kW) gerada</label>
                    <input type="text" class="form-control" id="potencia_inst_gerada" name="potencia_inst_gerada" value="{{$prodist->potencia_inst_gerada ?? ''}}" size="15">
                  </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="tipo_fonte_geracao">Tipo da Fonte de Geração</label>
                    <select  name="tipo_fonte_geracao" id="tipo_fonte_geracao" title="Tipo da Fonte de Geração, o padrão é eólica.">
                        @foreach($tipofontegeracao as $item)
                        <?php $selected = '';
                        if (!empty($prodist)) {
                            if($item->tipo == $prodist->tipo_fonte_geracao)
                            {
                                $selected = 'selected';
                            }
                        }
                            ?>
                        <option value="{{$item->tipo}}" {{$selected}} >{{$item->tipo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group" >
                    <label for="menor_consumo">Menor consumo (em kWh) dos últimos 12 meses</label>
                    <input readonly type="text" class="form-control" id="menor_consumo" name="menor_consumo"  value="{{$prodist->menor_consumo ?? ''}}"  size="15" title="Menor consumo (em kWh) dos últimos 12 meses" >
                  </div>
            </div>

            <div class="row">
                <div class="form-group" >
                    <label for="maior_consumo">Maior consumo (em kWh) dos últimos 12 meses</label>
                    <input readonly type="text" class="form-control" id="maior_consumo" name="maior_consumo" size="15"  value="{{$prodist->maior_consumo ?? ''}}"   title="Maior consumo (em kWh) dos últimos 12 meses" >
                  </div>
            </div>


            @if($readonly != "readonly")
              <button title="Enviar formulário Prodist de forma permanente" type="submit" name="btn_submit" value="enviar" class="btn btn-primary">Enviar</button>
              @endif
              @isset($prodist) 
              <a target="_blank" class="btn btn-primary" title="Visualizar/Imprimir formulário Prodist" href="{{route('prodist.show', $prodist->id)}}">Visualizar</a>
              @endisset
              
              <?php
              //<button title="Deletar de forma permanente registro do usuário no sistema" type="submit" name="btn_submit" value="deletar" class="btn btn-primary">Deletar</button>
              ?>
              <a title="Deletar conta" href="{{route('prodist.modal_status', $cooperado)}}"><i class="fas fa-trash text-danger mr-1">Deletar Conta</i></a>
              @if($readonly != "readonly")
              <button title="Salvar formulário Prodist" type="submit" name="btn_submit" value="salvar" class="btn btn-primary">Salvar</button>
              @endif
              
        </div>
    
        <div class="tab">
        <h3>5 - Forma de Pagamento</h3>

                <?php 
                    $checkedi = '';
                    $i= 0;
                    $j = 0;
                ?>

                @foreach($periodicidade as $itemi)
                
                <?php 
                $checkedi = '';
                if($itemi->periodicidade == $cooperado->periodicidade)
                {
                    $checkedi = 'checked';
                }
                $checkedj = '';
                $j = 0; 
                ?>
                
                <div class="form-row">
                    <div class="col-sm-1">
                        <input  class="form-check-input" {{$readonly}} type="radio" id="periodicidade_{{$i}}" {{$checkedi}} name="periodicidade" value="{{$itemi->periodicidade}}"/>
                    </div>
                    
                        <label for="periodicidade_{{$i}}"  >{{$itemi->periodicidade}} - {{$itemi->valor}}</label>
                    
                </div>
                
                <fieldset id="fieldset_{{$itemi->periodicidade}}">
                    @foreach($meio_pagamento as $itemj)
                    
                        @foreach($periodicidademeiopagamento as $itemk)
                        <?php 
                        
                        ?>
                            @if (($itemi->periodicidade == $itemk->periodicidade) && ($itemj->meio_pagamento == $itemk->meio_pagamento))

                            <?php
                            $checkedj = ''; 
                            if($itemi->periodicidade == $cooperado->periodicidade && $itemk->meio_pagamento == $cooperado->meio_pagamento)
                            {
                                $checkedj = 'checked';
                                
                            } 
                            ?>
                            
                            <div class="form-row">
                                <div class="col-sm-1">
                                    &nbsp;&nbsp;&nbsp;<input   class="form-check-input" {{$readonly}} type="radio" id="periodicidade_{{$i}}_meio_pagamento_{{$j}}" {{$checkedj}} name="meio_pagamento" value="{{$itemj->meio_pagamento}}"/>
                                </div>
                                
                                    <label  for="meio_pagamento_{{$j}}" >{{$itemj->meio_pagamento}}</label>
                                
                            </div>
                            @endif
                        @endforeach 
                        <?php $j++; ?>
                    @endforeach
                </fieldset>
                <?php $i++; ?>
                @endforeach

                <div class="row">
                    <div class="form-group">
                        <label for="diavencimento">Dia de Vencimento</label>
                        <select readonly name="dia_vencimento" id="dia_de_vencimento"  title="Vencimento de sua conta Coopeere">
                            @foreach($dia_vencimento as $item)
                            <?php $selected = '';
                            if($item->dia_vencimento == $cooperado->dia_vencimento)
                            {
                                $selected = 'selected';
                            }
                            ?>
                            <option readonly value="{{$item->dia_vencimento}}" {{$selected}} >{{$item->dia_vencimento}}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                @if($readonly != "readonly")
                <button title="Salvar formulário Prodist" type="submit" name="btn_submit" value="salvar" class="btn btn-primary">Salvar</button>
                @endif
        </div>
        <div class="tab">
            <h3>6 - Regulamento</h3>
            
        </div>

        <div class="tab">
            <h3>7 - Sorteio</h3>
            
        </div>

        <div class="tab">
            <h3>8 - Convite</h3>
            <div class="row">
                <div class="form-group">
                <br/>
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
            @if($readonly != "readonly")
              <button title="Salvar formulário Prodist" type="submit" name="btn_submit" value="salvar" class="btn btn-primary">Salvar</button>
              @endif
        </div>
        
        <!-- Modal -->

        <div style="overflow:auto;">
            <div style="float:right;">

                
              <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)">Anterior</button>
              <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Próximo</button>

            </div>
        </div>
        
    </form>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deletar Conta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Deseja Realmente Excluir esta conta?
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <form method="POST" action="{{route('prodist.delete_status', $id)}}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php 
if(@$id != ""){
  echo "<script>$('#exampleModal').modal('show');</script>";
}
?>

<?php
    $i = 0; $j=0;
    $break = false;
    foreach($periodicidade as $itemi)  
    {   
            
        $checkedi = '';
        
        if($itemi->periodicidade == $cooperado->periodicidade)
        {
            $checkedi = 'checked';
            $periodicidade_i = "#periodicidade_".$i;
        }
        $checkedj = '';
        $j = 0;  
        foreach($meio_pagamento as $itemj)
        {
            foreach($periodicidademeiopagamento as $itemk)
            {
            $checkedj = '';
            
            
                if (($itemi->periodicidade == $itemk->periodicidade) && ($itemj->meio_pagamento == $itemk->meio_pagamento)) 
                {
                    if($itemk->meio_pagamento == $cooperado->meio_pagamento)
                    {
                        $checkedj = 'checked';
                        $meio_pagamento_j = "meio_pagamento_".$j;
                        $periodicidade_i = "#periodicidade_".$i;
                        $break = true;
                        break;
                    }
                }
            }
            if ($break)
            {
                break;
            }
            $meio_pagamento_j = "meio_pagamento_".$j;
            $j++;
        }
        if ($break) {
            break;
        } 
        $periodicidade_i = "#periodicidade_".$i;
        $i++; 
        
    }
    
?>

<script>

<?php 


$i = 0;
foreach($periodicidade as $itemi)  
{   
        
    $nonei = 'none';
    $fieldset = "fieldset_".$itemi->periodicidade;

    if($itemi->periodicidade == $cooperado->periodicidade)
    {

        echo ("var p".$i." = document.getElementById('".$fieldset."')\n");
        echo ("p".$i.".style.display = ''\n");

    } else {
        echo ("var p".$i." = document.getElementById('".$fieldset."')\n");
        echo ("p".$i.".style.display = 'none'\n");
    }
    $i++;
}
$i = 0;
foreach($periodicidade as $itemi)  
{   
    $nonei = 'none';
    $fieldset = "fieldset_".$itemi->periodicidade;
    $periodicidade_i = "periodicidade_".$i;
    $displayi = "none";
    echo ("document.getElementById('".$periodicidade_i."').onclick = function() {\n");
    echo ("if (this.checked) {\n");
        echo (
        "var p0 = document.getElementById('fieldset_mensal');\n
        p0.style.display = 'none';\n
        var p1 = document.getElementById('fieldset_bimestral');\n
        p1.style.display = 'none';\n
        var p2 = document.getElementById('fieldset_trimestral');\n
        p2.style.display = 'none';\n
        var p3 = document.getElementById('fieldset_semestral');\n
        p3.style.display = 'none';\n
        var p4 = document.getElementById('fieldset_anual');\n
        p4.style.display = 'none';\n");
        
        echo ("      p".$i.".style.display ='';\n");
    echo ("}\n");
    
    echo ("};\n");
    $i++; 
    
}



?>

</script>
<?php 

$eh_apoiador = 'true';
$mensagem_triagem_ntitular = "'Não sou titular de uma conta ".$cooperado->operadora->nome." mas me cadastrarei com o Link convite que me foi enviado ou o farei sem convite por livre e espontânea vontade para apoiar a cooperativa. (você será um Cooperado Apoiador).'";
$mensagem_triagem_titular = "'Tenho uma conta ".$cooperado->operadora->nome." em meu nome. (Preencha o formulário PRODIST ANEEL com os dados desta conta)'";

if ($cooperado->eh_titular)
{
    $eh_apoiador = 'false';

} else {
    $eh_apoiador = 'true';
}

?>
<script>


    $('.fieldset_disabled').prop('disabled', true);
    $('.fieldset').prop('disabled', {{$eh_apoiador}});


    $('#mensagem_triagem_ntitular').text(<?php echo $mensagem_triagem_ntitular; ?>);
    //$('#mensagem_triagem_titular').text('Tenho uma conta Enel-RJ em meu nome. (Preencha o formulário a seguir, PRODIST ANEEL, com os dados desta conta). Mantenha-se em dia com suas mensalidades para obter sua cota de energia escolhida no Formulário PRODIST (a seguir) que irá preencher e participar de todos os nossos sorteios. Apenas R$ 3,50 por mês (Três reais e cinquenta centavos). Ao entrar em sua conta, clique no botão ´´Gerar Link Convite`` e convide seus amigos e fature 20% dos prêmios todas as vezes que eles forem sorteados. Seus amigos devem ter uma conta de energia em seus nomes, ou se não tem, devem seguir nossas regras de cadastro para os não titulares de conta de energia.');
    $('#mensagem_triagem_titular').text(<?php echo $mensagem_triagem_titular; ?>);
    document.getElementById('titular').onclick = function() {
        if (this.checked) {
            $('.fieldset').prop('disabled', false);
        }
    };
    document.getElementById('ntitular').onclick = function() {
        if (this.checked) {
             $('.fieldset').prop('disabled', true);
        }
    };
    
    <?php 
    foreach($operadoras as $item)
    {
    
        $mensagem_triagem_ntitular = "Não sou titular de uma conta ".$item->nome.", mas me cadastrarei com o Link convite que me foi enviado ou o farei sem convite por livre e espontânea vontade para apoiar a cooperativa. (você será um Cooperado Apoiador).";
        $mensagem_triagem_titular = "Tenho uma conta ".$item->nome." em meu nome. (Preencha o formulário PRODIST ANEEL com os dados desta conta)";
        echo "   document.getElementById('operadora".$item->id."').onclick = function() {\n";
        echo "      if (this.checked)\n";
        echo "      {\n";
        echo "           $('#mensagem_triagem_titular').text('".$mensagem_triagem_titular."');\n";
        echo "           $('#mensagem_triagem_ntitular').text('".$mensagem_triagem_ntitular."');\n";
        echo "      }\n";
        echo "   }\n";
        }
    ?>

    document.getElementById("cota_comprada").onclick = function() {
        {
            cota = $('#cota_comprada').val();
            pot_inst = cota/360;
            $('#potencia_inst_uc').val(pot_inst.toFixed(2));
        }
    }

    document.getElementById("potencia_inst_uc").onclick = function() {
        {
            cota = $('#cota_comprada').val();
            pot_inst = cota/360;
            $('#potencia_inst_uc').val(pot_inst.toFixed(2));
        }
    }

    
    var currentTab = {{ $prodist->form_tab ?? 0}} ; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    markTabs(currentTab);

    function markTabs(n) {
        for (i=0; i<=n; i++)
        {
            document.getElementsByClassName("step")[i].className += " finish";
        }
    }
    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Finalizar";
        } else {
            document.getElementById("nextBtn").innerHTML = "Próximo";
        }
        // ... and run a function that displays the correct step indicator:
        $('#form_tab').val(n);
        fixStepIndicator(n)
    }

    function showCurrentTab(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = n;
        $('#form_tab').val(currentTab);
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        $('#form_tab').val(currentTab);
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            //valid = false;
            valid = true;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
        x[n].className += " active";
    }

    
    
    
<?php
    echo "$(\"".$periodicidade_i."\").prop(\"checked\", true);\n";
    echo "$(\"".$periodicidade_i."_".$meio_pagamento_j."\").prop(\"checked\", true);";
 ?>   
   

</script>
@endsection
