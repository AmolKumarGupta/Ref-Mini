<?php

namespace App\Http\Controllers;

use App\Library\GithubClient;
use App\Models\HabitTrack;

class DashBoardController extends Controller
{
    public function index(GithubClient $client)
    {
        $projectsView = $this->displayRepo($client);
        $trackWeekCount = $this->trackWeekCount();

        return view('dashboard.dashboard', compact('projectsView', 'trackWeekCount'));
    }

    /**
     * Used to retrieve repositories data for dashboard.
     */
    public function displayRepo(GithubClient $client)
    {
        try {
            $repos = $client->cache('repos');
            $reposCount = count($repos);
            $displayRepo = array_slice($repos, 0, 7);

            return view('dashboard.projects', compact('displayRepo', 'repos', 'reposCount'));
        } catch (\Exception $e) {
            if ($e->getMessage() == 'Bad credentials') {
                return view('errors.dashboard.projects', ['error' => 'In-Valid Github Token']);
            }

            return view('errors.dashboard.projects', ['error' => $e->getMessage()]);
            // return view('errors.dashboard.projects', ['error' => 'Something went wrong']);
        }
    }

    protected function trackWeekCount(): array
    {
        $current = HabitTrack::where('fk_user_id', auth()->id())
                ->where('date', '>', now()->startOfWeek()->toDateTime())
                ->count();

        $previous = HabitTrack::where('fk_user_id', auth()->id())
            ->where('date', '<', now()->startOfWeek()->toDateTime())
            ->where('date', '>', now()->startOfWeek()->subDays(7)->toDateTime())
            ->count();

        $percentage = (int) $previous > 0 ? ($current - $previous) / $previous * 100 : 0;

        return compact('current', 'previous', 'percentage');
    }
}
