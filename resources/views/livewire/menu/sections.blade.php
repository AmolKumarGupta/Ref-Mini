<div class="card">

    <div class="card-header pb-0">
        <h5>Menu Section <div data-bs-toggle="modal" data-bs-target="#modal-menusection-create" role="button" class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center" style="line-height: 1;"><i class="fa fa-xs fa-plus" style="top: -25%"></i></div></h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm border-top border-bottom">
                <tbody>
                    @foreach($menuSection as $section)
                    <tr data-id="{{ $section->id }}">
                        <td><i role="button" class="fas fa-grip-vertical"></i></td>
                        <td class="text-capitalize">{{ $section->name }}</td>
                        <td class="w-0">
                            <div class="text-end space-x-2">
                                <i onclick="openEditModal(this)" data-edit='{ "id": "{{ $section->id }}", "name": "{{ $section->name }}"}' role="button" class="text-gradient text-info fa fa-xs fa-pen"></i>
                                <i wire:click="delete('{{ $section->id }}')" role="button" class="text-gradient text-danger fa fa-xs fa-trash"></i>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>