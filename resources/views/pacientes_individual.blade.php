@extends('layouts.menu_topo')
@section('content')

<div class="container">

  @include('layouts.alerts')

	<form method="post" action="{{Route('paciente.pesquisados')}}">
		@csrf
		<div class="row">
			<div class="col col-md-6">
				<input type="text" class="form-control" name="nome" placeholder="Nome do paciente">
			</div>
			<div class="col col-md-2">
				<button type="submit" class="form-control btn btn-warning">Pesquisar</button>
                <a class="btn btn-success" href="{{Route('paciente.exportar')}}" role="button">&nbsp&nbsp&nbsp Exportar Excel &nbsp&nbsp&nbsp</a><br>
			</div>
		</div>
	</form>
</div>
<br>
<br>
<div class="container">
  <p>Clique sobre o nome da coluna para ordenar</p>
	<table class="table table-bordered table-sm"  id="myTable2">
		<thead class="table" align="center" style="background-color: #a5a3d4">
			<tr>
				<th onclick="sortTable(0)">Nome</th>
				<th onclick="sortTable(1)">Curso</th>
				<th onclick="sortTable(2)">Data Nascimento</th>
				<th>Avaliação Individual</th>
				<th>Inserir Medidas</th>
				<th>Editar info. Paciente</th>
				<th>Cadastro de Dietas</th>
                <th>Recordátorio 24H</th>
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
					<a class="btn btn-sm" href="{{Route('paciente.exibir', $registros->id)}}" role="button" style="background-color: #4fc266">&nbspInserir&nbsp</a>
				</td>
				<td align="center">
					<a class="btn btn-sm" href="{{Route('paciente.avaliacao', $registros->id)}}" role="button" style="background-color: #7e79fc">Individual</a>
				</td>
				<td align="center">
					<a class="btn btn-sm" href="{{Route('paciente.editar', $registros->id)}}" role="button" style="background-color: #ed7f64">&nbspEditar&nbsp</a>
				</td>
                <td align="center">
					<a class="btn btn-sm" href="{{Route('dieta.inserirDieta', [$tipo ,$registros->id])}}" role="button" style="background-color: #ffc107">&nbspInserir Dieta&nbsp</a>
				</td>
                <td align="center">
					<a class="btn btn-sm" href="{{Route('dieta.recordatorio', $registros->id)}}" role="button" style="background-color: #ffc107">&nbspR24H&nbsp</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<script type="text/javascript">

	function sortTable(n) {
		var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		table = document.getElementById("myTable2");
		switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
      	if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
      }
  } else if (dir == "desc") {
  	if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
      }
  }
}
if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
  } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
      	dir = "desc";
      	switching = true;
      }
  }
}
}


</script>



@endsection
