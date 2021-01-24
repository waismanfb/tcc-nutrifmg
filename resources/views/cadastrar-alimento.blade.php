@extends('layouts.menu_topo')

@section('content')

<body class="bg-light">
  <div class=" bg-white container">
    @include('layouts.alerts')
    <form class="border form-horizontal" action="<?php if(isset($alimento)){echo Route('alimento.update', $alimento->id);}else {
      echo Route('alimento.insert');
    } ?>" method="post"  id="contact_form" name="cadastro">
    @csrf
    <fieldset>

      <!-- Form Name -->
      <br><br>


      <legend><center><h2><b>Cadastro de Alimentos</b></h2></center></legend>

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
              <label id="alimentoNome"></label>
              <div class="input-group ">
                <input  name="nome" placeholder="Nome do alimento" class="form-control "  type="text" value="<?php if(isset($alimento)){echo $alimento->nome;}else{echo old('nome');} ?>">
              </div>
            </div>
          </div>
          <!-- grupo-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Grupo</label>
              <label id="alimentoGrupo"></label>
              <div class="input-group ">
                <input  name="grupo" placeholder="grupo do Alimento" class="form-control "  type="text" value="<?php if(isset($alimento)){echo $alimento->grupo;}else{echo old('grupo');} ?>">
              </div>
            </div>
          </div>
          <!-- fonte-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Fonte</label>
              <label id="alimentoFonte"></label>
              <div class="input-group ">
                <input  name="fonte" placeholder="Fonte do Alimento" class="form-control "  type="text" value="<?php if(isset($alimento)){echo $alimento->fonte;}else{echo old('fonte');} ?>">
              </div>
            </div>
          </div>
          <!-- Energia (kcal)-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Energia (kcal)</label>
              <label id="alimentoEnergiaKcal"></label>
              <div class="input-group ">
                <input  name="energiaKcal" placeholder="Energia em kcal do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->energiaKcal;}else{echo old('energiaKcal');} ?>">
              </div>
            </div>
          </div>
          <!-- Proteina-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Proteina</label>
              <label id="alimentoProteina"></label>
              <div class="input-group ">
                <input  name="proteina" placeholder="Proteina do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->proteina;}else{echo old('proteina');} ?>">
              </div>
            </div>
          </div>
          <!-- Lipideos-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Lipídeos</label>
              <label id="alimentoLipideos"></label>
              <div class="input-group ">
                <input  name="lipideos" placeholder="Lipideos do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->lipideos;}else{echo old('lipideos');} ?>">
              </div>
            </div>
          </div>
          <!-- Carboidrato-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Carboidrato</label>
              <label id="alimentoCarboidrato"></label>
              <div class="input-group ">
                <input  name="carboidrato" placeholder="Carboidrato do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->carboidrato;}else{echo old('carboidrato');} ?>">
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
