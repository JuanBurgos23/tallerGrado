<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="notifications"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Detalle de Denuncia"></x-navbars.navs.auth>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Detalles de la Denuncia</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td><strong>Caso</strong></td>
                                        <td>{{$denuncia->caso}}</td>
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
                                        <td><a href="https://www.google.com/maps/search/?api=1&query={{ $denuncia->ubicacion->latitud ?? 'N/A' }},{{ $denuncia->ubicacion->longitud ?? 'N/A' }}"
                                                target="_blank" class="btn btn-success"><i
                                                    class="fas fa-map-marker-alt"></i> Ver Mapa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Denunciante</strong></td>
                                        <td>{{ $denuncia->denunciante->nombre_completo ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Oficial</strong></td>
                                        <td>
                                            <form action="{{ route('denuncias.update', $denuncia->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @php
                                                    $oficialesDisponibles = $oficiales->filter(function ($oficial) {
                                                        return $oficial->estado == 'Disponible';
                                                    });
                                                @endphp

                                                <select name="id_oficial" class="form-control">
                                                    @if ($oficialesDisponibles->isEmpty())
                                                        <option value="">No hay oficiales disponibles</option>
                                                    @else
                                                        @foreach ($oficialesDisponibles as $oficial)
                                                            <option value="{{ $oficial->id }}" {{ $denuncia->id_oficial == $oficial->id ? 'selected' : '' }}>
                                                                {{ $oficial->nombre_completo }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fiscal</strong></td>
                                        <td>

                                            @php
                                                $fiscalesDisponibles = $fiscales->filter(function ($fiscal) {
                                                    return $fiscal->estado == 'Disponible';
                                                });
                                            @endphp

                                            <select name="id_fiscal" class="form-control">
                                                @if ($fiscalesDisponibles->isEmpty())
                                                    <option value="">No hay fiscales disponibles</option>
                                                @else
                                                    @foreach ($fiscalesDisponibles as $fiscal)
                                                        <option value="{{ $fiscal->id }}" {{ $denuncia->id_fiscal == $fiscal->id ? 'selected' : '' }}>
                                                            {{ $fiscal->nombre_completo }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Estado</strong></td>
                                        <td>
                                            <select name="estado" class="form-control">
                                                <option value="En proceso" {{ $denuncia->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                                <option value="Finalizado" {{ $denuncia->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                            </select>
                                        </td>
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
                                        <td><strong>Declaración Formal</strong></td>
                                        <td><textarea name="declaracion_formal" id="declaracion_formal" rows="4"
                                                cols="50"></textarea></td>
                                    </tr>
                                    <tr>

                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-success">Confirmar Denuncia</button>
                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir Select2 CSS-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Incluir Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: 'Buscar fiscal',
                allowClear: true,
                tags: true,
                dropdownParent: $('.select2').parent(),
                width: '50%'  // Asegúrate de que el select2 ocupe todo el ancho del contenedor
            });
        });
    </script>

</x-layout>