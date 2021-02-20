@extends('layouts.menu_topo')

@section('content')


<div class="container">
  <a  type="button" href="{{url('home')}}" class="btn btn-primary "name="button">Voltar</a><br><br>
    <h3>Avaliação Antropométrica</h3>

  <a href="{{Route('imcIdadeMas')}}">IMC por idade - MASCULINO</a><br>
  <a href="{{Route('imcIdadeFem')}}">IMC por idade - FEMININO</a><br>

  <a href="{{Route('ImcIdadeNutriMas')}}">IMC por idade - NUTRIÇÃO FEMININO</a><br>
  <a href="{{Route('ImcIdadeNutriFem')}}">IMC por idade - NUTRIÇÃO MASCULINO</a><br>

  <a href="{{Route('ImcIdadeAgroFem')}}">IMC por idade - AGROPECUÁRIA FEMININO</a><br>
  <a href="{{Route('ImcIdadeAgroMas')}}">IMC por idade - AGROPECUÁRIA MASCULINO</a><br>

  <a href="{{Route('ImcIdadeInfoFem')}}">IMC por idade - INFORMÁTICA FEMININO</a><br>
  <a href="{{Route('ImcIdadeInfoMas')}}">IMC por idade - INFORMÁTICA MASCULINO</a><br>
</div>

<div class="container"><br><br>

  <h3>Recordatório 24 Horas</h3>

  <a href="{{Route('recordatorioMas')}}">R24h - MASCULINO</a><br>
  <a href="{{Route('recordatorioFem')}}">R24h - FEMININO</a><br>

  <a href="{{Route('recordatorioMasNutri')}}">R24h - NUTRIÇÃO MASCULINO</a><br>
  <a href="{{Route('recordatorioFemNutri')}}">R24h - NUTRIÇÃO FEMININO</a><br>

  <a href="{{Route('recordatorioAgroMas')}}">R24h - AGROPECUÁRIA MASCULINO</a><br>
  <a href="{{Route('recordatorioAgroFem')}}">R24h - AGROPECUÁRIA FEMININO</a><br>

  <a href="{{Route('recordatorioInfoMas')}}">R24h - INFORMÁTICA MASCULINO</a><br>
  <a href="{{Route('recordatorioInfoFem')}}">R24h - INFORMÁTICA FEMININO</a><br>
</div>

<br><br>




@endsection
