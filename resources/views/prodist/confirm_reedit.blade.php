@extends('layouts.hometemplate')
@section('title', 'Confirmar Reeditar Prodist')
@section('content')
<div class="container mt-4">
    <form method="GET" action="{{route('prodist.confirm_reedit')}}">
        @csrf
        
        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group">
                    <label for="token">Código de Confirmação de Reeditar Formulário PRODIST</label>
                    <input type="text" class="form-control" id="" name="token_reedit_prodist" required>
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
