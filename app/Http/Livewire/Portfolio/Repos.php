<?php

namespace App\Http\Livewire\Portfolio;

use Livewire\Component;
use App\Library\GithubClient;

class Repos extends Component
{

    public $data;

    public function mount(GithubClient $client) {
        $this->data = $client->cache('repos');
    }

    public function render()
    {
        return view('livewire.portfolio.repos');
    }
}
