@extends('layouts.common')

@section('title', Auth::user()->name . 'さん')

@section('page_heading', Auth::user()->name . 'さんの持ち歌')

@section('content')
    @include('includes.home_tabs', ['route' => 'home', 'user_parameter' => []])
    
    @if(count($my_songs) === 0)
        <h5 class="pt-3 text-center">該当データがありません</h5>
    @else
        @foreach($my_songs as $my_song)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $my_song->display_name }}</h5>
                </div>
                <div class="card-footer bg-white text-right py-2">
                    <a href="{{ route('mochiuta.edit', ['song_id' => $my_song->id]) }}" class="card-link mr-3">編集</a>
                    登録：{{ $my_song->pivot->created_at->format('Y/m/d H:i') }}
                </div>
            </div>
        @endforeach
    @endif
@endsection
