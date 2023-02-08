<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CooperadosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PrecadastroController;
use App\Http\Controllers\ProdistsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CobrancasController;
use App\Http\Controllers\FinanceiroController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

Route::get('cobrancas', [CobrancasController::class, 'cobrancas'])->name('cobrancas');

Route::post('gerar_cobranca', [CobrancasController::class, 'gerar_cobranca'])->name('cobrancas.gerar');

Route::delete('cobrancas_delete_all', [CobrancasController::class, 'delete_all'])->name('cobrancas.deletar');


Route::get('financeiro', [FinanceiroController::class, 'financeiro'])->name('financeiro');

Route::get('/', HomeController::class)->name('home');

Route::get('cooperados/dashboard', [CooperadosController::class, 'dashboard'])->name('cooperados.dashboard');

Route::get('cooperados/inserir', [CooperadosController::class, 'create'])->name('cooperados.inserir');

//Route::get('cooperados/{id}', [CooperadosController::class, 'show'])->name('cooperados.descricao');

Route::get('cooperados_undelete/{id}', [CooperadosController::class, 'undelete'])->name('cooperados.undelete');

//Route::get('cooperados/{nome}/{valor?}', [CooperadosController::class, 'show'])->name('cooperados.descricao');

Route::get('cooperados', [CooperadosController::class, 'cooperados'])->name('cooperados');

Route::post('cooperados', [CooperadosController::class, 'insert'])->name('cooperados.insert');

Route::get('cooperados/{prodist}/editar', [CooperadosController::class, 'editar'])->name('cooperados.editar');

Route::post('cooperados_edit/{prodist}', [CooperadosController::class, 'edit'])->name('cooperados.edit');


Route::get('cooperados/{cooperado}/delete', [CooperadosController::class, 'modal'])->name('cooperados.modal');

Route::delete('cooperados/{cooperado}', [CooperadosController::class, 'delete'])->name('cooperados.delete');

Route::get('precadastro/confirmar', [PrecadastroController::class, 'confirmar'])->name('precadastro.confirmar');

Route::post('precadastro_confirm', [PrecadastroController::class, 'confirm'])->name('precadastro.confirm');

Route::get('precadastro/confirmar_telefone', [PrecadastroController::class, 'confirmar_telefone'])->name('precadastro.confirmar_telefone');

Route::post('precadastro_confirm_tel', [PrecadastroController::class, 'confirm_tel'])->name('precadastro.confirm_tel');

Route::get('precadastro/inserir', [PrecadastroController::class, 'create'])->name('precadastro.inserir');

Route::put('precadastro_insert', [PrecadastroController::class, 'insert'])->name('precadastro.insert');

Route::get('precadastro/{cooperado}/edit', [PrecadastroController::class, 'edit'])->name('precadastro.edit');

Route::put('precadastro/{cooperado}', [PrecadastroController::class, 'editar'])->name('precadastro.editar');

Route::get('prodist/inserir', [ProdistsController::class, 'create'])->name('prodist.inserir');

Route::get('prodist_insert', [ProdistsController::class, 'insert'])->name('prodist.insert');

Route::post('prodist_payment', [ProdistsController::class, 'payment'])->name('prodist.payment');

Route::get('prodist_pagamento', [ProdistsController::class, 'pagamento'])->name('prodist.pagamento');


Route::get('prodist/{prodist}/editar', [ProdistsController::class, 'editar'])->name('prodist.editar');

Route::post('prodist_edit/{prodist}', [ProdistsController::class, 'edit'])->name('prodist.edit');

Route::get('prodist/convidar', [ProdistsController::class, 'convidar'])->name('prodist.convidar');

Route::put('prodist_invite', [ProdistsController::class, 'invite'])->name('prodist.invite');

Route::get('prodist/{cooperado}/change_operator', [ProdistsController::class, 'change_operator'])->name('prodist.change_operator');

Route::get('prodist/{cooperado}', [ProdistsController::class, 'alterar_operadora'])->name('prodist.alterar_operadora');

Route::get('prodist_show/{id}', [ProdistsController::class, 'show'])->name('prodist.show');

Route::get('prodist_reedit_confirm', [ProdistsController::class, 'reedit_prodist_confirm'])->name('prodist.confirm_reedit');

Route::get('prodist_reedit_edit', [ProdistsController::class, 'reedit_prodist_edit'])->name('prodist.reeditar');

Route::get('prodist_status/{cooperado}/delete', [ProdistsController::class, 'modal_status'])->name('prodist.modal_status');

Route::delete('prodist_status/{cooperado}', [ProdistsController::class, 'delete_status'])->name('prodist.delete_status');

Route::get('usuario/trocar_senha', [UsuariosController::class, 'trocar_senha'])->name('usuarios.trocar_senha');

Route::put('usuario_change_psw', [UsuariosController::class, 'change_password'])->name('usuarios.change_password');

Route::get('usuario/senha_esquecida', [UsuariosController::class, 'senha_esquecida'])->name('usuarios.senha_esquecida');

Route::put('usuario_forgotten_psw', [UsuariosController::class, 'forgotten_password'])->name('usuarios.forgotten_password');

Route::get('api/webook/pix/{cod_parcela}', [ProdistsController::class, 'webhook_pagamento_pix'])->name('prodist.webhook_pagamento_pix');

Route::post('painel', [UsuariosController::class, 'login'])->name('usuarios.login');

Route::get('/', [UsuariosController::class, 'logout'])->name('usuarios.logout');
