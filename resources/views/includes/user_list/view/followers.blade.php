@include('includes.user_list.profile')

@if(in_array($list_user->id, $following_ids))
    @include('includes.button.unfollow', ['user_id' => $list_user->id])
@else
    @include('includes.button.follow', ['user_id' => $list_user->id])
@endif