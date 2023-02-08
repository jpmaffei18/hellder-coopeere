@extends('layouts.template')
@section('title', 'Pagamento')
@section('content')

<?php 
use App\Models\cooperado;
use App\Models\prodist;
?>
<?php /*
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
*/
?>
<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            
            //$("#ibge").val("");
        }
        
        $('#fone1').mask('(00) 0000-00009');
        $('#numero_cartao').mask('0000-0000-0000-0000');
        $('#ccv').mask('000');

        $('#fone1').blur(function(event) {
        if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
            $('#fone1').mask('(00) 00000-0009');
        } else {
            $('#fone1').mask('(00) 0000-00009');
        }
        });

        $('#fone2').mask('(00) 0000-0000');
        $('#fone2').blur(function(event) {
        if($(this).val().length == 14){ // Fixo com 8 dígitos + 2 dígitos DDD e 4 da máscara
            $('#fone2').mask('(00) 0000-0000');
        } else {
            $('#fone2').mask('(00) 0000-00009');
        }
        });

        $("#cpfcnpj").keydown(function(){
        try {
            $("#cpfcnpj").unmask();
        } catch (e) {}

        var tamanho = $("#cpfcnpj").val().length;

        if(tamanho < 11){
            $("#cpfcnpj").mask("999.999.999-99");
            
        } else {
            $("#cpfcnpj").mask("99.999.999/9999-99");
            
        }

        // ajustando foco
        var elem = this;
        setTimeout(function(){
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
        });


    });


    
</script>

