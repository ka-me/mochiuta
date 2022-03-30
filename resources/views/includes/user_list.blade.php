<div class="text-center">
    <p class="text-secondary mb-4">{{ $heading }}</p>
    
    @foreach($users->chunk(2) as $chunk)
        <div class="row">
            @foreach($chunk as $user)
                <div class="col-md-6 px-2 mb-3">
                    <div class="card">
                        <div class="card-body">
                            
                            @include('includes.user_list.view.' . $view)
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>