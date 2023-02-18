@extends('layouts.app')

@section('guest')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.nav')
            </div>
        </div>
    </div>
    @yield('content')        
    @include('layouts.footers.guest.footer')
@endsection