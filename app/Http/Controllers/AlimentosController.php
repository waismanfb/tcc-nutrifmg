<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimento;

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
        $alimento->energiaKcal = $request->energiaKcal;
        $alimento->proteina = $request->proteina;
        $alimento->lipideos = $request->lipideos;
        $alimento->carboidrato = $request->carboidrato;

        $resposta = $alimento->save();        
    }  

    public function insert(Request $valores){
        try {
            $dados = $valores->All(); 
            $resposta = Alimento::create($dados);
            if ($resposta)
            return redirect()
                      ->route('alimento.cadastrar')
                      ->with('success', 'Os Dados do alimento foram cadastrados!');
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
        return view('cadastrar-alimento', compact('alimento'))->with('success','Alimento deletado com sucesso!');
      }

    public function delete(Alimento $id)
    {
      $id->delete();
      return redirect()->route('alimento.exibir')->with('success','Alimento deletado com sucesso!');
    }

    public function pesquisarAlimento(Request $request)
    {
      $registros = Alimento::where('nome', 'LIKE', '%'. $request->nome . '%')->paginate(10);  

        return view('dados-alimentos', [
          'registros' => $registros,
          'nome' => $request->nome
        ]); 

    }    




















          
    

}


