<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ActivityOverview extends Component
{
    public function render()
    {
        return view('livewire.activity-overview', [
            'activities' => $this->activities()
        ]);
    }

    public function activities(): Collection
    {
        return Activity::limit(10)
            ->orderBy('id', 'DESC')
            ->get();
    }
}
