@extends('pages.dinas.layout.main')

@push('head')
    <!-- Responsive Table css -->
    <link href="{{ asset('themes/back/') }}/libs/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />

    <style>
        select[readonly] {
        pointer-events: none;
        background-color: #f4f4f4; /* Warna latar belakang yang menunjukkan elemen tidak dapat diubah */
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
                        <li class="breadcrumb-item">OPD</li>
                        <li class="breadcrumb-item active">Daftar OPD</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar OPD</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="responsive-table-plugin">
                    <div class="table-rep-plugin">
                        <div class="table-wrapper">
                            <div class="btn-toolbar">
                                <div class="btn-group focus-btn-group mb-2">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target=".input-data"><i class="mdi mdi-plus"></i> Input Data</button>
                                </div>
                                <div class="btn-group dropdown-btn-group pull-right">
                                    {{-- <button type="button" class="btn btn-default">Tampil all</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Display <span class="caret"></span></button> --}}
                                    <form class="form-inline">
                                        <div class="input-group mb-3 mr-3">
                                            <input type="text" class="form-control" id="inlineFormInputGroup" name="cari" placeholder="{{ empty($dataview->pencarian) ? 'Cari data' : $dataview->pencarian }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="input-group-text" id="basic-addon1"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade input-data" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myCenterModalLabel">Input Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form method="POST" action="{{ route('opd.store') }}">
                                        @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama OPD</label>
                                                    <input type="text" class="form-control" name="nama_opd" value="{{ old('nama_opd') }}" placeholder="Nama OPD" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Singkatan OPD</label>
                                                    <input type="text" class="form-control" name="singkatan_opd" value="{{ old('singkatan_opd') }}" placeholder="Singkatan OPD" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Unit Organisasi</label>
                                            <input type="text" class="form-control" name="sub_unit_kerja" value="{{ old('sub_unit_kerja') }}" placeholder="Sub Unit Organisasi" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Lokasi</label>
                                            <input type="text" class="form-control" name="kode_lokasi" value="{{ old('kode_lokasi') }}" placeholder="Kode Lokasi" required>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username OPD" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <p>Password default adalah: 12345</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                                    </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Nama OPD</th>
                                    <th class="text-nowrap">Singkatan OPD</th>
                                    <th class="text-nowrap">Sub Unit Organisasi</th>
                                    <th class="text-nowrap">Kode Lokasi</th>
                                    <th class="text-nowrap">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nomor = $dataview->offset + 1;
                                @endphp
                                
                                @forelse($dataview->datanya as $opd)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $opd->nama_opd }}</td>
                                    <td>{{ $opd->singkatan_opd }}</td>
                                    <td>{{ $opd->sub_unit_kerja }}</td>
                                    <td>{{ $opd->kode_lokasi }}</td>
                                    <td class="text-nowrap">
                                        <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".edit-data{{ $opd->id_opd }}"><i class="mdi mdi-lead-pencil"></i> Edit</a>
                                        <a href="javascript:;" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".hapus-data{{ $opd->id_opd }}"><i class="mdi mdi-delete-outline"></i> Hapus</a>
                                    </td>
                                </tr>

                                <div class="modal fade edit-data{{ $opd->id_opd }}" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myCenterModalLabel">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <form method="POST" action="{{ route('opd.update', $opd->id_opd) }}">
                                                @csrf
                                                @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nama OPD</label>
                                                            <input type="text" class="form-control" name="nama_opd" value="{{ old('nama_opd', $opd->nama_opd) }}" placeholder="Nama OPD" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Singkatan OPD</label>
                                                            <input type="text" class="form-control" name="singkatan_opd" value="{{ old('singkatan_opd', $opd->singkatan_opd) }}" placeholder="Singkatan OPD" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sub Unit Organisasi</label>
                                                    <input type="text" class="form-control" name="sub_unit_kerja" value="{{ old('sub_unit_kerja', $opd->sub_unit_kerja) }}" placeholder="Sub Unit Organisasi" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Lokasi</label>
                                                    <input type="text" class="form-control" name="kode_lokasi" value="{{ old('kode_lokasi', $opd->kode_lokasi) }}" placeholder="Kode Lokasi" required>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="text" class="form-control" name="username" value="{{ old('username', $opd->username) }}" placeholder="Username OPD" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="text" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password User">
                                                            <small class="text-warning">Silakan kosongkan jika tidak ingin mengganti password</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary waves-effect">Perbaharui</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade hapus-data{{ $opd->id_opd }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusDataLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('opd.delete', $opd->id_opd) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive -->

                        @if($dataview->jumlah_page > 1)
                        <nav class="mt-4">
                            {!! $dataview->paginate_render !!}
                        </nav>
                        @endif

                    </div> <!-- end .table-rep-plugin-->
                </div> <!-- end .responsive-table-plugin-->
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('script')
    <script src="{{ asset('themes/back/') }}/libs/select2/select2.min.js"></script>
    <script src="{{ asset('themes/back/') }}/js/pages/form-advanced.init.js"></script>
@endpush