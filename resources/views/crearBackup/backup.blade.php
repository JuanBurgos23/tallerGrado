<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="dashboard"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <x-navbars.navs.auth titlePage="Backup"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="container mt-5">
                <h1>Crear Backup</h1>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('backup.create') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-success">Crear Backup</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-success">Volver al Dashboard</a>
                </form>
            </div>
        </div>

    </main>
</x-layout>