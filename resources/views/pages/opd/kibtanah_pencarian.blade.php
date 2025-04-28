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
                        <li class="breadcrumb-item active">Pencarian KIB Tanah</li>
                    </ol>
                </div>
                <h4 class="page-title">Pencarian KIB Tanah</h4>
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
                                    {{-- <button type="button" class="btn btn-default" data-toggle="modal" data-target=".input-data"><i class="mdi mdi-plus"></i> Input Data</button> --}}
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
                                        </td>
                                    </tr>

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