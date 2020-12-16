@extends('layouts.menu_topo')
@section('content')

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
            <form method="post" action="{{Route('dieta.inserir')}}">
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
                        </tr>
                    </thead>
                    <tbody>
                            <?php if (isset($selecionados)): ?>
                                @foreach($selecionados as $selecionados)
                                    <tr>
                                        <td>{{$selecionados->alimentos_nome}}</td>
                                        <td>{{$selecionados->quantidade}}</td>
                                    </tr>
                                @endforeach
                            <?php endif; ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>

<a class="btn btn-sm" href="{{Route('dieta.atualizarDieta', [$tipo ,$paciente->id])}}" role="button" style="background-color: #ffc107">&nbspContinuar&nbsp</a>

</script>
@endsection
