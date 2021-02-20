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
				<button type="submit"  class="form-control btn btn-secondary">Pesquisar</button>
			</div>
			<div class="col col-md-2">
                <a href="{{Route('receita.cadastrar')}}" class="btn btn-primary" id="b" >Inserir nova receita</a>
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
				<th>Inserir Ingredientes</th>
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
					<a class="btn btn-sm btn-primary" href="{{Route('receita.ingredientes',
                     $registro->id)}}" role="button" >Inserir</a>
                </td>
				<td align="center">
					<a class="btn btn-sm btn-warning" href="{{Route('receita.editar',
                    $registro->id)}}" role="button " >Editar</a>
                </td>
				<td align="center">
                    <button type="button" class="btn btn-sm btn-excluir-receitas"
                        name="button" style="background-color: #e0372b"
                        receita_id='{{$registro->id}}'
                        >Excluir
                    </button>
                </td>
			</tr>
			@endforeach
		</tbody>
  </table>
	<div>
		{{ $registros->links() }}
	</div>
</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">



@endsection
