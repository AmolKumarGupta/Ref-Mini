@extends('layouts.user_type.auth')

@section('content')
<style>
    .hide-scroll::-webkit-scrollbar {
        width: 0 !important;
    }

    .hide-scroll {
        -ms-overflow-style: none;
    }

    .hide-scroll {
        scrollbar-width: none;
    }

    .extras-wrapper {
        display: flex;
        gap: .25rem;
    }

    .extras-items {
        width: 0;
        overflow-x: hidden;
        transition: all 0.75s cubic-bezier(0.51, 0.06, 0.96, 0.44);
    }

    .extras-wrapper:hover .extras-items {
        width: 100%;
    }
</style>
<div class="container-fluid py-4">
    <div class="row gap-3 gap-lg-0">
        <div class="card">

            <div class="card-header pb-0">
                <h5>
                    Dashboard for Tracker
                    <div data-bs-toggle="modal" data-bs-target="#modal-track" role="button" class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center" style="line-height: 1;">
                        <i class="fa fa-xs fa-plus" style="top: -25%" aria-hidden="true"></i>
                    </div>
                </h5>

            </div>

            <div class="card-body">
                <div class="table-responsive hide-scroll">
                    <table class="table" id="track">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th class="text-center">Categories</th>
                                <th>Time</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@livewire('habit-track.modals.track')

@endsection

@section('scripts')
<script>
    const AJAX_URL = '{{ route("habit-tracker.ajax") }}';
</script>
<script src="{{ asset('public/assets/js/habittrack.js') }}"></script>
@endsection
