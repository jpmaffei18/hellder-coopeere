@extends('layouts.template')
@section('title', 'Senha esquecida')
@section('content')

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<div class="container mt-4">
  <div class="bg-white shadow rounded-md p-4 mb-4 w-50 mx-auto">
    <form method="POST" action="{{route('usuarios.forgotten_password')}}">
      @csrf
      @method('put')

      <div class="form-group-heading">Recuperar senha</div>

      <div class="form-group mt-4">

        <label class="form-label" for="email">E-mail</label>
        <div class="col-span-3">
          <div class="input-group">
            <input type="text" class="form-control" id="email" name="email" required>
          </div>
        </div>

        <div class="form-actions mt-4">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
