@extends('layouts.common')

@section('title', 'ユーザーを探す')

@section('page_heading', 'ユーザーを探す')

@section('content')
    <form action="{{ action('Users\SearchController@index') }}" method="get">
        <div class="form-row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" class="form-control" placeholder="ユーザー名を入力してください" name="keyword" autocomplete="off" autofocus>
            </div>
           
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary btn-block">検索</button>
            </div>
        </div>
    </form>
    
    <div class="text-center">
        <hr color="#c0c0c0">
        @if(count($users) == 0)
            <h5>該当するユーザーがいません</h5>
        @else
            @if($keyword == '')
                <p>{{ Auth::user()->name }}さんと同じ持ち歌があるユーザーです</p>
                <hr color="#c0c0c0">
            @endif
            
            @foreach($users as $user)
                @if(count($user->songs) > 0)
                    <p class="mb-2">{{ $user->songs->random()->display_name }} を歌っている</p>
                @endif
                
                <h5><a href="{{ action('Users\HomeController@index', ['user' => $user->id]) }}">{{ $user->name }}</a></h5>
                <hr color="#c0c0c0">
            @endforeach
        @endif
    </div>
@endsection