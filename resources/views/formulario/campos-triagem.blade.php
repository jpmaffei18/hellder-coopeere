{{-- TRIAGEM START --}}
<div class="tab">
  <fieldset class="fieldset">
    <h3 class="tab-title">Triagem</h3>
    <p for="operadora">Escolha a sua distribuidora (de acordo com sua conta de luz):</p>
    <div class="operadora_field mb-5">
      @foreach (App\Models\cooperado::lista_operadoras() as $item)

        @php($checked = '')
        @isset($cooperado->operadora)
        @if ($item->id == $cooperado->operadora->id)
          @php($checked = 'checked')
        @endif
        @endisset
        <label class="form-check-label {{ $checked }}"
            for="operadora{{ $item->id }}" id="operadora{{ $item->id }}_nome">
          <input class="form-check-input" {{ $checked }} type="radio"
              id="operadora{{ $item->id }}" name="idoperadora" value="{{ $item->id }}" />
          {{ $item->nome }}
        </label>
      @endforeach
    </div>

    @php($checked_titular = '')
    @php($checked_ntitular = '')
    @isset ($cooperado->eh_titular)
    @if ($cooperado->eh_titular)
      @php($checked_titular = 'checked')
      @php($checked_ntitular = '')
    @else
    @php($checked_titular = '')
      @php($checked_ntitular = 'checked')
    @endif
    @endisset

    <div class="row align-items-start md:align-items-center mb-3">
      <div class="col-auto">
        <input class="form-check-input" type="radio" id="titular" {{ $checked_titular }} name="eh_titular"
            value="true">
      </div>

      <div class="col">
        <label class="form-check-label" for="titular" id="mensagem_triagem_titular"></label>
      </div>

    </div>

    <div class="row align-items-start md:align-items-center">
      <div class="col-auto">
        <input class="form-check-input" type="radio" id="ntitular" {{ $checked_ntitular }} name="eh_titular"
            value="false">
      </div>

      <div class="col">
        <label class="form-check-label" for="ntitular" id="mensagem_triagem_ntitular"></label>
      </div>
    </div>

  </fieldset>
</div>
{{-- TRIAGEM END --}}
