@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/lang-color.css') }}">
<style>
    .bg-gradient-repo {
        background-image: linear-gradient(310deg,#2152ffb3,#21d4fda6);
    }
    .show-toggle .form-check.form-switch{
        display: inherit;
        align-items: center;
    }
    .show-toggle .form-switch .form-check-input {
        width: 1.5rem;
    }
    .show-toggle .form-switch .form-check-input:checked:after {
        transform: translateX(10px);
    }
    .show-toggle .form-switch .form-check-input:after {
        width: .7rem;
        height: .7rem;
    }
</style>
<div class="container-fluid py-4">
    <div class="row">

        <div class="card card-body blur shadow-blur">
            <div class="row">
                <div class="col">
                    @github's Repositories
                    <button class="btn btn-sm bg-gradient-success mb-0 float-end">Sync</button>
                </div>
            </div>
        </div>
        
        @livewire('portfolio.repos')

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('public/assets/js/core/sortable.min.js') }}"></script>
<script src="{{ asset('public/assets/js/portfolio/repos.js') }}"></script>
@endsection