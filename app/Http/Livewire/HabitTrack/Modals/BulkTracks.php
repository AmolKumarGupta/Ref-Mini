<?php

namespace App\Http\Livewire\HabitTrack\Modals;

use App\Models\Category;
use App\Models\HabitCategory;
use App\Models\HabitTrack;
use App\Traits\ConvertTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class BulkTracks extends Component
{
    use ConvertTime;

    protected $listeners = [
        'bulk_refresh' => 'refresh',
    ];

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

    protected $validationAttributes = [
        'tracks.*.name' => 'Name',
        'tracks.*.description' => 'Description',
        'tracks.*.time' => 'Total Time',
        'tracks.*.date' => 'Date',
        'tracks.*.category_id' => 'Category',
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
            'category_id' => null,
        ];
    }

    public function save()
    {
        $this->modalOpen = true;
        $this->validate();

        $bulk_category = [];
        $tracks = $this->tracks;
        foreach ($tracks as $key=>$track) {
            $track['time'] = $this->hourStringToSeconds(hourString: $track['time']);

            $category_id = $track['category_id'];
            unset($track['category_id']);

            $habit_track = HabitTrack::create($track);

            activity()
                ->on($habit_track)
                ->withProperties(['bulk' => $track])
                ->log(':subject.name is saved in bulk');

            $bulk_category[] = [
                'category_id' => $category_id,
                'habit_track_id' => $habit_track->id,
            ];
        }

        if ($bulk_category) {
            HabitCategory::insert($bulk_category);
        }

        $this->emit('closeBulkModal');
        $this->emit('reloadTable');
    }

    public function refresh()
    {
        if (count($this->tracks) > 1) {
            $this->tracks = [$this->toHabitTrack()];
        }
    }
}
