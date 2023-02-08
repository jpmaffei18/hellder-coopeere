@extends('admin_layout.admin')

@section('content')
<div class="container mt-4">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
          <th>Código da Parcela</th>
          <th>Data de Processamento</th>
          <th>Data de Vencimento</th>
          <th>Valor</th>
          <th>CPF/CNPJ</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @isset($cobrancas)
        @foreach($cobrancas as $cobranca)
        
           <tr>
              <td>{{$cobranca->cod_parcela}}</td>
              <td>{{$cobranca->dt_processamento}}</td>
              <td>{{$cobranca->dt_vencimento }}</td>
              <td>{{$cobranca->valor_a_pagar}}</td>
              <td>{{$cobranca->cpf_cnpj}}</td>
              <td>{{$cobranca->status}}</td>
              <?php //<a title="Efetuar Pagamento" href="{{route('prodist.dopayment', $cobrancas->id)}}"><i class="fas fa-money text-primary mr-1"></i></a> ?>
          </tr>
      
       @endforeach
       @endisset
</table>
</div>
@endsection