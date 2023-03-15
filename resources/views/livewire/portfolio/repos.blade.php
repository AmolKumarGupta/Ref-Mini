<div class="row gy-4">
    @foreach ( $data as $repo )
    @php $feat = 3; @endphp
    <div wire:key="repo-{{ $repo['id'] }}" class="col-sm-3">
        <div class="card bg-gradient-repo text-white">
            <div class="card-body  ">
                <div class="fw-bolder">{{ $repo['name'] }}</div>

                <div class="mt-1 text-xs d-flex gap-2">
                    @if( $feat>0 && $repo['language'] )
                        @php $feat -= 1; @endphp
                        <div class="d-flex gap-1">
                            <span class="{{ $repo['language'] }} border-radius-2xl" style="width: .75rem; height: .75rem;"></span>
                            {{ $repo['language'] }}
                        </div>
                    @endif

                    @if( $feat>0 && $repo['stargazers_count'] )
                        @php $feat -= 1; @endphp
                        <div>
                            <i class="far fa-star"></i> {{ $repo['stargazers_count'] }}
                        </div>
                    @endif

                    @if( $feat>0 && $repo['forks_count'] )
                        @php $feat -= 1; @endphp
                        <div>
                            <i class="fa fa-code-branch"></i> {{ $repo['forks_count'] }}
                        </div>
                    @endif

                    @if( $feat>0 && $repo['open_issues_count'] )
                        @php $feat -= 1; @endphp
                        <div>
                            <i class="far fa-dot-circle"></i> {{ $repo['open_issues_count'] }}
                        </div>
                    @endif

                    @if( $feat>0 && $repo['license'] )
                        @php $feat -= 1; @endphp
                        <div>
                            {{ $repo['license']['name'] }}
                        </div>
                    @endif
                </div>

                <div class="mt-1 text-xs d-flex align-items-center gap-1 show-toggle">
                    Show in portfolio
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input">
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>