@extends('layouts.menu_topo')

@section('content')
<div class="container">
  <a href="{{Route('imcIdadeMas')}}">IMC por idade - MASCULINO</a><br>
  <a href="{{Route('imcIdadeFem')}}">IMC por idade - FEMININO</a><br>

  <a href="{{Route('ImcIdadeNutriFem')}}">IMC por idade - NUTRIÇÃO FEMININO</a><br>
  <a href="{{Route('ImcIdadeNutriMas')}}">IMC por idade - NUTRIÇÃO MASCULINO</a><br>

  <a href="{{Route('ImcIdadeAgroFem')}}">IMC por idade - AGROPECUÁRIA FEMININO</a><br>
  <a href="{{Route('ImcIdadeAgroMas')}}">IMC por idade - AGROPECUÁRIA MASCULINO</a><br>

  <a href="{{Route('ImcIdadeInfoFem')}}">IMC por idade - INFORMÁTICA FEMININO</a><br>
  <a href="{{Route('ImcIdadeInfoMas')}}">IMC por idade - INFORMÁTICA MASCULINO</a><br>
</div>

@endsection
