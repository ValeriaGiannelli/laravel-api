<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    // mi prende i progetti e le technologie e tipi associati
    public function index(){
        $projects = Project::orderBy('id', 'desc')->with('technologies', 'type')->paginate(10);

        // gestione se esistono i progetti
        if($projects){
            $success = true;

            foreach($projects as $project){
                if($project->img_path){
                    $project->img_path = asset('storage/' . $project->img_path);
                } else {
                    $project->img_path = '/img/no_img.jpg';
                    $project->img_original_name = 'placeholder';
                }
            }

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

    // pagina del singolo progetto con tecnologie e tipo
    public function singleProject($slug){
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        // se il progetto esiste ancora
        if($project){

            $success = true;

            // se il progetto ha l'immagine modifica il path con asset storage
            if($project->img_path){
                $project->img_path = Storage::url($project->img_path);
            } else {

                // altrimenti assegnaci l'immagine di placheolder
                $project->img_path = Storage::url('/uploads/no_img.jpg');
                $project->img_original_name = 'placheolder';
            }
        } else {
            $success = false;
        }


        return response()->json(compact('success', 'project'));



    }


    // prenda tutti i progetti associati a un tipo specifico
    public function projectsByType($slug){

        $type = Type::where('slug', $slug)->with('projects')->first();

        if($type){

            $success = true;

            foreach($type->projects as $project){
                if($project->img_path){
                    $project->img_path = asset('storage/' . $project->img_path);
                } else {
                    $project->img_path = '/img/no_img.jpg';
                    $project->img_original_name = 'placeholder';
                }
            }

        } else {
            $success = false;
        }

        return response()->json(compact('success', 'type'));

    }


    // funzione per tutti i post associati a una tecnologia
    public function projectsByTechnology($slug){

        $technology = Technology::where('slug', $slug)->with('projects')->first();

        if($technology){
            $success = true;

            foreach($technology->projects as $project){

                if($project->img_path){

                    $project->img_path = asset('storage/' . $project->img_path);
                } else {
                    $project->img_path = '/img/no_img.jpg';
                    $project->img_original_name = 'placheolder';
                }
            }

        } else {
            $success = false;
        }

        return response()->json(compact('success', 'technology'));
    }

}
