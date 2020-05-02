<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('aid.site_title') }}</title> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="aid-page">
    
    @yield("content")
    
    <script async src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
