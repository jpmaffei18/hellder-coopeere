{{-- PAGAMENTO START --}}
<div class="tab">
  <h3 class="tab-title">Pagamento</h3>

  @php($checkedi = '')
  @php($i = 0)
  @php($j = 0)

  <div class="opcoes-pagamento">

    @foreach (App\Models\cooperado::lista_periodicidade() as $periodicidade)

        @php($checkedi = '')
        @php($j = 0)
        @if ($periodicidade->periodicidade === $cooperado->periodicidade)
          @php($checkedi = 'checked')
        @endif

        <div class="opcao-pagamento">
          <input
              type="radio"
              name="periodicidade"
              value="{{ $periodicidade->periodicidade }}"
              hidden
              {{ $checkedi }}
          />
          <div class="opcao-pagamento-content">
            <div class="opcao-pagamento-header">
              {{ $periodicidade->periodicidade }}
            </div>
            <div class="opcao-pagamento-body">
              <h3 class="opcao-pagamento-price">R$ {{ $periodicidade->valor }}</h3>
              @foreach (App\Models\cooperado::lista_meio_pagamento() as $item_meio_pagamento)

                @foreach (App\Models\cooperado::lista_periodicidademeiopagamento() as $item_periodicidade_pagamento)

                  @if ($periodicidade->periodicidade == $item_periodicidade_pagamento->periodicidade && $item_meio_pagamento->meio_pagamento == $item_periodicidade_pagamento->meio_pagamento)

                    <div class="form-check">
                        <input class="form-check-input opcao-pagamento-meio"
                            @isset($prodist)  @endisset type="radio"
                            id="periodicidade_{{ $i }}_meio_pagamento_{{ $j }}"
                            name="meio_pagamento"
                            value="{{ $item_meio_pagamento->meio_pagamento }}"
                            @if ($periodicidade->periodicidade === $cooperado->periodicidade && $item_periodicidade_pagamento->meio_pagamento === $cooperado->meio_pagamento) checked="checked" @endif />

                      <label class="form-check-label"
                          for="periodicidade_{{ $i }}_meio_pagamento_{{ $j }}">
                        {{ ucwords($item_meio_pagamento->meio_pagamento) }}
                      </label>
                    </div>
                  @endif
                @endforeach
                @php($j++)
              @endforeach
            </div>
          </div>
          </div>
        @php($i++)
      @endforeach

  </div>
  <div class="form-group pt-4 mt-4 text-center d-flex align-items-center justify-content-center">
    <label for="dia_de_vencimento" class="h6">Selecione o dia de vencimento</label>
    <select @isset($prodist)  @endisset  name="dia_vencimento" id="dia_de_vencimento"
        title="Vencimento de sua conta Coopeere" class="form-select w-auto ml-3">
      @foreach (App\Models\cooperado::lista_dia_vencimento() as $item)
        <option value="{{ $item->dia_vencimento }}"
            @if ($item->dia_vencimento == $cooperado->dia_vencimento) selected @endif>{{ $item->dia_vencimento }}
        </option>
      @endforeach
    </select>
    @isset($prodist) 
   
      <a title="Efetuar Pagmaento" class="btn btn-success"
                href="{{ route('prodist.pagamento') }}" role="button">Avançar <i class="fas fa-money"></i></a>
    
    @endisset 
  </div>
</div>
{{-- PAGAMENTO END --}}
