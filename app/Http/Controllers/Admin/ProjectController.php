<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // per barra di ricera
        if(isset($_GET['search'])){
            $projects = Project::where('title', 'LIKE', '%' . $_GET['search'] . '%')->paginate(10);
            // per mantenere la search nelle altre pagine (mantiene nella URL il get)
            $projects->append(request()->query());
        } else {

            $projects = Project::orderBy('id', 'desc')->paginate(10);
        }

        // questo cambia tra asc e desc quando clicco sul link
        if(isset($_GET['direction'])){
            $direction = $_GET['direction'] === 'asc' ? 'desc' : 'asc';
        } else {
            $direction = 'desc';
        }

        // questo fa l'order della visualizzazione
        if(isset($_GET['column'])){
            $column = $_GET['column'];
            $projects = Project::orderBy($column, $direction) -> paginate(10);
        } else {
            $projects = Project::orderBy('id', 'desc')->paginate(10);
        }

        $technologies = Technology::all();

        return view('admin.projects.index', compact('projects', 'technologies', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        // dd($data);
        if(array_key_exists('img_path', $data)){
            $img_path = Storage::put('uploads', $data['img_path']);
            $img_original_name = $request->file('img_path')->getClientOriginalName();
            $data['img_path'] = $img_path;
            $data['img_original_name'] = $img_original_name;

        }

        $new_project = Project::create($data);


        // se ho messo nuove technologies ci sarà una chiave in più:
        if(array_key_exists('technologies', $data)){
            $new_project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project);

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->all();
        if($data['title'] !== $project->title){
            $data['slug'] = Helper::generateSlug($data['title'], Project::class);
        }

        // se siste l'array delle immagini
        if(array_key_exists('img_path', $data)){

            // cancella la relazione precedente con l'immagine se esiste
            if($project->img_path){
                Storage::delete($project->img_path);
            }

            $img_path = Storage::put('uploads', $data['img_path']);
            $img_original_name = $request->file('img_path')->getClientOriginalName();
            $data['img_path'] = $img_path;
            $data['img_original_name'] = $img_original_name;

        }

        $project->update($data);

        // se esiste l'array delle tecnologie
        if(array_key_exists('technologies', $data)){
            // devo aggiornare la relazione
            $project->technologies()->sync($data['technologies']);
        } else {
            // se non c'è la chiave tolgo la relazione con la tabella technologies
            $project->technologies()->detach();
        }


        return redirect()->route('admin.projects.show', $project)->with('edit', 'Modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // se il post ha l'immagine cacellala dallo storage
        if($project->img_path){
            Storage::delete($project->img_path);
        }

        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
