@extends('admin_layout.admin')

@section('content')

<div class="container mt-4">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" id="regForm" action="{{route('cobrancas.gerar')}}" >
      @csrf
      @method('post')
    <button title="Gerar Novas Cobranças" type="submit" name="btn_submit" value="gerar_novas_cobrancas" class="btn btn-primary">Gerar Novas Cobranças</button>
    </form>
    
    <button title="Remover Cobranças Selecionadas" type="submit" name="btn_submit" value="delete_cobrancas" class="btn btn-danger delete_all" data-url="{{ url('cobrancas_delete_all') }}">Remover Cobranças</button>
    
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
          <th>Selecionar<input type="checkbox" id="master"></th>
        </tr>
      </thead>
      <tbody>
        @isset($cobrancas)
        <?php $i = 0; ?>
        @foreach($cobrancas as $cobranca)
        
           <tr>
              <td>{{$cobranca->cod_parcela}}</td>
              <td>{{$cobranca->parcela}}</td>
              <td>{{$cobranca->dt_processamento}}</td>
              <td>{{$cobranca->dt_vencimento }}</td>
              <td>{{$cobranca->valor_a_pagar}}</td>
              <td>{{$cobranca->cpf_cnpj}}</td>
              <td>{{$cobranca->status}}</td>
              <td><input class="sub_chk" type="checkbox" data-id="<?php echo $cobranca->id; ?>" /></td>

              <?php //<a title="Efetuar Pagamento" href="{{route('prodist.dopayment', $cobrancas->id)}}"><i class="fas fa-money text-primary mr-1"></i></a> ?>
          </tr>
       <?php $i++; ?>
       @endforeach
       @endisset
</table>
</div>

@endsection