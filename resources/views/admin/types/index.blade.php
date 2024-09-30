@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="table-responsive">
        <h1>Aggiungi/modifica le tipologie dei progetti</h1>

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


        <form action="{{route('admin.types.store')}}" method="POST">
            @csrf
            <input type="text" name="name">
            <button type="sibmit">Aggiungi</button>

        </form>



        <table class="table">
            <tbody>
                @foreach ($types as $type )
                    <tr>
                        <td>
                            <form action="{{route('admin.types.update', $type)}}" method="POST" id="edit-form-{{$type->id}}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{$type->name}}">
                            </form>
                        </td>

                        <td>
                            <button class="btn btn-warning" type="submit" onclick="submitEditTypeForm({{$type->id}})">Modifica</button></td>

                        <td>@include('admin.partials.formDelete', [
                            'route' => route('admin.types.destroy', $type),
                            'message' => "Confermi di voler eliminare: $type->name?"
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
