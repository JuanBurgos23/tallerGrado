<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .form-control {
        background-color: rgba(113, 162, 113, 0.5);
    }

    .btn-sm-custom {
        padding: 0.0002rem 0.0004rem;
        /* Ajusta el padding para hacer el botón más pequeño */
        font-size: 0.075rem;
        /* Ajusta el tamaño de la fuente para hacer el botón más pequeño */
        border-radius: 0.02rem;
        /* Ajusta el radio de borde para hacer el botón más pequeño */
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 20;
    }
</style>
<title>Formualrio de Denuncia</title>
<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="denuncia"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Registrar Denuncia"></x-navbars.navs.auth>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid py-4">
            <div style="display: flex; flex-wrap: wrap;">
                <label>
                    EL PRESENTE FORMULARIO RECIBE DENUNCIAS DE MALOS TRATOS Y OTROS COMETIDOS POR
                    CIUDADANOS Y SERA REVISADO POR EL DEPARTAMENTO NACIONAL DE TRANSPARENCIA DE LA
                    POLICIA BOLIVIANA.
                </label>
            </div>
            <form action="registrar-denuncia" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset style="border: 1px solid black; padding: 15px; margin-bottom: 20px;">

                    <legend style="font-weight: bold;">Registrar Denunciante</legend>
                    <div style="display: flex; flex-wrap: wrap;">
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Carnet Identidad</label>
                            <input type="text" name="ci" class="form-control" style="border: 1px solid black;" required>
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Nombre</label>
                            <input type="text" name="nombreDenunciante" class="form-control"
                                style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Paterno</label>
                            <input type="text" name="paterno" class="form-control" style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Materno</label>
                            <input type="text" name="materno" class="form-control" style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" id="sexo" name="sexo" style="border: 1px solid black;">
                                <option value="" selected disabled>Seleccione el sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>

                            </select>
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Domicilio</label>
                            <input type="text" name="domicilio" class="form-control" style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Telefono</label>
                            <input type="text" name="telefono" class="form-control" style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Edad</label>
                            <input type="text" name="edad" class="form-control" style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Estado Civil</label>
                            <input type="text" name="estado_civil" class="form-control"
                                style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nac" style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Nacionalidad</label>
                            <input type="text" name="nacionalidad" class="form-control"
                                style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Natural de</label>
                            <input type="text" name="natural_de" class="form-control" style="border: 1px solid black;">
                        </div>
                        <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="title" class="form-label">Ocupacion</label>
                            <input type="text" name="ocupacion" class="form-control" style="border: 1px solid black;">
                        </div>
                    </div>
                    <br>

                    <div>
                        <legend style="font-weight: bold;">Registrar Denunciados</legend>
                        <label>Si desconoce los datos del Agresor, rellenar con: "El autor" si solo es una
                            persona</label> <br>
                        <label>Rellenar con: "Los autores" si es mas de una persona</label>
                        <div id="contenedorDenunciados">
                            <!-- Aquí se añadirán dinámicamente los denunciados -->
                        </div>

                        <button id="btnAgregarDenunciado" class="btn btn-success btn-agregar">Agregar otro
                            denunciado</button>
                        <button id="btnEliminarDenunciado" class="btn btn-danger" style="display: none;">Eliminar último
                            denunciado</button>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const contenedorDenunciados = document.getElementById('contenedorDenunciados');
                            const btnAgregarDenunciado = document.getElementById('btnAgregarDenunciado');
                            const btnEliminarDenunciado = document.getElementById('btnEliminarDenunciado');
                            let contadorDenunciados = 0;

                            // Agregar el primer denunciado al cargar la página
                            agregarDenunciado();

                            // Event listener para el botón de agregar denunciado
                            btnAgregarDenunciado.addEventListener('click', agregarDenunciado);

                            // Event listener para el botón de eliminar denunciado
                            btnEliminarDenunciado.addEventListener('click', eliminarUltimoDenunciado);

                            function agregarDenunciado() {
                                contadorDenunciados++;

                                // Crear div para el nuevo denunciado
                                const divDenunciado = document.createElement('div');
                                divDenunciado.id = `denunciado${contadorDenunciados}`;
                                divDenunciado.classList.add('campo');

                                // Contenido del div para el nuevo denunciado
                                divDenunciado.innerHTML = `
                <fieldset>
                    <legend style="font-weight: bold;">Denunciado ${contadorDenunciados}</legend>
                    <div class="grupo-campos">
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="nombreDenunciado${contadorDenunciados}">Nombre:</label>
                            <input type="text" style="border: 1px solid black;" id="nombreDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][nombre]" class="form-control" required>
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="apellidosDenunciado${contadorDenunciados}">Apellidos:</label>
                            <input type="text" style="border: 1px solid black;" id="apellidosDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][apellidos]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="ciDenunciado${contadorDenunciados}">Carnet de Identidad:</label>
                            <input type="text" style="border: 1px solid black;" id="ciDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][ci]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="fecha_nacDenunciado${contadorDenunciados}">Fecha de Nacimiento:</label>
                            <input type="date" style="border: 1px solid black;" id="fecha_nacDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][fecha_nac]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="sexoDenunciado${contadorDenunciados}">Sexo:</label>
                            <select id="sexoDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][sexo]" style="border: 1px solid black;" class="form-control">
                                <option value="" selected disabled>Seleccione el sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                
                            </select>
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="estado_civilDenunciado${contadorDenunciados}">Estado Civil:</label>
                            <input type="text" style="border: 1px solid black;" id="estado_civilDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][estado_civil]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="edadDenunciado${contadorDenunciados}">Edad:</label>
                            <input type="number" style="border: 1px solid black;" id="edadDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][edad]" class="form-control" >
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="nacionalidadDenunciado${contadorDenunciados}">Nacionalidad:</label>
                            <input type="text" style="border: 1px solid black;" id="nacionalidadDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][nacionalidad]" class="form-control" >
                        </div>
                        <div class="campo"style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="descripcionDenunciado${contadorDenunciados}">Descripción:</label>
                            <input type="text" style="border: 1px solid black;" id="descripcionDenunciado${contadorDenunciados}" name="denunciados[${contadorDenunciados}][descripcion]" class="form-control">
                        </div>
                    </div>
                </fieldset>
            `;

                                // Añadir nuevo div de denunciado al contenedor
                                contenedorDenunciados.appendChild(divDenunciado);

                                // Mostrar el botón de eliminar si hay más de un denunciado
                                if (contadorDenunciados > 1) {
                                    btnEliminarDenunciado.style.display = 'block';
                                }
                            }

                            function eliminarUltimoDenunciado() {
                                const ultimoDenunciado = contenedorDenunciados.lastElementChild;
                                if (ultimoDenunciado && contadorDenunciados > 1) {
                                    contenedorDenunciados.removeChild(ultimoDenunciado);
                                    contadorDenunciados--;

                                    // Ocultar el botón de eliminar si queda solo un denunciado
                                    if (contadorDenunciados === 1) {
                                        btnEliminarDenunciado.style.display = 'none';
                                    }
                                }
                            }
                        });
                    </script>
                    <br>

                    <div>
                        <legend style="font-weight: bold;">Registrar Víctimas</legend>
                        <label>Si usted es una víctima, en el campo "Nombre" rellenar con: "El Denunciante" y los demás
                            campos
                            dejarlos en blanco.
                        </label>
                        <div id="contenedorVictimas">
                            <!-- Aquí se añadirán dinámicamente las víctimas -->
                        </div>

                        <button id="btnAgregarVictima" class="btn btn-success btn-agregar">Agregar otra víctima</button>
                        <button id="btnEliminarVictima" class="btn btn-danger" style="display: none;">Eliminar última
                            víctima</button>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const contenedorVictimas = document.getElementById('contenedorVictimas');
                            const btnAgregarVictima = document.getElementById('btnAgregarVictima');
                            const btnEliminarVictima = document.getElementById('btnEliminarVictima');
                            let contadorVictimas = 0;

                            // Agregar la primera víctima al cargar la página
                            agregarVictima();

                            // Event listener para el botón de agregar víctima
                            btnAgregarVictima.addEventListener('click', agregarVictima);

                            // Event listener para el botón de eliminar víctima
                            btnEliminarVictima.addEventListener('click', eliminarUltimaVictima);

                            function agregarVictima() {
                                contadorVictimas++;

                                // Crear div para la nueva víctima
                                const divVictima = document.createElement('div');
                                divVictima.id = `victima${contadorVictimas}`;
                                divVictima.classList.add('campo');

                                // Contenido del div para la nueva víctima
                                divVictima.innerHTML = `
                <fieldset>
                    <legend style="font-weight: bold;">Víctima ${contadorVictimas}</legend>
                    <div class="grupo-campos">
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="nombreVictima${contadorVictimas}">Nombre:</label>
                            <input type="text" style="border: 1px solid black;" id="nombreVictima${contadorVictimas}" name="victimas[${contadorVictimas}][nombre]" class="form-control" required>
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="apellidosVictima${contadorVictimas}">Apellidos:</label>
                            <input type="text" style="border: 1px solid black;" id="apellidosVictima${contadorVictimas}" name="victimas[${contadorVictimas}][apellidos]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="ci${contadorVictimas}">Carnet de Identidad:</label>
                            <input type="text" style="border: 1px solid black;" id="ci${contadorVictimas}" name="victimas[${contadorVictimas}][ci]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="fecha_nacVictima${contadorVictimas}">Fecha de Nacimiento:</label>
                            <input type="date" style="border: 1px solid black;" id="fecha_nacVictima${contadorVictimas}" name="victimas[${contadorVictimas}][fecha_nac]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="sexo${contadorVictimas}">Sexo:</label>
                            <select id="sexo${contadorVictimas}" name="victimas[${contadorVictimas}][sexo]" style="border: 1px solid black;" class="form-control">
                                <option value="" selected disabled>Seleccione el sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                
                            </select>
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="ocupacion${contadorVictimas}">Ocupación:</label>
                            <input type="text" style="border: 1px solid black;" id="ocupacion${contadorVictimas}" name="victimas[${contadorVictimas}][ocupacion]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="estado_civil${contadorVictimas}">Estado Civil:</label>
                            <input type="text" style="border: 1px solid black;" id="estado_civil${contadorVictimas}" name="victimas[${contadorVictimas}][estado_civil]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="edad${contadorVictimas}">Edad:</label>
                            <input type="number" style="border: 1px solid black;" id="edad${contadorVictimas}" name="victimas[${contadorVictimas}][edad]" class="form-control">
                        </div>
                        <div class="campo" style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                            <label for="nacionalidad${contadorVictimas}">Nacionalidad:</label>
                            <input type="text" style="border: 1px solid black;" id="nacionalidad${contadorVictimas}" name="victimas[${contadorVictimas}][nacionalidad]" class="form-control">
                        </div>
                    </div>
                </fieldset>
            `;

                                // Añadir nuevo div de víctima al contenedor
                                contenedorVictimas.appendChild(divVictima);

                                // Mostrar el botón de eliminar si hay más de una víctima
                                if (contadorVictimas > 1) {
                                    btnEliminarVictima.style.display = 'block';
                                }
                            }

                            function eliminarUltimaVictima() {
                                const ultimaVictima = contenedorVictimas.lastElementChild;
                                if (ultimaVictima && contadorVictimas > 1) {
                                    contenedorVictimas.removeChild(ultimaVictima);
                                    contadorVictimas--;

                                    // Ocultar el botón de eliminar si queda solo una víctima
                                    if (contadorVictimas === 1) {
                                        btnEliminarVictima.style.display = 'none';
                                    }
                                }
                            }
                        });
                    </script>


                    <br>
                    <legend style="font-weight: bold;">Registrar Denuncia</legend>
                    <div style="display: flex; flex-wrap: wrap;">
                        <!-- Lugar de Hecho, Fecha de Hecho, Hora de Hecho -->
                        <div style="display: flex; flex-wrap: wrap; width: 88%; margin-bottom: 20px;">
                            <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                                <label for="lugar_hecho" class="form-label">Lugar de Hecho</label>
                                <input type="text" name="lugar_hecho" class="form-control"
                                    style="border: 1px solid black;" required>
                            </div>
                            <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                                <label for="fecha_hecho" class="form-label">Fecha de Hecho</label>
                                <input type="date" name="fecha_hecho" class="form-control"
                                    style="border: 1px solid black;" required>
                            </div>
                            <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                                <label for="hora_hecho" class="form-label">Hora de Hecho</label>
                                <input type="time" name="hora_hecho" class="form-control"
                                    style="border: 1px solid black;" required>
                            </div>
                        </div>
                        <!-- Latitud, Longitud, Ubicación y Botón Ver Mapa -->
                        <div
                            style="display: flex; flex-wrap: wrap; width: 100%; align-items: center; margin-bottom: 20px;">
                            <div style="flex: 0 0 auto; width: 200px; margin-right: 20px; display: none;">
                                <label for="latitud" class="form-label">Latitud</label>
                                <input type="text" id="latitud" name="latitud" class="form-control"
                                    style="border: 1px solid black;">
                            </div>
                            <div style="flex: 0 0 auto; width: 200px; margin-right: 20px; display: none;">
                                <label for="longitud" class="form-label">Longitud</label>
                                <input type="text" id="longitud" name="longitud" class="form-control"
                                    style="border: 1px solid black;">
                            </div>
                            <div class="form-group"
                                style="flex: 0 0 auto; width: 100%; display: flex; align-items: center;">
                                <label class="form-label"
                                    style="margin-right: 10px; font-weight: bold;">Ubicación</label>
                                <button type="button" class="btn btn-success btn-sm-custom" data-bs-toggle="modal"
                                    data-bs-target="#mapModal">
                                    <i class="fas fa-map-marker-alt"></i> Ver Mapa
                                </button>
                            </div>
                        </div>
                        <!-- Delitos Disponibles y Delitos Seleccionados -->
                        <div style="display: flex; gap: 20px; width: 100%; margin-bottom: 20px;">
                            <div style="flex: 0 0 auto; width: 200px;">
                                <label for="delitos_disponibles" class="form-label">Seleccione el tipo de Delito</label>
                                <select id="delitos_disponibles" class="form-control" style="border: 1px solid black;"
                                    multiple>
                                    @foreach($delitos as $delito)
                                        <option value="{{ $delito->id }}">{{ $delito->nombre }}</option>
                                    @endforeach
                                </select><br>
                                <button type="button" onclick="agregarDelito()" class="btn btn-success">Agregar</button>
                            </div>
                            <div style="flex: 0 0 auto; width: 200px;">
                                <label for="delitos_seleccionados" class="form-label">Delitos Seleccionados</label>
                                <input type="text" id="delitos_seleccionados" name="nombre" class="form-control"
                                    style="border: 1px solid black;" readonly>
                                <input type="hidden" id="delitos_seleccionados_hidden" name="delitos" value=""><br>
                                <button type="button" onclick="eliminarDelito()"
                                    class="btn btn-success">Eliminar</button>
                            </div>
                            <div style="flex: 0 0 auto; width: 200px; margin-right: 20px;">
                                <label for="title" class="form-label">Instrumento Utilizado</label>
                                <input type="text" name="instrumento_utilizado" class="form-control"
                                    style="border: 1px solid black;" required>
                            </div>
                        </div>
                        <!-- Declaración -->
                        <div style="flex: 0 0 auto; width: 100%; margin-bottom: 20px;">
                            <label for="declaracion" class="form-label" style="font-weight: bold;">Declaración</label>
                            <br>
                            <label>Describa lo mas detallado posible el momento del hecho.</label> </label>
                            <textarea name="declaracion" class="form-control"
                                style="border: 1px solid black; width: 80%; height: 150px;" required></textarea>
                        </div>

                        <!-- Subir Imágenes de Evidencia -->
                        <div style="flex: 0 0 auto; width: 20%;">
                            <label for="imagenes" class="form-label">Subir Imágenes de Evidencia</label>
                            <div id="imagenes_container"></div>
                            <input type="file" id="imagenes" name="imagenes[]" multiple class="form-control"
                                onchange="previsualizarImagenes()">
                            <input type="hidden" id="imagenes_ids_hidden" name="imagenes_ids" value="">
                        </div>
                    </div>

                    <br>
                    <div style="margin-top: 20px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="confidentialityCheckbox"
                                required>
                            <label class="form-check-label" for="confidentialityCheckbox">
                                Estoy de acuerdo que todos mis datos seran tratados con absoluta reserva y
                                confidencialidad por la Inspectoria General y Departamento Nacional de Transparencia de
                                la Policia Boliviana.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="penalCodeCheckbox" required>
                            <label class="form-check-label" for="penalCodeCheckbox">
                                Declaro conocer el ARTICULO 166° (Código Penal).- (ACUSACION Y DENUNCIA FALSA). El que a
                                sabiendas acusare o denunciare como autor o partícipe de un delito de acción pública a
                                una persona que no lo cometió, dando lugar a que se inicie el proceso criminal
                                correspondiente, será sancionado con privación de libertad de uno a tres años. Si como
                                consecuencia sobreviniere la condena de la persona denunciada o acusada, la pena será de
                                privación de libertad de dos a seis años.
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i> Enviar Denuncia
                    </button>

            </form>
    </main>
    <x-plugins></x-plugins>
