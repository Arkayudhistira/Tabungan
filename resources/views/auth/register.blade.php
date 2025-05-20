<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app') <!-- Extend the app layout -->

@section('content') <!-- Begin content section -->
<div class="container mt-5">
    <div class="row justify-content-center ">
        <!-- Form Login - Col 4 -->
        
        <div class="col-12 col-md-4">
            <form method="POST" action="{{ route('register') }}" class="card p-4">
                @csrf
        
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="d-flex justify-content-between">
                    <a class="text-sm text-primary" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
        
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

    

@endsection
