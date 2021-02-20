@extends('layouts.app')

@section('content')

<div class="container ">
  <div class="row justify-content-center ">
    <div class="col-md-6 " >
      <div class="card " >
        <div class="card-header text-white bg-success font-weight-bold" >{{ __('LOGIN') }}</div>
        <div class="card-body"  align="center" style="padding-bottom:60px">
          <img src="{{url('image/logo-new.png')}}" class="img-fluid " alt="Responsive image" style="padding: 20px">
        </div>
        <div class="card-body ">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row justify-content-center">           
              <div class="col-md-8">
                <input placeholder="E-mail" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row justify-content-center">             
              <div class="col-md-8">
                <input placeholder="Senha" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" >

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>d
                @enderror
              </div>
            </div>

            <div class="form-group row justify-content-center">
              <div class="col-md-6 offset-md-4">
                <!-- <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    {{ __('Lembrar senha') }}
                  </label>
                </div> -->
              </div>
            </div>

            <div class="form-group row justify-content-center">
              <div class="col-md-8 text-center" style="color: #495057 " >
                <p style="margin: 0">GNU GENERAL PUBLIC LICENSE</p>
                <p>Version 3, 29 June 2007</p>
              </div>
            </div>

            <div class="form-group row justify-content-center">
              
              <div class=" col col-md-8 ">
                <button type="submit" class="btn btn-success  btn-block " align="center"  >
                  <strong>{{ __('Entrar') }}</strong>
                </button>

                <!-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Esqueceu sua senha?') }}
                </a>
                @endif -->
              </div>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
