@extends('layouts.menu_topo')

@section('content')


<div class="card-group ">
  <div>
    <div class="container">
      <div class="card" style="width: 18rem; background-color:#c1ffb8">
      <div class="card-body">
        <h5 class="card-title font-weight-bold">{{$registros->nome}}</h5>        
      </div>
      <ul class="list-group list-group-flush">       
        <li class="list-group-item">Total de Energia (kcal): {{$registros->totalEnergiaKcal}}</li>
        <li class="list-group-item">Total de Proteína: {{$registros->totalProteina}}</li>
        <li class="list-group-item">Total de Lipídeos: {{$registros->totalLipideos}}</li>       
        <li class="list-group-item">Total de Carboidrato: {{$registros->totalCarboidrato}}</li>       
      </ul>
      <div class="card-body" align="center">
        <a class="btn btn-sm text-danger font-weight-bold" href="{{Route('ingrediente.cadastrar')}}" role="button" style="border: 1px solid black; background-color: white">Inserir Ingredientes</a>
      </div>
    </div>

  </div>
</div>

<div class="card" style="border: 1px solid <?php if ($registros->curso==3){echo "#82b6f5";} else{echo "#a8e89e";}?>; border-radius: 5px;">
  <table class="table table-sm table-striped table-bordered" id="myTable2">
    <thead> 
      <tr align="center">
        <th scope="col">ID do Alimento</th>
        <th scope="col">ID da Receita</th>
        <th scope="col">Nome do Alimento</th>
        <th scope="col">Medida</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Energia (kcal)</th>
        <th scope="col">Proteína</th>
        <th scope="col">Lipídeos</th>
        <th scope="col">Carboidrato</th>
    </tr>
  </thead>
  <tbody>



  </tbody>
</table>
</div>
</div>


@endsection
