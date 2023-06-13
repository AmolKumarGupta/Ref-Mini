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

        // $this->formdata->time = 120;
        // $this->formdata->date = '2023-05-09';

        $this->validate();
        $this->formdata->save();
        $this->emit('closeModal');
    }
}
