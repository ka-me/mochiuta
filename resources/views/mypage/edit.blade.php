@extends('layouts.common')

@section('title', 'アカウント編集')

@section('page_heading', 'アカウント編集')

@section('content')
    @if(count($errors) > 0)
        <div class="d-block d-md-none alert alert-danger text-center" role="alert">
            エラーがあります
        </div>
    @endif
    
    <div class="row">
        <div class="col-md-6">
            @component('components.account_edit_form', ['route' => 'profile.update', 'item' => 'プロフィール'])	
                <div class="form-group">	
                    <label for="name">{{ __('messages.Name') }}</label>	
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $auth_user->name }}" required autocomplete="name">
        	
                    @include('includes.form_error', ['field' => 'name'])	
                </div>
                
                <div class="form-group">	
                    <label for="message">メッセージ</label>	
                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="6" placeholder="160文字まで登録できます">{{ old('message') ?? $auth_user->message }}</textarea>
        	
                    @include('includes.form_error', ['field' => 'message'])	
                </div>	
            @endcomponent
        </div>
        
        <div class="col-md-6">
            @component('components.account_edit_form', ['route' => 'email.update', 'item' => 'メールアドレス'])	
                <div class="form-group">
                    <label for="email">{{ __('messages.E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $auth_user->email }}" required autocomplete="email">
        
                    @include('includes.form_error', ['field' => 'email'])	
                </div>
            @endcomponent
            
            @component('components.account_edit_form', ['route' => 'password.update', 'item' => 'パスワード'])
                <div class="form-group">
                    <label for="password">新しい{{ __('messages.Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                    @include('includes.form_error', ['field' => 'password'])
                </div>
        
                <div class="form-group">
                    <label for="password-confirm">新しい{{ __('messages.Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            @endcomponent
            
            <div class="card">
                <div class="card-body">
                    <label>アカウント削除ページへ</label>
                    
                    <div class="row">
                        <div class="col-md-9 mx-auto">
                            <a href="{{ route('deactivate') }}" role="button" class="btn btn-outline-primary btn-block">アカウント削除</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection