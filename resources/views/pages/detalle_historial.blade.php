<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="historial"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Historial"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Detalles de la Denuncia</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td><strong>Caso</strong></td>
                                        <td>{{$denuncia->id}}/{{$denuncia->created_at->format('Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Lugar del Hecho</strong></td>
                                        <td>{{ $denuncia->lugar_hecho }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fecha del Hecho</strong></td>
                                        <td>{{ $denuncia->fecha_hecho }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Hora del Hecho</strong></td>
                                        <td>{{ $denuncia->hora_hecho }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Instrumento Utilizado</strong></td>
                                        <td>{{ $denuncia->instrumento_utilizado }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Declaración</strong></td>
                                        <td style="word-wrap: break-word; white-space: pre-wrap;">
                                            {{ $denuncia->declaracion }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ubicación</strong></td>
                                        <td>{{ $denuncia->ubicacion->latitud ?? 'N/A' }} ,
                                            {{ $denuncia->ubicacion->longitud ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Denunciante</strong></td>
                                        <td>{{ $denuncia->denunciante->nombre_completo ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Oficial</strong></td>
                                        <td>{{ $denuncia->oficial->nombre_completo ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fiscal</strong></td>
                                        <td>{{ $denuncia->fiscal->nombre_completo ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Denunciados</strong></td>
                                        <td>
                                            @foreach ($denuncia->denunciados as $denunciado)
                                                {{ $denunciado->nombre_completo }},
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Victima</strong></td>
                                        <td>
                                            @foreach ($denuncia->victimas as $victima)
                                                {{ $victima->nombre_completo }},
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Delito</strong></td>
                                        <td>
                                            @foreach ($denuncia->delitos as $delito)
                                                {{ $delito->nombre }},
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Declaración Formal</strong></td>
                                        <td style="word-wrap: break-word; white-space: pre-wrap;">
                                            {{ $denuncia->declaracion_formal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Estado</strong></td>
                                        <td>

                                            {{$denuncia->estado}}
                                        </td>
                                    </tr>
                                    <!-- Botón para mostrar modal -->
                                    <tr>
                                        <td><strong>Evidencias</strong></td>
                                        <td>
                                            @if ($denuncia->evidencias->count() > 0)
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalEvidencias">
                                                    Mostrar Evidencias
                                                </button>
                                            @else
                                                No hay evidencias disponibles.
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal para mostrar evidencias -->
                                    <div class="modal fade" id="modalEvidencias" tabindex="-1"
                                        aria-labelledby="modalEvidenciasLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEvidenciasLabel">Evidencias de la
                                                        Denuncia</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @foreach ($denuncia->evidencias as $evidencia)
                                                            <div class="col-md-4 mb-4">
                                                                <a href="{{ asset($evidencia->path) }}" target="_blank">
                                                                    <img src="{{ asset($evidencia->path) }}"
                                                                        class="img-fluid img-thumbnail"
                                                                        style="max-width: 100%;" alt="Evidencia">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Asegúrate de que Bootstrap y jQuery estén correctamente incluidos en tu layout principal (app.blade.php o similar) -->
                                    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
                                    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
                                    <script src="{{ asset('js/jquery.min.js') }}"></script>
                                    @if($denuncia->estado === 'Finalizado')
                                        <tr>
                                            <td><strong>Fecha Finalizacion</strong></td>
                                            <td>{{ $denuncia->updated_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <a href="{{ route('historial')}}"
                                            class="btn btn-success">Volver</a>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para mostrar evidencias -->
        <div class="modal fade" id="modalEvidencias" tabindex="-1" aria-labelledby="modalEvidenciasLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEvidenciasLabel">Evidencias de la Denuncia</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($denuncia->evidencias as $evidencia)
                                <div class="col-md-4 mb-4">
                                    <a href="{{ asset($evidencia->path) }}" target="_blank">
                                        <img src="{{ asset($evidencia->path) }}" class="img-fluid img-thumbnail"
                                            style="max-width: 100%;" alt="Evidencia">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>

        </div>


    </main>

    <x-plugins></x-plugins>

</x-layout>