<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="historial"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Historial"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <h1>Historial de Denuncias</h1>

            @if($denuncias->isEmpty())
                <p>No hay denuncias registradas.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Denunciante</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Oficial</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Fiscal</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Denunciados</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Lugar del Hecho</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Fecha del Hecho</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Estado</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($denuncias as $denuncia)
                            <tr>
                                <td class="align-middle text-center">{{ $denuncia->denunciante->nombre_completo }}</td>
                                <td class="align-middle text-center">{{ $denuncia->oficial->paterno ?? 'N/A' }}</td>
                                <td class="align-middle text-center">{{ $denuncia->fiscal->paterno ?? 'N/A' }}</td>
                                <td class="align-middle text-center">
                                    
                                        @foreach($denuncia->denunciados as $denunciado)
                                            {{ $denunciado->nombre }},
                                        @endforeach
                                    
                                </td>
                                <td class="align-middle text-center">{{ $denuncia->lugar_hecho }}</td>
                                <td class="align-middle text-center">{{ $denuncia->fecha_hecho }}</td>
                                <td class="align-middle text-center">{{ $denuncia->estado }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('detalle_historial', $denuncia->id) }}" class="btn btn-success">Ver Detalles</a>
                                    <!-- Otras acciones como editar o eliminar si es necesario -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                {{ $denuncias->links() }}
            @endif

        </div>
    </main>


</x-layout>