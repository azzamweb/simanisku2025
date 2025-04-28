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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Utama</a></li>
                        <li class="breadcrumb-item active">KIB Tanah</li>
                    </ol>
                </div>
                <h4 class="page-title">KIB Tanah</h4>
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
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myCenterModalLabel">Input Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form method="POST" action="{{ route('kib.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_barang">Nama Barang</label>
                                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Nama Barang" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kode_barang">Kode Barang</label>
                                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="Kode Barang" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kode_register">Kode Register</label>
                                                    <input type="text" class="form-control" id="kode_register" name="kode_register" value="{{ old('kode_register') }}" placeholder="Kode Register" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="luas">Luas (m²)</label>
                                                    <input type="number" step="0.01" class="form-control" id="luas" name="luas" value="{{ old('luas') }}" placeholder="Luas" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="tahun_pengadaan">Tahun Pengadaan</label>
                                            <input type="number" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan" value="{{ old('tahun_pengadaan') }}" placeholder="Tahun Pengadaan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="hak">Hak</label>
                                            <input type="text" class="form-control" id="hak" name="hak" value="{{ old('hak') }}" placeholder="Hak" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_sertifikat">Tanggal Sertifikat</label>
                                                    <input type="date" class="form-control" id="tanggal_sertifikat" name="tanggal_sertifikat" value="{{ old('tanggal_sertifikat') }}" placeholder="Tanggal Sertifikat">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nomor_sertifikat">Nomor Sertifikat</label>
                                                    <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" value="{{ old('nomor_sertifikat') }}" placeholder="Nomor Sertifikat">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="penggunaan">Penggunaan</label>
                                                    <input type="text" class="form-control" id="penggunaan" name="penggunaan" value="{{ old('penggunaan') }}" placeholder="Penggunaan" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="asal_usul">Asal Usul</label>
                                                    <input type="text" class="form-control" id="asal_usul" name="asal_usul" value="{{ old('asal_usul') }}" placeholder="Asal Usul" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" placeholder="Harga" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required>{{ old('keterangan') }}</textarea>
                                        </div>
                                        <hr>
                                        <h4>Lokasi Tanah</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="latitude">Latitude</label>
                                                    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Latitude">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="longitude">Longitude</label>
                                                    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Longitude">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="icon-info"></i> <b>Perhatian:</b>
                                                    <br>Format file upload untuk <b>Foto dan Dokumen</b> adalah <b>PDF</b> dengan ukuran file <b>maksimal</b> dibawah <b>2MB</b></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="foto_tanah">Foto Tanah</label>
                                                    <input type="file" class="form-control" id="foto_tanah" name="foto_tanah" value="{{ old('foto_tanah') }}" placeholder="Foto Tanah">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="dokumen_tanah">Dokumen Tanah</label>
                                                    <input type="file" class="form-control" id="dokumen_tanah" name="dokumen_tanah" value="{{ old('dokumen_tanah') }}" placeholder="Dokumen Tanah">
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
                                    <th class="text-nowrap">No</th>
                                    <th>Jenis Barang / Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Nomor Register</th>
                                    <th>Luas (M2)</th>
                                    <th>Tahun Pengadaan</th>
                                    <th>Letak / Alamat</th>
                                    <th>Status Hak Tanah</th>
                                    <th class="text-nowrap">Tanggal Sertifikat</th>
                                    <th class="text-nowrap">Nomor Sertifikat</th>
                                    <th>Penggunaan</th>
                                    <th>Asal Usul</th>
                                    <th>Harga (Rp)</th>
                                    <th>Keterangan</th>
                                    <th class="text-nowrap">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nomor = $dataview->offset + 1;
                                @endphp
        
                                @forelse($dataview->datanya as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{!! highlight($item->nama_barang, $dataview->pencarian) !!}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->kode_register }}</td>
                                        <td>{{ number_format($item->luas) }}</td>
                                        <td>{{ $item->tahun_pengadaan }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->hak }}</td>
                                        <td>{!! empty($item->tanggal_sertifikat) ? '<i class="text-danger">Belum Sertifikat</i>' : $item->tanggal_sertifikat !!}</td>
                                        <td>{{ $item->nomor_sertifikat }}</td>
                                        <td>{{ $item->penggunaan }}</td>
                                        <td>{{ $item->asal_usul }}</td>
                                        <td>{{ number_format($item->harga, 2) }}</td>
                                        <td>{{ $item->keterangan}}</td>
                                        <td class="text-nowrap">
                                            <a href="javascript:;" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".detail-data{{ $item->id_kib }}"><i class="mdi mdi-folder"></i> Detail</a>
                                            <a href="javascript:;" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".edit-data{{ $item->id_kib }}"><i class="mdi mdi-lead-pencil"></i> Edit</a>
                                            <a href="javascript:;" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".hapus-data{{ $item->id_kib }}"><i class="mdi mdi-delete-outline"></i> Hapus</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade edit-data{{ $item->id_kib }}" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myCenterModalLabel">Edit Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <form method="POST" action="{{ route('kib.update', $item->id_kib) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nama_barang">Nama Barang</label>
                                                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" placeholder="Nama Barang" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="kode_barang">Kode Barang</label>
                                                                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang) }}" placeholder="Kode Barang" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="kode_register">Kode Register</label>
                                                                <input type="text" class="form-control" id="kode_register" name="kode_register" value="{{ old('kode_register', $item->kode_register) }}" placeholder="Kode Register" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="luas">Luas (m²)</label>
                                                                <input type="number" step="0.01" class="form-control" id="luas" name="luas" value="{{ old('luas', $item->luas) }}" placeholder="Luas" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="tahun_pengadaan">Tahun Pengadaan</label>
                                                        <input type="number" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan" value="{{ old('tahun_pengadaan', $item->tahun_pengadaan) }}" placeholder="Tahun Pengadaan" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>{{ old('alamat', $item->alamat) }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hak">Hak</label>
                                                        <input type="text" class="form-control" id="hak" name="hak" value="{{ old('hak', $item->hak) }}" placeholder="Hak" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tanggal_sertifikat">Tanggal Sertifikat</label>
                                                                <input type="date" class="form-control" id="tanggal_sertifikat" name="tanggal_sertifikat" value="{{ old('tanggal_sertifikat', $item->tanggal_sertifikat) }}" placeholder="Tanggal Sertifikat" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nomor_sertifikat">Nomor Sertifikat</label>
                                                                <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" value="{{ old('nomor_sertifikat', $item->nomor_sertifikat) }}" placeholder="Nomor Sertifikat" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="penggunaan">Penggunaan</label>
                                                                <input type="text" class="form-control" id="penggunaan" name="penggunaan" value="{{ old('penggunaan', $item->penggunaan) }}" placeholder="Penggunaan" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="asal_usul">Asal Usul</label>
                                                                <input type="text" class="form-control" id="asal_usul" name="asal_usul" value="{{ old('asal_usul', $item->asal_usul) }}" placeholder="Asal Usul" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Harga</label>
                                                        <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="{{ old('harga', $item->harga) }}" placeholder="Harga" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required>{{ old('keterangan', $item->keterangan) }}</textarea>
                                                    </div>
                                                    <hr>
                                                    <h4>Lokasi Tanah</h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="latitude">Latitude</label>
                                                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $item->latitude) }}" placeholder="Latitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="longitude">Longitude</label>
                                                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $item->longitude) }}" placeholder="Longitude">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-info">
                                                                <i class="icon-info"></i> <b>Perhatian:</b>
                                                                <br>Format file upload untuk <b>Foto dan Dokumen</b> adalah <b>PDF</b> dengan ukuran file <b>maksimal</b> dibawah <b>2MB</b></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="foto_tanah">Foto Tanah</label>
                                                                <input type="file" class="form-control" id="foto_tanah" name="foto_tanah" value="{{ old('foto_tanah') }}" placeholder="Foto Tanah">
                                                                <small class="text-danger">Kosongkan jika tidak ingin memperbaharui</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="dokumen_tanah">Dokumen Tanah</label>
                                                                <input type="file" class="form-control" id="dokumen_tanah" name="dokumen_tanah" value="{{ old('dokumen_tanah') }}" placeholder="Dokumen Tanah">
                                                                <small class="text-danger">Kosongkan jika tidak ingin memperbaharui</small>
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

                                    <div class="modal fade detail-data{{ $item->id_kib }}" tabindex="-1" role="dialog" aria-labelledby="detailDataLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailDataLabel">Detail Tambahan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Lokasi Tanah</h5>
                                                    <div class="form-group">
                                                        <label for="latitude">Latitude:</label>
                                                        <input type="text" class="form-control" id="latitude" value="{{ $item->latitude }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="longitude">Longitude:</label>
                                                        <input type="text" class="form-control" id="longitude" value="{{ $item->longitude }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank" class="btn btn-success btn-sm"><i class="mdi mdi-map"></i> Lihat di Peta</a>
                                                    </div>
                                                    
                                                    <hr>
                                    
                                                    <h5>Dokumen Foto</h5>
                                                    <div class="form-group">
                                                        @if($item->foto_tanah)
                                                            <a href="{{ asset('storage/foto/' . $item->foto_tanah) }}" target="_blank" class="btn btn-primary btn-sm"><i class="mdi mdi-link"></i> Lihat Foto</a>
                                                        @else
                                                            <p>Foto tanah belum diunggah.</p>
                                                        @endif
                                                    </div>
                                    
                                                    <h5>File Dokumen</h5>
                                                    <div class="form-group">
                                                        @if($item->dokumen_tanah)
                                                            <a href="{{ asset('storage/dokumen/' . $item->dokumen_tanah) }}" target="_blank" class="btn btn-primary btn-sm"><i class="mdi mdi-link"></i> Lihat Dokumen</a>
                                                        @else
                                                            <p>Dokumen tanah belum diunggah.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                   <div class="modal fade hapus-data{{ $item->id_kib }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusDataLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('kib.delete', $item->id_kib) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data KIB ini?
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
                                {{-- <tr>
                                        <td colspan="4" align="center">Tidak ada data</td>
                                    </tr> --}}
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

@endpush