<nav class="navbar navbar-expand navbar-light p-3" id="navbar-top">
    <button type="button" id="sidebarCollapse" class="btn">
            <i class="fas fa-bars" id="iconSidebar"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li>
                <a href="{{ url('/login') }}">Login</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            {{-- Selección de idioma --}}
            <li class="dropdown nav-item">
                <a href="" class="dropdown-toggle nav-link text-toogle" data-toggle="dropdown">
                    <span class="align-middle text-uppercase">{{ Config::get('app.locale') }}</span>
                    <i class="fas fa-globe"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-with-icons sub bg-toggle">
                    <a id="lang_ca" class="dropdown-item text-toogle" href="{{ url('/language', ['locale' => 'ca']) }}">Català</a>
                    <a id="lang_en" class="dropdown-item text-toogle" href="{{ url('/language', ['locale' => 'en']) }}">English</a>
                    <a id="lang_es" class="dropdown-item text-toogle" href="{{ url('/language', ['locale' => 'es']) }}">Español</a>
                </div>
            </li>
            <!-- Sesión -->
            <li class="dropdown nav-item">
                <a href="" class="dropdown-toggle nav-link text-toogle" data-toggle="dropdown">
                    @if (Auth::check())
                        <span class="align-middle">{{ Auth::user()->nombre_usuario }}</span>
                    @endif
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-with-icons sub bg-toggle">
                    <a class="dropdown-item text-toogle" href="{{ url('/logout')}}">{{ __('navbar.logout') }}</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
