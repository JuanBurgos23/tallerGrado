<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle de Denuncia</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            margin-top: 30px;
            /* Ajusta el margen superior según sea necesario */
        }

        .encabezado {
            text-align: center;
        }

        .encabezado2 {
            text-align: center;
            margin-left: 200px;
            /* Ajusta la separación entre los dos divs según sea necesario */
        }

        .encabezado3 {
            text-align: center;
            margin-top: 20px;
            /* Ajusta la separación entre los dos divs según sea necesario */
        }

        .encabezado p,
        .encabezado2 p,
        .encabezado3 p {
            margin: 0;
            padding: 0;
        }

        .info-box {
            border: 1px solid #000;
            padding: 10px;
            width: 200px;
            /* Ajusta el ancho del cuadro según sea necesario */
            margin: 0 auto;
            /* Centra el cuadro horizontalmente */
            margin-top: 10px;
            /* Espacio entre el cuadro y el texto superior */
        }

        .info-box p {
            margin: 5px 0;
            font-weight: bold;
            text-align: left;
            /* Ajusta el texto a la izquierda dentro del cuadro */
        }

        .linea {
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        .detalle {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #000;
            width: 80%;
            margin: 0 auto;
        }

        .detalle p {
            margin: 5px 0;
            text-align: left;
        }

        .declaracion {
            margin-top: 20px;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            width: 80%;
            margin: 0 auto;
        }

        .declaracion p {
            margin: 5px 0;
            text-align: left;

        }

        .denunciante {
            margin-top: 20px;
            width: 80%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            /* Ajusta el espacio entre las columnas según sea necesario */
        }

        .denunciante p {
            font-size: 16px;
            font-weight: bold;
            background-color: lightgray;
            padding: 5px;
            /* Ajusta el relleno según sea necesario */
            grid-column: span 2;
            /* Hace que el título ocupe ambas columnas */
        }

        .denunciante .field {
            background-color: none;
            font-weight: normal;
        }

        .victima {
            margin-top: 20px;
            width: 80%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            /* Ajusta el espacio entre las columnas según sea necesario */
        }

        .victima p {
            font-size: 16px;
            font-weight: bold;
            background-color: lightgray;
            padding: 5px;
            /* Ajusta el relleno según sea necesario */
            grid-column: span 2;
            /* Hace que el título ocupe ambas columnas */
        }

        .victima .field {
            background-color: none;
            font-weight: normal;
        }

        .denunciado {
            margin-top: 20px;
            width: 80%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            /* Ajusta el espacio entre las columnas según sea necesario */
        }

        .denunciado p {
            font-size: 16px;
            font-weight: bold;
            background-color: lightgray;
            padding: 5px;
            /* Ajusta el relleno según sea necesario */
            grid-column: span 2;
            /* Hace que el título ocupe ambas columnas */
        }

        .denunciado .field {
            background-color: none;
            font-weight: normal;
        }

        .asignacion {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #000;
            width: 80%;
            margin: 0 auto;
        }

        .asignacion p {
            margin: 5px 0;
            text-align: left;
        }

        .firma {
            margin-top: 20px;
            width: 80%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            /* Ajusta el espacio entre las columnas según sea necesario */
        }

        .firma p {
            font-size: 16px;


            padding: 5px;
            /* Ajusta el relleno según sea necesario */
            grid-column: span 2;
            /* Hace que el título ocupe ambas columnas */
        }

        .firma .field {
            background-color: none;
            font-weight: normal;
        }

        .firma1 {
            text-align: center;

        }

        .firma2 {
            text-align: center;
            margin-left: 100px;
            /* Ajusta la separación entre los dos divs según sea necesario */
        }

        .firma1 p,
        .firma2 p {
            margin: 0;
            padding: 0;
        }

        .evidencias {
            page-break-before: always;
            margin-top: 20px;
            padding: 10px;
            width: 80%;
            margin: 0 auto;
        }

        .evidencias p {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .evidencias ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .evidencias ul li {
            margin-bottom: 5px;
        }

        @media print {

            .denunciante p,
            .victima p,
            .denunciado p {
                background-color: lightgray !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
        @page {
            margin: 20mm;
            @bottom-right {
                content: "Página " counter(page) " de " counter(pages);
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="encabezado">
            <p class="linea" style="font-size: 20px; font-weight: bold;">POLICÍA BOLIVIANA</p>
            <p class="linea" style="font-size: 16px;">DIRECCIÓN DEPARTAMENTAL</p>
            <p class="linea" style="font-size: 14px;">FUERZA ESPECIAL DE LUCHA CONTRA EL CRIMEN</p>
            <p class="linea">Santa Cruz - Bolivia</p>
        </div>
        <div class="encabezado2">
            <img src="{{ asset('assets/img/felcc.jpg') }}" alt="Logo FELCC" style="width: 35px;">
            <p class="linea" style="font-size: 16px; font-weight: bold;">MODULO FELCC MONTERO</p>
            <div class="info-box">
                <p>CASO: <span>{{$denuncia->caso}}</span></p>
                <p>REGISTRO: <span>{{$denuncia->created_at->format('d/m/Y')}}</span></p>
                <p>HORA: <span>{{$denuncia->created_at->format('H:i')}}</span></p>
            </div>
        </div>
    </div>

    <div class="encabezado3">
        <p style="font-size: 24px; font-weight: bold;">DENUNCIAS E INFORMACIONES</p>
    </div>

    <div class="detalle">
        <p><span style="font-weight: bold;">DELITO:</span> @foreach ($denuncia->delitos as $index => $delito)
            {{ $delito->nombre }}@if (!$loop->last), @endif
        @endforeach</p>
        <p><span style="font-weight: bold;">LUGAR DE HECHO:</span> <span>{{ $denuncia->lugar_hecho }}</span></p>
        <p><span style="font-weight: bold;">GEOREFERENCIA:</span> <span>{{ $denuncia->ubicacion->latitud ?? 'N/A' }},
                {{ $denuncia->ubicacion->longitud ?? 'N/A' }}</span></p>
        <p><span style="font-weight: bold;">FECHA DEL HECHO:</span> <span>{{ $denuncia->fecha_hecho }}</span></p>
        <p><span style="font-weight: bold;">HORA DEL HECHO:</span> <span>{{ $denuncia->hora_hecho }}</span></p>
        <p><span style="font-weight: bold;">INTS. UTILIZADO:</span> <span>{{ $denuncia->instrumento_utilizado }}</span>
        </p>
    </div>

    <div class="declaracion">
        <p><span style="font-size: 16px; font-weight: bold; text-decoration: underline;">BREVE DETALLE DEL HECHO:</span>
            <span>{{ $denuncia->declaracion_formal }}</span>
        </p>

    </div>
    <div class="denunciante">
        <p>DENUNCIANTE</p>
        <div class="field"><span style="font-weight: bold;">NOMBRE Y APELLIDOS:</span>
            <span>{{ $denuncia->denunciante->nombre_completo }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">CEDULA DE IDENTIDAD:</span>
            <span>{{ $denuncia->denunciante->ci ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">FECHA DE NACIMIENTO:</span>
            <span>{{ $denuncia->denunciante->fecha_nac ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">ESTADO CIVIL:</span>
            <span>{{ $denuncia->denunciante->estado_civil ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">NATURAL DE:</span>
            <span>{{ $denuncia->denunciante->natural_de ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">OCUPACION:</span>
            <span>{{ $denuncia->denunciante->ocupacion ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">DOMICILIO:</span>
            <span>{{ $denuncia->denunciante->domicilio ?? 'N/A' }}</span>
        </div>
        <!-- Aquí puedes agregar más campos a la derecha -->
        <div class="field"><span style="font-weight: bold;">TELÉFONO:</span>
            <span>{{ $denuncia->denunciante->telefono ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">SEXO:</span>
            <span>{{ $denuncia->denunciante->sexo ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">EDAD:</span>
            <span>{{ $denuncia->denunciante->edad ?? 'N/A' }}</span>
        </div>
        <div class="field"><span style="font-weight: bold;">NACIONALIDAD:</span>
            <span>{{ $denuncia->denunciante->nacionalidad ?? 'N/A' }}</span>
        </div>
    </div>
    @php $contadorVictima = 1; @endphp
    @foreach ($denuncia->victimas as $victima)
        <div class="victima">
            <p>VICTIMA {{ $contadorVictima }}</p>
            @if ($victima->nombre)
                <div class="field"><span style="font-weight: bold;">NOMBRE Y APELLIDOS:</span>
                    <span>{{ $victima->nombre_completo }}</span>
                </div>
            @endif
            @if ($victima->ci)
                <div class="field"><span style="font-weight: bold;">CEDULA DE IDENTIDAD:</span> <span>{{ $victima->ci }}</span>
                </div>
            @endif
            @if ($victima->fecha_nac)
                <div class="field"><span style="font-weight: bold;">FECHA DE NACIMIENTO:</span>
                    <span>{{ $victima->fecha_nac }}</span>
                </div>
            @endif
            @if ($victima->estado_civil)
                <div class="field"><span style="font-weight: bold;">ESTADO CIVIL:</span>
                    <span>{{ $victima->estado_civil }}</span>
                </div>
            @endif

            @if ($victima->ocupacion)
                <div class="field"><span style="font-weight: bold;">OCUPACION:</span> <span>{{ $victima->ocupacion }}</span>
                </div>
            @endif
            @if ($victima->sexo)
                <div class="field"><span style="font-weight: bold;">SEXO:</span> <span>{{ $victima->sexo }}</span>
                </div>
            @endif
            @if ($victima->edad)
                <div class="field"><span style="font-weight: bold;">EDAD:</span> <span>{{ $victima->edad }}</span>
                </div>
            @endif
            @if ($victima->nacionalidad)
                <div class="field"><span style="font-weight: bold;">NACIONALIDAD:</span>
                    <span>{{ $victima->nacionalidad }}</span>
                </div>
            @endif
        </div>
        @php    $contadorVictima++; @endphp
    @endforeach

    @php $contadorDenunciado = 1; @endphp
    @foreach ($denuncia->denunciados as $denunciado)
        <div class="denunciado">
            <p>DENUNCIADO {{ $contadorDenunciado }}</p>
            @if ($denunciado->nombre)
                <div class="field"><span style="font-weight: bold;">NOMBRE Y APELLIDOS:</span>
                    <span>{{ $denunciado->nombre_completo }}</span>
                </div>
            @endif
            @if ($denunciado->ci)
                <div class="field"><span style="font-weight: bold;">CEDULA DE IDENTIDAD:</span>
                    <span>{{ $denunciado->ci }}</span>
                </div>
            @endif
            @if ($denunciado->fecha_nac)
                <div class="field"><span style="font-weight: bold;">FECHA DE NACIMIENTO:</span>
                    <span>{{ $denunciado->fecha_nac }}</span>
                </div>
            @endif
            @if ($denunciado->estado_civil)
                <div class="field"><span style="font-weight: bold;">ESTADO CIVIL:</span>
                    <span>{{ $denunciado->estado_civil }}</span>
                </div>
            @endif

            @if ($denunciado->ocupacion)
                <div class="field"><span style="font-weight: bold;">OCUPACION:</span> <span>{{ $denunciado->ocupacion }}</span>
                </div>
            @endif
            @if ($denunciado->sexo)
                <div class="field"><span style="font-weight: bold;">SEXO:</span> <span>{{ $denunciado->sexo }}</span>
                </div>
            @endif
            @if ($denunciado->edad)
                <div class="field"><span style="font-weight: bold;">EDAD:</span> <span>{{ $denunciado->edad }}</span>
                </div>
            @endif
            @if ($denunciado->nacionalidad)
                <div class="field"><span style="font-weight: bold;">NACIONALIDAD:</span>
                    <span>{{ $denunciado->nacionalidad }}</span>
                </div>
            @endif
        </div>
        @php    $contadorDenunciado++; @endphp
    @endforeach
    <br>
    <div class="asignacion">
        <p><span style="font-weight: bold;">Lugar en la Policia:</span> <span>FELCC MONTERO</span></p>
        <p><span style="font-weight: bold;">Division:</span> <span>PERSONAS</span></p>
        <p><span style="font-weight: bold;">Investigador Asig. al Caso:</span>
            <span>{{ $denuncia->oficial->nombre_completo ?? 'N/A' }}</span>
        </p>
        <p><span style="font-weight: bold;">Celular del Asignado:</span>
            <span>{{ $denuncia->oficial->telefono ?? 'N/A' }}</span>
        </p>
        <p><span style="font-weight: bold;">Fiscal Asig. al Caso</span>
            <span>{{ $denuncia->fiscal->nombre_completo ?? 'N/A' }}</span>
        </p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="firma">
        <div class="firma1">
            <p>{{ $denuncia->denunciante->nombre_completo }}</p>
            <p>DENUNCIANTE</p>

        </div>

        <div class="firma2">
            <p class="linea">{{  $denuncia->oficial->nombre_completo ?? 'N/A' }}</p>
            <p class="linea">CELULAR: <span>{{ $denuncia->oficial->telefono ?? 'N/A' }}</span></p>
            <p class="linea">RECEPCIONADO POR</p>
        </div>

    </div>
    <br>
    <br>

    @if ($denuncia->evidencias->isNotEmpty())
        <div class="evidencias">
            <p>EVIDENCIAS DEL CASO: <span>{{$denuncia->caso}}</span></p>
            <ul>
                @foreach ($denuncia->evidencias as $evidencia)
                    <img src="{{ asset($evidencia->path) }}" class="img-fluid img-thumbnail" style="max-width: 100%;"
                        alt="Evidencia">
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>