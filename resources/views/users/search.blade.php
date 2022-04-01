@extends('layouts.common')

@section('title', 'ユーザーを探す')

@section('page_heading', 'ユーザーを探す')

@section('content')
    <div class="mb-2">
        <form action="{{ route('users.search') }}" method="get">
            <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="ユーザー名を入力してください" name="keyword" autocomplete="off" autofocus>
                </div>
               
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">検索</button>
                </div>
            </div>
        </form>
    </div>
    
    @if(count($list_users) === 0)
        <h5 class="text-center">該当するユーザーがいません</h5>
    @else
        @if($keyword == '')
            @include('includes.user_list.frame', [
                'heading' => Auth::user()->name . ' さんと同じ持ち歌があるユーザーです',
                'view' => 'other'
            ])
        @else
            @include('includes.user_list.frame', [
                'heading' => $list_users->count() . ' ユーザー見つかりました',
                'view' => 'other'
            ])
        @endif
    @endif
@endsection