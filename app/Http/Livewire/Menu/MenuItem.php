<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class MenuItem extends Component
{
    protected $listeners = [
        'setMenu',
        'refreshMenuItem' => 'setMenuItems',
        'updateItems' => 'update',
    ];
    public $menuSectionId;
    public $menuItems;

    public function mount() {
        $this->setMenu(0);
    }

    public function render()
    {
        return view('livewire.menu.menu-item');
    }

    public function setMenu( $id ) {
        $this->menuSectionId = $id;
        $this->setMenuItems();
    }

    public function setMenuItems() {
        $this->menuItems = Menu::where('fk_section_id', $this->menuSectionId)->orderBy('order', 'ASC')->get();
    }

    public function delete($id) {
        Menu::destroy($id);
        $this->setMenuItems();
    }

    function update ($jsonData) {
        $arrData = json_decode( $jsonData, true );

        $validation = Validator::make(
            [
                'id' => $arrData['id'],
                'name' => $arrData['name'],
                'url' => $arrData['url'],
                'icon' => $arrData['icon'],
            ], 
            [
                'name' =>'required',
                'url' =>'required',
                'icon' =>'required',
            ]
        );

        if ($validation->fails()) {
            $errorMsg = $validation->getMessageBag();
            $this->dispatchBrowserEvent('focusItemError',['err' => json_encode($errorMsg->getMessages())]);
            $validation->validate();
        }

        try {
            $item = Menu::find($arrData['id']);
            $item->name = $arrData['name'];
            $item->url = $arrData['url'];
            $item->icon = 'fa-'.$arrData['icon'];
            $item->save();

            $this->setMenuItems();
            $this->dispatchBrowserEvent('itemUpdated', []);
        }catch(\Exception $e) {
            // 
        }
    }
}
?>