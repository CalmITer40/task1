<header>
    <div class="menu-container">
        @if(Auth::check())
            <a href="/products" @class(['active' => Route::getCurrentRoute()->getPrefix() == '/products'])>Продукты</a>
        @endif
    </div>

    <div class="user-info">
        @if(Auth::check())
            <p>{{ Auth::user()->fullName }}</p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">(Выйти)</a>
            </form>
        @else
            <a href="/login">Войти</a>
        @endif
    </div>
</header>
