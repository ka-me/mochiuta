<form action="{{ route('follow', ['user_id' => $user->id]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-outline-primary px-5">フォローする</button>
</form>