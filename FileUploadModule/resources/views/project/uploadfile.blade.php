@extends('layouts.layout')
@section('content')
<form action="{{ url('/upload/store') }}" id="addForm" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 mt-3">
        <label for="file" class="form-label">Choose File to Upload : </label>
        <input type="file" id="file" name="file" class="form-control" accept=".csv, .xlsx, .xls, .pdf, .txt, .doc, .docx" required>
    </div>
    <div class="mb-3">
        <button type="submit" id="submitbtn" class="btn btn-outline-success"><i class="fa fa-save"></i> Store</button>
    </div>
</form>
<div id="addResults" class="container-fluid"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        //Getting the submit button by id
        var sbtbtn = $('#submitbtn');

        //Setting up event listener for form submit
        $('#addForm').on('submit', function(e) {

            //Disable HTML submit button
            e.preventDefault();

            //Disable submit buttoon to prevent unnecessary submission
            sbtbtn.attr("disabled", "disabled");

            // Clear the content at the start of a new search
            $('#addResults').empty();

            // Create a new FormData instance
            var formData = new FormData(this);

            //Submit form using AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                // data: $(this).serialize(),(Should not Use Because this form handles File)
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType

                //If we Get Response
                success: (data) => {

                    //If it was a Positive Response
                    if (data.status === 'Success') {

                        //Creating Elements for the Response
                        var status = $('<h2 class="mb-4 mt-5 text-success">Status : ' + data
                            .status +
                            ' </h2>');
                        var action = $('<h2 class="mb-2 mt-1 text-primary">Action : ' + data
                            .action +
                            '</h2>');
                        var filecode = $('<h2 class="mb-2 mt-1 text-info">File Code : ' +
                            data.code +
                            '</h2>');
                        var filename = $('<h2 class="mb-3 text-warning">File Name : ' + data
                            .name +
                            '</h2>');

                        //Appending the Response Message
                        $('#addResults').append(status);
                        $('#addResults').append(action);
                        $('#addResults').append(filecode);
                        $('#addResults').append(filename);
                    }
                    //If it was a Negative Response
                    else {

                        //Creating Elements for the Response
                        var status = $(
                            '<h2 class="mb-4 mt-5 text-danger">Status : Failed</h2>');
                        var action = $(
                            '<h2 class="mb-1 mt-1 text-danger">Action : File Not Uploaded</h2>'
                        );

                        //Appending the Response Message
                        $('#addResults').append(status);
                        $('#addResults').append(action);
                    }
                },
                complete: function() {

                    //Enable submit button again
                    sbtbtn.removeAttr("disabled");
                }
            });
        });
    });
</script>
@endsection