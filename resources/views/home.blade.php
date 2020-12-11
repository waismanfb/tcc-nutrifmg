@extends('layouts.menu_topo')

@section('content')

<div class="container ">
  <br>
  <div class="row">

    <div class="col-sm-4">

      <div class="card">
        <div class="card-header bg-secondary text-white">Cadastrar Paciente</div>
        <div class="card-body" style="background-color: #93fae0; ">
          <h5 class="card-title" align="center">Cadastrar Paciente</h5><br>
          <p class="card-text">Adicione novos pacientes.  (Necessário cadastro para realizar avaliação) </p>
          <br>
          <a href="{{Route('paciente.cadastrar')}}" class="btn btn-secondary btn-lg" >Cadastrar
            <i class="material-icons">person_add</i>
          </a>
        </div>
      </div>


    </div>

    <div class="col-sm-4">

      <div class="card">
        <div class="card-header bg-secondary text-white">Paciente Individual</div>
        <div class="card-body " style="background-color: #93fae0;">
          <h5 class="card-title" align="center">Consultar Paciente</h5><br>
          <p class="card-text">Inserir medidas, ver avaliação individual, alterar informações</p>
          <br>
          <a href="{{Route('paciente.pesquisar')}}" class="btn btn-secondary btn-lg " id="b" >Pacientes
            <i class="material-icons">assignment_ind</i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-sm-4">

      <div class="card">
        <div class="card-header bg-secondary text-white">Grupo de Pacientes</div>
        <div class="card-body " style="background-color: #93fae0;">
          <h5 class="card-title" align="center">Classificações</h5><br>
          <p class="card-text">Estatísticas de grupos de pacientes, separados por sexo e curso</p>
          <br>
          <a href="{{Route('graficos')}}" class="btn btn-secondary btn-lg " id="b" >Consultar
            <i class="material-icons">assignment_ind</i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-sm-4" style="padding: 30px 15px;">

      <div class="card" >
        <div class="card-header bg-secondary text-white">Cadastro de Alimentos</div>
        <div class="card-body " style="background-color: #93fae0;padding: 15px">
          <h5 class="card-title" align="center">Cadastro de Alimentos</h5><br>
          <p class="card-text">Incluir novos alimentos no banco de dados, alterar ou excluir alimentos já existentes</p>
          <br>
          <a href="{{Route('alimento.cadastrar')}}" class="btn btn-secondary btn-lg " id="b" >Cadastrar
            <i class="material-icons">assignment_ind</i>
          </a>
        </div>
      </div>
    </div>


  </div>
</div>
<br>

</div>
@endsection
