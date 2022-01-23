@extends('layouts.common')

@section('title', Auth::user()->name . 'さん')

@section('content')
    <div class="container text-center my-5">
        <h3 class="text-primary">{{ Auth::user()->name }}さんの持ち歌</h3>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-10 col-md-7 mx-auto">
                @foreach($mysongs as $mysong)
                    <div class="card mb-1">
                        <div class="card-body">
                            <h5>{{ $mysong->name }} / {{ $mysong->artist->name }}</h5>
                            <p>登録日：{{ $mysong->joined_at }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
