@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<h1 class="text-center">Quantidade de Pacientes: {{$quantidade}}</h1>

@include('layouts.alerts')

<div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-4">    
        <h3 align="center">Valores Médios {{$grupo}}</h3><br>      
        <table class="table table-striped table-dark"  id="myTable2">                
            <thead align="center" >                    
                <tr ><th>Total de Pacientes </th><td> {{$quantidade}}</td></tr>
                {{-- <tr><th>Umidade</th><td>{{$media['umidade']}}</td></tr> --}}
                <tr><th>Energia (Kcal)</th><td>{{$media['energiaKcal']}}</td></tr>
                <tr><th>Energia (KJ)</th><td>{{$media['energiaKj']}}</td></tr>
                <tr><th>Proteina</th><td>{{$media['proteina']}}</td></tr>
                <tr><th>Lipídeos</th><td>{{$media['lipideos']}}</td></tr>
                <tr><th>Colesterol</th><td>{{$media['colesterol']}}</td></tr>
                <tr><th>Carboidratos</th><td>{{$media['carboidrato']}}</td></tr>
                <tr><th>Fibra Alimentar</th> <td>{{$media['fibraAlimentar']}}</td></tr>
                <tr><th>Cinzas</th><td>{{$media['cinzas']}}</td></tr>
                <tr><th>Cálcio</th><td>{{$media['calcio']}}</td></tr>
                <tr><th>Magnésio</th><td>{{$media['magnesio']}}</td></tr>
                <tr><th>Manganês</th><td>{{$media['manganes']}}</td></tr>
                <tr><th>Fósforo</th><td>{{$media['fosforo']}}</td></tr>
                <tr><th>Ferro</th><td>{{$media['ferro']}}</td></tr>
                <tr><th>Sódio</th> <td>{{$media['sodio']}}</td></tr>              
                <tr><th>Potássio</th> <td>{{$media['potassio']}}</td></tr>              
                <tr><th>Cobre</th> <td>{{$media['cobre']}}</td></tr>              
                <tr><th>Zinco</th> <td>{{$media['zinco']}}</td></tr>              
                <tr><th>Retinol</th> <td>{{$media['retinol']}}</td></tr>              
                <tr><th>RE</th> <td>{{$media['re']}}</td></tr>              
                <tr><th>RAE</th> <td>{{$media['rae']}}</td></tr>              
                <tr><th>Tiamina</th> <td>{{$media['tiamina']}}</td></tr>              
                <tr><th>Riboflavina</th> <td>{{$media['riboflavina']}}</td></tr>              
                <tr><th>Piridoxina</th> <td>{{$media['piridoxina']}}</td></tr>              
                <tr><th>Niacina</th> <td>{{$media['niacina']}}</td></tr>              
                <tr><th>VitaminaC</th> <td>{{$media['vitaminaC']}}</td></tr>             
            </thead>
        </table>
    </div> 
    </div>   
    <div class="row">
        <div class="col-lg-12">
            <h3 align="center">Valores Médios {{$grupo}}</h3><br>
            <table class="table table-bordered table-sm"  id="myTable2">
                <thead class="table thead-dark table-striped table-hover"
                 align="center" style="background-color: #a5a3d4">
                    <tr>
                        <th>Quantidade</th>
                        <th>Umidade</th>
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
                        <td>{{$media['umidade']}}</td>
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
