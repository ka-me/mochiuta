<form action="{{ route('unfollow', ['user_id' => $user_id]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-primary px-5">フォロー中</button>
</form>