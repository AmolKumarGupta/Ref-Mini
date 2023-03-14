@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        <div class="card card-body blur shadow-blur">
            <div class="row">
                <div class="col">@github's Repositories</div>
            </div>
        </div>
        
        @livewire('portfolio.repos')

    </div>
</div>

@endsection

@section('scripts')
@endsection