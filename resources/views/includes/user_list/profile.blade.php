@if(count($list_user->songs) > 0)
    <p class="card-text">&#9833; {{ $list_user->songs->random()->display_name }}</p>
@endif

<h5 class="card-title">
    <a href="{{ route('users.home', ['user' => $list_user->id]) }}">{{ $list_user->name }}</a>
</h5>

<p class="card-text">
    <small class="text-muted">{{ $list_user->message }}</small>
</p>