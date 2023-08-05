<div class="table-responsive">
    <table class="table table-sm border-top border-bottom">
        <tbody>
            @foreach($menuItems as $item)
            @php
                $itemJson = json_encode([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'url' => $item['url'],
                    'icon' => \Str::replace('fa-', '', $item['icon']),
                ]);
            @endphp
            <tr data-id="">
                <td class="w-8"><i role="button" class="fas fa-grip-vertical"></i></td>
                <td class="text-capitalize d-flex">
                    <div class="icon icon-shape icon-xs shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center bg-gradient-info"><i class="fa {{ $item->icon }}" style="top: 0px;" aria-hidden="true"></i></div>
                    {{ $item->name }}
                </td>
                <td class=""><small><i>/{{ $item->url }}</i></small></td>
                <td class="w-0">
                    <div class="text-end space-x-2">
                        <i onclick="openEditItemModal(this)" data-edit='{{ $itemJson }}' role="button" class="text-gradient text-info fa fa-xs fa-pen"></i>
                        <i onclick="deleteMenuItem('{{ $item->id }}')" role="button" class="text-gradient text-danger fa fa-xs fa-trash"></i>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>