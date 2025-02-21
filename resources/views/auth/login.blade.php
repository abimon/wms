@extends('layouts.auth')

@section('form')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mt-3 d-grid gap-2">
            <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">SIGN
                IN</button>
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
            <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
        </div>
        <div class="text-center mt-4 fw-light">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary">Create</a>
        </div>
    </form>
@endsection