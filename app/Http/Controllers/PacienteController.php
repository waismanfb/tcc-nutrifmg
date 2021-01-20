<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use App\Paciente;
use App\AvAntropometrica;
use App\ClassificacaoGeral;
use Carbon\Carbon;
use DB;

class PacienteController extends Controller
{
  private $paciente;

  public function __construct(Paciente $todosPacientes){
    $this->paciente = $todosPacientes;
  }

  public function cadastrar(){
    return view('cadastrar-paciente');
  }

  public function editar($id){
    $paciente = Paciente::find($id);
    return view('cadastrar-paciente', compact('paciente'));
  }


  public function update(Request $request, $id){

    $paciente = Paciente::find($id);
    $paciente->nome = $request->nome;
    $paciente->sexo = $request->sexo;
    $paciente->dataNascimento = $request->dataNascimento;
    $paciente->anosEstudo = $request->anosEstudo;
    $paciente->renda = $request->renda;
    $paciente->curso = $request->curso;
    $paciente->numPessoasCasa = $request->numPessoasCasa;
    $paciente->moradia = $request->moradia;
    $paciente->numRefeicoes = $request->numRefeicoes;
    $resposta = $paciente->save();

    if ($resposta)
      return redirect()
                ->route('paciente.pesquisar')
                ->with('success', 'Os Dados do paciente foram atualizados!');
      return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar os dados!');
  }

  public function insert(Request $valores){
    try {
      $dados = $valores->All();
      // dd($dados);
      $dados['numRefeicoes'] = 0;
      if(isset($dados['cafe'])){
        $dados['numRefeicoes'] = $dados['numRefeicoes'] + $dados['cafe'];
      }
      if(isset($dados['almoco'])){
        $dados['numRefeicoes'] = $dados['numRefeicoes'] + $dados['almoco'];
      }
      if(isset($dados['janta'])){
        $dados['numRefeicoes'] = $dados['numRefeicoes'] + $dados['janta'];
      }

      $dados['renda'] = (double) $dados['renda'];

      $mensagens = [
        'nome.required' => 'O nome é obrigatório.',
        'nome.min' => 'O nome não pode ser menor que 3 caracteres',
        'nome.max' => 'O nome não pode ser maior que 100 caracteres',
        'anosEstudo.required' => 'Informe a quantidade de anos estudado',
        'renda.required' => 'Informe a renda familiar',
        'numPessoasCasa.required' => 'Informe o número de pessoas na casa do pacinete',
        'dataNascimento.required' => 'Informe a data de Nascimento',
      ];
      $validacao = validator($dados, $this->paciente->campos,$mensagens);
      if ($validacao->fails()) {
        return redirect()
        ->route('paciente.cadastrar')
        ->withErrors($validacao)
        ->withInput();
      }
      $resposta = Paciente::create($dados);


      if ($resposta)
        return redirect()
                  ->route('paciente.cadastrar')
                  ->with('success', 'Os Dados do paciente foram cadastrados!');
        return redirect()
                  ->back()
                  ->with('error', 'Falha ao cadastrar os dados do paciente!');
    } catch (Exception $e) {

    }
  }

    //mostra todos os pacientes
  public function pesquisar($mem=0){
    $registros = Paciente::all();
    $tipo = 'cafeDaManha';

    return view('pacientes_individual', compact('registros','mem', 'tipo'));
  }

  public function exibir($id)
  {
    $registros = Paciente::find($id);

    return view('dados-paciente', compact('registros') );

  }

  //mostra os pacientes pesquisados
  public function pesquisados(Request $request)
  {
    $registros = Paciente::where('nome', 'LIKE', '%'. $request->nome . '%')->get();
    $tipo = 'cafeDaManha';

    if($request->tela == 'paciente_individual')
    {
        return view('pacientes_individual', [
          'registros' => $registros,
          'nome' => $request->nome,
          'tipo' => $tipo
        ]);
    }
    else
    {
        return view('dietaIndividual', compact('registros'));
    }

  }

  public function ResultadoClassificacao($valor1, $valor2, $valor3){
  // $imc = $registros[$i]->imc;
  // $anos = $registros[$i]->idade;
  // $sexo = $registros[$i]->sexo;
    $imc = $valor1;
    $anos = $valor2;
    $sexo = $valor3;
    $score;
    $meses = 0;
  //$ei = $_POST['ei'];//estatura por idade
    $a="Abaixo de -3";
    $b="Entre -3 e 2";
    $c="Entre -2 e -1";
    $d="Entre -1 e 0";
    $e="Entre 0 e 1";
    $f="Entre 1 e 2";
    $g="Entre 2 e 3";
    $h="Acima de 3";
     //__________________________________ FEMININO _____________________
    if ($sexo == 2) {

      switch ($anos) {
        case 10.0
        :            $meses = 120;
        if($imc < 12.4){ $score = $a;} elseif($imc >=12.4 and $imc <13.5){$score = $b;} elseif($imc >=13.5 and $imc <14.9){$score = $c;} elseif($imc >=14.9 and $imc <16.7){$score = $d;} elseif($imc >= 16.7 and $imc <19.1){$score = $e;} elseif($imc >=19.1 and $imc <22.7){$score = $f;} elseif($imc >= 22.7 and $imc <28.5){$score = $g;} elseif($imc >= 28.5){$score = $h;} break;

        case 10.01:
        $meses = 121;
        if($imc < 12.4){ $score = $a;} elseif($imc >=12.4 and $imc <13.5){$score = $b;} elseif($imc >=13.5 and $imc <14.9){$score = $c;} elseif($imc >=14.9 and $imc <16.7){$score = $d;} elseif($imc >= 16.7 and $imc <19.1){$score = $e;} elseif($imc >=19.1 and $imc <22.7){$score = $f;} elseif($imc >= 22.7 and $imc <28.5){$score = $g;} elseif($imc >= 28.5){$score = $h;} break;

        case 10.2 :
        $meses = 122;
        if($imc < 12.4){ $score = $a;} elseif($imc >=12.4 and $imc <13.5){$score = $b;} elseif($imc >=13.5 and $imc <14.9){$score = $c;} elseif($imc >=14.9 and $imc <16.7){$score = $d;} elseif($imc >= 16.7 and $imc <19.2){$score = $e;} elseif($imc >=19.2 and $imc <22.8){$score = $f;} elseif($imc >= 22.8 and $imc <28.7){$score = $g;} elseif($imc >= 28.7){$score = $h;} break;

        case 10.3 :
        $meses = 123;
        if($imc < 12.5){ $score = $a;} elseif($imc >=12.5 and $imc <13.6){$score = $b;} elseif($imc >=13.6 and $imc <15.0){$score = $c;} elseif($imc >=15.0 and $imc <16.8){$score = $d;} elseif($imc >= 16.8 and $imc <19.2){$score = $e;} elseif($imc >=19.2 and $imc <22.8){$score = $f;} elseif($imc >= 22.8 and $imc <28.8){$score = $g;} elseif($imc >= 28.8){$score = $h;} break;

        case 10.4 :
        $meses = 124;
        if($imc < 12.5){ $score = $a;} elseif($imc >=12.5 and $imc <13.6){$score = $b;} elseif($imc >=13.6 and $imc <15.0){$score = $c;} elseif($imc >=15.0 and $imc <16.8){$score = $d;} elseif($imc >= 16.8 and $imc <19.3){$score = $e;} elseif($imc >=19.3 and $imc <22.9){$score = $f;} elseif($imc >= 22.9 and $imc <29.0){$score = $g;} elseif($imc >= 29.0){$score = $h;} break;

        case 10.5 :
        $meses = 125;
        if($imc < 12.5){ $score = $a;} elseif($imc >=12.5 and $imc <13.6){$score = $b;} elseif($imc >=13.6 and $imc <15.0){$score = $c;} elseif($imc >=15.0 and $imc <16.9){$score = $d;} elseif($imc >= 16.9 and $imc <19.4){$score = $e;} elseif($imc >=19.4 and $imc <23.0){$score = $f;} elseif($imc >= 23.0 and $imc <29.1){$score = $g;} elseif($imc >= 29.1){$score = $h;} break;

        case 10.6 :
        $meses = 126;
        if($imc < 12.5){ $score = $a;} elseif($imc >=12.5 and $imc <13.7){$score = $b;} elseif($imc >=13.7 and $imc <15.1){$score = $c;} elseif($imc >=15.1 and $imc <16.9){$score = $d;} elseif($imc >= 16.9 and $imc <19.4){$score = $e;} elseif($imc >=19.4 and $imc <23.1){$score = $f;} elseif($imc >= 23.1 and $imc <29.3){$score = $g;} elseif($imc >= 29.3){$score = $h;} break;

        case 10.7 :
        $meses = 127;
        if($imc < 12.6){ $score = $a;} elseif($imc >=12.6 and $imc <13.7){$score = $b;} elseif($imc >=13.7 and $imc <15.1){$score = $c;} elseif($imc >=15.1 and $imc <17.0){$score = $d;} elseif($imc >= 17.0 and $imc <19.5){$score = $e;} elseif($imc >=19.5 and $imc <23.2){$score = $f;} elseif($imc >= 23.2 and $imc <29.4){$score = $g;} elseif($imc >= 29.4){$score = $h;} break;

        case 10.8 :
        $meses = 128;
        if($imc < 12.6){ $score = $a;} elseif($imc >=12.6 and $imc <13.7){$score = $b;} elseif($imc >=13.7 and $imc <15.2){$score = $c;} elseif($imc >=15.2 and $imc <17.0){$score = $d;} elseif($imc >= 17.0 and $imc <19.6){$score = $e;} elseif($imc >=19.6 and $imc <23.3){$score = $f;} elseif($imc >= 23.3 and $imc <29.6){$score = $g;} elseif($imc >= 29.6){$score = $h;} break;

        case 10.9 :
        $meses = 129;
        if($imc < 12.6){ $score = $a;} elseif($imc >=12.6 and $imc <13.8){$score = $b;} elseif($imc >=13.8 and $imc <15.2){$score = $c;} elseif($imc >=15.2 and $imc <17.1){$score = $d;} elseif($imc >= 17.1 and $imc <19.6){$score = $e;} elseif($imc >=19.6 and $imc <23.4){$score = $f;} elseif($imc >= 23.4 and $imc <29.7){$score = $g;} elseif($imc >= 29.7){$score = $h;} break;

        case 10.10:
        $meses = 130;
        if($imc < 12.7){ $score = $a;} elseif($imc >=12.7 and $imc <13.8){$score = $b;} elseif($imc >=13.8 and $imc <15.3){$score = $c;} elseif($imc >=15.3 and $imc <17.1){$score = $d;} elseif($imc >= 17.1 and $imc <19.7){$score = $e;} elseif($imc >=19.7 and $imc <23.5){$score = $f;} elseif($imc >= 23.5 and $imc <29.9){$score = $g;} elseif($imc >= 29.9){$score = $h;} break;

        case 10.11:
        $meses = 131;
        if($imc < 12.7){ $score = $a;} elseif($imc >=12.7 and $imc <13.8){$score = $b;} elseif($imc >=13.8 and $imc <15.3){$score = $c;} elseif($imc >=15.3 and $imc <17.2){$score = $d;} elseif($imc >= 17.2 and $imc <19.8){$score = $e;} elseif($imc >=19.8 and $imc <23.6){$score = $f;} elseif($imc >= 23.6 and $imc <30.0){$score = $g;} elseif($imc >= 30.0){$score = $h;} break;

        case 11.0 :
        $meses = 132;
        if($imc < 12.7){ $score = $a;} elseif($imc >=12.7 and $imc <13.9){$score = $b;} elseif($imc >=13.9 and $imc <15.3){$score = $c;} elseif($imc >=15.3 and $imc <17.2){$score = $d;} elseif($imc >= 17.2 and $imc <19.9){$score = $e;} elseif($imc >=19.9 and $imc <23.7){$score = $f;} elseif($imc >= 23.7 and $imc <30.2){$score = $g;} elseif($imc >= 30.2){$score = $h;} break;

        case 11.01:
        $meses = 133;
        if($imc < 12.8){ $score = $a;} elseif($imc >=12.8 and $imc <13.9){$score = $b;} elseif($imc >=13.9 and $imc <15.4){$score = $c;} elseif($imc >=15.4 and $imc <17.3){$score = $d;} elseif($imc >= 17.3 and $imc <19.9){$score = $e;} elseif($imc >=19.9 and $imc <23.8){$score = $f;} elseif($imc >= 23.8 and $imc <30.3){$score = $g;} elseif($imc >= 30.3){$score = $h;} break;

        case 11.2 :
        $meses = 134;
        if($imc < 12.8){ $score = $a;} elseif($imc >=12.8 and $imc <14.0){$score = $b;} elseif($imc >=14.0 and $imc <15.4){$score = $c;} elseif($imc >=15.4 and $imc <17.4){$score = $d;} elseif($imc >= 17.4 and $imc <20.0){$score = $e;} elseif($imc >=20.0 and $imc <23.9){$score = $f;} elseif($imc >= 23.9 and $imc <30.5){$score = $g;} elseif($imc >= 30.5){$score = $h;} break;

        case 11.3 :
        $meses = 135;
        if($imc < 12.8){ $score = $a;} elseif($imc >=12.8 and $imc <14.0){$score = $b;} elseif($imc >=14.0 and $imc <15.5){$score = $c;} elseif($imc >=15.5 and $imc <17.4){$score = $d;} elseif($imc >= 17.4 and $imc <20.1){$score = $e;} elseif($imc >=20.1 and $imc <24.0){$score = $f;} elseif($imc >= 24.0 and $imc <30.6){$score = $g;} elseif($imc >= 30.6){$score = $h;} break;

        case 11.4 :
        $meses = 136;
        if($imc < 12.9){ $score = $a;} elseif($imc >=12.9 and $imc <14.0){$score = $b;} elseif($imc >=14.0 and $imc <15.5){$score = $c;} elseif($imc >=15.5 and $imc <17.5){$score = $d;} elseif($imc >= 17.5 and $imc <20.2){$score = $e;} elseif($imc >=20.2 and $imc <24.1){$score = $f;} elseif($imc >= 24.1 and $imc <30.8){$score = $g;} elseif($imc >= 30.8){$score = $h;} break;

        case 11.5 :
        $meses = 137;
        if($imc < 12.9){ $score = $a;} elseif($imc >=12.9 and $imc <14.1){$score = $b;} elseif($imc >=14.1 and $imc <15.6){$score = $c;} elseif($imc >=15.6 and $imc <17.5){$score = $d;} elseif($imc >= 17.5 and $imc <20.2){$score = $e;} elseif($imc >=20.2 and $imc <24.2){$score = $f;} elseif($imc >= 24.2 and $imc <30.9){$score = $g;} elseif($imc >= 30.9){$score = $h;} break;

        case 11.6 :
        $meses = 138;
        if($imc < 12.9){ $score = $a;} elseif($imc >=12.9 and $imc <14.1){$score = $b;} elseif($imc >=14.1 and $imc <15.6){$score = $c;} elseif($imc >=15.6 and $imc <17.6){$score = $d;} elseif($imc >= 17.6 and $imc <20.3){$score = $e;} elseif($imc >=20.3 and $imc <24.3){$score = $f;} elseif($imc >= 24.3 and $imc <31.1){$score = $g;} elseif($imc >= 31.1){$score = $h;} break;

        case 11.7 :
        $meses = 139;
        if($imc < 13.0){ $score = $a;} elseif($imc >=13.0 and $imc <14.2){$score = $b;} elseif($imc >=14.2 and $imc <15.7){$score = $c;} elseif($imc >=15.7 and $imc <17.7){$score = $d;} elseif($imc >= 17.7 and $imc <20.4){$score = $e;} elseif($imc >=20.4 and $imc <24.4){$score = $f;} elseif($imc >= 24.4 and $imc <31.2){$score = $g;} elseif($imc >= 31.2){$score = $h;} break;

        case 11.8 :
        $meses = 140;
        if($imc < 13.0){ $score = $a;} elseif($imc >=13.0 and $imc <14.2){$score = $b;} elseif($imc >=14.2 and $imc <15.7){$score = $c;} elseif($imc >=15.7 and $imc <17.7){$score = $d;} elseif($imc >= 17.7 and $imc <20.5){$score = $e;} elseif($imc >=20.5 and $imc <24.5){$score = $f;} elseif($imc >= 24.5 and $imc <31.4){$score = $g;} elseif($imc >= 31.4){$score = $h;} break;

        case 11.9 :
        $meses = 141;
        if($imc < 13.0){ $score = $a;} elseif($imc >=13.0 and $imc <14.3){$score = $b;} elseif($imc >=14.3 and $imc <15.8){$score = $c;} elseif($imc >=15.8 and $imc <17.8){$score = $d;} elseif($imc >= 17.8 and $imc <20.6){$score = $e;} elseif($imc >=20.6 and $imc <24.7){$score = $f;} elseif($imc >= 24.7 and $imc <31.5){$score = $g;} elseif($imc >= 31.5){$score = $h;} break;

        case 11.10:
        $meses = 142;
        if($imc < 13.1){ $score = $a;} elseif($imc >=13.1 and $imc <14.3){$score = $b;} elseif($imc >=14.3 and $imc <15.8){$score = $c;} elseif($imc >=15.8 and $imc <17.9){$score = $d;} elseif($imc >= 17.9 and $imc <20.6){$score = $e;} elseif($imc >=20.6 and $imc <24.8){$score = $f;} elseif($imc >= 24.8 and $imc <31.6){$score = $g;} elseif($imc >= 31.6){$score = $h;} break;

        case 11.11:
        $meses = 143;
        if($imc < 13.1){ $score = $a;} elseif($imc >=13.1 and $imc <14.3){$score = $b;} elseif($imc >=14.3 and $imc <15.9){$score = $c;} elseif($imc >=15.9 and $imc <17.9){$score = $d;} elseif($imc >= 17.9 and $imc <20.7){$score = $e;} elseif($imc >=20.7 and $imc <24.9){$score = $f;} elseif($imc >= 24.9 and $imc <31.8){$score = $g;} elseif($imc >= 31.8){$score = $h;} break;

        case 12.0 :
        $meses = 144;
        if($imc < 13.2){ $score = $a;} elseif($imc >=13.2 and $imc <14.4){$score = $b;} elseif($imc >=14.4 and $imc <16.0){$score = $c;} elseif($imc >=16.0 and $imc <18.0){$score = $d;} elseif($imc >= 18.0 and $imc <20.8){$score = $e;} elseif($imc >=20.8 and $imc <25.0){$score = $f;} elseif($imc >= 25.0 and $imc <31.9){$score = $g;} elseif($imc >= 31.9){$score = $h;} break;

        case 12.01:
        $meses = 145;
        if($imc < 13.2){ $score = $a;} elseif($imc >=13.2 and $imc <14.4){$score = $b;} elseif($imc >=14.4 and $imc <16.0){$score = $c;} elseif($imc >=16.0 and $imc <18.1){$score = $d;} elseif($imc >= 18.1 and $imc <20.9){$score = $e;} elseif($imc >=20.9 and $imc <25.1){$score = $f;} elseif($imc >= 25.1 and $imc <32.0){$score = $g;} elseif($imc >= 32.0){$score = $h;} break;

        case 12.2 :
        $meses = 146;
        if($imc < 13.2){ $score = $a;} elseif($imc >=13.2 and $imc <14.5){$score = $b;} elseif($imc >=14.5 and $imc <16.1){$score = $c;} elseif($imc >=16.1 and $imc <18.1){$score = $d;} elseif($imc >= 18.1 and $imc <21.0){$score = $e;} elseif($imc >=21.0 and $imc <25.2){$score = $f;} elseif($imc >= 25.2 and $imc <32.2){$score = $g;} elseif($imc >= 32.2){$score = $h;} break;

        case 12.3 :
        $meses = 147;
        if($imc < 13.3){ $score = $a;} elseif($imc >=13.3 and $imc <14.5){$score = $b;} elseif($imc >=14.5 and $imc <16.1){$score = $c;} elseif($imc >=16.1 and $imc <18.2){$score = $d;} elseif($imc >= 18.2 and $imc <21.1){$score = $e;} elseif($imc >=21.1 and $imc <25.3){$score = $f;} elseif($imc >= 25.3 and $imc <32.3){$score = $g;} elseif($imc >= 32.3){$score = $h;} break;

        case 12.4 :
        $meses = 148;
        if($imc < 13.3){ $score = $a;} elseif($imc >=13.3 and $imc <14.6){$score = $b;} elseif($imc >=14.6 and $imc <16.2){$score = $c;} elseif($imc >=16.2 and $imc <18.3){$score = $d;} elseif($imc >= 18.3 and $imc <21.1){$score = $e;} elseif($imc >=21.1 and $imc <25.4){$score = $f;} elseif($imc >= 25.4 and $imc <32.4){$score = $g;} elseif($imc >= 32.4){$score = $h;} break;

        case 12.5 :
        $meses = 149;
        if($imc < 13.3){ $score = $a;} elseif($imc >=13.3 and $imc <14.6){$score = $b;} elseif($imc >=14.6 and $imc <16.2){$score = $c;} elseif($imc >=16.2 and $imc <18.3){$score = $d;} elseif($imc >= 18.3 and $imc <21.2){$score = $e;} elseif($imc >=21.2 and $imc <25.5){$score = $f;} elseif($imc >= 25.5 and $imc <32.6){$score = $g;} elseif($imc >= 32.6){$score = $h;} break;

        case 12.6 :
        $meses = 150;
        if($imc < 13.4){ $score = $a;} elseif($imc >=13.4 and $imc <14.7){$score = $b;} elseif($imc >=14.7 and $imc <16.3){$score = $c;} elseif($imc >=16.3 and $imc <18.4){$score = $d;} elseif($imc >= 18.4 and $imc <21.3){$score = $e;} elseif($imc >=21.3 and $imc <25.6){$score = $f;} elseif($imc >= 25.6 and $imc <32.7){$score = $g;} elseif($imc >= 32.7){$score = $h;} break;

        case 12.7 :
        $meses = 151;
        if($imc < 13.4){ $score = $a;} elseif($imc >=13.4 and $imc <14.7){$score = $b;} elseif($imc >=14.7 and $imc <16.3){$score = $c;} elseif($imc >=16.3 and $imc <18.5){$score = $d;} elseif($imc >= 18.5 and $imc <21.4){$score = $e;} elseif($imc >=21.4 and $imc <25.7){$score = $f;} elseif($imc >= 25.7 and $imc <32.8){$score = $g;} elseif($imc >= 32.8){$score = $h;} break;

        case 12.8 :
        $meses = 152;
        if($imc < 13.5){ $score = $a;} elseif($imc >=13.5 and $imc <14.8){$score = $b;} elseif($imc >=14.8 and $imc <16.4){$score = $c;} elseif($imc >=16.4 and $imc <18.5){$score = $d;} elseif($imc >= 18.5 and $imc <21.5){$score = $e;} elseif($imc >=21.5 and $imc <25.8){$score = $f;} elseif($imc >= 25.8 and $imc <33.0){$score = $g;} elseif($imc >= 33.0){$score = $h;} break;

        case 12.9 :
        $meses = 153;
        if($imc < 13.5){ $score = $a;} elseif($imc >=13.5 and $imc <14.8){$score = $b;} elseif($imc >=14.8 and $imc <16.4){$score = $c;} elseif($imc >=16.4 and $imc <18.6){$score = $d;} elseif($imc >= 18.6 and $imc <21.6){$score = $e;} elseif($imc >=21.6 and $imc <25.9){$score = $f;} elseif($imc >= 25.9 and $imc <33.1){$score = $g;} elseif($imc >= 33.1){$score = $h;} break;

        case 12.10:
        $meses = 154;
        if($imc < 13.5){ $score = $a;} elseif($imc >=13.5 and $imc <14.8){$score = $b;} elseif($imc >=14.8 and $imc <16.5){$score = $c;} elseif($imc >=16.5 and $imc <18.7){$score = $d;} elseif($imc >= 18.7 and $imc <21.6){$score = $e;} elseif($imc >=21.6 and $imc <26.0){$score = $f;} elseif($imc >= 26.0 and $imc <33.2){$score = $g;} elseif($imc >= 33.2){$score = $h;} break;

        case 12.11:
        $meses = 155;
        if($imc < 13.6){ $score = $a;} elseif($imc >=13.6 and $imc <14.9){$score = $b;} elseif($imc >=14.9 and $imc <16.6){$score = $c;} elseif($imc >=16.6 and $imc <18.7){$score = $d;} elseif($imc >= 18.7 and $imc <21.7){$score = $e;} elseif($imc >=21.7 and $imc <26.1){$score = $f;} elseif($imc >= 26.1 and $imc <33.3){$score = $g;} elseif($imc >= 33.3){$score = $h;} break;

        case 13.0 :
        $meses = 156;
        if($imc < 13.6){ $score = $a;} elseif($imc >=13.6 and $imc <14.9){$score = $b;} elseif($imc >=14.9 and $imc <16.6){$score = $c;} elseif($imc >=16.6 and $imc <18.8){$score = $d;} elseif($imc >= 18.8 and $imc <21.8){$score = $e;} elseif($imc >=21.8 and $imc <26.2){$score = $f;} elseif($imc >= 26.2 and $imc <33.4){$score = $g;} elseif($imc >= 33.4){$score = $h;} break;

        case 13.01:
        $meses = 157;
        if($imc < 13.6){ $score = $a;} elseif($imc >=13.6 and $imc <15.0){$score = $b;} elseif($imc >=15.0 and $imc <16.7){$score = $c;} elseif($imc >=16.7 and $imc <18.9){$score = $d;} elseif($imc >= 18.9 and $imc <21.9){$score = $e;} elseif($imc >=21.9 and $imc <26.3){$score = $f;} elseif($imc >= 26.3 and $imc <33.6){$score = $g;} elseif($imc >= 33.6){$score = $h;} break;

        case 13.2 :
        $meses = 158;
        if($imc < 13.7){ $score = $a;} elseif($imc >=13.7 and $imc <15.0){$score = $b;} elseif($imc >=15.0 and $imc <16.7){$score = $c;} elseif($imc >=16.7 and $imc <18.9){$score = $d;} elseif($imc >= 18.9 and $imc <22.0){$score = $e;} elseif($imc >=22.0 and $imc <26.4){$score = $f;} elseif($imc >= 26.4 and $imc <33.7){$score = $g;} elseif($imc >= 33.7){$score = $h;} break;

        case 13.3 :
        $meses = 159;
        if($imc < 13.7){ $score = $a;} elseif($imc >=13.7 and $imc <15.1){$score = $b;} elseif($imc >=15.1 and $imc <16.8){$score = $c;} elseif($imc >=16.8 and $imc <19.0){$score = $d;} elseif($imc >= 19.0 and $imc <22.0){$score = $e;} elseif($imc >=22.0 and $imc <26.5){$score = $f;} elseif($imc >= 26.5 and $imc <33.8){$score = $g;} elseif($imc >= 33.8){$score = $h;} break;

        case 13.4 :
        $meses = 160;
        if($imc < 13.8){ $score = $a;} elseif($imc >=13.8 and $imc <15.1){$score = $b;} elseif($imc >=15.1 and $imc <16.8){$score = $c;} elseif($imc >=16.8 and $imc <19.1){$score = $d;} elseif($imc >= 19.1 and $imc <22.1){$score = $e;} elseif($imc >=22.1 and $imc <26.6){$score = $f;} elseif($imc >= 26.6 and $imc <33.9){$score = $g;} elseif($imc >= 33.9){$score = $h;} break;

        case 13.5 :
        $meses = 161;
        if($imc < 13.8){ $score = $a;} elseif($imc >=13.8 and $imc <15.2){$score = $b;} elseif($imc >=15.2 and $imc <16.9){$score = $c;} elseif($imc >=16.9 and $imc <19.1){$score = $d;} elseif($imc >= 19.1 and $imc <22.2){$score = $e;} elseif($imc >=22.2 and $imc <26.7){$score = $f;} elseif($imc >= 26.7 and $imc <34.0){$score = $g;} elseif($imc >= 34.0){$score = $h;} break;

        case 13.6 :
        $meses = 162;
        if($imc < 13.8){ $score = $a;} elseif($imc >=13.8 and $imc <15.2){$score = $b;} elseif($imc >=15.2 and $imc <16.9){$score = $c;} elseif($imc >=16.9 and $imc <19.2){$score = $d;} elseif($imc >= 19.2 and $imc <22.3){$score = $e;} elseif($imc >=22.3 and $imc <26.8){$score = $f;} elseif($imc >= 26.8 and $imc <34.1){$score = $g;} elseif($imc >= 34.1){$score = $h;} break;

        case 13.7 :
        $meses = 163;
        if($imc < 13.9){ $score = $a;} elseif($imc >=13.9 and $imc <15.2){$score = $b;} elseif($imc >=15.2 and $imc <17.0){$score = $c;} elseif($imc >=17.0 and $imc <19.3){$score = $d;} elseif($imc >= 19.3 and $imc <22.4){$score = $e;} elseif($imc >=22.4 and $imc <26.9){$score = $f;} elseif($imc >= 26.9 and $imc <34.2){$score = $g;} elseif($imc >= 34.2){$score = $h;} break;

        case 13.8 :
        $meses = 164;
        if($imc < 13.9){ $score = $a;} elseif($imc >=13.9 and $imc <15.3){$score = $b;} elseif($imc >=15.3 and $imc <17.0){$score = $c;} elseif($imc >=17.0 and $imc <19.3){$score = $d;} elseif($imc >= 19.3 and $imc <22.4){$score = $e;} elseif($imc >=22.4 and $imc <27.0){$score = $f;} elseif($imc >= 27.0 and $imc <34.3){$score = $g;} elseif($imc >= 34.3){$score = $h;} break;

        case 13.9 :
        $meses = 165;
        if($imc < 13.9){ $score = $a;} elseif($imc >=13.9 and $imc <15.3){$score = $b;} elseif($imc >=15.3 and $imc <17.1){$score = $c;} elseif($imc >=17.1 and $imc <19.4){$score = $d;} elseif($imc >= 19.4 and $imc <22.5){$score = $e;} elseif($imc >=22.5 and $imc <27.1){$score = $f;} elseif($imc >= 27.1 and $imc <34.4){$score = $g;} elseif($imc >= 34.4){$score = $h;} break;

        case 13.10:
        $meses = 166;
        if($imc < 14.0){ $score = $a;} elseif($imc >=14.0 and $imc <15.4){$score = $b;} elseif($imc >=15.4 and $imc <17.1){$score = $c;} elseif($imc >=17.1 and $imc <19.4){$score = $d;} elseif($imc >= 19.4 and $imc <22.6){$score = $e;} elseif($imc >=22.6 and $imc <27.1){$score = $f;} elseif($imc >= 27.1 and $imc <34.5){$score = $g;} elseif($imc >= 34.5){$score = $h;} break;

        case 13.11:
        $meses = 167;
        if($imc < 14.0){ $score = $a;} elseif($imc >=14.0 and $imc <15.4){$score = $b;} elseif($imc >=15.4 and $imc <17.2){$score = $c;} elseif($imc >=17.2 and $imc <19.5){$score = $d;} elseif($imc >= 19.5 and $imc <22.7){$score = $e;} elseif($imc >=22.7 and $imc <27.2){$score = $f;} elseif($imc >= 27.2 and $imc <34.6){$score = $g;} elseif($imc >= 34.6){$score = $h;} break;

        case 14.0 :
        $meses = 168;
        if($imc < 14.0){ $score = $a;} elseif($imc >=14.0 and $imc <15.4){$score = $b;} elseif($imc >=15.4 and $imc <17.2){$score = $c;} elseif($imc >=17.2 and $imc <19.6){$score = $d;} elseif($imc >= 19.6 and $imc <22.7){$score = $e;} elseif($imc >=22.7 and $imc <27.3){$score = $f;} elseif($imc >= 27.3 and $imc <34.7){$score = $g;} elseif($imc >= 34.7){$score = $h;} break;

        case 14.01:
        $meses = 169;
        if($imc < 14.1){ $score = $a;} elseif($imc >=14.1 and $imc <15.5){$score = $b;} elseif($imc >=15.5 and $imc <17.3){$score = $c;} elseif($imc >=17.3 and $imc <19.6){$score = $d;} elseif($imc >= 19.6 and $imc <22.8){$score = $e;} elseif($imc >=22.8 and $imc <27.4){$score = $f;} elseif($imc >= 27.4 and $imc <34.7){$score = $g;} elseif($imc >= 34.7){$score = $h;} break;

        case 14.2 :
        $meses = 170;
        if($imc < 14.1){ $score = $a;} elseif($imc >=14.1 and $imc <15.5){$score = $b;} elseif($imc >=15.5 and $imc <17.3){$score = $c;} elseif($imc >=17.3 and $imc <19.7){$score = $d;} elseif($imc >= 19.7 and $imc <22.9){$score = $e;} elseif($imc >=22.9 and $imc <27.5){$score = $f;} elseif($imc >= 27.5 and $imc <34.8){$score = $g;} elseif($imc >= 34.8){$score = $h;} break;

        case 14.3 :
        $meses = 171;
        if($imc < 14.1){ $score = $a;} elseif($imc >=14.1 and $imc <15.6){$score = $b;} elseif($imc >=15.6 and $imc <17.4){$score = $c;} elseif($imc >=17.4 and $imc <19.7){$score = $d;} elseif($imc >= 19.7 and $imc <22.9){$score = $e;} elseif($imc >=22.9 and $imc <27.6){$score = $f;} elseif($imc >= 27.6 and $imc <34.9){$score = $g;} elseif($imc >= 34.9){$score = $h;} break;

        case 14.4 :
        $meses = 172;
        if($imc < 14.1){ $score = $a;} elseif($imc >=14.1 and $imc <15.6){$score = $b;} elseif($imc >=15.6 and $imc <17.4){$score = $c;} elseif($imc >=17.4 and $imc <19.8){$score = $d;} elseif($imc >= 19.8 and $imc <23.0){$score = $e;} elseif($imc >=23.0 and $imc <27.7){$score = $f;} elseif($imc >= 27.7 and $imc <35.0){$score = $g;} elseif($imc >= 35.0){$score = $h;} break;

        case 14.5 :
        $meses = 173;
        if($imc < 14.2){ $score = $a;} elseif($imc >=14.2 and $imc <15.6){$score = $b;} elseif($imc >=15.6 and $imc <17.5){$score = $c;} elseif($imc >=17.5 and $imc <19.9){$score = $d;} elseif($imc >= 19.9 and $imc <23.1){$score = $e;} elseif($imc >=23.1 and $imc <27.7){$score = $f;} elseif($imc >= 27.7 and $imc <35.1){$score = $g;} elseif($imc >= 35.1){$score = $h;} break;

        case 14.6 :
        $meses = 174;
        if($imc < 14.2){ $score = $a;} elseif($imc >=14.2 and $imc <15.7){$score = $b;} elseif($imc >=15.7 and $imc <17.5){$score = $c;} elseif($imc >=17.5 and $imc <19.9){$score = $d;} elseif($imc >= 19.9 and $imc <23.1){$score = $e;} elseif($imc >=23.1 and $imc <27.8){$score = $f;} elseif($imc >= 27.8 and $imc <35.1){$score = $g;} elseif($imc >= 35.1){$score = $h;} break;

        case 14.7 :
        $meses = 175;
        if($imc < 14.2){ $score = $a;} elseif($imc >=14.2 and $imc <15.7){$score = $b;} elseif($imc >=15.7 and $imc <17.6){$score = $c;} elseif($imc >=17.6 and $imc <20.0){$score = $d;} elseif($imc >= 20.0 and $imc <23.2){$score = $e;} elseif($imc >=23.2 and $imc <27.9){$score = $f;} elseif($imc >= 27.9 and $imc <35.2){$score = $g;} elseif($imc >= 35.2){$score = $h;} break;

        case 14.8 :
        $meses = 176;
        if($imc < 14.3){ $score = $a;} elseif($imc >=14.3 and $imc <15.7){$score = $b;} elseif($imc >=15.7 and $imc <17.6){$score = $c;} elseif($imc >=17.6 and $imc <20.0){$score = $d;} elseif($imc >= 20.0 and $imc <23.3){$score = $e;} elseif($imc >=23.3 and $imc <28.0){$score = $f;} elseif($imc >= 28.0 and $imc <35.3){$score = $g;} elseif($imc >= 35.3){$score = $h;} break;

        case 14.9 :
        $meses = 177;
        if($imc < 14.3){ $score = $a;} elseif($imc >=14.3 and $imc <15.8){$score = $b;} elseif($imc >=15.8 and $imc <17.6){$score = $c;} elseif($imc >=17.6 and $imc <20.1){$score = $d;} elseif($imc >= 20.1 and $imc <23.3){$score = $e;} elseif($imc >=23.3 and $imc <28.0){$score = $f;} elseif($imc >= 28.0 and $imc <35.4){$score = $g;} elseif($imc >= 35.4){$score = $h;} break;

        case 14.10:
        $meses = 178;
        if($imc < 14.3){ $score = $a;} elseif($imc >=14.3 and $imc <15.8){$score = $b;} elseif($imc >=15.8 and $imc <17.7){$score = $c;} elseif($imc >=17.7 and $imc <20.1){$score = $d;} elseif($imc >= 20.1 and $imc <23.4){$score = $e;} elseif($imc >=23.4 and $imc <28.1){$score = $f;} elseif($imc >= 28.1 and $imc <35.4){$score = $g;} elseif($imc >= 35.4){$score = $h;} break;

        case 14.11:
        $meses = 179;
        if($imc < 14.3){ $score = $a;} elseif($imc >=14.3 and $imc <15.8){$score = $b;} elseif($imc >=15.8 and $imc <17.7){$score = $c;} elseif($imc >=17.7 and $imc <20.2){$score = $d;} elseif($imc >= 20.2 and $imc <23.5){$score = $e;} elseif($imc >=23.5 and $imc <28.2){$score = $f;} elseif($imc >= 28.2 and $imc <35.5){$score = $g;} elseif($imc >= 35.5){$score = $h;} break;

        case 15.0 :
        $meses = 180;
        if($imc < 14.4){ $score = $a;} elseif($imc >=14.4 and $imc <15.9){$score = $b;} elseif($imc >=15.9 and $imc <17.8){$score = $c;} elseif($imc >=17.8 and $imc <20.2){$score = $d;} elseif($imc >= 20.2 and $imc <23.5){$score = $e;} elseif($imc >=23.5 and $imc <28.2){$score = $f;} elseif($imc >= 28.2 and $imc <35.5){$score = $g;} elseif($imc >= 35.5){$score = $h;} break;

        case 15.01:
        $meses = 181;
        if($imc < 14.4){ $score = $a;} elseif($imc >=14.4 and $imc <15.9){$score = $b;} elseif($imc >=15.9 and $imc <17.8){$score = $c;} elseif($imc >=17.8 and $imc <20.3){$score = $d;} elseif($imc >= 20.3 and $imc <23.6){$score = $e;} elseif($imc >=23.6 and $imc <28.3){$score = $f;} elseif($imc >= 28.3 and $imc <35.6){$score = $g;} elseif($imc >= 35.6){$score = $h;} break;

        case 15.2 :
        $meses = 182;
        if($imc < 14.4){ $score = $a;} elseif($imc >=14.4 and $imc <15.9){$score = $b;} elseif($imc >=15.9 and $imc <17.8){$score = $c;} elseif($imc >=17.8 and $imc <20.3){$score = $d;} elseif($imc >= 20.3 and $imc <23.6){$score = $e;} elseif($imc >=23.6 and $imc <28.4){$score = $f;} elseif($imc >= 28.4 and $imc <35.7){$score = $g;} elseif($imc >= 35.7){$score = $h;} break;

        case 15.3 :
        $meses = 183;
        if($imc < 14.4){ $score = $a;} elseif($imc >=14.4 and $imc <16.0){$score = $b;} elseif($imc >=16.0 and $imc <17.9){$score = $c;} elseif($imc >=17.9 and $imc <20.4){$score = $d;} elseif($imc >= 20.4 and $imc <23.7){$score = $e;} elseif($imc >=23.7 and $imc <28.4){$score = $f;} elseif($imc >= 28.4 and $imc <35.7){$score = $g;} elseif($imc >= 35.7){$score = $h;} break;

        case 15.4 :
        $meses = 184;
        if($imc < 14.5){ $score = $a;} elseif($imc >=14.5 and $imc <16.0){$score = $b;} elseif($imc >=16.0 and $imc <17.9){$score = $c;} elseif($imc >=17.9 and $imc <20.4){$score = $d;} elseif($imc >= 20.4 and $imc <23.7){$score = $e;} elseif($imc >=23.7 and $imc <28.5){$score = $f;} elseif($imc >= 28.5 and $imc <35.8){$score = $g;} elseif($imc >= 35.8){$score = $h;} break;

        case 15.5 :
        $meses = 185;
        if($imc < 14.5){ $score = $a;} elseif($imc >=14.5 and $imc <16.0){$score = $b;} elseif($imc >=16.0 and $imc <17.9){$score = $c;} elseif($imc >=17.9 and $imc <20.4){$score = $d;} elseif($imc >= 20.4 and $imc <23.8){$score = $e;} elseif($imc >=23.8 and $imc <28.5){$score = $f;} elseif($imc >= 28.5 and $imc <35.8){$score = $g;} elseif($imc >= 35.8){$score = $h;} break;

        case 15.6 :
        $meses = 186;
        if($imc < 14.5){ $score = $a;} elseif($imc >=14.5 and $imc <16.0){$score = $b;} elseif($imc >=16.0 and $imc <18.0){$score = $c;} elseif($imc >=18.0 and $imc <20.5){$score = $d;} elseif($imc >= 20.5 and $imc <23.8){$score = $e;} elseif($imc >=23.8 and $imc <28.6){$score = $f;} elseif($imc >= 28.6 and $imc <35.8){$score = $g;} elseif($imc >= 35.8){$score = $h;} break;

        case 15.7 :
        $meses = 187;
        if($imc < 14.5){ $score = $a;} elseif($imc >=14.5 and $imc <16.1){$score = $b;} elseif($imc >=16.1 and $imc <18.0){$score = $c;} elseif($imc >=18.0 and $imc <20.5){$score = $d;} elseif($imc >= 20.5 and $imc <23.9){$score = $e;} elseif($imc >=23.9 and $imc <28.6){$score = $f;} elseif($imc >= 28.6 and $imc <35.9){$score = $g;} elseif($imc >= 35.9){$score = $h;} break;

        case 15.8 :
        $meses = 188;
        if($imc < 14.5){ $score = $a;} elseif($imc >=14.5 and $imc <16.1){$score = $b;} elseif($imc >=16.1 and $imc <18.0){$score = $c;} elseif($imc >=18.0 and $imc <20.6){$score = $d;} elseif($imc >= 20.6 and $imc <23.9){$score = $e;} elseif($imc >=23.9 and $imc <28.7){$score = $f;} elseif($imc >= 28.7 and $imc <35.9){$score = $g;} elseif($imc >= 35.9){$score = $h;} break;

        case 15.9 :
        $meses = 189;
        if($imc < 14.5){ $score = $a;} elseif($imc >=14.5 and $imc <16.1){$score = $b;} elseif($imc >=16.1 and $imc <18.1){$score = $c;} elseif($imc >=18.1 and $imc <20.6){$score = $d;} elseif($imc >= 20.6 and $imc <24.0){$score = $e;} elseif($imc >=24.0 and $imc <28.7){$score = $f;} elseif($imc >= 28.7 and $imc <36.0){$score = $g;} elseif($imc >= 36.0){$score = $h;} break;

        case 15.10:
        $meses = 190;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.1){$score = $b;} elseif($imc >=16.1 and $imc <18.1){$score = $c;} elseif($imc >=18.1 and $imc <20.6){$score = $d;} elseif($imc >= 20.6 and $imc <24.0){$score = $e;} elseif($imc >=24.0 and $imc <28.8){$score = $f;} elseif($imc >= 28.8 and $imc <36.0){$score = $g;} elseif($imc >= 36.0){$score = $h;} break;

        case 15.11:
        $meses = 191;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.2){$score = $b;} elseif($imc >=16.2 and $imc <18.1){$score = $c;} elseif($imc >=18.1 and $imc <20.7){$score = $d;} elseif($imc >= 20.7 and $imc <24.1){$score = $e;} elseif($imc >=24.1 and $imc <28.8){$score = $f;} elseif($imc >= 28.8 and $imc <36.0){$score = $g;} elseif($imc >= 36.0){$score = $h;} break;

        case 16.0 :
        $meses = 192;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.2){$score = $b;} elseif($imc >=16.2 and $imc <18.2){$score = $c;} elseif($imc >=18.2 and $imc <20.7){$score = $d;} elseif($imc >= 20.7 and $imc <24.1){$score = $e;} elseif($imc >=24.1 and $imc <28.9){$score = $f;} elseif($imc >= 28.9 and $imc <36.1){$score = $g;} elseif($imc >= 36.1){$score = $h;} break;