<div class="container mt-4">
    <form method="POST" id="regForm" action="{{route('prodist.payment')}}"  enctype="multipart/form-data">
        

        @csrf
        @method('post')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @isset($errors_asaas)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors_asaas as $error)
                    <li>{{ $error['description'] }}</li>
                @endforeach
            </ul>
        </div>
        @endisset

        @isset($errors_aarin)
        <div class="alert alert-danger">
            <ul>
                
                    <li>{{ $errors_aarin['description'] }}</li>
                
            </ul>
        </div>
        @endisset

        <h3>Pagamento</h3>
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="periodicidade">Periodicidade</label>
                    <input type="text" readonly class="form-control" id="" readonly  name="id" value="{{$cooperado->periodicidade}}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="meio_pagamento">Meio de Pagamento</label>
                    <input type="text" readonly class="form-control" id="" readonly  name="id" value="{{$cooperado->meio_pagamento}}" required>
                </div>
            </div>
        </div>

        @empty($charge)
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Gerar Cobrança</button>
                </div>
            </div>
        </div>
        @endempty

        @isset($charge)
        @if($charge == true)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>Código da Parcela</th>
                  <th>Parcela</th>
                  <th>Data de Processamento</th>
                  <th>Data de Vencimento</th>
                  <th>Valor</th>
                  <th>CPF/CNPJ</th>
                  <th>Status</th>
                  @isset($boletos_pdf)
                  <th>PDF</th>
                  @endisset
                  @isset($cobrancas_pix)
                  <th>PIXQRCode</th>
                  <th>PIX</th>
                  @endisset
                </tr>
              </thead>
              <tbody>
                @isset($cobrancas_boletos)
                @forelse($cobrancas_boletos as $cobranca)
                   <tr>
                      <td>{{$cobranca['cod_parcela'] }}</td>
                      <td>{{$cobranca['parcela']}}</td>
                      <td>{{$cobranca['dt_processamento']}}</td>
                      <td>{{$cobranca['dt_vencimento']}}</td>
                      <td>{{$cobranca['valor_a_pagar']}}</td>
                      <td>{{$cobranca['cpf_cnpj']}}</td>
                      <td>{{$cobranca['status']}}</td>
                      <td><a href="{{$cobranca['bankSlipUrl']}}" class="btn btn-primary" target="_blank" >PDF do boleto</a></td>
                  </tr>
                  
                  @empty
                  <p>Sem cobranças</p>
                @endforelse
                @endisset

                @isset($cobrancas_pix)
                @forelse($cobrancas_pix as $cobranca)
                   <tr>
                      <td>{{$cobranca['cod_parcela'] }}</td>
                      <td>{{$cobranca['parcela']}}</td>
                      <td>{{$cobranca['dt_processamento']}}</td>
                      <td>{{$cobranca['dt_vencimento']}}</td>
                      <td>{{$cobranca['valor_a_pagar']}}</td>
                      <td>{{$cobranca['cpf_cnpj']}}</td>
                      <td>{{$cobranca['status']}}</td>
                      <td><img style="margin:12px auto" src="{{$cobranca['qr_code'] ?? ''}}" alt="QR Code de Pagamento" width="200" height="200"/></td>
                      <td><textarea readonly id="pixinput" rows="5" cols="40">{{$cobranca['pix_code']}}</textarea><a href="#" id="copypix">Copiar Código PIX</a></td>
                  </tr>
                  
                  @empty
                  <p>Sem cobranças</p>
                @endforelse
                @endisset
        </table>

        

        @isset($pix_code)

        
        <img style="margin:12px auto" src="{{$qr_code ?? ''}}" alt="QR Code de Pagamento" width="200" height="200"/>
        <br/>
        <textarea readonly id="pixinput" rows="5" cols="40">{{$pix_code}}</textarea>
        <br/>
        <a href="#" id="copypix">Copiar Código PIX</a>
        @endisset
        
        @endif
        @endisset

        

        <?php if ($cooperado->meio_pagamento == 'cartão de crédito')  { ?>
        <div class="container-step-content">
            <div class="grid grid-cols-1 col-span-1 gap-4 content-start">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="Nome">Nome (exatamente como está no cartão) *</label>
                        <input type="text" class="form-control" id="" name="holder_name" value="{{ old('holder_name') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="Nome">Número do Cartão *</label>
                        <input type="text" class="form-control" id="numero_cartao" name="number" value="{{ old('number') }}" required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="Nome">Código de Segurança (CCV) *</label>
                        <input type="text" class="form-control" id="ccv" name="ccv" value="{{ old('ccv') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="Nome">Vencimento *</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="Nome">Mês *</label>
                        <select class="form-select" name="expiry_mounth" aria-label="Mês de vencimento do cartão">
                            <option selected>Selecione</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option> 
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="Nome">Ano *</label>
                        <select class="form-select" name="expiry_year" aria-label="Ano de vencimento do cartão">
                            <option selected>Selecione</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                            <option value="2034">2034</option>
                          </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="Nome">Nome Completo *</label>
                        <input type="text" class="form-control" id="" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="cep">CEP (coloque o mesmo CEP onde vai a fatura do Cartão) *</label>
                        <input type="text" class="form-control" id="cep" name="postal_code" size="11"  value="{{ old('postal_code') }}" required>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="cpf_cnpj">CPF/CNPJ do pagador do cartão *</label>
                        <input type="text" class="form-control" id="cpfcnpj" name="cpf_cnpj"  value="{{ old('cpf_cnpj') }}" size="15" required>
                    </div>
                </div>
                
            </div>
    
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="endereco">Número da Rua *</label>
                        <input type="text" class="form-control" id="numero" name="address_number"  value="{{ old('address_number') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="endereco">Complemento *</label>
                        <input type="text" class="form-control" id="numero" name="address_complement"  value="{{ old('address_complement') }}" required>
                    </div>
                </div>
            </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="text" class="form-control" id="" name="email"  value="{{ old('email') }}" required>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="telefone_celular">Telefone Celular *</label>
                        <input type="text" class="form-control" id="fone1" name="mobile_phone" size="16"  value="{{ old('mobile_phone') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="telefone_fixo">Telefone Fixo</label>
                        <input type="text" class="form-control" id="fone2" name="phone" size="16"  value="{{ old('phone') }}">
                    </div>
                </div>
            </div>
            <button title="Pagar com Cartão de Crédito" type="submit" name="btn_submit" value="pagar_cartao_credito" class="btn btn-primary">Pagar com Cartão de Crédito</button>
        <?php } ?>
        </div>
        </div>
    </form>
    <script>
        function copy() {
         var copyText = document.querySelector("#pixinput");
            copyText.select();
            document.execCommand("copy");
        }
        document.querySelector("#copypix").addEventListener("click", copy);
    </script>
@endsection