<!doctype html>
<html lang="en">
<head>
@include('partials._head')
</head>
<body>
<header>
@include('partials._header')
</header>
<div class="container">
    @include('partials._messages')
    @yield('content')
</div>
@yield('scripts')
</body>
</html>