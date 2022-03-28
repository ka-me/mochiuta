@extends('layouts.common')

@section('title', 'アカウント削除')

@section('page_heading', 'アカウント削除')

@section('content')
    <div class-"row">
        <div class="col-md-9 mx-auto">
            @include('includes.back_link', ['url' => route('edit'), 'page' => 'アカウント編集'])
    
            <div class="alert alert-danger text-center" role="alert">
                登録データをすべて削除します<br>
                ボタンを押すと最終確認メッセージが表示されます
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6 mx-auto">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal">
                        アカウント削除
                    </button>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">アカウントを削除します</h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <p>削除が完了したらログインページが表示されます</p>
                        </div>
                        
                        <div class="modal-footer justify-content-center">
                            <form action="{{ route('destroy') }}" method="post">
                                @csrf
                        
                                <button type="submit" class="btn btn-primary px-5">アカウント削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection