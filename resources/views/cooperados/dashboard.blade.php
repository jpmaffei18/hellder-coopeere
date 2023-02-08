@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')
<?php
#$valor_prod = number_format($cooperado->valor, 2, ',', '.');
session_start();
?>


<div class="jumbotron">
  <h1 class="display-9">Cota Comprada Total (kWh) : <?php echo $cota_comprada_total; ?> </h1>
  <h1 class="display-9">Cota Comprada Total [alto consumo] (kWh): <?php echo $cota_comprada_total_alto_consumo; ?> </h1>
  <h1 class="display-9">Cota Comprada Total [alto consumo, grupo 1] (kWh): <?php echo $cota_comprada_total_alto_consumo_grupo_conta_1; ?> </h1>
  <h1 class="display-9">Cota a ser Comprada Total (kWh): <?php echo $cota_a_ser_comprada_total; ?> </h1>
  <h1 class="display-9">Cota a ser Comprada Total [alto consumo] (kWh): <?php echo $cota_a_ser_comprada_total_alto_consumo; ?> </h1>
  @isset ($_SESSION)
  @if ($_SESSION['nivel_usuario'] == 'admin')
  <a class="btn btn-primary btn-lg" href="{{route('cooperados')}}" role="button">Ver Cooperados</a>
  @endisset
  @endif
</div>

@endsection