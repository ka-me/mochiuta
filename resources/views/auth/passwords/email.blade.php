@extends('layouts.auth')

@section('title', 'パスワードをお忘れの方')

@section('content')
    @if(session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group mb-5">
            <label for="email">{{ __('messages.E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            {{ __('messages.Send Password Reset Link') }}
        </button>
    </form>
    
    <a href="{{ route('login') }}" role="button" class="btn btn-outline-primary btn-block mt-4">ログインページに戻る</a>
@endsection
