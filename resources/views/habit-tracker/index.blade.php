@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row gap-3 gap-lg-0">
        <div class="card">

            <div class="card-header pb-0">
                <h5>Dashboard for Tracker</h5>
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
                            <tr>
                                <th>1</th>
                                <th>Exercise</th>
                                <th>exercise</th>
                                <th>15 mins</th>
                                <th>10 May, 10:00am</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Categories</th>
                                <th>Time</th>
                                <th>Created At</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Categories</th>
                                <th>Time</th>
                                <th>Created At</th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let table = new simpleDatatables.DataTable('#track');
    });
</script>
@endsection
