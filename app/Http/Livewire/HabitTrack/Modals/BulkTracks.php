<?php

namespace App\Http\Livewire\HabitTrack\Modals;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class BulkTracks extends Component
{
    public $tracks;

    /**
     * @property Collection<array-key,Category>
     */
    public Collection $categories;

    protected $rules = [
        'tracks.*.name' => 'required|string|max:100',
        'tracks.*.description' => 'required|string',
        'tracks.*.time' => 'required',
        'tracks.*.date' => 'required',
        'tracks.*.category_id' => 'numeric',
    ];

    public function mount(): void
    {
        $this->setCategories();
    }

    public function render()
    {
        return view('livewire.habit-track.modals.bulk-tracks');
    }

    public function setCategories(): void
    {
        $this->categories = Category::get();
    }
}
