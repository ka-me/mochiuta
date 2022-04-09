@extends('layouts.common')

@section('title', '曲を探す')

@section('page_heading', '曲を探す')

@section('content')
    <div class="mb-2">
        <form action="{{ route('search') }}" method="get">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="入力してください" name="keyword" autofocus>
                </div>
                
                <div class="form-group col-md-4">
                    <select class="form-control" name="category">
                        <option value="artist">アーティスト名</option>
                        <option value="song">曲名</option>
                    </select>
                </div>
                
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">検索</button>
                </div>
            </div>
        </form>
    </div>
    
    @if(count($results) === 0)
        <h5 class="text-center">該当データがありません</h5>
    @else
        @if($category == 'artist')
            @foreach($results as $artist)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="mb-0">
                            <a href="{{ route('search.selectArtist', ['artist' => $artist->id]) }}">{{ $artist->name }}</a>
                        </h5>
                    </div>
                </div>
            @endforeach
        @endif
        
        @if($category == 'song')
            @foreach($results as $song)
                <div class="card mb-2">
                    <div class="card-body">
                        @if(in_array($song->id, $my_song_ids))
                            <h5 class="card-title">
                                {{ $song->display_name }} <span class="badge badge-primary">持ち歌</span>
                            </h5>
                        @else
                            <h5 class="card-title">
                                <a href="{{ route('mochiuta.select', ['song' => $song->id]) }}">{{ $song->display_name }}</a>
                            </h5>
                        @endif
                        
                        @isset($song->preview_url)
                            <audio controls controlslist="nodownload" src="{{ $song->preview_url }}" class="w-100"></audio>
                        @else
                            <p class="card-text">プレビューがありません</p>
                        @endisset
                    </div>
                </div>
            @endforeach
        @endif
    @endif
@endsection