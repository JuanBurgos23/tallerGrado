<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Reporte Grafico"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="container">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">
                        Porcentaje de denuncias por tipo de delito
                    </p>
                </figure>
                <a class="btn btn-success" href="{{route ('backup.index')}}">Crear backup</a>
            </div>

            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const delitos = @json($delitos);

                    Highcharts.chart('container', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Porcentaje de denuncias por tipo de delito'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            name: 'Porcentaje',
                            colorByPoint: true,
                            data: delitos.map(delito => ({
                                name: delito.nombre,
                                y: delito.denuncias_count
                            }))
                        }]
                    });
                });
            </script>
            <style>
                .highcharts-figure,
                .highcharts-data-table table {
                    min-width: 320px;
                    max-width: 800px;
                    margin: 1em auto;
                }

                .highcharts-data-table table {
                    font-family: Verdana, sans-serif;
                    border-collapse: collapse;
                    border: 1px solid #ebebeb;
                    margin: 10px auto;
                    text-align: center;
                    width: 100%;
                    max-width: 500px;
                }

                .highcharts-data-table caption {
                    padding: 1em 0;
                    font-size: 1.2em;
                    color: #555;
                }

                .highcharts-data-table th {
                    font-weight: 600;
                    padding: 0.5em;
                }

                .highcharts-data-table td,
                .highcharts-data-table th,
                .highcharts-data-table caption {
                    padding: 0.5em;
                }

                .highcharts-data-table thead tr,
                .highcharts-data-table tr:nth-child(even) {
                    background: #f8f8f8;
                }

                .highcharts-data-table tr:hover {
                    background: #f1f7ff;
                }

                input[type="number"] {
                    min-width: 50px;
                }
            </style>
        </div>
    </main>
</x-layout>