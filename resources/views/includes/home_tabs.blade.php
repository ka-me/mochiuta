<div class="accordion mb-2" id="accordion">
    <div class="card border-bottom">
        <div class="card-header" id="homeTabs">
            <a class="btn btn-link" href="{{ route($route, array_merge([], $user_parameter)) }}">
                全曲 <span class="badge badge-primary">{{ $tabs['my_song_count'] }}</span>
            </a>
            
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#artist" aria-expanded="false" aria-controls="artist">
                アーティスト
            </button>
        </div>
        
        <div id="artist" class="collapse" aria-labelledby="homeTabs" data-parent="#accordion">
            <div class="list-group list-group-flush">
                @foreach($tabs['my_artists'] as $my_artist)
                    <a class="list-group-item list-group-item-action" href="{{ route($route, array_merge(['display' => 'artist', 'id' => $my_artist->id], $user_parameter)) }}">
                        {{ $my_artist->name }} <span class="badge badge-primary">{{ $my_artist->songs_count }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>