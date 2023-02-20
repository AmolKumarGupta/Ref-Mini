<ul class="navbar-nav">
    @foreach( $menugrp as $k=>$menu )
        <li class="nav-item mt-2">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">{{ $k }}</h6>
        </li>
        @foreach($menu as $m)
        <li class="nav-item">
            <a class="nav-link {{ $m['url']!=null ? (Request::is($m['url']) ? 'active' : '') : '' }}" href="{{ $m['url']!=null ? url($m['url']) : 'javascript:void(0);' }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa {{ $m['url']!=null ? (Request::is($m['url']) ? 'active' : 'text-dark') : 'text-dark' }} {{ $m['icon'] }}"></i>
                </div>
                <span class="nav-link-text text-capitalize ms-1">{{ $m['name'] }}</span>
            </a>
        </li>
        @endforeach
    @endforeach
</ul>