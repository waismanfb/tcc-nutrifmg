@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<h1 class="text-center">Quantidade de Pacientes: {{$quantidade}}</h1>

@include('layouts.alerts')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 align="center">Valores Médios {{$grupo}}</h3><br>
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
                        <td>{{$media['quantidade']}}</td>
                        <td>{{$media['energiaKcal']}}</td>
                        <td>{{$media['energiaKj']}}</td>
                        <td>{{$media['proteina']}}</td>
                        <td>{{$media['lipideos']}}</td>
                        <td>{{$media['colesterol']}}</td>
                        <td>{{$media['carboidrato']}}</td>
                        <td>{{$media['fibraAlimentar']}}</td>
                        <td>{{$media['cinzas']}}</td>
                        <td>{{$media['calcio']}}</td>
                        <td>{{$media['magnesio']}}</td>
                        <td>{{$media['manganes']}}</td>
                        <td>{{$media['fosforo']}}</td>
                        <td>{{$media['ferro']}}</td>
                        <td>{{$media['sodio']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div><br><br>

<a type="button" href="javascript:history.back()" class="btn btn-primary btn-lg" name="button" style="margin-left:45%;">Voltar</a><br><br>

<a class="btn btn-success" href="{{Route('grupos.exportar' , $grupo)}}" role="button" style="margin-left:45%;"
>&nbsp&nbsp&nbsp Exportar para Excel &nbsp&nbsp&nbsp</a><br>

@endsection
