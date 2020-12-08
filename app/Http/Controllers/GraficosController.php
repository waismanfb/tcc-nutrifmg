<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\GraficoClassificacao;
use DB;

class GraficosController extends Controller
{
    public function NumeroClassificacao($sexo, $tipoClassificacao)
    {
      return DB::table('pacientes')
            ->join('classificacao_gerals', 'pacientes.id', '=', 'classificacao_gerals.id_paciente')
            ->select('classificacao_gerals.classificacaoImcIdade')
            ->where('pacientes.sexo',$sexo)
            ->where('classificacao_gerals.classificacaoImcIdade',$tipoClassificacao)
            ->count();
    }
    public function NumeroClassificacaoCurso($sexo, $curso, $tipoClassificacao)
    {
      return DB::table('pacientes')
            ->join('classificacao_gerals', 'pacientes.id', '=', 'classificacao_gerals.id_paciente')
            ->select('classificacao_gerals.classificacaoImcIdade')
            ->where('pacientes.sexo',$sexo)
            ->where('pacientes.curso',$curso)
            ->where('classificacao_gerals.classificacaoImcIdade',$tipoClassificacao)
            ->count();
    }


    public function index(){
      return view('graficos');
    }
    public function imcIdadeMas(){
      //PACIENTES DO sexo MASCULINO
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacao(1, 'Eutrofia(Normal)');
      $MagrezaAcentuada = GraficosController::NumeroClassificacao(1, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacao(1, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacao(1, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacao(1, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacao(1, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);
      $grafico->displayLegend(true);
      $grafico->width(1);
      $grafico->height(1);

      $grafico->title("Classificação Geral IMC por idade - Masculino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }


      return view('grafico', compact('grafico','porcentagem'));
    }
    public function ImcIdadeFem(){
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacao(2, 'Eutrofia(Normal)');
      $MagrezaAcentuada = GraficosController::NumeroClassificacao(2, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacao(2, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacao(2, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacao(2, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacao(2, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);

      $grafico->title("Classificação Geral IMC por idade - Feminino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }

      return view('grafico', compact('grafico','porcentagem'));
    }
    public function ImcIdadeNutriFem()
    {
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacaoCurso(2, 1, 'Eutrofia(Normal)');
      $MagrezaAcentuada = GraficosController::NumeroClassificacaoCurso(2, 1, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacaoCurso(2, 1, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacaoCurso(2, 1, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacaoCurso(2, 1, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacaoCurso(2, 1, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);

      $grafico->title("Classificação IMC por idade - Curso Nutrição - Feminino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }

      return view('grafico', compact('grafico','porcentagem'));
    }
    public function ImcIdadeNutriMas()
    {
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacaoCurso(1, 1, 'Eutrofia(Normal)');
      $MagrezaAcentuada = GraficosController::NumeroClassificacaoCurso(1, 1, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacaoCurso(1, 1, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacaoCurso(1, 1, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacaoCurso(1, 1, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacaoCurso(1, 1, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);

      $grafico->title("Classificação IMC por idade - Curso Nutrição - Masculino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }

      return view('grafico', compact('grafico','porcentagem'));
    }
    public function ImcIdadeAgroMas()
    {
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacaoCurso(1, 2, 'Eutrofia(Normal)');//sexo, curso. classificação
      $MagrezaAcentuada = GraficosController::NumeroClassificacaoCurso(1, 2, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacaoCurso(1, 2, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacaoCurso(1, 2, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacaoCurso(1, 2, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacaoCurso(1, 2, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);

      $grafico->title("Classificação IMC por idade - Curso Agropecuaria - Masculino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }

      return view('grafico', compact('grafico', 'porcentagem'));
    }
    public function ImcIdadeAgroFem()
    {
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacaoCurso(2, 2, 'Eutrofia(Normal)');//sexo, curso. classificação
      $MagrezaAcentuada = GraficosController::NumeroClassificacaoCurso(2, 2, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacaoCurso(2, 2, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacaoCurso(2, 2, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacaoCurso(2, 2, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacaoCurso(2, 2, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);

      $grafico->title("Classificação IMC por idade - Curso Agropecuaria - Feminino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }

      return view('grafico', compact('grafico','porcentagem'));
    }
    public function ImcIdadeInfoFem()
    {
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacaoCurso(2, 3, 'Eutrofia(Normal)');//sexo, curso. classificação
      $MagrezaAcentuada = GraficosController::NumeroClassificacaoCurso(2, 3, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacaoCurso(2, 3, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacaoCurso(2, 3, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacaoCurso(2, 3, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacaoCurso(2, 3, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);

      $grafico->title("Classificação IMC por idade - Curso Informática - Feminino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }

      return view('grafico', compact('grafico','porcentagem'));
    }
    public function ImcIdadeInfoMas()
    {
      $grafico = new GraficoClassificacao;

      $EutrofiaNormal   = GraficosController::NumeroClassificacaoCurso(1, 3, 'Eutrofia(Normal)');//sexo, curso. classificação
      $MagrezaAcentuada = GraficosController::NumeroClassificacaoCurso(1, 3, 'Magreza acentuada');
      $Magreza          = GraficosController::NumeroClassificacaoCurso(1, 3, 'Magreza');
      $Sobrepeso        = GraficosController::NumeroClassificacaoCurso(1, 3, 'Sobrepeso');
      $Obesidade        = GraficosController::NumeroClassificacaoCurso(1, 3, 'Obesidade');
      $ObesidadeGrave   = GraficosController::NumeroClassificacaoCurso(1, 3, 'Obesidade grave');
      $grafico->Labels(["Eutrofia(Normal)","Magreza acentuada","Magreza","Sobrepeso","Obesidade","Obesidade grave"]);
      $grafico->dataset('Valores', 'pie',[$EutrofiaNormal,$MagrezaAcentuada,$Magreza,$Sobrepeso,$Obesidade,$ObesidadeGrave])
        ->backgroundColor(['#4e342e','#ff6e40','#ffff00','#1b5e20','#01579b','#ff1744']);

      $grafico->title("Classificação IMC por idade - Curso Informática - Masculino", 20);

      $porcentagem[] = $EutrofiaNormal + $MagrezaAcentuada + $Magreza + $Sobrepeso + $Obesidade + $ObesidadeGrave;
      if ($porcentagem[0] != 0) {
        $porcentagem[] = number_format(($EutrofiaNormal*100)/$porcentagem[0], 2);
        $porcentagem[] = number_format(($MagrezaAcentuada*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Magreza*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Sobrepeso*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($Obesidade*100)/$porcentagem[0]);
        $porcentagem[] = number_format(($ObesidadeGrave*100)/$porcentagem[0]);
      }else {
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
        $porcentagem[] = 0;
      }

      return view('grafico', compact('grafico','porcentagem'));
    }
}
