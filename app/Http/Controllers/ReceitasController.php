<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receita;

class ReceitasController extends Controller
{
    private $receita;

    public function cadastrarReceita(){
        return view('cadastrar-receita');
    }    

    public function update(Request $request, $id){

        $receita = Receita::find($id);

        $receita->nome = $request->nome;       
        $receita->totalEnergiaKcal = $request->totalEnergiaKcal;  
        $receita->totalProteina = $request->totalProteina;
        $receita->totalLipideos = $request->totalLipideos;
        $receita->totalCarboidrato = $request->totalCarboidrato;
        $resposta = $receita->save();
        
    }  

    public function insert(Request $valores){
        try {
            $dados = $valores->All(); 
            $resposta = Receita::create($dados);
            if ($resposta)
            return redirect()
                      ->route('receita.cadastrar')
                      ->with('success', 'Os Dados do alimento foram cadastrados!');
            return redirect()
                      ->back()
                      ->with('error', 'Falha ao cadastrar os dados do alimento!');
    
        }catch (Exception $e) {

        }
    }

    public function exibir()
    {
      $registros = Receita::orderBy('id','DESC')->get();  
      return view('dados-receitas', compact('registros'));  
    }

    public function exibirById($id)
    {
      $registros = Receita::where('id',$id)->first();
      return view('receita-ingredientes', compact('registros'));  
    }






    


}
