<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;
use App\Models\MenuSection;
use Illuminate\Support\Facades\Validator;

class Sections extends Component
{
    protected $listeners = [
        'refreshMenuSection' => 'refresh',
        'updateSection' => 'update',
    ];
    public $menuSection;

    public function mount() {
        $this->menuSection = MenuSection::orderBy('order', 'ASC')->get();
    }
    
    public function render()
    {
        return view('livewire.menu.sections');
    }
    
    public function refresh() {
        $this->menuSection = MenuSection::orderBy('order', 'ASC')->get();
    }

    public function delete($id) {
        MenuSection::destroy($id);
        $this->menuSection = MenuSection::orderBy('order', 'ASC')->get();
        $this->emitTo('menu.menu-item', 'setMenu', '0');
    }

    function update($id, $name) {
        $validation = Validator::make(
            [ 'name' => $name ], 
            [ 'name' =>'required' ]
        );

        if ($validation->fails()) {
            $errorMsg = $validation->getMessageBag();
            $this->dispatchBrowserEvent('focusError',['err' => current($errorMsg->getMessages())]);
            $validation->validate();
        }

        try {
            $section = MenuSection::find($id);
            $section->name = $name;
            $section->save();
            $this->menuSection = MenuSection::orderBy('order', 'ASC')->get();
            $this->dispatchBrowserEvent('sectionUpdated', []);
        }catch(\Exception $e) {
            // 
        }
    }
}
