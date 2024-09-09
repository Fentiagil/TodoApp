<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Include other CSS files if needed -->
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content_header')
            @yield('content')
        </div>
    </div>

    <!-- Include AdminLTE JS -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- Include other JS files if needed -->
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Include other CSS files if needed -->
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content_header')
            @yield('content')
        </div>
    </div>

    <!-- Include AdminLTE JS -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- Include other JS files if needed -->
</body>
</html>
