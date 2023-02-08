@extends('layouts.template')
@section('title', 'Editar Cooperado')
@section('content')

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  <script>
    $(function () {

      if ($("#cpfcnpj").length > 0) {
        var tamanho = $("#cpfcnpj").val().replace(/\D/g, "").length;

        $("#cpfcnpj").unmask();
        if (tamanho < 12) {
          $("#cpfcnpj").mask("999.999.999-99");
        } else {
          $("#cpfcnpj").mask("99.999.999/9999-99");
        }
      }

      $('#fone1').mask('(00) 0000-00009');
      $('#fone1').blur(function (event) {
        if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
          $('#fone1').mask('(00) 00000-0009');
        } else {
          $('#fone1').mask('(00) 0000-00009');
        }
      });

      $('#fone2').mask('(00) 0000-0000');
      $('#fone2').blur(function (event) {
        if ($(this).val().length == 14) { // Celular com 8 dígitos + 2 dígitos DDD e 4 da máscara
          $('#fone2').mask('(00) 0000-0000');
        } else {
          $('#fone2').mask('(00) 0000-00009');
        }
      });

      $(document).on('input', "#cpfcnpj", function () {

        $("#cpfcnpj").unmask();
        var tamanho = $("#cpfcnpj").val().replace(/\D/g, "").length;

        console.log(tamanho);

        if (tamanho <= 11) {
          $("#cpfcnpj").mask("999.999.999-99");
          $('.inscricaofieldset').prop('disabled', true);
        } else {
          $("#cpfcnpj").unmask();
          $("#cpfcnpj").mask("99.999.999/9999-99");
          $('.inscricaofieldset').prop('disabled', false);
        }

        // ajustando foco
        var elem = this;
        setTimeout(function () {
          // mudo a posição do seletor
          elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
      });

      //Quando o campo cep perde o foco.
      $(document).on('change', "#cep", function () {

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
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

              $('#loading-cep').addClass('d-none');

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
        } //end if.
        else {
          //cep sem valor, limpa formulário.
        }
      });
    });
  </script>

  <div class="container mt-4">
    <div class="bg-white shadow rounded-md p-4 mb-4">
      <form method="POST" action="{{ route('precadastro.editar', $cooperado, $operadoras) }}">
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
        <input type="hidden" name="id" value="{{ $cooperado->id }}">
        <input type="hidden" name="tipo" value="{{ $cooperado->tipo }}">
        <input type="hidden" name="tipo_conta" value="{{ $cooperado->tipo_conta }}">
        <input type="hidden" name="sorteio" value="{{ $cooperado->sorteio }}">
        <input type="hidden" name="status" value="{{ $cooperado->status }}">
        <input type="hidden" name="idusuario" value="{{ $cooperado->usuario->id }}">

        <div class="form-group-heading">Dados do Cooperado</div>

        <div class="form-group grid-cols-6">

          <div class="form-group-title">Dados Pessoais</div>

          <label class="form-label" for="nome">Nome Completo:*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $cooperado->nome }}" required>
          </div>

          <label class="form-label" for="cpf_cnpj">CPF/CNPJ:*</label>
          <div class="input-group w-50">
            <input type="text" class="form-control usuario-documento" id="cpf_cnpj" name="cpf_cnpj"
                value="{{ $cooperado->cpf_cnpj }}" required>
          </div>

          <label class="form-label" for="telefone_celular">Telefone Celular:*</label>
          <div class="input-group w-50">
            <input type="text" class="form-control" id="fone1" name="telefone_celular"
                value="{{ $cooperado->usuario->telefone_celular }}" size="16" required>
          </div>

          <div class="form-label">
            <label for="telefone_fixo">Telefone Fixo:</label>
            <div class="form-hint">
              Opcional
            </div>
          </div>
          <div class="input-group w-50">
            <input type="text" class="form-control" id="fone2" name="telefone_fixo"
                value="{{ $cooperado->usuario->telefone_fixo }}" size="16">
          </div>

          <label class="form-label" for="nome">E-mail:*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="" name="email" readonly
                value="{{ $cooperado->usuario->email }}" required>
          </div>

          <div class="form-group-title">Endereço:*</div>

          <div class="form-label">
            <label for="cep">CEP:*</label>
          </div>
          <div class="col-span-5">
            <div class="flex">
              <div class="input-group w-25">
                <input type="text" class="form-control" id="cep" name="cep" value="{{ $cooperado->cep }}" size="10"
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

          <label class="form-label" for="endereco">Endereço:*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $cooperado->endereco }}"
                required>
          </div>

          <label class="form-label" for="numero">Número:*</label>
          <div class="input-group w-50">
            <input type="text" class="form-control" id="numero" name="numero" value="{{ $cooperado->numero }}"
                required>
          </div>

          <label class="form-label" for="bairro">Bairro:*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $cooperado->bairro }}"
                required>
          </div>

          <label class="form-label" for="cidade">Cidade:*</label>
          <div class="input-group">
            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $cooperado->cidade }}"
                required>
          </div>

          <label class="form-label" for="estado">Estado:*</label>
          <div class="input-group">
            <select class="form-select" id="estado" name="estado" required>
              <option value="">UF</option>
              <option @if ($cooperado->estado === 'AC') selected @endif value="AC">Acre</option>
              <option @if ($cooperado->estado === 'AL') selected @endif value="AL">Alagoas</option>
              <option @if ($cooperado->estado === 'AP') selected @endif value="AP">Amapá</option>
              <option @if ($cooperado->estado === 'AM') selected @endif value="AM">Amazonas</option>
              <option @if ($cooperado->estado === 'BA') selected @endif value="BA">Bahia</option>
              <option @if ($cooperado->estado === 'CE') selected @endif value="CE">Ceará</option>
              <option @if ($cooperado->estado === 'DF') selected @endif value="DF">Distrito Federal</option>
              <option @if ($cooperado->estado === 'ES') selected @endif value="ES">Espírito Santo</option>
              <option @if ($cooperado->estado === 'GO') selected @endif value="GO">Goiás</option>
              <option @if ($cooperado->estado === 'MA') selected @endif value="MA">Maranhão</option>
              <option @if ($cooperado->estado === 'MT') selected @endif value="MT">Mato Grosso</option>
              <option @if ($cooperado->estado === 'MS') selected @endif value="MS">Mato Grosso do Sul</option>
              <option @if ($cooperado->estado === 'MG') selected @endif value="MG">Minas Gerais</option>
              <option @if ($cooperado->estado === 'PA') selected @endif value="PA">Pará</option>
              <option @if ($cooperado->estado === 'PB') selected @endif value="PB">Paraíba</option>
              <option @if ($cooperado->estado === 'PR') selected @endif value="PR">Paraná</option>
              <option @if ($cooperado->estado === 'PE') selected @endif value="PE">Pernambuco</option>
              <option @if ($cooperado->estado === 'PI') selected @endif value="PI">Piauí</option>
              <option @if ($cooperado->estado === 'RJ') selected @endif value="RJ">Rio de Janeiro</option>
              <option @if ($cooperado->estado === 'RN') selected @endif value="RN">Rio Grande do Norte</option>
              <option @if ($cooperado->estado === 'RS') selected @endif value="RS">Rio Grande do Sul</option>
              <option @if ($cooperado->estado === 'RO') selected @endif value="RO">Rondônia</option>
              <option @if ($cooperado->estado === 'RR') selected @endif value="RR">Roraima</option>
              <option @if ($cooperado->estado === 'SC') selected @endif value="SC">Santa Catarina</option>
              <option @if ($cooperado->estado === 'SP') selected @endif value="SP">São Paulo</option>
              <option @if ($cooperado->estado === 'SE') selected @endif value="SE">Sergipe</option>
              <option @if ($cooperado->estado === 'TO') selected @endif value="TO">Tocantins</option>
            </select>
          </div>

        </div>

        <div class="form-actions mt-4">
          <button type="submit" class="btn btn-primary">Enviar <i class="fas fa-save"></i></button>
        </div>

      </form>
    </div>
  </div>
@endsection
