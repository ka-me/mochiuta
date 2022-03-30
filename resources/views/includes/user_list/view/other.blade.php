@if(in_array($user->id, $follower_ids))
    @include('includes.user_list.follower_badge')
@endif

@include('includes.user_list.profile')

@if($user->id === Auth::id())
    <button type="button" class="btn btn-primary px-5" disabled>自分です</button>
@else
    @if(in_array($user->id, $followee_ids))
        @include('includes.user_list.unfollow_button')
    @else
        @include('includes.user_list.follow_button')
    @endif
@endif