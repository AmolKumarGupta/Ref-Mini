<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\GithubClient;

class DashBoardController extends Controller
{    
    public function index (GithubClient $client) {
        // dd( $client->cache('repos') );
        return view('dashboard.dashboard');
    }
}
