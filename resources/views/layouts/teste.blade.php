@extends('layouts.menu_topo')

@section('content')


<div class="card-group ">
  <div>
    <div class="container">
      <div class="card" style="width: 18rem; background-color:#c1ffb8">
      <div class="card-body">
        <h5 class="card-title font-weight-bold">{{$registros->nome}}</h5>
        <p class="card-text"> <?php if ($registros->curso == 1) {
          echo "Curso Técnico em Nutrição e Dietética";
        }
        elseif ($registros->curso == 2) {
          echo "Curso Técnico em Agropecuária";
        } 
        elseif ($registros->curso == 3) {
          echo " Curso Técnico em Informática";
        }

        ?></p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          Sexo: <?php 
          if ($registros->sexo == 1) {
            echo "Masculino";
          }
          else
            echo "Feminino";
          ?>
        </li>
        <li class="list-group-item">Data de Nascimento:
          <?php echo date('d/m/Y', strtotime($registros->dataNascimento)); ?>
        </li>
        <li class="list-group-item">Anos de estudo: {{$registros->anosEstudo}}</li>
        <li class="list-group-item">Renda Familiar: {{$registros->renda}}</li>
        <li class="list-group-item">Pessoas em casa: {{$registros->numPessoasCasa}}</li>
        <li class="list-group-item">Moradia:
          <?php
          if ($registros->moradia == 1) {
            echo "Casa da Família";
          }
          elseif ($registros->moradia == 2) {
            echo "Pensão";
          }
          elseif ($registros->moradia == 3) {
            echo "República";
          }
          elseif ($registros->moradia == 4) {
            echo "Hotel";
          }
          elseif ($registros->moradia == 5) {
            echo "Alojamento";
          }


          ?>
        </li>
      </ul>
      <div class="card-body" align="center">
        <<a class="btn btn-sm text-danger font-weight-bold" href="{{Route('', $registros->id)}}" role="button" style="border: 1px solid black; background-color: white">Editar Informações</a>
      </div>
    </div>

  </div>
</div>

<div class="card" style="border: 1px solid <?php if ($registros->curso==3){echo "#82b6f5";} else{echo "#a8e89e";}?>; border-radius: 5px;">
  <table class="table table-sm table-striped table-bordered" id="myTable2">
    <thead> 
      <tr align="center" style="background-color:<?php 
      if ($registros->curso == 1) {echo "#c1ffb8";}
      elseif ($registros->curso == 2) {echo "#52ba50";}
      elseif ($registros->curso == 3) {echo "#82b6f5";}              
      ?>">
      <th scope="col">Data da Avaliação</th>
      <th scope="col">Imc</th>
      <th scope="col">Classificação</th>
      <th scope="col">Score-z IMC</th>
      <th scope="col">Ei</th>
      <th scope="col">Score-z EI</th>
      <th scope="col">Idade</th>
      <th scope="col">Meses</th>
      <th scope="col">Peso</th>
      <th scope="col">Altura</th>
      <th scope="col">Dobra</th>


    </tr>
  </thead>
  <tbody>

    <?php for ($i=0; $i < count($registros); $i++) { ?>
      <tr align="center">
        <td>{{$registros[$i]->data}}</td>
        <td class="font-weight-bold">{{$registros[$i]->imc}}</td>
        <td><?php print_r( $scorez[$i][2]);?></td>
        <th scope="row"><?php print_r( $scorez[$i][1]);?></th>
        <td><?php print_r( $scoreEi[$i][2]);?></td>
        <th scope="row"><?php print_r( $scoreEi[$i][1]); ?></th>
        <td>{{$registros[$i]->idade}}</td>
        <td><?php print_r( $scorez[$i][3]);?></td>
        <td>{{$registros[$i]->peso}}</td>
        <td>{{$registros[$i]->altura}}</td>
        <td>{{$registros[$i]->pct}}</td>
      </tr>

    <?php } ?>
  </tbody>
</table>
</div>
</div>


@endsection
