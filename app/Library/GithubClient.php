<?php
namespace App\Library;

use Github\Client;
use Github\AuthMethod;
use Illuminate\Support\Facades\Cache;

class GithubClient 
{
    public function repos() {
        $client = new Client();
        $client->authenticate(auth()->user()->gists_token, null, AuthMethod::ACCESS_TOKEN);
        $repos = $client->currentUser()->repositories('owner', 'pushed', 'desc');
        return $repos;
    }

    public function cache($func) {
        return Cache::remember($func, 3600, function () use($func) {
            return $this->$func();
        });
    }
}