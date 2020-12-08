<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AvAntropometrica;
use App\ClassificacaoGeral;
use Carbon\Carbon;
use App\Paciente;
use DB;

class AvaliacaoController extends Controller
{
    public function insert(Request $valores){
    $dados = new AvAntropometrica();
    $geral = new ClassificacaoGeral();
    $paciente = Paciente::find($valores->id_paciente);

    $dados->id_paciente = $valores->id_paciente;
    $dados->data = $valores->data;
    $dados->peso = $valores->peso;
    $dados->altura = $valores->altura;
    $dados->pct = $valores->pct;
    $alturacentimetros = $valores->altura / 100;
    $dados->imc = ($valores->peso)/($alturacentimetros * $alturacentimetros);

    $dt = new Carbon($dados->data);
    $dtt = new Carbon($paciente->dataNascimento);
    /*diffInYears diffInMonths()*/
    $dados->idade =  $dt->diffInMonths($dtt)/12;

    $dados->idade =  (int)$dados->idade;

    //ok

    $aux = ($dt->diffInMonths($dtt)%12);
    if ($aux == 1) {
      $aux = $aux/100;
    }
    elseif ($aux <10) {
      $aux = $aux/10;
    }elseif ($aux <=11) {
      $aux = $aux/100;
    }else {
      $aux = 0;
    }
    $aux = $aux + $dados->idade;

    $dados->idade = $aux;

    $resposta = $dados->save();

    //salvar na tabela classificação geral
    $variavel = ClassificacaoGeral::find($dados->id_paciente);

    if ($variavel == null) {//se não existir eu crio um novo registro,

      $geral->id_paciente = $dados->id_paciente;
      $geral->data        = $dados->data;
      $geral->peso        = $dados->peso;
      $geral->altura      = $dados->altura;
      $geral->pct         = $dados->pct;
      $geral->imc         = $dados->imc;
      $geral->idade       = $dados->idade;
      $geral->save();
    }
    else {//se existir eu atualizo
      $variavel->id_paciente = $dados->id_paciente;
      $variavel->data        = $dados->data;
      $variavel->peso        = $dados->peso;
      $variavel->altura      = $dados->altura;
      $variavel->pct         = $dados->pct;
      $variavel->imc         = $dados->imc;
      $variavel->idade       = $dados->idade;
      $variavel->save();
    }

    if ($resposta)
      return redirect()
                ->route('paciente.pesquisar')
                ->with('success', 'Os dados do paciente foram cadastrados!');
      return redirect()
                ->back()
                ->with('error', 'Falha ao cadastrar os dados!');
    

    }
}