        case 16.01:
        $meses = 193;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.2){$score = $b;} elseif($imc >=16.2 and $imc <18.2){$score = $c;} elseif($imc >=18.2 and $imc <20.7){$score = $d;} elseif($imc >= 20.7 and $imc <24.1){$score = $e;} elseif($imc >=24.1 and $imc <28.9){$score = $f;} elseif($imc >= 28.9 and $imc <36.1){$score = $g;} elseif($imc >= 36.1){$score = $h;} break;

        case 16.2 :
        $meses = 194;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.2){$score = $b;} elseif($imc >=16.2 and $imc <18.2){$score = $c;} elseif($imc >=18.2 and $imc <20.8){$score = $d;} elseif($imc >= 20.8 and $imc <24.2){$score = $e;} elseif($imc >=24.2 and $imc <29.0){$score = $f;} elseif($imc >= 29.0 and $imc <36.1){$score = $g;} elseif($imc >= 36.1){$score = $h;} break;

        case 16.3 :
        $meses = 195;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.2){$score = $b;} elseif($imc >=16.2 and $imc <18.2){$score = $c;} elseif($imc >=18.2 and $imc <20.8){$score = $d;} elseif($imc >= 20.8 and $imc <24.2){$score = $e;} elseif($imc >=24.2 and $imc <29.0){$score = $f;} elseif($imc >= 29.0 and $imc <36.1){$score = $g;} elseif($imc >= 36.1){$score = $h;} break;

        case 16.4 :
        $meses = 196;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.2){$score = $b;} elseif($imc >=16.2 and $imc <18.3){$score = $c;} elseif($imc >=18.3 and $imc <20.8){$score = $d;} elseif($imc >= 20.8 and $imc <24.3){$score = $e;} elseif($imc >=24.3 and $imc <29.0){$score = $f;} elseif($imc >= 29.0 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 16.5 :
        $meses = 197;
        if($imc < 14.6){ $score = $a;} elseif($imc >=14.6 and $imc <16.3){$score = $b;} elseif($imc >=16.3 and $imc <18.3){$score = $c;} elseif($imc >=18.3 and $imc <20.9){$score = $d;} elseif($imc >= 20.9 and $imc <24.3){$score = $e;} elseif($imc >=24.3 and $imc <29.1){$score = $f;} elseif($imc >= 29.1 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 16.6 :
        $meses = 198;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.3){$score = $b;} elseif($imc >=16.3 and $imc <18.3){$score = $c;} elseif($imc >=18.3 and $imc <20.9){$score = $d;} elseif($imc >= 20.9 and $imc <24.3){$score = $e;} elseif($imc >=24.3 and $imc <29.1){$score = $f;} elseif($imc >= 29.1 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 16.7 :
        $meses = 199;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.3){$score = $b;} elseif($imc >=16.3 and $imc <18.3){$score = $c;} elseif($imc >=18.3 and $imc <20.9){$score = $d;} elseif($imc >= 20.9 and $imc <24.4){$score = $e;} elseif($imc >=24.4 and $imc <29.1){$score = $f;} elseif($imc >= 29.1 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 16.8 :
        $meses = 200;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.3){$score = $b;} elseif($imc >=16.3 and $imc <18.3){$score = $c;} elseif($imc >=18.3 and $imc <20.9){$score = $d;} elseif($imc >= 20.9 and $imc <24.4){$score = $e;} elseif($imc >=24.4 and $imc <29.2){$score = $f;} elseif($imc >= 29.2 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 16.9 :
        $meses = 201;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.3){$score = $b;} elseif($imc >=16.3 and $imc <18.4){$score = $c;} elseif($imc >=18.4 and $imc <21.0){$score = $d;} elseif($imc >= 21.0 and $imc <24.4){$score = $e;} elseif($imc >=24.4 and $imc <29.2){$score = $f;} elseif($imc >= 29.2 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 16.10:
        $meses = 202;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.3){$score = $b;} elseif($imc >=16.3 and $imc <18.4){$score = $c;} elseif($imc >=18.4 and $imc <21.0){$score = $d;} elseif($imc >= 21.0 and $imc <24.4){$score = $e;} elseif($imc >=24.4 and $imc <29.2){$score = $f;} elseif($imc >= 29.2 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 16.11:
        $meses = 203;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.3){$score = $b;} elseif($imc >=16.3 and $imc <18.4){$score = $c;} elseif($imc >=18.4 and $imc <21.0){$score = $d;} elseif($imc >= 21.0 and $imc <24.5){$score = $e;} elseif($imc >=24.5 and $imc <29.3){$score = $f;} elseif($imc >= 29.3 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.0 :
        $meses = 204;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.4){$score = $c;} elseif($imc >=18.4 and $imc <21.0){$score = $d;} elseif($imc >= 21.0 and $imc <24.5){$score = $e;} elseif($imc >=24.5 and $imc <29.3){$score = $f;} elseif($imc >= 29.3 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.01:
        $meses = 205;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.4){$score = $c;} elseif($imc >=18.4 and $imc <21.1){$score = $d;} elseif($imc >= 21.1 and $imc <24.5){$score = $e;} elseif($imc >=24.5 and $imc <29.3){$score = $f;} elseif($imc >= 29.3 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.2 :
        $meses = 206;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.4){$score = $c;} elseif($imc >=18.4 and $imc <21.1){$score = $d;} elseif($imc >= 21.1 and $imc <24.6){$score = $e;} elseif($imc >=24.6 and $imc <29.3){$score = $f;} elseif($imc >= 29.3 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.3 :
        $meses = 207;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.1){$score = $d;} elseif($imc >= 21.1 and $imc <24.6){$score = $e;} elseif($imc >=24.6 and $imc <29.4){$score = $f;} elseif($imc >= 29.4 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.4 :
        $meses = 208;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.1){$score = $d;} elseif($imc >= 21.1 and $imc <24.6){$score = $e;} elseif($imc >=24.6 and $imc <29.4){$score = $f;} elseif($imc >= 29.4 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.5 :
        $meses = 209;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.1){$score = $d;} elseif($imc >= 21.1 and $imc <24.6){$score = $e;} elseif($imc >=24.6 and $imc <29.4){$score = $f;} elseif($imc >= 29.4 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.6 :
        $meses = 210;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.2){$score = $d;} elseif($imc >= 21.2 and $imc <24.6){$score = $e;} elseif($imc >=24.6 and $imc <29.4){$score = $f;} elseif($imc >= 29.4 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.7 :
        $meses = 211;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.2){$score = $d;} elseif($imc >= 21.2 and $imc <24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.4){$score = $f;} elseif($imc >= 29.4 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.8 :
        $meses = 212;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.2){$score = $d;} elseif($imc >= 21.2 and $imc <24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.9 :
        $meses = 213;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.2){$score = $d;} elseif($imc >= 21.2 and $imc <24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.10:
        $meses = 214;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.5){$score = $c;} elseif($imc >=18.5 and $imc <21.2){$score = $d;} elseif($imc >= 21.2 and $imc <24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.11:
        $meses = 215;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.2){$score = $d;} elseif($imc >= 21.2 and $imc <24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.0 :
        $meses = 216;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.4){$score = $b;} elseif($imc >=16.4 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.3){$score = $d;} elseif($imc >= 21.3 and $imc <24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.01:
        $meses = 217;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.3){$score = $d;} elseif($imc >= 21.3 and $imc <24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.2 :
        $meses = 218;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.3){$score = $d;} elseif($imc >= 21.3 and $imc <24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.3 :
        $meses = 219;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.3){$score = $d;} elseif($imc >= 21.3 and $imc <24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.4 :
        $meses = 220;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.3){$score = $d;} elseif($imc >= 21.3 and $imc <24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.5 :
        $meses = 221;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.3){$score = $d;} elseif($imc >= 21.3 and $imc <24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.6 :
        $meses = 222;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.3){$score = $d;} elseif($imc >= 21.3 and $imc <24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.7 :
        $meses = 223;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.4){$score = $d;} elseif($imc >= 21.4 and $imc <24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.8 :
        $meses = 224;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.6){$score = $c;} elseif($imc >=18.6 and $imc <21.4){$score = $d;} elseif($imc >= 21.4 and $imc <24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.9 :
        $meses = 225;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.7){$score = $c;} elseif($imc >=18.7 and $imc <21.4){$score = $d;} elseif($imc >= 21.4 and $imc <24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.10:
        $meses = 226;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.7){$score = $c;} elseif($imc >=18.7 and $imc <21.4){$score = $d;} elseif($imc >= 21.4 and $imc <24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.11:
        $meses = 227;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.7){$score = $c;} elseif($imc >=18.7 and $imc <21.4){$score = $d;} elseif($imc >= 21.4 and $imc <25.0){$score = $e;} elseif($imc >=25.0 and $imc <29.7){$score = $f;} elseif($imc >= 29.7 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 19.0 :
        $meses = 228;
        if($imc < 14.7){ $score = $a;} elseif($imc >=14.7 and $imc <16.5){$score = $b;} elseif($imc >=16.5 and $imc <18.7){$score = $c;} elseif($imc >=18.7 and $imc <21.4){$score = $d;} elseif($imc >= 21.4 and $imc <25.0){$score = $e;} elseif($imc >=25.0 and $imc <29.7){$score = $f;} elseif($imc >= 29.7 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;



      //default ----------------------------------------------
        default:
        $score = 'Erro no score';
        break;
      }



    }
  //__________________________________ MASCULINO _____________________

    if ($sexo ==1) {
      switch ($anos) {
        case 10.0:
        $meses = 120;
        if($imc < 12.8){ $score = $a;} elseif($imc >=12.8 and $imc <13.7){$score = $b;} elseif($imc >=13.7 and $imc <14.9){$score = $c;} elseif($imc >=14.9 and $imc <16.4){$score = $d;} elseif($imc >= 16.4 and $imc <18.5){$score = $e;} elseif($imc >=18.5 and $imc <21.4){$score = $f;} elseif($imc >= 21.4 and $imc <26.1){$score = $g;} elseif($imc >= 26.1){$score = $h;} break;

        case 10.01:
        $meses = 121;
        if($imc <12.8){ $score = $a;} elseif($imc >= 12.8 and $imc < 13.8){$score = $b;} elseif($imc >= 13.8 and $imc < 15.0){$score = $c;} elseif($imc >= 15.0 and $imc < 16.5){$score = $d;} elseif($imc >=16.5 and $imc < 18.5){$score = $e;} elseif($imc >=18.5 and $imc <21.5){$score = $f;} elseif($imc >= 21.5 and $imc <26.2){$score = $g;} elseif($imc >= 26.2){$score = $h;} break;

        case 10.2 :
        $meses = 122;
        if($imc <12.8){ $score = $a;} elseif($imc >= 12.8 and $imc < 13.8){$score = $b;} elseif($imc >= 13.8 and $imc < 15.0){$score = $c;} elseif($imc >= 15.0 and $imc < 16.5){$score = $d;} elseif($imc >=16.5 and $imc < 18.6){$score = $e;} elseif($imc >=18.6 and $imc <21.6){$score = $f;} elseif($imc >= 21.6 and $imc <26.4){$score = $g;} elseif($imc >= 26.4){$score = $h;} break;

        case 10.3 :
        $meses = 123;
        if($imc <12.8){ $score = $a;} elseif($imc >= 12.8 and $imc < 13.8){$score = $b;} elseif($imc >= 13.8 and $imc < 15.0){$score = $c;} elseif($imc >= 15.0 and $imc < 16.6){$score = $d;} elseif($imc >=16.6 and $imc < 18.6){$score = $e;} elseif($imc >=18.6 and $imc <21.7){$score = $f;} elseif($imc >= 21.7 and $imc <26.6){$score = $g;} elseif($imc >= 26.6){$score = $h;} break;

        case 10.4 :
        $meses = 124;
        if($imc <12.9){ $score = $a;} elseif($imc >= 12.9 and $imc < 13.8){$score = $b;} elseif($imc >= 13.8 and $imc < 15.0){$score = $c;} elseif($imc >= 15.0 and $imc < 16.6){$score = $d;} elseif($imc >=16.6 and $imc < 18.7){$score = $e;} elseif($imc >=18.7 and $imc <21.7){$score = $f;} elseif($imc >= 21.7 and $imc <26.7){$score = $g;} elseif($imc >= 26.7){$score = $h;} break;

        case 10.5 :
        $meses = 125;
        if($imc <12.9){ $score = $a;} elseif($imc >= 12.9 and $imc < 13.9){$score = $b;} elseif($imc >= 13.9 and $imc < 15.1){$score = $c;} elseif($imc >= 15.1 and $imc < 16.6){$score = $d;} elseif($imc >=16.6 and $imc < 18.8){$score = $e;} elseif($imc >=18.8 and $imc <21.8){$score = $f;} elseif($imc >= 21.8 and $imc <26.9){$score = $g;} elseif($imc >= 26.9){$score = $h;} break;

        case 10.6 :
        $meses = 126;
        if($imc <12.9){ $score = $a;} elseif($imc >= 12.9 and $imc < 13.9){$score = $b;} elseif($imc >= 13.9 and $imc < 15.1){$score = $c;} elseif($imc >= 15.1 and $imc < 16.7){$score = $d;} elseif($imc >=16.7 and $imc < 18.8){$score = $e;} elseif($imc >=18.8 and $imc <21.9){$score = $f;} elseif($imc >= 21.9 and $imc <27.0){$score = $g;} elseif($imc >= 27.0){$score = $h;} break;

        case 10.7 :
        $meses = 127;
        if($imc <12.9){ $score = $a;} elseif($imc >= 12.9 and $imc < 13.9){$score = $b;} elseif($imc >= 13.9 and $imc < 15.1){$score = $c;} elseif($imc >= 15.1 and $imc < 16.7){$score = $d;} elseif($imc >=16.7 and $imc < 18.9){$score = $e;} elseif($imc >=18.9 and $imc <22.0){$score = $f;} elseif($imc >= 22.0 and $imc <27.2){$score = $g;} elseif($imc >= 27.2){$score = $h;} break;

        case 10.8 :
        $meses = 128;
        if($imc <13.0){ $score = $a;} elseif($imc >= 13.0 and $imc < 13.9){$score = $b;} elseif($imc >= 13.9 and $imc < 15.2){$score = $c;} elseif($imc >= 15.2 and $imc < 16.8){$score = $d;} elseif($imc >=16.8 and $imc < 18.9){$score = $e;} elseif($imc >=18.9 and $imc <22.1){$score = $f;} elseif($imc >= 22.1 and $imc <27.4){$score = $g;} elseif($imc >= 27.4){$score = $h;} break;

        case 10.9 :
        $meses = 129;
        if($imc <13.0){ $score = $a;} elseif($imc >= 13.0 and $imc < 14.0){$score = $b;} elseif($imc >= 14.0 and $imc < 15.2){$score = $c;} elseif($imc >= 15.2 and $imc < 16.8){$score = $d;} elseif($imc >=16.8 and $imc < 19.0){$score = $e;} elseif($imc >=19.0 and $imc <22.2){$score = $f;} elseif($imc >= 22.2 and $imc <27.5){$score = $g;} elseif($imc >= 27.5){$score = $h;} break;

        case 10.10:
        $meses = 130;
        if($imc <13.0){ $score = $a;} elseif($imc >= 13.0 and $imc < 14.0){$score = $b;} elseif($imc >= 14.0 and $imc < 15.2){$score = $c;} elseif($imc >= 15.2 and $imc < 16.9){$score = $d;} elseif($imc >=16.9 and $imc < 19.0){$score = $e;} elseif($imc >=19.0 and $imc <22.3){$score = $f;} elseif($imc >= 22.3 and $imc <27.7){$score = $g;} elseif($imc >= 27.7){$score = $h;} break;

        case 10.11:
        $meses = 131;
        if($imc <13.0){ $score = $a;} elseif($imc >= 13.0 and $imc < 14.0){$score = $b;} elseif($imc >= 14.0 and $imc < 15.3){$score = $c;} elseif($imc >= 15.3 and $imc < 16.9){$score = $d;} elseif($imc >=16.9 and $imc < 19.1){$score = $e;} elseif($imc >=19.1 and $imc <22.4){$score = $f;} elseif($imc >= 22.4 and $imc <27.9){$score = $g;} elseif($imc >= 27.9){$score = $h;} break;

        case 11.0 :
        $meses = 132;
        if($imc <13.1){ $score = $a;} elseif($imc >= 13.1 and $imc < 14.1){$score = $b;} elseif($imc >= 14.1 and $imc < 15.3){$score = $c;} elseif($imc >= 15.3 and $imc < 16.9){$score = $d;} elseif($imc >=16.9 and $imc < 19.2){$score = $e;} elseif($imc >=19.2 and $imc <22.5){$score = $f;} elseif($imc >= 22.5 and $imc <28.0){$score = $g;} elseif($imc >= 28.0){$score = $h;} break;

        case 11.01:
        $meses = 133;
        if($imc <13.1){ $score = $a;} elseif($imc >= 13.1 and $imc < 14.1){$score = $b;} elseif($imc >= 14.1 and $imc < 15.3){$score = $c;} elseif($imc >= 15.3 and $imc < 17.0){$score = $d;} elseif($imc >=17.0 and $imc < 19.2){$score = $e;} elseif($imc >=19.2 and $imc <22.5){$score = $f;} elseif($imc >= 22.5 and $imc <28.2){$score = $g;} elseif($imc >= 28.2){$score = $h;} break;

        case 11.2 :
        $meses = 134;
        if($imc <13.1){ $score = $a;} elseif($imc >= 13.1 and $imc < 14.1){$score = $b;} elseif($imc >= 14.1 and $imc < 15.4){$score = $c;} elseif($imc >= 15.4 and $imc < 17.0){$score = $d;} elseif($imc >=17.0 and $imc < 19.3){$score = $e;} elseif($imc >=19.3 and $imc <22.6){$score = $f;} elseif($imc >= 22.6 and $imc <28.4){$score = $g;} elseif($imc >= 28.4){$score = $h;} break;

        case 11.3 :
        $meses = 135;
        if($imc <13.1){ $score = $a;} elseif($imc >= 13.1 and $imc < 14.1){$score = $b;} elseif($imc >= 14.1 and $imc < 15.4){$score = $c;} elseif($imc >= 15.4 and $imc < 17.1){$score = $d;} elseif($imc >=17.1 and $imc < 19.3){$score = $e;} elseif($imc >=19.3 and $imc <22.7){$score = $f;} elseif($imc >= 22.7 and $imc <28.5){$score = $g;} elseif($imc >= 28.5){$score = $h;} break;

        case 11.4 :
        $meses = 136;
        if($imc <13.2){ $score = $a;} elseif($imc >= 13.2 and $imc < 14.2){$score = $b;} elseif($imc >= 14.2 and $imc < 15.5){$score = $c;} elseif($imc >= 15.5 and $imc < 17.1){$score = $d;} elseif($imc >=17.1 and $imc < 19.4){$score = $e;} elseif($imc >=19.4 and $imc <22.8){$score = $f;} elseif($imc >= 22.8 and $imc <28.7){$score = $g;} elseif($imc >= 28.7){$score = $h;} break;

        case 11.5 :
        $meses = 137;
        if($imc <13.2){ $score = $a;} elseif($imc >= 13.2 and $imc < 14.2){$score = $b;} elseif($imc >= 14.2 and $imc < 15.5){$score = $c;} elseif($imc >= 15.5 and $imc < 17.2){$score = $d;} elseif($imc >=17.2 and $imc < 19.5){$score = $e;} elseif($imc >=19.5 and $imc <22.9){$score = $f;} elseif($imc >= 22.9 and $imc <28.8){$score = $g;} elseif($imc >= 28.8){$score = $h;} break;

        case 11.6 :
        $meses = 138;
        if($imc <13.2){ $score = $a;} elseif($imc >= 13.2 and $imc < 14.2){$score = $b;} elseif($imc >= 14.2 and $imc < 15.5){$score = $c;} elseif($imc >= 15.5 and $imc < 17.2){$score = $d;} elseif($imc >=17.2 and $imc < 19.5){$score = $e;} elseif($imc >=19.5 and $imc <23.0){$score = $f;} elseif($imc >= 23.0 and $imc <29.0){$score = $g;} elseif($imc >= 29.0){$score = $h;} break;

        case 11.7 :
        $meses = 139;
        if($imc <13.2){ $score = $a;} elseif($imc >= 13.2 and $imc < 14.3){$score = $b;} elseif($imc >= 14.3 and $imc < 15.6){$score = $c;} elseif($imc >= 15.6 and $imc < 17.3){$score = $d;} elseif($imc >=17.3 and $imc < 19.6){$score = $e;} elseif($imc >=19.6 and $imc <23.1){$score = $f;} elseif($imc >= 23.1 and $imc <29.2){$score = $g;} elseif($imc >= 29.2){$score = $h;} break;

        case 11.8 :
        $meses = 140;
        if($imc <13.3){ $score = $a;} elseif($imc >= 13.3 and $imc < 14.3){$score = $b;} elseif($imc >= 14.3 and $imc < 15.6){$score = $c;} elseif($imc >= 15.6 and $imc < 17.3){$score = $d;} elseif($imc >=17.3 and $imc < 19.7){$score = $e;} elseif($imc >=19.7 and $imc <23.2){$score = $f;} elseif($imc >= 23.2 and $imc <29.3){$score = $g;} elseif($imc >= 29.3){$score = $h;} break;

        case 11.9 :
        $meses = 141;
        if($imc <13.3){ $score = $a;} elseif($imc >= 13.3 and $imc < 14.3){$score = $b;} elseif($imc >= 14.3 and $imc < 15.7){$score = $c;} elseif($imc >= 15.7 and $imc < 17.4){$score = $d;} elseif($imc >=17.4 and $imc < 19.7){$score = $e;} elseif($imc >=19.7 and $imc <23.3){$score = $f;} elseif($imc >= 23.3 and $imc <29.5){$score = $g;} elseif($imc >= 29.5){$score = $h;} break;

        case 11.10:
        $meses = 142;
        if($imc <13.3){ $score = $a;} elseif($imc >= 13.3 and $imc < 14.4){$score = $b;} elseif($imc >= 14.4 and $imc < 15.7){$score = $c;} elseif($imc >= 15.7 and $imc < 17.4){$score = $d;} elseif($imc >=17.4 and $imc < 19.8){$score = $e;} elseif($imc >=19.8 and $imc <23.4){$score = $f;} elseif($imc >= 23.4 and $imc <29.6){$score = $g;} elseif($imc >= 29.6){$score = $h;} break;

        case 11.11:
        $meses = 143;
        if($imc <13.4){ $score = $a;} elseif($imc >= 13.4 and $imc < 14.4){$score = $b;} elseif($imc >= 14.4 and $imc < 15.7){$score = $c;} elseif($imc >= 15.7 and $imc < 17.5){$score = $d;} elseif($imc >=17.5 and $imc < 19.9){$score = $e;} elseif($imc >=19.9 and $imc <23.5){$score = $f;} elseif($imc >= 23.5 and $imc <29.8){$score = $g;} elseif($imc >= 29.8){$score = $h;} break;

        case 12.0 :
        $meses = 144;
        if($imc <13.4){ $score = $a;} elseif($imc >= 13.4 and $imc < 14.5){$score = $b;} elseif($imc >= 14.5 and $imc < 15.8){$score = $c;} elseif($imc >= 15.8 and $imc < 17.5){$score = $d;} elseif($imc >=17.5 and $imc < 19.9){$score = $e;} elseif($imc >=19.9 and $imc <23.6){$score = $f;} elseif($imc >= 23.6 and $imc <30.0){$score = $g;} elseif($imc >= 30.0){$score = $h;} break;

        case 12.01:
        $meses = 145;
        if($imc <13.4){ $score = $a;} elseif($imc >= 13.4 and $imc < 14.5){$score = $b;} elseif($imc >= 14.5 and $imc < 15.8){$score = $c;} elseif($imc >= 15.8 and $imc < 17.6){$score = $d;} elseif($imc >=17.6 and $imc < 20.0){$score = $e;} elseif($imc >=20.0 and $imc <23.7){$score = $f;} elseif($imc >= 23.7 and $imc <30.1){$score = $g;} elseif($imc >= 30.1){$score = $h;} break;

        case 12.2 :
        $meses = 146;
        if($imc <13.5){ $score = $a;} elseif($imc >= 13.5 and $imc < 14.5){$score = $b;} elseif($imc >= 14.5 and $imc < 15.9){$score = $c;} elseif($imc >= 15.9 and $imc < 17.6){$score = $d;} elseif($imc >=17.6 and $imc < 20.1){$score = $e;} elseif($imc >=20.1 and $imc <23.8){$score = $f;} elseif($imc >= 23.8 and $imc <30.3){$score = $g;} elseif($imc >= 30.3){$score = $h;} break;

        case 12.3 :
        $meses = 147;
        if($imc <13.5){ $score = $a;} elseif($imc >= 13.5 and $imc < 14.6){$score = $b;} elseif($imc >= 14.6 and $imc < 15.9){$score = $c;} elseif($imc >= 15.9 and $imc < 17.7){$score = $d;} elseif($imc >=17.7 and $imc < 20.2){$score = $e;} elseif($imc >=20.2 and $imc <23.9){$score = $f;} elseif($imc >= 23.9 and $imc <30.4){$score = $g;} elseif($imc >= 30.4){$score = $h;} break;

        case 12.4 :
        $meses = 148;
        if($imc <13.5){ $score = $a;} elseif($imc >= 13.5 and $imc < 14.6){$score = $b;} elseif($imc >= 14.6 and $imc < 16.0){$score = $c;} elseif($imc >= 16.0 and $imc < 17.8){$score = $d;} elseif($imc >=17.8 and $imc < 20.2){$score = $e;} elseif($imc >=20.2 and $imc <24.0){$score = $f;} elseif($imc >= 24.0 and $imc <30.6){$score = $g;} elseif($imc >= 30.6){$score = $h;} break;

        case 12.5 :
        $meses = 149;
        if($imc <13.6){ $score = $a;} elseif($imc >= 13.6 and $imc < 14.6){$score = $b;} elseif($imc >= 14.6 and $imc < 16.0){$score = $c;} elseif($imc >= 16.0 and $imc < 17.8){$score = $d;} elseif($imc >=17.8 and $imc < 20.3){$score = $e;} elseif($imc >=20.3 and $imc <24.1){$score = $f;} elseif($imc >= 24.1 and $imc <30.7){$score = $g;} elseif($imc >= 30.7){$score = $h;} break;

        case 12.6 :
        $meses = 150;
        if($imc <13.6){ $score = $a;} elseif($imc >= 13.6 and $imc < 14.7){$score = $b;} elseif($imc >= 14.7 and $imc < 16.1){$score = $c;} elseif($imc >= 16.1 and $imc < 17.9){$score = $d;} elseif($imc >=17.9 and $imc < 20.4){$score = $e;} elseif($imc >=20.4 and $imc <24.2){$score = $f;} elseif($imc >= 24.2 and $imc <30.9){$score = $g;} elseif($imc >= 30.9){$score = $h;} break;

        case 12.7 :
        $meses = 151;
        if($imc <13.6){ $score = $a;} elseif($imc >= 13.6 and $imc < 14.7){$score = $b;} elseif($imc >= 14.7 and $imc < 16.1){$score = $c;} elseif($imc >= 16.1 and $imc < 17.9){$score = $d;} elseif($imc >=17.9 and $imc < 20.4){$score = $e;} elseif($imc >=20.4 and $imc <24.3){$score = $f;} elseif($imc >= 24.3 and $imc <31.0){$score = $g;} elseif($imc >= 31.0){$score = $h;} break;

        case 12.8 :
        $meses = 152;
        if($imc <13.7){ $score = $a;} elseif($imc >= 13.7 and $imc < 14.8){$score = $b;} elseif($imc >= 14.8 and $imc < 16.2){$score = $c;} elseif($imc >= 16.2 and $imc < 18.0){$score = $d;} elseif($imc >=18.0 and $imc < 20.5){$score = $e;} elseif($imc >=20.5 and $imc <24.4){$score = $f;} elseif($imc >= 24.4 and $imc <31.1){$score = $g;} elseif($imc >= 31.1){$score = $h;} break;

        case 12.9 :
        $meses = 153;
        if($imc <13.7){ $score = $a;} elseif($imc >= 13.7 and $imc < 14.8){$score = $b;} elseif($imc >= 14.8 and $imc < 16.2){$score = $c;} elseif($imc >= 16.2 and $imc < 18.0){$score = $d;} elseif($imc >=18.0 and $imc < 20.6){$score = $e;} elseif($imc >=20.6 and $imc <24.5){$score = $f;} elseif($imc >= 24.5 and $imc <31.3){$score = $g;} elseif($imc >= 31.3){$score = $h;} break;

        case 12.10:
        $meses = 154;
        if($imc <13.7){ $score = $a;} elseif($imc >= 13.7 and $imc < 14.8){$score = $b;} elseif($imc >= 14.8 and $imc < 16.3){$score = $c;} elseif($imc >= 16.3 and $imc < 18.1){$score = $d;} elseif($imc >=18.1 and $imc < 20.7){$score = $e;} elseif($imc >=20.7 and $imc <24.6){$score = $f;} elseif($imc >= 24.6 and $imc <31.4){$score = $g;} elseif($imc >= 31.4){$score = $h;} break;

        case 12.11:
        $meses = 155;
        if($imc <13.8){ $score = $a;} elseif($imc >= 13.8 and $imc < 14.9){$score = $b;} elseif($imc >= 14.9 and $imc < 16.3){$score = $c;} elseif($imc >= 16.3 and $imc < 18.2){$score = $d;} elseif($imc >=18.2 and $imc < 20.8){$score = $e;} elseif($imc >=20.8 and $imc <24.7){$score = $f;} elseif($imc >= 24.7 and $imc <31.6){$score = $g;} elseif($imc >= 31.6){$score = $h;} break;

        case 13.0 :
        $meses = 156;
        if($imc <13.8){ $score = $a;} elseif($imc >= 13.8 and $imc < 14.9){$score = $b;} elseif($imc >= 14.9 and $imc < 16.4){$score = $c;} elseif($imc >= 16.4 and $imc < 18.2){$score = $d;} elseif($imc >=18.2 and $imc < 20.8){$score = $e;} elseif($imc >=20.8 and $imc <24.8){$score = $f;} elseif($imc >= 24.8 and $imc <31.7){$score = $g;} elseif($imc >= 31.7){$score = $h;} break;

        case 13.01:
        $meses = 157;
        if($imc <13.8){ $score = $a;} elseif($imc >= 13.8 and $imc < 15.0){$score = $b;} elseif($imc >= 15.0 and $imc < 16.4){$score = $c;} elseif($imc >= 16.4 and $imc < 18.3){$score = $d;} elseif($imc >=18.3 and $imc < 20.9){$score = $e;} elseif($imc >=20.9 and $imc <24.9){$score = $f;} elseif($imc >= 24.9 and $imc <31.8){$score = $g;} elseif($imc >= 31.8){$score = $h;} break;

        case 13.2 :
        $meses = 158;
        if($imc <13.9){ $score = $a;} elseif($imc >= 13.9 and $imc < 15.0){$score = $b;} elseif($imc >= 15.0 and $imc < 16.5){$score = $c;} elseif($imc >= 16.5 and $imc < 18.4){$score = $d;} elseif($imc >=18.4 and $imc < 21.0){$score = $e;} elseif($imc >=21.0 and $imc <25.0){$score = $f;} elseif($imc >= 25.0 and $imc <31.9){$score = $g;} elseif($imc >= 31.9){$score = $h;} break;

        case 13.3 :
        $meses = 159;
        if($imc <13.9){ $score = $a;} elseif($imc >= 13.9 and $imc < 15.1){$score = $b;} elseif($imc >= 15.1 and $imc < 16.5){$score = $c;} elseif($imc >= 16.5 and $imc < 18.4){$score = $d;} elseif($imc >=18.4 and $imc < 21.1){$score = $e;} elseif($imc >=21.1 and $imc <25.1){$score = $f;} elseif($imc >= 25.1 and $imc <32.1){$score = $g;} elseif($imc >= 32.1){$score = $h;} break;

        case 13.4 :
        $meses = 160;
        if($imc <14.0){ $score = $a;} elseif($imc >= 14.0 and $imc < 15.1){$score = $b;} elseif($imc >= 15.1 and $imc < 16.6){$score = $c;} elseif($imc >= 16.6 and $imc < 18.5){$score = $d;} elseif($imc >=18.5 and $imc < 21.1){$score = $e;} elseif($imc >=21.1 and $imc <25.2){$score = $f;} elseif($imc >= 25.2 and $imc <32.2){$score = $g;} elseif($imc >= 32.2){$score = $h;} break;

        case 13.5 :
        $meses = 161;
        if($imc <14.0){ $score = $a;} elseif($imc >= 14.0 and $imc < 15.2){$score = $b;} elseif($imc >= 15.2 and $imc < 16.6){$score = $c;} elseif($imc >= 16.6 and $imc < 18.6){$score = $d;} elseif($imc >=18.6 and $imc < 21.2){$score = $e;} elseif($imc >=21.2 and $imc <25.2){$score = $f;} elseif($imc >= 25.2 and $imc <32.3){$score = $g;} elseif($imc >= 32.3){$score = $h;} break;

        case 13.6 :
        $meses = 162;
        if($imc <14.0){ $score = $a;} elseif($imc >= 14.0 and $imc < 15.2){$score = $b;} elseif($imc >= 15.2 and $imc < 16.7){$score = $c;} elseif($imc >= 16.7 and $imc < 18.6){$score = $d;} elseif($imc >=18.6 and $imc < 21.3){$score = $e;} elseif($imc >=21.3 and $imc <25.3){$score = $f;} elseif($imc >= 25.3 and $imc <32.4){$score = $g;} elseif($imc >= 32.4){$score = $h;} break;

        case 13.7 :
        $meses = 163;
        if($imc <14.1){ $score = $a;} elseif($imc >= 14.1 and $imc < 15.2){$score = $b;} elseif($imc >= 15.2 and $imc < 16.7){$score = $c;} elseif($imc >= 16.7 and $imc < 18.7){$score = $d;} elseif($imc >=18.7 and $imc < 21.4){$score = $e;} elseif($imc >=21.4 and $imc <25.4){$score = $f;} elseif($imc >= 25.4 and $imc <32.6){$score = $g;} elseif($imc >= 32.6){$score = $h;} break;

        case 13.8 :
        $meses = 164;
        if($imc <14.1){ $score = $a;} elseif($imc >= 14.1 and $imc < 15.3){$score = $b;} elseif($imc >= 15.3 and $imc < 16.8){$score = $c;} elseif($imc >= 16.8 and $imc < 18.7){$score = $d;} elseif($imc >=18.7 and $imc < 21.5){$score = $e;} elseif($imc >=21.5 and $imc <25.5){$score = $f;} elseif($imc >= 25.5 and $imc <32.7){$score = $g;} elseif($imc >= 32.7){$score = $h;} break;

        case 13.9 :
        $meses = 165;
        if($imc <14.1){ $score = $a;} elseif($imc >= 14.1 and $imc < 15.3){$score = $b;} elseif($imc >= 15.3 and $imc < 16.8){$score = $c;} elseif($imc >= 16.8 and $imc < 18.8){$score = $d;} elseif($imc >=18.8 and $imc < 21.5){$score = $e;} elseif($imc >=21.5 and $imc <25.6){$score = $f;} elseif($imc >= 25.6 and $imc <32.8){$score = $g;} elseif($imc >= 32.8){$score = $h;} break;

        case 13.10:
        $meses = 166;
        if($imc <14.2){ $score = $a;} elseif($imc >= 14.2 and $imc < 15.4){$score = $b;} elseif($imc >= 15.4 and $imc < 16.9){$score = $c;} elseif($imc >= 16.9 and $imc < 18.9){$score = $d;} elseif($imc >=18.9 and $imc < 21.6){$score = $e;} elseif($imc >=21.6 and $imc <25.7){$score = $f;} elseif($imc >= 25.7 and $imc <32.9){$score = $g;} elseif($imc >= 32.9){$score = $h;} break;

        case 13.11:
        $meses = 167;
        if($imc <14.2){ $score = $a;} elseif($imc >= 14.2 and $imc < 15.4){$score = $b;} elseif($imc >= 15.4 and $imc < 17.0){$score = $c;} elseif($imc >= 17.0 and $imc < 18.9){$score = $d;} elseif($imc >=18.9 and $imc < 21.7){$score = $e;} elseif($imc >=21.7 and $imc <25.8){$score = $f;} elseif($imc >= 25.8 and $imc <33.0){$score = $g;} elseif($imc >= 33.0){$score = $h;} break;

        case 14.0 :
        $meses = 168;
        if($imc <14.3){ $score = $a;} elseif($imc >= 14.3 and $imc < 15.5){$score = $b;} elseif($imc >= 15.5 and $imc < 17.0){$score = $c;} elseif($imc >= 17.0 and $imc < 19.0){$score = $d;} elseif($imc >=19.0 and $imc < 21.8){$score = $e;} elseif($imc >=21.8 and $imc <25.9){$score = $f;} elseif($imc >= 25.9 and $imc <33.1){$score = $g;} elseif($imc >= 33.1){$score = $h;} break;

        case 14.01:
        $meses = 169;
        if($imc <14.3){ $score = $a;} elseif($imc >= 14.3 and $imc < 15.5){$score = $b;} elseif($imc >= 15.5 and $imc < 17.1){$score = $c;} elseif($imc >= 17.1 and $imc < 19.1){$score = $d;} elseif($imc >=19.1 and $imc < 21.8){$score = $e;} elseif($imc >=21.8 and $imc <26.0){$score = $f;} elseif($imc >= 26.0 and $imc <33.2){$score = $g;} elseif($imc >= 33.2){$score = $h;} break;

        case 14.2 :
        $meses = 170;
        if($imc <14.3){ $score = $a;} elseif($imc >= 14.3 and $imc < 15.6){$score = $b;} elseif($imc >= 15.6 and $imc < 17.1){$score = $c;} elseif($imc >= 17.1 and $imc < 19.1){$score = $d;} elseif($imc >=19.1 and $imc < 21.9){$score = $e;} elseif($imc >=21.9 and $imc <26.1){$score = $f;} elseif($imc >= 26.1 and $imc <33.3){$score = $g;} elseif($imc >= 33.3){$score = $h;} break;

        case 14.3 :
        $meses = 171;
        if($imc <14.4){ $score = $a;} elseif($imc >= 14.4 and $imc < 15.6){$score = $b;} elseif($imc >= 15.6 and $imc < 17.2){$score = $c;} elseif($imc >= 17.2 and $imc < 19.2){$score = $d;} elseif($imc >=19.2 and $imc < 22.0){$score = $e;} elseif($imc >=22.0 and $imc <26.2){$score = $f;} elseif($imc >= 26.2 and $imc <33.4){$score = $g;} elseif($imc >= 33.4){$score = $h;} break;

        case 14.4 :
        $meses = 172;
        if($imc <14.4){ $score = $a;} elseif($imc >= 14.4 and $imc < 15.7){$score = $b;} elseif($imc >= 15.7 and $imc < 17.2){$score = $c;} elseif($imc >= 17.2 and $imc < 19.3){$score = $d;} elseif($imc >=19.3 and $imc < 22.1){$score = $e;} elseif($imc >=22.1 and $imc <26.3){$score = $f;} elseif($imc >= 26.3 and $imc <33.5){$score = $g;} elseif($imc >= 33.5){$score = $h;} break;

        case 14.5 :
        $meses = 173;
        if($imc <14.5){ $score = $a;} elseif($imc >= 14.5 and $imc < 15.7){$score = $b;} elseif($imc >= 15.7 and $imc < 17.3){$score = $c;} elseif($imc >= 17.3 and $imc < 19.3){$score = $d;} elseif($imc >=19.3 and $imc < 22.2){$score = $e;} elseif($imc >=22.2 and $imc <26.4){$score = $f;} elseif($imc >= 26.4 and $imc <33.5){$score = $g;} elseif($imc >= 33.5){$score = $h;} break;

        case 14.6 :
        $meses = 174;
        if($imc <14.5){ $score = $a;} elseif($imc >= 14.5 and $imc < 15.7){$score = $b;} elseif($imc >= 15.7 and $imc < 17.3){$score = $c;} elseif($imc >= 17.3 and $imc < 19.4){$score = $d;} elseif($imc >=19.4 and $imc < 22.2){$score = $e;} elseif($imc >=22.2 and $imc <26.5){$score = $f;} elseif($imc >= 26.5 and $imc <33.6){$score = $g;} elseif($imc >= 33.6){$score = $h;} break;

        case 14.7 :
        $meses = 175;
        if($imc <14.5){ $score = $a;} elseif($imc >= 14.5 and $imc < 15.8){$score = $b;} elseif($imc >= 15.8 and $imc < 17.4){$score = $c;} elseif($imc >= 17.4 and $imc < 19.5){$score = $d;} elseif($imc >=19.5 and $imc < 22.3){$score = $e;} elseif($imc >=22.3 and $imc <26.5){$score = $f;} elseif($imc >= 26.5 and $imc <33.7){$score = $g;} elseif($imc >= 33.7){$score = $h;} break;

        case 14.8 :
        $meses = 176;
        if($imc <14.6){ $score = $a;} elseif($imc >= 14.6 and $imc < 15.8){$score = $b;} elseif($imc >= 15.8 and $imc < 17.4){$score = $c;} elseif($imc >= 17.4 and $imc < 19.5){$score = $d;} elseif($imc >=19.5 and $imc < 22.4){$score = $e;} elseif($imc >=22.4 and $imc <26.6){$score = $f;} elseif($imc >= 26.6 and $imc <33.8){$score = $g;} elseif($imc >= 33.8){$score = $h;} break;

        case 14.9 :
        $meses = 177;
        if($imc <14.6){ $score = $a;} elseif($imc >= 14.6 and $imc < 15.9){$score = $b;} elseif($imc >= 15.9 and $imc < 17.5){$score = $c;} elseif($imc >= 17.5 and $imc < 19.6){$score = $d;} elseif($imc >=19.6 and $imc < 22.5){$score = $e;} elseif($imc >=22.5 and $imc <26.7){$score = $f;} elseif($imc >= 26.7 and $imc <33.9){$score = $g;} elseif($imc >= 33.9){$score = $h;} break;

        case 14.10:
        $meses = 178;
        if($imc <14.6){ $score = $a;} elseif($imc >= 14.6 and $imc < 15.9){$score = $b;} elseif($imc >= 15.9 and $imc < 17.5){$score = $c;} elseif($imc >= 17.5 and $imc < 19.6){$score = $d;} elseif($imc >=19.6 and $imc < 22.5){$score = $e;} elseif($imc >=22.5 and $imc <26.8){$score = $f;} elseif($imc >= 26.8 and $imc <33.9){$score = $g;} elseif($imc >= 33.9){$score = $h;} break;

        case 14.11:
        $meses = 179;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.0){$score = $b;} elseif($imc >= 16.0 and $imc < 17.6){$score = $c;} elseif($imc >= 17.6 and $imc < 19.7){$score = $d;} elseif($imc >=19.7 and $imc < 22.6){$score = $e;} elseif($imc >=22.6 and $imc <26.9){$score = $f;} elseif($imc >= 26.9 and $imc <34.0){$score = $g;} elseif($imc >= 34.0){$score = $h;} break;

        case 15.0 :
        $meses = 180;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.0){$score = $b;} elseif($imc >= 16.0 and $imc < 17.6){$score = $c;} elseif($imc >= 17.6 and $imc < 19.8){$score = $d;} elseif($imc >=19.8 and $imc < 22.7){$score = $e;} elseif($imc >=22.7 and $imc <27.0){$score = $f;} elseif($imc >= 27.0 and $imc <34.1){$score = $g;} elseif($imc >= 34.1){$score = $h;} break;

        case 15.01:
        $meses = 181;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.1){$score = $b;} elseif($imc >= 16.1 and $imc < 17.7){$score = $c;} elseif($imc >= 17.7 and $imc < 19.8){$score = $d;} elseif($imc >=19.8 and $imc < 22.8){$score = $e;} elseif($imc >=22.8 and $imc <27.1){$score = $f;} elseif($imc >= 27.1 and $imc <34.1){$score = $g;} elseif($imc >= 34.1){$score = $h;} break;

        case 15.2 :
        $meses = 182;
        if($imc <14.8){ $score = $a;} elseif($imc >= 14.8 and $imc < 16.1){$score = $b;} elseif($imc >= 16.1 and $imc < 17.8){$score = $c;} elseif($imc >= 17.8 and $imc < 19.9){$score = $d;} elseif($imc >=19.9 and $imc < 22.8){$score = $e;} elseif($imc >=22.8 and $imc <27.1){$score = $f;} elseif($imc >= 27.1 and $imc <34.2){$score = $g;} elseif($imc >= 34.2){$score = $h;} break;

        case 15.3 :
        $meses = 183;
        if($imc <14.8){ $score = $a;} elseif($imc >= 14.8 and $imc < 16.1){$score = $b;} elseif($imc >= 16.1 and $imc < 17.8){$score = $c;} elseif($imc >= 17.8 and $imc < 20.0){$score = $d;} elseif($imc >=20.0 and $imc < 22.9){$score = $e;} elseif($imc >=22.9 and $imc <27.2){$score = $f;} elseif($imc >= 27.2 and $imc <34.3){$score = $g;} elseif($imc >= 34.3){$score = $h;} break;

        case 15.4 :
        $meses = 184;
        if($imc <14.8){ $score = $a;} elseif($imc >= 14.8 and $imc < 16.2){$score = $b;} elseif($imc >= 16.2 and $imc < 17.9){$score = $c;} elseif($imc >= 17.9 and $imc < 20.0){$score = $d;} elseif($imc >=20.0 and $imc < 23.0){$score = $e;} elseif($imc >=23.0 and $imc <27.3){$score = $f;} elseif($imc >= 27.3 and $imc <34.3){$score = $g;} elseif($imc >= 34.3){$score = $h;} break;

        case 15.5 :
        $meses = 185;
        if($imc <14.9){ $score = $a;} elseif($imc >= 14.9 and $imc < 16.2){$score = $b;} elseif($imc >= 16.2 and $imc < 17.9){$score = $c;} elseif($imc >= 17.9 and $imc < 20.1){$score = $d;} elseif($imc >=20.1 and $imc < 23.0){$score = $e;} elseif($imc >=23.0 and $imc <27.4){$score = $f;} elseif($imc >= 27.4 and $imc <34.4){$score = $g;} elseif($imc >= 34.4){$score = $h;} break;

        case 15.6 :
        $meses = 186;
        if($imc <14.9){ $score = $a;} elseif($imc >= 14.9 and $imc < 16.3){$score = $b;} elseif($imc >= 16.3 and $imc < 18.0){$score = $c;} elseif($imc >= 18.0 and $imc < 20.1){$score = $d;} elseif($imc >=20.1 and $imc < 23.1){$score = $e;} elseif($imc >=23.1 and $imc <27.4){$score = $f;} elseif($imc >= 27.4 and $imc <34.5){$score = $g;} elseif($imc >= 34.5){$score = $h;} break;

        case 15.7 :
        $meses = 187;
        if($imc <15.0){ $score = $a;} elseif($imc >= 15.0 and $imc < 16.3){$score = $b;} elseif($imc >= 16.3 and $imc < 18.0){$score = $c;} elseif($imc >= 18.0 and $imc < 20.2){$score = $d;} elseif($imc >=20.2 and $imc < 23.2){$score = $e;} elseif($imc >=23.2 and $imc <27.5){$score = $f;} elseif($imc >= 27.5 and $imc <34.5){$score = $g;} elseif($imc >= 34.5){$score = $h;} break;

        case 15.8 :
        $meses = 188;
        if($imc <15.0){ $score = $a;} elseif($imc >= 15.0 and $imc < 16.3){$score = $b;} elseif($imc >= 16.3 and $imc < 18.1){$score = $c;} elseif($imc >= 18.1 and $imc < 20.3){$score = $d;} elseif($imc >=20.3 and $imc < 23.3){$score = $e;} elseif($imc >=23.3 and $imc <27.6){$score = $f;} elseif($imc >= 27.6 and $imc <34.6){$score = $g;} elseif($imc >= 34.6){$score = $h;} break;

        case 15.9 :
        $meses = 189;
        if($imc <15.0){ $score = $a;} elseif($imc >= 15.0 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.1){$score = $c;} elseif($imc >= 18.1 and $imc < 20.3){$score = $d;} elseif($imc >=20.3 and $imc < 23.3){$score = $e;} elseif($imc >=23.3 and $imc <27.7){$score = $f;} elseif($imc >= 27.7 and $imc <34.6){$score = $g;} elseif($imc >= 34.6){$score = $h;} break;

        case 15.10:
        $meses = 190;
        if($imc <15.0){ $score = $a;} elseif($imc >= 15.0 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.2){$score = $c;} elseif($imc >= 18.2 and $imc < 20.4){$score = $d;} elseif($imc >=20.4 and $imc < 23.4){$score = $e;} elseif($imc >=23.4 and $imc <27.7){$score = $f;} elseif($imc >= 27.7 and $imc <34.7){$score = $g;} elseif($imc >= 34.7){$score = $h;} break;

        case 15.11:
        $meses = 191;
        if($imc <15.1){ $score = $a;} elseif($imc >= 15.1 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.2){$score = $c;} elseif($imc >= 18.2 and $imc < 20.4){$score = $d;} elseif($imc >=20.4 and $imc < 23.5){$score = $e;} elseif($imc >=23.5 and $imc <27.8){$score = $f;} elseif($imc >= 27.8 and $imc <34.7){$score = $g;} elseif($imc >= 34.7){$score = $h;} break;

        case 16.0 :
        $meses = 192;
        if($imc <15.1){ $score = $a;} elseif($imc >= 15.1 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.2){$score = $c;} elseif($imc >= 18.2 and $imc < 20.5){$score = $d;} elseif($imc >=20.5 and $imc < 23.5){$score = $e;} elseif($imc >=23.5 and $imc <27.9){$score = $f;} elseif($imc >= 27.9 and $imc <34.8){$score = $g;} elseif($imc >= 34.8){$score = $h;} break;

        case 16.01:
        $meses = 193;
        if($imc <15.1){ $score = $a;} elseif($imc >= 15.1 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.3){$score = $c;} elseif($imc >= 18.3 and $imc < 20.6){$score = $d;} elseif($imc >=20.6 and $imc < 23.6){$score = $e;} elseif($imc >=23.6 and $imc <27.9){$score = $f;} elseif($imc >= 27.9 and $imc <34.8){$score = $g;} elseif($imc >= 34.8){$score = $h;} break;

        case 16.2 :
        $meses = 194;
        if($imc <15.2){ $score = $a;} elseif($imc >= 15.2 and $imc < 16.6){$score = $b;} elseif($imc >= 16.6 and $imc < 18.3){$score = $c;} elseif($imc >= 18.3 and $imc < 20.6){$score = $d;} elseif($imc >=20.6 and $imc < 23.7){$score = $e;} elseif($imc >=23.7 and $imc <28.0){$score = $f;} elseif($imc >= 28.0 and $imc <34.8){$score = $g;} elseif($imc >= 34.8){$score = $h;} break;

        case 16.3 :
        $meses = 195;
        if($imc <15.2){ $score = $a;} elseif($imc >= 15.2 and $imc < 16.6){$score = $b;} elseif($imc >= 16.6 and $imc < 18.4){$score = $c;} elseif($imc >= 18.4 and $imc < 20.7){$score = $d;} elseif($imc >=20.7 and $imc < 23.7){$score = $e;} elseif($imc >=23.7 and $imc <28.1){$score = $f;} elseif($imc >= 28.1 and $imc <34.9){$score = $g;} elseif($imc >= 34.9){$score = $h;} break;

        case 16.4 :
        $meses = 196;
        if($imc <15.2){ $score = $a;} elseif($imc >= 15.2 and $imc < 16.7){$score = $b;} elseif($imc >= 16.7 and $imc < 18.4){$score = $c;} elseif($imc >= 18.4 and $imc < 20.7){$score = $d;} elseif($imc >=20.7 and $imc < 23.8){$score = $e;} elseif($imc >=23.8 and $imc <28.1){$score = $f;} elseif($imc >= 28.1 and $imc <34.9){$score = $g;} elseif($imc >= 34.9){$score = $h;} break;

        case 16.5 :
        $meses = 197;
        if($imc <15.3){ $score = $a;} elseif($imc >= 15.3 and $imc < 16.7){$score = $b;} elseif($imc >= 16.7 and $imc < 18.5){$score = $c;} elseif($imc >= 18.5 and $imc < 20.8){$score = $d;} elseif($imc >=20.8 and $imc < 23.8){$score = $e;} elseif($imc >=23.8 and $imc <28.2){$score = $f;} elseif($imc >= 28.2 and $imc <35.0){$score = $g;} elseif($imc >= 35.0){$score = $h;} break;

        case 16.6 :
        $meses = 198;
        if($imc <15.3){ $score = $a;} elseif($imc >= 15.3 and $imc < 16.7){$score = $b;} elseif($imc >= 16.7 and $imc < 18.5){$score = $c;} elseif($imc >= 18.5 and $imc < 20.8){$score = $d;} elseif($imc >=20.8 and $imc < 23.9){$score = $e;} elseif($imc >=23.9 and $imc <28.3){$score = $f;} elseif($imc >= 28.3 and $imc <35.0){$score = $g;} elseif($imc >= 35.0){$score = $h;} break;

        case 16.7 :
        $meses = 199;
        if($imc <15.3){ $score = $a;} elseif($imc >= 15.3 and $imc < 16.8){$score = $b;} elseif($imc >= 16.8 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 20.9){$score = $d;} elseif($imc >=20.9 and $imc < 24.0){$score = $e;} elseif($imc >=24.0 and $imc <28.3){$score = $f;} elseif($imc >= 28.3 and $imc <35.0){$score = $g;} elseif($imc >= 35.0){$score = $h;} break;

        case 16.8 :
        $meses = 200;
        if($imc <15.3){ $score = $a;} elseif($imc >= 15.3 and $imc < 16.8){$score = $b;} elseif($imc >= 16.8 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 20.9){$score = $d;} elseif($imc >=20.9 and $imc < 24.0){$score = $e;} elseif($imc >=24.0 and $imc <28.4){$score = $f;} elseif($imc >= 28.4 and $imc <35.1){$score = $g;} elseif($imc >= 35.1){$score = $h;} break;

        case 16.9 :
        $meses = 201;
        if($imc <15.4){ $score = $a;} elseif($imc >= 15.4 and $imc < 16.8){$score = $b;} elseif($imc >= 16.8 and $imc < 18.7){$score = $c;} elseif($imc >= 18.7 and $imc < 21.0){$score = $d;} elseif($imc >=21.0 and $imc < 24.1){$score = $e;} elseif($imc >=24.1 and $imc <28.5){$score = $f;} elseif($imc >= 28.5 and $imc <35.1){$score = $g;} elseif($imc >= 35.1){$score = $h;} break;

        case 16.10:
        $meses = 202;
        if($imc <15.4){ $score = $a;} elseif($imc >= 15.4 and $imc < 16.9){$score = $b;} elseif($imc >= 16.9 and $imc < 18.7){$score = $c;} elseif($imc >= 18.7 and $imc < 21.0){$score = $d;} elseif($imc >=21.0 and $imc < 24.2){$score = $e;} elseif($imc >=24.2 and $imc <28.5){$score = $f;} elseif($imc >= 28.5 and $imc <35.1){$score = $g;} elseif($imc >= 35.1){$score = $h;} break;

        case 16.11:
        $meses = 203;
        if($imc <15.4){ $score = $a;} elseif($imc >= 15.4 and $imc < 16.9){$score = $b;} elseif($imc >= 16.9 and $imc < 18.7){$score = $c;} elseif($imc >= 18.7 and $imc < 21.1){$score = $d;} elseif($imc >=21.1 and $imc < 24.2){$score = $e;} elseif($imc >=24.2 and $imc <28.6){$score = $f;} elseif($imc >= 28.6 and $imc <35.2){$score = $g;} elseif($imc >= 35.2){$score = $h;} break;

        case 17.0 :
        $meses = 204;
        if($imc <15.4){ $score = $a;} elseif($imc >= 15.4 and $imc < 16.9){$score = $b;} elseif($imc >= 16.9 and $imc < 18.8){$score = $c;} elseif($imc >= 18.8 and $imc < 21.1){$score = $d;} elseif($imc >=21.1 and $imc < 24.3){$score = $e;} elseif($imc >=24.3 and $imc <28.6){$score = $f;} elseif($imc >= 28.6 and $imc <35.2){$score = $g;} elseif($imc >= 35.2){$score = $h;} break;

        case 17.01:
        $meses = 205;
        if($imc <15.5){ $score = $a;} elseif($imc >= 15.5 and $imc < 17.0){$score = $b;} elseif($imc >= 17.0 and $imc < 18.8){$score = $c;} elseif($imc >= 18.8 and $imc < 21.2){$score = $d;} elseif($imc >=21.2 and $imc < 24.3){$score = $e;} elseif($imc >=24.3 and $imc <28.7){$score = $f;} elseif($imc >= 28.7 and $imc <35.2){$score = $g;} elseif($imc >= 35.2){$score = $h;} break;

        case 17.2 :
        $meses = 206;
        if($imc <15.5){ $score = $a;} elseif($imc >= 15.5 and $imc < 17.0){$score = $b;} elseif($imc >= 17.0 and $imc < 18.9){$score = $c;} elseif($imc >= 18.9 and $imc < 21.2){$score = $d;} elseif($imc >=21.2 and $imc < 24.4){$score = $e;} elseif($imc >=24.4 and $imc <28.7){$score = $f;} elseif($imc >= 28.7 and $imc <35.2){$score = $g;} elseif($imc >= 35.2){$score = $h;} break;

        case 17.3 :
        $meses = 207;
        if($imc <15.5){ $score = $a;} elseif($imc >= 15.5 and $imc < 17.0){$score = $b;} elseif($imc >= 17.0 and $imc < 18.9){$score = $c;} elseif($imc >= 18.9 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.4){$score = $e;} elseif($imc >=24.4 and $imc <28.8){$score = $f;} elseif($imc >= 28.8 and $imc <35.3){$score = $g;} elseif($imc >= 35.3){$score = $h;} break;

        case 17.4 :
        $meses = 208;
        if($imc <15.5){ $score = $a;} elseif($imc >= 15.5 and $imc < 17.1){$score = $b;} elseif($imc >= 17.1 and $imc < 18.9){$score = $c;} elseif($imc >= 18.9 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.5){$score = $e;} elseif($imc >=24.5 and $imc <28.9){$score = $f;} elseif($imc >= 28.9 and $imc <35.3){$score = $g;} elseif($imc >= 35.3){$score = $h;} break;

        case 17.5 :
        $meses = 209;
        if($imc <15.6){ $score = $a;} elseif($imc >= 15.6 and $imc < 17.1){$score = $b;} elseif($imc >= 17.1 and $imc < 19.0){$score = $c;} elseif($imc >= 19.0 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 24.5){$score = $e;} elseif($imc >=24.5 and $imc <28.9){$score = $f;} elseif($imc >= 28.9 and $imc <35.3){$score = $g;} elseif($imc >= 35.3){$score = $h;} break;

        case 17.6 :
        $meses = 210;
        if($imc <15.6){ $score = $a;} elseif($imc >= 15.6 and $imc < 17.1){$score = $b;} elseif($imc >= 17.1 and $imc < 19.0){$score = $c;} elseif($imc >= 19.0 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 24.6){$score = $e;} elseif($imc >=24.6 and $imc <29.0){$score = $f;} elseif($imc >= 29.0 and $imc <35.3){$score = $g;} elseif($imc >= 35.3){$score = $h;} break;

        case 17.7 :
        $meses = 211;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.5){$score = $c;} elseif($imc >= 18.5 and $imc < 21.2){$score = $d;} elseif($imc >=21.2 and $imc < 24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.4){$score = $f;} elseif($imc >= 29.4 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.8 :
        $meses = 212;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.5){$score = $c;} elseif($imc >= 18.5 and $imc < 21.2){$score = $d;} elseif($imc >=21.2 and $imc < 24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.9 :
        $meses = 213;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.5){$score = $c;} elseif($imc >= 18.5 and $imc < 21.2){$score = $d;} elseif($imc >=21.2 and $imc < 24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.10:
        $meses = 214;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.5){$score = $c;} elseif($imc >= 18.5 and $imc < 21.2){$score = $d;} elseif($imc >=21.2 and $imc < 24.7){$score = $e;} elseif($imc >=24.7 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 17.11:
        $meses = 215;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.2){$score = $d;} elseif($imc >=21.2 and $imc < 24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.0 :
        $meses = 216;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.4){$score = $b;} elseif($imc >= 16.4 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.01:
        $meses = 217;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.5){$score = $f;} elseif($imc >= 29.5 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.2 :
        $meses = 218;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.3 :
        $meses = 219;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.4 :
        $meses = 220;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.8){$score = $e;} elseif($imc >=24.8 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.3){$score = $g;} elseif($imc >= 36.3){$score = $h;} break;

        case 18.5 :
        $meses = 221;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.6 :
        $meses = 222;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.3){$score = $d;} elseif($imc >=21.3 and $imc < 24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.7 :
        $meses = 223;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.8 :
        $meses = 224;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.6){$score = $c;} elseif($imc >= 18.6 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.9 :
        $meses = 225;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.7){$score = $c;} elseif($imc >= 18.7 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.10:
        $meses = 226;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.7){$score = $c;} elseif($imc >= 18.7 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 24.9){$score = $e;} elseif($imc >=24.9 and $imc <29.6){$score = $f;} elseif($imc >= 29.6 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 18.11:
        $meses = 227;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.7){$score = $c;} elseif($imc >= 18.7 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 25.0){$score = $e;} elseif($imc >=25.0 and $imc <29.7){$score = $f;} elseif($imc >= 29.7 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;

        case 19.0 :
        $meses = 228;
        if($imc <14.7){ $score = $a;} elseif($imc >= 14.7 and $imc < 16.5){$score = $b;} elseif($imc >= 16.5 and $imc < 18.7){$score = $c;} elseif($imc >= 18.7 and $imc < 21.4){$score = $d;} elseif($imc >=21.4 and $imc < 25.0){$score = $e;} elseif($imc >=25.0 and $imc <29.7){$score = $f;} elseif($imc >= 29.7 and $imc <36.2){$score = $g;} elseif($imc >= 36.2){$score = $h;} break;



        default:
        $score = 'Erro no score';
        break;
      }
    }

    if($score == "Abaixo de -3"){$classificacao = 'Magreza acentuada';}
    elseif($score == "Entre -3 e 2"){$classificacao = 'Magreza';}
    elseif($score == "Entre 1 e 2"){$classificacao = 'Sobrepeso';}
    elseif($score == "Entre 2 e 3"){$classificacao = 'Obesidade';}
    elseif($score == "Acima de 3"){$classificacao = 'Obesidade grave';}
    else{$classificacao = 'Eutrofia(Normal)';}

    $arrayIMC = array(1 => $score, 2 => $classificacao, 3 =>$meses);
    return $arrayIMC;

  }
