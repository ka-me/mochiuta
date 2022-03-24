@extends('layouts.common')

@section('title', '持ち歌登録')

@section('page_heading', '持ち歌登録')

@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            @include('includes.back_link', ['session' => 'song_search_url', 'page' => '検索ページ'])
            
            <label>曲名 / アーティスト名</label>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-0">{{ $song->display_name }}</h5>
                </div>
            </div>
            
            <form action="{{ route('mochiuta.addSelect') }}" method="post">
                @csrf
                <input type="hidden" name="song_id" value="{{ $song->id }}">
                
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">登録する</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection