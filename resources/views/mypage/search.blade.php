@extends('layouts.common')

@section('title', '曲を探す')

@section('page_heading', '曲を探す')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-11 col-md-9 mx-auto">
                @if(session('add_success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('add_success') }}
                    </div>
                @endif
                
                @if(session('add_error'))
                    <div class="alert alert-secondary" role="alert">
                        {{ session('add_error') }}
                    </div>
                @endif

                <form action="{{ action('Mypage\SearchController@index') }}" method="get">
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
                
                @if(count($results) == 0)
                    <h5>該当データがありません</h5>
                @else
                    @if($category == 'artist')
                        @foreach($results as $artist)
                            <div class="card mb-1">
                                <div class="card-body">
                                    <h5 class="mb-0">
                                        <a href="{{ action('Mypage\SearchController@selectArtist', ['artist' => $artist->id]) }}">{{ $artist->name }}</a>
                                    </h5>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                    @if($category == 'song')
                        @foreach($results as $song)
                            <div class="card mb-1">
                                <div class="card-body">
                                    @if(in_array($song->id, $mysong_ids))
                                        <h5>{{ $song->display_name }} <span class="badge badge-primary">登録済</span></h5>
                                    @else
                                        <h5><a href="{{ action('Mypage\MochiutaController@selectSong', ['song' => $song->id]) }}">{{ $song->display_name }}</a></h5>
                                    @endif
                                    
                                    @isset($song->preview_url)
                                        <audio controls controlslist="nodownload" src="{{ $song->preview_url }}" style="width: 100%;"></audio>
                                    @else
                                        <p class="mb-0">プレビューがありません</p>
                                    @endisset
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection