<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="notifications"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Notifications"></x-navbars.navs.auth>
        <script src="{{ mix('js/app.js') }}"></script>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="card mt-4">
                        <div class="card-header p-3">
                            <h5 class="mb-0">Notificaciones</h5>
                        </div>
                        <div class="card-body p-3 pb-0">
                            @foreach ($filteredNotifications as $notification)
                                <div class="alert alert-info alert-dismissible text-white" role="alert">
                                    <span class="text-sm">
                                        Nueva denuncia registrada por {{ $notification->data['denunciante'] }}
                                        el
                                        {{ \Carbon\Carbon::parse($notification->data['fecha'])->setTimezone('America/La_Paz')->format('d/m/Y H:i') }}.
                                        <a href="{{ route('notificaciones.show', $notification->id) }}"
                                            class="alert-link text-white">
                                            Ver detalles
                                        </a>.
                                    </span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            Echo.channel('denuncias') // Nombre del canal de broadcasting
                .listen('.new-denuncia-registered', (event) => {
                    console.log('Nueva denuncia registrada:', event.denuncia);
                    // Actualizar la vista de notificaciones aquí
                });
            
        </script>
    </main>
</x-layout>