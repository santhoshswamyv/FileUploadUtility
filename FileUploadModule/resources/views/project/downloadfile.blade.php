@extends('layouts.layout')
@section('content')
    <div class="pb-5">
        <h1 class="text-light">Download Stored Files</h1>
    </div>
    <div class="row">
        <div class="col-md-2"><a href="{{ url('/download/pdf') }}"><button class="btn btn-outline-danger"><i class="fa fa-file-pdf"></i> PDF
                    Files</button></a></div>
        <div class="col-md-2"> <a href="{{ url('/download/csv') }}"><button class="btn btn-outline-success"><i class="fas fa-file-csv"></i> CSV
                    File</button></a></div>
        <div class="col-md-2"><a href="{{ url('/download/xlsx') }}"><button class="btn btn-outline-info"><i class="fas fa-file-excel"></i> XLSX
                    Files</button></a></div>
        <div class="col-md-2"><a href="{{ url('/download/txtdocx') }}"><button class="btn btn-outline-warning"><i class="fa fa-file-word"></i> TXT / DOCX
                    Files</button></a></div>
        <div class="col-md-2"><a href="{{ url('/download/allfiles') }}"><button class="btn btn-outline-primary"><i class="fa fa-file"></i> All
                    Files</button></a></div>
    </div>
    <div id="result" class="mt-5"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('button').click(function(e) {
            e.preventDefault();

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
                success: function(data) {

                    //If the Response is Positive
                    if (data.status === 'Success') {

                        //Making the Div Element Empty because of Data Appending Again and Again For Every Success Response
                        $('#result').empty();

                        //Create a table
                        var table = $('<table class="table text-light"></table>');

                        //Add table headers
                        var headers = $('<tr></tr>');
                        headers.append($('<th style="text-align:center;"></th>').text('S.No.'));
                        headers.append($('<th style="text-align:center;"></th>').text('File Code'));
                        headers.append($('<th style="text-align:center;"></th>').text('File Name'));
                        headers.append($('<th style="text-align:center;"></th>').text('Uploaded On'));
                        headers.append($('<th colspan="3" style="text-align:center;"></th>').text(
                            'Action'));
                        table.append(headers);

                        //Iterate over each record in the data
                        $.each(data.tabledata, function(index, record) {

                            //Create a new row
                            var row = $('<tr></tr>');

                            //Add the serial number
                            row.append($('<td style="text-align:center;"></td>').text(index +
                                1));

                            //Iterate over each field in the record
                            $.each(record, function(key, value) {

                                //Create a new cell with the value of the field and add it to the row
                                if (key !== 'updated_at' && key !== 'filepath') {
                                    var cell = $('<td style="text-align:center;"></td>')
                                        .text(value);
                                    row.append(cell);
                                }
                            });

                            //Create the Action buttons
                            var button1 = $('<a href="/view/' + record.filename + '/' + record
                                .filecode +
                                '"><button class="btn btn-outline-primary"><i class="fa fa-tv"></i> View File</button></a>'
                            );
                            var button2 = $('<a href="/download/' + record.filename + '/' +
                                record
                                .filecode +
                                '"><button class="btn btn-outline-success"><i class="fa fa-download"></i> Download File</button></a>'
                            );
                            var button3 = $('<a href="/delete/' + record.filename + '/' + record
                                .filecode +
                                '"><button class="btn btn-outline-danger delete-btn"><i class="fa fa-trash"></i> Delete File</button></a>'
                            );

                            //Add the buttons to the row
                            row.append($('<td class="dldbtns"></td>').append(button1).append(
                                button2).append(button3));

                            //Add the row to the table
                            table.append(row);
                        });

                        //Add the table to the #result div element
                        $('#result').html(table);
                    }

                    //If the Response is Negative
                    else {

                        //Making the Div Element Empty because of Data Appending Again and Again For Every Success Response
                        $('#result').empty();

                        //Setting the Data in a Variable
                        var status = $('<h2 class="text-warning mb-3">Status : ' + data.status +
                            '</h2>');
                        var message = $('<h2 class="text-danger">Reason : ' + data.reason + '</h2>');

                        //Appending the Variables or Tags inside the Div Element
                        $('#result').append(status);
                        $('#result').append(message);
                    }
                }

            });
        });

        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();

            //Confirm deletion
            if (!confirm('Are you sure to delete this file')) {
                return;
            }

            //Clear searchResults div
            $('#result').empty();

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
                            '<h3 class="text-success mb-3">' + result
                            .status + '</h1>'
                        );
                        var action = $('<h2 class="mb-3 text-danger">' + result
                            .message + '</h2>');

                        //Appending the Variables or Tags inside the Div Element
                        $('#result').append(status);
                        $('#result').append(action);
                    }
                    //If it is a Negative Response
                    else {

                        //Redirecting to Error Page
                        window.location.href = "/error404";
                    }
                }
            });
        });
    </script>
@endsection
