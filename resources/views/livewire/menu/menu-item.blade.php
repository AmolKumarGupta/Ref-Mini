<div class="card" data-active-section-id="{{ $menuSectionId }}" >

    <div class="card-header pb-0">
        <h5>Menu Items @if($menuSectionId != 0) <div data-bs-toggle="modal" data-bs-target="#modal-menuitem-create" role="button" class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center" style="line-height: 1;"><i class="fa fa-xs fa-plus" style="top: -25%"></i></div> @endif</h5>
    </div>

    <div class="card-body">
        @if($menuItems->count() > 0)
            @include('livewire.menu.item')
        @else
            @include('livewire.menu.empty')
        @endif
    </div>

</div>