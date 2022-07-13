<header>
    <div class="menu-container">
        <a href="/products" @class(['active' => Route::getCurrentRoute()->getPrefix() == '/products'])>Продукты</a>
    </div>

    <div class="user-info">
        @if(Auth::check())
            <p>{{ Auth::user()->fullName }}</p>
        @else
            <a href="/login">Войти</a>
        @endif
    </div>
</header>
