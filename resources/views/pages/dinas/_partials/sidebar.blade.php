<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Menu Utama</li>

                <li>
                    <a href="{{ url('dashboard-dinas') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin-kib-tanah') }}">
                        <i class="mdi mdi-inbox"></i>
                        <span> KIB Tanah </span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ url('admin-kib-tanah-pencarian') }}">
                        <i class="mdi mdi-magnify"></i>
                        <span> Pencarian KIB Tanah </span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ url('admin-kib-tanah-cetak') }}">
                        <i class="mdi mdi-printer"></i>
                        <span> Cetak KIB Tanah </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('daftar-opd') }}">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span> Daftar OPD </span>
                    </a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-school-outline"></i>
                        <span> Sekolah Asal</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ url('sd') }}">Daftar Sekolah SD</a></li>
                        <li><a href="{{ url('akun-sekolah') }}">Akun Admin Sekolah</a></li>
                        <li><a href="{{ url('pendaftaran-siswa-sekolah') }}">Pendaftaran Siswa</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-school"></i>
                        <span> Sekolah Tujuan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ url('smp') }}">Daftar Sekolah SMP</a></li>
                        <li><a href="{{ url('akun-verifikator') }}">Akun Verifikator</a></li>
                        <li><a href="{{ url('quota') }}">Quota Penerimaan</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="{{ url('statistik-ppdb') }}">
                        <i class="mdi mdi-chart-bar"></i>
                        <span> Statistik PPDB </span>
                    </a>
                </li> --}}

                <li class="menu-title mt-2">Lainnya</li>

                <li>
                    <a href="javascript:;" onclick="promptLogout()">
                        <i class="mdi mdi-logout"></i>
                        <span> Logout </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>