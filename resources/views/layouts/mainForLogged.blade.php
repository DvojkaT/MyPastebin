<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/highlight.min.js"></script>
</head>
<body>
    @include('Inc.header')
    <div class="container">
        <div class="row">
            <div class="col-6">
            @yield('content')
            </div>
            <div class="col-3">
            @include('Inc.asideForPublicPastes')
            </div>
            @if(Auth::check())
            <div class="col-3">
            @include('Inc.asideForUserPastes')
            </div>
            @endif
        </div>
    </div>
</body>
</html>