@if(in_array($list_user->id, $follower_ids))
    @include('includes.follower_badge')
@endif

@include('includes.user_list.profile')

@if($list_user->id === Auth::id())
    <button type="button" class="btn btn-primary px-5" disabled>自分です</button>
@else
    @if(in_array($list_user->id, $followee_ids))
        @include('includes.button.unfollow', ['user_id' => $list_user->id])
    @else
        @include('includes.button.follow', ['user_id' => $list_user->id])
    @endif
@endif