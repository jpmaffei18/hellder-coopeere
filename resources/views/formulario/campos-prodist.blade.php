{{-- PRODIST START --}}
<div class="tab">
    <div class="tab-title">Formulário PRODIST (deve-se preencher e salvar a etapa TRIAGEM, antes de preencher o formulário Prodist)</div>
    @isset($prodist)
    <fieldset class="fieldset_prodist">
    <div class="form-group">
        <div class="form-group-title">
            Identificação da Unidade Consumidora
        </div>

        <div class="form-label row-span-2">
            <label for="maior_consumo">Upload da conta de luz</label>
            <div class="form-hint">Últimos 3 meses</div>
        </div>
        <div class="input-group row-auto">
          <div class="bg-gray-100 rounded-lg shadow-md text-center w-100 h-100">
            <div class="h-36">
                @if (isset($arquivo_prodist_ico))
                <img class="h-36 w-100 object-contain object-center" src="/uploads/{{ $arquivo_prodist_ico }}" alt="Avatar Upload" />
                @else
                <img class="h-36 w-100 object-contain object-center" src="/uploads/null_icon.png" alt="Avatar Upload" />
                @endif
              
            </div>
            <label class="cursor-pointer mt-2 w-100">
              <span class="btn btn-primary w-100">Enviar Arquivo</span>
              @if (isset($arquivo_prodist_ico))
              <input class="file-uploader w-100"
                  type="file"
                  name="upfile"
                  id="arquivo"
                  value="/uploads/{{ $arquivo_prodist_ico }}"
                  hidden>
                                        
              @else
              <input class="file-uploader w-100"
                  type="file"
                  name="upfile"
                  id="arquivo"
                  value="/uploads/null_icon.png"
                  hidden>
              @endif
            </label>
          </div>
        </div>

        <div class="grid grid-cols-2 col-span-2 gap-4 content-start">

            <label class="form-label" for="codigo_uc">Código UC/Número do Cliente</label>
            <div class="input-group">
                <input type="text"
                    class="form-control"
                    id="codigo_uc"
                    name="codigo_uc"
                    size="15"
                    value="{{ $prodist->codigo_uc }}"
                    title="Código da Unidade Consumidora ou Número do Cliente na sua conta"
                    {{ $readonly }}
                >
            </div>

            <div class="form-label">
                <label for="classe_uc">Classe UC</label>
                <div class="form-hint">
                    Unidade Consumidora
                </div>
            </div>
            <div class="input-group">
                <input type="text"
                    class="form-control"
                    id="classe_uc"
                    name="classe_uc"
                    size="15"
                    value="{{ $prodist->classe_uc }}"
                    {{ $readonly }}
                >
            </div>
        </div>

    </div>
    <div class="form-group">
        <div class="form-group-title">
            Dados da Unidade Consumidora
        </div>

        <div class="form-label">
            <label for="cota_comprada">Cota que deseja comprar mensalmente</label>
            <div class="form-hint">
                Preço estimado em 50% menor do que a operadora
            </div>
        </div>
        <div class="input-group">
            <input class="form-control"
                id="cota_comprada"
                name="cota_comprada"
                value="{{ (float) $prodist->cota_comprada }}"
                size="15"
                {{ $readonly }}
            >
            <span class="input-group-text">kWh</span>
        </div>

        <div class="form-label">
            <label for="potencia_inst_uc">Potência Instalada</label>
            <div class="form-hint">
                Em função da Cota, ou seja,<br/>Potência instalada = Cota/360
            </div>
        </div>
        <div class="input-group">
            <input
                type="text"
                class="form-control"
                readonly
                id="potencia_inst_uc"
                name="potencia_inst_uc"
                value="{{ $prodist->potencia_inst_uc }}"
                size="15">
            <span class="input-group-text">kW</span>
        </div>

        <label class="form-label" for="tensao_atendimento">Tensão de atendimento (V)</label>
        <div class="input-group">
            <select class="form-select" id="tensao_atendimento" name="tensao_atendimento">
                <option value="">Selecione</option>
                @foreach (App\Models\prodist::lista_tensaoatendimento() as $item)
                <option value="{{ $item->tensao_atendimento }}"
                    @if ($item->tensao_atendimento == $prodist->tensao_atendimento) selected @endif
                    >
                    {{ $item->tensao_atendimento }}
                </option>
                @endforeach

            </select>
        </div>

        <div class="form-label">
            <label for="tipo_conexao">Tipo de conexão</label>
            <div class="form-hint">
                Esta informação tem em sua conta de energia.
            </div>
        </div>
        <div class="input-group">
            <select class="form-select"
                name="tipo_conexao"
                id="tipo_conexao"
                {{ $readonly }}
            >
                @foreach (App\Models\prodist::lista_tipoconexao() as $item)
                <option value="{{ $item->tipo }}" @if ($item->tipo == $prodist->tipo_conexao) selected @endif>{{ ucwords($item->tipo) }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-label">
            <label for="tipo_ramal">Tipo de Ramal</label>
            <div class="form-hint">
                A energia chega até você via postes ou debaixo da terra?
            </div>
        </div>
        <div class="input-group">
            <select class="form-select"
                name="tipo_ramal"
                id="tipo_ramal"
                {{ $readonly }}
            >
                @foreach (App\Models\prodist::lista_tiporamal() as $item)
                <option value="{{ $item->tipo }}" @if ($item->tipo == $prodist->tipo_ramal) selected @endif>{{ ucwords($item->tipo) }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-title">
            Dados da Geração
        </div>

        <label class="form-label" for="potencia_inst_gerada">Potência instalada gerada</label>
        <div class="input-group">
            <input class="form-control"
                type="text"
                id="potencia_inst_gerada"
                name="potencia_inst_gerada"
                value="{{ $prodist->potencia_inst_gerada }}"
                size="20"
                readonly
            >
            <span class="input-group-text">kW</span>
        </div>

        <div class="form-label">
            <label for="tipo_fonte_geracao">Tipo da Fonte de Geração</label>
            <div class="form-hint">
                O padrão é Eólica
            </div>
        </div>
        <div class="input-group">
            <select class="form-select"
                {{ $readonly }}
                name="tipo_fonte_geracao"
                id="tipo_fonte_geracao"
            >
                @foreach (App\Models\prodist::lista_tipofontegeracao() as $item)
                <option value="{{ $item->tipo }}" @if ($item->tipo == $prodist->tipo_fonte_geracao) selected @endif>{{ ucwords($item->tipo) }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-label">
            <label for="menor_consumo">Menor consumo</label>
            <div class="form-hint">
                Dos últimos 12 meses
            </div>
        </div>
        <div class="input-group">
            <input class="form-control"
                {{ $readonly }}
                type="text"
                id="menor_consumo"
                name="menor_consumo"
                value="{{ $prodist->menor_consumo }}"
                size="15">
            <span class="input-group-text">kWh</span>
        </div>

        <div class="form-label">
            <label for="maior_consumo">Maior consumo</label>
            <div class="form-hint">
                Dos últimos 12 meses
            </div>
        </div>
        <div class="input-group">
            <input {{ $readonly }} type="text" class="form-control" id="maior_consumo"
                name="maior_consumo" size="15" value="{{ $prodist->maior_consumo }}"
                title="Maior consumo (em kWh) dos últimos 12 meses">
            <span class="input-group-text">kWh</span>
        </div>

        <div class="form-actions space-x-2">
            @if ($readonly != 'readonly')
            <button title="Enviar formulário Prodist de forma permanente" type="submit" name="btn_submit"
                value="enviar" class="btn btn-success">Enviar <i class="fas fa-paper-plane"></i></button>
            @endif
            <a target="_blank" class="btn btn-primary" title="Visualizar/Imprimir formulário Prodist"
                href="{{ route('prodist.show', $prodist->id) }}">Visualizar <i class="fas fa-eye"></i></a>

            @if ($readonly == 'readonly')
            <a title="Reeditar formulário Prodist, envio de código para desbloquear" class="btn btn-success"
                href="{{ route('prodist.reeditar') }}" role="button">Reeditar <i class="fas fa-edit"></i></a>
            @endif
            <a class="btn btn-danger" title="Deletar conta"
                href="{{ route('prodist.modal_status', $cooperado) }}">Deletar <i class="fas fa-trash"></i></a>
        </div>
        </fieldset>
        @endisset
    </div>
</div>
{{-- PRODIST END --}}
