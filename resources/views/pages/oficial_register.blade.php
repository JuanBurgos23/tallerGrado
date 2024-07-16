<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="oficial"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Registrar Investigador"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">

        <form action="oficial-register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" style="border: 1px solid black; width: 300px;">

                    <label for="title" class="form-label">Paterno</label>
                    <input type="text" name="paterno" class="form-control" style="border: 1px solid black; width: 300px;">

                    <label for="title" class="form-label">Materno</label>
                    <input type="text" name="materno" class="form-control" style="border: 1px solid black; width: 300px;">

                    <label for="title" class="form-label">Telefono</label>
                    <input type="text" name="telefono" class="form-control" style="border: 1px solid black; width: 300px;">

                    <label for="title" class="form-label">Correo</label>
                    <input type="email" name="email" class="form-control" style="border: 1px solid black; width: 300px;">

                    <label for="title" class="form-label">Cargo</label>
                    <input type="text" name="cargo" class="form-control" style="border: 1px solid black; width: 300px;">

                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
            </form>

        </div>
    </main>
   

</x-layout>
