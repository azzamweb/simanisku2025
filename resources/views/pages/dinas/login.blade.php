@extends('pages.dinas.layout.auth')

@push('head')
@endpush

@section('content')
    <div class="account-pages pt-5 my-5">
        <div class="container">
            {{-- <div class="row justify-content-center"> --}}
            <div class="row">
                <div class="col-md-7">
                    
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center">
                                
                                <div class="align-items-center d-table mb-4 mx-auto">
                                    <div class="d-flex justify-content-between">
                                        <div class="align-self-center me-4">
                                            <img alt="logo dinas" class="img-fluid" src="{{ asset('storage/images/logo_dinas.png') }}" style="height: 80px;">
                                        </div>
                                    </div>
                                    
                                </div>
                        
                                <h5 class="text-white" style="
                                font-weight: bold;
                                text-shadow: 2px 2px 4px #000;
                                ">Selamat Datang di {{ env('APP_NAME') }}</h5>
                                <p class="text-white">{{ env('APP_TITLE') }}</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <img alt="bupati" class="img-fluid" src="{{ asset('storage/images/bupati.png') }}" style="height: 290px;">
                                        <h6 class="text-white"><b>KASMARNI, S.Sos., MMP</b><br>BUPATI BENGKALIS </h6>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <img alt="wakil bupati" class="img-fluid" src="{{ asset('storage/images/wakil_bupati.png') }}" style="height: 290px;">
                                        <h6 class="text-white"><b>H. Bagus Santoso</b><br>WAKIL BUPATI BENGKALIS </h6>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    
                </div>
                <div class="col-md-5">
                    {{-- <div class="text-center">
                        <div class="my-3">
                            <a href="javascript:;">
                                <span><img src="{{ asset('storage/images/logo_bengkalis.png') }}" alt=""
                                        height="60"></span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="account-card-box">
                        <div class="card mb-0">
                            <div class="card-body p-4">

                                <div class="text-center">
                                    {{-- <div class="my-3">
                                    <a href="{{ url('/') }}">
                                        <span><img src="{{ asset('themes/back/') }}/images/logo-ppdb-dark.png" alt="" height="28"></span>
                                    </a>
                                </div> --}}
                                    <h5 class="text-muted text-uppercase font-16">{{ env('APP_NAME') }}</h5>
                                    <p class="mb-4">{{ env('APP_TITLE') }}</p>
                                </div>

                                <form id="formLogin" action="{{ route('login.auth') }}" class="mt-2" method="POST">
                                    @csrf
                                    <div class="alert alert-info text-center">
                                        {{-- <p><b>Dinas Pendidikan dan Kebudayaan Kota Dumai</b><br>Silakan login untuk masuk ke
                                            sistem</p> --}}
                                            <p>Silakan login untuk masuk ke sistem</p>
                                    </div>

                                    <div id="errorMessage" class="alert alert-warning"></div>

                                    <div class="form-group mb-3">
                                        <label>Akses Login</label>
                                        <select class="form-control" name="akses_login" required>
                                            <option value="" selected disabled>Tentukan</option>
                                            <option value="adm">Admin</option>
                                            <option value="opd">OPD</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Username</label>
                                        <input class="form-control" type="text" id="username" name="username"
                                            placeholder="Username" value="{{ old('username') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Password</label>
                                        <input class="form-control" type="password" id="password" name="password"
                                            placeholder="Masukkan password">
                                    </div>

                                    {{-- <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div> --}}

                                    <div class="form-group text-center">
                                        <button class="btn btn-success btn-block waves-effect waves-light" type="submit">
                                            Log In </button>
                                    </div>

                                    {{-- <a href="javascript:;" class="text-muted" data-toggle="modal" data-target="#myModal"><i
                                            class="mdi mdi-lock mr-1"></i> Lupa password?</a> --}}
                                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">Lupa password?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Silakan hubungi Dinas Kominfo untuk dilakukan Reset Password.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect"
                                                        data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>

                                </form>



                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            {{-- <p class="text-white-50">Butuh bantuan? <a href="{{ url('bantuan') }}" class="text-white ml-1"><b>Klik disini</b></a></p> --}}
                            <p class="text-white-50">{{ date('Y') }} &copy; {{ env('APP_NAME') }}.
                                <br>
                                <span class="ml-1"><b>{{ env('APP_TITLE') }}</b></span>
                            </p>

                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
                
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection

@push('script')
    <script>
        document.getElementById("errorMessage").style.display = "none";

        document.getElementById("formLogin").addEventListener("submit", function(event) {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            //   if (!username || !password) {
            if (!username) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("errorMessage").style.display = "block";
                document.getElementById("errorMessage").textContent = "Kolom wajib di isi!";
            } else if (!password) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("errorMessage").style.display = "block";
                document.getElementById("errorMessage").textContent = "Password tidak boleh kosong!";
            }
        });
    </script>
@endpush
