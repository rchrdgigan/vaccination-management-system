@extends('layouts.auth')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
        Sign In
    </h2>
    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
    <div class="intro-x mt-8">
        <input type="text" class="intro-x login__input input input--lg border border-gray-300 block  @error('email') border-theme-6 @enderror" placeholder="Email" name="email"  autocomplete="email">
            @error('email')
                <div class="text-theme-6 mt-2">{{$message}}</div>
            @enderror
        <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4 @error('password') border-theme-6 @enderror" placeholder="Password" name="password" autocomplete="current-password">
            @error('password')
                <div class="text-theme-6 mt-2">{{$message}}</div>
            @enderror
    </div>
    <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
        <div class="flex items-center mr-auto">
            <input type="checkbox" class="input border mr-2" id="remember-me">
            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
        </div>
        <a href="">Forgot Password?</a>
    </div>
    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
        <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top" type="submit">Login</button>
        <a href="{{route('register')}}" type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0 align-top">Sign up</a>
    </div>
    {{-- <div class="row mb-3">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row mb-0">
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
    </div> --}}
</form>
@endsection
