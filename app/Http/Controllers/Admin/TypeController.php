<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;
use App\http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        // prima di inserirla devo vedere se non esiste. Quando verifico l'esistenza di qualcosa è una query!!
        $exists = Type::where('name', $request->name)->first();

        // se non esiste la inserisco
        if(!$exists){

            $data = $request->all();
            // dump($request->all());
            $data['slug'] = Helper::generateSlug($data['name'], Type::class);

            $type = Type::create($data);

            return redirect()->route('admin.types.index')->with('succes', 'Elemento aggiunto con successo');
        } else {
            // se esiste mando messaggio di errore.
            return redirect()->route('admin.types.index')->with('duplicate', 'Attenzione! Elemento già presente nella lista');
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['name'], Type::class);


        $type->update($data);
        return redirect()->route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index');
    }
}
