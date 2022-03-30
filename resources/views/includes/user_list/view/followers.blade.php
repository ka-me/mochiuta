@include('includes.user_list.profile')

@if(in_array($user->id, $followee_ids))
    @include('includes.user_list.unfollow_button')
@else
    @include('includes.user_list.follow_button')
@endif