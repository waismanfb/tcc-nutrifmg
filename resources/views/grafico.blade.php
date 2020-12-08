@extends('layouts.menu_topo')

@section('content')

<html>
<body>
<div class="container">
  <a class="btn btn-primary" href="{{Route('graficos')}}" role="button">Voltar</a>

  <div class="row">
    <div class="col-8">
      <div class="" style="width:70%; height:700px; margin-left:100px">
        {!! $grafico->container() !!}
      </div>
    </div>

    <div class="col-4" style="width:15%"><br><br><br>
      <p>Total de Pacientes: {{$porcentagem[0]}}</p>
      <p>Pacientes com Eutrofia(Normal): {{$porcentagem[1]}}%</p>
      <p>Pacientes com Magreza Acentuada: {{$porcentagem[2]}}%</p>
      <p>Pacientes com Magreza: {{$porcentagem[3]}}%</p>
      <p>Pacientes com Sobrepeso: {{$porcentagem[4]}}%</p>
      <p>Pacientes com Obesidade: {{$porcentagem[5]}}%</p>
      <p>Pacientes com Obesidade Grave: {{$porcentagem[6]}}%</p>
    </div>
  </div>
</div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset=utf-8></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
        <script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
        <script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.7/c3.min.js"></script>
        {!! $grafico->script() !!}
    </body>
</html>

@endsection
