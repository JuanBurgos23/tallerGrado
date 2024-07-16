<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="fiscal"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Editar Fiscal"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <!-- Encabezado de la tarjeta, si es necesario -->
                    </div>
                    <div class="card-body px-0 pb-2">
                        <form action="{{ route('actualizar_fiscal', $fiscals->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="nombre"
                                    value="{{ $fiscals->nombre }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="paterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="paterno" name="paterno"
                                    value="{{ $fiscals->paterno }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="materno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="materno" name="materno"
                                    value="{{ $fiscals->materno }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    value="{{ $fiscals->telefono }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="correo"
                                    value="{{ $fiscals->correo }}" required>
                            </div>
                           

                            <button type="submit" class="btn btn-primary">Actualizar Fiscal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>