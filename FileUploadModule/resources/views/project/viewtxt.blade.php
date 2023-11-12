@extends('layouts.layout')
@section('content')
    <div class="pb-3">
        <h1 class="text-light">Filecode : {{ $fileCode }}</h1>
        <h2 class="text-primary">Filename : {{ $fileName }}</h2>
    </div>
    <hr style=" width:100%;">
    <p class="text-justify text-light">
        {!! $fileData !!}
    </p>
@endsection
