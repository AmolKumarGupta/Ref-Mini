<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\GithubClient;

class DashBoardController extends Controller
{    
    public function index (GithubClient $client) {
        $projectsView = $this->displayRepo($client);
        return view('dashboard.dashboard', compact('projectsView'));
    }

    /**
     * Used to retrieve repositories data for dashboard
     */
    public function displayRepo(GithubClient $client) {
        try {
            $repos = $client->cache('repos');
            $reposCount = count($repos);
            $displayRepo = array_slice($repos, 0, 7);

            return view('dashboard.projects', compact('displayRepo', 'repos', 'reposCount'));

        }catch (\Exception $e) {
            if ( $e->getMessage() == 'Bad credentials') {
                return view('errors.dashboard.projects', ['error' => 'In-Valid Github Token']);

            }
            return view('errors.dashboard.projects', ['error' => $e->getMessage() ]);
            // return view('errors.dashboard.projects', ['error' => 'Something went wrong']);
        }
    }

}
