<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ActivityOverview extends Component
{
    public function render()
    {
        return view('livewire.activity-overview', [
            'activities' => $this->activities(),
        ]);
    }

    public function activities(): Collection
    {
        return Activity::limit(6)
            ->orderBy('id', 'DESC')
            ->where('causer_id', auth()->id())
            ->where('causer_type', User::class)
            ->get();
    }
}
