<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand" >
            <a href="{{ route('home') }}" class="navbar-item">
                {{ config('app.name') }}
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div class="navbar-end">
            @if(auth()->check())
                <a href="#" class="navbar-item ">
                    Your account
                </a>

                <a href="#" class="navbar-item"  onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                    Sign out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="navbar-item has-text-white">
                    Sign in
                </a>

                <a href="{{ route('register') }}" class="navbar-item has-text-white">
                    Start selling
                </a>
            @endif
        </div>
    </div>
</nav>