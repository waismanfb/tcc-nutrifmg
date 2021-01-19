@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<h1 class="text-center">{{$titulo}}</h1>
<h4 class="text-center">Paciente: {{$paciente->nome}}</h4>
<h4 class="text-center">Data da coleta: {{$dataColeta}}</h4><br>

@include('layouts.alerts')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-sm"  id="myTable2">
                <thead class="table" align="center" style="background-color: #a5a3d4">
                    <tr>
                        <th>Nome do Alimento</th>
                        <th>Quantidade</th>
                        <th>Refeição</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php if (isset($selecionados)): ?>
                            @foreach($selecionados as $selecionados)
                                <tr>
                                    <td>{{$selecionados->alimentos_nome}}</td>
                                    <td>{{$selecionados->quantidade}}</td>
                                    <td>{{$selecionados->dietas_nome}}</td>
                                </tr>
                            @endforeach
                        <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><br><br>

<a type="button" href="{{$url}}" class="btn btn-primary btn-lg" name="button" style="margin-left:45%;">{{$botao}}</a>

@endsection
