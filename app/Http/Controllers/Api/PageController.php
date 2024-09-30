<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{

    // mi prende i progetti e le technologie e tipi associati
    public function index(){
        $projects = Project::with('technologies', 'type')->paginate(10);

        // gestione se esistono i progetti
        if($projects){
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'projects'));
    }


    // mi prende l'elenco delle tecnologie (linguaggi di programmazione)
    public function technologies(){
        $technologies = Technology::all();

        // gestione se esistono le tecnologie
        if($technologies){
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'technologies'));
    }


    // mi prende il tipi
    public function types(){
        $types = Type::all();

        // gestione se esistono i tipi
        if($types){
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'types'));
    }

    // prenda tutti i progetti associati a un tipo specifico
    public function projectsByType($slug){

        $type = Type::where('slug', $slug)->with('projects')->first();

        if($type){
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'type'));

    }

}