</x-layout>

<style>
    .form-control {
        background-color: rgba(113, 162, 113, 0.5);
    }

    .btn-sm-custom {
        padding: 0.2rem 0.4rem;
        /* Ajusta el padding para hacer el botón más pequeño */
        font-size: 0.75rem;
        /* Ajusta el tamaño de la fuente para hacer el botón más pequeño */
        border-radius: 0.2rem;
        /* Ajusta el radio de borde para hacer el botón más pequeño */
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 20px;
    }
</style>

<!-- Modal para mostrar el mapa -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapModalLabel">Seleccionar Ubicación en el Mapa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="button" class="btn btn-primary btn-sm-custom" onclick="obtenerUbicacionActual()">
                    Obtener Ubicación Actual
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenedor del mapa -->
                <div id="map" style="height: 400px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="confirmLocation">Confirmar Ubicación</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap y jQuery JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-Nm2qB07RztU1lnDte-iuqm-b7zJuq8g&libraries=places&callback=initMap"
    async defer></script>


<script>
    // Variables globales para el mapa y el marcador
    var map;
    var marker;

    // Función para inicializar el mapa
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -17.319637506933223, lng: -63.26168288937773 }, // Centro en La Paz, Bolivia (puedes cambiarlo)
            zoom: 12 // Ajusta el nivel de zoom según tus necesidades
        });

        // Agregar evento de clic al mapa para marcar un punto
        map.addListener('click', function (event) {
            placeMarker(event.latLng); // Llama a la función placeMarker con event.latLng
        });
    }

    // Función para obtener la ubicación actual del usuario
    function obtenerUbicacionActual() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    mostrarPosicion(pos);
                },
                function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    // Función para colocar un marcador en el mapa y actualizar el formulario
    function placeMarker(location) {
        // Si ya hay un marcador, quítalo del mapa
        if (marker) {
            marker.setMap(null);
        }

        // Crear un nuevo marcador en la ubicación clickeada
        marker = new google.maps.Marker({
            position: location,
            map: map
        });

        // Obtener las coordenadas y pasarlas de vuelta al formulario
        var lat = (typeof location.lat === "function") ? location.lat() : location.lat;
        var lng = (typeof location.lng === "function") ? location.lng() : location.lng;

        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;
    }

    // Función para mostrar las coordenadas obtenidas
    function mostrarPosicion(posicion) {
        // Mostrar posición en consola (opcional)
        console.log('Posición obtenida:', posicion);

        // Centrar el mapa en la posición obtenida y hacer zoom
        map.setCenter(posicion);
        map.setZoom(16); // Puedes ajustar el nivel de zoom según tus necesidades

        // Colocar un marcador en la posición obtenida
        placeMarker(posicion);

        // Actualizar los campos de latitud y longitud en el formulario
        document.getElementById('latitud').value = posicion.lat;
        document.getElementById('longitud').value = posicion.lng;
    }

    // Función para agregar delitos seleccionados
    function agregarDelito() {
        var delitosDisponibles = document.getElementById('delitos_disponibles');
        var delitosSeleccionados = document.getElementById('delitos_seleccionados');
        var delitosSeleccionadosHidden = document.getElementById('delitos_seleccionados_hidden');

        // Obtener los delitos seleccionados y agregarlos al campo de texto visible
        for (var i = 0; i < delitosDisponibles.selectedOptions.length; i++) {
            var option = delitosDisponibles.selectedOptions[i];
            if (delitosSeleccionados.value === '') {
                delitosSeleccionados.value += option.text;
            } else {
                delitosSeleccionados.value += ', ' + option.text;
            }
        }

        // Obtener los valores de los delitos seleccionados y agregarlos al campo oculto
        var delitosIds = delitosSeleccionadosHidden.value ? delitosSeleccionadosHidden.value.split(',') : [];
        for (var i = 0; i < delitosDisponibles.selectedOptions.length; i++) {
            var option = delitosDisponibles.selectedOptions[i];
            if (!delitosIds.includes(option.value)) {
                delitosIds.push(option.value);
            }
        }
        delitosSeleccionadosHidden.value = delitosIds.join(',');

        // Limpiar la lista de delitos seleccionados para evitar duplicados
        delitosDisponibles.selectedIndex = -1;
    }

    // Función para eliminar el último delito seleccionado
    function eliminarDelito() {
        var delitosSeleccionados = document.getElementById('delitos_seleccionados');

        // Eliminar el último delito seleccionado del campo de texto visible
        var delitos = delitosSeleccionados.value.split(', ');
        delitos.pop(); // Elimina el último elemento del array
        delitosSeleccionados.value = delitos.join(', ');

        // También actualiza el campo oculto para reflejar los cambios en los delitos seleccionados
        var delitosSeleccionadosHidden = document.getElementById('delitos_seleccionados_hidden');
        delitosSeleccionadosHidden.value = delitos.join(',');
    }


    //imagenes

    // Función para previsualizar imágenes seleccionadas
    function previsualizarImagenes() {
        var input = document.getElementById('imagenes');
        var imagenesContainer = document.getElementById('imagenes_container');

        if (input.files && input.files.length) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader(); // Crear un objeto FileReader para leer archivos

                reader.onload = function (e) {
                    var imageContainer = document.createElement('div'); // Contenedor para cada imagen
                    imageContainer.classList.add('imagen-container'); // Añadir clase CSS al contenedor

                    var image = document.createElement('img'); // Elemento de imagen
                    image.src = e.target.result; // Asignar la URL de la imagen al atributo src

                    var deleteButton = document.createElement('button'); // Botón para eliminar la imagen
                    deleteButton.textContent = 'Eliminar'; // Texto del botón

                    deleteButton.onclick = function () {
                        imageContainer.remove(); // Eliminar el contenedor de imagen al hacer clic en el botón
                    };

                    imageContainer.appendChild(image); // Agregar la imagen al contenedor
                    imageContainer.appendChild(deleteButton); // Agregar el botón al contenedor
                    imagenesContainer.appendChild(imageContainer); // Agregar el contenedor al contenedor principal
                };

                reader.readAsDataURL(input.files[i]); // Leer el archivo como una URL de datos
            }
        }
    }

</script>
<style>
    .imagen-container {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .imagen-container img {
        width: 100px;
        height: 100px;
        display: block;
    }

    .delete-button {
        display: block;
        margin-top: 5px;
    }
</style>

<!-- Cargar la API de Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-Nm2qB07RztU1lnDte-iuqm-b7zJuq8g&callback=initMap"
    defer></script>



<style>
    .campo {
        margin-bottom: 10px;
    }

    .grupo-campos {
        display: flex;
        flex-wrap: wrap;
    }

    .grupo-campos .campo {
        flex: 0 0 calc(20% - 10px);
        /* Mostrar los campos en grupos de 5 horizontalmente */
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .btn-agregar {
        margin-top: 10px;
    }

    .btn-eliminar {
        margin-top: 10px;
        display: none;
        /* Ocultar el botón de eliminar por defecto */
    }
</style>