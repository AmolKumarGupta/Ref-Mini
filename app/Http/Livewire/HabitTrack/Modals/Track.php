<?php

namespace App\Http\Livewire\HabitTrack\Modals;

use App\Models\Category;
use App\Models\HabitCategory;
use App\Models\HabitTrack;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Track extends Component
{
    public $habit_id = null;
    public HabitTrack $formdata;
    public $modalOpen = false;

    protected $rules = [
        'formdata.name' => 'required|string|max:100',
        'formdata.description' => 'required|string',
        'formdata.time' => 'required',
        'formdata.date' => 'required',
        'formdata.category_id' => 'numeric'
    ];

    public function mount()
    {
        $this->formdata = new HabitTrack;
        $this->formdata->name = "Test";
    }

    public function render()
    {
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
