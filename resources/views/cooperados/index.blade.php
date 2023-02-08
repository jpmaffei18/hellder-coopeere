@extends('layouts.template')
@section('title', 'cooperados')
@section('content')
  <?php
  @session_start();
  if (@$_SESSION['id_usuario'] == null) {
    echo "<script language='javascript'> window.location='./' </script>";
  }
  if (!isset($id)) {
    $id = "";
  }

  ?>
  <div class="container">

    <!-- DataTales Example -->
    <div class="bg-white rounded shadow mb-4">

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="dataTable">
            <thead>
            <tr>
              <th>Nome</th>
              <th>Tipo</th>
              <th>Tipo Conta</th>
              <th>Grupo Conta</th>
              <th>CPF/CNPJ</th>
              <th>Ações</th>
            </tr>
            </thead>

            <tbody>
            @foreach($cooperados as $cooperado)
              <tr>
                <td>{{$cooperado->nome}}</td>
                <td class="text-capitalize">{{$cooperado->tipo}}</td>
                <td>{{$cooperado->tipo_conta}}</td>
                <td>{{$cooperado->grupo_conta}}</td>
                <td class="usuario-documento">{{$cooperado->cpf_cnpj}}</td>
                <td>
                  <div class="flex space-x-2">
                    <?php
                    //<a title="Detalhes do cooperado" href="{{route('cooperados.descricao', $cooperado->id)}}"><i class="fas fa-eye text-primary mr-1"></i></a>
                    ?>
                    <a title="Editar cooperado"
                        href="{{route('cooperados.editar', $cooperado)}}"><i class="fas fa-edit text-info"></i></a>
                    <a title="Deletar cooperado"
                        href="{{route('cooperados.modal', $cooperado)}}"><i class="fas fa-trash text-danger"></i></a>
                    <a title="Restaurar cooperado"
                        href="{{route('cooperados.undelete', $cooperado->id)}}"><i class="fas fa-user text-primary"></i></a>

                    @isset($cooperado->token_convite)
                      <div class="dropdown">
                        <a class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                          Convidados
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          @foreach($cooperado->convidados() as $convidado)
                            <a class="dropdown-item" href="#">{{$convidado->nome}} - {{$convidado->tipo}} </a>
                          @endforeach
                        </div>
                      </div>
                    @endisset
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#dataTable').dataTable({
        "ordering": false
      })

    });
  </script>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Deseja Realmente Excluir este Registro?

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <form method="POST" action="{{route('cooperados.delete', $id)}}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (@$id != "") {
    echo "<script>$('#exampleModal').modal('show');</script>";
  }
  ?>

@endsection
