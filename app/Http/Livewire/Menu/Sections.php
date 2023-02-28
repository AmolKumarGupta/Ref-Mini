<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;
use App\Models\MenuSection;

class Sections extends Component
{
    protected $listeners = ['refreshMenuSection' => 'refresh'];
    public $menuSection;

    public function mount() {
        $this->menuSection = MenuSection::orderBy('order', 'ASC')->get();
    }

    public function refresh() {
        $this->menuSection = MenuSection::orderBy('order', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.menu.sections');
    }
}
