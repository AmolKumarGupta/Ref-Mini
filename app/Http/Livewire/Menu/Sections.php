<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;
use App\Models\MenuSection;

class Sections extends Component
{
    // protected $listeners = ['create' => 'create'];
    public $menuSection;
    public Array $create;

    public function mount() {
        $this->menuSection = MenuSection::orderBy('order', 'ASC')->get();
        $this->create['name'] = "";
    }

    public function render()
    {
        return view('livewire.menu.sections');
    }
}
