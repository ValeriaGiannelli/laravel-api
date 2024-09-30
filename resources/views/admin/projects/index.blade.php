@extends('layouts.app')

@section('content')
<div class="container my-5">

    {{-- search bar --}}
    <form action="{{route('admin.projects.index')}}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" value="{{ request('search') }}">
            <button class="btn" type="submit" class="form-control">Cerca</button>

        </div>
    </form>


    <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">
                    <a href="{{route('admin.projects.index', ['direction'=> $direction, 'column'  => 'id'])}}">id</a>
                </th>
                <th scope="col">Immagine</th>
                <th scope="col">
                    <a href="{{route('admin.projects.index', ['direction'=> $direction, 'column'  => 'title'])}}">Titolo</a>
                </th>
                <th scope="col">Inizio</th>
                <th scope="col">Fine</th>
                <th scope="col">Categoria</th>
                <th scope="col">Tecnologia</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $projects as $project )
                    <tr>
                            <td class="col-auto"> {{$project->id}}</td>
                            {{-- immagine --}}
                            <td class="col-auto">
                                <img class="thumb-mini" src="{{asset('storage/' . $project->img_path)}}" alt="{{ $project->img_original_name }}" onerror="this.src='/img/no_img.jpg'">
                            </td>
                            <td class="col-auto"> {{$project->title}} </td>
                            <td class="col-auto">{{($project->start_date)->format('d-m-Y')}}</td>
                            <td class="col-auto">@if(Carbon\Carbon::now()<=$project->end_date) In progress @else {{($project->end_date)->format('d-m-Y')}} @endif</td>
                            {{-- categoria --}}
                            <td class="col-auto"><span class="badge text-bg-info">{{$project->type?->name}}</span></td>

                            {{-- technology --}}
                            <td class="col-auto">
                                @forelse ($project->technologies as $technology)
                                    <span class="badge text-bg-info">{{$technology->name}}</span>
                                @empty
                                    --
                                @endforelse
                            </td>

                            <td class="col-auto">
                                <a class="btn btn-primary" href="{{route('admin.projects.show', $project)}}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a class="btn btn-warning" href="{{route('admin.projects.edit', $project)}}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                @include('admin.partials.formDelete', [
                                    'route' => route('admin.projects.destroy', $project),
                                    'message' => "Sei sicuro di voler eliminare il progetto: $project->title?"
                                ])

                            </td>
                    </tr>
                @endforeach

            </tbody>
          </table>

          {{$projects->links()}}
    </div>

</div>
@endsection
