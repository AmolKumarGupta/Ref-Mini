<div class="modal fade " id="bulk-modal-track" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <style>
        .bulk-layout {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
        }
    </style>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Create Tracks</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 bulk-layout">
                            <label for="item_name">Name</label>
                            <label for="description">Description</label>
                            <label for="category">Category</label>
                            <label for="time">Total Time (in hrs and mins)</label>
                            <label for="date">Date</label>
                        </div>

                        @foreach($tracks as $index => $track)
                        <div class="col-md-12 bulk-layout" wire:key="track-{{ $index }}">
                            <div class="form-group">
                                <input wire:model.defer="tracks.{{ $index }}.name" type="text" name="name" class="form-control" placeholder="Name">
                                @error('tracks.{{ $index }}.name') <small data-error="name" class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                
                                <input wire:model.defer="tracks.{{ $index }}.description" type="text" name="description" class="form-control" placeholder="">
                                @error('tracks.{{ $index }}.description') <small data-error="url" class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                
                                <select id="category-select" wire:model.defer="tracks.{{ $index }}.category_id" name="category" class="form-select text-capitalize">
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('tracks.{{ $index }}.category_id') <small data-error="url" class="text-danger">Required</small> @enderror
                            </div>

                            <div class="form-group">
                                
                                <input wire:model.defer="tracks.{{ $index }}.time" type="time" name="time" class="form-control" placeholder="">
                                @error('tracks.{{ $index }}.time') <small data-error="url" class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                
                                <input wire:model.defer="tracks.{{ $index }}.date" type="date" name="date" class="form-control" placeholder="">
                                @error('tracks.{{ $index }}.date') <small data-error="url" class="text-danger">{{ $message }}</small> @enderror
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-info">Save</button>
                    <button type="button" class="btn ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

