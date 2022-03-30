@extends('layouts.common')

@section('title', Auth::user()->name . 'さん')

@section('page_heading', Auth::user()->name . 'さんのフォロー')

@section('content')
    @include('includes.user_list', [
        'heading' => $users->count() . ' フォロー',
        'view' => 'following'
    ])
@endsection