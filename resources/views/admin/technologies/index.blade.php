@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="table-responsive">
        <h1>Aggiungi/modifica le tecnologie</h1>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('duplicate'))
            <div class="alert alert-warning" role="alert">
                {{ session('duplicate') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{route('admin.technologies.store')}}" method="POST">
            @csrf
            <input type="text" name="name">
            <button type="submit">Aggiungi</button>

        </form>



        <table class="table">
            <tbody>
                @foreach ($technologies as $technology )
                    <tr>
                        <td>
                            <form action="{{route('admin.technologies.update', $technology)}}" method="POST" id="edit-form-{{$technology->id}}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{$technology->name}}">
                            </form>
                        </td>

                        <td>
                            <button class="btn btn-warning" type="submit" onclick="submitEditTypeForm({{$technology->id}})">Modifica</button></td>

                        <td>@include('admin.partials.formDelete', [
                            'route' => route('admin.technologies.destroy', $technology),
                            'message' => "Confermi di voler eliminare: $technology->name?"
                        ])</td>
                    </tr>

                @endforeach
            </tbody>
          </table>
    </div>

</div>

<script>
    function submitEditTypeForm(id){
        // prendo il form
        const form = document.getElementById(`edit-form-${id}`);
        form.submit();
    }
</script>
@endsection
