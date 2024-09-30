@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        Dashboard dei progetti
    </h2>
    <div class="row justify-content-center">
        <h3>Ti diamo il benvenuto! Ci sono {{$projects}} progetti</h3>
    </div>
</div>
@endsection
