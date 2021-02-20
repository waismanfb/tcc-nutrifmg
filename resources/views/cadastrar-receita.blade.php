@extends('layouts.menu_topo')

@section('content')

<body class="bg-light">
  <div class=" bg-white container">
    @include('layouts.alerts')
    <form class="border form-horizontal" action="<?php if(isset($receita)){echo Route('receita.update', $receita->id);}else {
      echo Route('receita.insert');
    } ?>" method="post"  id="contact_form" name="cadastro">
    @csrf
    <div class="row">
			<div class="col col-md-2">
				<a href="{{Route('receita.exibir')}}" class="btn btn-primary" style="margin: 10px">Voltar</a>
			</div>
		</div>
    <fieldset>

      <!-- Form Name -->
      <br><br>


      <legend><center><h2><b><?php if(!isset($receita)){echo "Cadastro de Receitas";}else {
        echo "Editar Receita";
      } ?></b></h2></center></legend>

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
          <!-- Quantidade Total em gramas-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Peso Total da receita</label>
              <label id="receitaQuantidadeTotal"></label>
              <div class="input-group ">
                <input  name="quantidadeTotal" placeholder="Quantidade total da receita em gramas" class="form-control "  type="number" step="any" value="<?php if(isset($receita)){echo $receita->quantidadeTotal;}else{echo old('quantidadeTotal');} ?>">
              </div>
            </div>
          </div>
          <!-- Quantidade da porção em gramas-->
          <div class="form-group">
            <div class="input-group mb-3 ">
              <label class="">Peso da porção em gramas</label>
              <label id="receitaQuantidadePorcao"></label>
              <div class="input-group ">
                <input  name="quantidadePorcao" placeholder="Peso da porção em gramas" class="form-control "  type="number" step="any" value="<?php if(isset($receita)){echo $receita->quantidadePorcao;}else{echo old('quantidadePorcao');} ?>">
              </div>
            </div>
          </div>

            <!-- Button -->
            <div class="form-group">
              <label class="input-group mb-3"></label>
              
                <button type="submit" class="btn btn-primary" value="enviar" onclick="return validar()">
                    <?php if(!isset($receita)){echo "Cadastrar Receita";}else {
                      echo "Editar Receita";
                    } ?>
                  
             
            </div>
          </div>
          <div class="col-sm"></div>
        </div>

      </fieldset>
    </form>
  </div>
</div><!-- /.container -->

</body>
@endsection
