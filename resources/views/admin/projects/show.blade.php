@extends('layouts.app')

@section('content')
<div class="container my-5">

    @if(session('edit'))
        <div class="alert alert-success">
            {{session('edit')}}
        </div>
    @endif

    <a class="btn btn-warning" href="{{route('admin.projects.edit', $project)}}">
        <i class="fa-solid fa-pencil"></i>
    </a>
    @include('admin.partials.formDelete', [
        'route' => route('admin.projects.destroy', $project),
        'message' => "Sei sicuro di voler eliminare il progetto: $project->title?"
    ])

    <h1>{{$project->id}}# {{$project->title}}</h1>
    <h3>Categoria: {{$project->type? $project->type->name : 'Nessuna Categoria'}}</h3>

    @forelse ($project->technologies as $technology)
        <span class="badge text-bg-info">{{$technology->name}}</span>
    @empty
        --
    @endforelse

    <p>Descrizione: {{$project->description}}</p>
    <h3>Data di inizio: {{$project->start_date}}</h3>

    {{-- immagine --}}
    <div class="col-auto">
        <img class="img-show" src="{{asset('storage/' . $project->img_path)}}" alt="{{ $project->img_original_name }}" onerror="this.src='/img/no_img.jpg'">
    </div>

    <a class="btn btn-primary" href="{{route('admin.projects.index')}}">
        indietro
    </a>


</div>
@endsection