//===================================================Estatura por idade +++++++++++++++++++++++++++++++++++

  public function ResultadoClassificacaoEi($valor1, $valor2, $valor3){
  // $imc = $registros[$i]->imc;
  // $anos = $registros[$i]->idade;
  // $sexo = $registros[$i]->sexo;
    $ei = $valor1; //altura
    $anos = $valor2;
    $sexo = $valor3;
  //$ei = $_POST['ei'];//estatura por idade
    $a="Abaixo de -3";
    $b="Entre -3 e 2";
    $c="Entre -2 e -1";
    $d="Entre -1 e 0";
    $e="Entre 0 e 1";
    $f="Entre 1 e 2";
    $g="Entre 2 e 3";
    $h="Acima de 3";

    $muitobaixo = "Muito baixa EI";
    $baixa = "Baixa EI";
    $adequado = "EI adequada";

    $scoreEi;

     //__________________________________ FEMININO _____________________
    if ($sexo == 2) {

      switch ($anos) {
        case 10.0 :

        if($ei < 119.4){ $scoreEi = $a;} elseif($ei >=119.4 and $ei <125.8){$scoreEi = $b;} elseif($ei >=125.8 and $ei <132.2){$scoreEi = $c;} elseif($ei >=132.2 and $ei <138.6){$scoreEi = $d;} elseif($ei >= 138.6 and $ei <145.0){$scoreEi = $e;} elseif($ei >=145.0 and $ei <151.4){$scoreEi = $f;} elseif($ei >= 151.4 and $ei <157.8){$scoreEi = $g;} elseif($ei >= 157.8){$scoreEi = $h;} break;

        case 10.01:

        if($ei < 119.9){ $scoreEi = $a;} elseif($ei >=119.9 and $ei <126.3){$scoreEi = $b;} elseif($ei >=126.3 and $ei <132.7){$scoreEi = $c;} elseif($ei >=132.7 and $ei <139.2){$scoreEi = $d;} elseif($ei >= 139.2 and $ei <145.6){$scoreEi = $e;} elseif($ei >=145.6 and $ei <152.0){$scoreEi = $f;} elseif($ei >= 152.0 and $ei <158.4){$scoreEi = $g;} elseif($ei >= 158.4){$scoreEi = $h;} break;

        case 10.2 :

        if($ei < 120.4){ $scoreEi = $a;} elseif($ei >=120.4 and $ei <126.8){$scoreEi = $b;} elseif($ei >=126.8 and $ei <133.2){$scoreEi = $c;} elseif($ei >=133.2 and $ei <139.7){$scoreEi = $d;} elseif($ei >= 139.7 and $ei <146.1){$scoreEi = $e;} elseif($ei >=146.1 and $ei <152.6){$scoreEi = $f;} elseif($ei >= 152.6 and $ei <159.0){$scoreEi = $g;} elseif($ei >= 159.0){$scoreEi = $h;} break;

        case 10.3 :

        if($ei < 120.8){ $scoreEi = $a;} elseif($ei >=120.8 and $ei <127.3){$scoreEi = $b;} elseif($ei >=127.3 and $ei <133.7){$scoreEi = $c;} elseif($ei >=133.7 and $ei <140.2){$scoreEi = $d;} elseif($ei >= 140.2 and $ei <146.7){$scoreEi = $e;} elseif($ei >=146.7 and $ei <153.1){$scoreEi = $f;} elseif($ei >= 153.1 and $ei <159.6){$scoreEi = $g;} elseif($ei >= 159.6){$scoreEi = $h;} break;

        case 10.4 :

        if($ei < 121.3){ $scoreEi = $a;} elseif($ei >=121.3 and $ei <127.8){$scoreEi = $b;} elseif($ei >=127.8 and $ei <134.2){$scoreEi = $c;} elseif($ei >=134.2 and $ei <140.7){$scoreEi = $d;} elseif($ei >= 140.7 and $ei <147.2){$scoreEi = $e;} elseif($ei >=147.2 and $ei <153.7){$scoreEi = $f;} elseif($ei >= 153.7 and $ei <160.2){$scoreEi = $g;} elseif($ei >= 160.2){$scoreEi = $h;} break;

        case 10.5 :

        if($ei < 121.7){ $scoreEi = $a;} elseif($ei >=121.7 and $ei <128.2){$scoreEi = $b;} elseif($ei >=128.2 and $ei <134.8){$scoreEi = $c;} elseif($ei >=134.8 and $ei <141.3){$scoreEi = $d;} elseif($ei >= 141.3 and $ei <147.8){$scoreEi = $e;} elseif($ei >=147.8 and $ei <154.3){$scoreEi = $f;} elseif($ei >= 154.3 and $ei <160.8){$scoreEi = $g;} elseif($ei >= 160.8){$scoreEi = $h;} break;

        case 10.6 :

        if($ei < 122.2){ $scoreEi = $a;} elseif($ei >=122.2 and $ei <128.7){$scoreEi = $b;} elseif($ei >=128.7 and $ei <135.3){$scoreEi = $c;} elseif($ei >=135.3 and $ei <141.8){$scoreEi = $d;} elseif($ei >= 141.8 and $ei <148.3){$scoreEi = $e;} elseif($ei >=148.3 and $ei <154.8){$scoreEi = $f;} elseif($ei >= 154.8 and $ei <161.4){$scoreEi = $g;} elseif($ei >= 161.4){$scoreEi = $h;} break;

        case 10.7 :

        if($ei < 122.7){ $scoreEi = $a;} elseif($ei >=122.7 and $ei <129.2){$scoreEi = $b;} elseif($ei >=129.2 and $ei <135.8){$scoreEi = $c;} elseif($ei >=135.8 and $ei <142.3){$scoreEi = $d;} elseif($ei >= 142.3 and $ei <148.9){$scoreEi = $e;} elseif($ei >=148.9 and $ei <155.4){$scoreEi = $f;} elseif($ei >= 155.4 and $ei <162.0){$scoreEi = $g;} elseif($ei >= 162.0){$scoreEi = $h;} break;

        case 10.8 :

        if($ei < 123.2){ $scoreEi = $a;} elseif($ei >=123.2 and $ei <129.7){$scoreEi = $b;} elseif($ei >=129.7 and $ei <136.3){$scoreEi = $c;} elseif($ei >=136.3 and $ei <142.9){$scoreEi = $d;} elseif($ei >= 142.9 and $ei <149.4){$scoreEi = $e;} elseif($ei >=149.4 and $ei <156.0){$scoreEi = $f;} elseif($ei >= 156.0 and $ei <162.6){$scoreEi = $g;} elseif($ei >= 162.6){$scoreEi = $h;} break;

        case 10.9 :

        if($ei < 123.6){ $scoreEi = $a;} elseif($ei >=123.6 and $ei <130.2){$scoreEi = $b;} elseif($ei >=130.2 and $ei <136.8){$scoreEi = $c;} elseif($ei >=136.8 and $ei <143.4){$scoreEi = $d;} elseif($ei >= 143.4 and $ei <150.0){$scoreEi = $e;} elseif($ei >=150.0 and $ei <156.6){$scoreEi = $f;} elseif($ei >= 156.6 and $ei <163.1){$scoreEi = $g;} elseif($ei >= 163.1){$scoreEi = $h;} break;

        case 10.10:

        if($ei < 124.1){ $scoreEi = $a;} elseif($ei >=124.1 and $ei <130.7){$scoreEi = $b;} elseif($ei >=130.7 and $ei <137.3){$scoreEi = $c;} elseif($ei >=137.3 and $ei <143.9){$scoreEi = $d;} elseif($ei >= 143.9 and $ei <150.5){$scoreEi = $e;} elseif($ei >=150.5 and $ei <157.1){$scoreEi = $f;} elseif($ei >= 157.1 and $ei <163.7){$scoreEi = $g;} elseif($ei >= 163.7){$scoreEi = $h;} break;

        case 10.11:

        if($ei < 124.6){ $scoreEi = $a;} elseif($ei >=124.6 and $ei <131.2){$scoreEi = $b;} elseif($ei >=131.2 and $ei <137.8){$scoreEi = $c;} elseif($ei >=137.8 and $ei <144.5){$scoreEi = $d;} elseif($ei >= 144.5 and $ei <151.1){$scoreEi = $e;} elseif($ei >=151.1 and $ei <157.7){$scoreEi = $f;} elseif($ei >= 157.7 and $ei <164.3){$scoreEi = $g;} elseif($ei >= 164.3){$scoreEi = $h;} break;

        case 11.0 :

        if($ei < 125.1){ $scoreEi = $a;} elseif($ei >=125.1 and $ei <131.7){$scoreEi = $b;} elseif($ei >=131.7 and $ei <138.3){$scoreEi = $c;} elseif($ei >=138.3 and $ei <145.0){$scoreEi = $d;} elseif($ei >= 145.0 and $ei <151.6){$scoreEi = $e;} elseif($ei >=151.6 and $ei <158.3){$scoreEi = $f;} elseif($ei >= 158.3 and $ei <164.9){$scoreEi = $g;} elseif($ei >= 164.9){$scoreEi = $h;} break;

        case 11.01:

        if($ei < 125.5){ $scoreEi = $a;} elseif($ei >=125.5 and $ei <132.2){$scoreEi = $b;} elseif($ei >=132.2 and $ei <138.9){$scoreEi = $c;} elseif($ei >=138.9 and $ei <145.5){$scoreEi = $d;} elseif($ei >= 145.5 and $ei <152.2){$scoreEi = $e;} elseif($ei >=152.2 and $ei <158.9){$scoreEi = $f;} elseif($ei >= 158.9 and $ei <165.5){$scoreEi = $g;} elseif($ei >= 165.5){$scoreEi = $h;} break;

        case 11.2 :

        if($ei < 126.0){ $scoreEi = $a;} elseif($ei >=126.0 and $ei <132.7){$scoreEi = $b;} elseif($ei >=132.7 and $ei <139.4){$scoreEi = $c;} elseif($ei >=139.4 and $ei <146.1){$scoreEi = $d;} elseif($ei >= 146.1 and $ei <152.7){$scoreEi = $e;} elseif($ei >=152.7 and $ei <159.4){$scoreEi = $f;} elseif($ei >= 159.4 and $ei <166.1){$scoreEi = $g;} elseif($ei >= 166.1){$scoreEi = $h;} break;

        case 11.3 :

        if($ei < 126.5){ $scoreEi = $a;} elseif($ei >=126.5 and $ei <133.2){$scoreEi = $b;} elseif($ei >=133.2 and $ei <139.9){$scoreEi = $c;} elseif($ei >=139.9 and $ei <146.6){$scoreEi = $d;} elseif($ei >= 146.6 and $ei <153.3){$scoreEi = $e;} elseif($ei >=153.3 and $ei <160.0){$scoreEi = $f;} elseif($ei >= 160.0 and $ei <166.7){$scoreEi = $g;} elseif($ei >= 166.7){$scoreEi = $h;} break;

        case 11.4 :

        if($ei < 127.0){ $scoreEi = $a;} elseif($ei >=127.0 and $ei <133.7){$scoreEi = $b;} elseif($ei >=133.7 and $ei <140.4){$scoreEi = $c;} elseif($ei >=140.4 and $ei <147.1){$scoreEi = $d;} elseif($ei >= 147.1 and $ei <153.8){$scoreEi = $e;} elseif($ei >=153.8 and $ei <160.6){$scoreEi = $f;} elseif($ei >= 160.6 and $ei <167.3){$scoreEi = $g;} elseif($ei >= 167.3){$scoreEi = $h;} break;

        case 11.5 :

        if($ei < 127.4){ $scoreEi = $a;} elseif($ei >=127.4 and $ei <134.2){$scoreEi = $b;} elseif($ei >=134.2 and $ei <140.9){$scoreEi = $c;} elseif($ei >=140.9 and $ei <147.7){$scoreEi = $d;} elseif($ei >= 147.7 and $ei <154.4){$scoreEi = $e;} elseif($ei >=154.4 and $ei <161.1){$scoreEi = $f;} elseif($ei >= 161.1 and $ei <167.9){$scoreEi = $g;} elseif($ei >= 167.9){$scoreEi = $h;} break;

        case 11.6 :

        if($ei < 127.9){ $scoreEi = $a;} elseif($ei >=127.9 and $ei <134.7){$scoreEi = $b;} elseif($ei >=134.7 and $ei <141.4){$scoreEi = $c;} elseif($ei >=141.4 and $ei <148.2){$scoreEi = $d;} elseif($ei >= 148.2 and $ei <154.9){$scoreEi = $e;} elseif($ei >=154.9 and $ei <161.7){$scoreEi = $f;} elseif($ei >= 161.7 and $ei <168.4){$scoreEi = $g;} elseif($ei >= 168.4){$scoreEi = $h;} break;

        case 11.7 :

        if($ei < 128.4){ $scoreEi = $a;} elseif($ei >=128.4 and $ei <135.2){$scoreEi = $b;} elseif($ei >=135.2 and $ei <141.9){$scoreEi = $c;} elseif($ei >=141.9 and $ei <148.7){$scoreEi = $d;} elseif($ei >= 148.7 and $ei <155.5){$scoreEi = $e;} elseif($ei >=155.5 and $ei <162.2){$scoreEi = $f;} elseif($ei >= 162.2 and $ei <169.0){$scoreEi = $g;} elseif($ei >= 169.0){$scoreEi = $h;} break;

        case 11.8 :

        if($ei < 128.9){ $scoreEi = $a;} elseif($ei >=128.9 and $ei <135.7){$scoreEi = $b;} elseif($ei >=135.7 and $ei <142.4){$scoreEi = $c;} elseif($ei >=142.4 and $ei <149.2){$scoreEi = $d;} elseif($ei >= 149.2 and $ei <156.0){$scoreEi = $e;} elseif($ei >=156.0 and $ei <162.8){$scoreEi = $f;} elseif($ei >= 162.8 and $ei <169.6){$scoreEi = $g;} elseif($ei >= 169.6){$scoreEi = $h;} break;

        case 11.9 :

        if($ei < 129.3){ $scoreEi = $a;} elseif($ei >=129.3 and $ei <136.1){$scoreEi = $b;} elseif($ei >=136.1 and $ei <142.9){$scoreEi = $c;} elseif($ei >=142.9 and $ei <149.7){$scoreEi = $d;} elseif($ei >= 149.7 and $ei <156.5){$scoreEi = $e;} elseif($ei >=156.5 and $ei <163.3){$scoreEi = $f;} elseif($ei >= 163.3 and $ei <170.1){$scoreEi = $g;} elseif($ei >= 170.1){$scoreEi = $h;} break;

        case 11.10:

        if($ei < 129.8){ $scoreEi = $a;} elseif($ei >=129.8 and $ei <136.6){$scoreEi = $b;} elseif($ei >=136.6 and $ei <143.4){$scoreEi = $c;} elseif($ei >=143.4 and $ei <150.2){$scoreEi = $d;} elseif($ei >= 150.2 and $ei <157.1){$scoreEi = $e;} elseif($ei >=157.1 and $ei <163.9){$scoreEi = $f;} elseif($ei >= 163.9 and $ei <170.7){$scoreEi = $g;} elseif($ei >= 170.7){$scoreEi = $h;} break;

        case 11.11:

        if($ei < 130.3){ $scoreEi = $a;} elseif($ei >=130.3 and $ei <137.1){$scoreEi = $b;} elseif($ei >=137.1 and $ei <143.9){$scoreEi = $c;} elseif($ei >=143.9 and $ei <150.7){$scoreEi = $d;} elseif($ei >= 150.7 and $ei <157.6){$scoreEi = $e;} elseif($ei >=157.6 and $ei <164.4){$scoreEi = $f;} elseif($ei >= 164.4 and $ei <171.2){$scoreEi = $g;} elseif($ei >= 171.2){$scoreEi = $h;} break;

        case 12.0 :

        if($ei < 130.7){ $scoreEi = $a;} elseif($ei >=130.7 and $ei <137.6){$scoreEi = $b;} elseif($ei >=137.6 and $ei <144.4){$scoreEi = $c;} elseif($ei >=144.4 and $ei <151.2){$scoreEi = $d;} elseif($ei >= 151.2 and $ei <158.1){$scoreEi = $e;} elseif($ei >=158.1 and $ei <164.9){$scoreEi = $f;} elseif($ei >= 164.9 and $ei <171.8){$scoreEi = $g;} elseif($ei >= 171.8){$scoreEi = $h;} break;

        case 12.01:

        if($ei < 131.2){ $scoreEi = $a;} elseif($ei >=131.2 and $ei <138.0){$scoreEi = $b;} elseif($ei >=138.0 and $ei <144.9){$scoreEi = $c;} elseif($ei >=144.9 and $ei <151.7){$scoreEi = $d;} elseif($ei >= 151.7 and $ei <158.6){$scoreEi = $e;} elseif($ei >=158.6 and $ei <165.4){$scoreEi = $f;} elseif($ei >= 165.4 and $ei <172.3){$scoreEi = $g;} elseif($ei >= 172.3){$scoreEi = $h;} break;

        case 12.2 :

        if($ei < 131.6){ $scoreEi = $a;} elseif($ei >=131.6 and $ei <138.5){$scoreEi = $b;} elseif($ei >=138.5 and $ei <145.3){$scoreEi = $c;} elseif($ei >=145.3 and $ei <152.2){$scoreEi = $d;} elseif($ei >= 152.2 and $ei <159.1){$scoreEi = $e;} elseif($ei >=159.1 and $ei <165.9){$scoreEi = $f;} elseif($ei >= 165.9 and $ei <172.8){$scoreEi = $g;} elseif($ei >= 172.8){$scoreEi = $h;} break;

        case 12.3 :

        if($ei < 132.0){ $scoreEi = $a;} elseif($ei >=132.0 and $ei <138.9){$scoreEi = $b;} elseif($ei >=138.9 and $ei <145.8){$scoreEi = $c;} elseif($ei >=145.8 and $ei <152.7){$scoreEi = $d;} elseif($ei >= 152.7 and $ei <159.5){$scoreEi = $e;} elseif($ei >=159.5 and $ei <166.4){$scoreEi = $f;} elseif($ei >= 166.4 and $ei <173.3){$scoreEi = $g;} elseif($ei >= 173.3){$scoreEi = $h;} break;

        case 12.4 :

        if($ei < 132.5){ $scoreEi = $a;} elseif($ei >=132.5 and $ei <139.3){$scoreEi = $b;} elseif($ei >=139.3 and $ei <146.2){$scoreEi = $c;} elseif($ei >=146.2 and $ei <153.1){$scoreEi = $d;} elseif($ei >= 153.1 and $ei <160.0){$scoreEi = $e;} elseif($ei >=160.0 and $ei <166.9){$scoreEi = $f;} elseif($ei >= 166.9 and $ei <173.8){$scoreEi = $g;} elseif($ei >= 173.8){$scoreEi = $h;} break;

        case 12.5 :

        if($ei < 132.9){ $scoreEi = $a;} elseif($ei >=132.9 and $ei <139.8){$scoreEi = $b;} elseif($ei >=139.8 and $ei <146.7){$scoreEi = $c;} elseif($ei >=146.7 and $ei <153.6){$scoreEi = $d;} elseif($ei >= 153.6 and $ei <160.5){$scoreEi = $e;} elseif($ei >=160.5 and $ei <167.4){$scoreEi = $f;} elseif($ei >= 167.4 and $ei <174.3){$scoreEi = $g;} elseif($ei >= 174.3){$scoreEi = $h;} break;

        case 12.6 :

        if($ei < 133.3){ $scoreEi = $a;} elseif($ei >=133.3 and $ei <140.2){$scoreEi = $b;} elseif($ei >=140.2 and $ei <147.1){$scoreEi = $c;} elseif($ei >=147.1 and $ei <154.0){$scoreEi = $d;} elseif($ei >= 154.0 and $ei <160.9){$scoreEi = $e;} elseif($ei >=160.9 and $ei <167.8){$scoreEi = $f;} elseif($ei >= 167.8 and $ei <174.7){$scoreEi = $g;} elseif($ei >= 174.7){$scoreEi = $h;} break;

        case 12.7 :

        if($ei < 133.7){ $scoreEi = $a;} elseif($ei >=133.7 and $ei <140.6){$scoreEi = $b;} elseif($ei >=140.6 and $ei <147.5){$scoreEi = $c;} elseif($ei >=147.5 and $ei <154.4){$scoreEi = $d;} elseif($ei >= 154.4 and $ei <161.3){$scoreEi = $e;} elseif($ei >=161.3 and $ei <168.3){$scoreEi = $f;} elseif($ei >= 168.3 and $ei <175.2){$scoreEi = $g;} elseif($ei >= 175.2){$scoreEi = $h;} break;

        case 12.8 :

        if($ei < 134.1){ $scoreEi = $a;} elseif($ei >=134.1 and $ei <141.0){$scoreEi = $b;} elseif($ei >=141.0 and $ei <147.9){$scoreEi = $c;} elseif($ei >=147.9 and $ei <154.8){$scoreEi = $d;} elseif($ei >= 154.8 and $ei <161.8){$scoreEi = $e;} elseif($ei >=161.8 and $ei <168.7){$scoreEi = $f;} elseif($ei >= 168.7 and $ei <175.6){$scoreEi = $g;} elseif($ei >= 175.6){$scoreEi = $h;} break;

        case 12.9 :

        if($ei < 134.5){ $scoreEi = $a;} elseif($ei >=134.5 and $ei <141.4){$scoreEi = $b;} elseif($ei >=141.4 and $ei <148.3){$scoreEi = $c;} elseif($ei >=148.3 and $ei <155.2){$scoreEi = $d;} elseif($ei >= 155.2 and $ei <162.2){$scoreEi = $e;} elseif($ei >=162.2 and $ei <169.1){$scoreEi = $f;} elseif($ei >= 169.1 and $ei <176.0){$scoreEi = $g;} elseif($ei >= 176.0){$scoreEi = $h;} break;

        case 12.10:

        if($ei < 134.8){ $scoreEi = $a;} elseif($ei >=134.8 and $ei <141.8){$scoreEi = $b;} elseif($ei >=141.8 and $ei <148.7){$scoreEi = $c;} elseif($ei >=148.7 and $ei <155.6){$scoreEi = $d;} elseif($ei >= 155.6 and $ei <162.6){$scoreEi = $e;} elseif($ei >=162.6 and $ei <169.5){$scoreEi = $f;} elseif($ei >= 169.5 and $ei <176.4){$scoreEi = $g;} elseif($ei >= 176.4){$scoreEi = $h;} break;

        case 12.11:

        if($ei < 135.2){ $scoreEi = $a;} elseif($ei >=135.2 and $ei <142.1){$scoreEi = $b;} elseif($ei >=142.1 and $ei <149.1){$scoreEi = $c;} elseif($ei >=149.1 and $ei <156.0){$scoreEi = $d;} elseif($ei >= 156.0 and $ei <162.9){$scoreEi = $e;} elseif($ei >=162.9 and $ei <169.9){$scoreEi = $f;} elseif($ei >= 169.9 and $ei <176.8){$scoreEi = $g;} elseif($ei >= 176.8){$scoreEi = $h;} break;

        case 13.0 :

        if($ei < 135.6){ $scoreEi = $a;} elseif($ei >=135.6 and $ei <142.5){$scoreEi = $b;} elseif($ei >=142.5 and $ei <149.4){$scoreEi = $c;} elseif($ei >=149.4 and $ei <156.4){$scoreEi = $d;} elseif($ei >= 156.4 and $ei <163.3){$scoreEi = $e;} elseif($ei >=163.3 and $ei <170.3){$scoreEi = $f;} elseif($ei >= 170.3 and $ei <177.2){$scoreEi = $g;} elseif($ei >= 177.2){$scoreEi = $h;} break;

        case 13.01:

        if($ei < 135.9){ $scoreEi = $a;} elseif($ei >=135.9 and $ei <142.8){$scoreEi = $b;} elseif($ei >=142.8 and $ei <149.8){$scoreEi = $c;} elseif($ei >=149.8 and $ei <156.7){$scoreEi = $d;} elseif($ei >= 156.7 and $ei <163.7){$scoreEi = $e;} elseif($ei >=163.7 and $ei <170.6){$scoreEi = $f;} elseif($ei >= 170.6 and $ei <177.6){$scoreEi = $g;} elseif($ei >= 177.6){$scoreEi = $h;} break;

        case 13.2 :

        if($ei < 136.2){ $scoreEi = $a;} elseif($ei >=136.2 and $ei <143.2){$scoreEi = $b;} elseif($ei >=143.2 and $ei <150.1){$scoreEi = $c;} elseif($ei >=150.1 and $ei <157.1){$scoreEi = $d;} elseif($ei >= 157.1 and $ei <164.0){$scoreEi = $e;} elseif($ei >=164.0 and $ei <171.0){$scoreEi = $f;} elseif($ei >= 171.0 and $ei <177.9){$scoreEi = $g;} elseif($ei >= 177.9){$scoreEi = $h;} break;

        case 13.3 :

        if($ei < 136.5){ $scoreEi = $a;} elseif($ei >=136.5 and $ei <143.5){$scoreEi = $b;} elseif($ei >=143.5 and $ei <150.4){$scoreEi = $c;} elseif($ei >=150.4 and $ei <157.4){$scoreEi = $d;} elseif($ei >= 157.4 and $ei <164.3){$scoreEi = $e;} elseif($ei >=164.3 and $ei <171.3){$scoreEi = $f;} elseif($ei >= 171.3 and $ei <178.2){$scoreEi = $g;} elseif($ei >= 178.2){$scoreEi = $h;} break;

        case 13.4 :

        if($ei < 136.9){ $scoreEi = $a;} elseif($ei >=136.9 and $ei <143.8){$scoreEi = $b;} elseif($ei >=143.8 and $ei <150.8){$scoreEi = $c;} elseif($ei >=150.8 and $ei <157.7){$scoreEi = $d;} elseif($ei >= 157.7 and $ei <164.7){$scoreEi = $e;} elseif($ei >=164.7 and $ei <171.6){$scoreEi = $f;} elseif($ei >= 171.6 and $ei <178.6){$scoreEi = $g;} elseif($ei >= 178.6){$scoreEi = $h;} break;

        case 13.5 :

        if($ei < 137.2){ $scoreEi = $a;} elseif($ei >=137.2 and $ei <144.1){$scoreEi = $b;} elseif($ei >=144.1 and $ei <151.1){$scoreEi = $c;} elseif($ei >=151.1 and $ei <158.0){$scoreEi = $d;} elseif($ei >= 158.0 and $ei <165.0){$scoreEi = $e;} elseif($ei >=165.0 and $ei <171.9){$scoreEi = $f;} elseif($ei >= 171.9 and $ei <178.9){$scoreEi = $g;} elseif($ei >= 178.9){$scoreEi = $h;} break;

        case 13.6 :

        if($ei < 137.4){ $scoreEi = $a;} elseif($ei >=137.4 and $ei <144.4){$scoreEi = $b;} elseif($ei >=144.4 and $ei <151.3){$scoreEi = $c;} elseif($ei >=151.3 and $ei <158.3){$scoreEi = $d;} elseif($ei >= 158.3 and $ei <165.3){$scoreEi = $e;} elseif($ei >=165.3 and $ei <172.2){$scoreEi = $f;} elseif($ei >= 172.2 and $ei <179.2){$scoreEi = $g;} elseif($ei >= 179.2){$scoreEi = $h;} break;

        case 13.7 :

        if($ei < 137.7){ $scoreEi = $a;} elseif($ei >=137.7 and $ei <144.7){$scoreEi = $b;} elseif($ei >=144.7 and $ei <151.6){$scoreEi = $c;} elseif($ei >=151.6 and $ei <158.6){$scoreEi = $d;} elseif($ei >= 158.6 and $ei <165.5){$scoreEi = $e;} elseif($ei >=165.5 and $ei <172.5){$scoreEi = $f;} elseif($ei >= 172.5 and $ei <179.4){$scoreEi = $g;} elseif($ei >= 179.4){$scoreEi = $h;} break;

        case 13.8 :

        if($ei < 138.0){ $scoreEi = $a;} elseif($ei >=138.0 and $ei <144.9){$scoreEi = $b;} elseif($ei >=144.9 and $ei <151.9){$scoreEi = $c;} elseif($ei >=151.9 and $ei <158.8){$scoreEi = $d;} elseif($ei >= 158.8 and $ei <165.8){$scoreEi = $e;} elseif($ei >=165.8 and $ei <172.7){$scoreEi = $f;} elseif($ei >= 172.7 and $ei <179.7){$scoreEi = $g;} elseif($ei >= 179.7){$scoreEi = $h;} break;

        case 13.9 :

        if($ei < 138.2){ $scoreEi = $a;} elseif($ei >=138.2 and $ei <145.2){$scoreEi = $b;} elseif($ei >=145.2 and $ei <152.1){$scoreEi = $c;} elseif($ei >=152.1 and $ei <159.1){$scoreEi = $d;} elseif($ei >= 159.1 and $ei <166.0){$scoreEi = $e;} elseif($ei >=166.0 and $ei <173.0){$scoreEi = $f;} elseif($ei >= 173.0 and $ei <179.9){$scoreEi = $g;} elseif($ei >= 179.9){$scoreEi = $h;} break;

        case 13.10:

        if($ei < 138.5){ $scoreEi = $a;} elseif($ei >=138.5 and $ei <145.4){$scoreEi = $b;} elseif($ei >=145.4 and $ei <152.4){$scoreEi = $c;} elseif($ei >=152.4 and $ei <159.3){$scoreEi = $d;} elseif($ei >= 159.3 and $ei <166.3){$scoreEi = $e;} elseif($ei >=166.3 and $ei <173.2){$scoreEi = $f;} elseif($ei >= 173.2 and $ei <180.2){$scoreEi = $g;} elseif($ei >= 180.2){$scoreEi = $h;} break;

        case 13.11:

        if($ei < 138.7){ $scoreEi = $a;} elseif($ei >=138.7 and $ei <145.7){$scoreEi = $b;} elseif($ei >=145.7 and $ei <152.6){$scoreEi = $c;} elseif($ei >=152.6 and $ei <159.6){$scoreEi = $d;} elseif($ei >= 159.6 and $ei <166.5){$scoreEi = $e;} elseif($ei >=166.5 and $ei <173.5){$scoreEi = $f;} elseif($ei >= 173.5 and $ei <180.4){$scoreEi = $g;} elseif($ei >= 180.4){$scoreEi = $h;} break;

        case 14.0 :

        if($ei < 139.0){ $scoreEi = $a;} elseif($ei >=139.0 and $ei <145.9){$scoreEi = $b;} elseif($ei >=145.9 and $ei <152.8){$scoreEi = $c;} elseif($ei >=152.8 and $ei <159.8){$scoreEi = $d;} elseif($ei >= 159.8 and $ei <166.7){$scoreEi = $e;} elseif($ei >=166.7 and $ei <173.7){$scoreEi = $f;} elseif($ei >= 173.7 and $ei <180.6){$scoreEi = $g;} elseif($ei >= 180.6){$scoreEi = $h;} break;

        case 14.01:

        if($ei < 139.2){ $scoreEi = $a;} elseif($ei >=139.2 and $ei <146.1){$scoreEi = $b;} elseif($ei >=146.1 and $ei <153.1){$scoreEi = $c;} elseif($ei >=153.1 and $ei <160.0){$scoreEi = $d;} elseif($ei >= 160.0 and $ei <166.9){$scoreEi = $e;} elseif($ei >=166.9 and $ei <173.9){$scoreEi = $f;} elseif($ei >= 173.9 and $ei <180.8){$scoreEi = $g;} elseif($ei >= 180.8){$scoreEi = $h;} break;

        case 14.2 :

        if($ei < 139.4){ $scoreEi = $a;} elseif($ei >=139.4 and $ei <146.3){$scoreEi = $b;} elseif($ei >=146.3 and $ei <153.3){$scoreEi = $c;} elseif($ei >=153.3 and $ei <160.2){$scoreEi = $d;} elseif($ei >= 160.2 and $ei <167.1){$scoreEi = $e;} elseif($ei >=167.1 and $ei <174.1){$scoreEi = $f;} elseif($ei >= 174.1 and $ei <181.0){$scoreEi = $g;} elseif($ei >= 181.0){$scoreEi = $h;} break;

        case 14.3 :

        if($ei < 139.6){ $scoreEi = $a;} elseif($ei >=139.6 and $ei <146.5){$scoreEi = $b;} elseif($ei >=146.5 and $ei <153.5){$scoreEi = $c;} elseif($ei >=153.5 and $ei <160.4){$scoreEi = $d;} elseif($ei >= 160.4 and $ei <167.3){$scoreEi = $e;} elseif($ei >=167.3 and $ei <174.2){$scoreEi = $f;} elseif($ei >= 174.2 and $ei <181.2){$scoreEi = $g;} elseif($ei >= 181.2){$scoreEi = $h;} break;

        case 14.4 :

        if($ei < 139.8){ $scoreEi = $a;} elseif($ei >=139.8 and $ei <146.7){$scoreEi = $b;} elseif($ei >=146.7 and $ei <153.6){$scoreEi = $c;} elseif($ei >=153.6 and $ei <160.6){$scoreEi = $d;} elseif($ei >= 160.6 and $ei <167.5){$scoreEi = $e;} elseif($ei >=167.5 and $ei <174.4){$scoreEi = $f;} elseif($ei >= 174.4 and $ei <181.3){$scoreEi = $g;} elseif($ei >= 181.3){$scoreEi = $h;} break;

        case 14.5 :

        if($ei < 140.0){ $scoreEi = $a;} elseif($ei >=140.0 and $ei <146.9){$scoreEi = $b;} elseif($ei >=146.9 and $ei <153.8){$scoreEi = $c;} elseif($ei >=153.8 and $ei <160.7){$scoreEi = $d;} elseif($ei >= 160.7 and $ei <167.7){$scoreEi = $e;} elseif($ei >=167.7 and $ei <174.6){$scoreEi = $f;} elseif($ei >= 174.6 and $ei <181.5){$scoreEi = $g;} elseif($ei >= 181.5){$scoreEi = $h;} break;

        case 14.6 :

        if($ei < 140.1){ $scoreEi = $a;} elseif($ei >=140.1 and $ei <147.1){$scoreEi = $b;} elseif($ei >=147.1 and $ei <154.0){$scoreEi = $c;} elseif($ei >=154.0 and $ei <160.9){$scoreEi = $d;} elseif($ei >= 160.9 and $ei <167.8){$scoreEi = $e;} elseif($ei >=167.8 and $ei <174.7){$scoreEi = $f;} elseif($ei >= 174.7 and $ei <181.6){$scoreEi = $g;} elseif($ei >= 181.6){$scoreEi = $h;} break;

        case 14.7 :

        if($ei < 140.3){ $scoreEi = $a;} elseif($ei >=140.3 and $ei <147.2){$scoreEi = $b;} elseif($ei >=147.2 and $ei <154.1){$scoreEi = $c;} elseif($ei >=154.1 and $ei <161.0){$scoreEi = $d;} elseif($ei >= 161.0 and $ei <168.0){$scoreEi = $e;} elseif($ei >=168.0 and $ei <174.9){$scoreEi = $f;} elseif($ei >= 174.9 and $ei <181.8){$scoreEi = $g;} elseif($ei >= 181.8){$scoreEi = $h;} break;

        case 14.8 :

        if($ei < 140.5){ $scoreEi = $a;} elseif($ei >=140.5 and $ei <147.4){$scoreEi = $b;} elseif($ei >=147.4 and $ei <154.3){$scoreEi = $c;} elseif($ei >=154.3 and $ei <161.2){$scoreEi = $d;} elseif($ei >= 161.2 and $ei <168.1){$scoreEi = $e;} elseif($ei >=168.1 and $ei <175.0){$scoreEi = $f;} elseif($ei >= 175.0 and $ei <181.9){$scoreEi = $g;} elseif($ei >= 181.9){$scoreEi = $h;} break;

        case 14.9 :

        if($ei < 140.6){ $scoreEi = $a;} elseif($ei >=140.6 and $ei <147.5){$scoreEi = $b;} elseif($ei >=147.5 and $ei <154.4){$scoreEi = $c;} elseif($ei >=154.4 and $ei <161.3){$scoreEi = $d;} elseif($ei >= 161.3 and $ei <168.2){$scoreEi = $e;} elseif($ei >=168.2 and $ei <175.1){$scoreEi = $f;} elseif($ei >= 175.1 and $ei <182.0){$scoreEi = $g;} elseif($ei >= 182.0){$scoreEi = $h;} break;

        case 14.10:

        if($ei < 140.8){ $scoreEi = $a;} elseif($ei >=140.8 and $ei <147.7){$scoreEi = $b;} elseif($ei >=147.7 and $ei <154.5){$scoreEi = $c;} elseif($ei >=154.5 and $ei <161.4){$scoreEi = $d;} elseif($ei >= 161.4 and $ei <168.3){$scoreEi = $e;} elseif($ei >=168.3 and $ei <175.2){$scoreEi = $f;} elseif($ei >= 175.2 and $ei <182.1){$scoreEi = $g;} elseif($ei >= 182.1){$scoreEi = $h;} break;

        case 14.11:

        if($ei < 140.9){ $scoreEi = $a;} elseif($ei >=140.9 and $ei <147.8){$scoreEi = $b;} elseif($ei >=147.8 and $ei <154.7){$scoreEi = $c;} elseif($ei >=154.7 and $ei <161.6){$scoreEi = $d;} elseif($ei >= 161.6 and $ei <168.4){$scoreEi = $e;} elseif($ei >=168.4 and $ei <175.3){$scoreEi = $f;} elseif($ei >= 175.3 and $ei <182.2){$scoreEi = $g;} elseif($ei >= 182.2){$scoreEi = $h;} break;

        case 15.0 :

        if($ei < 141.0){ $scoreEi = $a;} elseif($ei >=141.0 and $ei <147.9){$scoreEi = $b;} elseif($ei >=147.9 and $ei <154.8){$scoreEi = $c;} elseif($ei >=154.8 and $ei <161.7){$scoreEi = $d;} elseif($ei >= 161.7 and $ei <168.5){$scoreEi = $e;} elseif($ei >=168.5 and $ei <175.4){$scoreEi = $f;} elseif($ei >= 175.4 and $ei <182.3){$scoreEi = $g;} elseif($ei >= 182.3){$scoreEi = $h;} break;

        case 15.01:

        if($ei < 141.2){ $scoreEi = $a;} elseif($ei >=141.2 and $ei <148.0){$scoreEi = $b;} elseif($ei >=148.0 and $ei <154.9){$scoreEi = $c;} elseif($ei >=154.9 and $ei <161.8){$scoreEi = $d;} elseif($ei >= 161.8 and $ei <168.6){$scoreEi = $e;} elseif($ei >=168.6 and $ei <175.5){$scoreEi = $f;} elseif($ei >= 175.5 and $ei <182.4){$scoreEi = $g;} elseif($ei >= 182.4){$scoreEi = $h;} break;

        case 15.2 :

        if($ei < 141.3){ $scoreEi = $a;} elseif($ei >=141.3 and $ei <148.1){$scoreEi = $b;} elseif($ei >=148.1 and $ei <155.0){$scoreEi = $c;} elseif($ei >=155.0 and $ei <161.9){$scoreEi = $d;} elseif($ei >= 161.9 and $ei <168.7){$scoreEi = $e;} elseif($ei >=168.7 and $ei <175.6){$scoreEi = $f;} elseif($ei >= 175.6 and $ei <182.5){$scoreEi = $g;} elseif($ei >= 182.5){$scoreEi = $h;} break;

        case 15.3 :

        if($ei < 141.4){ $scoreEi = $a;} elseif($ei >=141.4 and $ei <148.2){$scoreEi = $b;} elseif($ei >=148.2 and $ei <155.1){$scoreEi = $c;} elseif($ei >=155.1 and $ei <162.0){$scoreEi = $d;} elseif($ei >= 162.0 and $ei <168.8){$scoreEi = $e;} elseif($ei >=168.8 and $ei <175.7){$scoreEi = $f;} elseif($ei >= 175.7 and $ei <182.5){$scoreEi = $g;} elseif($ei >= 182.5){$scoreEi = $h;} break;

        case 15.4 :

        if($ei < 141.5){ $scoreEi = $a;} elseif($ei >=141.5 and $ei <148.3){$scoreEi = $b;} elseif($ei >=148.3 and $ei <155.2){$scoreEi = $c;} elseif($ei >=155.2 and $ei <162.0){$scoreEi = $d;} elseif($ei >= 162.0 and $ei <168.9){$scoreEi = $e;} elseif($ei >=168.9 and $ei <175.7){$scoreEi = $f;} elseif($ei >= 175.7 and $ei <182.6){$scoreEi = $g;} elseif($ei >= 182.6){$scoreEi = $h;} break;

        case 15.5 :

        if($ei < 141.6){ $scoreEi = $a;} elseif($ei >=141.6 and $ei <148.4){$scoreEi = $b;} elseif($ei >=148.4 and $ei <155.3){$scoreEi = $c;} elseif($ei >=155.3 and $ei <162.1){$scoreEi = $d;} elseif($ei >= 162.1 and $ei <169.0){$scoreEi = $e;} elseif($ei >=169.0 and $ei <175.8){$scoreEi = $f;} elseif($ei >= 175.8 and $ei <182.6){$scoreEi = $g;} elseif($ei >= 182.6){$scoreEi = $h;} break;

        case 15.6 :

        if($ei < 141.7){ $scoreEi = $a;} elseif($ei >=141.7 and $ei <148.5){$scoreEi = $b;} elseif($ei >=148.5 and $ei <155.4){$scoreEi = $c;} elseif($ei >=155.4 and $ei <162.2){$scoreEi = $d;} elseif($ei >= 162.2 and $ei <169.0){$scoreEi = $e;} elseif($ei >=169.0 and $ei <175.9){$scoreEi = $f;} elseif($ei >= 175.9 and $ei <182.7){$scoreEi = $g;} elseif($ei >= 182.7){$scoreEi = $h;} break;

        case 15.7 :

        if($ei < 141.8){ $scoreEi = $a;} elseif($ei >=141.8 and $ei <148.6){$scoreEi = $b;} elseif($ei >=148.6 and $ei <155.4){$scoreEi = $c;} elseif($ei >=155.4 and $ei <162.3){$scoreEi = $d;} elseif($ei >= 162.3 and $ei <169.1){$scoreEi = $e;} elseif($ei >=169.1 and $ei <175.9){$scoreEi = $f;} elseif($ei >= 175.9 and $ei <182.7){$scoreEi = $g;} elseif($ei >= 182.7){$scoreEi = $h;} break;

        case 15.8 :

        if($ei < 141.9){ $scoreEi = $a;} elseif($ei >=141.9 and $ei <148.7){$scoreEi = $b;} elseif($ei >=148.7 and $ei <155.5){$scoreEi = $c;} elseif($ei >=155.5 and $ei <162.3){$scoreEi = $d;} elseif($ei >= 162.3 and $ei <169.1){$scoreEi = $e;} elseif($ei >=169.1 and $ei <176.0){$scoreEi = $f;} elseif($ei >= 176.0 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 15.9 :

        if($ei < 141.9){ $scoreEi = $a;} elseif($ei >=141.9 and $ei <148.7){$scoreEi = $b;} elseif($ei >=148.7 and $ei <155.6){$scoreEi = $c;} elseif($ei >=155.6 and $ei <162.4){$scoreEi = $d;} elseif($ei >= 162.4 and $ei <169.2){$scoreEi = $e;} elseif($ei >=169.2 and $ei <176.0){$scoreEi = $f;} elseif($ei >= 176.0 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 15.10:

        if($ei < 142.0){ $scoreEi = $a;} elseif($ei >=142.0 and $ei <148.8){$scoreEi = $b;} elseif($ei >=148.8 and $ei <155.6){$scoreEi = $c;} elseif($ei >=155.6 and $ei <162.4){$scoreEi = $d;} elseif($ei >= 162.4 and $ei <169.2){$scoreEi = $e;} elseif($ei >=169.2 and $ei <176.0){$scoreEi = $f;} elseif($ei >= 176.0 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 15.11:

        if($ei < 142.1){ $scoreEi = $a;} elseif($ei >=142.1 and $ei <148.9){$scoreEi = $b;} elseif($ei >=148.9 and $ei <155.7){$scoreEi = $c;} elseif($ei >=155.7 and $ei <162.5){$scoreEi = $d;} elseif($ei >= 162.5 and $ei <169.3){$scoreEi = $e;} elseif($ei >=169.3 and $ei <176.1){$scoreEi = $f;} elseif($ei >= 176.1 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.0 :

        if($ei < 142.2){ $scoreEi = $a;} elseif($ei >=142.2 and $ei <148.9){$scoreEi = $b;} elseif($ei >=148.9 and $ei <155.7){$scoreEi = $c;} elseif($ei >=155.7 and $ei <162.5){$scoreEi = $d;} elseif($ei >= 162.5 and $ei <169.3){$scoreEi = $e;} elseif($ei >=169.3 and $ei <176.1){$scoreEi = $f;} elseif($ei >= 176.1 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.01:

        if($ei < 142.2){ $scoreEi = $a;} elseif($ei >=142.2 and $ei <149.0){$scoreEi = $b;} elseif($ei >=149.0 and $ei <155.8){$scoreEi = $c;} elseif($ei >=155.8 and $ei <162.6){$scoreEi = $d;} elseif($ei >= 162.6 and $ei <169.3){$scoreEi = $e;} elseif($ei >=169.3 and $ei <176.1){$scoreEi = $f;} elseif($ei >= 176.1 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.2 :

        if($ei < 142.3){ $scoreEi = $a;} elseif($ei >=142.3 and $ei <149.1){$scoreEi = $b;} elseif($ei >=149.1 and $ei <155.8){$scoreEi = $c;} elseif($ei >=155.8 and $ei <162.6){$scoreEi = $d;} elseif($ei >= 162.6 and $ei <169.4){$scoreEi = $e;} elseif($ei >=169.4 and $ei <176.1){$scoreEi = $f;} elseif($ei >= 176.1 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.3 :

        if($ei < 142.3){ $scoreEi = $a;} elseif($ei >=142.3 and $ei <149.1){$scoreEi = $b;} elseif($ei >=149.1 and $ei <155.9){$scoreEi = $c;} elseif($ei >=155.9 and $ei <162.6){$scoreEi = $d;} elseif($ei >= 162.6 and $ei <169.4){$scoreEi = $e;} elseif($ei >=169.4 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.4 :

        if($ei < 142.4){ $scoreEi = $a;} elseif($ei >=142.4 and $ei <149.2){$scoreEi = $b;} elseif($ei >=149.2 and $ei <155.9){$scoreEi = $c;} elseif($ei >=155.9 and $ei <162.7){$scoreEi = $d;} elseif($ei >= 162.7 and $ei <169.4){$scoreEi = $e;} elseif($ei >=169.4 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.5 :

        if($ei < 142.4){ $scoreEi = $a;} elseif($ei >=142.4 and $ei <149.2){$scoreEi = $b;} elseif($ei >=149.2 and $ei <155.9){$scoreEi = $c;} elseif($ei >=155.9 and $ei <162.7){$scoreEi = $d;} elseif($ei >= 162.7 and $ei <169.4){$scoreEi = $e;} elseif($ei >=169.4 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.6 :

        if($ei < 142.5){ $scoreEi = $a;} elseif($ei >=142.5 and $ei <149.2){$scoreEi = $b;} elseif($ei >=149.2 and $ei <156.0){$scoreEi = $c;} elseif($ei >=156.0 and $ei <162.7){$scoreEi = $d;} elseif($ei >= 162.7 and $ei <169.5){$scoreEi = $e;} elseif($ei >=169.5 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.7 :

        if($ei < 142.5){ $scoreEi = $a;} elseif($ei >=142.5 and $ei <149.3){$scoreEi = $b;} elseif($ei >=149.3 and $ei <156.0){$scoreEi = $c;} elseif($ei >=156.0 and $ei <162.7){$scoreEi = $d;} elseif($ei >= 162.7 and $ei <169.5){$scoreEi = $e;} elseif($ei >=169.5 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.8 :

        if($ei < 142.6){ $scoreEi = $a;} elseif($ei >=142.6 and $ei <149.3){$scoreEi = $b;} elseif($ei >=149.3 and $ei <156.0){$scoreEi = $c;} elseif($ei >=156.0 and $ei <162.8){$scoreEi = $d;} elseif($ei >= 162.8 and $ei <169.5){$scoreEi = $e;} elseif($ei >=169.5 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.9 :

        if($ei < 142.6){ $scoreEi = $a;} elseif($ei >=142.6 and $ei <149.4){$scoreEi = $b;} elseif($ei >=149.4 and $ei <156.1){$scoreEi = $c;} elseif($ei >=156.1 and $ei <162.8){$scoreEi = $d;} elseif($ei >= 162.8 and $ei <169.5){$scoreEi = $e;} elseif($ei >=169.5 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.10:

        if($ei < 142.7){ $scoreEi = $a;} elseif($ei >=142.7 and $ei <149.4){$scoreEi = $b;} elseif($ei >=149.4 and $ei <156.1){$scoreEi = $c;} elseif($ei >=156.1 and $ei <162.8){$scoreEi = $d;} elseif($ei >= 162.8 and $ei <169.5){$scoreEi = $e;} elseif($ei >=169.5 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 16.11:

        if($ei < 142.7){ $scoreEi = $a;} elseif($ei >=142.7 and $ei <149.4){$scoreEi = $b;} elseif($ei >=149.4 and $ei <156.1){$scoreEi = $c;} elseif($ei >=156.1 and $ei <162.8){$scoreEi = $d;} elseif($ei >= 162.8 and $ei <169.5){$scoreEi = $e;} elseif($ei >=169.5 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.0 :

        if($ei < 142.8){ $scoreEi = $a;} elseif($ei >=142.8 and $ei <149.5){$scoreEi = $b;} elseif($ei >=149.5 and $ei <156.2){$scoreEi = $c;} elseif($ei >=156.2 and $ei <162.9){$scoreEi = $d;} elseif($ei >= 162.9 and $ei <169.5){$scoreEi = $e;} elseif($ei >=169.5 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.01:

        if($ei < 142.8){ $scoreEi = $a;} elseif($ei >=142.8 and $ei <149.5){$scoreEi = $b;} elseif($ei >=149.5 and $ei <156.2){$scoreEi = $c;} elseif($ei >=156.2 and $ei <162.9){$scoreEi = $d;} elseif($ei >= 162.9 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.2 :

        if($ei < 142.9){ $scoreEi = $a;} elseif($ei >=142.9 and $ei <149.5){$scoreEi = $b;} elseif($ei >=149.5 and $ei <156.2){$scoreEi = $c;} elseif($ei >=156.2 and $ei <162.9){$scoreEi = $d;} elseif($ei >= 162.9 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.3 :

        if($ei < 142.9){ $scoreEi = $a;} elseif($ei >=142.9 and $ei <149.6){$scoreEi = $b;} elseif($ei >=149.6 and $ei <156.2){$scoreEi = $c;} elseif($ei >=156.2 and $ei <162.9){$scoreEi = $d;} elseif($ei >= 162.9 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.4 :

        if($ei < 142.9){ $scoreEi = $a;} elseif($ei >=142.9 and $ei <149.6){$scoreEi = $b;} elseif($ei >=149.6 and $ei <156.3){$scoreEi = $c;} elseif($ei >=156.3 and $ei <162.9){$scoreEi = $d;} elseif($ei >= 162.9 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.5 :

        if($ei < 143.0){ $scoreEi = $a;} elseif($ei >=143.0 and $ei <149.6){$scoreEi = $b;} elseif($ei >=149.6 and $ei <156.3){$scoreEi = $c;} elseif($ei >=156.3 and $ei <162.9){$scoreEi = $d;} elseif($ei >= 162.9 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.6 :

        if($ei < 143.0){ $scoreEi = $a;} elseif($ei >=143.0 and $ei <149.7){$scoreEi = $b;} elseif($ei >=149.7 and $ei <156.3){$scoreEi = $c;} elseif($ei >=156.3 and $ei <163.0){$scoreEi = $d;} elseif($ei >= 163.0 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.7 :

        if($ei < 143.1){ $scoreEi = $a;} elseif($ei >=143.1 and $ei <149.7){$scoreEi = $b;} elseif($ei >=149.7 and $ei <156.3){$scoreEi = $c;} elseif($ei >=156.3 and $ei <163.0){$scoreEi = $d;} elseif($ei >= 163.0 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.8 :

        if($ei < 143.1){ $scoreEi = $a;} elseif($ei >=143.1 and $ei <149.7){$scoreEi = $b;} elseif($ei >=149.7 and $ei <156.4){$scoreEi = $c;} elseif($ei >=156.4 and $ei <163.0){$scoreEi = $d;} elseif($ei >= 163.0 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.9 :

        if($ei < 143.1){ $scoreEi = $a;} elseif($ei >=143.1 and $ei <149.8){$scoreEi = $b;} elseif($ei >=149.8 and $ei <156.4){$scoreEi = $c;} elseif($ei >=156.4 and $ei <163.0){$scoreEi = $d;} elseif($ei >= 163.0 and $ei <169.6){$scoreEi = $e;} elseif($ei >=169.6 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.10:

        if($ei < 143.2){ $scoreEi = $a;} elseif($ei >=143.2 and $ei <149.8){$scoreEi = $b;} elseif($ei >=149.8 and $ei <156.4){$scoreEi = $c;} elseif($ei >=156.4 and $ei <163.0){$scoreEi = $d;} elseif($ei >= 163.0 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 17.11:

        if($ei < 143.2){ $scoreEi = $a;} elseif($ei >=143.2 and $ei <149.8){$scoreEi = $b;} elseif($ei >=149.8 and $ei <156.4){$scoreEi = $c;} elseif($ei >=156.4 and $ei <163.0){$scoreEi = $d;} elseif($ei >= 163.0 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.0 :

        if($ei < 143.2){ $scoreEi = $a;} elseif($ei >=143.2 and $ei <149.8){$scoreEi = $b;} elseif($ei >=149.8 and $ei <156.5){$scoreEi = $c;} elseif($ei >=156.5 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.01:

        if($ei < 143.3){ $scoreEi = $a;} elseif($ei >=143.3 and $ei <149.9){$scoreEi = $b;} elseif($ei >=149.9 and $ei <156.5){$scoreEi = $c;} elseif($ei >=156.5 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.2 :

        if($ei < 143.3){ $scoreEi = $a;} elseif($ei >=143.3 and $ei <149.9){$scoreEi = $b;} elseif($ei >=149.9 and $ei <156.5){$scoreEi = $c;} elseif($ei >=156.5 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.3 :

        if($ei < 143.3){ $scoreEi = $a;} elseif($ei >=143.3 and $ei <149.9){$scoreEi = $b;} elseif($ei >=149.9 and $ei <156.5){$scoreEi = $c;} elseif($ei >=156.5 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.4 :

        if($ei < 143.4){ $scoreEi = $a;} elseif($ei >=143.4 and $ei <149.9){$scoreEi = $b;} elseif($ei >=149.9 and $ei <156.5){$scoreEi = $c;} elseif($ei >=156.5 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.5 :

        if($ei < 143.4){ $scoreEi = $a;} elseif($ei >=143.4 and $ei <150.0){$scoreEi = $b;} elseif($ei >=150.0 and $ei <156.5){$scoreEi = $c;} elseif($ei >=156.5 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.6 :

        if($ei < 143.4){ $scoreEi = $a;} elseif($ei >=143.4 and $ei <150.0){$scoreEi = $b;} elseif($ei >=150.0 and $ei <156.6){$scoreEi = $c;} elseif($ei >=156.6 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.9){$scoreEi = $g;} elseif($ei >= 182.9){$scoreEi = $h;} break;

        case 18.7 :

        if($ei < 143.4){ $scoreEi = $a;} elseif($ei >=143.4 and $ei <150.0){$scoreEi = $b;} elseif($ei >=150.0 and $ei <156.6){$scoreEi = $c;} elseif($ei >=156.6 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 18.8 :

        if($ei < 143.5){ $scoreEi = $a;} elseif($ei >=143.5 and $ei <150.0){$scoreEi = $b;} elseif($ei >=150.0 and $ei <156.6){$scoreEi = $c;} elseif($ei >=156.6 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 18.9 :

        if($ei < 143.5){ $scoreEi = $a;} elseif($ei >=143.5 and $ei <150.0){$scoreEi = $b;} elseif($ei >=150.0 and $ei <156.6){$scoreEi = $c;} elseif($ei >=156.6 and $ei <163.1){$scoreEi = $d;} elseif($ei >= 163.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 18.10:

        if($ei < 143.5){ $scoreEi = $a;} elseif($ei >=143.5 and $ei <150.0){$scoreEi = $b;} elseif($ei >=150.0 and $ei <156.6){$scoreEi = $c;} elseif($ei >=156.6 and $ei <163.2){$scoreEi = $d;} elseif($ei >= 163.2 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.3){$scoreEi = $f;} elseif($ei >= 176.3 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 18.11:

        if($ei < 143.5){ $scoreEi = $a;} elseif($ei >=143.5 and $ei <150.1){$scoreEi = $b;} elseif($ei >=150.1 and $ei <156.6){$scoreEi = $c;} elseif($ei >=156.6 and $ei <163.2){$scoreEi = $d;} elseif($ei >= 163.2 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;

        case 19.0 :

        if($ei < 143.5){ $scoreEi = $a;} elseif($ei >=143.5 and $ei <150.1){$scoreEi = $b;} elseif($ei >=150.1 and $ei <156.6){$scoreEi = $c;} elseif($ei >=156.6 and $ei <163.2){$scoreEi = $d;} elseif($ei >= 163.2 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <176.2){$scoreEi = $f;} elseif($ei >= 176.2 and $ei <182.8){$scoreEi = $g;} elseif($ei >= 182.8){$scoreEi = $h;} break;




    //default ----------------------------------------------
        default:
        $scoreEi = 'Erro na estatura por idade';
        //echo "Valor inválido";
        break;
      }

      if ($scoreEi == $a) {
        $classificacaoEi = $muitobaixo;
      }
      elseif($scoreEi == $b){
        $classificacaoEi = $baixa;
      }
      else{
        $classificacaoEi = $adequado;
      }

    }
    if ($sexo == 1) {

      switch ($anos) {
        case 10.0 :

        if($ei < 118.7){ $scoreEi = $a;} elseif($ei >=118.7 and $ei <125.0){$scoreEi = $b;} elseif($ei >=125.0 and $ei <131.4){$scoreEi = $c;} elseif($ei >=131.4 and $ei <137.8){$scoreEi = $d;} elseif($ei >= 137.8 and $ei <144.2){$scoreEi = $e;} elseif($ei >=144.2 and $ei <150.5){$scoreEi = $f;} elseif($ei >= 150.5 and $ei <156.9){$scoreEi = $g;} elseif($ei >= 156.9){$scoreEi = $h;} break;

        case 10.01:

        if($ei < 119.0){ $scoreEi = $a;} elseif($ei >=119.0 and $ei <125.4){$scoreEi = $b;} elseif($ei >=125.4 and $ei <131.8){$scoreEi = $c;} elseif($ei >=131.8 and $ei <138.2){$scoreEi = $d;} elseif($ei >= 138.2 and $ei <144.6){$scoreEi = $e;} elseif($ei >=144.6 and $ei <151.0){$scoreEi = $f;} elseif($ei >= 151.0 and $ei <157.4){$scoreEi = $g;} elseif($ei >= 157.4){$scoreEi = $h;} break;

        case 10.2 :

        if($ei < 119.3){ $scoreEi = $a;} elseif($ei >=119.3 and $ei <125.8){$scoreEi = $b;} elseif($ei >=125.8 and $ei <132.2){$scoreEi = $c;} elseif($ei >=132.2 and $ei <138.6){$scoreEi = $d;} elseif($ei >= 138.6 and $ei <145.1){$scoreEi = $e;} elseif($ei >=145.1 and $ei <151.5){$scoreEi = $f;} elseif($ei >= 151.5 and $ei <157.9){$scoreEi = $g;} elseif($ei >= 157.9){$scoreEi = $h;} break;

        case 10.3 :

        if($ei < 119.7){ $scoreEi = $a;} elseif($ei >=119.7 and $ei <126.2){$scoreEi = $b;} elseif($ei >=126.2 and $ei <132.6){$scoreEi = $c;} elseif($ei >=132.6 and $ei <139.1){$scoreEi = $d;} elseif($ei >= 139.1 and $ei <145.5){$scoreEi = $e;} elseif($ei >=145.5 and $ei <152.0){$scoreEi = $f;} elseif($ei >= 152.0 and $ei <158.5){$scoreEi = $g;} elseif($ei >= 158.5){$scoreEi = $h;} break;

        case 10.4 :

        if($ei < 120.0){ $scoreEi = $a;} elseif($ei >=120.0 and $ei <126.5){$scoreEi = $b;} elseif($ei >=126.5 and $ei <133.0){$scoreEi = $c;} elseif($ei >=133.0 and $ei <139.5){$scoreEi = $d;} elseif($ei >= 139.5 and $ei <146.0){$scoreEi = $e;} elseif($ei >=146.0 and $ei <152.5){$scoreEi = $f;} elseif($ei >= 152.5 and $ei <159.0){$scoreEi = $g;} elseif($ei >= 159.0){$scoreEi = $h;} break;

        case 10.5 :

        if($ei < 120.4){ $scoreEi = $a;} elseif($ei >=120.4 and $ei <126.9){$scoreEi = $b;} elseif($ei >=126.9 and $ei <133.4){$scoreEi = $c;} elseif($ei >=133.4 and $ei <140.0){$scoreEi = $d;} elseif($ei >= 140.0 and $ei <146.5){$scoreEi = $e;} elseif($ei >=146.5 and $ei <153.0){$scoreEi = $f;} elseif($ei >= 153.0 and $ei <159.5){$scoreEi = $g;} elseif($ei >= 159.5){$scoreEi = $h;} break;

        case 10.6 :

        if($ei < 120.7){ $scoreEi = $a;} elseif($ei >=120.7 and $ei <127.3){$scoreEi = $b;} elseif($ei >=127.3 and $ei <133.8){$scoreEi = $c;} elseif($ei >=133.8 and $ei <140.4){$scoreEi = $d;} elseif($ei >= 140.4 and $ei <146.9){$scoreEi = $e;} elseif($ei >=146.9 and $ei <153.5){$scoreEi = $f;} elseif($ei >= 153.5 and $ei <160.1){$scoreEi = $g;} elseif($ei >= 160.1){$scoreEi = $h;} break;

        case 10.7 :

        if($ei < 121.1){ $scoreEi = $a;} elseif($ei >=121.1 and $ei <127.7){$scoreEi = $b;} elseif($ei >=127.7 and $ei <134.3){$scoreEi = $c;} elseif($ei >=134.3 and $ei <140.8){$scoreEi = $d;} elseif($ei >= 140.8 and $ei <147.4){$scoreEi = $e;} elseif($ei >=147.4 and $ei <154.0){$scoreEi = $f;} elseif($ei >= 154.0 and $ei <160.6){$scoreEi = $g;} elseif($ei >= 160.6){$scoreEi = $h;} break;

        case 10.8 :

        if($ei < 121.4){ $scoreEi = $a;} elseif($ei >=121.4 and $ei <128.1){$scoreEi = $b;} elseif($ei >=128.1 and $ei <134.7){$scoreEi = $c;} elseif($ei >=134.7 and $ei <141.3){$scoreEi = $d;} elseif($ei >= 141.3 and $ei <147.9){$scoreEi = $e;} elseif($ei >=147.9 and $ei <154.5){$scoreEi = $f;} elseif($ei >= 154.5 and $ei <161.1){$scoreEi = $g;} elseif($ei >= 161.1){$scoreEi = $h;} break;

        case 10.9 :

        if($ei < 121.8){ $scoreEi = $a;} elseif($ei >=121.8 and $ei <128.5){$scoreEi = $b;} elseif($ei >=128.5 and $ei <135.1){$scoreEi = $c;} elseif($ei >=135.1 and $ei <141.7){$scoreEi = $d;} elseif($ei >= 141.7 and $ei <148.4){$scoreEi = $e;} elseif($ei >=148.4 and $ei <155.0){$scoreEi = $f;} elseif($ei >= 155.0 and $ei <161.7){$scoreEi = $g;} elseif($ei >= 161.7){$scoreEi = $h;} break;

        case 10.10:

        if($ei < 122.2){ $scoreEi = $a;} elseif($ei >=122.2 and $ei <128.8){$scoreEi = $b;} elseif($ei >=128.8 and $ei <135.5){$scoreEi = $c;} elseif($ei >=135.5 and $ei <142.2){$scoreEi = $d;} elseif($ei >= 142.2 and $ei <148.9){$scoreEi = $e;} elseif($ei >=148.9 and $ei <155.5){$scoreEi = $f;} elseif($ei >= 155.5 and $ei <162.2){$scoreEi = $g;} elseif($ei >= 162.2){$scoreEi = $h;} break;

        case 10.11:

        if($ei < 122.5){ $scoreEi = $a;} elseif($ei >=122.5 and $ei <129.2){$scoreEi = $b;} elseif($ei >=129.2 and $ei <135.9){$scoreEi = $c;} elseif($ei >=135.9 and $ei <142.7){$scoreEi = $d;} elseif($ei >= 142.7 and $ei <149.4){$scoreEi = $e;} elseif($ei >=149.4 and $ei <156.1){$scoreEi = $f;} elseif($ei >= 156.1 and $ei <162.8){$scoreEi = $g;} elseif($ei >= 162.8){$scoreEi = $h;} break;

        case 11.0 :

        if($ei < 122.9){ $scoreEi = $a;} elseif($ei >=122.9 and $ei <129.7){$scoreEi = $b;} elseif($ei >=129.7 and $ei <136.4){$scoreEi = $c;} elseif($ei >=136.4 and $ei <143.1){$scoreEi = $d;} elseif($ei >= 143.1 and $ei <149.8){$scoreEi = $e;} elseif($ei >=149.8 and $ei <156.6){$scoreEi = $f;} elseif($ei >= 156.6 and $ei <163.3){$scoreEi = $g;} elseif($ei >= 163.3){$scoreEi = $h;} break;

        case 11.01:

        if($ei < 123.3){ $scoreEi = $a;} elseif($ei >=123.3 and $ei <130.1){$scoreEi = $b;} elseif($ei >=130.1 and $ei <136.8){$scoreEi = $c;} elseif($ei >=136.8 and $ei <143.6){$scoreEi = $d;} elseif($ei >= 143.6 and $ei <150.3){$scoreEi = $e;} elseif($ei >=150.3 and $ei <157.1){$scoreEi = $f;} elseif($ei >= 157.1 and $ei <163.9){$scoreEi = $g;} elseif($ei >= 163.9){$scoreEi = $h;} break;

        case 11.2 :

        if($ei < 123.7){ $scoreEi = $a;} elseif($ei >=123.7 and $ei <130.5){$scoreEi = $b;} elseif($ei >=130.5 and $ei <137.3){$scoreEi = $c;} elseif($ei >=137.3 and $ei <144.1){$scoreEi = $d;} elseif($ei >= 144.1 and $ei <150.8){$scoreEi = $e;} elseif($ei >=150.8 and $ei <157.6){$scoreEi = $f;} elseif($ei >= 157.6 and $ei <164.4){$scoreEi = $g;} elseif($ei >= 164.4){$scoreEi = $h;} break;

        case 11.3 :

        if($ei < 124.1){ $scoreEi = $a;} elseif($ei >=124.1 and $ei <130.9){$scoreEi = $b;} elseif($ei >=130.9 and $ei <137.7){$scoreEi = $c;} elseif($ei >=137.7 and $ei <144.5){$scoreEi = $d;} elseif($ei >= 144.5 and $ei <151.3){$scoreEi = $e;} elseif($ei >=151.3 and $ei <158.2){$scoreEi = $f;} elseif($ei >= 158.2 and $ei <165.0){$scoreEi = $g;} elseif($ei >= 165.0){$scoreEi = $h;} break;

        case 11.4 :

        if($ei < 124.5){ $scoreEi = $a;} elseif($ei >=124.5 and $ei <131.3){$scoreEi = $b;} elseif($ei >=131.3 and $ei <138.2){$scoreEi = $c;} elseif($ei >=138.2 and $ei <145.0){$scoreEi = $d;} elseif($ei >= 145.0 and $ei <151.9){$scoreEi = $e;} elseif($ei >=151.9 and $ei <158.7){$scoreEi = $f;} elseif($ei >= 158.7 and $ei <165.6){$scoreEi = $g;} elseif($ei >= 165.6){$scoreEi = $h;} break;

        case 11.5 :

        if($ei < 124.9){ $scoreEi = $a;} elseif($ei >=124.9 and $ei <131.7){$scoreEi = $b;} elseif($ei >=131.7 and $ei <138.6){$scoreEi = $c;} elseif($ei >=138.6 and $ei <145.5){$scoreEi = $d;} elseif($ei >= 145.5 and $ei <152.4){$scoreEi = $e;} elseif($ei >=152.4 and $ei <159.3){$scoreEi = $f;} elseif($ei >= 159.3 and $ei <166.1){$scoreEi = $g;} elseif($ei >= 166.1){$scoreEi = $h;} break;

        case 11.6 :

        if($ei < 125.3){ $scoreEi = $a;} elseif($ei >=125.3 and $ei <132.2){$scoreEi = $b;} elseif($ei >=132.2 and $ei <139.1){$scoreEi = $c;} elseif($ei >=139.1 and $ei <146.0){$scoreEi = $d;} elseif($ei >= 146.0 and $ei <152.9){$scoreEi = $e;} elseif($ei >=152.9 and $ei <159.8){$scoreEi = $f;} elseif($ei >= 159.8 and $ei <166.7){$scoreEi = $g;} elseif($ei >= 166.7){$scoreEi = $h;} break;

        case 11.7 :

        if($ei < 125.7){ $scoreEi = $a;} elseif($ei >=125.7 and $ei <132.6){$scoreEi = $b;} elseif($ei >=132.6 and $ei <139.6){$scoreEi = $c;} elseif($ei >=139.6 and $ei <146.5){$scoreEi = $d;} elseif($ei >= 146.5 and $ei <153.4){$scoreEi = $e;} elseif($ei >=153.4 and $ei <160.4){$scoreEi = $f;} elseif($ei >= 160.4 and $ei <167.3){$scoreEi = $g;} elseif($ei >= 167.3){$scoreEi = $h;} break;

        case 11.8 :

        if($ei < 126.1){ $scoreEi = $a;} elseif($ei >=126.1 and $ei <133.1){$scoreEi = $b;} elseif($ei >=133.1 and $ei <140.0){$scoreEi = $c;} elseif($ei >=140.0 and $ei <147.0){$scoreEi = $d;} elseif($ei >= 147.0 and $ei <154.0){$scoreEi = $e;} elseif($ei >=154.0 and $ei <160.9){$scoreEi = $f;} elseif($ei >= 160.9 and $ei <167.9){$scoreEi = $g;} elseif($ei >= 167.9){$scoreEi = $h;} break;

        case 11.9 :

        if($ei < 126.5){ $scoreEi = $a;} elseif($ei >=126.5 and $ei <133.5){$scoreEi = $b;} elseif($ei >=133.5 and $ei <140.5){$scoreEi = $c;} elseif($ei >=140.5 and $ei <147.5){$scoreEi = $d;} elseif($ei >= 147.5 and $ei <154.5){$scoreEi = $e;} elseif($ei >=154.5 and $ei <161.5){$scoreEi = $f;} elseif($ei >= 161.5 and $ei <168.5){$scoreEi = $g;} elseif($ei >= 168.5){$scoreEi = $h;} break;

        case 11.10:

        if($ei < 126.9){ $scoreEi = $a;} elseif($ei >=126.9 and $ei <134.0){$scoreEi = $b;} elseif($ei >=134.0 and $ei <141.0){$scoreEi = $c;} elseif($ei >=141.0 and $ei <148.0){$scoreEi = $d;} elseif($ei >= 148.0 and $ei <155.0){$scoreEi = $e;} elseif($ei >=155.0 and $ei <162.1){$scoreEi = $f;} elseif($ei >= 162.1 and $ei <169.1){$scoreEi = $g;} elseif($ei >= 169.1){$scoreEi = $h;} break;

        case 11.11:

        if($ei < 127.4){ $scoreEi = $a;} elseif($ei >=127.4 and $ei <134.4){$scoreEi = $b;} elseif($ei >=134.4 and $ei <141.5){$scoreEi = $c;} elseif($ei >=141.5 and $ei <148.5){$scoreEi = $d;} elseif($ei >= 148.5 and $ei <155.6){$scoreEi = $e;} elseif($ei >=155.6 and $ei <162.7){$scoreEi = $f;} elseif($ei >= 162.7 and $ei <169.7){$scoreEi = $g;} elseif($ei >= 169.7){$scoreEi = $h;} break;

        case 12.0 :

        if($ei < 127.8){ $scoreEi = $a;} elseif($ei >=127.8 and $ei <134.9){$scoreEi = $b;} elseif($ei >=134.9 and $ei <142.0){$scoreEi = $c;} elseif($ei >=142.0 and $ei <149.1){$scoreEi = $d;} elseif($ei >= 149.1 and $ei <156.2){$scoreEi = $e;} elseif($ei >=156.2 and $ei <163.3){$scoreEi = $f;} elseif($ei >= 163.3 and $ei <170.3){$scoreEi = $g;} elseif($ei >= 170.3){$scoreEi = $h;} break;

        case 12.01:

        if($ei < 128.3){ $scoreEi = $a;} elseif($ei >=128.3 and $ei <135.4){$scoreEi = $b;} elseif($ei >=135.4 and $ei <142.5){$scoreEi = $c;} elseif($ei >=142.5 and $ei <149.6){$scoreEi = $d;} elseif($ei >= 149.6 and $ei <156.7){$scoreEi = $e;} elseif($ei >=156.7 and $ei <163.9){$scoreEi = $f;} elseif($ei >= 163.9 and $ei <171.0){$scoreEi = $g;} elseif($ei >= 171.0){$scoreEi = $h;} break;

        case 12.2 :

        if($ei < 128.7){ $scoreEi = $a;} elseif($ei >=128.7 and $ei <135.9){$scoreEi = $b;} elseif($ei >=135.9 and $ei <143.0){$scoreEi = $c;} elseif($ei >=143.0 and $ei <150.2){$scoreEi = $d;} elseif($ei >= 150.2 and $ei <157.3){$scoreEi = $e;} elseif($ei >=157.3 and $ei <164.5){$scoreEi = $f;} elseif($ei >= 164.5 and $ei <171.6){$scoreEi = $g;} elseif($ei >= 171.6){$scoreEi = $h;} break;

        case 12.3 :

        if($ei < 129.2){ $scoreEi = $a;} elseif($ei >=129.2 and $ei <136.4){$scoreEi = $b;} elseif($ei >=136.4 and $ei <143.6){$scoreEi = $c;} elseif($ei >=143.6 and $ei <150.7){$scoreEi = $d;} elseif($ei >= 150.7 and $ei <157.9){$scoreEi = $e;} elseif($ei >=157.9 and $ei <165.1){$scoreEi = $f;} elseif($ei >= 165.1 and $ei <172.2){$scoreEi = $g;} elseif($ei >= 172.2){$scoreEi = $h;} break;

        case 12.4 :

        if($ei < 129.7){ $scoreEi = $a;} elseif($ei >=129.7 and $ei <136.9){$scoreEi = $b;} elseif($ei >=136.9 and $ei <144.1){$scoreEi = $c;} elseif($ei >=144.1 and $ei <151.3){$scoreEi = $d;} elseif($ei >= 151.3 and $ei <158.5){$scoreEi = $e;} elseif($ei >=158.5 and $ei <165.7){$scoreEi = $f;} elseif($ei >= 165.7 and $ei <172.9){$scoreEi = $g;} elseif($ei >= 172.9){$scoreEi = $h;} break;

        case 12.5 :

        if($ei < 130.2){ $scoreEi = $a;} elseif($ei >=130.2 and $ei <137.4){$scoreEi = $b;} elseif($ei >=137.4 and $ei <144.6){$scoreEi = $c;} elseif($ei >=144.6 and $ei <151.9){$scoreEi = $d;} elseif($ei >= 151.9 and $ei <159.1){$scoreEi = $e;} elseif($ei >=159.1 and $ei <166.3){$scoreEi = $f;} elseif($ei >= 166.3 and $ei <173.6){$scoreEi = $g;} elseif($ei >= 173.6){$scoreEi = $h;} break;

        case 12.6 :

        if($ei < 130.7){ $scoreEi = $a;} elseif($ei >=130.7 and $ei <137.9){$scoreEi = $b;} elseif($ei >=137.9 and $ei <145.2){$scoreEi = $c;} elseif($ei >=145.2 and $ei <152.4){$scoreEi = $d;} elseif($ei >= 152.4 and $ei <159.7){$scoreEi = $e;} elseif($ei >=159.7 and $ei <167.0){$scoreEi = $f;} elseif($ei >= 167.0 and $ei <174.2){$scoreEi = $g;} elseif($ei >= 174.2){$scoreEi = $h;} break;

        case 12.7 :

        if($ei < 131.2){ $scoreEi = $a;} elseif($ei >=131.2 and $ei <138.5){$scoreEi = $b;} elseif($ei >=138.5 and $ei <145.7){$scoreEi = $c;} elseif($ei >=145.7 and $ei <153.0){$scoreEi = $d;} elseif($ei >= 153.0 and $ei <160.3){$scoreEi = $e;} elseif($ei >=160.3 and $ei <167.6){$scoreEi = $f;} elseif($ei >= 167.6 and $ei <174.9){$scoreEi = $g;} elseif($ei >= 174.9){$scoreEi = $h;} break;

        case 12.8 :

        if($ei < 131.7){ $scoreEi = $a;} elseif($ei >=131.7 and $ei <139.0){$scoreEi = $b;} elseif($ei >=139.0 and $ei <146.3){$scoreEi = $c;} elseif($ei >=146.3 and $ei <153.6){$scoreEi = $d;} elseif($ei >= 153.6 and $ei <160.9){$scoreEi = $e;} elseif($ei >=160.9 and $ei <168.3){$scoreEi = $f;} elseif($ei >= 168.3 and $ei <175.6){$scoreEi = $g;} elseif($ei >= 175.6){$scoreEi = $h;} break;

        case 12.9 :

        if($ei < 132.2){ $scoreEi = $a;} elseif($ei >=132.2 and $ei <139.5){$scoreEi = $b;} elseif($ei >=139.5 and $ei <146.9){$scoreEi = $c;} elseif($ei >=146.9 and $ei <154.2){$scoreEi = $d;} elseif($ei >= 154.2 and $ei <161.6){$scoreEi = $e;} elseif($ei >=161.6 and $ei <168.9){$scoreEi = $f;} elseif($ei >= 168.9 and $ei <176.3){$scoreEi = $g;} elseif($ei >= 176.3){$scoreEi = $h;} break;

        case 12.10:

        if($ei < 132.7){ $scoreEi = $a;} elseif($ei >=132.7 and $ei <140.1){$scoreEi = $b;} elseif($ei >=140.1 and $ei <147.5){$scoreEi = $c;} elseif($ei >=147.5 and $ei <154.8){$scoreEi = $d;} elseif($ei >= 154.8 and $ei <162.2){$scoreEi = $e;} elseif($ei >=162.2 and $ei <169.6){$scoreEi = $f;} elseif($ei >= 169.6 and $ei <176.9){$scoreEi = $g;} elseif($ei >= 176.9){$scoreEi = $h;} break;

        case 12.11:

        if($ei < 133.2){ $scoreEi = $a;} elseif($ei >=133.2 and $ei <140.6){$scoreEi = $b;} elseif($ei >=140.6 and $ei <148.0){$scoreEi = $c;} elseif($ei >=148.0 and $ei <155.4){$scoreEi = $d;} elseif($ei >= 155.4 and $ei <162.8){$scoreEi = $e;} elseif($ei >=162.8 and $ei <170.2){$scoreEi = $f;} elseif($ei >= 170.2 and $ei <177.6){$scoreEi = $g;} elseif($ei >= 177.6){$scoreEi = $h;} break;

        case 13.0 :

        if($ei < 133.8){ $scoreEi = $a;} elseif($ei >=133.8 and $ei <141.2){$scoreEi = $b;} elseif($ei >=141.2 and $ei <148.6){$scoreEi = $c;} elseif($ei >=148.6 and $ei <156.0){$scoreEi = $d;} elseif($ei >= 156.0 and $ei <163.5){$scoreEi = $e;} elseif($ei >=163.5 and $ei <170.9){$scoreEi = $f;} elseif($ei >= 170.9 and $ei <178.3){$scoreEi = $g;} elseif($ei >= 178.3){$scoreEi = $h;} break;

        case 13.01:

        if($ei < 134.3){ $scoreEi = $a;} elseif($ei >=134.3 and $ei <141.7){$scoreEi = $b;} elseif($ei >=141.7 and $ei <149.2){$scoreEi = $c;} elseif($ei >=149.2 and $ei <156.7){$scoreEi = $d;} elseif($ei >= 156.7 and $ei <164.1){$scoreEi = $e;} elseif($ei >=164.1 and $ei <171.6){$scoreEi = $f;} elseif($ei >= 171.6 and $ei <179.0){$scoreEi = $g;} elseif($ei >= 179.0){$scoreEi = $h;} break;

        case 13.2 :

        if($ei < 134.8){ $scoreEi = $a;} elseif($ei >=134.8 and $ei <142.3){$scoreEi = $b;} elseif($ei >=142.3 and $ei <149.8){$scoreEi = $c;} elseif($ei >=149.8 and $ei <157.3){$scoreEi = $d;} elseif($ei >= 157.3 and $ei <164.7){$scoreEi = $e;} elseif($ei >=164.7 and $ei <172.2){$scoreEi = $f;} elseif($ei >= 172.2 and $ei <179.7){$scoreEi = $g;} elseif($ei >= 179.7){$scoreEi = $h;} break;

        case 13.3 :

        if($ei < 135.4){ $scoreEi = $a;} elseif($ei >=135.4 and $ei <142.9){$scoreEi = $b;} elseif($ei >=142.9 and $ei <150.4){$scoreEi = $c;} elseif($ei >=150.4 and $ei <157.9){$scoreEi = $d;} elseif($ei >= 157.9 and $ei <165.4){$scoreEi = $e;} elseif($ei >=165.4 and $ei <172.9){$scoreEi = $f;} elseif($ei >= 172.9 and $ei <180.4){$scoreEi = $g;} elseif($ei >= 180.4){$scoreEi = $h;} break;

        case 13.4 :

        if($ei < 135.9){ $scoreEi = $a;} elseif($ei >=135.9 and $ei <143.4){$scoreEi = $b;} elseif($ei >=143.4 and $ei <151.0){$scoreEi = $c;} elseif($ei >=151.0 and $ei <158.5){$scoreEi = $d;} elseif($ei >= 158.5 and $ei <166.0){$scoreEi = $e;} elseif($ei >=166.0 and $ei <173.5){$scoreEi = $f;} elseif($ei >= 173.5 and $ei <181.1){$scoreEi = $g;} elseif($ei >= 181.1){$scoreEi = $h;} break;

        case 13.5 :

        if($ei < 136.4){ $scoreEi = $a;} elseif($ei >=136.4 and $ei <144.0){$scoreEi = $b;} elseif($ei >=144.0 and $ei <151.5){$scoreEi = $c;} elseif($ei >=151.5 and $ei <159.1){$scoreEi = $d;} elseif($ei >= 159.1 and $ei <166.6){$scoreEi = $e;} elseif($ei >=166.6 and $ei <174.2){$scoreEi = $f;} elseif($ei >= 174.2 and $ei <181.8){$scoreEi = $g;} elseif($ei >= 181.8){$scoreEi = $h;} break;

        case 13.6 :

        if($ei < 137.0){ $scoreEi = $a;} elseif($ei >=137.0 and $ei <144.5){$scoreEi = $b;} elseif($ei >=144.5 and $ei <152.1){$scoreEi = $c;} elseif($ei >=152.1 and $ei <159.7){$scoreEi = $d;} elseif($ei >= 159.7 and $ei <167.3){$scoreEi = $e;} elseif($ei >=167.3 and $ei <174.8){$scoreEi = $f;} elseif($ei >= 174.8 and $ei <182.4){$scoreEi = $g;} elseif($ei >= 182.4){$scoreEi = $h;} break;

        case 13.7 :

        if($ei < 137.5){ $scoreEi = $a;} elseif($ei >=137.5 and $ei <145.1){$scoreEi = $b;} elseif($ei >=145.1 and $ei <152.7){$scoreEi = $c;} elseif($ei >=152.7 and $ei <160.3){$scoreEi = $d;} elseif($ei >= 160.3 and $ei <167.9){$scoreEi = $e;} elseif($ei >=167.9 and $ei <175.5){$scoreEi = $f;} elseif($ei >= 175.5 and $ei <183.1){$scoreEi = $g;} elseif($ei >= 183.1){$scoreEi = $h;} break;

        case 13.8 :

        if($ei < 138.0){ $scoreEi = $a;} elseif($ei >=138.0 and $ei <145.7){$scoreEi = $b;} elseif($ei >=145.7 and $ei <153.3){$scoreEi = $c;} elseif($ei >=153.3 and $ei <160.9){$scoreEi = $d;} elseif($ei >= 160.9 and $ei <168.5){$scoreEi = $e;} elseif($ei >=168.5 and $ei <176.1){$scoreEi = $f;} elseif($ei >= 176.1 and $ei <183.7){$scoreEi = $g;} elseif($ei >= 183.7){$scoreEi = $h;} break;

        case 13.9 :

        if($ei < 138.6){ $scoreEi = $a;} elseif($ei >=138.6 and $ei <146.2){$scoreEi = $b;} elseif($ei >=146.2 and $ei <153.8){$scoreEi = $c;} elseif($ei >=153.8 and $ei <161.5){$scoreEi = $d;} elseif($ei >= 161.5 and $ei <169.1){$scoreEi = $e;} elseif($ei >=169.1 and $ei <176.7){$scoreEi = $f;} elseif($ei >= 176.7 and $ei <184.4){$scoreEi = $g;} elseif($ei >= 184.4){$scoreEi = $h;} break;

        case 13.10:

        if($ei < 139.1){ $scoreEi = $a;} elseif($ei >=139.1 and $ei <146.7){$scoreEi = $b;} elseif($ei >=146.7 and $ei <154.4){$scoreEi = $c;} elseif($ei >=154.4 and $ei <162.1){$scoreEi = $d;} elseif($ei >= 162.1 and $ei <169.7){$scoreEi = $e;} elseif($ei >=169.7 and $ei <177.4){$scoreEi = $f;} elseif($ei >= 177.4 and $ei <185.0){$scoreEi = $g;} elseif($ei >= 185.0){$scoreEi = $h;} break;

        case 13.11:

        if($ei < 139.6){ $scoreEi = $a;} elseif($ei >=139.6 and $ei <147.3){$scoreEi = $b;} elseif($ei >=147.3 and $ei <154.9){$scoreEi = $c;} elseif($ei >=154.9 and $ei <162.6){$scoreEi = $d;} elseif($ei >= 162.6 and $ei <170.3){$scoreEi = $e;} elseif($ei >=170.3 and $ei <178.0){$scoreEi = $f;} elseif($ei >= 178.0 and $ei <185.6){$scoreEi = $g;} elseif($ei >= 185.6){$scoreEi = $h;} break;

        case 14.0 :

        if($ei < 140.1){ $scoreEi = $a;} elseif($ei >=140.1 and $ei <147.8){$scoreEi = $b;} elseif($ei >=147.8 and $ei <155.5){$scoreEi = $c;} elseif($ei >=155.5 and $ei <163.2){$scoreEi = $d;} elseif($ei >= 163.2 and $ei <170.9){$scoreEi = $e;} elseif($ei >=170.9 and $ei <178.6){$scoreEi = $f;} elseif($ei >= 178.6 and $ei <186.3){$scoreEi = $g;} elseif($ei >= 186.3){$scoreEi = $h;} break;

        case 14.01:

        if($ei < 140.6){ $scoreEi = $a;} elseif($ei >=140.6 and $ei <148.3){$scoreEi = $b;} elseif($ei >=148.3 and $ei <156.0){$scoreEi = $c;} elseif($ei >=156.0 and $ei <163.7){$scoreEi = $d;} elseif($ei >= 163.7 and $ei <171.4){$scoreEi = $e;} elseif($ei >=171.4 and $ei <179.1){$scoreEi = $f;} elseif($ei >= 179.1 and $ei <186.9){$scoreEi = $g;} elseif($ei >= 186.9){$scoreEi = $h;} break;

        case 14.2 :

        if($ei < 141.1){ $scoreEi = $a;} elseif($ei >=141.1 and $ei <148.8){$scoreEi = $b;} elseif($ei >=148.8 and $ei <156.5){$scoreEi = $c;} elseif($ei >=156.5 and $ei <164.3){$scoreEi = $d;} elseif($ei >= 164.3 and $ei <172.0){$scoreEi = $e;} elseif($ei >=172.0 and $ei <179.7){$scoreEi = $f;} elseif($ei >= 179.7 and $ei <187.4){$scoreEi = $g;} elseif($ei >= 187.4){$scoreEi = $h;} break;

        case 14.3 :

        if($ei < 141.6){ $scoreEi = $a;} elseif($ei >=141.6 and $ei <149.3){$scoreEi = $b;} elseif($ei >=149.3 and $ei <157.1){$scoreEi = $c;} elseif($ei >=157.1 and $ei <164.8){$scoreEi = $d;} elseif($ei >= 164.8 and $ei <172.5){$scoreEi = $e;} elseif($ei >=172.5 and $ei <180.3){$scoreEi = $f;} elseif($ei >= 180.3 and $ei <188.0){$scoreEi = $g;} elseif($ei >= 188.0){$scoreEi = $h;} break;

        case 14.4 :

        if($ei < 142.1){ $scoreEi = $a;} elseif($ei >=142.1 and $ei <149.8){$scoreEi = $b;} elseif($ei >=149.8 and $ei <157.6){$scoreEi = $c;} elseif($ei >=157.6 and $ei <165.3){$scoreEi = $d;} elseif($ei >= 165.3 and $ei <173.1){$scoreEi = $e;} elseif($ei >=173.1 and $ei <180.8){$scoreEi = $f;} elseif($ei >= 180.8 and $ei <188.6){$scoreEi = $g;} elseif($ei >= 188.6){$scoreEi = $h;} break;

        case 14.5 :

        if($ei < 142.5){ $scoreEi = $a;} elseif($ei >=142.5 and $ei <150.3){$scoreEi = $b;} elseif($ei >=150.3 and $ei <158.1){$scoreEi = $c;} elseif($ei >=158.1 and $ei <165.8){$scoreEi = $d;} elseif($ei >= 165.8 and $ei <173.6){$scoreEi = $e;} elseif($ei >=173.6 and $ei <181.3){$scoreEi = $f;} elseif($ei >= 181.3 and $ei <189.1){$scoreEi = $g;} elseif($ei >= 189.1){$scoreEi = $h;} break;

        case 14.6 :

        if($ei < 143.0){ $scoreEi = $a;} elseif($ei >=143.0 and $ei <150.8){$scoreEi = $b;} elseif($ei >=150.8 and $ei <158.5){$scoreEi = $c;} elseif($ei >=158.5 and $ei <166.3){$scoreEi = $d;} elseif($ei >= 166.3 and $ei <174.1){$scoreEi = $e;} elseif($ei >=174.1 and $ei <181.8){$scoreEi = $f;} elseif($ei >= 181.8 and $ei <189.6){$scoreEi = $g;} elseif($ei >= 189.6){$scoreEi = $h;} break;

        case 14.7 :

        if($ei < 143.4){ $scoreEi = $a;} elseif($ei >=143.4 and $ei <151.2){$scoreEi = $b;} elseif($ei >=151.2 and $ei <159.0){$scoreEi = $c;} elseif($ei >=159.0 and $ei <166.8){$scoreEi = $d;} elseif($ei >= 166.8 and $ei <174.6){$scoreEi = $e;} elseif($ei >=174.6 and $ei <182.3){$scoreEi = $f;} elseif($ei >= 182.3 and $ei <190.1){$scoreEi = $g;} elseif($ei >= 190.1){$scoreEi = $h;} break;

        case 14.8 :

        if($ei < 143.9){ $scoreEi = $a;} elseif($ei >=143.9 and $ei <151.7){$scoreEi = $b;} elseif($ei >=151.7 and $ei <159.5){$scoreEi = $c;} elseif($ei >=159.5 and $ei <167.2){$scoreEi = $d;} elseif($ei >= 167.2 and $ei <175.0){$scoreEi = $e;} elseif($ei >=175.0 and $ei <182.8){$scoreEi = $f;} elseif($ei >= 182.8 and $ei <190.6){$scoreEi = $g;} elseif($ei >= 190.6){$scoreEi = $h;} break;

        case 14.9 :

        if($ei < 144.3){ $scoreEi = $a;} elseif($ei >=144.3 and $ei <152.1){$scoreEi = $b;} elseif($ei >=152.1 and $ei <159.9){$scoreEi = $c;} elseif($ei >=159.9 and $ei <167.7){$scoreEi = $d;} elseif($ei >= 167.7 and $ei <175.5){$scoreEi = $e;} elseif($ei >=175.5 and $ei <183.3){$scoreEi = $f;} elseif($ei >= 183.3 and $ei <191.1){$scoreEi = $g;} elseif($ei >= 191.1){$scoreEi = $h;} break;

        case 14.10:

        if($ei < 144.7){ $scoreEi = $a;} elseif($ei >=144.7 and $ei <152.5){$scoreEi = $b;} elseif($ei >=152.5 and $ei <160.3){$scoreEi = $c;} elseif($ei >=160.3 and $ei <168.1){$scoreEi = $d;} elseif($ei >= 168.1 and $ei <175.9){$scoreEi = $e;} elseif($ei >=175.9 and $ei <183.7){$scoreEi = $f;} elseif($ei >= 183.7 and $ei <191.5){$scoreEi = $g;} elseif($ei >= 191.5){$scoreEi = $h;} break;

        case 14.11:

        if($ei < 145.1){ $scoreEi = $a;} elseif($ei >=145.1 and $ei <152.9){$scoreEi = $b;} elseif($ei >=152.9 and $ei <160.7){$scoreEi = $c;} elseif($ei >=160.7 and $ei <168.5){$scoreEi = $d;} elseif($ei >= 168.5 and $ei <176.3){$scoreEi = $e;} elseif($ei >=176.3 and $ei <184.1){$scoreEi = $f;} elseif($ei >= 184.1 and $ei <191.9){$scoreEi = $g;} elseif($ei >= 191.9){$scoreEi = $h;} break;

        case 15.0 :

        if($ei < 145.5){ $scoreEi = $a;} elseif($ei >=145.5 and $ei <153.4){$scoreEi = $b;} elseif($ei >=153.4 and $ei <161.2){$scoreEi = $c;} elseif($ei >=161.2 and $ei <169.0){$scoreEi = $d;} elseif($ei >= 169.0 and $ei <176.8){$scoreEi = $e;} elseif($ei >=176.8 and $ei <184.6){$scoreEi = $f;} elseif($ei >= 184.6 and $ei <192.4){$scoreEi = $g;} elseif($ei >= 192.4){$scoreEi = $h;} break;

        case 15.01:

        if($ei < 145.9){ $scoreEi = $a;} elseif($ei >=145.9 and $ei <153.7){$scoreEi = $b;} elseif($ei >=153.7 and $ei <161.5){$scoreEi = $c;} elseif($ei >=161.5 and $ei <169.4){$scoreEi = $d;} elseif($ei >= 169.4 and $ei <177.2){$scoreEi = $e;} elseif($ei >=177.2 and $ei <185.0){$scoreEi = $f;} elseif($ei >= 185.0 and $ei <192.8){$scoreEi = $g;} elseif($ei >= 192.8){$scoreEi = $h;} break;

        case 15.2 :

        if($ei < 146.3){ $scoreEi = $a;} elseif($ei >=146.3 and $ei <154.1){$scoreEi = $b;} elseif($ei >=154.1 and $ei <161.9){$scoreEi = $c;} elseif($ei >=161.9 and $ei <169.7){$scoreEi = $d;} elseif($ei >= 169.7 and $ei <177.5){$scoreEi = $e;} elseif($ei >=177.5 and $ei <185.4){$scoreEi = $f;} elseif($ei >= 185.4 and $ei <193.2){$scoreEi = $g;} elseif($ei >= 193.2){$scoreEi = $h;} break;

        case 15.3 :

        if($ei < 146.7){ $scoreEi = $a;} elseif($ei >=146.7 and $ei <154.5){$scoreEi = $b;} elseif($ei >=154.5 and $ei <162.3){$scoreEi = $c;} elseif($ei >=162.3 and $ei <170.1){$scoreEi = $d;} elseif($ei >= 170.1 and $ei <177.9){$scoreEi = $e;} elseif($ei >=177.9 and $ei <185.7){$scoreEi = $f;} elseif($ei >= 185.7 and $ei <193.5){$scoreEi = $g;} elseif($ei >= 193.5){$scoreEi = $h;} break;

        case 15.4 :

        if($ei < 147.1){ $scoreEi = $a;} elseif($ei >=147.1 and $ei <154.9){$scoreEi = $b;} elseif($ei >=154.9 and $ei <162.7){$scoreEi = $c;} elseif($ei >=162.7 and $ei <170.5){$scoreEi = $d;} elseif($ei >= 170.5 and $ei <178.3){$scoreEi = $e;} elseif($ei >=178.3 and $ei <186.1){$scoreEi = $f;} elseif($ei >= 186.1 and $ei <193.9){$scoreEi = $g;} elseif($ei >= 193.9){$scoreEi = $h;} break;

        case 15.5 :

        if($ei < 147.4){ $scoreEi = $a;} elseif($ei >=147.4 and $ei <155.2){$scoreEi = $b;} elseif($ei >=155.2 and $ei <163.0){$scoreEi = $c;} elseif($ei >=163.0 and $ei <170.8){$scoreEi = $d;} elseif($ei >= 170.8 and $ei <178.6){$scoreEi = $e;} elseif($ei >=178.6 and $ei <186.4){$scoreEi = $f;} elseif($ei >= 186.4 and $ei <194.2){$scoreEi = $g;} elseif($ei >= 194.2){$scoreEi = $h;} break;

        case 15.6 :

        if($ei < 147.7){ $scoreEi = $a;} elseif($ei >=147.7 and $ei <155.5){$scoreEi = $b;} elseif($ei >=155.5 and $ei <163.3){$scoreEi = $c;} elseif($ei >=163.3 and $ei <171.1){$scoreEi = $d;} elseif($ei >= 171.1 and $ei <178.9){$scoreEi = $e;} elseif($ei >=178.9 and $ei <186.8){$scoreEi = $f;} elseif($ei >= 186.8 and $ei <194.6){$scoreEi = $g;} elseif($ei >= 194.6){$scoreEi = $h;} break;

        case 15.7 :

        if($ei < 148.1){ $scoreEi = $a;} elseif($ei >=148.1 and $ei <155.9){$scoreEi = $b;} elseif($ei >=155.9 and $ei <163.7){$scoreEi = $c;} elseif($ei >=163.7 and $ei <171.5){$scoreEi = $d;} elseif($ei >= 171.5 and $ei <179.3){$scoreEi = $e;} elseif($ei >=179.3 and $ei <187.1){$scoreEi = $f;} elseif($ei >= 187.1 and $ei <194.9){$scoreEi = $g;} elseif($ei >= 194.9){$scoreEi = $h;} break;

        case 15.8 :

        if($ei < 148.4){ $scoreEi = $a;} elseif($ei >=148.4 and $ei <156.2){$scoreEi = $b;} elseif($ei >=156.2 and $ei <164.0){$scoreEi = $c;} elseif($ei >=164.0 and $ei <171.8){$scoreEi = $d;} elseif($ei >= 171.8 and $ei <179.6){$scoreEi = $e;} elseif($ei >=179.6 and $ei <187.4){$scoreEi = $f;} elseif($ei >= 187.4 and $ei <195.2){$scoreEi = $g;} elseif($ei >= 195.2){$scoreEi = $h;} break;

        case 15.9 :

        if($ei < 148.7){ $scoreEi = $a;} elseif($ei >=148.7 and $ei <156.5){$scoreEi = $b;} elseif($ei >=156.5 and $ei <164.3){$scoreEi = $c;} elseif($ei >=164.3 and $ei <172.1){$scoreEi = $d;} elseif($ei >= 172.1 and $ei <179.9){$scoreEi = $e;} elseif($ei >=179.9 and $ei <187.7){$scoreEi = $f;} elseif($ei >= 187.7 and $ei <195.4){$scoreEi = $g;} elseif($ei >= 195.4){$scoreEi = $h;} break;

        case 15.10:

        if($ei < 149.0){ $scoreEi = $a;} elseif($ei >=149.0 and $ei <156.8){$scoreEi = $b;} elseif($ei >=156.8 and $ei <164.6){$scoreEi = $c;} elseif($ei >=164.6 and $ei <172.4){$scoreEi = $d;} elseif($ei >= 172.4 and $ei <180.1){$scoreEi = $e;} elseif($ei >=180.1 and $ei <187.9){$scoreEi = $f;} elseif($ei >= 187.9 and $ei <195.7){$scoreEi = $g;} elseif($ei >= 195.7){$scoreEi = $h;} break;

        case 15.11:

        if($ei < 149.3){ $scoreEi = $a;} elseif($ei >=149.3 and $ei <157.1){$scoreEi = $b;} elseif($ei >=157.1 and $ei <164.9){$scoreEi = $c;} elseif($ei >=164.9 and $ei <172.6){$scoreEi = $d;} elseif($ei >= 172.6 and $ei <180.4){$scoreEi = $e;} elseif($ei >=180.4 and $ei <188.2){$scoreEi = $f;} elseif($ei >= 188.2 and $ei <196.0){$scoreEi = $g;} elseif($ei >= 196.0){$scoreEi = $h;} break;

        case 16.0 :

        if($ei < 149.6){ $scoreEi = $a;} elseif($ei >=149.6 and $ei <157.4){$scoreEi = $b;} elseif($ei >=157.4 and $ei <165.1){$scoreEi = $c;} elseif($ei >=165.1 and $ei <172.9){$scoreEi = $d;} elseif($ei >= 172.9 and $ei <180.7){$scoreEi = $e;} elseif($ei >=180.7 and $ei <188.4){$scoreEi = $f;} elseif($ei >= 188.4 and $ei <196.2){$scoreEi = $g;} elseif($ei >= 196.2){$scoreEi = $h;} break;

        case 16.01:

        if($ei < 149.9){ $scoreEi = $a;} elseif($ei >=149.9 and $ei <157.6){$scoreEi = $b;} elseif($ei >=157.6 and $ei <165.4){$scoreEi = $c;} elseif($ei >=165.4 and $ei <173.1){$scoreEi = $d;} elseif($ei >= 173.1 and $ei <180.9){$scoreEi = $e;} elseif($ei >=180.9 and $ei <188.7){$scoreEi = $f;} elseif($ei >= 188.7 and $ei <196.4){$scoreEi = $g;} elseif($ei >= 196.4){$scoreEi = $h;} break;

        case 16.2 :

        if($ei < 150.1){ $scoreEi = $a;} elseif($ei >=150.1 and $ei <157.9){$scoreEi = $b;} elseif($ei >=157.9 and $ei <165.6){$scoreEi = $c;} elseif($ei >=165.6 and $ei <173.4){$scoreEi = $d;} elseif($ei >= 173.4 and $ei <181.1){$scoreEi = $e;} elseif($ei >=181.1 and $ei <188.9){$scoreEi = $f;} elseif($ei >= 188.9 and $ei <196.7){$scoreEi = $g;} elseif($ei >= 196.7){$scoreEi = $h;} break;

        case 16.3 :

        if($ei < 150.4){ $scoreEi = $a;} elseif($ei >=150.4 and $ei <158.1){$scoreEi = $b;} elseif($ei >=158.1 and $ei <165.9){$scoreEi = $c;} elseif($ei >=165.9 and $ei <173.6){$scoreEi = $d;} elseif($ei >= 173.6 and $ei <181.4){$scoreEi = $e;} elseif($ei >=181.4 and $ei <189.1){$scoreEi = $f;} elseif($ei >= 189.1 and $ei <196.9){$scoreEi = $g;} elseif($ei >= 196.9){$scoreEi = $h;} break;

        case 16.4 :

        if($ei < 150.6){ $scoreEi = $a;} elseif($ei >=150.6 and $ei <158.4){$scoreEi = $b;} elseif($ei >=158.4 and $ei <166.1){$scoreEi = $c;} elseif($ei >=166.1 and $ei <173.8){$scoreEi = $d;} elseif($ei >= 173.8 and $ei <181.6){$scoreEi = $e;} elseif($ei >=181.6 and $ei <189.3){$scoreEi = $f;} elseif($ei >= 189.3 and $ei <197.0){$scoreEi = $g;} elseif($ei >= 197.0){$scoreEi = $h;} break;

        case 16.5 :

        if($ei < 150.9){ $scoreEi = $a;} elseif($ei >=150.9 and $ei <158.6){$scoreEi = $b;} elseif($ei >=158.6 and $ei <166.3){$scoreEi = $c;} elseif($ei >=166.3 and $ei <174.0){$scoreEi = $d;} elseif($ei >= 174.0 and $ei <181.8){$scoreEi = $e;} elseif($ei >=181.8 and $ei <189.5){$scoreEi = $f;} elseif($ei >= 189.5 and $ei <197.2){$scoreEi = $g;} elseif($ei >= 197.2){$scoreEi = $h;} break;

        case 16.6 :

        if($ei < 151.1){ $scoreEi = $a;} elseif($ei >=151.1 and $ei <158.8){$scoreEi = $b;} elseif($ei >=158.8 and $ei <166.5){$scoreEi = $c;} elseif($ei >=166.5 and $ei <174.2){$scoreEi = $d;} elseif($ei >= 174.2 and $ei <181.9){$scoreEi = $e;} elseif($ei >=181.9 and $ei <189.7){$scoreEi = $f;} elseif($ei >= 189.7 and $ei <197.4){$scoreEi = $g;} elseif($ei >= 197.4){$scoreEi = $h;} break;

        case 16.7 :

        if($ei < 151.3){ $scoreEi = $a;} elseif($ei >=151.3 and $ei <159.0){$scoreEi = $b;} elseif($ei >=159.0 and $ei <166.7){$scoreEi = $c;} elseif($ei >=166.7 and $ei <174.4){$scoreEi = $d;} elseif($ei >= 174.4 and $ei <182.1){$scoreEi = $e;} elseif($ei >=182.1 and $ei <189.8){$scoreEi = $f;} elseif($ei >= 189.8 and $ei <197.5){$scoreEi = $g;} elseif($ei >= 197.5){$scoreEi = $h;} break;

        case 16.8 :

        if($ei < 151.5){ $scoreEi = $a;} elseif($ei >=151.5 and $ei <159.2){$scoreEi = $b;} elseif($ei >=159.2 and $ei <166.9){$scoreEi = $c;} elseif($ei >=166.9 and $ei <174.6){$scoreEi = $d;} elseif($ei >= 174.6 and $ei <182.3){$scoreEi = $e;} elseif($ei >=182.3 and $ei <190.0){$scoreEi = $f;} elseif($ei >= 190.0 and $ei <197.7){$scoreEi = $g;} elseif($ei >= 197.7){$scoreEi = $h;} break;

        case 16.9 :

        if($ei < 151.7){ $scoreEi = $a;} elseif($ei >=151.7 and $ei <159.4){$scoreEi = $b;} elseif($ei >=159.4 and $ei <167.1){$scoreEi = $c;} elseif($ei >=167.1 and $ei <174.7){$scoreEi = $d;} elseif($ei >= 174.7 and $ei <182.4){$scoreEi = $e;} elseif($ei >=182.4 and $ei <190.1){$scoreEi = $f;} elseif($ei >= 190.1 and $ei <197.8){$scoreEi = $g;} elseif($ei >= 197.8){$scoreEi = $h;} break;

        case 16.10:

        if($ei < 151.9){ $scoreEi = $a;} elseif($ei >=151.9 and $ei <159.6){$scoreEi = $b;} elseif($ei >=159.6 and $ei <167.2){$scoreEi = $c;} elseif($ei >=167.2 and $ei <174.9){$scoreEi = $d;} elseif($ei >= 174.9 and $ei <182.6){$scoreEi = $e;} elseif($ei >=182.6 and $ei <190.2){$scoreEi = $f;} elseif($ei >= 190.2 and $ei <197.9){$scoreEi = $g;} elseif($ei >= 197.9){$scoreEi = $h;} break;

        case 16.11:

        if($ei < 152.1){ $scoreEi = $a;} elseif($ei >=152.1 and $ei <159.7){$scoreEi = $b;} elseif($ei >=159.7 and $ei <167.4){$scoreEi = $c;} elseif($ei >=167.4 and $ei <175.0){$scoreEi = $d;} elseif($ei >= 175.0 and $ei <182.7){$scoreEi = $e;} elseif($ei >=182.7 and $ei <190.3){$scoreEi = $f;} elseif($ei >= 190.3 and $ei <198.0){$scoreEi = $g;} elseif($ei >= 198.0){$scoreEi = $h;} break;

        case 17.0 :

        if($ei < 152.2){ $scoreEi = $a;} elseif($ei >=152.2 and $ei <159.9){$scoreEi = $b;} elseif($ei >=159.9 and $ei <167.5){$scoreEi = $c;} elseif($ei >=167.5 and $ei <175.2){$scoreEi = $d;} elseif($ei >= 175.2 and $ei <182.8){$scoreEi = $e;} elseif($ei >=182.8 and $ei <190.4){$scoreEi = $f;} elseif($ei >= 190.4 and $ei <198.1){$scoreEi = $g;} elseif($ei >= 198.1){$scoreEi = $h;} break;

        case 17.01:

        if($ei < 152.4){ $scoreEi = $a;} elseif($ei >=152.4 and $ei <160.0){$scoreEi = $b;} elseif($ei >=160.0 and $ei <167.7){$scoreEi = $c;} elseif($ei >=167.7 and $ei <175.3){$scoreEi = $d;} elseif($ei >= 175.3 and $ei <182.9){$scoreEi = $e;} elseif($ei >=182.9 and $ei <190.5){$scoreEi = $f;} elseif($ei >= 190.5 and $ei <198.2){$scoreEi = $g;} elseif($ei >= 198.2){$scoreEi = $h;} break;

        case 17.2 :

        if($ei < 152.5){ $scoreEi = $a;} elseif($ei >=152.5 and $ei <160.2){$scoreEi = $b;} elseif($ei >=160.2 and $ei <167.8){$scoreEi = $c;} elseif($ei >=167.8 and $ei <175.4){$scoreEi = $d;} elseif($ei >= 175.4 and $ei <183.0){$scoreEi = $e;} elseif($ei >=183.0 and $ei <190.6){$scoreEi = $f;} elseif($ei >= 190.6 and $ei <198.2){$scoreEi = $g;} elseif($ei >= 198.2){$scoreEi = $h;} break;

        case 17.3 :

        if($ei < 152.7){ $scoreEi = $a;} elseif($ei >=152.7 and $ei <160.3){$scoreEi = $b;} elseif($ei >=160.3 and $ei <167.9){$scoreEi = $c;} elseif($ei >=167.9 and $ei <175.5){$scoreEi = $d;} elseif($ei >= 175.5 and $ei <183.1){$scoreEi = $e;} elseif($ei >=183.1 and $ei <190.7){$scoreEi = $f;} elseif($ei >= 190.7 and $ei <198.3){$scoreEi = $g;} elseif($ei >= 198.3){$scoreEi = $h;} break;

        case 17.4 :

        if($ei < 152.8){ $scoreEi = $a;} elseif($ei >=152.8 and $ei <160.4){$scoreEi = $b;} elseif($ei >=160.4 and $ei <168.0){$scoreEi = $c;} elseif($ei >=168.0 and $ei <175.6){$scoreEi = $d;} elseif($ei >= 175.6 and $ei <183.2){$scoreEi = $e;} elseif($ei >=183.2 and $ei <190.8){$scoreEi = $f;} elseif($ei >= 190.8 and $ei <198.4){$scoreEi = $g;} elseif($ei >= 198.4){$scoreEi = $h;} break;

        case 17.5 :

        if($ei < 153.0){ $scoreEi = $a;} elseif($ei >=153.0 and $ei <160.5){$scoreEi = $b;} elseif($ei >=160.5 and $ei <168.1){$scoreEi = $c;} elseif($ei >=168.1 and $ei <175.7){$scoreEi = $d;} elseif($ei >= 175.7 and $ei <183.3){$scoreEi = $e;} elseif($ei >=183.3 and $ei <190.8){$scoreEi = $f;} elseif($ei >= 190.8 and $ei <198.4){$scoreEi = $g;} elseif($ei >= 198.4){$scoreEi = $h;} break;

        case 17.6 :

        if($ei < 153.1){ $scoreEi = $a;} elseif($ei >=153.1 and $ei <160.6){$scoreEi = $b;} elseif($ei >=160.6 and $ei <168.2){$scoreEi = $c;} elseif($ei >=168.2 and $ei <175.8){$scoreEi = $d;} elseif($ei >= 175.8 and $ei <183.3){$scoreEi = $e;} elseif($ei >=183.3 and $ei <190.9){$scoreEi = $f;} elseif($ei >= 190.9 and $ei <198.4){$scoreEi = $g;} elseif($ei >= 198.4){$scoreEi = $h;} break;

        case 17.7 :

        if($ei < 153.2){ $scoreEi = $a;} elseif($ei >=153.2 and $ei <160.8){$scoreEi = $b;} elseif($ei >=160.8 and $ei <168.3){$scoreEi = $c;} elseif($ei >=168.3 and $ei <175.8){$scoreEi = $d;} elseif($ei >= 175.8 and $ei <183.4){$scoreEi = $e;} elseif($ei >=183.4 and $ei <190.9){$scoreEi = $f;} elseif($ei >= 190.9 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 17.8 :

        if($ei < 153.3){ $scoreEi = $a;} elseif($ei >=153.3 and $ei <160.9){$scoreEi = $b;} elseif($ei >=160.9 and $ei <168.4){$scoreEi = $c;} elseif($ei >=168.4 and $ei <175.9){$scoreEi = $d;} elseif($ei >= 175.9 and $ei <183.4){$scoreEi = $e;} elseif($ei >=183.4 and $ei <191.0){$scoreEi = $f;} elseif($ei >= 191.0 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 17.9 :

        if($ei < 153.4){ $scoreEi = $a;} elseif($ei >=153.4 and $ei <160.9){$scoreEi = $b;} elseif($ei >=160.9 and $ei <168.5){$scoreEi = $c;} elseif($ei >=168.5 and $ei <176.0){$scoreEi = $d;} elseif($ei >= 176.0 and $ei <183.5){$scoreEi = $e;} elseif($ei >=183.5 and $ei <191.0){$scoreEi = $f;} elseif($ei >= 191.0 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 17.10:

        if($ei < 153.5){ $scoreEi = $a;} elseif($ei >=153.5 and $ei <161.0){$scoreEi = $b;} elseif($ei >=161.0 and $ei <168.5){$scoreEi = $c;} elseif($ei >=168.5 and $ei <176.0){$scoreEi = $d;} elseif($ei >= 176.0 and $ei <183.5){$scoreEi = $e;} elseif($ei >=183.5 and $ei <191.0){$scoreEi = $f;} elseif($ei >= 191.0 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 17.11:

        if($ei < 153.6){ $scoreEi = $a;} elseif($ei >=153.6 and $ei <161.1){$scoreEi = $b;} elseif($ei >=161.1 and $ei <168.6){$scoreEi = $c;} elseif($ei >=168.6 and $ei <176.1){$scoreEi = $d;} elseif($ei >= 176.1 and $ei <183.6){$scoreEi = $e;} elseif($ei >=183.6 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.6){$scoreEi = $g;} elseif($ei >= 198.6){$scoreEi = $h;} break;

        case 18.0 :

        if($ei < 153.7){ $scoreEi = $a;} elseif($ei >=153.7 and $ei <161.2){$scoreEi = $b;} elseif($ei >=161.2 and $ei <168.7){$scoreEi = $c;} elseif($ei >=168.7 and $ei <176.1){$scoreEi = $d;} elseif($ei >= 176.1 and $ei <183.6){$scoreEi = $e;} elseif($ei >=183.6 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.6){$scoreEi = $g;} elseif($ei >= 198.6){$scoreEi = $h;} break;

        case 18.01:

        if($ei < 153.8){ $scoreEi = $a;} elseif($ei >=153.8 and $ei <161.3){$scoreEi = $b;} elseif($ei >=161.3 and $ei <168.7){$scoreEi = $c;} elseif($ei >=168.7 and $ei <176.2){$scoreEi = $d;} elseif($ei >= 176.2 and $ei <183.6){$scoreEi = $e;} elseif($ei >=183.6 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.6){$scoreEi = $g;} elseif($ei >= 198.6){$scoreEi = $h;} break;

        case 18.2 :

        if($ei < 153.9){ $scoreEi = $a;} elseif($ei >=153.9 and $ei <161.4){$scoreEi = $b;} elseif($ei >=161.4 and $ei <168.8){$scoreEi = $c;} elseif($ei >=168.8 and $ei <176.2){$scoreEi = $d;} elseif($ei >= 176.2 and $ei <183.7){$scoreEi = $e;} elseif($ei >=183.7 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.6){$scoreEi = $g;} elseif($ei >= 198.6){$scoreEi = $h;} break;

        case 18.3 :

        if($ei < 154.0){ $scoreEi = $a;} elseif($ei >=154.0 and $ei <161.4){$scoreEi = $b;} elseif($ei >=161.4 and $ei <168.9){$scoreEi = $c;} elseif($ei >=168.9 and $ei <176.3){$scoreEi = $d;} elseif($ei >= 176.3 and $ei <183.7){$scoreEi = $e;} elseif($ei >=183.7 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.6){$scoreEi = $g;} elseif($ei >= 198.6){$scoreEi = $h;} break;

        case 18.4 :

        if($ei < 154.1){ $scoreEi = $a;} elseif($ei >=154.1 and $ei <161.5){$scoreEi = $b;} elseif($ei >=161.5 and $ei <168.9){$scoreEi = $c;} elseif($ei >=168.9 and $ei <176.3){$scoreEi = $d;} elseif($ei >= 176.3 and $ei <183.7){$scoreEi = $e;} elseif($ei >=183.7 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.6){$scoreEi = $g;} elseif($ei >= 198.6){$scoreEi = $h;} break;

        case 18.5 :

        if($ei < 154.2){ $scoreEi = $a;} elseif($ei >=154.2 and $ei <161.6){$scoreEi = $b;} elseif($ei >=161.6 and $ei <169.0){$scoreEi = $c;} elseif($ei >=169.0 and $ei <176.4){$scoreEi = $d;} elseif($ei >= 176.4 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 18.6 :

        if($ei < 154.2){ $scoreEi = $a;} elseif($ei >=154.2 and $ei <161.6){$scoreEi = $b;} elseif($ei >=161.6 and $ei <169.0){$scoreEi = $c;} elseif($ei >=169.0 and $ei <176.4){$scoreEi = $d;} elseif($ei >= 176.4 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 18.7 :

        if($ei < 154.3){ $scoreEi = $a;} elseif($ei >=154.3 and $ei <161.7){$scoreEi = $b;} elseif($ei >=161.7 and $ei <169.0){$scoreEi = $c;} elseif($ei >=169.0 and $ei <176.4){$scoreEi = $d;} elseif($ei >= 176.4 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.2){$scoreEi = $f;} elseif($ei >= 191.2 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 18.8 :

        if($ei < 154.4){ $scoreEi = $a;} elseif($ei >=154.4 and $ei <161.7){$scoreEi = $b;} elseif($ei >=161.7 and $ei <169.1){$scoreEi = $c;} elseif($ei >=169.1 and $ei <176.4){$scoreEi = $d;} elseif($ei >= 176.4 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.2){$scoreEi = $f;} elseif($ei >= 191.2 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 18.9 :

        if($ei < 154.5){ $scoreEi = $a;} elseif($ei >=154.5 and $ei <161.8){$scoreEi = $b;} elseif($ei >=161.8 and $ei <169.1){$scoreEi = $c;} elseif($ei >=169.1 and $ei <176.5){$scoreEi = $d;} elseif($ei >= 176.5 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.2){$scoreEi = $f;} elseif($ei >= 191.2 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 18.10:

        if($ei < 154.5){ $scoreEi = $a;} elseif($ei >=154.5 and $ei <161.8){$scoreEi = $b;} elseif($ei >=161.8 and $ei <169.2){$scoreEi = $c;} elseif($ei >=169.2 and $ei <176.5){$scoreEi = $d;} elseif($ei >= 176.5 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 18.11:

        if($ei < 154.6){ $scoreEi = $a;} elseif($ei >=154.6 and $ei <161.9){$scoreEi = $b;} elseif($ei >=161.9 and $ei <169.2){$scoreEi = $c;} elseif($ei >=169.2 and $ei <176.5){$scoreEi = $d;} elseif($ei >= 176.5 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.5){$scoreEi = $g;} elseif($ei >= 198.5){$scoreEi = $h;} break;

        case 19.0 :

        if($ei < 154.6){ $scoreEi = $a;} elseif($ei >=154.6 and $ei <161.9){$scoreEi = $b;} elseif($ei >=161.9 and $ei <169.2){$scoreEi = $c;} elseif($ei >=169.2 and $ei <176.5){$scoreEi = $d;} elseif($ei >= 176.5 and $ei <183.8){$scoreEi = $e;} elseif($ei >=183.8 and $ei <191.1){$scoreEi = $f;} elseif($ei >= 191.1 and $ei <198.4){$scoreEi = $g;} elseif($ei >= 198.4){$scoreEi = $h;} break;




    //default ----------------------------------------------
        default:
        $scoreEi = 'Erro na estatura por idade';
        //echo "Valor inválido";
        break;
      }

      if ($scoreEi == $a) {
        $classificacaoEi = $muitobaixo;
      }
      elseif($scoreEi == $b){
        $classificacaoEi = $baixa;
      }
      else{
        $classificacaoEi = $adequado;
      }

    }


    $arrayEi = array(1 => $scoreEi, 2 => $classificacaoEi);
    return $arrayEi;





  }
  public function realizarAvaliacao($id)
  {
    $paciente = Paciente::find($id);
    $registros = DB::table('pacientes')
    ->select('pacientes.*', 'av_antropometricas.*')
    ->where('pacientes.id', '=', $id)
    ->join('av_antropometricas', 'pacientes.id', '=', 'av_antropometricas.id_paciente')
    ->get();

     // $anos = DB::table('av_antropometricas')
     // ->select('av_antropometricas.*', 'pacientes.*',)
     // ->where('av_antropometricas.id_paciente', '=', $id)
     // ->join('pacientes.id', '=', 'av_antropometricas.id_paciente')
     // ->get();
//--------------------------------------------------------
//---------------------------------------------------------



    if (count($registros)<=0) {
      //não foi realizada avaliação ainda do paciente especificado
      return redirect()
                ->route('paciente.pesquisar')
                ->with('error', 'Não foi realizada nenhuma avaliação deste paciente até o momento!');
    }
    else{
      for ($i=0; $i< count($registros) ; $i++) {
        $classificacao[] = PacienteController::ResultadoClassificacao($registros[$i]->imc,$registros[$i]->idade,$registros[$i]->sexo);
        $scorez[]        = PacienteController::ResultadoClassificacao($registros[$i]->imc,$registros[$i]->idade,$registros[$i]->sexo);
        $scoreEi[]       = PacienteController::ResultadoClassificacaoEi($registros[$i]->altura,$registros[$i]->idade,$registros[$i]->sexo);
        //chamo a função que insere no banco os valores das avaliacoes
        PacienteController::InserirDadosClassificacao($registros[$i]->id, $scorez[$i], $scoreEi[$i]);
      }

      return view ('resultado_individual', compact('registros', 'scorez','paciente', 'scoreEi'));
    }

} //fecha a função

  public function InserirDadosClassificacao($id, $dadosImcIdade, $dadosEstIdade){
    $avaliacao = AvAntropometrica::find($id);
    $geral = ClassificacaoGeral::find($avaliacao->id_paciente);
    //dd($geral);
    $avaliacao->meses                 = $dadosImcIdade[3];
    $avaliacao->classificacaoImcIdade = $dadosImcIdade[2];
    $avaliacao->scoreImcIdade         = $dadosImcIdade[1];
    $avaliacao->classificacaoEstIdade = $dadosEstIdade[2];
    $avaliacao->scoreEstIdade         = $dadosEstIdade[1];

    $geral->meses                 = $dadosImcIdade[3];
    $geral->classificacaoImcIdade = $dadosImcIdade[2];
    $geral->scoreImcIdade         = $dadosImcIdade[1];
    $geral->classificacaoEstIdade = $dadosEstIdade[2];
    $geral->scoreEstIdade         = $dadosEstIdade[1];



    $geral->save();
    $avaliacao->save();

  }

  public function exportar(){
    // Definimos o nome do arquivo que será exportado
    $arquivo = 'dados.xls';

    // Criamos uma tabela HTML com o formato da planilha
    $html = '';
    $html .= '<table border="1">';
    $html .= '<tr>';
    $html .= '<td colspan="5">Planilha Avaliações antropométricas</tr>';
    $html .= '</tr>';


    $html .= '<tr>';
    $html .= '<td><b>id_paciente</b></td>';
    $html .= '<td><b>Nome</b></td>';
    $html .= '<td><b>Data av.</b></td>';
    $html .= '<td><b>Peso</b></td>';
    $html .= '<td><b>altura</b></td>';
    $html .= '<td><b>dobras</b></td>';
    $html .= '<td><b>Idade</b></td>';
    $html .= '<td><b>IMC</b></td>';
    $html .= '<td><b>C. imc</b></td>';
    $html .= '<td><b>Score imc</b></td>';
    $html .= '<td><b>C. estatura idade</b></td>';
    $html .= '<td><b>Score estatura idade</b></td>';
    $html .= '</tr>';

    //Selecionar todos os itens da tabela
    $result_msg_contatos = "SELECT * FROM av_antropometricas";
    // $resultado_msg_contatos = mysqli_query($result_msg_contatos);
    $dados = DB::table('pacientes')
    ->select('pacientes.*', 'classificacao_gerals.*')
    // ->where('pacientes.id', '=', $id)
    ->join('classificacao_gerals', 'pacientes.id', '=', 'classificacao_gerals.id_paciente')
    ->get();
    foreach ($dados as $dados) {
      # code...
      $html .= '<tr>';
      $html .= '<td>'.$dados->id_paciente.'</td>';
      $html .= '<td>'.$dados->nome.'</td>';
      $html .= '<td>'.$dados->data.'</td>';
      $html .= '<td>'.$dados->peso.'</td>';
      $html .= '<td>'.$dados->altura.'</td>';
      $html .= '<td>'.$dados->pct.'</td>';
      $html .= '<td>'.$dados->idade.'</td>';
      $html .= '<td>'.$dados->imc.'</td>';
      $html .= '<td>'.$dados->classificacaoImcIdade.'</td>';
      $html .= '<td>'.$dados->scoreImcIdade.'</td>';
      $html .= '<td>'.$dados->classificacaoEstIdade.'</td>';
      $html .= '<td>'.$dados->scoreEstIdade.'</td>';
      // $html .= '<td>'.$data.'</td>';
      $html .= '</tr>';
      ;
    }
    // while(mysqli_fetch_assoc($result_msg_contatos)){


    // Configurações header para forçar o download
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );
    // Envia o conteúdo do arquivo
    echo $html;
    exit;
  }

}
