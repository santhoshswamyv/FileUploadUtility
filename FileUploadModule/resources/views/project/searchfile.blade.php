@extends('layouts.layout')
@section('content')
    <form action="{{ url('/search/files') }}" id="searchForm" method="post">
        @csrf
        <div class="mb-3 mt-3">
            <label for="filecode" class="form-label">Filecode : </label>
            <input type="text" name="filecode" placeholder="Filecode" class="form-control" id="filecode" required>
        </div>
        <div class="mb-3">
            <button type="submit" id="submitbtn" class="btn btn-outline-info"><i class="fa fa-search"></i> Search</button>
        </div>
    </form>
    <div id="searchResults" class="container-fluid"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            //Getting the submit button by id
            var sbtbtn = $('#submitbtn');

            //Setting up event listener for form submit
            $('#searchForm').on('submit', function(e) {

                //Disable HTML submit button
                e.preventDefault();

                //Disable submit buttoon to prevent unnecessary submission
                sbtbtn.attr("disabled", "disabled");

                //Clear the content at the start of a new search
                $('#searchResults').empty();

                //Submit form using AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'post',
                    data: $(this).serialize(),

                    //If Response Received
                    success: (data) => {

                        //If it was a Negative Response
                        if (data.status === 'error') {
                            var heading = $('<h2 class="mb-4 mt-5">Search Details : </h2>');
                            var error = $('<h2 class="mb-3 text-danger">' + data
                                .message + '</h2>');
                            var check = $(
                                '<h3 class="text-warning">Make sure you have entered valid filecode...!!</h1>'
                            );
                            $('#searchResults').append(heading);
                            $('#searchResults').append(error);
                            $('#searchResults').append(check);
                        }

                        //If it was a Positive Response
                        else {

                            //Creating Elements For the Response
                            var heading = $('<h2 class="mb-4 mt-5">Search Details : </h2>');
                            var fileCode = $('<h2 class="mb-3 text-info">File Code : ' + data
                                .recorddata
                                .filecode +
                                '</h2>');
                            var fileName = $('<h3 class="mb-5 text-warning">File Name : ' + data
                                .recorddata
                                .filename +
                                '</h3>');
                            var btngrp = $('<div class="row"></div>');
                            var viewbtn = $('<div class="col-md-2"><a href="/view/' + data
                                .recorddata
                                .filename +
                                '/' + data.recorddata
                                .filecode +
                                '"><button class="btn btn-outline-primary"><i class="fa fa-display"></i> View File</button></a></div>'
                            );
                            var dwldbtn = $(
                                '<div class="col-md-2"><a href="/download/' +
                                data
                                .recorddata
                                .filename +
                                '/' + data.recorddata
                                .filecode +
                                '"><button class="btn btn-outline-success"><i class="fa fa-download"></i> Download</button></a></div>'
                            );
                            var dltbtn = $('<div class="col-md-2"><a href="/delete/' + data
                                .recorddata
                                .filename +
                                '/' + data.recorddata
                                .filecode +
                                '"><button class="btn btn-outline-danger delete-btn"><i class="fa fa-trash"></i> Delete File</button></a></div>'
                            );

                            //Appending all the buttons into single div
                            var fileExtension = data.recorddata.filecode.substring(0, 3);

                            //Confirming that it is not a DOCX type
                            if (fileExtension !== 'doc') {
                                btngrp.append(viewbtn);
                                btngrp.append(dwldbtn);
                                btngrp.append(dltbtn);
                            }
                            //If it is a DOC or DOCX Type
                            else {
                                btngrp.append(dwldbtn);
                                btngrp.append(dltbtn);
                            }

                            //Append all the element to the searchResults div
                            $('#searchResults').append(heading);
                            $('#searchResults').append(fileCode);
                            $('#searchResults').append(fileName);
                            $('#searchResults').append(btngrp);
                        }
                    },
                    complete: function() {

                        //Enable submit button again
                        sbtbtn.removeAttr("disabled");
                    }
                });
            });

            //Setting up event listener for Delete Button
            $(document).on('click', '.delete-btn', function(e) {

                //Disable HTML submit button
                e.preventDefault();

                //Confirm deletion
                if (!confirm('Are you sure to delete this file')) {
                    return;
                }

                //Clear searchResults div
                $('#searchResults').empty();

                //Get the URL from the <a> tag
                var url = $(this).parent().attr('href');

                //Send AJAX request
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    //If Response Received
                    success: function(result) {

                        //If it is a Positive Response
                        if (result.status === 'Success') {
                            var status = $(
                                '<h3 class="text-success mt-5 mb-3">' + result
                                .status + '</h1>'
                            );
                            var action = $('<h2 class="mb-3 text-danger">' + result
                                .message + '</h2>');

                            //Appending the Variables or Tags inside the Div Element
                            $('#searchResults').append(status);
                            $('#searchResults').append(action);
                        }
                        //If it is a Negative Response
                        else {

                            //Redirecting to Error Page
                            window.location.href = "/error404";
                        }
                    }
                });
            });
        });
    </script>
@endsection
