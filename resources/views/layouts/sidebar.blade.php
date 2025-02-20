<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (Auth::User()->role == "admin")
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('product.index') }}" aria-expanded="false">
                            <i class="mdi mdi-home-variant"></i><span class="hide-menu">Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('pembelian') }}" aria-expanded="false">
                            <i class="mdi mdi-cart"></i><span class="hide-menu">Pembelian</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/user/') }}" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i><span class="hide-menu">User</span>
                        </a>
                    </li>
                @endif
                @if (Auth::User()->role == "employee")
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('product') }}" aria-expanded="false">
                            <i class="mdi mdi-home-variant"></i><span class="hide-menu">Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('sale.index') }}" aria-expanded="false">
                            <i class="mdi mdi-cart"></i><span class="hide-menu">Pembelian</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
