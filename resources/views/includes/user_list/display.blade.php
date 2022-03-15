<div class="text-center">
    @switch($view)
        @case('search')
            @if($keyword == '')
                @include('includes.user_list.heading', ['text' => Auth::user()->name . 'さんと同じ持ち歌があるユーザーです'])
            @endif
            @break
            
        @case('following')
            @include('includes.user_list.heading', ['text' => $users->count() . ' フォロー'])
            @break
            
        @case('followers')
            @include('includes.user_list.heading', ['text' => $users->count() . ' フォロワー'])
            @break
    @endswitch
    
    @foreach($users->chunk(2) as $chunk)
        <div class="row">
            @foreach($chunk as $user)
                <div class="col-md-6 px-2 mb-3">
                    <div class="card">
                        <div class="card-body">
                            @if(count($user->songs) > 0)
                                <p class="mb-2">{{ $user->songs->random()->display_name }} を歌っている</p>
                            @endif
                            
                            <h5><a href="{{ action('Users\HomeController@index', ['user' => $user->id]) }}">{{ $user->name }}</a></h5>
                            
                            @if($view !== 'followers')
                                @if(in_array($user->id, $follower_ids))
                                    @include('includes.user_list.follower')
                                @endif
                            @endif
                            
                            <div class="row">
                                <div class="col-9 col-md-7 mx-auto">
                                    @if($view === 'following')
                                        @include('includes.user_list.unfollow_button')
                                    @else
                                        @if(in_array($user->id, $followee_ids))
                                            @include('includes.user_list.unfollow_button')
                                        @else
                                            @include('includes.user_list.follow_button')
                                        @endif
                                    @endif
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>