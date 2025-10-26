<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Category;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Statistics
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('is_completed', true)->count();
        $pendingTasks = $user->tasks()->where('is_completed', false)->count();
        $totalCategories = Category::count();
        
        // Recent tasks
        $recentTasks = $user->tasks()->with('category')
            ->latest()
            ->take(5)
            ->get();
        
        // Tasks by priority
        $highPriorityTasks = $user->tasks()
            ->where('priority', 'high')
            ->where('is_completed', false)
            ->count();

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'totalCategories',
            'recentTasks',
            'highPriorityTasks'
        ));
    }
}