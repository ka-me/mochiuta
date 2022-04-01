@if(in_array($list_user->id, $follower_ids))
    @include('includes.follower_badge')
@endif

@include('includes.user_list.profile')

@include('includes.button.unfollow', ['user_id' => $list_user->id])