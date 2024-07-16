<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="usuario"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Usuarios"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <!-- Encabezado de la tarjeta, si es necesario -->
                        <h2>Registrar Nuevo Usuario</h2>
                    </div>
                    <div class="me-3 my-3 text-end">
                        <button class="btn bg-gradient-dark mb-0" onclick="openAddModal()">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Agregar Nuevo Usuario
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
                                            CORREO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $user->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($users->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">No hay usuarios registrados.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario para agregar nuevo usuario -->
        <div id="myModalAdd" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 class="modal-title text-center">Agregar Nuevo Usuario</h2>
                <form id="formAdd" action="{{ route('empleado.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name_add">Nombre:</label>
                        <input type="text" id="name_add" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email_add">Correo Electrónico:</label>
                        <input type="email" id="email_add" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_add">Contraseña:</label>
                        <input type="password" id="password_add" name="password" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Agregar Usuario</button>
                </form>
            </div>
        </div>

        <script>
            // Función para abrir el modal con el formulario vacío para agregar un nuevo usuario
            function openAddModal() {
                // Limpiamos los campos del formulario
                document.getElementById('name_add').value = '';
                document.getElementById('email_add').value = '';
                document.getElementById('password_add').value = '';
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
