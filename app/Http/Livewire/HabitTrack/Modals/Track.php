<?php

namespace App\Http\Livewire\HabitTrack\Modals;

use App\Models\Category;
use App\Models\HabitCategory;
use App\Models\HabitTrack;
use App\Traits\ConvertTime;
use Carbon\Carbon;
use Livewire\Component;

class Track extends Component
{
    use ConvertTime;

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
        $this->formdata->time = $this->toHourString(seconds: $this->formdata->time);
        $this->formdata->date = Carbon::parse($this->formdata->date)->toDateString();

        $categories = Category::get();

        return view('livewire.habit-track.modals.track', compact('categories'));
    }

    public function save()
    {
        $this->modalOpen = true;

        if ($this->formdata->time) {
            $this->formdata->time = $this->hourStringToSeconds(hourString: $this->formdata->time);
        }

        $this->validate();
        $category_id = $this->formdata->category_id;
        unset($this->formdata->category_id);

        $prop = $this->formdata->logProp();
        if ($this->formdata->save()) {
            activity()
            ->on($this->formdata)
            ->withProperties($prop)
            ->log(':subject.name is saved');

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
