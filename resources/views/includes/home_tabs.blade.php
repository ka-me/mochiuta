<ul class="nav nav-tabs mb-2">
    <li class="nav-item">
        <a class="nav-link{{ $display == 'all' ? ' active' : '' }}" href="{{ url()->current() }}?display=all">
            全曲 <span class="badge badge-primary">{{ $mysong_count }}</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle{{ $display == 'artist' ? ' active' : '' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            アーティスト
        </a>
            
        <div class="dropdown-menu">
            @foreach($myartists as $myartist)
                <a class="dropdown-item{{ $display == 'artist' && $myartist->id == $id ? ' disabled' : '' }}" href="{{ url()->current() }}?display=artist&id={{ $myartist->id }}">
                    {{ $myartist->name }} <span class="badge badge-primary">{{ $myartist->songs_count }}</span>
                </a>
            @endforeach
        </div>
    </li>
</ul>