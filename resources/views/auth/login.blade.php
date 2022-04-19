@extends('layouts.auth')

@section('title', 'ログイン')

@section('content')
    @if(session('status'))
        <div class="alert alert-primary text-center" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
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

        <div class="form-group form-check text-center my-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('messages.Remember Me') }}
            </label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            {{ __('messages.Login') }}
        </button>
    </form>
    
    @if(Route::has('password.request'))
        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="btn btn-link">
                パスワードをお忘れの方はこちら
            </a>
        </div>
    @endif
    
    <a href="{{ route('register') }}" role="button" class="btn btn-outline-primary btn-block mt-3">
        新規登録はこちら
    </a>
    
    <button type="button" class="btn btn-outline-secondary btn-block mt-3" data-toggle="modal" data-target="#modal">
        {{ config('app.name') }}について
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="aboutApp" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h3 class="modal-title text-primary" id="aboutApp">{{ config('app.name') }}</h3>
                </div>
                
                <div class="modal-body">
                    <p>カラオケの持ち歌を記録できるSNSアプリです</p>
                    
                    <p class="text-primary mb-0">&#9679; 持ち歌の登録</p>
                    <p>曲を検索して登録すると、持ち歌一覧に追加されます</p>
                    
                    <p>※当アプリに登録している検索用の曲は、spotifyAPIから取得した曲データを使用しています</p>
                    
                    <p class="text-primary mb-0">&#9679; ユーザーの持ち歌を閲覧、フォロー</p>
                    <p>気になるユーザーをフォローできます<br>
                       他のユーザーの持ち歌から、自分の新しい持ち歌が見つかるかもしれません</p>
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary px-5" data-dismiss="modal">とじる</button>
                </div>
            </div>
        </div>
    </div>
@endsection
