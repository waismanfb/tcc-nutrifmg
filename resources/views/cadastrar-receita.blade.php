@extends('layouts.menu_topo')

@section('content')

<body class="bg-light">
  <div class=" bg-white container">
    @include('layouts.alerts')
    <form class="border form-horizontal" action="<?php if(isset($receita)){echo Route('receita.update', $receita->id);}else {
      echo Route('receita.insert');
    } ?>" method="post"  id="contact_form" name="cadastro">
    @csrf
    <fieldset>

      <!-- Form Name -->
      <br><br>


      <legend><center><h2><b>Cadastro de Receitas</b></h2></center></legend>

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
              <label class="">Nome </label>
              <label id="receitaNome"></label>
              <div class="input-group ">
                <input  name="nome" placeholder="Nome da Receita" class="form-control "  type="text" value="<?php if(isset($receita)){echo $receita->nome;}else{echo old('nome');} ?>">
              </div>
            </div>
          </div>
          <!-- Energia (kcal)-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Energia (kcal)</label>
              <label id="receitaEnergiaKcal"></label>
              <div class="input-group ">
                <input  name="energiaKcal" placeholder="Energia em kcal da Receita" class="form-control "  type="number" step="any" value="<?php if(isset($receita)){echo $receita->totalEnergiaKcal;}else{echo old('totalEnergiaKcal');} ?>">
              </div>
            </div>
          </div>
          <!-- Proteina-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Proteina</label>
              <label id="receitaProteina"></label>
              <div class="input-group ">
                <input  name="proteina" placeholder="Proteina da Receita" class="form-control "  type="number" step="any" value="<?php if(isset($receita)){echo $receita->totalProteina;}else{echo old('totalProteina');} ?>">
              </div>
            </div>
          </div>
          <!-- Lipideos-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Lipídeos</label>
              <label id="receitaLipideos"></label>
              <div class="input-group ">
                <input  name="lipideos" placeholder="Lipideos da Receita" class="form-control "  type="number" step="any" value="<?php if(isset($receita)){echo $receita->totalLipideos;}else{echo old('totalLipideos');} ?>">
              </div>
            </div>
          </div>

          <!-- Carboidrato-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Carboidrato</label>
              <label id="receitaCarboidrato"></label>
              <div class="input-group ">
                <input  name="carboidrato" placeholder="Carboidrato da Receita" class="form-control "  type="number" step="any" value="<?php if(isset($receita)){echo $receita->totalCarboidrato;}else{echo old('totalCarboidrato');} ?>">
              </div>
            </div>
          </div>          


         
         

            <!-- Button -->
            <div class="form-group">
              <label class="input-group mb-3"></label>
              <div class="col-md-2">
                <button type="submit" class="btn btn-success" value="enviar" onclick="return validar()">Cadastrar <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
              </div>
            </div>
          </div>
          <div class="col-sm"></div>
        </div>

      </fieldset>
    </form>
  </div>
</div><!-- /.container -->

<!-- <script type="text/javascript">



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

</script>-->
</body>
@endsection
