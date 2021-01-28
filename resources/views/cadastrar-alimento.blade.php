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

          <!-- umidade-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Umidade</label>
              <label id="alimentoUmidade"></label>
              <div class="input-group ">
                <input  name="umidade" placeholder="Umidade do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->umidade;}else{echo old('umidade');} ?>">
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

          <!-- Energia (kj)-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Energia (kj)</label>
              <label id="alimentoEnergiaKj"></label>
              <div class="input-group ">
                <input  name="energiaKj" placeholder="Energia em kj do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->energiaKj;}else{echo old('energiaKj');} ?>">
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

          <!-- Colesterol-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Colesterol</label>
              <label id="alimentoColesterol"></label>
              <div class="input-group ">
                <input  name="colesterol" placeholder="Colesterol do Alimento" class="form-control "  type="text" value="<?php if(isset($alimento)){echo $alimento->colesterol;}else{echo old('colesterol');} ?>">
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
          
          <!-- Fibra Alimentar-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Fibra Alimentar</label>
              <label id="alimentoFibraAlimentar"></label>
              <div class="input-group ">
                <input  name="fibraAlimentar" placeholder="Fibra Alimentar do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->fibraAlimentar;}else{echo old('fibraAlimentar');} ?>">
              </div>
            </div>
          </div>          
          <!-- Cinzas-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Cinzas</label>
              <label id="alimentoCinzas"></label>
              <div class="input-group ">
                <input  name="cinzas" placeholder="Cinzas do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->cinzas;}else{echo old('cinzas');} ?>">
              </div>
            </div>
          </div>          
          <!-- Calcio-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Calcio</label>
              <label id="alimentoCalcio"></label>
              <div class="input-group ">
                <input  name="calcio" placeholder="Calcio do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->calcio;}else{echo old('calcio');} ?>">
              </div>
            </div>
          </div>          
          <!-- Magnesio-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Magnésio</label>
              <label id="alimentoMagnesio"></label>
              <div class="input-group ">
                <input  name="magnesio" placeholder="Magnésio do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->magnesio;}else{echo old('magnesio');} ?>">
              </div>
            </div>
          </div>          
          <!-- Manganes-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Manganês</label>
              <label id="alimentoManganes"></label>
              <div class="input-group ">
                <input  name="manganes" placeholder="Manganes do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->manganes;}else{echo old('manganes');} ?>">
              </div>
            </div>
          </div>          
          <!-- Fósforo-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Fósforo</label>
              <label id="alimentoFosforo"></label>
              <div class="input-group ">
                <input  name="fosforo" placeholder="Fósforo do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->fosforo;}else{echo old('fosforo');} ?>">
              </div>
            </div>
          </div>          
          <!-- Ferro-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Ferro</label>
              <label id="alimentoFerro"></label>
              <div class="input-group ">
                <input  name="ferro" placeholder="Ferro do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->ferro;}else{echo old('ferro');} ?>">
              </div>
            </div>
          </div>          
          <!-- Sódio-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Sódio</label>
              <label id="alimentoSodio"></label>
              <div class="input-group ">
                <input  name="sodio" placeholder="Sodio do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->sodio;}else{echo old('sodio');} ?>">
              </div>
            </div>
          </div>          
          <!-- Potássio-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Potássio</label>
              <label id="alimentoPotassio"></label>
              <div class="input-group ">
                <input  name="potassio" placeholder="Potássio do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->potassio;}else{echo old('potassio');} ?>">
              </div>
            </div>
          </div>          
          <!-- Cobre-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Cobre</label>
              <label id="alimentoCobre"></label>
              <div class="input-group ">
                <input  name="cobre" placeholder="Cobre do Alimento" class="form-control"  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->cobre;}else{echo old('cobre');} ?>">
              </div>
            </div>
          </div>          
          <!-- Zinco-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Zinco</label>
              <label id="alimentoZinco"></label>
              <div class="input-group ">
                <input  name="zinco" placeholder="Zinco do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->zinco;}else{echo old('zinco');} ?>">
              </div>
            </div>
          </div>          
          <!-- Retinol -->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Retinol</label>
              <label id="alimentoRetinol"></label>
              <div class="input-group ">
                <input  name="retinol" placeholder="Retinol do Alimento" class="form-control "  type="text" step="any" value="<?php if(isset($alimento)){echo $alimento->retinol;}else{echo old('retinol');} ?>">
              </div>
            </div>
          </div>  
          <!-- RE-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">RE</label>
              <label id="alimentoRE"></label>
              <div class="input-group ">
                <input  name="re" placeholder="RE do Alimento" class="form-control "  type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->re;}else{echo old('re');} ?>">
              </div>
            </div>
          </div>                    
          <!-- RAE-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">RAE</label>
              <label id="alimentoRAE"></label>
              <div class="input-group ">
                <input  name="rae" placeholder="RAE do Alimento" class="form-control" type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->rae;}else{echo old('rae');} ?>">
              </div>
            </div>
          </div>                    
          <!-- Tiamina-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Tiamina</label>
              <label id="alimentoTiamina"></label>
              <div class="input-group ">
                <input  name="tiamina" placeholder="Tiamina do Alimento" class="form-control" type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->tiamina;}else{echo old('tiamina');} ?>">
              </div>
            </div>
          </div>                    
          <!-- Riboflavina-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Riboflavina</label>
              <label id="alimentoRiboflavina"></label>
              <div class="input-group ">
                <input  name="riboflavina" placeholder="Riboflavina do Alimento" class="form-control" type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->riboflavina;}else{echo old('riboflavina');} ?>">
              </div>
            </div>
          </div>                    
          <!-- Piridoxina-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Piridoxina</label>
              <label id="alimentoPiridoxina"></label>
              <div class="input-group ">
                <input  name="piridoxina" placeholder="Piridoxina do Alimento" class="form-control" type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->piridoxina;}else{echo old('piridoxina');} ?>">
              </div>
            </div>
          </div>                    
          <!-- niacina-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Niacina</label>
              <label id="alimentoNiacina"></label>
              <div class="input-group ">
                <input  name="niacina" placeholder="Niacina do Alimento" class="form-control" type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->niacina;}else{echo old('niacina');} ?>">
              </div>
            </div>
          </div>                    
          <!-- VitaminaC-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">VitaminaC</label>
              <label id="alimentoVitaminaC"></label>
              <div class="input-group ">
                <input  name="vitaminaC" placeholder="VitaminaC do Alimento" class="form-control" type="number" step="any" value="<?php if(isset($alimento)){echo $alimento->vitaminaC;}else{echo old('vitaminaC');} ?>">
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
