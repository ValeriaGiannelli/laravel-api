<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('technologies', 'type')->paginate(10);

        if($projects){
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'projects'));
    }


    public function technologies(){
        $technologies = Technology::all();

        if($technologies){
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'technologies'));
    }
}
