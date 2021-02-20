@extends('layouts.menu_topo')

@section('content')

    <script type="text/javascript">
        $(function() {
            $('#id_alimento').selectize();
        });

    </script>

    <body class="bg-light">
        <div class=" bg-white container">

            @include('layouts.alerts')

            <form class="border form-horizontal" action="<?php if (isset($ingrediente)) {
            echo Route('ingrediente.update', $ingrediente->id);
        } else {
            echo Route('ingrediente.insert');
        } ?>" method="post" id="contact_form" name="cadastro">
                @csrf
                <div class="row">
                    <div class="col col-md-2">
                        <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin: 10px">Voltar</a>
                    </div>
                </div>
                <fieldset>

                    <!-- Form Name -->
                    <br><br>


                    <legend>
                        <center>
                            <h2><b>Cadastro de Ingredientes: </b></h2>
                        </center>
                    </legend>

                    <!-- se tiver qualquer erro -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $erro)
                                <p>{{ $erro }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="container-fluid">
                        <div class="row"></div>
                        <div class="container col-sm-6">
                            <!-- Nome-->
                            <div class="form-group">
                                <label class="">Nome:</label>
                                <label id="ingredienteNome"></label>

                                <select id="id_alimento" required name="id_alimento">
                                    <option>Escolha um Alimento:</option><br>
                                    @foreach ($alimentos as $alimentos)
                                        <option value="{{ $alimentos->id }}">{{ $alimentos->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Medida -->
                            <div class="form-group">
                                <div class="input-group mb-3 ">
                                    <label class="">Medida</label>
                                    <label id="ingredienteMedida"></label>
                                    <div class="input-group ">
                                        <input name="medida" placeholder="Medida em gramas" required class="form-control "
                                            type="number" step="any" value="<?php if (isset($ingrediente)) {
                        echo $ingrediente->medida;
                    } else {
                        echo old('medida');
                    } ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Quantidade -->
                            <div class="form-group">
                                <div class="input-group mb-3 ">
                                    <label class="">Quantidade</label>
                                    <label id="ingredienteQuantidade"></label>
                                    <div class="input-group ">
                                        <input name="quantidade" placeholder="Quantidade" required class="form-control"
                                            min="1" type="number" step="any" value="<?php if (isset($ingrediente)) {
                        echo $ingrediente->quantidade;
                    } else {
                        echo old('quantidade');
                    } ?>">
                                    </div>
                                </div>
                            </div>

                            <input type="number" name="id_receitas" value="{{ $id }}" hidden>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="input-group mb-3"></label>

                                <button type="submit" class="btn btn-primary" value="enviar"
                                    onclick="return validar()">Cadastrar Ingrediente</button>

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
