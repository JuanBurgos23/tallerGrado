<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="oficial"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Editar Oficial"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <!-- Encabezado de la tarjeta, si es necesario -->
                    </div>
                    <div class="card-body px-0 pb-2">
                        <form action="{{ route('actualizar_oficial', $oficials->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $oficials->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="paterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="paterno" name="paterno" value="{{ $oficials->paterno }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="materno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="materno" name="materno" value="{{ $oficials->materno }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $oficials->telefono }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $oficials->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="form-text text-muted">Dejar en blanco si no desea cambiar la contraseña</small>
                            </div>
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $oficials->cargo }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $oficials->tipo }}" >
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Oficial</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>