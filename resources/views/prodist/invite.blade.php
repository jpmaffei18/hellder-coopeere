@extends('layouts.template')
@section('title', 'Editar Cooperado')
@section('content')

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

  <div class="container mt-4">
    <form method="POST" action="{{ route('prodist.invite') }}">
      @csrf
      @method('put')

      <div class="row">
        <div class="col">
          <div class="form-group custom-form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="" name="nome" required>
          </div>
        </div>
        <div class="col">
          <div class="form-group custom-form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="" name="email" required>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-editar-custom">Enviar <i class="fas fa-paper-plane"></i></button>
    </form>
  </div>
@endsection
