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
			</div>
			<div class="col col-md-4">
				<a href="{{Route('alimento.cadastrar')}}" class="btn btn-success" id="b" >Inserir novo alimento</a>		
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
				<th onclick="sortTable(1)">Tipo</th>
				<th onclick="sortTable(2)">Grupo</th>
				<th>Energia (Kcal)</th>
				<th>Proteinas</th>
				<th>Carboidrato</th>
            <th>Lipideos</th>
				<th>Editar info. Alimento</th>
				<th>Excluir Alimento</th>
			</tr>
		</thead>
		<tbody>
			@foreach($registros as $registros)
			<tr>
				<td>{{$registros->nome}}</td>
				<td>{{$registros->tipo}}</td>
				<td>{{$registros->grupo}}</td>
				<td>{{$registros->energiaKcal}}</td>
				<td>{{$registros->proteina}}</td>
				<td>{{$registros->carboidrato}}</td>
				<td>{{$registros->lipideos}}</td>

				<td align="center">
					<a class="btn btn-sm" href="{{Route('alimento.editarAlimento', $registros->id)}}" role="button" style="background-color: #ffc107">Editar</a>
        </td>
				<td align="center">
					<a class="btn btn-sm" href="{{Route('alimento.delete', $registros->id)}}" role="button" style="background-color: #ed7f64">Excluir</a>
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