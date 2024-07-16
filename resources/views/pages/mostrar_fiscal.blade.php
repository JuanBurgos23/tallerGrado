<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="fiscal"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Fiscal"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <!-- Encabezado de la tarjeta, si es necesario -->
			<h2>Listado de Fiscales</h2>
                    </div>
                    <div class="me-3 my-3 text-end">
                        <button class="btn bg-gradient-dark mb-0" onclick="openAddModal()">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Agregar Nuevo Fiscal
                        </button>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOMBRE</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            PATERNO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            MATERNO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            TELEFONO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            CORREO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ESTADO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fiscals as $fiscal)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $fiscal->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fiscal->nombre }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fiscal->paterno }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fiscal->materno }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fiscal->telefono }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fiscal->correo }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fiscal->estado }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-success btn-sm"
                                                    onclick="openModalEdit({{ $fiscal->id }})">
                                                    <i class="material-icons" style="font-size: 20px">edit</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No hay fiscales registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal flotante agregar-->
        <div id="myModalAdd" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 class="modal-title text-center">Agregar Fiscal</h2>
                <form id="formAdd" action="agregar-fiscal" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_add">Nombre:</label>
                        <input type="text" id="nombre_add" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paterno_add">Paterno:</label>
                        <input type="text" id="paterno_add" name="paterno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="materno_add">Materno:</label>
                        <input type="text" id="materno_add" name="materno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_add">Teléfono:</label>
                        <input type="text" id="telefono_add" name="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_add">Correo:</label>
                        <input type="email" id="correo_add" name="correo" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Agregar Fiscal</button>
                </form>
            </div>
        </div>

        <script>
            // Función para abrir el modal con el formulario vacío para agregar un nuevo fiscal
            function openAddModal() {
                // Limpiamos los campos del formulario
                document.getElementById('nombre_add').value = '';
                document.getElementById('paterno_add').value = '';
                document.getElementById('materno_add').value = '';
                document.getElementById('telefono_add').value = '';
                document.getElementById('correo_add').value = '';
                // Cambiamos la acción del formulario para que apunte a la ruta de creación de un nuevo fiscal
                document.getElementById('formAdd').action = "agregar-fiscal";
                // Mostramos el modal
                document.getElementById('myModalAdd').style.display = "block";
            }

            // Código para cerrar el modal al hacer clic en el botón de cerrar (x)
            var modalAdd = document.getElementById("myModalAdd");
            var spanAdd = modalAdd.getElementsByClassName("close")[0];
            spanAdd.onclick = function () {
                modalAdd.style.display = "none";
            }
            // Código para cerrar el modal al hacer clic fuera del mismo
            window.onclick = function (event) {
                if (event.target == modalAdd) {
                    modalAdd.style.display = "none";
                }
            }
        </script>

        <!-- Modal flotante editar-->
        <div id="myModalEdit" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 class="modal-title text-center">Editar Fiscal</h2>
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre_edit">Nombre:</label>
                        <input type="text" id="nombre_edit" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paterno_edit">Paterno:</label>
                        <input type="text" id="paterno_edit" name="paterno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="materno_edit">Materno:</label>
                        <input type="text" id="materno_edit" name="materno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_edit">Teléfono:</label>
                        <input type="text" id="telefono_edit" name="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_edit">Correo:</label>
                        <input type="email" id="correo_edit" name="correo" class="form-control" required>
                    </div>
                   
                    <br>
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>

        <script>
            function openModalEdit(id) {
                fetch(`/fiscales/edit/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nombre_edit').value = data.nombre;
                        document.getElementById('paterno_edit').value = data.paterno;
                        document.getElementById('materno_edit').value = data.materno;
                        document.getElementById('telefono_edit').value = data.telefono;
                        document.getElementById('correo_edit').value = data.correo;
                        document.getElementById('editForm').action = `/fiscales/update/${id}`;
                        document.getElementById('myModalEdit').style.display = "block";
                    })
                    .catch(error => console.error('Error:', error));
            }

            var modalEdit = document.getElementById("myModalEdit");
            var spanEdit = modalEdit.getElementsByClassName("close")[0];
            spanEdit.onclick = function () {
                modalEdit.style.display = "none";
            }
            window.onclick = function (event) {
                if (event.target == modalEdit) {
                    modalEdit.style.display = "none";
                }
            }
        </script>

        <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
                padding-top: 60px;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 5% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 50%;
                max-width: 400px;
                /* Tamaño máximo del modal */
                display: flex;
                /* Utilizamos flexbox para alinear los elementos horizontalmente */
                flex-wrap: wrap;
                /* Permitimos que los elementos se envuelvan en varias líneas si no hay suficiente espacio */
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .form-group {
                margin-right: 15px;
                /* Añadimos un margen derecho para separar los campos */
                flex: 1 0 45%;
                /* Ajustamos el tamaño de los campos para que ocupen aproximadamente la mitad del ancho del modal */
            }

            .form-control {
                width: calc(100% - 10px);
                /* Restamos el padding del ancho total para evitar que los campos se desborden */
                padding: 10px;
                box-sizing: border-box;
                border: 1px solid #ced4da;
                /* Agregamos un borde alrededor del input */
                border-radius: 4px;
                /* Añadimos bordes redondeados */
            }

            .modal-title {
                font-size: 18px;

            }
        </style>
    </main>
    <x-plugins></x-plugins>
</x-layout>
