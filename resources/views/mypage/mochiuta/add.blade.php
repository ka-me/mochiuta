@extends('layouts.common')

@section('title', '持ち歌登録')

@section('page_heading', '持ち歌登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-11 col-md-7 mx-auto">
                @include('includes.back_link', ['session' => 'song_search_url', 'page' => '検索ページ'])
                
                <label>曲名 / アーティスト名</label>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-0">{{ $song->display_name }}</h5>
                    </div>
                </div>
                
                <form action="{{ action('Mypage\MochiutaController@selectSongAdd') }}" method="post">
                    @csrf
                    <input type="hidden" name="song_id" value="{{ $song->id }}">
                    
                    <div class="row">
                        <div class="col-md-5 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">登録する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection