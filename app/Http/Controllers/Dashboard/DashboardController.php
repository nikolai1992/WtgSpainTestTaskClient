<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\WTGApiServices;

class DashboardController extends Controller
{
    private WTGApiServices $wtgApiService;
    public function __construct()
    {
        $this->wtgApiService = app(WTGApiServices::class);
    }
	public function index()
	{
        $tasks = $this->wtgApiService->getTasks();
        return view('dashboard.dashboard', compact('tasks'));
	}
}
