@extends('layouts.menu_topo')
@section('content')

<div class="container">

  @include('layouts.alerts')

<h1 class="text-center">Recordatórios cadastrados do(a) paciente:</h1>
<h2 class="text-center">{{$paciente[0]->nome}}</h2><br>

<?php if ($registros->count() != 0) {
    echo '<div class="container">
        	<table class="table table-bordered table-sm"  id="myTable2">
        		<thead class="table" align="center" style="background-color: #a5a3d4">
        			<tr>
        				<th><h4>Data da Avaliação</h4></th>
                        <th><h4>Ver Avaliação</h4></th>
        			</tr>
        		</thead>
        		<tbody>' ?>
        			@foreach($registros as $registros)
        		 <?php	echo '<tr>
        				<td align="center"><h5>'; ?>
        				{{date("d/m/Y", strtotime($registros->data_coleta))}}
                <?php   echo '</h5></td>
                        <td align="center">
                            <a href="'. "/recordatorioPacienteUnico/{$paciente[0]->id}/{$registros->data_coleta}" .'"><button type="button" class="btn btn-sm btn-info"
                             name="button">Ver Avaliação</button></a>
                        </td>
        			</tr>' ?>
                @endforeach
        <?php echo '</tbody>
        	</table>
        </div>';
} else {
        echo "<h3 align='center'>Nenhum recordatorio encontrado!!</h3><br>";
        echo "<div align='center'><a href='javascript:history.back()'><button type='button' class='btn btn-lg btn-primary'
        name='button'>Voltar</button></a></div>";
    }
 ?>

@endsection
