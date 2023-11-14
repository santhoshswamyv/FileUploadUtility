<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#001a33">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>File Upload Utility</title>
    </head>

<body class="p-5 bg-dark text-white">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" target="_blank" href="">
                        <img src="{{ asset('akatsuki.jpg') }}" alt="Avatar Logo" title="File Upload Utility" style="width:40px;" class="rounded-pill">
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ url('/upload') }}"><i class="fa fa-upload"></i> Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/download') }}"><i class="fa fa-download"></i> Download</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/search') }}"><i class="fa fa-search"></i> Search</a>
                </li>
            </ul>
        </div>
    </nav>
    <br><br>
    <div class="col-md-12" style="margin-top: 0%;">@yield('content')</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>