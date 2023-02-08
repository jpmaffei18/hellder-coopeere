{{-- INFORMAÇÕES PESSOAIS START --}}
<div class="tab">
  <input name="id" value="{{ $cooperado->id }}" hidden />
  <input name="email" value="{{ $cooperado->usuario->email }}" hidden />
  <input name="nome" value="{{ $cooperado->nome }}" hidden />
  <input name="inscricao_estadual" value="{{ $cooperado->inscricao_estadual }}" hidden />
  <input name="inscricao_municipal" value="{{ $cooperado->inscricao_municipal }}" hidden />
  <input name="endereco" value="{{ $cooperado->endereco }}" hidden />
  <input name="numero" value="{{ $cooperado->numero }}" hidden />
  <input name="cep" value="{{ $cooperado->cep }}" hidden />
  <input name="bairro" value="{{ $cooperado->bairro }}" hidden />
  <input name="cidade" value="{{ $cooperado->cidade }}" hidden />
  <input name="estado" value="{{ $cooperado->estado }}" hidden />
  <input name="telefone_celular" value="{{ $cooperado->usuario->telefone_celular }}" hidden />

  <div class="row justify-content-between align-items-start">
    <div class="col-md-6">
      <div class="row">
        <div class="flex mb-2 md:mb-4">
          <div class="tab-title">Informações Pessoais</div>
        </div>

        <div class="col-12 sm:col-6 mt-3">
          <div class="flex rounded-lg bg-blue-50 shadow-md justify-items-stretch overflow-hidden">
            <div class="m-2 h-20 w-20 flex items-center justify-center bg-blue-400 rounded">
              <i class="far fa-lightbulb text-4xl text-white"></i>
            </div>
            <div class="p-2 flex flex-col justify-center leading-normal">
              <h5 class="text-blue-600 font-bold text-lg tracking-tight mb-1">Associado</h5>
              <span class="font-normal text-gray-700">{{ $cooperado->nome }}</span>
              <span class="font-normal text-gray-700 usuario-documento">{{ $cooperado->cpf_cnpj }}</span>
              <input hidden name="cpf_cnpj" value="{{ $cooperado->cpf_cnpj }}" />
            </div>
          </div>
        </div>

        <div class="col-12 sm:col-6 mt-3">
          <div class="flex rounded-lg bg-green-50 shadow-md justify-items-stretch overflow-hidden">
            <div class="m-2 h-20 w-20 flex items-center justify-center bg-green-400 rounded">
              <i class="fas fa-phone-volume text-4xl text-white"></i>
            </div>
            <div class="p-2 flex flex-col justify-center leading-normal">
              <h5 class="text-green-600 font-bold text-lg tracking-tight mb-1">Contatos</h5>
              <span class="font-normal text-gray-700 usuario-telefone">{{ $cooperado->usuario->telefone_celular }}</span>
              <span class="font-normal text-gray-700 usuario-telefone">{{ $cooperado->usuario->telefone_fixo }}</span>
            </div>
          </div>
        </div>

        <div class="col-12 mt-3">
          <div class="flex rounded-lg bg-red-50 shadow-md justify-items-stretch overflow-hidden">
            <div class="flex-shrink-0 m-2 h-20 w-20 flex items-center justify-center bg-red-400 rounded">
              <i class="fas fa-map-marker-alt text-4xl text-white"></i>
            </div>
            <div class="p-2 flex flex-col justify-center leading-normal">
              <h5 class="text-red-600 font-bold text-lg tracking-tight mb-1">Endereço</h5>
              <span class="font-normal text-gray-700">{{ $cooperado->endereco }}, {{ $cooperado->numero }}</span>
              <span class="font-normal text-gray-700">{{ $cooperado->cidade }} - {{ $cooperado->estado }}</span>
              <span class="font-normal text-gray-700">{{ $cooperado->bairro }} - {{ $cooperado->cep }}</span>
            </div>
          </div>
        </div>

        <div class="col-12 mt-3">
        <a class="btn btn-primary btn-sm "
            href="{{ route('precadastro.edit', $cooperado->id) }}">
          <i class="far fa-edit"></i>
          Reeditar
        </a>
        </div>

      </div>

    </div>

    <div class="col-md-6 d-none d-md-block text-md-right">
      <img class="w-full h-96 rounded-xl object-cover shadow-md"
          src="{{ asset('/img/informacoes-pessoais.jpg') }}"
          alt="thumb"
          style="height: 400px"/>
    </div>
  </div>
</div>
{{-- INFORMAÇÕES PESSOAIS END --}}
