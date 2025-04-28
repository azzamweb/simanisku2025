<!DOCTYPE html>
<html>
<head>
    <title>KARTU INVENTARIS BARANG (KIB) A TANAH</title>
    <style>
        /* CSS untuk pengaturan kertas dan orientasi */
        /*@media print {*/
            @page {
                size: A4 landscape; /* Atur ukuran kertas A4 dan orientasi landscape */
                margin: 10mm; /* Atur margin sesuai kebutuhan */
            }
            body {
                font-family: Arial, sans-serif;
                font-size: 11px;
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }
            .header img {
                max-height: 100px; /* Ukuran logo */
            }
            .header .title {
                flex-grow: 1;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
            }
            
            .header .title p, 
            .header .title h3 {
                margin: 0;
                padding: 0;
                line-height: 1.2; /* Mengatur ketinggian baris agar lebih rapat */
            }
            
            /* CSS untuk tabel dengan border */
            table.table-bordered {
                width: 100%;
                border-collapse: collapse; /* Agar border tabel rapat */
            }
            table.table-bordered, table.table-bordered th, table.table-bordered td {
                border: 1px solid black; /* Border untuk tabel, th, dan td */
            }
            table.table-bordered th, table.table-bordered td {
                padding: 8px; /* Spasi di dalam sel */
                text-align: left; /* Perataan teks */
            }
            table.table-bordered th {
                background-color: #f2f2f2; /* Warna latar untuk header tabel */
                text-align: center;
            }
            
            .text-nowrap {
                white-space: nowrap;
            }
            
            /* CSS untuk tabel tanpa border */
            .no-border-table {
                width: 100%;
            }
            .no-border-table td {
                padding: 4px 8px;
            }
            .no-border-table td:first-child {
                font-weight: bold;
            }
            
            /* CSS untuk tanda tangan */
            .signature-container {
                margin-top: 30px;
                display: flex;
                justify-content: space-between;
            }
            .signature-box {
                width: 17%;
                text-align: center;
            }
            
            .left-side {
                text-align: left !important;
            }
            
        /*}*/
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('storage/images/logo_bengkalis.png') }}" alt="Logo"> <!-- Ganti dengan path logo Anda -->
        <div class="title">
            <p>PEMERINTAH KABUPATEN BENGKALIS</p>
            <h3>KARTU INVENTARIS BARANG (KIB) A<br>TANAH</h3>
        </div>
    </div>

    <div class="content">
        <table>
            <tr>
                <td><b>Provinsi</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>PROVINSI RIAU</td>
            </tr>
            <tr>
                <td><b>Kab./Kota</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>PEMERINTAH KABUPATEN BENGKALIS</td>
            </tr>
            <tr>
                <td><b>Bidang</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>Sekretariat Daerah</td>
            </tr>
            @if(!empty($dataview->id_opd))
            <tr>
                <td><b>Unit Organisasi</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ getOPD($dataview->id_opd)->nama_opd }}</td>
            </tr>
            <tr>
                <td><b>Sub Unit Organisasi</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ getOPD($dataview->id_opd)->sub_unit_kerja }}</td>
            </tr>
            <tr>
                <td><b>NO. KODE LOKASI</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ getOPD($dataview->id_opd)->kode_lokasi }}</td>
            </tr>
            @endif
        </table>
        
        <table class="table table-bordered">
            <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Jenis Barang / Nama Barang</th>
                <th colspan="2">Nomor</th>
                <th rowspan="3">Luas (M2)</th>
                <th rowspan="3">Tahun Pengadaan</th>
                <th rowspan="3">Letak / Alamat</th>
                <th colspan="3">Status Hak Tanah</th>
                <th rowspan="3">Penggunaan</th>
                <th rowspan="3">Asal Usul</th>
                <th rowspan="3">Harga (Rp)</th>
                <th rowspan="3">Keterangan</th>
            </tr>
            <tr>
                <th rowspan="2">Kode Barang</th>
                <th rowspan="2">Register</th>
                <th rowspan="2">Hak</th>
                <th colspan="2">Sertifikat</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Nomor</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
            </tr>
            </thead>
            <tbody>
            @php
                $nomor = 1;
                $jumlah_harga = 0;
            @endphp

            @forelse($dataview->datanya as $item)
                @php
                $jumlah_harga += $item->harga;
                @endphp
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td class="text-2-lines">{{ $item->nama_barang }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->kode_register }}</td>
                    <td>{{ number_format($item->luas) }}</td>
                    <td>{{ $item->tahun_pengadaan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td class="text-nowrap">{{ $item->hak }}</td>
                    <td class="text-nowrap">{!! empty($item->tanggal_sertifikat) ? '<i class="text-danger">Belum Sertifikat</i>' : $item->tanggal_sertifikat !!}</td>
                    <td class="text-nowrap">{{ $item->nomor_sertifikat }}</td>
                    <td>{{ $item->penggunaan }}</td>
                    <td>{{ $item->asal_usul }}</td>
                    <td class="text-nowrap">{{ number_format($item->harga, 2) }}</td>
                    <td>{{ $item->keterangan}}</td>
                    
                </tr>
                
            @empty
            <tr>
                    <td colspan="14" align="center">Tidak ada data</td>
                </tr>
            @endforelse
                <tr>
                    <td colspan="12" style="text-align: right;"><b>Jumlah Harga</b></td>
                    <td>{{ number_format($jumlah_harga, 2) }}</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Bagian untuk tanda tangan -->
        <div class="signature-container">
            <div class="signature-box">
                <p><strong>Mengetahui,</strong></p>
                
                @if(!empty($dataview->id_opd))
                    @if(strtoupper(getOPD($dataview->id_opd)->nama_opd)=='SEKRETARIAT DAERAH')
                        <p><strong>SEKRETARIS DAERAH</strong></p>
                    @else
                        <p><strong>KEPALA {{ strtoupper(getOPD($dataview->id_opd)->nama_opd) }}</strong></p>
                    @endif
                @else
                    <p><strong>SEKRETARIS DAERAH</strong></p>
                @endif
                
                <br>
                <br>
                <br>
                
                @if(!empty($dataview->id_opd))
                    <p class="left-side">{{ getOPD($dataview->id_opd)->pejabat_tandatangan }}</p>
                    <hr>
                    <p class="left-side">NIP. {{ getOPD($dataview->id_opd)->pejabat_tandatangan_nip }}</p>
                @else
                    <p class="left-side">{{ getOPDSingkatan('setda')->pejabat_tandatangan }}</p>
                    <hr>
                    <p class="left-side">NIP. {{ getOPDSingkatan('setda')->pejabat_tandatangan_nip }}</p>
                @endif
                
            </div>
            <div class="signature-box">
                <p>Bengkalis, {{ tanggal_indonesia(date('Y-m-d')) }}</p>
                
                @if(!empty($dataview->id_opd))
                    <p><strong>PENGURUS BARANG {{ strtoupper(getOPD($dataview->id_opd)->nama_opd) }}</strong></p>
                @else
                    <p><strong>ADMINISTRATOR SISTEM PENGURUS BARANG</strong></p>
                @endif
                
                <br>
                <br>
                <br>
                
                @if(!empty($dataview->id_opd))
                    <p class="left-side">{{ getOPD($dataview->id_opd)->pengurus_barang }}</p>
                    <hr>
                    <p class="left-side">NIP. {{ getOPD($dataview->id_opd)->pengurus_barang_nip }}</p>
                @else
                    <p class="left-side">{{ Auth::guard('dinas')->user()->nama }}</p>
                    <hr>
                    <p class="left-side">NIP. -</p>
                @endif
                
            </div>
        </div>
        
    </div>
    
    <!-- JavaScript untuk mencetak halaman -->
    <script>
        window.print();
    </script>
</body>
</html>
