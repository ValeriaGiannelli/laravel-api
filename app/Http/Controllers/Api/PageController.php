<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('technologies', 'type')->get();

        if($projects){
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'projects'));
    }
}
