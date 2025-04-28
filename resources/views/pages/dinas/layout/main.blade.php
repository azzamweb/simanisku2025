<!DOCTYPE html>
<html lang="en">
    @include('pages/dinas/_partials/head')

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
            @include('pages/dinas/_partials/navbar')
            <!-- end Topbar -->

            
            <!-- ========== Left Sidebar Start ========== -->
            @include('pages/dinas/_partials/sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    @yield('content')
                    <!-- end container-fluid -->

                </div> <!-- end content -->

                

                <!-- Footer Start -->
                @include('pages/dinas/_partials/footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        {{-- <a href="{{ url('bantuan') }}" target="_blank" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-information"></i> &nbsp;Bantuan
        </a> --}}

        @include('pages/dinas/_partials/script')
        
    </body>
</html>