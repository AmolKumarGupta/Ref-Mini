<?php

namespace App\Http\Livewire\HabitTrack\Modals;

use App\Models\Category;
use App\Models\HabitCategory;
use App\Models\HabitTrack;
use Carbon\Carbon;
use Livewire\Component;

class Track extends Component
{
    protected $listeners = [
        'setHabitTrack' => 'setHabitTrack',
    ];

    public HabitTrack $formdata;
    public $modalOpen = false;

    protected $rules = [
        'formdata.name' => 'required|string|max:100',
        'formdata.description' => 'required|string',
        'formdata.time' => 'required',
        'formdata.date' => 'required',
        'formdata.category_id' => 'numeric',
    ];

    public function mount()
    {
        $this->formdata = new HabitTrack;
    }

    public function timestring($time): string
    {
        $time = (int) $time;
        $hrs = (string) floor($time / 3600);
        $hrs = str_pad($hrs, 2, '0', STR_PAD_LEFT);

        $lefted = (int) $time % 3600;
        $mins = (string) floor($lefted / 60);
        $mins = str_pad($mins, 2, '0', STR_PAD_LEFT);

        return "$hrs:$mins";
    }

    public function setHabitTrack(HabitTrack $habitTrack)
    {
        $cat = HabitCategory::where('habit_track_id', $habitTrack->id)->first();
        if ($cat) {
            $habitTrack->category_id = $cat->category_id;
        }

        $this->formdata = $habitTrack;
        $this->emit('openModal');
    }

    public function render()
    {
        $this->formdata->time = $this->timestring($this->formdata->time);
        $this->formdata->date = Carbon::parse($this->formdata->date)->toDateString();

        $categories = Category::get();

        return view('livewire.habit-track.modals.track', compact('categories'));
    }

    public function save()
    {
        $this->modalOpen = true;

        if ($this->formdata->time) {
            $timeString = explode(':', (string) $this->formdata->time);
            $hrs = (int) $timeString[0] * 3600;
            $mins = (int) $timeString[1] * 60;
            $this->formdata->time = $hrs + $mins;
        }

        $this->validate();
        $category_id = $this->formdata->category_id;
        unset($this->formdata->category_id);

        if ($this->formdata->save()) {
            $habitCategory = HabitCategory::where('habit_track_id', $this->formdata->id)->first();
            if ($habitCategory == null) {
                $habitCategory = new HabitCategory;
                $habitCategory->habit_track_id = $this->formdata->id;
            }
            $habitCategory->category_id = $category_id;
            $habitCategory->save();
        }
        $this->emit('closeModal');
        $this->emit('reloadTable');
    }
}
