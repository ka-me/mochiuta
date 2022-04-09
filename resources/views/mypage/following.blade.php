@extends('layouts.common')

@section('title', Auth::user()->name . 'さんのフォロー')

@section('page_heading', Auth::user()->name . 'さん')

@section('content')
    @include('includes.user_list.frame', [
        'heading' => $list_users->count() . ' フォロー',
        'view' => 'following'
    ])
@endsection