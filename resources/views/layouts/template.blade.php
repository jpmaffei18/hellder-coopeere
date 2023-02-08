<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">

  <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  <script src="{{ mix('/js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

  @stack('styles')
</head>
<?php
@session_start();
if (!isset($_SESSION['CREATED'])) {
  $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800 / 2) {
  session_regenerate_id(true); // change session ID for the current session and invalidate old session ID
  $_SESSION['CREATED'] = time(); // update creation time
}
?>

<body>
<header>

  <nav class="navbar navbar-expand-lg">
    <div class="container flex-col sm:flex-row">

      <a class="navbar-brand" href="/">
        <img class="pb-2" src="{{ asset('/img/logo-coopeere-vert.png') }}" alt="Coopeere"/>
        <span>CNPJ: 40.409.711/0001-39</span>
      </a>

      <div class="nav-usuario">

      @isset($_SESSION['cooperado'])
        <div class="usuario">
          <div class="usuario-nome">{{ $_SESSION['cooperado']->nome }}</div>
          <div class="d-flex justify-content-md-between space-x-2">
            <div class="usuario-dados">
              {{ strlen($_SESSION['cooperado']->cpf_cnpj) === 11 ? 'CPF: ' : 'CNPJ: ' }}
              <span class="usuario-documento">{{ $_SESSION['cooperado']->cpf_cnpj }}</span>
            </div>
            <div class="usuario-dados">No. do Coop.: {{ $_SESSION['cooperado']->id }}</div>
          </div>
        </div>
      @endisset

        <ul class="navbar-nav ml-5 nav-separator nav-exit">
          <li class="nav-item">
            <br/>
            <a class="nav-link text-right" href="{{ route('usuarios.logout') }}">Sair</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>


</header>
<div id="main-content">
  @yield('content')
</div>
<!-- Scripts DataTables -->
<script src="{{ asset('/assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/datatables-demo.js') }}"></script>
@stack('scripts')
</body>

</html>
