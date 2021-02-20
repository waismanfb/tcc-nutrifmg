@extends('layouts.menu_topo')

@section('content')

<div class="container ">
  <br>
  <div class="row">

    <div class="col-sm-4">
      <div class="card">
        <div class="card-header bg-success bg-gradient  text-white font-weight-bold" style="background: #006837">Pacientes</div>
        <img src="{{url('image/img-paciente.png')}}" class="card-img-top border-bottom" alt="...">        
        <div class="card-body bg-light" >
          <h5 class="card-title font-weight-bold text-dark" align="center">Cadastrar Paciente</h5><br>
          <p class="card-text">Adicione novos pacientes.  (Necessário cadastro para realizar avaliação) </p>
          <br>
          <a href="{{Route('paciente.cadastrar')}}" class="btn btn-success" >Cadastrar

          </a>
        </div>
      </div>


    </div>

    <div class="col-sm-4">

      <div class="card">
        <div class="card-header bg-success text-white font-weight-bold">Avaliação Antopométrica</div>
        <img src="{{url('image/img-antopometrica.png')}}" class="card-img-top border-bottom" alt="...">      
        <div class="card-body bg-light" >
          <h5 class="card-title font-weight-bold text-dark" align="center">Avaliação Antopométrica</h5><br>
          <p class="card-text">Inserir medidas, ver avaliação individual, alterar informações</p>
          <br>
          <a href="{{Route('paciente.pesquisar')}}" class="btn btn-success  " id="b" >Pacientes

          </a>
        </div>
      </div>
    </div>

    <div class="col-sm-4">

      <div class="card">
        <div class="card-header bg-success text-white font-weight-bold">Grupo de Pacientes</div>
        <img src="{{url('image/img-classificações.png')}}" class="card-img-top border-bottom" alt="..."> 
        <div class="card-body bg-light" >
          <h5 class="card-title font-weight-bold text-dark" align="center">Classificações</h5><br>
          <p class="card-text">Estatísticas de grupos de pacientes, separados por sexo e curso</p>
          <br>
          <a href="{{Route('graficos')}}" class="btn btn-success  " id="b" >Consultar

          </a>
        </div>
      </div>
    </div>



    <div class="col-sm-4" style="padding: 30px 15px;">

      <div class="card" >
        <div class="card-header bg-success text-white font-weight-bold">Alimentos </div>
        <img src="{{url('image/img-alimentos.png')}}" class="card-img-top border-bottom" alt="..."> 
        <div class="card-body bg-light" style="padding: 15px">
          <h5 class="card-title font-weight-bold text-dark" align="center">Consultar Alimentos</h5><br>
          <p class="card-text">Incluir novos alimentos no banco de dados, alterar ou excluir alimentos já existentes</p>
          <br>
          <a href="{{Route('alimento.exibir')}}" class="btn btn-success  " id="b" >Alimentos

          </a>
        </div>
      </div>
    </div>


    <div class="col-sm-4" style="padding: 30px 15px;">

      <div class="card" >
        <div class="card-header bg-success text-white font-weight-bold">Receitas</div>
        <img src="{{url('image/img-receitas.png')}}" class="card-img-top border-bottom" alt="..."> 
        <div class="card-body bg-light" style="padding: 15px">
          <h5 class="card-title font-weight-bold text-dark" align="center">Receitas</h5><br>
          <p class="card-text">Incluir novos alimentos no banco de dados, alterar ou excluir alimentos já existentes</p>
          <br>
          <a href="{{Route('receita.exibir')}}" class="btn btn-success  " id="b" >Receitas

          </a>
        </div>
      </div>
    </div>


    <div class="col-sm-4" style="padding: 30px 15px;">
      <div class="card" >
        <div class="card-header bg-success text-white font-weight-bold">Recordatório de 24 Horas</div>
        <img src="{{url('image/img-r24h.png')}}" class="card-img-top border-bottom" alt="..."> 
        <div class="card-body bg-light" style="padding: 15px">
          <h5 class="card-title font-weight-bold text-dark" align="center">Recordatório de 24 Horas</h5><br>
          <p class="card-text">Consulta de recordatórios de 24 horas de pacientes.</p>
          <br>
          <a href="{{Route('dieta.individual')}}" class="btn btn-success  " id="b" >R24h

          </a>
        </div>
      </div>
    </div>


  </div>
</div>
<br>

</div>
@endsection
