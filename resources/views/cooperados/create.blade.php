@extends('layouts.template')
@section('title', 'Criar Cooperado')
@section('content')
<div class="container mt-4">
    <form method="POST" action="{{route('cooperados.insert')}}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">CPF/CNPJ</label>
                    <input type="text" class="form-control" id="" name="cpf_cnpj">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tipo</label>
                    <input type="text" class="form-control" id="" name="tipo">
                </div>
            </div>
        </div>



        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
