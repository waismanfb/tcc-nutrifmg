@extends('layouts.menu_topo')

@section('content')

<body class="bg-light">
  <div class=" bg-white container">
    @include('layouts.alerts')
    <form class="border form-horizontal" action="<?php if(isset($paciente)){echo Route('paciente.update', $paciente->id);}else {
      echo Route('paciente.insert');
    } ?>" method="post"  id="contact_form" name="cadastro">
    @csrf
    <fieldset>

      <!-- Form Name -->
      <br><br>


      <legend><center><h2><b>Cadastro de Paciente</b></h2></center></legend>

      <!-- se tiver qualquer erro -->
      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $erro)
            <p>{{$erro}}</p>
          @endforeach
        </div>
      @endif

      <div class="container">
        <div class="col-sm"></div>
        <div class="container col-sm-6">
          <!-- Nome-->
          <div class="form-group">
            <div class="input-group mb-3 ">

              <label class="">Nome&nbsp&nbsp</label>
              <label id="msgNome"></label>
              <div class="input-group ">
                <span class="input-group-text"><i class="material-icons ">person</i></span>
                <input  name="nome" placeholder="Nome do paciente" class="form-control "  type="text" value="<?php if(isset($paciente)){echo $paciente->nome;}else{echo old('nome');} ?>">
              </div>
            </div>
          </div>

          <!-- Sexo -->
          <div class="form-group">
            <div class="input-group mb-3">
              <label class="control-label">Sexo&nbsp&nbsp</label>
              <div class="input-group">

                <span class="input-group-text"><i class="material-icons">wc</i></span>
                <select name="sexo" class="form-control selectpicker">
                  <?php
                  if(isset($paciente) && $paciente->sexo==1){
                    echo "<option selected value='1'>Masculino</option>
                    <option value='2'>Feminino</option>";
                  }elseif (isset($paciente) && $paciente->sexo==2) {
                    echo "<option value='1'>Masculino</option>
                    <option selected value='2'>Feminino</option>";
                  }else {
                    echo "<option value='1'>Masculino</option>
                    <option value='2'>Feminino</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!-- Data nascimento-->

          <div class="form-group">
            <label class="control-label">Data Nascimento</label>
            <div class="input-group mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                <input  name="dataNascimento" placeholder="Data de Nascimento" class="form-control"  type="date" value="<?php if(isset($paciente)){echo $paciente->dataNascimento;}else{echo old('dataNascimento');} ?>">
              </div>
            </div>
          </div>
          <!-- Anos de estudo-->

          <div class="form-group">
            <label class="input-group mb-3" >Escolaridade</label>
            <div class="input-group mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="material-icons">school</i></span>
                <input  name="anosEstudo" placeholder="Anos de estudo" class="form-control"  type="number" value="<?php if(isset($paciente)){echo $paciente->anosEstudo;}else{echo old('anosEstudo');} ?>">
              </div>
            </div>
          </div>

          <!-- Anos de estudo-->

          <div class="form-group">
            <label class="input-group mb-3" >Renda Familiar</label>
            <label id="msgRenda" class="input-group mb-3" ></label>
            <label>
            <div class="input-group mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="material-icons">monetization_on</i></span>
                <input  name="renda" placeholder="Renda" class="form-control" onblur=" return validaRenda(this)"  type="text" value="<?php if(isset($paciente)){echo $paciente->renda;}else{echo old('renda');} ?>">
              </div>
            </div>
          </div>
          <!-- Curso -->
          <div class="form-group">
            <label class="input-group mb-3">Curso</label>
            <div class="">
              <div class="input-group">
                <span class="input-group-text"><i class="material-icons">book</i></span>
                <select name="curso" class="form-control selectpicker">
                  <?php
                  if (isset($paciente) && $paciente->curso==1) {
                    echo "<option  selected value='1'>Nutrição</option>
                    <option value='2'>Agropecuária</option>
                    <option value='3'>Informática</option>";
                  }elseif (isset($paciente) && $paciente->curso==2) {
                    echo "<option value='1'>Nutrição</option>
                    <option selected value='2'>Agropecuária</option>
                    <option value='3'>Informática</option>";
                  }elseif (isset($paciente) && $paciente->curso==3) {
                    echo "<option value='1'>Nutrição</option>
                    <option value='2'>Agropecuária</option>
                    <option selected value='3'>Informática</option>";
                  }else {
                    echo "<option value='1'>Nutrição</option>
                    <option value='2'>Agropecuária</option>
                    <option value='3'>Informática</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!-- Pessoas em casa-->
          <div class="form-group">
            <label class="input-group mb-3" >Pessoas em casa</label>
            <div class="input-group mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="material-icons">perm_identity</i></span>
                <input  name="numPessoasCasa" placeholder="Número de pessoas" class="form-control"  type="number" value="<?php if(isset($paciente)){echo $paciente->numPessoasCasa;}else{echo old('numPessoasCasa');} ?>">
              </div>
            </div>
          </div>
          <!-- Moradia -->
          <div class="form-group">
            <label class="input-group mb-3">Moradia</label>
            <div class="">
              <div class="input-group">
                <span class="input-group-text"><i class="material-icons">home</i></span>
                <select name="moradia" class="form-control selectpicker">
                  <?php
                  if (isset($paciente) && $paciente->moradia==1) {
                    echo "<option selected value='1'>Casa da família</option>
                    <option value='2'>Pensão</option>
                    <option value='3'>República</option>
                    <option value='4'>Hotel</option>
                    <option value='5'>Alojamento</option>";
                  }elseif (isset($paciente) && $paciente->moradia==2) {
                    echo "<option value='1'>Casa da família</option>
                    <option selected value='2'>Pensão</option>
                    <option value='3'>República</option>
                    <option value='4'>Hotel</option>
                    <option value='5'>Alojamento</option>";
                  }elseif (isset($paciente) && $paciente->moradia==3) {
                    echo "<option value='1'>Casa da família</option>
                    <option value='2'>Pensão</option>
                    <option selected value='3'>República</option>
                    <option value='4'>Hotel</option>
                    <option value='5'>Alojamento</option>";
                  }elseif (isset($paciente) && $paciente->moradia==4) {
                    echo "<option value='1'>Casa da família</option>
                    <option value='2'>Pensão</option>
                    <option value='3'>República</option>
                    <option selected value='4'>Hotel</option>
                    <option value='5'>Alojamento</option>";
                  }else {
                    echo "<option value='1'>Casa da família</option>
                    <option value='2'>Pensão</option>
                    <option value='3'>República</option>
                    <option value='4'>Hotel</option>
                    <option value='5'>Alojamento</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
          </div>
          <br>
          <!-- refeições -->
          <div class="form-group" style="display:none;">
            <input type="number" name="numRefeicoes" value="0">
          </div>
          <div class="form-group form-check">
            <label class="input-group mb-3">Refeições que faz no dia:</label>
            <div class="col-md-4 selectContainer">
              <!-- <div class="input-group"> -->
                <input value="1"type="checkbox" class="form-check-input" name="cafe">
                <label class="form-check-label">&nbsp&nbsp&nbsp&nbspCafé</label><br>
                <input value="1" value="1"type="checkbox" class="form-check-input" name="almoco">
                <label class="form-check-label">&nbsp&nbsp&nbsp&nbspAlmoço</label><br>
                <input value="1" value="1"type="checkbox" class="form-check-input" name="janta">
                <label class="form-check-label">&nbsp&nbsp&nbsp&nbspJanta</label>
                <!-- </div> -->
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <label class="input-group mb-3"></label>
              <div class="col-md-2">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-primary" value="enviar" onclick="return validar()">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCadastrar <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
              </div>
            </div>
          </div>
          <div class="col-sm"></div>
        </div>

      </fieldset>
    </form>
  </div>
</div><!-- /.container -->
<script type="text/javascript">



function validaRenda(renda)
{
  const valor = renda.value;
  if(!isNaN(parseFloat(valor)) && isFinite(valor)){
    return;
  }
  else{
    document.getElementById('msgRenda').style.display = "block";
    document.getElementById('msgRenda').innerHTML = "Favor digitar somente números (00.00)";
    document.getElementById('msgRenda').style.color = "red";
    setTimeout(function(){
      document.getElementById('msgRenda').style.display = "none";
    },2000);
    renda.focus();
    return;
  }
}
function validaNome(nome)
{
  const valor = nome.value;
  if(!isNaN(parseFloat(valor)) && isFinite(valor)){
    document.getElementById('msgNome').style.display = "block";
    document.getElementById('msgNome').innerHTML = "Favor digitar apenas letras";
    document.getElementById('msgNome').style.color = "red";
    setTimeout(function(){
      document.getElementById('msgNome').style.display = "none";
    },2000);
    nome.focus();
    return;
  }
  else{
    return;
  }
}

</script>
</body>
@endsection
