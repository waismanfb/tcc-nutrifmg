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

        $carboidratoTACO = $alimento['carboidrato'];
        $proteinaTACO = $alimento['proteina'];
        $lipidioTACO = $alimento['lipideos'];
        $qporcao = $this->calculaAlimentoPorcao($quantidadeTotalAlimento,
        $quantidadeTotalReceita, $quantidadePorcao);

        //calcula carboidrato
        $qCarboidrato = $this->calculaComposicaoItens($qporcao,$carboidratoTACO);

        //calcula proteina
        $qProteina = $this->calculaComposicaoItens($qporcao,$proteinaTACO);

        //calcula lipidios
        $qLipidios = $this->calculaComposicaoItens($qporcao,$lipidioTACO);

        //calculo valor energético carboidrato
        $VECarboidratoKcal = $this->calculaValorEnergeticoKcal($qCarboidrato, 4);
        $VECarboidratoKj = $this->calculaValorEnergeticoKcal($qCarboidrato, 17);

        //calculo valor energético proteinas
        $VEProteinaKcal = $this->calculaValorEnergeticoKcal($qProteina, 4);
        $VEProteinaKj = $this->calculaValorEnergeticoKcal($qProteina, 17);

        //calculo valor energético lipideos
        $VELipideosKcal = $this->calculaValorEnergeticoKcal($qLipidios, 9);
        $VELipideosKj = $this->calculaValorEnergeticoKcal($qLipidios, 37);

        $valorTotal = $this->calculoValorEnergeticoTotal($VECarboidratoKcal, $VEProteinaKcal, $VELipideosKcal);

        $dados['energiaKcal'] = $valorTotal;
        $dados['proteina'] = $qProteina;
        $dados['lipideos'] = $qLipidios;
        $dados['carboidrato'] = $qCarboidrato;

        $resposta = ReceitaIngrediente::create($dados);

        echo "<script>alert('Alimento Cadastrado com sucesso!!');</alert>";

        return view('home');
    }

    public function calculaAlimentoPorcao($quantidadeTotalAlimento,
    $quantidadeTotalReceita, $quantidadePorcao){
        $result = $quantidadeTotalAlimento * $quantidadePorcao / $quantidadeTotalReceita;
        return round((float)$result, 4);
    }

    public function calculaComposicaoItens($qporcao,$composicaoTACO)
    {
        $result = $qporcao * $composicaoTACO / 100;
        return round((float)$result, 4);
    }

    public function calculaValorEnergeticoKcal($quantidade, $conversao)
    {
        $result = $quantidade * $conversao;
        return round((float)$result, 4);
    }

    public function calculoValorEnergeticoTotal($VECarboidratoKcal, $VEProteinaKcal, $VELipideosKcal)
    {
        $result = $VECarboidratoKcal + $VEProteinaKcal + $VELipideosKcal;
        return round((float)$result, 4);
    }
}
