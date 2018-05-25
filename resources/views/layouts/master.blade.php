<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @yield('style')
</head>
<body>
    <div class="main">
        @include('includes.header')
        @yield('content')
    </div>
</body>
</html>