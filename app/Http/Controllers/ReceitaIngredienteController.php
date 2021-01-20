<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReceitaIngrediente;
use App\Alimento;
use App\Receita;
use DB;

class ReceitaIngredienteController extends Controller
{
    private $ingrediente;

    public function cadastrarIngrediente(Request $request){
        $alimentos = Alimento::all();
        $receita = Receita::all();
        
        

        
        return view('cadastrar-ingrediente', [
            'alimentos' => $alimentos
        ]);  
    }    

    public function update(Request $request, $id){

        $ingrediente = ReceitaIngrediente::find($id);
        $alimento = Alimento::find($id);
        $receita = Receita::find($id);
        

        $ingrediente->nome = $request->nome;     
        $ingrediente->medida = $request->medida;  
        $ingrediente->quantidade = $request->quantidade;
        $ingrediente->id_alimento = $request->id_alimento;
        $ingrediente->id_receitas = $request->id_receitas;
        $resposta = $ingrediente->save();
        
    }  

    public function insert(Request $valores){
        try {
            $dados = $valores->All(); 
            $resposta = ReceitaIngrediente::create($dados);
           
            
            if ($resposta)
            return redirect()
                      ->route('ingrediente.cadastrar')
                      ->with('success', 'Os Dados do alimento foram cadastrados!');
            return redirect()
                      ->back()
                      ->with('error', 'Falha ao cadastrar os dados do alimento!');
    
        }catch (Exception $e) {

        }

    
    }   
    
    
}
