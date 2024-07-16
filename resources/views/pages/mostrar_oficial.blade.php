<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="oficial"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Oficial"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
			<h2>Listado de Oficiales</h2>
		    </div>
                    <div class="me-3 my-3 text-end">
                        <button class="btn bg-gradient-dark mb-0" onclick="openAddModalOficial()">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Agregar Nuevo Oficial
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
                                            EMAIL</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            CARGO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ESTADO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($oficials as $oficial)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $oficial->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $oficial->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $oficial->paterno }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $oficial->materno }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $oficial->telefono }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $oficial->email }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $oficial->cargo }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $oficial->estado }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-success btn-sm"
                                                    onclick="openModalEditOficial({{ $oficial->id }})">
                                                    <i class="material-icons" style="font-size: 20px">edit</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No hay oficiales registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal flotante agregar oficiales -->
        <div id="myModalAddOficial" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 class="modal-title text-center">Agregar Oficial</h2>
                <form id="formAddOficial" action="oficial-register" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name_add_oficial">Nombre:</label>
                        <input type="text" id="name_add_oficial" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paterno_add_oficial">Paterno:</label>
                        <input type="text" id="paterno_add_oficial" name="paterno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="materno_add_oficial">Materno:</label>
                        <input type="text" id="materno_add_oficial" name="materno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_add_oficial">Teléfono:</label>
                        <input type="text" id="telefono_add_oficial" name="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email_add_oficial">Correo:</label>
                        <input type="email" id="email_add_oficial" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cargo_add_oficial">Cargo:</label>
                        <input type="text" id="cargo_add_oficial" name="cargo" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Agregar Oficial</button>
                </form>
            </div>
        </div>

        <script>
            // Función para abrir el modal con el formulario vacío para agregar un nuevo oficial
            function openAddModalOficial() {
                // Limpiamos los campos del formulario
                document.getElementById('name_add_oficial').value = '';
                document.getElementById('paterno_add_oficial').value = '';
                document.getElementById('materno_add_oficial').value = '';
                document.getElementById('telefono_add_oficial').value = '';
                document.getElementById('email_add_oficial').value = '';
                document.getElementById('cargo_add_oficial').value = '';
                // Cambiamos la acción del formulario para que apunte a la ruta de creación de un nuevo oficial
                document.getElementById('formAddOficial').action = "oficial-register";
                // Mostramos el modal
                document.getElementById('myModalAddOficial').style.display = "block";
            }

            // Código para cerrar el modal al hacer clic en el botón de cerrar (x)
            var modalAddOficial = document.getElementById("myModalAddOficial");
            var spanAddOficial = modalAddOficial.getElementsByClassName("close")[0];
            spanAddOficial.onclick = function () {
                modalAddOficial.style.display = "none";
            }
            // Código para cerrar el modal al hacer clic fuera del mismo
            window.onclick = function (event) {
                if (event.target == modalAddOficial) {
                    modalAddOficial.style.display = "none";
                }
            }
        </script>

        <!-- Modal flotante editar oficiales-->
        <div id="myModalEditOficial" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 class="modal-title text-center">Editar Oficial</h2>
                <form id="editFormOficial" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre_edit_oficial">Nombre:</label>
                        <input type="text" id="nombre_edit_oficial" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paterno_edit_oficial">Paterno:</label>
                        <input type="text" id="paterno_edit_oficial" name="paterno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="materno_edit_oficial">Materno:</label>
                        <input type="text" id="materno_edit_oficial" name="materno" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_edit_oficial">Teléfono:</label>
                        <input type="text" id="telefono_edit_oficial" name="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_edit_oficial">Correo:</label>
                        <input type="email" id="correo_edit_oficial" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_edit_oficial">Cargo:</label>
                        <input type="text" id="cargo_edit_oficial" name="cargo" class="form-control" required>
                    </div>
                    
                    <br>
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>

        <script>
            function openModalEditOficial(id) {
                fetch(`/oficiales/edit/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nombre_edit_oficial').value = data.name;
                        document.getElementById('paterno_edit_oficial').value = data.paterno;
                        document.getElementById('materno_edit_oficial').value = data.materno;
                        document.getElementById('telefono_edit_oficial').value = data.telefono;
                        document.getElementById('correo_edit_oficial').value = data.email;
                        document.getElementById('cargo_edit_oficial').value = data.cargo;
                        document.getElementById('editFormOficial').action = `/oficiales/update/${id}`;
                        document.getElementById('myModalEditOficial').style.display = "block";
                    })
                    .catch(error => console.error('Error:', error));
            }

            var modalEditOficial = document.getElementById("myModalEditOficial");
            var spanEditOficial = modalEditOficial.getElementsByClassName("close")[0];
            spanEditOficial.onclick = function () {
                modalEditOficial.style.display = "none";
            }
            window.onclick = function (event) {
                if (event.target == modalEditOficial) {
                    modalEditOficial.style.display = "none";
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
                display: flex;
                flex-wrap: wrap;
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
                flex: 1 0 45%;
            }

            .form-control {
                width: calc(100% - 10px);
                padding: 10px;
                box-sizing: border-box;
                border: 1px solid #ced4da;
                border-radius: 4px;
            }

            .modal-title {
                font-size: 18px;

            }
        </style>
    </main>
    <x-plugins></x-plugins>
</x-layout>
