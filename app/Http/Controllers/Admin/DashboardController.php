<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index(){

        $projects = Project::count();
        // dump('Index della dashboard protetta');
        return view('admin.index', compact('projects'));
    }
}
