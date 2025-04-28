@extends('pages.opd.layout.main')

@push('head')
<link href="{{ asset('themes/back/') }}/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
<style>
    .step-container {
        border: 1px solid #ccc;
        border-style: dashed;
        border-radius: 15px;
        padding: 20px 20px 30px 20px;

        display: flex;
        justify-content: space-between; /* Memposisikan ke tengah */
        align-items: center;
        margin: 0 auto; /* Menengahkan container */
        max-width: 600px; /* Menambahkan max-width untuk menjaga agar tahapan tidak terlalu lebar */
    }

    .step {
        height: 50px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px; /* Menyesuaikan teks menjadi vertikal tengah */
        font-size: 34px;
        margin: 0 5px;
    }

    .step-title {
        font-size: 14px;
        text-align: center;
    }

    .line {
        width: 50px; /* Sesuaikan panjang garis di sini */
        height: 1px; /* Sesuaikan ketebalan garis di sini */
        background-color: #ccc; /* Sesuaikan warna garis di sini */
    }

    @media screen and (max-width: 600px) {
        .step {
            width: 55px;
            height: 30px;
            line-height: 30px; /* Menyesuaikan teks menjadi vertikal tengah */
            font-size: 24px;
        }

        .step-title {
            font-size: 10px;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Utama</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    {{-- <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="title text-center">Tahapan Pelaksanaan {{ getTitle() }}</h4>
                <div class="step-container mt-5 mb-5">
                    <div class="step">
                        <i class="mdi mdi-file-upload"></i>
                        <div class="step-title">Pemberkasan</div>
                    </div>
                    <div class="line"></div>
                    <div class="step">
                        <i class="mdi mdi-pencil-box-multiple"></i>
                        <div class="step-title">Pendaftaran</div>
                    </div>
                    <div class="line"></div>
                    <div class="step">
                        <i class="mdi mdi-progress-check"></i>
                        <div class="step-title">Verifikasi</div>
                    </div>
                    <div class="line"></div>
                    <div class="step">
                        <i class="mdi mdi-calendar-check"></i>
                        <div class="step-title">Hasil</div>
                    </div>
                </div>
                <hr>
                <p>Silakan lihat jadwal lengkap <a href="javascript:;" class="badge badge-primary font-13">disini</a></p>
                <hr>
                <p>
                    <strong>Perhatian:</strong>
                    <br>Sebelum melakukan unggah dokumen, pastikan telah mempersiapkan dokumen berikut:
                    <ol>
                        <li>Format surat keterangan nilai rata-rata rapor <a href="javascript:;" class="badge badge-primary font-13">klik disini</a></li>
                        <li>Format surat pernyataan keabsahan dokumen <a href="javascript:;" class="badge badge-primary font-13">klik disini</a></li>
                    </ol>
                </p>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12">
            
            <div class="card-box">
                <h4 class="title text-center">Selamat datang, {{ Auth::guard('opd')->user()->nama_opd }}!</h4>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <a href="{{ url('kib-tanah?sertifikat=Y') }}">
                <div class="card-box tilebox-one">
                    <i class="icon-layers float-right m-0 h2 text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Total Aset Bersertifikat</h6>
                    <h3 class="my-3" data-plugin="counterup">{{ number_format($dataview->jumlah_sertifikat) }}</h3>
                    {{-- <span class="badge badge-success mr-1"> +11% </span> <span class="text-muted">From previous period</span> --}}
                </div>
            </a>
        </div>

        <div class="col-md-6 col-xl-3">
            <a href="{{ url('kib-tanah?sertifikat=N') }}">
                <div class="card-box tilebox-one">
                    <i class="icon-chart float-right m-0 h2 text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Belum Bersertifikat</h6>
                    <h3 class="my-3" data-plugin="counterup">{{ number_format($dataview->belum_sertifikat) }}</h3>
                    {{-- <span class="badge badge-danger mr-1"> -29% </span> <span class="text-muted">From previous period</span> --}}
                </div>
            </a>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <a href="{{ url('kib-tanah') }}">
                <div class="card-box tilebox-one">
                    <i class="icon-wallet float-right m-0 h2 text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Total Anggaran (Rp)</h6>
                    <h3 class="my-3" data-plugin="counterup">{{ number_format($dataview->total_anggaran, 2) }}</h3>
                    {{-- <span class="badge badge-danger mr-1"> -29% </span> <span class="text-muted">From previous period</span> --}}
                </div>
            </a>
        </div>

        
    </div>

    {{-- <div class="row">
        <div class="col-12">
            <div class="card-box mb-5">
                <p>Lihat Format surat pernyataan keabsahan dokumen <i>(hasil upload tadi)</i> <a href="javascript:;" class="badge badge-primary font-13">klik disini</a></p>
            </div>
        </div>
    </div> --}}
    
</div>
@endsection

@push('script')
<!-- Dashboard init js-->
<script src="{{ asset('themes/back/') }}/js/pages/dashboard.init.js"></script>
<!-- Plugins js -->
<script src="{{ asset('themes/back/') }}/libs/dropify/dropify.min.js"></script>

<!-- Init js-->
<script src="{{ asset('themes/back/') }}/js/pages/form-fileuploads.init.js"></script>
@endpush