@extends('layouts.menu_topo')

@section('content')

<script type="text/javascript" src="{{ URL::asset('js/alimentos_receitas.js') }}"></script>


<div class="card-group ">
  <div>
    <div class="container">
      <div class="card" style="width: 18rem; background-color:#c1ffb8">
      <div class="card-body">
        <h5 class="card-title font-weight-bold text-center ">{{$registros->nome}}</h5>
      </div>
      <ul class="list-group list-group-flush ">
        <li class="list-group-item">Total de Energia (kcal): {{$totalEnergia}}</li>

        <li class="list-group-item">Total de Proteína: {{$totalProteina}}</li>
        <li class="list-group-item">Total de Lipídeos: {{$totalLipideos}}</li>
        <li class="list-group-item">Total de Carboidrato: {{$totalCarboidrato}}</li>
      </ul>
      <div class="card-body" align="center">
        <a class="btn btn-success" href="{{Route('ingrediente.cadastrar', $registros->id)}}" role="button">Inserir Ingredientes</a>
      </div>
  </div>
  </div>
</div>
<div class="card" style="border: 1px solid <?php if ($registros->curso==3) {
    echo "#82b6f5";
} else {
    echo "#a8e89e";
}?>; border-radius: 5px;">
  <table class="table table-sm table-striped table-bordered" id="myTable2">
    <thead>
      <tr align="center">
        <th scope="col">Nome do Alimento</th>
        <th scope="col">Medida</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Remover Alimento</th>

    </tr>
  </thead>
  <tbody>
      @foreach($alimentos as $alimentos)
			<tr align="center">
				<td>{{$alimentos->nome}}</td>
                <td>{{$alimentos->medida}}</td>
                <td>{{$alimentos->quantidade}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-excluir-ingrediente-receitas"
                        name="button" style="background-color: #e0372b"
                        receita_id='{{$idReceita}}'
                        id='{{$alimentos->id}}'
                        >Excluir
                    </button>
                </td>
			</tr>
		@endforeach
  </tbody>
</table>
</div>
</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@endsection
