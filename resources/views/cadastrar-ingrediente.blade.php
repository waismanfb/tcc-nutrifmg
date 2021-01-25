@extends('layouts.menu_topo')

@section('content')

<body class="bg-light">
  <div class=" bg-white container">
    @include('layouts.alerts')
    <form class="border form-horizontal" action="<?php if(isset($ingrediente)){echo Route('ingrediente.update', $ingrediente->id);}else {
      echo Route('ingrediente.insert');
    } ?>" method="post"  id="contact_form" name="cadastro">
    @csrf
    <fieldset>

      <!-- Form Name -->
      <br><br>


      <legend><center><h2><b>Cadastro de Ingredientes:  </b></h2></center></legend>

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
              <label class="">Nome:</label><br>
              <label id="ingredienteNome"></label>

              <select id="id_alimento" required name="id_alimento">
               <option>Escolha um Alimento:</option><br>
               @foreach($alimentos as $alimentos)
                   <option value="{{$alimentos->id}}">{{$alimentos->nome}}</option>
               @endforeach
               </select><br>

            </div>
          </div>
          <!-- Medida -->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Medida</label>
              <label id="ingredienteMedida"></label>
              <div class="input-group ">
                <input  name="medida" placeholder="Medida em gramas" class="form-control "  type="number" step="any" value="<?php if(isset($ingrediente)){echo $ingrediente->medida;}else{echo old('medida');} ?>">
              </div>
            </div>
          </div>
          <!-- Quantidade -->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Quantidade</label>
              <label id="ingredienteQuantidade"></label>
              <div class="input-group ">
                <input  name="quantidade" placeholder="Quantidade" class="form-control "  type="number" step="any" value="<?php if(isset($ingrediente)){echo $ingrediente->quantidade;}else{echo old('quantidade');} ?>">
              </div>
            </div>
          </div>

          <input type="number" name="id_receitas" value="{{$id}}" hidden>

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
