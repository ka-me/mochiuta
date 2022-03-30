@extends('layouts.common')

@section('title', Auth::user()->name . 'さん')

@section('page_heading', Auth::user()->name . 'さんのフォロワー')

@section('content')
    @include('includes.user_list', [
        'heading' => $users->count() . ' フォロワー',
        'view' => 'followers'
    ])
@endsection