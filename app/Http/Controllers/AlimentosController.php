<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimento;
use DB;

class AlimentosController extends Controller
{
    private $alimento;

    public function cadastrarAlimento(){
        return view('cadastrar-alimento');
    }

    public function update(Request $request, $id){

        $alimento = Alimento::find($id);

        $alimento->nome = $request->nome;
        $alimento->grupo = $request->grupo;
        $alimento->fonte = $request->fonte;
        $alimento->umidade = $request->umidade;
        $alimento->energiaKcal = $request->energiaKcal;
        $alimento->energiaKj = $request->energiaKj;
        $alimento->proteina = $request->proteina;
        $alimento->lipideos = $request->lipideos;
        $alimento->colesterol = $request->colesterol;
        $alimento->carboidrato = $request->carboidrato;
        $alimento->fibraAlimentar = $request->fibraAlimentar;
        $alimento->cinzas = $request->cinzas;
        $alimento->calcio = $request->calcio;
        $alimento->magnesio = $request->magnesio;
        $alimento->manganes = $request->manganes;
        $alimento->fosforo = $request->fosforo;
        $alimento->ferro = $request->ferro;
        $alimento->sodio = $request->sodio;
        $alimento->potassio = $request->potassio;
        $alimento->cobre = $request->cobre;
        $alimento->zinco = $request->zinco;
        $alimento->retinol = $request->retinol;
        $alimento->re = $request->re;
        $alimento->rae = $request->rae;
        $alimento->tiamina = $request->tiamina;
        $alimento->riboflavina = $request->riboflavina;
        $alimento->piridoxina = $request->piridoxina;
        $alimento->niacina = $request->niacina;
        $alimento->vitaminaC = $request->vitaminaC;

        $resposta = $alimento->save();

        if ($resposta)
        return redirect()
                  ->route('alimento.editarAlimento', $id)
                  ->with('success', 'Os Dados do alimento foram editados com Sucesso!');
        return redirect()
                  ->back()
                  ->with('error', 'Falha ao editar os dados do alimento!');
    }

    public function insert(Request $valores){
        try {
            $dados = $valores->All();
            $resposta = Alimento::create($dados);
            if ($resposta)
            return redirect()
                      ->route('alimento.exibir')
                      ->with('success', 'Alimento cadastrado com Sucesso!');
            return redirect()
                      ->back()
                      ->with('error', 'Falha ao cadastrar os dados do alimento!');

        }catch (Exception $e) {

        }
    }

    public function exibir()
    {
      $registros = Alimento::orderBy('id','DESC')->paginate(10);
      return view('dados-alimentos', compact('registros'));
    }

    public function editarAlimento($id){
        $alimento = Alimento::find($id);
        return view('cadastrar-alimento', compact('alimento'));

      }

    public function delete()
    {
        $alimento_id = $_POST['alimento_id'];
        DB::table('alimentos')->where('id', '=', $alimento_id)->delete();
    }

    public function pesquisarAlimento(Request $request)
    {
      $registros = Alimento::where('nome', 'LIKE', '%'. $request->nome . '%')->orderBy('id','DESC')->paginate(10);

      $registros->appends(['nome' => $request->nome]);

        return view('dados-alimentos', [
          'registros' => $registros,
          'nome' => $request->nome
        ]);

    }























}
