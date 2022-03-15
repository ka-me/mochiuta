{{-- other users home view --}}
@extends('layouts.common')

@section('title', $user->name . 'さん')

@section('page_heading', $user->name . 'さんの持ち歌')

@section('content')
    <div class="text-center">
        @if(Auth::user()->isBeingFollowed($user->id))
            @include('includes.user_list.follower')
        @endif
    </div>
    
    <div class="row">
        <div class="col-9 col-md-4 mx-auto mb-3">
            @if(Auth::user()->isFollowing($user->id))
                @include('includes.user_list.unfollow_button')
            @else
                @include('includes.user_list.follow_button')
            @endif
        </div>
    </div>
    
    @include('includes.back_link', ['session' => 'user_list_url', 'page' => 'ユーザー一覧'])

    @include('includes.home_tabs')
    
    @if(count($mysongs) == 0)
        <h5 class="pt-2">該当データがありません</h5>
    @else
        @foreach($mysongs as $mysong)
            <div class="card mb-1">
                <div class="card-body">
                    <h5>{{ $mysong->display_name }}</h5>
                    <p class="mb-0">登録日時：{{ $mysong->pivot->created_at->format('Y/n/j G:i:s') }}</p>
                </div>
            </div>
        @endforeach
    @endif
@endsection
