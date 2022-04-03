@extends('layouts.common')

@section('title', $user->name . 'さん')

@section('back')
    @if(session('user_list_url'))
        @include('includes.button.back', ['url' => session('user_list_url'), 'page' => 'ユーザー一覧'])
    @endif
@endsection

@section('page_heading', $user->name . 'さんの持ち歌')

@section('content')
    <div class="text-center mb-4">
        <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#about" aria-expanded="false" aria-controls="about">
            {{ $user->name }}
        </button>
    
        <div class="collapse" id="about">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="mb-2">
                        <a href="{{ route('users.following', ['user' => $user->id]) }}" class="card-link text-dark">
                            {{ $about['followee_count'] }} フォロー
                        </a>
                        
                        <a href="{{ route('users.followers', ['user' => $user->id]) }}" class="card-link text-dark">
                            {{ $about['follower_count'] }} フォロワー
                        </a>
                    </div>
                    
                    @if($about['is_followed'])
                        @include('includes.follower_badge')
                    @endif
                    
                    <p class="card-text">{{ $user->message }}</p>
                    
                    @if($about['is_following'])
                        @include('includes.button.unfollow', ['user_id' => $user->id])
                    @else
                        @include('includes.button.follow', ['user_id' => $user->id])
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('includes.home_tabs', ['route' => 'users.home', 'user_parameter' => ['user' => $user->id]])
    
    @if(count($my_songs) === 0)
        <h5 class="pt-3 text-center">該当データがありません</h5>
    @else
        @foreach($my_songs as $my_song)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="mb-0">{{ $my_song->display_name }}</h5>
                </div>
                
                <div class="card-footer bg-white text-right py-2">
                    登録日時：{{ $my_song->pivot->created_at->format('Y/n/j G:i:s') }}
                </div>
            </div>
        @endforeach
    @endif
@endsection
