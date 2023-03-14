<div class="row gy-4">
    @foreach ( $data as $repo )
    <div wire:key="repo-{{ $repo['id'] }}" class="col-sm-3">
        <div class="card">
            <div class="card-body">
                {{ $repo['name'] }}
            </div>
        </div>
    </div>
    @endforeach
</div>