<?php

namespace App\Http\Livewire\Portfolio;

use Livewire\Component;
use App\Library\GithubClient;

class Repos extends Component
{
    public $data;

    public function mount(GithubClient $client) {
        try {
            $this->data = $client->cache('repos');

        }catch (\Exception $e) {
            $this->data = [];
            if ( $e->getMessage() == 'Bad credentials') {
                // 
            }
        }
    }

    public function render()
    {
        return view('livewire.portfolio.repos');
    }
}
