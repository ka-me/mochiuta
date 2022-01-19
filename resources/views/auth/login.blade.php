@extends('layouts.auth')

@section('title', 'ログイン')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 col-md-5 mx-auto">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('messages.E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('messages.Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-check text-center mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('messages.Remember Me') }}
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('messages.Login') }}
                    </button>
                </form>
                
                <a href="{{ route('register') }}" role="button" class="btn btn-outline-primary btn-block mt-4">新規登録はこちら</a>
            </div>
        </div>
    </div>
@endsection
