@extends('layouts.common')

@section('title', Auth::user()->name . 'さん')

@section('back')
    @include('includes.button.back', ['url' => session('home_url'), 'page' => '持ち歌一覧'])
@endsection

@section('page_heading', '持ち歌編集')

@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <label>曲名 / アーティスト名</label>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-0">{{ $my_song->display_name }}</h5>
                </div>
            </div>
            
            <hr color="#c0c0c0">
            
            <div class="mt-4 text-center">
                <button type="button" class="btn btn-outline-primary px-5" data-toggle="modal" data-target="#modal">
                    持ち歌一覧から削除
                </button>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="deleteFromMySongList" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteFromMySongList">持ち歌一覧から削除します</h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <p>{{ $my_song->display_name }}</p>
                        </div>
                        
                        <div class="modal-footer justify-content-center">
                            <form action="{{ route('mochiuta.delete', ['song_id' => $my_song->id]) }}" method="post">
                                @csrf
                                
                                <button type="submit" class="btn btn-primary px-5">OK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection