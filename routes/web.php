<?php

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

Route::get('/', function () {
    return view('welcome');
});

//Alimentos
Route::get('/cadastrar-alimento','AlimentosController@cadastrarAlimento' )->name('alimento.cadastrar')->middleware('auth');
Route::post('/inserir-alimento', 'AlimentosController@insert')->name('alimento.insert')->middleware('auth');


//------
Route::get('/graficos', 'GraficosController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cadastrar-paciente', 'PacienteController@cadastrar')->name('paciente.cadastrar')->middleware('auth');

Route::post('/inserir-paciente', 'PacienteController@insert')->name('paciente.insert')->middleware('auth');

Route::post('/editar-paciente/{id}', 'PacienteController@update')->name('paciente.update')->middleware('auth');

Route::get('/lista_pacientes', 'PacienteController@pesquisar')->name('paciente.pesquisar')->middleware('auth');

Route::get('/dados-paciente/{id}', 'PacienteController@exibir')->name('paciente.exibir')->middleware('auth');

Route::get('/avaliacao_individual/{id}', 'PacienteController@realizarAvaliacao')->name('paciente.avaliacao')->middleware('auth');

Route::get('/paciente_editar/{id}', 'PacienteController@editar')->name('paciente.editar')->middleware('auth');

Route::get('/paciente_individual', 'PacienteController@exportar')->name('paciente.exportar')->middleware('auth');

Route::post('/pacientes_individual', 'PacienteController@pesquisados')->name('paciente.pesquisados')->middleware('auth');

Route::post('/avaliacao_individual/cadastrar', 'AvaliacaoController@insert')->name('avaliacao.insert')->middleware('auth');
//Graficos
Route::get('/classificacoes', 'GraficosController@index')->name('graficos')->middleware('auth');
Route::get('/classificacoes/imcIdadeMasculino', 'GraficosController@imcIdadeMas')->name('imcIdadeMas')->middleware('auth');
Route::get('/classificacoes/imcIdadeFeminino', 'GraficosController@ImcIdadeFem')->name('imcIdadeFem')->middleware('auth');

Route::get('/classificacoes/imcIdadeMasculino/nutri', 'GraficosController@ImcIdadeNutriMas')->name('ImcIdadeNutriMas')->middleware('auth');
Route::get('/classificacoes/imcIdadeFeminino/nutri', 'GraficosController@ImcIdadeNutriFem')->name('ImcIdadeNutriFem')->middleware('auth');

Route::get('/classificacoes/imcIdadeMasculino/agro', 'GraficosController@ImcIdadeAgroMas')->name('ImcIdadeAgroMas')->middleware('auth');
Route::get('/classificacoes/imcIdadeFeminino/agro', 'GraficosController@ImcIdadeAgroFem')->name('ImcIdadeAgroFem')->middleware('auth');

Route::get('/classificacoes/imcIdadeMasculino/info', 'GraficosController@ImcIdadeInfoMas')->name('ImcIdadeInfoMas')->middleware('auth');
Route::get('/classificacoes/imcIdadeFeminino/info', 'GraficosController@ImcIdadeInfoFem')->name('ImcIdadeInfoFem')->middleware('auth');

//Dietas
Route::get('/dieta/{tipo}/{id}', 'DietaController@inserirDieta')->name('dieta.inserirDieta')->middleware('auth');
Route::get('/atualizadieta/{tipo}/{id}', 'DietaController@atualizarDieta')->name('dieta.atualizarDieta')->middleware('auth');
Route::post('/dieta/inserir', 'DietaController@inserir')->name('dieta.inserir')->middleware('auth');
