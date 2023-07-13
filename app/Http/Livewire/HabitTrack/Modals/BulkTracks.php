<?php

namespace App\Http\Livewire\HabitTrack\Modals;

use App\Models\Category;
use App\Traits\ConvertTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class BulkTracks extends Component
{
    use ConvertTime;

    public bool $modalOpen = false;

    public array $tracks;

    /**
     * @var Collection<array-key,Category>
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
        $this->tracks[] = $this->toHabitTrack();
    }

    public function render()
    {
        foreach ($this->tracks as $track) {
            $track['time'] = $this->toHourString(seconds: $track['time']);
        }

        return view('livewire.habit-track.modals.bulk-tracks');
    }

    public function setCategories(): void
    {
        $this->categories = Category::get();
    }

    public function add(): void
    {
        $this->modalOpen = true;
        $this->tracks[] = $this->toHabitTrack();
    }

    public function toHabitTrack(): array
    {
        return [
            'name' => '',
            'description' => '',
            'time' => '00:00',
            'date' => Carbon::now()->toDateString(),
            'category_id' => '0',
        ];
    }
}
