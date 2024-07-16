<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Perfil'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('../assets/img/z_FELCC (1).jpg'); background-position: center 100%;">
            </div>
        </div>

        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ asset('assets') }}/img/juan.jpg" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name }}
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            @foreach(auth()->user()->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profileSection"
                                    role="tab" aria-selected="true">
                                    <i class="material-icons text-lg position-relative">home</i>
                                    <span class="ms-1">Perfil</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" href="#messagesSection" role="tab"
                                    aria-selected="false" id="messagesLink">
                                    <i class="material-icons text-lg position-relative">email</i>
                                    <span class="ms-1">Mensajes</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 id="sectionTitle">Información del Perfil</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3" id="profileSection">
                    <!-- Contenido del perfil -->
                    @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (Session::has('demo'))
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('demo') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <form method='POST' action='{{ route('user-profile') }}'>
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Dirección de Correo</label>
                                <input type="email" name="email" class="form-control border border-2 p-2"
                                    value='{{ old('email', auth()->user()->email) }}'>
                                @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" class="form-control border border-2 p-2"
                                    value='{{ old('name', auth()->user()->name) }}'>
                                @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="number" name="phone" class="form-control border border-2 p-2"
                                    value='{{ old('phone', auth()->user()->phone) }}'>
                                @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Dirección</label>
                                <input type="text" name="location" class="form-control border border-2 p-2"
                                    value='{{ old('location', auth()->user()->location) }}'>
                                @error('location')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="floatingTextarea2">Sobre mí</label>
                                <textarea class="form-control border border-2 p-2" placeholder="Di algo sobre ti"
                                    id="floatingTextarea2" name="about" rows="4"
                                    cols="50">{{ old('about', auth()->user()->about) }}</textarea>
                                @error('about')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark">Guardar</button>
                    </form>
                </div>
            </div>

            <!-- Sección de Mensajes -->
            <div id="messagesSection" class="mt-3" style="display: none;">
                <div class="card card-body mx-3 mx-md-4 mt-n6">
                    <div class="row gx-4 mb-2">
                        <div class="col-md-12">
                            <h6>Todos los Mensajes</h6>
                            <!-- Listado de mensajes -->
                            @foreach ($mensajes as $mensaje)

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Nombre: {{ $mensaje->data }}</h5>
                                        <p class="card-text">Asunto: {{ $mensaje->asunto }}</p>
                                        <p class="card-text">Mensaje: {{ $mensaje->mensaje }}</p>
                                        <p class="card-text"><small
                                                class="text-muted">{{ $mensaje->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>


                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de la sección de Mensajes -->
        </div>

    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messagesLink = document.querySelector('#messagesLink');
        const profileSection = document.querySelector('#profileSection');
        const messagesSection = document.querySelector('#messagesSection');

        messagesLink.addEventListener('click', function (event) {
            event.preventDefault();
            profileSection.style.display = 'none';
            messagesSection.style.display = 'block';
            scrollToSection(messagesSection);
        });

        const appLink = document.querySelector('[href="#profileSection"]');
        appLink.addEventListener('click', function (event) {
            event.preventDefault();
            messagesSection.style.display = 'none';
            profileSection.style.display = 'block';
            scrollToSection(profileSection);
        });

        function scrollToSection(section) {
            const offsetTop = section.offsetTop;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
</script>