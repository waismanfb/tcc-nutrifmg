@extends('layouts.menu_topo')

@section('content')
<div class="container" style="width:400px; margin:auto">
  <form  method="post" action="{{Route('paciente.insert')}}">
    @csrf
    <div class="form-group">
      <label>Nome:</label>
      <input type="text" name="nome" class="form-control"  placeholder="">
    </div>
     <div class="form-group">
      <label>Sexo:</label>
      <select class="custom-select" name="sexo" >
        <option value="1" selected>Masculino</option>
        <option value="2">Feminino</option>
      </select>
    </div>
    <div class="form-group">
      <label>Data de Nascimento:</label>
      <input type="date" name="dataNascimento" class="form-control"  placeholder="">
    </div>
    <div class="form-group">
      <label>Escolaridade em Anos de Estudo:</label>
      <input type="number" name="anosEstudo" class="form-control"  placeholder="">
      <small>Quantidade de anos que você estudou</small>
    </div>
    <div class="form-group">
      <label>Renda Familiar:</label>
      <input type="number" name="renda" class="form-control"  placeholder="">
    </div>
    <div class="form-group">
      <label>Curso que faz:</label>
      <select class="custom-select" name="curso">
        <option value="1" selected>Curso 1</option>
        <option value="2">Curso 2</option>
      </select>
    </div>
    <div class="form-group">
      <label>Número de pessoas que moram em casa:</label>
      <input type="number" name="numPessoasCasa" class="form-control"  placeholder="">
    </div>
    <div class="form-group">
      <label>Moradia:</label>
      <select class="custom-select" name="moradia">
        <option value="1" selected>Casa da Família</option>
        <option value="2">Pensão</option>
        <option value="3">República</option>
        <option value="4">Hotel</option>
        <option value="5">Alojamento</option>
      </select>
    </div>
    <div class="form-group" style="display:none;">
      <input type="number" name="numRefeicoes" value="0">
    </div>
    <div class="form-group form-check">
      <label>Refeições que faz no dia:</label><br>
      <input value="1"type="checkbox" class="form-check-input" name="cafe">
      <label class="form-check-label">Café</label><br>
      <input value="1" value="1"type="checkbox" class="form-check-input" name="almoco">
      <label class="form-check-label">Almoço</label><br>
      <input value="1" value="1"type="checkbox" class="form-check-input" name="janta">
      <label class="form-check-label">Janta</label><br>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>

</div>
@endsection
