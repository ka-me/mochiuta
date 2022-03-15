<form action="{{ action('Mypage\FollowController@follow', ['user_id' => $user->id]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-outline-primary btn-block">フォローする</button>
</form>