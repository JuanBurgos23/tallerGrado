<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Mdenuncia"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Ver Denuncias"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="col-12">
                <h2>Listado de Denuncias</h2>
                <!-- Formulario de búsqueda -->
                <div class="d-flex justify-content-center mb-4">
                    <!-- Formulario de búsqueda por Numero de Caso -->
                    <form method="GET" action="{{ route('buscar_denuncia') }}" class="me-2">
                        <div class="input-group" style="width: 300px; border: 3px solid #ccc; border-radius: 5px;">
                            <input type="text" name="caso" class="form-control" placeholder="Buscar por Numero de Caso"
                                aria-label="Buscar por Numero de Caso" aria-describedby="button-addon2"
                                style="border: none;">
                            <button class="btn btn-success" type="submit" id="button-addon2"
                                style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </form>

                    <!-- Formulario de búsqueda por CI del Denunciado -->
                    <form method="GET" action="{{ route('buscar_denuncia') }}" class="ms-2">
                        <div class="input-group" style="width: 300px; border: 3px solid #ccc; border-radius: 5px;">
                            <input type="text" name="ci" class="form-control" placeholder="Buscar por CI del Denunciado"
                                aria-label="Buscar por CI del Denunciado" aria-describedby="button-addon3"
                                style="border: none;">
                            <button class="btn btn-success" type="submit" id="button-addon3"
                                style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card my-4">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">Lugar del Hecho</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Fecha
                                    del Hecho</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                    Denunciante</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                    Denunciado</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                    Oficial</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Fiscal
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Estado
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($denuncia as $den)
                                <tr>
                                    <td class="align-middle text-center">{{ $den->lugar_hecho }}</td>
                                    <td class="align-middle text-center">{{ $den->fecha_hecho }}</td>
                                    <td class="align-middle text-center">
                                        {{ $den->denunciante ? $den->denunciante->nombre : 'N/A' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        @foreach ($den->denunciados as $denunciado)
                                            {{ $denunciado->nombre }},
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">{{ $den->oficial ? $den->oficial->name : 'N/A' }}
                                    </td>
                                    <td class="align-middle text-center">{{ $den->fiscal ? $den->fiscal->nombre : 'N/A' }}
                                    </td>
                                    <td class="align-middle text-center">{{ $den->estado }}</td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('detalle_den', $den->id) }}" class="btn btn-success">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Enlaces de paginación -->
                    <div class="d-flex justify-content-center">
                        {{ $denuncia->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>