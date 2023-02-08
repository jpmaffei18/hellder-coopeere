@extends('layouts.template')
@section('title', 'Criar Pré Cadastro')
@section('content')

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  <script>
    $(document).ready(function() {

      $('#fone1').mask('(00) 0000-00009');
      $('#fone1').blur(function(event) {
        if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
          $('#fone1').mask('(00) 00000-0009');
        } else {
          $('#fone1').mask('(00) 0000-00009');
        }
      });

      $('#fone2').mask('(00) 0000-0000');
      $('#fone2').blur(function(event) {
        if ($(this).val().length == 14) { // Fixo com 8 dígitos + 2 dígitos DDD e 4 da máscara
          $('#fone2').mask('(00) 0000-0000');
        } else {
          $('#fone2').mask('(00) 0000-00009');
        }
      });

      $("#cpfcnpj").keydown(function() {
        try {
          $("#cpfcnpj").unmask();
        } catch (e) {}

        var tamanho = $("#cpfcnpj").val().length;

        if (tamanho <= 11) {
          $("#cpfcnpj").mask("999.999.999-99");
        } else {
          $("#cpfcnpj").mask("99.999.999/9999-99");
        }

        // ajustando foco
        var elem = this;
        setTimeout(function() {
          // mudo a posição do seletor
          elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
      });

      //Quando o campo cep perde o foco.
      $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

          //Expressão regular para validar o CEP.
          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if (validacep.test(cep)) {

            $('#loading-cep').removeClass('d-none');

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

              if (!("erro" in dados)) {
                //Atualiza os campos com os valores da consulta.
                $("#endereco").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
                //$("#ibge").val(dados.ibge);
              } //end if.
              else {
                //CEP pesquisado não foi encontrado.
                alert("CEP não encontrado.");
              }
            });
          } //end if.
          else {
            //cep é inválido.
            alert("Formato de CEP inválido.");
          }
        }
      });
    });
  </script>

  <div class="form-with-bg">
  <img src="{{ asset(Arr::random(File::glob('img/turbinas-*.jfif'))) }}" alt="Coopeere" />

    <div class="card p-4 mb-4">
      <form method="POST" action="{{ route('precadastro.insert') }}">
        @csrf
        @method('put')
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @isset($_GET['token_convite']))
          <input type="hidden" name="token_convite" value="{{ $_GET['token_convite'] }}">
        @endisset

        <div class="form-group-heading">Realize o cadastro e torne-se um Coopeerado</div>

        <div class="form-group grid-cols-6">

          <div class="form-group-title">Dados Pessoais</div>

          <label class="form-label" for="nome">Nome Completo*</label>
          <div class="col-span-5">
            <div class="input-group">
              <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
            </div>
          </div>

          <label class="form-label" for="email">E-mail*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
          </div>

          <label class="form-label" for="cpf_cnpj">CPF/CNPJ*</label>
          <div class="input-group w-50">
            <input type="text" class="form-control usuario-documento" id="cpf_cnpj" name="cpf_cnpj" value="{{ old('cpf_cnpj') }}"
               required>
          </div>

          <label class="form-label" for="telefone_celular">Telefone Celular*</label>
          <div class="input-group w-50">
            <input type="text" class="form-control" id="telefone_celular" name="telefone_celular" size="16"
                value="{{ old('telefone_celular') }}" required>
          </div>

          <label class="form-label" for="telefone_fixo">Telefone Fixo</label>
          <div class="input-group w-50">
            <input type="text" class="form-control" id="telefone_fixo" name="telefone_fixo" size="16"
                value="{{ old('telefone_fixo') }}">
          </div>

          <label class="form-label" for="senha">Senha*</label>
          <div class="input-group">
            <input type="password" class="form-control" id="senha" name="senha" required>
          </div>

          <label class="form-label" for="confirmar_senha">Confirmar Senha*</label>
          <div class="input-group">
            <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
          </div>

          <div class="form-group-title">Endereço*</div>

          <label class="form-label" for="cep">CEP*</label>
          <div class="col-span-5">
            <div class="flex">
              <div class="input-group w-25">
                <input class="form-control"
                    type="text"
                    id="cep"
                    name="cep"
                    value="{{ old('cep') }}"
                    size="10"
                    required>
              </div>
              <div class="p-2 d-none" id="loading-cep">
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
            </div>
            <small class="text-muted">
              O mesmo que consta na conta de energia
            </small>
          </div>

          <label class="form-label" for="endereco">Endereço*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco') }}" required>
          </div>

          <label class="form-label" for="endereco">Número*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" required>
          </div>

          <label class="form-label" for="bairro">Bairro*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro') }}" required>
          </div>

          <label class="form-label" for="cidade">Cidade*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}" required>
          </div>

          <label class="form-label" for="estado">Estado*</label>
          <div class="input-group">
            <select class="form-select" id="estado" name="estado" required>
              <option value="">UF</option>
              <option @if (old('estado') == 'AC') selected @endif value="AC">Acre</option>
              <option @if (old('estado') == 'AL') selected @endif value="AL">Alagoas</option>
              <option @if (old('estado') == 'AP') selected @endif value="AP">Amapá</option>
              <option @if (old('estado') == 'AM') selected @endif value="AM">Amazonas</option>
              <option @if (old('estado') == 'BA') selected @endif value="BA">Bahia</option>
              <option @if (old('estado') == 'CE') selected @endif value="CE">Ceará</option>
              <option @if (old('estado') == 'DF') selected @endif value="DF">Distrito Federal</option>
              <option @if (old('estado') == 'ES') selected @endif value="ES">Espírito Santo</option>
              <option @if (old('estado') == 'GO') selected @endif value="GO">Goiás</option>
              <option @if (old('estado') == 'MA') selected @endif value="MA">Maranhão</option>
              <option @if (old('estado') == 'MT') selected @endif value="MT">Mato Grosso</option>
              <option @if (old('estado') == 'MS') selected @endif value="MS">Mato Grosso do Sul</option>
              <option @if (old('estado') == 'MG') selected @endif value="MG">Minas Gerais</option>
              <option @if (old('estado') == 'PA') selected @endif value="PA">Pará</option>
              <option @if (old('estado') == 'PB') selected @endif value="PB">Paraíba</option>
              <option @if (old('estado') == 'PR') selected @endif value="PR">Paraná</option>
              <option @if (old('estado') == 'PE') selected @endif value="PE">Pernambuco</option>
              <option @if (old('estado') == 'PI') selected @endif value="PI">Piauí</option>
              <option @if (old('estado') == 'RJ') selected @endif value="RJ">Rio de Janeiro</option>
              <option @if (old('estado') == 'RN') selected @endif value="RN">Rio Grande do Norte</option>
              <option @if (old('estado') == 'RS') selected @endif value="RS">Rio Grande do Sul</option>
              <option @if (old('estado') == 'RO') selected @endif value="RO">Rondônia</option>
              <option @if (old('estado') == 'RR') selected @endif value="RR">Roraima</option>
              <option @if (old('estado') == 'SC') selected @endif value="SC">Santa Catarina</option>
              <option @if (old('estado') == 'SP') selected @endif value="SP">São Paulo</option>
              <option @if (old('estado') == 'SE') selected @endif value="SE">Sergipe</option>
              <option @if (old('estado') == 'TO') selected @endif value="TO">Tocantins</option>
            </select>
          </div>

          <div class="form-actions mt-4">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>

        </div>
      </form>
  </div>
  </div>
@endsection
