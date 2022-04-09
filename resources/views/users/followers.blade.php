@extends('layouts.common')

@section('title', $user->name . 'さんのフォロワー')

@section('back')
    @include('includes.button.back', [
        'url'  => route('users.home', ['user' => $user->id]),
        'page' => '持ち歌一覧'
    ])
@endsection

@section('page_heading', $user->name . 'さん')

@section('content')
    @include('includes.user_list.frame', [
        'heading' => $list_users->count() . ' フォロワー',
        'view'    => 'other'
    ])
@endsection