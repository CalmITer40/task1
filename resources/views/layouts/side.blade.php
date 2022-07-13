<aside class="left-side">
    <div class="logo-container">
        <div class="logo-container-icon-shape">
            <img src="assets/img/logo.svg" alt="Logo"/>
        </div>
        <span class="logo-container-name">
            Enterprise<br>
            Resource<br>
            Planning
        </span>
    </div>
    <div class="menu-container">
        @if(Auth::check())
            <a href="/products">Продукты</a>
        @endif
    </div>
</aside>
