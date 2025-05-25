@extends('layouts.auth')

@section('form')
    <h4>Driver's Details</h4>
    <h6 class="fw-light">Update your details</h6>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class=" col-form-label text-md-end">{{ __('Name') }}</label>
            <div class="">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
            <div class="">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="contact" class="col-form-label text-md-end">{{ __('Phone Number') }}</label>
            <div class="">
                <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact"
                    value="{{ old('contact') }}" required autocomplete="contact">

                @error('contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class=" col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password-confirm" class=" col-form-label text-md-end">{{ __('Confirm Password') }}</label>

            <div class="">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div class="mb-4">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    I agree to all Terms & Conditions
                </label>
            </div>
        </div>
        <div class="mt-3 d-grid gap-2">
            <button type="submit" class="btn btn-block btn-warning btn-lg fw-medium auth-form-btn">Save & Continue</button>
        </div>
        <div class="text-center mt-4 fw-light">
            Already have an account? <a href="{{ route('login') }}" class="text-warning">Login</a>
        </div>
    </form>
@endsection