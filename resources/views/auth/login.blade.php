<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app') <!-- Extend the app layout -->

@section('content') <!-- Begin content section -->

    <form method="POST" action="{{ route('login') }}" class="card p-4">
        @csrf

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
        </div>

        <div class="d-flex justify-content-between">
            @if (Route::has('password.request'))
                <a class="text-sm text-primary" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
        </div>
    </form>

@endsection
