@extends('pages.opd.layout.main')

@push('head')
    <!-- Responsive Table css -->
    <link href="{{ asset('themes/back/') }}/libs/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
    <style>
        @keyframes blink {
            50% {
                opacity: 0.1;
            }
        }

        #blink-alert {
            animation: blink 3s infinite;
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Lainnya</a></li>
                        <li class="breadcrumb-item active">Penandatangan</li>
                    </ol>
                </div>
                <h4 class="page-title">Penandatangan</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    {{-- <div class="row">
        <div class="col-lg-12">
            <div id="blink-alert" class="alert alert-info">
                <b>Perhatian</b> : Jika ada perubahan jadwal yang anda lakukan, akan berdampak langsung terhadap <b>dibuka/tutup</b>nya modul pendaftaran siswa didalam aplikasi
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="responsive-table-plugin">
                    <div class="table-rep-plugin">
                        
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>PROVINSI RIAU</td>
                                </tr>
                                <tr>
                                    <td>Kab./Kota</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>PEMERINTAH KABUPATEN BENGKALIS</td>
                                </tr>
                                <tr>
                                    <td>Bidang</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>Sekretariat Daerah</td>
                                </tr>
                                <tr>
                                    <td>Unit Organisasi</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ Auth::guard('opd')->user()->nama_opd }}</td>
                                </tr>
                                <tr>
                                    <td>Sub Unit Organisasi</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ Auth::guard('opd')->user()->sub_unit_kerja }}</td>
                                </tr>
                                <tr>
                                    <td>No. Kode Lokasi</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td>{{ Auth::guard('opd')->user()->kode_lokasi }}</td>
                                </tr>
                            </table>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-nowrap">Jabatan</th>
                                    <th class="text-nowrap">Nama Pejabat</th>
                                    <th class="text-nowrap">NIP</th>
                                    <th class="text-nowrap">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('update.pimpinan', Auth::guard('opd')->id() ) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <tr>
                                            <td>Pimpinan / Kepala</td>
                                            <td>
                                                <input type="text" class="form-control" name="pejabat_tandatangan" value="{{ $dataview->detail_opd->pejabat_tandatangan }}" placeholder="Nama Pejabat" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="pejabat_tandatangan_nip" value="{{ $dataview->detail_opd->pejabat_tandatangan_nip }}" placeholder="NIP" required>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                                            </td>
                                        </tr>
                                    </form>
                                    
                                    <form action="{{ route('update.pengurus', Auth::guard('opd')->id() ) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <tr>
                                            <td>Pengurus Barang</td>
                                            <td>
                                                <input type="text" class="form-control" name="pengurus_barang" value="{{ $dataview->detail_opd->pengurus_barang }}" placeholder="Nama Pejabat" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="pengurus_barang_nip" value="{{ $dataview->detail_opd->pengurus_barang_nip }}" placeholder="NIP" required>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                                            </td>
                                        </tr>
                                    </form>
                                
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive -->

                        
                    </div> <!-- end .table-rep-plugin-->
                </div> <!-- end .responsive-table-plugin-->
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('script')

@endpush