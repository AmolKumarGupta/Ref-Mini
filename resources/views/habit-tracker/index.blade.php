@extends('layouts.user_type.auth')

@section('content')
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
                <div class="table-responsive">
                    <table class="table" id="track">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Categories</th>
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
