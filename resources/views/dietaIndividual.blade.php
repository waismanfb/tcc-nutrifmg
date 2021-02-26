@extends('layouts.menu_topo')
@section('content')

<div class="container">

  @include('layouts.alerts')

	<form method="post" action="{{Route('paciente.pesquisados')}}">
		@csrf
		<div class="row">
			<div class="col col-md-6">
				<input type="text" class="form-control" name="nome" placeholder="Nome do paciente">
				<input type="text" class="form-control" name="tela" value="" hidden>
			</div>
			<div class="col col-md-2">
				<button type="submit" class="form-control btn btn-secondary">Pesquisar</button>
			</div>
            <div class="col col-md-2">
                <a class="btn btn-success" href="{{Route('dieta.exportar' ,
                [9999, 9999, 9999, 9999])}}" role="button">&nbsp&nbsp&nbsp Exportar Excel &nbsp&nbsp&nbsp</a><br>
			</div>
		</div>
	</form>
</div>
<br>
<br>
<div class="container">
	<table class="table table-bordered table-sm"  id="myTable2">
		<thead class="table" align="center" style="background-color: #a5a3d4">
			<tr>
				<th onclick="sortTable(0)">Nome</th>
				<th onclick="sortTable(1)">Curso</th>
				<th onclick="sortTable(2)">Data Nascimento</th>
				<th>Avaliação Individual</th>
            <th>Inserir Dieta</th>
			</tr>
		</thead>
		<tbody>
			@foreach($registros as $registros)
			<tr>
				<td>{{$registros->nome}}</td>
				<td align="center"><?php if ($registros->curso == 1) {
					echo "Nutrição";
				}
				elseif ($registros->curso == 2) {
					echo "Agropecuária";
				}
				elseif ($registros->curso == 3) {
					echo "Informática";
				}

				?></td>
				<td align="center">{{$registros->dataNascimento}}</td>
				<td align="center">
					<a class="btn btn-sm btn-warning" href="{{Route('dieta.recordatorio', $registros->id)}}" role="button" >&nbspVer Avaliação&nbsp</a>
				</td>
                <td align="center">
					<a class="btn btn-sm btn-primary" href="{{Route('dieta.inserirDieta', [$tipo ,$registros->id])}}" role="button" >&nbspInserir Dieta&nbsp</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>



@endsection
