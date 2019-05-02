<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%;">
@include('layouts.partials.head')
<body class="has-background-primary" style="height: 100%;">
@include('layouts.partials.navigation')
<main>
    @yield('content')
</main>
</body>
</html>
