{{--@section('title', 'Cooperado')--}}
@extends('admin_layout.admin')
@section('content')
<?php
#$valor_prod = number_format($cooperado->valor, 2, ',', '.');
?>
<div class="jumbotron">
  <h1 class="display-4"><?php echo $cooperado->nome; ?> </h1>
  <p class="lead">CPF/CNPJ <?php echo $cooperado->cpf_cnpj; ?> - Tipo: <?php echo $cooperado->tipo; ?>
    Endereço: <?php echo $cooperado->endereco; ?> <?php echo $cooperado->numero; ?> </p>
  <hr class="my-4">
  <p><?php echo $cooperado->endereco; ?></p>
  {{--@isset ($_SESSION)
  @if ($_SESSION['nivel_usuario'] == 'admin')
  --}}
    <a class="btn btn-primary btn-lg" href="{{route('cooperados')}}" role="button">Ver Cooperados</a>
  {{--
    @endif
  @endisset
  --}}
</div>
@endsection
