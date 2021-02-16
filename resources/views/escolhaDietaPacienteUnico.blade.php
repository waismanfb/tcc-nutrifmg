@extends('layouts.menu_topo')

@section('content')

<h3 align="center">Por Favor, Selecione uma Dieta:</h3>

<div class="container ">
  <br>


  <div class="row">
    <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" height="180px" src="{{asset('imagensDietas/cafeManha.jpg')}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Café da Manhã</h5>
                <a href="{{Route('dieta.dietaPacienteUnicoController', [$id, $data, 1])}}" class="btn btn-primary">Ver</a>
            </div>
        </div>
     </div>

     <div class="col-sm-4">
         <div class="card" style="width: 18rem;">
             <img class="card-img-top" height="180px" src="{{asset('imagensDietas/lancheManha.jpg')}}" alt="Card image cap">
             <div class="card-body">
                 <h5 class="card-title">Lanche da Manhã</h5>
                 <a href="{{Route('dieta.dietaPacienteUnicoController', [$id, $data, 2])}}" class="btn btn-primary">Ver</a>
             </div>
         </div>
      </div>

      <div class="col-sm-4">
          <div class="card" style="width: 18rem;">
              <img class="card-img-top" height="180px" src="{{asset('imagensDietas/almoco.jpg')}}" alt="Card image cap">
              <div class="card-body">
                  <h5 class="card-title">Almoço</h5>
                  <a href="{{Route('dieta.dietaPacienteUnicoController', [$id, $data, 3])}}" class="btn btn-primary">Ver</a>
              </div>
          </div>
       </div>
   </div><br><br>

   <div class="row">
     <div class="col-sm-4">
         <div class="card" style="width: 18rem;">
             <img class="card-img-top" height="180px" src="{{asset('imagensDietas/lancheTarde.jpg')}}" alt="Card image cap">
             <div class="card-body">
                 <h5 class="card-title">Lanche da Tarde</h5>
                 <a href="{{Route('dieta.dietaPacienteUnicoController', [$id, $data, 4])}}" class="btn btn-primary">Ver</a>
             </div>
         </div>
      </div>

      <div class="col-sm-4">
          <div class="card" style="width: 18rem;">
              <img class="card-img-top" height="180px" src="{{asset('imagensDietas/jantar.jpg')}}" alt="Card image cap">
              <div class="card-body">
                  <h5 class="card-title">Jantar</h5>
                  <a href="{{Route('dieta.dietaPacienteUnicoController', [$id, $data, 5])}}" class="btn btn-primary">Ver</a>
              </div>
          </div>
       </div>

       <div class="col-sm-4">
           <div class="card" style="width: 18rem;">
               <img class="card-img-top" height="180px" src="{{asset('imagensDietas/lancheNoite.jpg')}}" alt="Card image cap">
               <div class="card-body">
                   <h5 class="card-title">Lanche da Noite</h5>
                   <a href="{{Route('dieta.dietaPacienteUnicoController', [$id, $data, 6])}}" class="btn btn-primary">Ver</a>
               </div>
           </div>
        </div>
    </div>

</div>
<br>

</div>

<div align='center'><a href='javascript:history.back()'><button type='button' class='btn btn-lg btn-primary'
name='button'>Voltar</button></a></div>
@endsection
