@extends('layouts.common')

@section('title', '持ち歌登録')

@section('content')
    <div class="container text-center my-5">
        <h3 class="text-primary">持ち歌登録</h3>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-10 col-md-7 mx-auto">
                <div class="row">
                    <div class="col-md-5">
                        <p>1.アーティストを選ぶ</p>
                        
                        <div class="list-group">
                            @foreach($artists as $artist)
                            
                                @if($artist == $select_artist)
                                    <a href="{{ action('Mypage\MochiutaController@index', ['id' => $artist->id]) }}" class="list-group-item list-group-item-action">
                                        {{ $artist->name }}<span class="badge badge-primary">選択中</span>
                                    </a>
                                @else
                                    <a href="{{ action('Mypage\MochiutaController@index', ['id' => $artist->id]) }}" class="list-group-item list-group-item-action">
                                        {{ $artist->name }}
                                    </a>
                                @endif
                                
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="col-md-5 offset-md-2 mt-3 mt-md-0">
                        <p>2.曲を選ぶ</p>
                        
                        @if(is_null($select_artist))
                            <p>アーティストを選択してください</p>
                        @else
                            <form action="{{ action('Mypage\MochiutaController@add') }}" method="post">
                                @csrf
                                
                                <div class="form-group">
                                    <select class="form-control" name="song_id">
                                        
                                        @foreach($select_artist->songs as $song)
                                            <option value="{{ $song->id }}">{{ $song->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            
                                <button type="submit" class="btn btn-primary btn-block">持ち歌登録</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection