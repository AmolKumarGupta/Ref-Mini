<?php

namespace App\Http\Livewire\HabitTrack\Modals;

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
        'formdata.date' => 'required'
    ];

    public function mount()
    {
        $this->formdata = new HabitTrack;
        $this->formdata->name = "Test";
    }

    public function render()
    {
        return view('livewire.habit-track.modals.track');
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
        $this->formdata->save();
        $this->emit('closeModal');
    }
}
