@extends('layouts.menu_topo')

@section('content')




<div class="container" style="width:500px">

	<h2>Adicionar dados do paciente {{$registros->nome}}</h2>
	<form class="form" action="{{Route('avaliacao.insert')}}" method="post">
		@csrf
		<div class="form-group">
			  <input type="number" name="id_paciente" class="form-control" value="{{$registros->id}}" style="display:none">
		</div>
		<div class="form-group">
      <label>Data da coleta dos dados:</label>
      <input type="date" name="data" class="form-control"  placeholder="">
    </div>
		<div class="form-group">
      <label>Peso (kg):</label>
      <input type="text" name="peso" class="form-control" >
			<small></small>
    </div>
		<div class="form-group">
      <label>Altura (centímetros):</label>
      <input type="text" name="altura" class="form-control"  placeholder="">
			<small></small>
    </div>
		<div class="form-group">
      <label>Dobras:</label>
      <input type="text" name="pct" class="form-control"  placeholder="">
			<small>Não é obrigatório.</small>
    </div>
		<br>
		<button type="submit" class="btn btn-primary">Salvar</button>

	</form>
</div>


@endsection
