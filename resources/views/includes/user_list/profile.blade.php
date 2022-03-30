@if(count($user->songs) > 0)
    <p class="card-text">&#9833; {{ $user->songs->random()->display_name }}</p>
@endif

<h5 class="card-title"><a href="{{ route('users.home', ['user' => $user->id]) }}">{{ $user->name }}</a></h5>

<p class="card-text"><small class="text-muted">{{ $user->message }}</small></p>