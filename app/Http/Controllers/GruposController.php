<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimento;
use App\Paciente;
use App\Dieta;
use App\Receita;
use App\DietasPaciente;
use Carbon\Carbon;
use DB;

class GruposController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function recordatorioMas()
    {
        $quantidadeRegistros   = $this->contarPacientes(1, 0); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(1, 0);
        $receitas              = $this->retornaReceitas(1, 0);
        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
            $grupo                 = 'Masculino';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function recordatorioFem()
    {
        $quantidadeRegistros   = $this->contarPacientes(2, 0); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(2, 0);
        $receitas              = $this->retornaReceitas(2, 0);

        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
                $grupo                 = 'Feminino';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function recordatorioMasNutri()
    {
        $quantidadeRegistros   = $this->contarPacientes(1, 1); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(1, 1);
        $receitas              = $this->retornaReceitas(1, 1);

        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
            $grupo                 = 'Masculino Nutrição';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function recordatorioFemNutri()
    {
        $quantidadeRegistros   = $this->contarPacientes(2, 1); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(2, 1);
        $receitas              = $this->retornaReceitas(2, 1);

        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
            $grupo                 = 'Feminino Nutrição';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function recordatorioAgroMas()
    {
        $quantidadeRegistros   = $this->contarPacientes(1, 2); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(1, 2);
        $receitas              = $this->retornaReceitas(1, 2);

        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
            $grupo                 = 'Masculino Agropecuária';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function recordatorioAgroFem()
    {
        $quantidadeRegistros   = $this->contarPacientes(2, 2); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(2, 2);
        $receitas              = $this->retornaReceitas(2, 2);

        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
            $grupo                 = 'Feminino Agropecuária';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function recordatorioInfoMas()
    {
        $quantidadeRegistros   = $this->contarPacientes(1, 3); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(1, 3);
        $receitas              = $this->retornaReceitas(1, 3);

        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
            $grupo                 = 'Informática Masculino';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function recordatorioInfoFem()
    {
        $quantidadeRegistros   = $this->contarPacientes(2, 3); //parametros(sexo, curso)
        $selecionados          = $this->retornaAlimentosSelecionados(2, 3);
        $receitas              = $this->retornaReceitas(2, 3);

        if (!$selecionados->isEmpty() or !$selecionados->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);
            $media                 = $this->media($totais, $quantidadeRegistros);
            $grupo                 = 'Informática Feminino';

            return view('grupos', [
                'media' => $media,
                'quantidade' => $quantidadeRegistros,
                'grupo' => $grupo
            ]);
        }
        else{
            return view('error');
        }
    }

    public function contarPacientes($sexoId, $curso)
    {
        if ($curso == 0) {
            return count(Paciente::where('sexo', '=', $sexoId)->get());
        }
        else {
            return count(Paciente::where('sexo', '=', $sexoId)
            ->where('curso', '=', $curso)->get());
        }

    }

    public function exportar($grupo)
    {
        if ($grupo == 'Masculino') {
            $sexoId = 1;
            $curso  = 0;
        }
        else if ($grupo == 'Feminino') {
            $sexoId = 2;
            $curso  = 0;
        }
        else if ($grupo == 'Masculino Nutrição') {
            $sexoId = 1;
            $curso  = 1;
        }
        else if ($grupo == 'Feminino Nutrição') {
            $sexoId = 2;
            $curso  = 1;
        }
        else if ($grupo == 'Masculino Agropecuária') {
            $sexoId = 1;
            $curso  = 2;
        }
        else if ($grupo == 'Feminino Agropecuária') {
            $sexoId = 2;
            $curso  = 2;
        }
        else if ($grupo == 'Informática Masculino') {
            $sexoId = 1;
            $curso  = 3;
        }
        else if ($grupo == 'Informática Feminino') {
            $sexoId = 2;
            $curso  = 3;
        }

        // Definimos o nome do arquivo que será exportado
        $dataColeta = Carbon::today()->toDateString();
        $dataColeta = Carbon::parse($dataColeta)->format('d/m/Y');
        $arquivo = $grupo . '_' . $dataColeta . '.xls';

        $quantidadeRegistros   = $this->contarPacientes($sexoId, $curso);
        $selecionados          = $this->retornaAlimentosSelecionados($sexoId, $curso);
        $receitas              = $this->retornaReceitas($sexoId, $curso);
        $totais                = $this->somaTotais($selecionados, $receitas);
        $media                 = $this->media($totais, $quantidadeRegistros);

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="5">Total</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Quantidade</b></td>';
        $html .= '<td><b>Kcal</b></td>';
        $html .= '<td><b>Kj</b></td>';
        $html .= '<td><b>Proteina</b></td>';
        $html .= '<td><b>Lipideos</b></td>';
        $html .= '<td><b>Colesterol</b></td>';
        $html .= '<td><b>Carboidrato</b></td>';
        $html .= '<td><b>Fibra Alimentar</b></td>';
        $html .= '<td><b>Cinzas</b></td>';
        $html .= '<td><b>Calcio</b></td>';
        $html .= '<td><b>Magnesio</b></td>';
        $html .= '<td><b>Manganes</b></td>';
        $html .= '<td><b>Fosforo</b></td>';
        $html .= '<td><b>Ferro</b></td>';
        $html .= '<td><b>Sodio</b></td>';
        $html .= '<td><b>Potassio</b></td>';
        $html .= '<td><b>Cobre</b></td>';
        $html .= '<td><b>Zinco</b></td>';
        $html .= '<td><b>Retinol</b></td>';
        $html .= '<td><b>RE</b></td>';
        $html .= '<td><b>RAE</b></td>';
        $html .= '<td><b>Tiamina</b></td>';
        $html .= '<td><b>Riboflavina</b></td>';
        $html .= '<td><b>Piridoxina</b></td>';
        $html .= '<td><b>Niacina</b></td>';
        $html .= '<td><b>VitaminaC</b></td>';
        $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<td>'.$media['quantidade'].'</td>';
            $html .= '<td>'.$media['energiaKcal'].'</td>';
            $html .= '<td>'.$media['energiaKj'].'</td>';
            $html .= '<td>'.$media['proteina'].'</td>';
            $html .= '<td>'.$media['lipideos'].'</td>';
            $html .= '<td>'.$media['colesterol'].'</td>';
            $html .= '<td>'.$media['carboidrato'].'</td>';
            $html .= '<td>'.$media['fibraAlimentar'].'</td>';
            $html .= '<td>'.$media['cinzas'].'</td>';
            $html .= '<td>'.$media['calcio'].'</td>';
            $html .= '<td>'.$media['magnesio'].'</td>';
            $html .= '<td>'.$media['manganes'].'</td>';
            $html .= '<td>'.$media['fosforo'].'</td>';
            $html .= '<td>'.$media['ferro'].'</td>';
            $html .= '<td>'.$media['sodio'].'</td>';
            $html .= '<td>'.$media['potassio'].'</td>';
            $html .= '<td>'.$media['cobre'].'</td>';
            $html .= '<td>'.$media['zinco'].'</td>';
            $html .= '<td>'.$media['retinol'].'</td>';
            $html .= '<td>'.$media['re'].'</td>';
            $html .= '<td>'.$media['rae'].'</td>';
            $html .= '<td>'.$media['tiamina'].'</td>';
            $html .= '<td>'.$media['riboflavina'].'</td>';
            $html .= '<td>'.$media['piridoxina'].'</td>';
            $html .= '<td>'.$media['niacina'].'</td>';
            $html .= '<td>'.$media['vitaminaC'].'</td>';
            $html .= '</tr>';

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

    //Funções que retornam consultas ao banco de dados

    //Função para retornar os alimentos selecionados
    public function retornaAlimentosSelecionados($sexo, $curso)
    {
        if ($curso == 0) {
            $selecionados = DB::table('alimentos')
                           ->join('dietas_pacientes', 'alimentos.id', '=', 'dietas_pacientes.id_alimento')
                           ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                           ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                           ->select('alimentos.nome as alimentos_nome', 'alimentos.*' ,
                            'dietas_pacientes.*', 'pacientes.id', 'dietas.nome as dietas_nome', 'dietas.*')
                           ->where('pacientes.sexo', '=', $sexo)
                           ->get();
        }
        else {
            $selecionados = DB::table('alimentos')
                           ->join('dietas_pacientes', 'alimentos.id', '=', 'dietas_pacientes.id_alimento')
                           ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                           ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                           ->select('alimentos.nome as alimentos_nome', 'alimentos.*' ,
                            'dietas_pacientes.*', 'pacientes.id', 'dietas.nome as dietas_nome', 'dietas.*')
                           ->where('pacientes.sexo', '=', $sexo)
                           ->where('pacientes.curso', '=', $curso)
                           ->get();
        }

        return $selecionados;
    }

    //Função para retornar as receitas selecionados
    public function retornaReceitas($sexo, $curso)
    {
        if ($curso == 0) {
            $receitas = DB::table('receitas')
                           ->join('dietas_pacientes', 'receitas.id', '=', 'dietas_pacientes.id_receita')
                           ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                           ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                           ->join('receita_ingredientes', 'receita_ingredientes.id_receitas', '=', 'receitas.id')
                           ->select('receitas.nome as receitas_nome', 'receitas.*' ,
                            'dietas_pacientes.quantidade as dietas_pacientes_quantidade',
                            'dietas_pacientes.*', 'pacientes.id', 'dietas.nome as dietas_nome', 'dietas.*',
                            'receita_ingredientes.*',
                            DB::raw('sum(energiaKcal) as energiaKcal'),
                            DB::raw('sum(energiaKj) as energiaKj'),
                            DB::raw('sum(proteina) as proteina'),
                            DB::raw('sum(lipideos) as lipideos'),
                            DB::raw('sum(colesterol) as colesterol'),
                            DB::raw('sum(carboidrato) as carboidrato'),
                            DB::raw('sum(fibraAlimentar) as fibraAlimentar'),
                            DB::raw('sum(cinzas) as cinzas'),
                            DB::raw('sum(calcio) as calcio'),
                            DB::raw('sum(magnesio) as magnesio'),
                            DB::raw('sum(manganes) as manganes'),
                            DB::raw('sum(fosforo) as fosforo'),
                            DB::raw('sum(ferro) as ferro'),
                            DB::raw('sum(sodio) as sodio'))
                           ->where('pacientes.sexo', '=', $sexo)
                           ->groupBy('receitas.id')
                           ->groupBy('dietas.id')
                           ->get();
        }
        else {
            $receitas = DB::table('receitas')
                           ->join('dietas_pacientes', 'receitas.id', '=', 'dietas_pacientes.id_receita')
                           ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                           ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                           ->join('receita_ingredientes', 'receita_ingredientes.id_receitas', '=', 'receitas.id')
                           ->select('receitas.nome as receitas_nome', 'receitas.*' ,
                            'dietas_pacientes.quantidade as dietas_pacientes_quantidade',
                            'dietas_pacientes.*', 'pacientes.id', 'dietas.nome as dietas_nome', 'dietas.*',
                            'receita_ingredientes.*',
                            DB::raw('sum(energiaKcal) as energiaKcal'),
                            DB::raw('sum(energiaKj) as energiaKj'),
                            DB::raw('sum(proteina) as proteina'),
                            DB::raw('sum(lipideos) as lipideos'),
                            DB::raw('sum(colesterol) as colesterol'),
                            DB::raw('sum(carboidrato) as carboidrato'),
                            DB::raw('sum(fibraAlimentar) as fibraAlimentar'),
                            DB::raw('sum(cinzas) as cinzas'),
                            DB::raw('sum(calcio) as calcio'),
                            DB::raw('sum(magnesio) as magnesio'),
                            DB::raw('sum(manganes) as manganes'),
                            DB::raw('sum(fosforo) as fosforo'),
                            DB::raw('sum(ferro) as ferro'),
                            DB::raw('sum(sodio) as sodio'))
                           ->where('pacientes.sexo', '=', $sexo)
                           ->where('pacientes.curso', '=', $curso)
                           ->groupBy('receitas.id')
                           ->groupBy('dietas.id')
                           ->get();
        }

        return $receitas;
    }

    public function somaTotais($selecionados, $receitas)
    {
        $totais['quantidade'] = $selecionados->sum('quantidade') + $receitas->sum('dietas_pacientes_quantidade');

        $totais['energiaKcal'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['energiaKcal'] = $totais['energiaKcal'] +
            $selecionados[$key]->energiaKcal * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['energiaKcal'] = $totais['energiaKcal'] +
            $receitas[$key]->energiaKcal * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['energiaKj'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['energiaKj'] = $totais['energiaKj'] +
            $selecionados[$key]->energiaKj * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['energiaKj'] = $totais['energiaKj'] +
            $receitas[$key]->energiaKj * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['proteina'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['proteina'] = $totais['proteina'] +
            $selecionados[$key]->proteina * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['proteina'] = $totais['proteina'] +
            $receitas[$key]->proteina * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['lipideos'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['lipideos'] = $totais['lipideos'] +
            $selecionados[$key]->lipideos * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['lipideos'] = $totais['lipideos'] +
            $receitas[$key]->lipideos * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['colesterol'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['colesterol'] = $totais['colesterol'] +
            $selecionados[$key]->colesterol * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['colesterol'] = $totais['colesterol'] +
            $receitas[$key]->colesterol * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['carboidrato'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['carboidrato'] = $totais['carboidrato'] +
            $selecionados[$key]->carboidrato * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['carboidrato'] = $totais['carboidrato'] +
            $receitas[$key]->carboidrato * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['fibraAlimentar'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['fibraAlimentar'] = $totais['fibraAlimentar'] +
            $selecionados[$key]->fibraAlimentar * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['fibraAlimentar'] = $totais['fibraAlimentar'] +
            $receitas[$key]->fibraAlimentar * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['cinzas'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['cinzas'] = $totais['cinzas'] +
            $selecionados[$key]->cinzas * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['cinzas'] = $totais['cinzas'] +
            $receitas[$key]->cinzas * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['calcio'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['calcio'] = $totais['calcio'] +
            $selecionados[$key]->calcio * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['calcio'] = $totais['calcio'] +
            $receitas[$key]->calcio * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['magnesio'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['magnesio'] = $totais['magnesio'] +
            $selecionados[$key]->magnesio * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['magnesio'] = $totais['magnesio'] +
            $receitas[$key]->magnesio * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['manganes'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['manganes'] = $totais['manganes'] +
            $selecionados[$key]->manganes * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['manganes'] = $totais['manganes'] +
            $receitas[$key]->manganes * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['fosforo'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['fosforo'] = $totais['fosforo'] +
            $selecionados[$key]->fosforo * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['fosforo'] = $totais['fosforo'] +
            $receitas[$key]->fosforo * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['ferro'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['ferro'] = $totais['ferro'] +
            $selecionados[$key]->ferro * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['ferro'] = $totais['ferro'] +
            $receitas[$key]->ferro * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['sodio'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['sodio'] = $totais['sodio'] +
            $selecionados[$key]->sodio * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['sodio'] = $totais['sodio'] +
            $receitas[$key]->sodio * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['potassio'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['potassio'] = $totais['potassio'] +
            $selecionados[$key]->potassio * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['potassio'] = $totais['potassio'] +
            $receitas[$key]->potassio * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['cobre'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['cobre'] = $totais['cobre'] +
            $selecionados[$key]->cobre * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['cobre'] = $totais['cobre'] +
            $receitas[$key]->cobre * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['zinco'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['zinco'] = $totais['zinco'] +
            $selecionados[$key]->zinco * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['zinco'] = $totais['zinco'] +
            $receitas[$key]->zinco * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['retinol'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['retinol'] = $totais['retinol'] +
            $selecionados[$key]->retinol * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['retinol'] = $totais['retinol'] +
            $receitas[$key]->retinol * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['re'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['re'] = $totais['re'] +
            $selecionados[$key]->re * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['re'] = $totais['re'] +
            $receitas[$key]->re * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['rae'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['rae'] = $totais['rae'] +
            $selecionados[$key]->rae * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['rae'] = $totais['rae'] +
            $receitas[$key]->rae * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['tiamina'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['tiamina'] = $totais['tiamina'] +
            $selecionados[$key]->tiamina * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['tiamina'] = $totais['tiamina'] +
            $receitas[$key]->tiamina * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['riboflavina'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['riboflavina'] = $totais['riboflavina'] +
            $selecionados[$key]->riboflavina * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['riboflavina'] = $totais['riboflavina'] +
            $receitas[$key]->riboflavina * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['piridoxina'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['piridoxina'] = $totais['piridoxina'] +
            $selecionados[$key]->piridoxina * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['piridoxina'] = $totais['piridoxina'] +
            $receitas[$key]->piridoxina * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['niacina'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['niacina'] = $totais['niacina'] +
            $selecionados[$key]->niacina * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['niacina'] = $totais['niacina'] +
            $receitas[$key]->niacina * $receitas[$key]->dietas_pacientes_quantidade;
        }

        $totais['vitaminaC'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['vitaminaC'] = $totais['vitaminaC'] +
            $selecionados[$key]->vitaminaC * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['vitaminaC'] = $totais['vitaminaC'] +
            $receitas[$key]->vitaminaC * $receitas[$key]->dietas_pacientes_quantidade;
        }

        return $totais;
    }

    public function media($totais, $quantidadeRegistros)
    {
        $totais['quantidade']       = $totais['quantidade']     / $quantidadeRegistros;
        $totais['energiaKcal']      = $totais['energiaKcal']    / $quantidadeRegistros;
        $totais['energiaKj']        = $totais['energiaKj']      / $quantidadeRegistros;
        $totais['proteina']         = $totais['proteina']       / $quantidadeRegistros;
        $totais['lipideos']         = $totais['lipideos']       / $quantidadeRegistros;
        $totais['colesterol']       = $totais['colesterol']     / $quantidadeRegistros;
        $totais['carboidrato']      = $totais['carboidrato']    / $quantidadeRegistros;
        $totais['fibraAlimentar']   = $totais['fibraAlimentar'] / $quantidadeRegistros;
        $totais['cinzas']           = $totais['cinzas']         / $quantidadeRegistros;
        $totais['calcio']           = $totais['calcio']         / $quantidadeRegistros;
        $totais['magnesio']         = $totais['magnesio']       / $quantidadeRegistros;
        $totais['manganes']         = $totais['manganes']       / $quantidadeRegistros;
        $totais['fosforo']          = $totais['fosforo']        / $quantidadeRegistros;
        $totais['ferro']            = $totais['ferro']          / $quantidadeRegistros;
        $totais['sodio']            = $totais['sodio']          / $quantidadeRegistros;
        $totais['potassio']         = $totais['potassio']       / $quantidadeRegistros;
        $totais['cobre']            = $totais['cobre']          / $quantidadeRegistros;
        $totais['zinco']            = $totais['zinco']          / $quantidadeRegistros;
        $totais['retinol']          = $totais['retinol']        / $quantidadeRegistros;
        $totais['re']               = $totais['re']             / $quantidadeRegistros;
        $totais['rae']              = $totais['rae']            / $quantidadeRegistros;
        $totais['tiamina']          = $totais['tiamina']        / $quantidadeRegistros;
        $totais['riboflavina']      = $totais['riboflavina']    / $quantidadeRegistros;
        $totais['piridoxina']       = $totais['piridoxina']     / $quantidadeRegistros;
        $totais['niacina']          = $totais['niacina']        / $quantidadeRegistros;
        $totais['vitaminaC']        = $totais['vitaminaC']      / $quantidadeRegistros;


        return $totais;
    }

    public function selecionadosQuantidade($selecionados)
    {
        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->energiaKcal = $selecionados[$key]->energiaKcal * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->energiaKj = $selecionados[$key]->energiaKj * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->proteina = $selecionados[$key]->proteina * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->lipideos = $selecionados[$key]->lipideos * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->colesterol = $selecionados[$key]->colesterol * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->carboidrato = $selecionados[$key]->carboidrato * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->fibraAlimentar = $selecionados[$key]->fibraAlimentar * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->cizas = $selecionados[$key]->cinzas * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->calcio = $selecionados[$key]->calcio * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->magnesio = $selecionados[$key]->magnesio * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->fosforo = $selecionados[$key]->fosforo * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->ferro = $selecionados[$key]->ferro * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->sodio = $selecionados[$key]->sodio * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->potassio = $selecionados[$key]->potassio * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->cobre = $selecionados[$key]->cobre * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->zinco = $selecionados[$key]->zinco * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->retinol = $selecionados[$key]->retinol * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->re = $selecionados[$key]->re * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->rae = $selecionados[$key]->rae * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->tiamina = $selecionados[$key]->tiamina * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->riboflavina = $selecionados[$key]->riboflavina * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->piridoxina = $selecionados[$key]->piridoxina * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->niacina = $selecionados[$key]->niacina * $selecionados[$key]->quantidade;
        }

        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->vitaminaC = $selecionados[$key]->vitaminaC * $selecionados[$key]->quantidade;
        }

        return $selecionados;
    }

    public function receitasQuantidade($receitas)
    {
        foreach ($receitas as $key => $value) {
            $receitas[$key]->quantidade = $receitas[$key]->quantidade  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->energiaKcal = $receitas[$key]->energiaKcal  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->energiaKj = $receitas[$key]->energiaKj  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->proteina = $receitas[$key]->proteina  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->lipideos = $receitas[$key]->lipideos  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->colesterol = $receitas[$key]->colesterol  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->carboidrato = $receitas[$key]->carboidrato  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->fibraAlimentar = $receitas[$key]->fibraAlimentar  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->cinzas = $receitas[$key]->cinzas  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->calcio = $receitas[$key]->calcio  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->magnesio = $receitas[$key]->magnesio  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->manganes = $receitas[$key]->manganes  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->fosforo = $receitas[$key]->fosforo  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->ferro = $receitas[$key]->ferro  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->sodio = $receitas[$key]->sodio  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->potassio = $receitas[$key]->potassio  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->cobre = $receitas[$key]->cobre  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->zinco = $receitas[$key]->zinco  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->retinol = $receitas[$key]->retinol  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->re = $receitas[$key]->re  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->rae = $receitas[$key]->rae  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->tiamina = $receitas[$key]->tiamina  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->riboflavina = $receitas[$key]->riboflavina  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->piridoxina = $receitas[$key]->piridoxina  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->niacina = $receitas[$key]->niacina  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        foreach ($receitas as $key => $value) {
            $receitas[$key]->vitaminaC = $receitas[$key]->vitaminaC  * $receitas[$key]->dietas_pacientes_quantidade;
        }

        return $receitas;
    }

    public function erroPage()
    {
        echo "<br><br><br><h1 align='center'> Nenhum Registro Encontrado!! </h1>";
        echo "<h1><a type='button' href='javascript:history.back()'
        class='btn btn-primary btn-lg' name='button' style='margin-left:47%;text-decoration:none;'>
        Voltar</a></h1><br><br>";
    }
}
