<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="delito"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Delito"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <!-- Encabezado de la tarjeta, si es necesario -->
                    </div>
                    <div class="me-3 my-3 text-end">
                        <button class="btn bg-gradient-dark mb-0" onclick="openAddModal()">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Agregar Nuevo Delito
                        </button>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NOMBRE</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($delito as $delit)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $delit->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $delit->nombre }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-success btn-sm" onclick="openModalEdit({{ $delit->id }})">
                                                    <i class="material-icons" style="font-size: 20px">edit</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No hay delitos registrados.</td>
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
                <h2 class="modal-title text-center">Agregar Delito</h2>
                <form id="formAdd" action="{{ route('agregarDelito') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_add">Nombre:</label>
                        <input type="text" id="nombre_add" name="nombre" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Agregar Delito</button>
                </form>
            </div>
        </div>

        <script>
            function openAddModal() {
                document.getElementById('nombre_add').value = '';
                document.getElementById('formAdd').action = "{{ route('agregarDelito') }}";
                document.getElementById('myModalAdd').style.display = "block";
            }

            var modalAdd = document.getElementById("myModalAdd");
            var spanAdd = modalAdd.getElementsByClassName("close")[0];
            spanAdd.onclick = function () {
                modalAdd.style.display = "none";
            }
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
                <h2 class="modal-title text-center">Editar Delito</h2>
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre_edit">Nombre:</label>
                        <input type="text" id="nombre_edit" name="nombre" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>

        <script>
            function openModalEdit(id) {
                fetch(`/delito/edit/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nombre_edit').value = data.nombre;
                        document.getElementById('editForm').action = `/delito/update/${id}`;
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
