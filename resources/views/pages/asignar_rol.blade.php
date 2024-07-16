<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="rol"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Rol"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <h2 class="mb-4">Asignar rol al usuario</h2>

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('agregar_rol') }}">
                @csrf

                <div class="form-group">
                    <label for="user_id">Usuario</label>
                    <select class="form-control border-success" id="user_id" name="user_id" required>
                        <option  value="" disabled selected>Seleccionar Usuario</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="role">Rol</label>
                    <select name="role_id" class="form-control border-success">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Asignar Rol</button>
            </form>
        </div>
    </main>

    <x-plugins></x-plugins>
</x-layout>

@push('scripts')
    <script>
        // Actualiza el valor del campo oculto user_id al cambiar la selección del usuario
        document.getElementById('user_id').addEventListener('change', function() {
            document.getElementById('selected_user_id').value = this.value;
        });
    </script>
@endpush

@push('styles')
    <style>
        .border-success {
            border: 2px solid green; /* Borde verde alrededor del select */
        }
    </style>
@endpush
