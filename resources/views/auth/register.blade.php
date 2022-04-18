@extends('layouts.auth')
@section('title')
Register Account
@endsection

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="barangay" class="col-md-4 col-form-label text-md-end">{{ __('Barangay') }}</label>
                            <div class="relative mt-2" >
                                <select class="input w-full  border mr-2" name="barangay_id">
                                    @foreach ($barangays as $barangay)
                                        <option value="{{$barangay->id}}">{{$barangay->barangay_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                @error('barangay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Sign Up
        </h2>
        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
        <div class="intro-x mt-8">
            <input type="text" class="intro-x login__input input input--lg border border-gray-300 block  @error('name') border-theme-6 @enderror" placeholder="Name" name="name"  autocomplete="email">
                @error('name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror

            <input type="text" class="intro-x login__input input mt-2 input--lg border border-gray-300 block  @error('email') border-theme-6 @enderror" placeholder="Email" name="email"  autocomplete="email">
                @error('email')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror

            <div class="row mb-3">
                <div class="relative mt-2" >
                    <select class="input w-full  border mr-2" name="barangay_id">
                        @foreach ($barangays as $barangay)
                            <option value="{{$barangay->id}}">{{$barangay->barangay_name}}</option>
                        @endforeach
                    </select>
                </div>
                    @error('barangay')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4 @error('password') border-theme-6 @enderror" placeholder="Password" name="password" autocomplete="current-password">
                @error('password')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4 @error('password') border-theme-6 @enderror" placeholder="Confirm Password" name="password_confirmation" autocomplete="current-password">
                @error('password')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
        </div>
        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
            <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top" type="submit">Register</button>
            <a href="{{route('login')}}" type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0 align-top">Back to Login</a>

        </div>
    </form>
</div>

@endsection
