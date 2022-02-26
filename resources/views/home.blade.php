@extends('layouts.common')

@section('title', Auth::user()->name . 'さん')

@section('page_heading', Auth::user()->name . 'さんの持ち歌')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-11 col-md-9 mx-auto">
                <ul class="nav nav-tabs mb-2">
                    <li class="nav-item">
                        <a class="nav-link{{ $display == 'all' ? ' active' : '' }}" href="{{ route('home', ['display' => 'all']) }}">
                            全曲 <span class="badge badge-primary">{{ $mysong_count }}</span>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle{{ $display == 'artist' ? ' active' : '' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            アーティスト
                        </a>
                        <div class="dropdown-menu">
                            @foreach($myartists as $myartist)
                                <a class="dropdown-item{{ $display == 'artist' && $myartist->id == $id ? ' disabled' : '' }}" href="{{ route('home', ['display' => 'artist', 'id' => $myartist->id]) }}">
                                    {{ $myartist->name }} <span class="badge badge-primary">{{ $mysong_by_artist_count[$myartist->id] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                
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
            </div>
        </div>
    </div>
@endsection
