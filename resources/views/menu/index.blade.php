@extends('layouts.user_type.auth')

@section('content')
<div class="row gap-3 gap-lg-0">
    <!-- Menu Section -->
    <div class="col-lg-4">
        @livewire('menu.sections')
    </div>

    <!-- Menu Item -->
    <div class="col-lg-8">
        @livewire('menu.menu-item')
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
                                <small data-error="name" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-info" >Save changes</button>
                    <button type="button" class="btn ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-menusection-edit" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Edit Menu Section</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form onsubmit="edit(event)">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id" >
                                <input type="text" name="name" class="form-control" placeholder="Create">
                                <small data-error="name" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-info" >Save changes</button>
                    <button type="button" class="btn ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-menuitem-create" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Create Menu Item</h6>
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
                    <button type="submit" class="btn bg-gradient-info" >Save changes</button>
                    <button type="button" class="btn ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-menuitem-edit" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Edit Menu Item</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form onsubmit="editItem(event)">
                <input type="hidden" name="id">
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
                    <button type="submit" class="btn bg-gradient-info" >Save changes</button>
                    <button type="button" class="btn ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    const createUrl = '{{ route("menu.section.create") }}';
    const createItemUrl = '{{ route("menu.item.create") }}';
</script>
<script src="{{ asset('public/assets/js/menu.js') }}"></script>
@endsection