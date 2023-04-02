<?php

namespace App\Library;

use App\Models\Gist;
use Github\AuthMethod;
use Github\Client;
use Illuminate\Support\Facades\Cache;

class GithubClient
{
    public Client $client;

    public function auth()
    {
        if (isset($this->client) && $this->client) {
            return $this->client;
        }

        $this->client = new Client();
        $token = auth()->user()->gists_token;
        if ($token == null) {
            $token = '';
        }
        $this->client->authenticate($token, null, AuthMethod::ACCESS_TOKEN);

        return $this->client;
    }

    private function createGist($file): Gist|null
    {
        $dict = config('github.gists');
        if (!array_key_exists($file, $dict)) {
            return null;
        }

        $fileArray = [];
        $fileArray[config('github.prefix') . $file . '.json'] = ['content' => '[]'];

        $data = [
            'files' => $fileArray,
            'public' => true,
            'description' => config('github.description'),
        ];
        $gist = $this->auth()->api('gists')->create($data);

        $model = new Gist;
        $model->fk_user_id = auth()->user()->id;
        $model->file = $file;
        $model->gist_id = $gist['id'];
        $model->save();

        return $model;
    }

    public function gist($file): Gist|null
    {
        $dict = config('github.gists');
        if (!array_key_exists($file, $dict)) {
            return null;
        }

        $gist = Gist::where('file', $file)->where('fk_user_id', auth()->user()->id)->first();
        if ($gist) {
            return $gist;
        }

        return $this->createGist($file);
    }

    public function repos()
    {
        $client = new Client();
        $token = auth()->user()->gists_token;
        if ($token == null) {
            $token = '';
        }
        $client->authenticate($token, null, AuthMethod::ACCESS_TOKEN);
        $repos = $client->currentUser()->repositories('owner', 'pushed', 'desc');

        return $repos;
    }

    public function cache($func)
    {
        return Cache::remember($func, 3600, function () use ($func) {
            return $this->$func();
        });
    }

    public function update($file, $content)
    {
        $gist = $this->gist($file);

        $data = [
            'files' => [
                config('github.prefix') . $file . '.json' => [
                    'content' => json_encode($content),
                ],
            ],
        ];
        $gistData = $this->auth()->api('gists')->update($gist->gist_id, $data);
        activity()->on($gist)->log(':causer.name synced the repositories');
    }
}
