
<input type="hidden" value="{{ $prodist->id }}" name="id">

<input type="hidden" id="form_tab" value="{{ $prodist->form_tab }}" name="form_tab">

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<fieldset class="fieldset">
  @include('formulario.campos-associado')
  @include('formulario.campos-explicacao')
  @include('formulario.campos-triagem')
  @include('formulario.campos-prodist')
  @include('formulario.campos-pagamento')
  @include('formulario.campos-regulamento')
  @include('formulario.campos-sorteio')
  @include('formulario.campos-convite')

  <div class="flex justify-end space-x-2 mt-3 py-3 border-t">
    <button class="btn btn-outline-primary btn-next-prev"
        type="button"
        id="prevBtn"
        data-action="prev">
      <span class="text-sm">
        <i class="fas fa-chevron-left"></i> Anterior
      </span>
    </button>

    <button class="btn btn-outline-primary btn-next-prev"
        type="button"
        id="nextBtn"
        data-action="next">
      <span class="text-sm">
        Próximo <i class="fas fa-chevron-right"></i>
      </span>
    </button>

    
    @if ($readonly != 'readonly')
      <button class="btn btn-outline-success"
          title="Salvar formulário Prodist"
          type="submit"
          name="btn_submit"
          id="btnSalvar"
          value="salvar">
      <span class="text-sm">
        Salvar <i class="fas fa-save"></i>
      </span>
      </button>
    @endif
    
  </div>

</fieldset>
