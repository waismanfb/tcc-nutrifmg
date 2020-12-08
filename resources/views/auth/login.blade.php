@extends('layouts.app')

@section('content')

<div class="container ">
  <div class="row justify-content-center ">
    <div class="col-md-6 bg-light">
      <div class="card ">
        <div class="card-header text-white bg-secondary" >{{ __('Login') }}</div>
        <div class="card-body"  align="center" >
          <img src="{{url('image/logo.png')}}" class="img-fluid " alt="Responsive image" style="max-width: 250px">
        </div>
        <div class="card-body ">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right"><strong>{{ __('USUÁRIO') }}</strong></label>

              <div class="col-md-6">

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border:none; border-bottom: 2px solid black; border-radius: 90px  ">
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right"><strong>{{ __('SENHA') }}</strong></label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border:none; border-bottom: 2px solid black; border-radius: 90px  ">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>d
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <!-- <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    {{ __('Lembrar senha') }}
                  </label>
                </div> -->
              </div>
            </div>

            <div class="form-group row ">
              <div class="col "></div>
              <div class=" col col-md-4 ">
                <button type="submit" class="btn btn-success btn-lg btn-block " align="center" style="border-radius: 50px; ">
                  <strong>{{ __('Entrar') }}</strong>
                </button>

                <!-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Esqueceu sua senha?') }}
                </a>
                @endif -->
              </div>
              <div class="col "></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
