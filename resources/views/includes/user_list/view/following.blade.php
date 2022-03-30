@if(in_array($user->id, $follower_ids))
    @include('includes.user_list.follower_badge')
@endif

@include('includes.user_list.profile')

@include('includes.user_list.unfollow_button')