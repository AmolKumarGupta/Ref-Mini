@extends('layouts.user_type.auth')

@section('content')
<div class="row">
    <div class="col-lg-4">
        @livewire('menu.sections')
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modal-menusection-create" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Create Menu Section</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                    {{-- <span aria-hidden="true">x</span> --}}
                </button>
            </div>

            <form onsubmit="create(event)">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Create">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-success" >Save changes</button>
                    <button type="button" class="btn ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('public/assets/js/menu.js') }}"></script>
@endsection