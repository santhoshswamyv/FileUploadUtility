@extends('layouts.layout')
@section('content')
    <div class="pb-5">
        <h1 class="text-light">File Upload Utility</h1>
    </div>
    <div class="pb-5">
        <h3 class="text-primary">Only CSV, XLSX, PDF, TXT, DOC, DOCX Accepted</h3>
    </div>
    <div class="row">
        <div class="col-md-2"><a href="{{ url('/upload') }}"><button class="btn btn-outline-success">Upload File</button></a>
        </div>
        <div class="col-md-2"> <a href="{{ url('/search') }}"><button class="btn btn-outline-info">Search File</button></a>
        </div>
        <div class="col-md-2"><a href="{{ url('/download') }}"><button class="btn btn-outline-warning">Download
                    Files</button></a></div>
        <div class="col-md-2"><a href="{{ url('/cleartemp') }}"><button class="btn btn-outline-danger"
                    onclick="return confirm('Are you sure to delete all the Temp Files Present ?')">Clear Temp
                    Files</button></a></div>
    </div>
@endsection
