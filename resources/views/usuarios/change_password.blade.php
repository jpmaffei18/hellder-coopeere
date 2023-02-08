@extends('layouts.hometemplate')
@section('title', 'Trocar Senha')
@section('content')

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<div class="container mt-4">
    <form method="POST" action="{{route('usuarios.change_password')}}">
        @csrf
        @method('put')
        <?php 

        if (empty(!($_GET["token_change_psw"]))) 
        { 
        ?>
            <input type="hidden" name="token_change_psw" value="<?php echo $_GET["token_change_psw"] ?>">
        <?php
        }
        ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="" name="senha" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" class="form-control" id="" name="confirma_senha" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
