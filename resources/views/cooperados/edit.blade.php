@extends('layouts.template')
@section('title', 'Reeditar Formulário Cooperado')
@section('content')
  @php
  use App\Models\cooperado;
  use App\Models\prodist;
  @endphp

  @push('scripts')
  <script>
    var currentTab = {{ $prodist->form_tab ?? 0}} ;
     // Current tab is set to be the first tab (0)
    </script>
    <script src="{{ mix('/js/tabs.js') }}"></script>
    <script>
    // Current tab is set to be the first tab (0)
    var currentTab = {{ $prodist->form_tab ?? 0}} ;
      <?php
        $current_tab_id = "#tab_".$prodist->form_tab;
      ?>
       
      function doCurrentTab() {
        let time = 100;
        
        $('.step.active').removeClass('active');
        
        $('{{$current_tab_id}}').addClass('active');
        $('.tab').fadeOut(time);
        setTimeout(() => {
          
          showCurrentTab(parseInt($('{{$current_tab_id}}').data('index')));
        }, time);
      }  
      doCurrentTab();
    </script>
  @endpush

  @if (!isset($id))
    @php($id = null)
  @endif

  @include('formulario.tabs')

  <div class="container-step-content">
    <form class="container" method="POST" id="regForm" action="{{ route('cooperados.editar', $cooperado) }}" enctype="multipart/form-data">
      @csrf
      @method('post')
      @include('formulario.campos')
    </form>
  </div>

  @include('formulario.model-excluir')

  @if ($id != '') <script>$('#exampleModal').modal('show');</script> @endif

  @php($eh_apoiador = 'true')
  @php($mensagem_triagem_ntitular = "'Não sou titular de uma conta {{ $cooperado->operadora->nome }} mas me cadastrarei com o Link convite que me foi enviado ou o farei sem convite por livre e espontânea vontade para apoiar a cooperativa. (você será um Cooperado Apoiador).'")
  @php($mensagem_triagem_titular = "'Tenho uma conta {{ $cooperado->operadora->nome }} em meu nome. (Preencha o formulário PRODIST ANEEL com os dados desta conta)'")

  @if ($cooperado->eh_titular)
    @php($eh_apoiador = 'false')
  @else
    @php($eh_apoiador = 'true')
  @endif

  @foreach (cooperado::lista_operadoras() as $item)
    @php($mensagem_triagem_ntitular = 'Não sou titular de uma conta ' . $item->nome . ', mas me cadastrarei com o Link convite que me foi enviado ou o farei sem convite por livre e espontânea vontade para apoiar a cooperativa. (você será um Cooperado Apoiador).')
    @php($mensagem_triagem_titular = 'Tenho uma conta ' . $item->nome . ' em meu nome. (Preencha o formulário PRODIST ANEEL com os dados desta conta)')
    <script>
      document.getElementById('operadora{{ $item->id }}').onclick = function() {
        if (this.checked) {
          $('#mensagem_triagem_titular').text('{{ $mensagem_triagem_titular }}');
          $('#mensagem_triagem_ntitular').text('{{ $mensagem_triagem_ntitular }}');
        }
      }
    </script>
  @endforeach

  <script>
    $(function() {
      $('.fieldset_disabled').prop('disabled', true);
      $('.fieldset').prop('disabled', {{ $eh_apoiador }});


      $('#mensagem_triagem_ntitular').text('{{ $mensagem_triagem_ntitular }}');
      $('#mensagem_triagem_titular').text('{{ $mensagem_triagem_titular }}');
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


      document.getElementById("cota_comprada").onclick = function() {
        {
          cota = $('#cota_comprada').val();
          pot_inst = cota / 360;
          $('#potencia_inst_uc').val(pot_inst.toFixed(2));
        }
      }

      document.getElementById("potencia_inst_uc").onclick = function() {
        {
          cota = $('#cota_comprada').val();
          pot_inst = cota / 360;
          $('#potencia_inst_uc').val(pot_inst.toFixed(2));
        }
      }
    })
  </script>
@endsection
