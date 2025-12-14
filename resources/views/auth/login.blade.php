@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="row">
  <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <div class="login-brand">
      <img src="{{ asset('backend/dist/assets/img/stisla-fill.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>

    <div class="card card-primary">
      <div class="card-header"><h4>Login</h4></div>

      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible show fade">
          <div class="alert-body">
            <button class="close" data-dismiss="alert">
              <span>&times;</span>
            </button>
            @foreach ($errors->all() as $error)
              {{ $error }}<br>
            @endforeach
          </div>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <div class="d-block">
              <label for="password" class="control-label">Password</label>
            </div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
              <label class="custom-control-label" for="remember-me">Remember Me</label>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <div class="simple-footer">
      Copyright &copy; Coffee Shop {{ date('Y') }}
    </div>
  </div>
</div>
@endsection