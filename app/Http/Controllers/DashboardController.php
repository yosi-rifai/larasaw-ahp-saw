<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Ranking;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alternatives = Alternative::with('hotel')->orderBy('nilai', 'desc')->get();
        $rankings = Ranking::with('alternative.hotel')->orderBy('score', 'desc')->get();
        $totalHotels = Hotel::count();
        $totalCriteria = Criteria::count();
        $totalAlternatives = Alternative::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('alternatives', 'rankings', 'totalHotels', 'totalCriteria', 'totalAlternatives', 'totalUsers'));
    }
}
