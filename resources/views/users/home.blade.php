@extends('layouts.common')

@section('title', $user->name . 'さん')

@section('back')
    @if(session('user_list_url'))
        @include('includes.button.back', ['url' => session('user_list_url'), 'page' => 'ユーザー一覧'])
    @endif
@endsection

@section('page_heading', $user->name . 'さんの持ち歌')

@section('content')
    <div class="text-center">
        @if(Auth::user()->isBeingFollowed($user->id))
            @include('includes.follower_badge')
        @endif
    </div>
    
    <div class="row">
        <div class="col-9 col-md-4 mx-auto mb-3">
            @if(Auth::user()->isFollowing($user->id))
                @include('includes.button.unfollow', ['user_id' => $user->id])
            @else
                @include('includes.button.follow', ['user_id' => $user->id])
            @endif
        </div>
    </div>

    @include('includes.home_tabs', ['route' => 'users.home', 'user_parameter' => ['user' => $user->id]])
    
    @if(count($my_songs) === 0)
        <h5 class="pt-3 text-center">該当データがありません</h5>
    @else
        @foreach($my_songs as $my_song)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $my_song->display_name }}</h5>
                </div>
                <div class="card-footer bg-white text-right py-2">
                    登録日時：{{ $my_song->pivot->created_at->format('Y/n/j G:i:s') }}
                </div>
            </div>
        @endforeach
    @endif
@endsection
