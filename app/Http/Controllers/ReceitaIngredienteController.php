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

    public function cadastrarIngrediente(Request $request, $id){
        $alimentos = Alimento::all();
        $receita = Receita::all();
        return view('cadastrar-ingrediente', [
            'alimentos' => $alimentos,
            'id' => $id
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
        $dados = $valores->All();
        $receita = Receita::find($dados['id_receitas']);
        $alimento = Alimento::find($dados['id_alimento']);

        $medida = $dados['medida'];
        if (isset($dados['quantidade'])) {
            $quantidade = $dados['quantidade'];
        }
        else {
            $quantidade = 1;
        }

        $quantidadeTotalAlimento = $medida * $quantidade;
        $quantidadeTotalReceita = $receita['quantidadeTotal'];
        $quantidadePorcao = $receita['quantidadePorcao'];

        $umidadeTACO = $alimento['umidade'];
        $proteinaTACO = $alimento['proteina'];
        $lipidioTACO = $alimento['lipideos'];
        $colesterolTACO = $alimento['colesterol'];
        $carboidratoTACO = $alimento['carboidrato'];
        $fibraAlimentarTACO = $alimento['fibraAlimentar'];
        $cinzasTACO = $alimento['cinzas'];
        $calcioTACO = $alimento['calcio'];
        $magnesioTACO = $alimento['magnesio'];
        $manganesTACO = $alimento['manganes'];
        $fosforoTACO = $alimento['fosforo'];
        $ferroTACO = $alimento['ferro'];
        $sodioTACO = $alimento['sodio'];
        $potassioTACO = $alimento['potassio'];
        $cobreTACO = $alimento['cobre'];
        $zincoTACO = $alimento['zinco'];
        $retinolTACO = $alimento['retinol'];
        $reTACO = $alimento['re'];
        $raeTACO = $alimento['rae'];
        $tiaminaTACO = $alimento['tiamina'];
        $riboflavinaTACO = $alimento['riboflavina'];
        $piridoxinaTACO = $alimento['piridoxina'];
        $niacinaTACO = $alimento['niacina'];
        $vitaminaCTACO = $alimento['vitaminaC'];
        $qporcao = $this->calculaAlimentoPorcao($quantidadeTotalAlimento,
        $quantidadeTotalReceita, $quantidadePorcao);

        //calcula umidade
        $qUmidade = $this->calculaComposicaoItens($qporcao, $umidadeTACO);

        //calcula proteina
        $qProteina = $this->calculaComposicaoItens($qporcao,$proteinaTACO);

        //calcula lipidios
        $qLipidios = $this->calculaComposicaoItens($qporcao,$lipidioTACO);

        //calcula colesterol
        $qColesterol = $this->calculaComposicaoItens($qporcao,$colesterolTACO);

        //calcula carboidrato
        $qCarboidrato = $this->calculaComposicaoItens($qporcao,$carboidratoTACO);

        //calcula fibraAlimentar
        $qFibraAlimentar = $this->calculaComposicaoItens($qporcao,$fibraAlimentarTACO);

        //calcula cinzas
        $qCinzas = $this->calculaComposicaoItens($qporcao,$cinzasTACO);

        //calcula calcio
        $qCalcio = $this->calculaComposicaoItens($qporcao,$calcioTACO);

        //calcula magnesio
        $qMagnesio = $this->calculaComposicaoItens($qporcao,$magnesioTACO);

        //calcula manganes
        $qManganes = $this->calculaComposicaoItens($qporcao,$manganesTACO);

        //calcula fosforo
        $qFosforo = $this->calculaComposicaoItens($qporcao,$fosforoTACO);

        //calcula ferro
        $qFerro = $this->calculaComposicaoItens($qporcao,$ferroTACO);

        //calcula sodio
        $qSodio = $this->calculaComposicaoItens($qporcao,$sodioTACO);

        //calcula potassio
        $qPotassio = $this->calculaComposicaoItens($qporcao,$potassioTACO);

        //calcula cobre
        $qCobre = $this->calculaComposicaoItens($qporcao,$cobreTACO);

        //calcula zinco
        $qZinco = $this->calculaComposicaoItens($qporcao,$zincoTACO);

        //calcula retinol
        $qRetinol = $this->calculaComposicaoItens($qporcao,$retinolTACO);

        //calcula re
        $qRe = $this->calculaComposicaoItens($qporcao,$reTACO);

        //calcula rae
        $qRae = $this->calculaComposicaoItens($qporcao,$raeTACO);

        //calcula tiamina
        $qTiamina = $this->calculaComposicaoItens($qporcao,$tiaminaTACO);

        //calcula riboflavina
        $qRiboflavina = $this->calculaComposicaoItens($qporcao,$riboflavinaTACO);

        //calcula piridoxina
        $qPiridoxina = $this->calculaComposicaoItens($qporcao,$piridoxinaTACO);

        //calcula niacina
        $qNiacina = $this->calculaComposicaoItens($qporcao,$niacinaTACO);

        //calcula vitaminaC
        $qVitaminaC = $this->calculaComposicaoItens($qporcao,$vitaminaCTACO);

        //calculo valor energético carboidrato
        $VECarboidratoKcal = $this->calculaValorEnergeticoKcal($qCarboidrato, 4);
        $VECarboidratoKj = $this->calculaValorEnergeticoKcal($qCarboidrato, 17);

        //calculo valor energético proteinas
        $VEProteinaKcal = $this->calculaValorEnergeticoKcal($qProteina, 4);
        $VEProteinaKj = $this->calculaValorEnergeticoKcal($qProteina, 17);

        //calculo valor energético lipideos
        $VELipideosKcal = $this->calculaValorEnergeticoKcal($qLipidios, 9);
        $VELipideosKj = $this->calculaValorEnergeticoKcal($qLipidios, 37);

        $valorTotalKcal = $this->calculoValorEnergeticoTotal($VECarboidratoKcal, $VEProteinaKcal, $VELipideosKcal);
        $valorTotalKj = $this->calculoValorEnergeticoTotal($VECarboidratoKj, $VEProteinaKj, $VELipideosKj);

        $dados['umidade'] = $qUmidade;
        $dados['energiaKcal'] = $valorTotalKcal;
        $dados['energiaKj'] = $valorTotalKj;
        $dados['proteina'] = $qProteina;
        $dados['lipideos'] = $qLipidios;
        $dados['colesterol'] = $qColesterol;
        $dados['carboidrato'] = $qCarboidrato;
        $dados['fibraAlimentar'] = $qFibraAlimentar;
        $dados['cinzas'] = $qCinzas;
        $dados['calcio'] = $qCalcio;
        $dados['magnesio'] = $qMagnesio;
        $dados['manganes'] = $qManganes;
        $dados['fosforo'] = $qFosforo;
        $dados['ferro'] = $qFerro;
        $dados['sodio'] = $qSodio;
        $dados['potassio'] = $qPotassio;
        $dados['cobre'] = $qCobre;
        $dados['zinco'] = $qZinco;
        $dados['retinol'] = $qRetinol;
        $dados['re'] = $qRe;
        $dados['rae'] = $qRae;
        $dados['tiamina'] = $qTiamina;
        $dados['riboflavina'] = $qRiboflavina;
        $dados['piridoxina'] = $qPiridoxina;
        $dados['niacina'] = $qNiacina;
        $dados['vitaminaC'] = $qVitaminaC;

        $resposta = ReceitaIngrediente::create($dados);

        // return redirect()
        //           ->route('ingrediente.cadastrar', [$dados['id_receitas']])
        //           ->with('success', 'Os Dados do ingrediente foram cadastrados!');
    }

    public function calculaAlimentoPorcao($quantidadeTotalAlimento,
    $quantidadeTotalReceita, $quantidadePorcao){
        $result = $quantidadeTotalAlimento * $quantidadePorcao / $quantidadeTotalReceita;
        return round((float)$result, 2);
    }

    public function calculaComposicaoItens($qporcao,$composicaoTACO)
    {
        $result = $qporcao * $composicaoTACO / 100;
        return round((float)$result, 2);
    }

    public function calculaValorEnergeticoKcal($quantidade, $conversao)
    {
        $result = $quantidade * $conversao;
        return round((float)$result, 2);
    }

    public function calculoValorEnergeticoTotal($VECarboidratoKcal, $VEProteinaKcal, $VELipideosKcal)
    {
        $result = $VECarboidratoKcal + $VEProteinaKcal + $VELipideosKcal;
        return round((float)$result, 2);
    }
}
