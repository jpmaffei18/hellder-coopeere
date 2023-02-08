@extends('layouts.hometemplate')
@section('title', 'Confirmar E-mail')
@section('content')
<div class="container mt-4">
    <form method="POST" action="{{route('precadastro.confirm')}}">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-md-4"> 
                <div class="form-group custom-form-group">
                    <label for="token">Código de Confirmação de Conta de E-mail</label>
                    <input type="text" class="form-control" id="" name="token_email" required>
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
