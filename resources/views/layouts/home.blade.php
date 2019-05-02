<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.head')
<body>
<main>
    <section class="hero is-primary is-large">
        <div class="hero-head">
            @include('layouts.partials.navigation')
        </div>
        @yield('content')
    </section>
</main>
</body>
</html>
