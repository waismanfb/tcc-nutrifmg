@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<h1 class="text-center">{{$titulo}}</h1>
<h4 class="text-center">Paciente: {{$paciente->nome}}</h4>
<h4 class="text-center">Data da coleta: {{$dataColeta}}</h4><br>

@include('layouts.alerts')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 align="center">Valores Totais</h3>
            <table class="table table-bordered table-sm"  id="myTable2">
                <thead class="table thead-dark table-striped table-hover"
                 align="center" style="background-color: #a5a3d4">
                    <tr>
                        <th>Quantidade</th>
                        <th>Kcal</th>
                        <th>KJ</th>
                        <th>Proteina</th>
                        <th>Lipídeos</th>
                        <th>Colesterol</th>
                        <th>Carboidratos</th>
                        <th>Fibra Alimentar</th>
                        <th>Cinzas</th>
                        <th>Cálcio</th>
                        <th>Magnésio</th>
                        <th>Manganês</th>
                        <th>Fósforo</th>
                        <th>Ferro</th>
                        <th>Sódio</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>{{$totais['quantidade']}}</td>
                        <td>{{$totais['energiaKcal']}}</td>
                        <td>{{$totais['energiaKj']}}</td>
                        <td>{{$totais['proteina']}}</td>
                        <td>{{$totais['lipideos']}}</td>
                        <td>{{$totais['colesterol']}}</td>
                        <td>{{$totais['carboidrato']}}</td>
                        <td>{{$totais['fibraAlimentar']}}</td>
                        <td>{{$totais['cinzas']}}</td>
                        <td>{{$totais['calcio']}}</td>
                        <td>{{$totais['magnesio']}}</td>
                        <td>{{$totais['manganes']}}</td>
                        <td>{{$totais['fosforo']}}</td>
                        <td>{{$totais['ferro']}}</td>
                        <td>{{$totais['sodio']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 align="center">Alimentos Selecionados</h3>
            <table class="table table-bordered table-sm table-striped table-hover"  id="myTable2">
                <thead class="table" align="center" style="background-color: #a5a3d4">
                    <tr>
                        <th>Nome do Alimento</th>
                        <th>Quantidade</th>
                        <th>Kcal</th>
                        <th>KJ</th>
                        <th>Proteina</th>
                        <th>Lipídeos</th>
                        <th>Colesterol</th>
                        <th>Carboidratos</th>
                        <th>Fibra Alimentar</th>
                        <th>Cinzas</th>
                        <th>Cálcio</th>
                        <th>Magnésio</th>
                        <th>Manganês</th>
                        <th>Fósforo</th>
                        <th>Ferro</th>
                        <th>Sódio</th>
                        <th>Nome da Dieta</ht>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php if (isset($selecionados)): ?>
                            @foreach($selecionados as $selecionados)
                                <tr>
                                    <td>{{$selecionados->alimentos_nome}}</td>
                                    <td>{{$selecionados->quantidade}}</td>
                                    <td>{{$selecionados->energiaKcal * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->energiaKj * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->proteina * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->lipideos * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->colesterol * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->carboidrato * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->fibraAlimentar * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->cinzas * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->calcio * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->magnesio * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->manganes * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->fosforo * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->ferro * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->sodio * $selecionados->quantidade}}</td>
                                    <td>{{$selecionados->dietas_nome}}</td>
                                </tr>
                            @endforeach
                        <?php endif; ?>
                        <?php if (isset($receitas)): ?>
                            @foreach($receitas as $receitas)
                                <tr>
                                    <td>{{$receitas->receitas_nome}}</td>
                                    <td>{{$receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->energiaKcal * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->energiaKj * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->proteina * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->lipideos * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->colesterol * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->carboidrato * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->fibraAlimentar * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->cinzas * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->calcio * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->magnesio * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->manganes * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->fosforo * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->ferro * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->sodio * $receitas->dietas_pacientes_quantidade}}</td>
                                    <td>{{$receitas->nome}}</td>
                                </tr>
                            @endforeach
                        <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><br><br>

<a type="button" href="{{$url}}" class="btn btn-primary btn-lg" name="button" style="margin-left:45%;">{{$botao}}</a>

@endsection
