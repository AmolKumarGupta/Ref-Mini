<div class="modal fade @if($modalOpen) show @endif" @if($modalOpen) style="display: block;" @endif id="modal-track" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Create Track</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="item_name">Name</label>
                                <input wire:model.defer="formdata.name" type="text" name="name" class="form-control" placeholder="Name">
                                @error('formdata.name') <small data-error="name" class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input wire:model.defer="formdata.description" type="text" name="description" class="form-control" placeholder="">
                                @error('formdata.description') <small data-error="url" class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category-select" wire:model.defer="formdata.category_id" name="category" class="form-select text-capitalize">
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('formdata.category_id') <small data-error="url" class="text-danger">Required</small> @enderror
                            </div>

                            <div class="form-group">
                                <label for="time">Total Time (in hrs and mins)</label>
                                <input wire:model.defer="formdata.time" type="time" name="time" class="form-control" placeholder="">
                                @error('formdata.time') <small data-error="url" class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input wire:model.defer="formdata.date" type="date" name="date" class="form-control" placeholder="">
                                @error('formdata.date') <small data-error="url" class="text-danger">{{ $message }}</small> @enderror
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
