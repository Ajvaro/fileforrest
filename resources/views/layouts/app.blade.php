<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%;">
@include('layouts.partials.head')
<body style="height: 100%;">
@include('layouts.partials.navigation')
<main>
    @yield('content')
</main>
</body>
</html>
