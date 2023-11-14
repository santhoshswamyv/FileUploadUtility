@extends('layouts.layout')
@section('content')
    <div class="pb-5">
        <h1 class="text-light">File Upload Utility</h1>
    </div>
    <div class="pb-5">
        <h3 class="text-primary">Only CSV, XLS, XLSX, PDF, TXT, DOC, DOCX Accepted</h3>
    </div>
    <div class="row">
        <div class="col-md-2"><a href="{{ url('/upload') }}"><button class="btn btn-outline-success"><i class="fa fa-upload"></i> Upload File</button></a>
        </div>
        <div class="col-md-2"> <a href="{{ url('/search') }}"><button class="btn btn-outline-info"><i class="fa fa-search"></i> Search File</button></a>
        </div>
        <div class="col-md-2"><a href="{{ url('/download') }}"><button class="btn btn-outline-warning"><i class="fa fa-download"></i> Download
                    Files</button></a></div>
        <div class="col-md-2"><a href="{{ url('/cleartemp') }}"><button class="btn btn-outline-danger"
                    onclick="return confirm('Are you sure to delete all the Temp Files Present ?')"><i class="fa fa-trash"></i> Clear Temp
                    Files</button></a></div>
    </div>
@endsection
