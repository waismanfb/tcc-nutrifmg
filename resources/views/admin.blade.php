@extends('layouts.menu_topo')
@section('content')

<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>

@include('layouts.alerts')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 align="center">Lista de Administradores</h3><br>
            <table class="table table-bordered table-sm"  id="myTable2">
                <thead class="table thead-dark table-striped table-hover"
                 align="center" style="background-color: #a5a3d4">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($admins as $admins)
                    <tr>
                        <th>{{$admins->name}}</th>
                        <th>{{$admins->email}}</th>
                        <th>
                            <button type="button" class="btn btn-sm btn-excluir-admin"
                                name="button" style="background-color: #e0372b;"
                                id='{{$admins->id}}'
                                >Excluir
                            </button>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><br><br>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<a type="button" href="javascript:history.back()" class="btn btn-primary btn-lg" name="button" style="margin-left:45%;">Voltar</a><br><br>

@endsection
