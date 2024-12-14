<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> @yield('titulo') </title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- Tablas --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <title> @yield('head') </title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CORONEL</div>
            </a>

            {{-- @role('administrador')
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestionar
            </div>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Roles y permisos</span>
                </a>
            </li>
            @endrole --}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Mantener
            </div>

            @can('mantener-insumos')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('insumos.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Insumos</span></a>
            </li>
            @endcan

            @can('mantener-categorias')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categorias.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Categorias</span></a>
            </li>
            @endcan

            @can('mantener-productos')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('productos.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Productos</span></a>
            </li>
            @endcan

            @can('mantener-proveedores')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('proveedores.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Proveedores</span></a>
            </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Otros controles
            </div>

            @can('controlar-compras-insumos')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('comprasinsumos.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Compras de insumos</span></a>
            </li>
            @endcan

            @can('controlar-elaboracion-productos')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('elaboracionproductos.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Elaboración de productos</span></a>
            </li>
            @endcan

            @can('controlar-ventas-productos')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ventasproductos.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Ventas de productos</span></a>
            </li>
            @endcan

            @can('generar-reportes')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reportes.index') }}">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Reportes</span></a>
            </li>
            @endcan

            @can('generar-graficos')
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('graficos.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráficos</span></a>
            </li>
            @endcan

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tiempos.index') }}">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tiempos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">1+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alertas
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                {{-- <a class="dropdown-item text-center small text-gray-500" href="">Show All Alerts</a> --}}
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ auth()->user()->name }} </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                {{-- Logout --}}
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Log Out') }}
                                </a>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"> @yield('subtitulo') </h1>
                    @yield('contenido')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Coronel 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- ------------------------------------------------------------------------------------------------ --}}

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    {{-- Tablas --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mi-tabla').DataTable({
                "lengthMenu": [5, 10, 20, 50, 100], // Configura las opciones de número de compras a mostrar
                "pageLength": 5, // Establece el número predeterminado de compras por página
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros en total)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "aria": {
                        "sortAscending": ": activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>

    {{-- Gráficas --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    {{-- Capturar tecla F1 --}}
    <script>
        document.addEventListener('keydown', function (event) {
            if (event.key === 'F1') {
                event.preventDefault();
                window.open('/ayuda/index.htm', '_blank');
            }
        });
    </script>

    {{-- Nuevos scripts --}}
    @yield('scripts')

</body>
</html>