<?php
namespace App\Library;

use Github\Client;
use Github\AuthMethod;
use Illuminate\Support\Facades\Cache;

class GithubClient 
{
    public Client $client;

    public function auth() {
        $this->client = new Client();
        $token = auth()->user()->gists_token;
        if ($token == null) {
            $token = "";
        }
        $this->client->authenticate($token, null, AuthMethod::ACCESS_TOKEN);
        return $this->client;
    }

    public function repos() {
        $client = new Client();
        $token = auth()->user()->gists_token;
        if ($token == null) {
            $token = "";
        }
        $client->authenticate($token, null, AuthMethod::ACCESS_TOKEN);
        $repos = $client->currentUser()->repositories('owner', 'pushed', 'desc');
        return $repos;
    }

    public function cache($func) {
        return Cache::remember($func, 3600, function () use($func) {
            return $this->$func();
        });
    }

    public function gists() {
        $this->auth();
        // $gists = $this->client->api('gists')->show('4646bbbbf48ff59aab45b490d65c99bb');
        $data = array(
            'files' => array(
                'test.json' => array(
                    'content' => json_encode(["status" => 'true'])
                ),
            ),
            'public' => true,
            'description' => 'This is an test'
        );
        
        // $gist = $this->client->api('gists')->create($data);
        dd( $gist );
    }
}