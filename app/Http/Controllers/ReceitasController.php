<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receita;
use App\ReceitaIngrediente;
use DB;

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
                      ->with('success', 'Os Dados da Receita foram cadastrados!');
            return redirect()
                      ->back()
                      ->with('error', 'Falha ao cadastrar os dados da receita!');

        }catch (Exception $e) {

        }
    }

    public function exibir()
    {
      $registros = Receita::orderBy('id','DESC')->paginate(10);
      return view('dados-receitas', compact('registros'));
    }

    public function exibirById($id)
    {
      $registros = Receita::where('id',$id)->first();
      $ingredientes = ReceitaIngrediente::where('id_receitas',$id)->get();
      $alimentos = DB::table('alimentos')
                        ->join('receita_ingredientes', 'alimentos.id', '=', 'receita_ingredientes.id_alimento')
                        ->select('alimentos.nome', 'receita_ingredientes.*')
                        ->where('receita_ingredientes.id_receitas', $id)->get();


      $totalEnergia = $this->calculoTotalEnergia($ingredientes);
      $totalProteina = $this->calculoTotalProteina($ingredientes);
      $totalLipideos = $this->calculoTotalLipideos($ingredientes);
      $totalCarboidratos = $this->calculoTotalCarboidratos($ingredientes);

      return view('receita-ingredientes', [
          'registros' => $registros,
          'ingredientes' => $ingredientes,
          'totalEnergia' => $totalEnergia,
          'totalProteina' => $totalProteina,
          'totalLipideos' => $totalLipideos,
          'totalCarboidrato' => $totalCarboidratos,
          'alimentos' => $alimentos
      ]);
    }

    public function pesquisarReceita(Request $request)
    {
      $registros = Receita::where('nome', 'LIKE', '%'. $request->nome . '%')->get();

        return view('dados-receitas', [
          'registros' => $registros,
          'nome' => $request->nome
        ]);

    }

    public function calculoTotalEnergia($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['energiaKcal'];
        }
        return round((float)$result, 4);
    }

    public function calculoTotalProteina($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['proteina'];
        }
        return round((float)$result, 4);
    }

    public function calculoTotalLipideos($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['lipideos'];
        }
        return round((float)$result, 4);
    }

    public function calculoTotalCarboidratos($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['carboidrato'];
        }
        return round((float)$result, 4);
    }

}
