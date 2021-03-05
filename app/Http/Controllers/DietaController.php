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

class DietaController extends Controller
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

    public function atualizarDieta($tipo, $id)
    {
        $paciente = Paciente::find($id);

        if ($tipo == 'cafeDaManha')
        {
            $tipoId = 2;
            $tipo = 'lancheDaManha';
            $titulo = 'Lanche da Manha';
        }
        else if ($tipo == 'lancheDaManha')
        {
            $tipoId = 3;
            $tipo = 'almoco';
            $titulo = 'Almoço';
        }
        else if ($tipo == 'almoco')
        {
            $tipoId = 4;
            $tipo = 'lancheDaTarde';
            $titulo = 'Lanche da Tarde';
        }
        else if ($tipo == 'lancheDaTarde')
        {
            $tipoId = 5;
            $tipo = 'jantar';
            $titulo = 'Jantar';
        }
        else if ($tipo == 'jantar')
        {
            $tipoId = 6;
            $tipo = 'lancheDaNoite';
            $titulo = 'Lanche Da Noite';
        }
        else
        {
            $dataColeta = Carbon::today()->toDateString();
            $selecionados = $this->retornaAlimentosSelecionados($id, $dataColeta, 0);
            $receitas = $this->retornaReceitas($id, $dataColeta, 0);
            $totais = $this->somaTotais($selecionados, $receitas);

            $dataColetaFormatada = Carbon::parse($dataColeta)->format('d/m/Y');

            $tela = 1; //tela apresentada no final do recordatorio 24 horas

            $botao = 'Concluir Avaliação';
            $url = '/home';

            $dieta = 0;

            $titulo = 'Lista de Alimentos Selecionados';

            return view('lista_dieta', [
                'totais' => $totais,
                'dataColeta' => $dataColeta,
                'dataColetaFormatada' => $dataColetaFormatada,
                'tela' => $tela,
                'titulo' => $titulo,
                'receitas' => $receitas,
                'paciente' => $paciente,
                'selecionados' => $selecionados,
                'botao' => $botao,
                'dieta' => $dieta,
                'url' => $url,
                'titulo' => $titulo
            ]);
        }

        $alimentos = Alimento::all();
        $receitas = Receita::all();
        $tipoDieta = $tipo;

        $selecionados = $this->retornaSelecionados($id, $tipoId);

        $alimentosReceitas = $alimentos->concat($receitas);

        return view('dieta', [
            'alimentosReceitas' => $alimentosReceitas,
            'paciente' => $paciente,
            'selecionados' => $selecionados,
            'tipo' => $tipoDieta,
            'titulo' => $titulo
        ]);
    }

    public function inserir(Request $request)
    {
        $dados = $request->All();
        $dados['data_coleta'] = Carbon::now();
        $tipoDieta = $request['tipo_dieta'];

        if ($request['id_alimento_receita'] > 1000) {
            $dados['id_receita'] = $request['id_alimento_receita'];
        }
        else {
            $dados['id_alimento'] = $request['id_alimento_receita'];
        }

        if ($tipoDieta == 'cafeDaManha')
        {
            $tipoId = 1;
            $dados['id_dieta'] = 1;
            $titulo = 'Café Da Manhã';
        }
        else if ($tipoDieta == 'lancheDaManha')
        {
            $tipoId = 2;
            $dados['id_dieta'] = 2;
            $titulo = 'Lanche Da Manhã';
        }
        else if ($tipoDieta == 'almoco')
        {
            $tipoId = 3;
            $dados['id_dieta'] = 3;
            $titulo = 'Almoco';
        }
        else if ($tipoDieta == 'lancheDaTarde')
        {
            $tipoId = 4;
            $dados['id_dieta'] = 4;
            $titulo = 'Lanche Da Tarde';
        }
        else if ($tipoDieta == 'jantar')
        {
            $tipoId = 5;
            $dados['id_dieta'] = 5;
            $titulo = 'Jantar';
        }
        else if ($tipoDieta == 'lancheDaNoite')
        {
            $tipoId = 6;
            $dados['id_dieta'] = 6;
            $titulo = 'Lanche Da Noite';
        }

        echo $request['id_dieta'];

        $resposta = DietasPaciente::create($dados);
        $alimentos = Alimento::all();
        $receitas = Receita::all();
        $paciente = Paciente::find($dados['id_paciente']);
        $id = $dados['id_paciente'];

        return $this->inserirDieta($tipoDieta, $id);
    }

    //Funcão para excluir um Alimento Selecionado
    public function excluirAlimentoSelecionado()
    {
        $dietas_pacientes_id = $_POST['dietas_pacientes_id'];
        $paciente_id = $_POST['paciente_id'];
        $tipo_dieta = $_POST['tipo_dieta'];
        DB::table('dietas_pacientes')->where('id', '=', $dietas_pacientes_id)->delete();
        return $this->inserirDieta($tipo_dieta, $paciente_id);
    }


    public function inserirDieta($tipo, $id)
    {
        if ($tipo == 'cafeDaManha')
        {
            $tipoId = 1;
            $request['id_dieta'] = 1;
            $titulo = 'Café Da Manhã';
        }
        else if ($tipo == 'lancheDaManha')
        {
            $tipoId = 2;
            $request['id_dieta'] = 2;
            $titulo = 'Lanche da Manha';
        }
        else if ($tipo == 'almoco')
        {
            $tipoId = 3;
            $request['id_dieta'] = 3;
            $titulo = 'Almoco';
        }
        else if ($tipo == 'lancheDaTarde')
        {
            $tipoId = 4;
            $request['id_dieta'] = 4;
            $titulo = 'Lanche Da Tarde';
        }
        else if ($tipo == 'jantar')
        {
            $tipoId = 5;
            $request['id_dieta'] = 5;
            $titulo = 'Jantar';
        }
        else if ($tipo == 'lancheDaNoite')
        {
            $tipoId = 6;
            $request['id_dieta'] = 6;
            $titulo = 'Lanche Da Noite';
        }


        $paciente = Paciente::find($id);
        $alimentos = Alimento::all();
        $receitas = Receita::all();
        $tipoDieta = $tipo;

        $selecionados = $this->retornaSelecionados($id, $tipoId);
        $receitasSelecionadas = $this->retornaReceitasSelecionadas($id, $tipoId);

        $alimentosReceitas = $alimentos->concat($receitas);

        return view('dieta', [
            'alimentosReceitas'     => $alimentosReceitas,
            'paciente'              => $paciente,
            'selecionados'          => $selecionados,
            'receitasSelecionadas'  => $receitasSelecionadas,
            'tipo'                  => $tipoDieta,
            'titulo'                => $titulo
        ]);
    }

    public function recordatorio($id)
    {
        $paciente = DB::table('pacientes')
                     ->select('pacientes.*')
                     ->where('pacientes.id', '=', $id)
                     ->get();

        $registros = DB::table('dietas_pacientes')
                     ->select('dietas_pacientes.data_coleta')
                     ->where('dietas_pacientes.id_paciente', '=', $id)
                     ->groupby('data_coleta')->distinct()->orderby('data_coleta', 'desc')
                     ->get();

        return view('pacienteRecordatorio', [
            'paciente'  => $paciente,
            'registros' => $registros
        ]);
    }

    public function dietaIndividual()
    {
        $registros = Paciente::all();
        $tipo = 'cafeDaManha';

        return view('dietaIndividual', compact('registros', 'tipo'));
    }

    public function recordatorioUnico($id, $data)
    {
        $selecionados = $this->retornaAlimentosSelecionados($id, $data, 0);
        $receitas = $this->retornaReceitas($id, $data, 0);
        $totais = $this->somaTotais($selecionados, $receitas);

        $paciente = Paciente::find($id);

        $dataColeta = $data;


        $tela = 2; //tela de recordatorio 24 de pacientes por data

        $dataColetaFormatada = Carbon::parse($data)->format('d/m/Y');
        $botao = 'Voltar';
        $url = "javascript:history.back()";

        $titulo = 'Lista de Alimentos Selecionados';

        $dieta = 0;

        return view('lista_dieta', [
            'dataColeta' => $dataColeta,
            'dataColetaFormatada' => $dataColetaFormatada,
            'titulo' => $titulo,
            'tela' => $tela,
            'paciente' => $paciente,
            'selecionados' => $selecionados,
            'receitas' => $receitas,
            'totais' => $totais,
            'dieta' => $dieta,
            'botao' => $botao,
            'url' => $url
        ]);
    }

    public function escolherDieta($id, $data)
    {
        $paciente = Paciente::find($id);
        $dataColeta = $data;
        $url = "javascript:history.back()";
        $botao = 'Voltar';

        return view('escolherDieta', [
            'paciente' => $paciente,
            'data' => $data,
            'botao' => $botao,
            'url' => $url
        ]);
    }

    public function dietaUnico($id, $data)
    {
        return view('escolhaDietaPacienteUnico', [
            'id' => $id,
            'data' => $data
        ]);
    }

    public function dietaPacienteUnicoController($id, $data, $dieta)
    {
        $selecionados = $this->retornaAlimentosSelecionados($id, $data, $dieta);
        $receitas = $this->retornaReceitas($id, $data, $dieta);
        $totais = $this->somaTotais($selecionados, $receitas);

        $paciente = Paciente::find($id);

        $dataColeta = $data;
        $dataColetaFormatada = Carbon::parse($data)->format('d/m/Y');
        $botao = 'Voltar';
        $url = "javascript:history.back()";

        $tela = 3; //tela onde mostra a dieta do paciente de acordo com o tipo

        $titulo = 'Lista de Alimentos Selecionados';

        if (!$selecionados->isEmpty() or !$receitas->isEmpty()) {
            $totais                = $this->somaTotais($selecionados, $receitas);

            return view('lista_dieta', [
                'dataColeta' => $dataColeta,
                'dataColetaFormatada' => $dataColetaFormatada,
                'tela' => $tela,
                'titulo' => $titulo,
                'paciente' => $paciente,
                'selecionados' => $selecionados,
                'receitas' => $receitas,
                'totais' => $totais,
                'dieta' => $dieta,
                'botao' => $botao,
                'url' => $url
            ]);
        }
        else{
            return view('error');
        }
    }

    //Funções que retornam consultas ao banco de dados

    //Função para retornar os alimentos selecionados
    public function retornaAlimentosSelecionados($id, $data, $dieta)
    {
        $query = DB::table('alimentos')
                       ->join('dietas_pacientes', 'alimentos.id', '=', 'dietas_pacientes.id_alimento')
                       ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                       ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                       ->select('alimentos.nome as alimentos_nome', 'alimentos.*' ,
                        'dietas_pacientes.*', 'pacientes.id', 'dietas.nome as dietas_nome', 'dietas.*')
                       ->where('dietas_pacientes.id_paciente', '=', $id);

          if ($data != 0) {
              $query = $query->whereDate('data_coleta', '=', $data);
          }

          if ($dieta != 0) {
              $query = $query->where('dietas.id', '=', $dieta);
          }

          $selecionados = $query->get();

        return $selecionados;
    }

    //Função para retornar as receitas selecionados
    public function retornaReceitas($id, $data, $dieta)
    {
        $query = DB::table('receitas')
                       ->join('dietas_pacientes', 'receitas.id', '=', 'dietas_pacientes.id_receita')
                       ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                       ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                       ->join('receita_ingredientes', 'receita_ingredientes.id_receitas', '=', 'receitas.id')
                       ->select('receitas.nome as receitas_nome', 'receitas.*' ,
                        'dietas_pacientes.quantidade as dietas_pacientes_quantidade',
                        'dietas_pacientes.*', 'pacientes.id', 'dietas.nome as dietas_nome', 'dietas.*',
                        'receita_ingredientes.*',
                        DB::raw('sum(umidade) as umidade'),
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
                        DB::raw('sum(sodio) as sodio'),
                        DB::raw('sum(potassio) as potassio'),
                        DB::raw('sum(cobre) as cobre'),
                        DB::raw('sum(zinco) as zinco'),
                        DB::raw('sum(retinol) as retinol'),
                        DB::raw('sum(re) as re'),
                        DB::raw('sum(rae) as rae'),
                        DB::raw('sum(tiamina) as tiamina'),
                        DB::raw('sum(riboflavina) as riboflavina'),
                        DB::raw('sum(piridoxina) as piridoxina'),
                        DB::raw('sum(niacina) as niacina'),
                        DB::raw('sum(vitaminaC) as vitaminaC'))
                       ->where('dietas_pacientes.id_paciente', '=', $id);

        if ($data != 0) {
            $query = $query->whereDate('data_coleta', '=', $data);
        }
        if ($dieta != 0) {
            $query = $query->where('dietas.id', '=', $dieta);
        }

                       $query = $query->groupBy('receitas.id');
                       $query = $query->groupBy('dietas.id');
        $receitas =    $query->get();

        return $receitas;
    }

    //Função para retornar os alimentos selecionados de acordo com a dieta
    public function retornaSelecionados($id, $tipoId)
    {
        $selecionados = DB::table('alimentos')
                       ->join('dietas_pacientes', 'alimentos.id', '=', 'dietas_pacientes.id_alimento')
                       ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                       ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                       ->select('alimentos.nome as alimentos_nome', 'alimentos.*' , 'dietas_pacientes.*',
                       'dietas_pacientes.id as dietas_pacientes_id', 'pacientes.id', 'dietas.*')
                       ->where('dietas_pacientes.id_paciente', '=', $id)
                       ->where('dietas_pacientes.id_dieta', '=', $tipoId)
                       ->whereDate('data_coleta', '=', Carbon::today()->toDateString())
                       ->get();

        return $selecionados;
    }

    //Função para retornar as receitas selecionados de acordo com a dieta
    public function retornaReceitasSelecionadas($id, $tipoId)
    {
        $receitasSelecionadas = DB::table('receitas')
                               ->join('dietas_pacientes', 'receitas.id', '=', 'dietas_pacientes.id_receita')
                               ->join('pacientes', 'dietas_pacientes.id_paciente', '=', 'pacientes.id')
                               ->join('dietas', 'dietas.id', '=', 'dietas_pacientes.id_dieta')
                               ->select('receitas.nome as receitas_nome', 'receitas.*' , 'dietas_pacientes.*',
                               'dietas_pacientes.id as dietas_pacientes_id', 'pacientes.id', 'dietas.*')
                               ->where('dietas_pacientes.id_paciente', '=', $id)
                               ->where('dietas_pacientes.id_dieta', '=', $tipoId)
                               ->whereDate('data_coleta', '=', Carbon::today()->toDateString())
                               ->get();

        return $receitasSelecionadas;
    }

    public function somaTotais($selecionados, $receitas)
    {
        $totais['quantidade'] = $selecionados->sum('quantidade') + $receitas->sum('dietas_pacientes_quantidade');

        $totais['umidade'] = 0;
        foreach ($selecionados as $key => $value) {
            $totais['umidade'] = $totais['umidade'] +
            $selecionados[$key]->umidade * $selecionados[$key]->quantidade;
        }
        foreach ($receitas as $key => $value) {
            $totais['umidade'] = $totais['umidade'] +
            $receitas[$key]->umidade * $receitas[$key]->dietas_pacientes_quantidade;
        }

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

    public function selecionadosQuantidade($selecionados)
    {
        foreach ($selecionados as $key => $value) {
            $selecionados[$key]->umidade = $selecionados[$key]->umidade * $selecionados[$key]->quantidade;
        }

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
            $receitas[$key]->umidade = $receitas[$key]->umidade  * $receitas[$key]->dietas_pacientes_quantidade;
        }

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
}
