@props(['signin', 'signup'])

<nav
    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
    <div class="container-fluid ps-2 pe-0">
        
            <div class="d-flex flex-column">
                <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="{{ route('dashboard') }}">
                    FELCC
                </a>
                <center>
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="{{ route('dashboard') }}">
                        Proteger al pueblo cumpliendo y haciendo cumplir la ley, brindando seguridad integral con
                        EXCELENCIA
                    </a>
                </center>

            </div>
        

        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                            href="{{ route('dashboard') }}">
                            <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('profile') }}">
                            <i class="fa fa-user opacity-6 text-dark me-1"></i>
                            Profile
                        </a>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>