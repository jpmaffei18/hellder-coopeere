@extends('layouts.hometemplate')
@section('title', 'Confirmar Telefone')
@section('content')
<div class="container mt-4">
    <form method="POST" action="{{route('precadastro.confirm_tel')}}">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-md-4"> 
                <div class="form-group custom-form-group">
                    <label for="token">Código de Confirmação de Telefone</label>
                    <input type="text" class="form-control" id="" name="token_telefone" required>
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
