{{-- CONVITE START --}}
<div class="tab">

  <div class="flex justify-between items-start mb-4">
    <div class="tab-title">Convite</div>
    <a class="btn btn-primary btn-sm" href="{{ route('prodist.convidar') }}">
      Enviar link de convite
      <i class="far fa-envelope"></i>
    </a>
  </div>

  @isset($cooperado->token_convite)
    <div class="form-group mb-3">
      <label class="form-label">Link the convite para seu amigo</label>
      <div class="col-span-3">
        <div class="input-group w-100 items-stretch">
          <input class="form-control" readonly id="link_convite"
              value="http://{{ request()->getHttpHost() }}/precadastro/inserir?token_convite={{ $cooperado->token_convite }}"/>
          <button class="btn btn-success btn-copy"
              type="button"
              data-target="#link_convite">
            <i class="far fa-copy"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="form-group mt-5">
      <div class="form-group-title">Seus convidados</div>
      <div class="col-span-4 table-responsive ">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Nome</th>
            <th>Tipo</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($cooperado->convidados() as $convidado)
            <tr>
              <td>{{ ucwords(strtolower($convidado->nome)) }}</td>
              <td>{{ ucfirst($convidado->tipo) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endisset
</div>
{{-- CONVITE END --}}
