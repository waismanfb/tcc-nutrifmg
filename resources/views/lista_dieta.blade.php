@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<h1 class="text-center">{{$titulo}}</h1>
<h4 class="text-center">Paciente: {{$paciente->nome}}</h4>
<h4 class="text-center">Data da coleta: {{$dataColetaFormatada}}</h4><br>

@include('layouts.alerts')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-4">
            <h3 align="center" >Valores Totais Consumidos nas Últimas 24h</h3>
            <table class="table table-striped table-dark"  id="myTable2">
                <thead align="center" >
                    <tr ><th>Quantidade </th><td>{{$totais['quantidade']}}</td></tr>
                    {{-- <tr><th>Umidade</th><td>{{$totais['umidade']}}</td></tr> --}}
                    <tr><th>Energia (Kcal)</th><td>{{$totais['energiaKcal']}}</td></tr>
                    <tr><th>Energia (KJ)</th><td>{{$totais['energiaKj']}}</td></tr>
                    <tr><th>Proteina</th><td>{{$totais['proteina']}}</td></tr>
                    <tr><th>Lipídeos</th><td>{{$totais['lipideos']}}</td></tr>
                    <tr><th>Colesterol</th><td>{{$totais['colesterol']}}</td></tr>
                    <tr><th>Carboidratos</th><td>{{$totais['carboidrato']}}</td></tr>
                    <tr><th>Fibra Alimentar</th> <td>{{$totais['fibraAlimentar']}}</td></tr>
                    <tr><th>Cinzas</th><td>{{$totais['cinzas']}}</td></tr>
                    <tr><th>Cálcio</th><td>{{$totais['calcio']}}</td></tr>
                    <tr><th>Magnésio</th><td>{{$totais['magnesio']}}</td></tr>
                    <tr><th>Manganês</th><td>{{$totais['manganes']}}</td></tr>
                    <tr><th>Fósforo</th><td>{{$totais['fosforo']}}</td></tr>
                    <tr><th>Ferro</th><td>{{$totais['ferro']}}</td></tr>
                    <tr><th>Sódio</th> <td>{{$totais['sodio']}}</td></tr>
                    <tr><th>Potássio</th> <td>{{$totais['potassio']}}</td></tr>
                    <tr><th>Cobre</th> <td>{{$totais['cobre']}}</td></tr>
                    <tr><th>Zinco</th> <td>{{$totais['zinco']}}</td></tr>
                    <tr><th>Retinol</th> <td>{{$totais['retinol']}}</td></tr>
                    <tr><th>RE</th> <td>{{$totais['re']}}</td></tr>
                    <tr><th>RAE</th> <td>{{$totais['rae']}}</td></tr>
                    <tr><th>Tiamina</th> <td>{{$totais['tiamina']}}</td></tr>
                    <tr><th>Riboflavina</th> <td>{{$totais['riboflavina']}}</td></tr>
                    <tr><th>Piridoxina</th> <td>{{$totais['piridoxina']}}</td></tr>
                    <tr><th>Niacina</th> <td>{{$totais['niacina']}}</td></tr>
                    <tr><th>VitaminaC</th> <td>{{$totais['vitaminaC']}}</td></tr>
    <div class="row">
        <div class="col-lg-12">
            <h3 align="center">Valores Totais</h3>
            <table class="table table-bordered table-sm"  id="myTable2">
                <thead class="table thead-dark table-striped table-hover"
                 align="center" style="background-color: #a5a3d4">
                    <tr>
                        
                    </tr>
                </thead>
            </table>
        </div>

        <div class="col-lg-6">
            <h3 align="center">Alimentos Consumidos nas Ultimas 24h</h3>
            <table class="table table-bordered table-sm table-striped table-hover"  id="myTable2">
                <thead class="table" align="center" style="background-color: #454d55; color:white">
                    <tr>
                        <th>Nome do Alimento</th>
                        <th>Quantidade</th>
                        <th>Nome da Dieta</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php if (isset($selecionados)): ?>
                            @foreach($selecionados as $selecionados)
                                <tr>
                                    <td>{{$selecionados->alimentos_nome}}</td>
                                    <td>{{$selecionados->quantidade}}</td>
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
    <div class="row">

    </div>
</div><br><br>

<a type="button" href="{{$url}}" class="btn btn-primary btn-lg" name="button" style="margin-left:45%;">{{$botao}}</a><br><br>

<a class="btn btn-success" href="{{Route('dieta.exportar' , [$paciente->id, $dataColeta, $tela, $dieta])}}"
    role="button" style="margin-left:45%;"
>&nbsp&nbsp&nbsp Exportar para Excel &nbsp&nbsp&nbsp</a><br>

@endsection
