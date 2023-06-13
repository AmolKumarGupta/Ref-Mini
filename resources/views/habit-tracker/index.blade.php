@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row gap-3 gap-lg-0">
        <div class="card">

            <div class="card-header pb-0">
                <h5>
                    Dashboard for Tracker
                    <div data-bs-toggle="modal" data-bs-target="#modal-track-create" role="button" class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center" style="line-height: 1;">
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

<div class="modal fade" id="modal-track-create" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Create Track</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form onsubmit="createItem(event)">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="item_name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" id="item_name">
                                <small data-error="name" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="item_url">Url</label>
                                <input type="text" name="url" class="form-control" placeholder="Ex. menu" id="item_url">
                                <small data-error="url" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="item_icon">Icon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-home"></i></span>
                                    <input type="text" name="icon" class="form-control" placeholder="Fontawesome icon" id="item_icon" onkeyup="setFormIconDisplay(this)">
                                </div>
                                <small data-error="icon" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-info">Save changes</button>
                    <button type="button" class="btn ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
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
