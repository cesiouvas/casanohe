@extends('layouts.app')

@section('content')
<div class="container">
    <div style="height: 100%; margin: 0; display: flex; justify-content: center; align-items: center;">
        <div class="rounded-5 p-2 form-container w-50" style="border: 8px solid #CED93C; background-color: #fffff8;">
            <div class="text-center">
                <a href="../index.html"><img src="../img/logo.png" alt="logo" style="width: 150px;"></a>
                <h3>Iniciar sesión</h3>
            </div>

            <div class="card-body p-3">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end p-3">
                        <button class="btn btn-primary" style="background-color: #FFB536; color: black; border: 2px solid #FFB536; font-weight: bold;" type="submit" id="login">Iniciar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection