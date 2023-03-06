<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="/dashboard" class="logo">
                <i class="mdi mdi-album"></i>
                <span>
                    Kasir App
                </span>
            </a>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                @can('check_most')
                <li>
                    <a href="/dashboard" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span
                            class="badge badge-pill badge-primary float-right">7</span><span>Dashboard</span></a>
                </li>
                @endcan

                @can('crud_user')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                class="mdi mdi-table-merge-cells"></i><span>User</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('user.index') }}">All Users</a></li>
                            <li><a href="{{ route('user.create') }}">Create User</a></li>
                        </ul>
                    </li>
                @endcan
                @can('crud_table')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                class="mdi mdi-table-merge-cells"></i><span>Meja</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('meja.index') }}">All Tables</a></li>
                            <li><a href="{{ route('meja.create') }}">Create Table</a></li>
                        </ul>
                    </li>
                @endcan
                @can('crud_menu')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                class="mdi mdi-table-merge-cells"></i><span>Menu</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('menu.index') }}">All Menu's</a></li>
                            <li><a href="{{ route('menu.create') }}">Create Menu</a></li>
                        </ul>
                    </li>
                @endcan
                @hasanyrole('kasir|manajer')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                class="mdi mdi-table-merge-cells"></i><span>Transaksi</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('do_transaction')
                                <li><a href="{{ route('transaksiview') }}">Tambah Transaksi</a></li>
                            @endcan
                            @can('see_private_transaction')
                                <li><a href="{{ route('transaksipribadi') }}">Lihat Transaksi</a></li>
                            @endcan
                            @can('see_all_transaction')
                                <li><a href="{{ route('transaksisemua') }}">Lihat Transaksi</a></li>
                            @endcan
                            @can('check_table_number')
                                <li><a href="{{ route('lihatmeja') }}">Lihat Status Meja</a></li>
                            @endcan
                            @can('cek_keuangan')
                                <li><a href="{{ route('cek_keuangan') }}">Lihat Laporan Keuangan</a></li>
                            @endcan
                            {{-- @can('check_most')
                                <li><a href="{{ route('lihatdata') }}">Lihat Statistik Menu</a></li>
                            @endcan --}}

                        </ul>
                    </li>
                @endhasanyrole

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>