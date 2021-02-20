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
        
        <li class="list-group-item">Total de Umidade: {{$totalUmidade}}</li>
        <li class="list-group-item">Total de Energia (kcal): {{$totalEnergiaKcal}}</li>
        <li class="list-group-item">Total de Energia (kj): {{$totalEnergiaKj}}</li>
        <li class="list-group-item">Total de Proteína: {{$totalProteina}}</li>
        <li class="list-group-item">Total de Lipídeos: {{$totalLipideos}}</li>
        <li class="list-group-item">Total de Colesterol: {{$totalColesterol}}</li>
        <li class="list-group-item">Total de Fibra Alimentar: {{$totalFibraAlimentar}}</li>
        <li class="list-group-item">Total de Cinzas: {{$totalCinzas}}</li>
        <li class="list-group-item">Total de Cálcio: {{$totalCalcio}}</li>
        <li class="list-group-item">Total de Magnésio: {{$totalMagnesio}}</li>
        <li class="list-group-item">Total de Maganês: {{$totalManganes}}</li>
        <li class="list-group-item">Total de Fósforo: {{$totalFosforo}}</li>
        <li class="list-group-item">Total de Ferro: {{$totalFerro}}</li>
        <li class="list-group-item">Total de Sódio: {{$totalSodio}}</li>
        <li class="list-group-item">Total de Potássio: {{$totalPotassio}}</li>
        <li class="list-group-item">Total de Cobre: {{$totalCobre}}</li>
        <li class="list-group-item">Total de Zinco: {{$totalZinco}}</li>
        <li class="list-group-item">Total de Retinol: {{$totalRetinol}}</li>
        <li class="list-group-item">Total de Re: {{$totalRe}}</li>
        <li class="list-group-item">Total de Rae: {{$totalRae}}</li>
        <li class="list-group-item">Total de Tiamina: {{$totalTiamina}}</li>
        <li class="list-group-item">Total de Riboflavina: {{$totalRiboflavina}}</li>
        <li class="list-group-item">Total de Piridoxina: {{$totalPiridoxina}}</li>
        <li class="list-group-item">Total de Niacina: {{$totalNiacina}}</li>
        <li class="list-group-item">Total de VitaminaC: {{$totalVitaminaC}}</li>

      </ul>
      <div class="card-body" align="center">
        <a class="btn btn-primary" href="{{Route('ingrediente.cadastrar', $registros->id)}}" role="button">Inserir Ingredientes</a>
      </div>
  </div>
  </div>
</div>

<div class="card" style="border: 1px solid <?php if ($registros->curso==3) {
    echo "#82b6f5";
} else {
    echo "#a8e89e";
}?>; border-radius: 5px;">
    <div class="row">
			<div class="col col-md-2">
				<a href="{{Route('receita.exibir')}}" class="btn btn-primary" style="margin: 10px">Voltar</a>
			</div>

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
