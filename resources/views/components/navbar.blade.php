<nav class="navbar navbar-expand-lg nav-custom fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse justify-content-between" id="navbarScroll">
            <a class="nav-link " aria-current="page" href="{{ route('home') }}"><i
                    class="fa-solid fa-bolt icon-custom"></i> Flash.it</a>
            <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('announcements.index') }}">Tutti i
                        prodotti</a>
                </li>
                <li><a class="nav-link" href="{{ route('createAnnouncement') }}">Vendi i tuoi prodotti</a>
                </li>

                <div class="nav-item">
                    @auth

                        @if (Auth::user()->is_revisor)
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-success btn-sm position-relative" aria-current="page"
                                    href="{{ route('revisor.index') }}">
                                    Zona revisore
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ App\Models\Announcement::toBeRevisionedCount() }}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </a>
                            </li>
                        @endif

                    @endauth
                </div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="=button"
                        data-bs-toggle="dropdown" aria-expanded="false">Categorie</a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item"
                                    href="{{ route('categoryShow', compact('category')) }}">{{ $category->name }}</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @guest Unisciti a noi
                        @else
                            Ciao , {{ Auth::user()->name }}

                        @endguest

                    </a>
                    <ul class="dropdown-menu">
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
                        @endguest
                        @auth
                            <li><a class="dropdown-item" href="{{ route('announcements.index') }}">I tuoi prodotti</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.querySelector('#form-logout').submit();">Logout</a>
                            </li>
                            <form action="{{ route('logout') }}" method="post" id="form-logout">
                                @csrf
                            </form>
                        @endauth
                    </ul>
                </li>
                <li class="nav-item">
                    <x-_locale lang="it" />
                </li>
                <li class="nav-item">
                    <x-_locale lang="es" />
                </li>
                <li class="nav-item">
                    <x-_locale lang="en" />
                </li>
            </ul>
            <div>
                <form action="{{ route('announcements.search') }}" method="GET" class="d-flex">
                    <input name="searched" class="form-control me-2" type="search" placeholder="Cerca"
                    aria-label="Search">
                    <button class="btn btn-search" type="submit">Cerca</button>
                </form>
            </div>
        </div>
    </div>
</nav>
