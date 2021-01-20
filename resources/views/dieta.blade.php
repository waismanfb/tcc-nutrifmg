@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/dieta.js') }}"></script>

<script type="text/javascript">
    $(function(){
        $('#id_alimento').selectize();
    });
</script>

<h1 class="text-center">{{$titulo}}</h1>
<h4 class="text-center">Paciente: {{$paciente->nome}}</h4><br>


@include('layouts.alerts')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-center">Digite os alimentos para inserir na dieta:</h4><br>
            <form method="post" action="{{Route('dieta.inserir')}}" id="inserirDieta">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <span>Escolha o Alimento:</span>
                        <select id="id_alimento" required name="id_alimento">
                            <option value="">Escolha um Alimento:</option>
                            @foreach($alimentos as $alimentos)
                                <option value="{{$alimentos->id}}">{{$alimentos->nome}}</option>
                            @endforeach
                        </select><br>
                        <span>Digite a quantidade:</span><br>
                        <input type="number" name="quantidade" min="1" value="" required><br><br><br>
                        <input type="text" name="id_paciente" value="{{$paciente->id}}" hidden>
                        <input type="text" name="tipo_dieta" value="{{$tipo}}" hidden>
                    </div><br><br>
                    <div class="col-12">
                        <button type="submit" class="form-control btn btn-warning">Inserir</button>
                    </div>
                </div>
            </form><br>
        </div>
        <div class="col-lg-6">
                <table class="table table-bordered table-sm"  id="myTable2">
                     <thead class="table" align="center" style="background-color: #a5a3d4">
                        <tr>
                            <th>Nome do Alimento</th>
                            <th>Quantidade</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                            <?php if (isset($selecionados)): ?>
                                @foreach($selecionados as $selecionados)
                                    <tr>
                                        <td>{{$selecionados->alimentos_nome}}</td>
                                        <td>{{$selecionados->quantidade}}</td>
                                        <td><button type="button" class="btn btn-sm btn-excluir"
                                            name="button" style="background-color: #e0372b"
                                            dietas_pacientes_id='{{$selecionados->dietas_pacientes_id}}'
                                            paciente_id='{{$paciente->id}}'
                                            tipo_dieta='{{$tipo}}'
                                            >Excluir</button>
                                        </td>
                                    </tr>
                                @endforeach
                            <?php endif; ?>
                    </tbody>
                </table>
        </div>
    </div>
</div><br><br>

<!-- linha necessaria para passagem do token csrf para o ajax -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<button type="button" class="btn btn-primary btn-lg" name="button" style="margin-left:45%;" id="botaoContinuar">Continuar</button>

<a class="btn btn-lg" href="{{Route('dieta.atualizarDieta', [$tipo ,$paciente->id])}}" id='linkContinuar' role="button" style="background-color: #ffc107" hidden>&nbspContinuar&nbsp</a>

@endsection
