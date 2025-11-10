<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">
        <img src="{{asset('img/iconos/logoPrincipal.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('clientes.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('productos.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('facturas.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Facturas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('proveedores.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Proveedores
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('metodoPagos.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Metodos de Pago
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('ordenCompras.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Ordenes de Compra
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>