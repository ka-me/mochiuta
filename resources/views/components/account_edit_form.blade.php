<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route($route) }}" method="post">
            @csrf
    
            {{ $slot }}
            
            <div class="row mt-4">
                <div class="col-md-9 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block">{{ $item }}更新</button>
                </div>
            </div>
        </form>
    </div>
</div>