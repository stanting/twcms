<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin-static/css/global.css') }}" type="text/css" rel="stylesheet" />
    <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-static/js/global.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var pKey = "{{ $action = explode('/', request()->path())[1] }}",
            urlKey = "{{ $url = request()->url() }}",
            place = "{{ $nav['menu'][$action] }}&#187;{{ $title = $nav['child'][$action][$url] }}";
    </script>
    <title>{{ $title }}</title>
</head>

<body>

    @yield('content')

    @yield('js')
</body>
</html>
