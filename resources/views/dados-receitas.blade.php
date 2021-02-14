@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/receitas.js') }}"></script>

<div class="container">

  @include('layouts.alerts')

	<form method="post" action="{{Route('receita.pesquisada')}}">
		@csrf
		<div class="row">
			<div class="col col-md-8">
				<input type="text" class="form-control" name="nome" placeholder="Nome da receita">
			</div>
			<div class="col col-md-2">
				<button type="submit"  class="form-control btn btn-primary">Pesquisar</button>
			</div>
			<div class="col col-md-2">
                <a href="{{Route('receita.cadastrar')}}" class="btn btn-success" id="b" >Inserir nova receita</a>
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
				<th>Peso total da receita (em gramas)</th>
				<th>Peso total da porção (em gramas)</th>
				<th>Vizualizar</th>
				<th>Editar</th>
                <th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach($registros as $registro)
			<tr>
				<td align="center">{{$registro->nome}}</td>
				<td align="center">{{$registro->quantidadeTotal}}</td>
				<td align="center">{{$registro->quantidadePorcao}}</td>
                <td align="center">
					<a class="btn btn-sm" href="{{Route('receita.ingredientes',
                     $registro->id)}}" role="button" style="background-color: #ffc107">Vizualizar</a>
                </td>
				<td align="center">
					<a class="btn btn-sm" href="{{Route('receita.editar',
                    $registro->id)}}" role="button" style="background-color: #007bff; color: white">Editar</a>
                </td>
				<td align="center">
                    <a id="btn-excluir-receitas" class="btn btn-sm" href="#" role="button"
                     style="background-color: #ed7f64">Excluir</a>
					<a id="btn-excluir-receitas-confirmation" hidden class="btn btn-sm"
                     href="{{Route('receita.delete', $registro->id)}}"
                         role="button" style="background-color: #ed7f64">Excluir</a>
                </td>
			</tr>
			@endforeach
		</tbody>
  </table>
	<div>
		{{ $registros->links() }}
	</div>
</div>



@endsection
