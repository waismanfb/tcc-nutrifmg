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
        $receita->quantidadeTotal = $request->quantidadeTotal;
        $receita->quantidadePorcao = $request->quantidadePorcao;

        $resposta = $receita->save();

        if ($resposta)
        return redirect()
                  ->route('receita.editar', $id)
                  ->with('success', 'Os Dados da Receita foram cadastrados!');
        return redirect()
                  ->back()
                  ->with('error', 'Falha ao cadastrar os dados da receita!');

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

    public function editar($id)
    {
        $receita = Receita::find($id);
        return view('cadastrar-receita', compact('receita'));
    }

    public function exibirById($id)
    {
      $registros = Receita::where('id',$id)->first();
      $ingredientes = ReceitaIngrediente::where('id_receitas',$id)->get();
      $alimentos = DB::table('alimentos')
                        ->join('receita_ingredientes', 'alimentos.id', '=', 'receita_ingredientes.id_alimento')
                        ->select('alimentos.nome', 'receita_ingredientes.*')
                        ->where('receita_ingredientes.id_receitas', $id)->get();

      $totalUmidade = $this->calculoTotalUmidade($ingredientes);
      $totalEnergiaKcal = $this->calculoTotalEnergiaKcal($ingredientes);
      $totalEnergiaKj = $this->calculoTotalEnergiaKj($ingredientes);
      $totalProteina = $this->calculoTotalProteina($ingredientes);
      $totalLipideos = $this->calculoTotalLipideos($ingredientes);
      $totalColesterol = $this->calculoTotalColesterol($ingredientes);
      $totalCarboidratos = $this->calculoTotalCarboidratos($ingredientes);
      $totalFibraAlimentar = $this->calculoTotalFibraAlimentar($ingredientes);
      $totalCinzas = $this->calculoTotalCinzas($ingredientes);
      $totalCalcio = $this->calculoCalcio($ingredientes);
      $totalMagnesio = $this->calculoMagnesio($ingredientes);
      $totalManganes = $this->calculoManganes($ingredientes);
      $totalFosforo = $this->calculoFosforo($ingredientes);
      $totalFerro = $this->calculoFerro($ingredientes);
      $totalSodio = $this->calculoSodio($ingredientes);
      $totalPotassio = $this->calculoPotassio($ingredientes);
      $totalCobre = $this->calculoCobre($ingredientes);
      $totalZinco = $this->calculoZinco($ingredientes);
      $totalRetinol = $this->calculoRetinol($ingredientes);
      $totalRe = $this->calculoRe($ingredientes);
      $totalRae = $this->calculoRae($ingredientes);
      $totalTiamina = $this->calculoTiamina($ingredientes);
      $totalRiboflavina = $this->calculoRiboflavina($ingredientes);
      $totalPiridoxina = $this->calculoPiridoxina($ingredientes);
      $totalNiacina = $this->calculoNiacina($ingredientes);
      $totalVitaminaC = $this->calculoVitaminaC($ingredientes);
    

      return view('receita-ingredientes', [
          'idReceita' => $id,
          'registros' => $registros,
          'ingredientes' => $ingredientes,
          'totalUmidade' => $totalUmidade,
          'totalEnergiaKcal' => $totalEnergiaKcal,
          'totalEnergiaKj' => $totalEnergiaKj,
          'totalProteina' => $totalProteina,
          'totalLipideos' => $totalLipideos,
          'totalColesterol' => $totalColesterol,
          'totalCarboidrato' => $totalCarboidratos,
          'totalFibraAlimentar' => $totalFibraAlimentar,
          'totalCinzas' => $totalCinzas,
          'totalCalcio' => $totalCalcio,
          'totalMagnesio' => $totalMagnesio,
          'totalManganes' => $totalManganes,
          'totalFosforo' => $totalFosforo,
          'totalFerro' => $totalFerro,
          'totalSodio' => $totalSodio,
          'totalPotassio'=> $totalPotassio,
          'totalCobre'=> $totalCobre,
          'totalZinco'=> $totalZinco,
          'totalRetinol'=> $totalRetinol,
          'totalRe'=> $totalRe,
          'totalRae'=> $totalRae,
          'totalTiamina'=> $totalTiamina,
          'totalRiboflavina'=> $totalRiboflavina,
          'totalPiridoxina'=> $totalPiridoxina,
          'totalNiacina'=> $totalNiacina,
          'totalVitaminaC'=> $totalVitaminaC,
          'alimentos' => $alimentos
      ]);
    }

    public function pesquisarReceita(Request $request)
    {
      $registros = Receita::where('nome', 'LIKE', '%'. $request->nome . '%')->orderBy('id','DESC')->paginate(10);

      $registros->appends(['nome' => $request->nome]);

        return view('dados-receitas', [
          'registros' => $registros,
          'nome' => $request->nome
        ]);

    }

    public function calculoTotalUmidade($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['umidade'];
        }
        return round((float)$result, 2);
    }

    public function calculoTotalEnergiaKcal($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['energiaKcal'];
        }
        return round((float)$result, 2);
    }

    public function calculoTotalEnergiaKj($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['energiaKj'];
        }
        return round((float)$result, 2);
    }

    public function calculoTotalProteina($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['proteina'];
        }
        return round((float)$result, 2);
    }

    public function calculoTotalLipideos($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['lipideos'];
        }
        return round((float)$result, 2);
    }
    
    public function calculoTotalColesterol($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['colesterol'];
        }
        return round((float)$result, 2);
    }

    public function calculoTotalCarboidratos($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['carboidrato'];
        }
        return round((float)$result, 2);
    }

    public function calculoTotalFibraAlimentar($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['fibraAlimentar'];
        }
        return round((float)$result, 2);
    }
    public function calculoTotalCinzas($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['cinzas'];
        }
        return round((float)$result, 2);
    }
    public function calculoCalcio($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['calcio'];
        }
        return round((float)$result, 2);
    }

    public function calculoMagnesio($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['magnesio'];
        }
        return round((float)$result, 2);
    }
    
    public function calculoManganes($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['manganes'];
        }
        return round((float)$result, 2);
    }

    public function calculoFosforo($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['fosforo'];
        }
        return round((float)$result, 2);
    }

    public function calculoFerro($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['ferro'];
        }
        return round((float)$result, 2);
    }
    public function calculoSodio($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['sodio'];
        }
        return round((float)$result, 2);
    }
    public function calculoPotassio($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['potassio'];
        }
        return round((float)$result, 2);
    }
    public function calculoCobre($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['Cobre'];
        }
        return round((float)$result, 2);
    }
    public function calculoZinco($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['zinco'];
        }
        return round((float)$result, 2);
    }
    public function calculoRetinol($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['retinol'];
        }
        return round((float)$result, 2);
    }
    public function calculoRe($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['re'];
        }
        return round((float)$result, 2);
    }
    public function calculoRae($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['rae'];
        }
        return round((float)$result, 2);
    }
    public function calculoTiamina($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['tiamina'];
        }
        return round((float)$result, 2);
    }
    public function calculoRiboflavina($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['riboflavina'];
        }
        return round((float)$result, 2);
    }
    public function calculoPiridoxina($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['piridoxina'];
        }
        return round((float)$result, 2);
    }
    public function calculoNiacina($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['niacina'];
        }
        return round((float)$result, 2);
    }
    public function calculoVitaminaC($ingredientes)
    {
        $result = 0;
        foreach ($ingredientes as $key => $value) {
            $result = $result + $ingredientes[$key]['vitaminaC'];
        }
        return round((float)$result, 2);
    }




    public function delete()
    {
      $receita_id = $_POST['receita_id'];
      DB::table('receitas')->where('id', '=', $receita_id)->delete();
      DB::table('receita_ingredientes')->where('id_receitas', '=', $receita_id)->delete();
    }

}
