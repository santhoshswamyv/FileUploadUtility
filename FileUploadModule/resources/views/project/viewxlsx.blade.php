@extends('layouts.layout')
@section('content')
    <div class="pb-3">
        <h1 class="text-light">Filecode : {{ $fileCode }}</h1>
        <h2 class="text-primary">Filename : {{ $fileName }}</h2>
    </div>
    <hr style=" width:100%;">
    <table class="table text-light">
        @php $count=0; @endphp
        @foreach ($fileData as $line)
            @php $count++; @endphp
            @if ($count === 1)
                <tr>
                    @foreach ($line as $cell)
                        <th>{{ $cell }}</th>
                    @endforeach
                </tr>
            @else
                <tr>
                    @foreach ($line as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endif
        @endforeach
    </table>
@endsection
