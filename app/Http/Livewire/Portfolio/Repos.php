<?php

namespace App\Http\Livewire\Portfolio;

use Livewire\Component;
use App\Library\GithubClient;
use App\Models\PortfolioRepo;

class Repos extends Component
{
    protected $listeners = [
        'sort' => 'sort',
    ];
    public $data;
    public $hash;

    public function mount(GithubClient $client) {
        $this->hash = [];
        try {
            $this->data = $client->cache('repos');
            foreach ($this->data as $d) {
                $this->hash[ $d['id'] ] = $d['name'];
            }

        }catch (\Exception $e) {
            $this->data = [];
            if ( $e->getMessage() == 'Bad credentials') {
                // 
            }
        }


    }

    public function render()
    {
        $this->sortedData();
        return view('livewire.portfolio.repos');
    }

    public function sortedData () {
        $repos = PortfolioRepo::where( 'user_id', auth()->user()->id )->orderBy('sort_by', 'asc')->get();
        $data = $this->data;

        $hash = [];
        foreach ($data as $d) {
            $hash[ $d['id'] ] = $d;
        }

        $sortedData = [];
        foreach ( $repos as $r ) {
            $sortedData[] = $hash[ $r->pid ];
            unset( $hash[ $r->pid ] );
        }
        foreach ( $hash as $h ) {
            $sortedData[] = $h;
        }

        $this->data = $sortedData;
    }

    public function sort ($orderdata) {
        $orderdata = json_decode($orderdata, true);

        $insertBatch = [];
        foreach ( $orderdata as $idx=>$data ) {
            $repo = PortfolioRepo::where('pid', $data)->where( 'user_id', auth()->user()->id )->first();
            if ($repo == null) {
                $insertBatch[] = [
                    "user_id" => auth()->user()->id,
                    "pid" => $data, 
                    "name" => $this->hash[ $data ],
                    "sort_by" => $idx
                ];
                continue;
            }

            $repo->sort_by = $idx;
            $repo->save();
        }

        if ($insertBatch) {
            PortfolioRepo::insert( $insertBatch );
        }
    }
}
