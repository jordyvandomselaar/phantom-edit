<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')

    {{-- Website style --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('custom_styles')

    {{-- js csrfToken --}}
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    @yield('content')

    @stack('custom_scripts')
</body>
</html>