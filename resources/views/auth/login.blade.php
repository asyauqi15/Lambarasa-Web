@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-8">
      <img src="{{ asset('img/photo3.jpg') }}" class="img-fluid">
      <h5 class="text-center">Nikmati Latihan Soal yang Kredibel, Fresh dan Terupdate dengan Pembahasan yang Mudah Dipahami dan Sistematis (Step Solutions) Hanya di Lambarasa Education</h5>
    </div>
    <div class="col-md-4">
      <h2>MASUK KE LAMBARASA EDUCATION</h2>
      <p>Masukkan email dan password kamu.<br>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini.</a></p>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholde="Email" required autofocus>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholde="Password" required>
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> 
            <label class="form-check-label" for="remember">Ingat saya</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Masuk</button>
      </form>

      <p>Lupa password? <a href="{{ route('password.request') }}">Reset password</a></p>
    </div>
  </div>
</div>
@endsection

<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 -->