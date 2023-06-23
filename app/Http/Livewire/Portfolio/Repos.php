<?php

namespace App\Http\Livewire\Portfolio;

use App\Library\GithubClient;
use App\Models\PortfolioRepo;
use Livewire\Component;

class Repos extends Component
{
    protected $listeners = [
        'sort' => 'sort',
        'setDisplay' => 'setDisplay',
        'syncrepos' => 'syncRepos',
    ];

    public $data;
    public $hash;
    public $repos;

    public function getData(GithubClient $client)
    {
        $map = [];
        $existedDataArray = [];

        $this->hash = [];
        $this->data = $client->cache('repos');
        $this->repos = PortfolioRepo::where('user_id', auth()->user()->id)->orderBy('sort_by', 'asc')->get();

        foreach ($this->repos as $r) {
            $existedDataArray[] = $r->pid;
            $map[$r->pid] = $r->display;
        }

        $insertBatch = [];
        $userid = auth()->user()->id;
        foreach ($this->data as &$d) {
            $this->hash[$d['id']] = $d['name'];

            if (in_array($d['id'], $existedDataArray)) {
                $d['display'] = $map[$d['id']];
            } else {
                $d['display'] = 0;
                $insertBatch[] = [
                    'user_id' => $userid,
                    'pid' => $d['id'],
                    'name' => $d['name'],
                    'sort_by' => 0,
                ];
            }
        }

        if ($insertBatch) {
            PortfolioRepo::insert($insertBatch);
        }
    }

    public function mount(GithubClient $client)
    {
        try {
            $this->getData($client);
        } catch (\Exception $e) {
            $this->data = [];
            if ($e->getMessage() == 'Bad credentials') {
                //
            }
        }
    }

    public function render()
    {
        $this->sortedData();

        return view('livewire.portfolio.repos');
    }

    public function sortedData()
    {
        $repos = PortfolioRepo::where('user_id', auth()->user()->id)->orderBy('sort_by', 'asc')->get();
        $data = $this->data;

        $hash = [];
        foreach ($data as $d) {
            $hash[$d['id']] = $d;
        }

        $sortedData = [];
        foreach ($repos as $r) {
            if (!isset($hash[$r->pid])) {
                continue;
            }
            $sortedData[] = $hash[$r->pid];
            unset($hash[$r->pid]);
        }
        foreach ($hash as $h) {
            $sortedData[] = $h;
        }

        $this->data = $sortedData;
    }

    public function sort($orderdata)
    {
        $orderdata = json_decode($orderdata, true);

        $insertBatch = [];
        foreach ($orderdata as $idx => $data) {
            $repo = PortfolioRepo::where('pid', $data)->where('user_id', auth()->user()->id)->first();
            if ($repo == null) {
                $insertBatch[] = [
                    'user_id' => auth()->user()->id,
                    'pid' => $data,
                    'name' => $this->hash[$data],
                    'sort_by' => $idx,
                ];
                continue;
            }

            $repo->sort_by = $idx;
            $repo->save();
        }

        if ($insertBatch) {
            PortfolioRepo::insert($insertBatch);
        }

        $activity = activity(config('log.portfolio'))->withProperties($orderdata)->log(':causer.name sorted the portfolio repos');
        $activity->subject_type = "App\Models\PortfolioRepo";
        $activity->save();
    }

    public function setDisplay($pid, $state)
    {
        $repo = PortfolioRepo::where('pid', $pid)->first();
        if ($repo) {
            $repo->display = (int) $state;
            $props = $repo->logProp();
            $repo->save();
            activity(config('log.portfolio'))->on($repo)->withProperties($props)->log(':causer.name updated the :subject.name\'s settings');
        }
    }

    public function syncRepos(GithubClient $client)
    {
        $repos = PortfolioRepo::where('display', 1)->orderBy('sort_by', 'ASC')->get();

        $data = [];
        foreach ($repos as $repo) {
            $data[] = $repo->pid;
        }

        $client->update('repolist', $data);
    }
}
