<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\KibTanah;

class KibTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'KIB Tanah - '.getTitle();

        // filter pencarian
        $pencarian = request()->input('cari');
        
        $sertifikat = request()->input('sertifikat');
        
        $jumlah_data = KibTanah::where('nama_barang', 'like', '%' . $pencarian . '%')
                        ->where('id_opd', $id_opd)
                        
                        ->when($sertifikat == 'Y', function ($query) {
                            return $query->whereNotNull('nomor_sertifikat')
                                        //  ->where('nomor_sertifikat', '!=', '-')
                                         ->whereNotNull('tanggal_sertifikat');
                        })
                        ->when($sertifikat == 'N', function ($query) {
                            return $query->where(function ($subQuery) {
                                $subQuery->whereNull('nomor_sertifikat')
                                         ->orWhere('nomor_sertifikat', '-');
                            })
                            ->whereNull('tanggal_sertifikat');
                        })
                        
                        ->count();
        
        $config = paginateRender($jumlah_data);
        
        $limit = $config->limit;
        $offset = $config->offset;
        $render = $config->render;
        $pencarian = $config->cari;
        $jumlah_page = $config->jumlah_page;

        $dataview->datanya = KibTanah::orderBy('id_kib', 'DESC')
        ->where('nama_barang', 'like', '%' . $pencarian . '%')
        ->where('id_opd', $id_opd)
        
        ->when($sertifikat == 'Y', function ($query) {
            return $query->whereNotNull('nomor_sertifikat')
                        //  ->where('nomor_sertifikat', '!=', '-')
                         ->whereNotNull('tanggal_sertifikat');
        })
        ->when($sertifikat == 'N', function ($query) {
            return $query->where(function ($subQuery) {
                $subQuery->whereNull('nomor_sertifikat')
                         ->orWhere('nomor_sertifikat', '-');
            })
            ->whereNull('tanggal_sertifikat');
        })
        
        ->limit($limit)->offset($offset)
        ->get();

        $dataview->paginate_render = $render;
        $dataview->jumlah_page = $jumlah_page;
        $dataview->pencarian = $pencarian;
        $dataview->offset = $offset;

        return view('pages/opd/kibtanah', compact('dataview'));
    }
    
    public function pencarian()
    {
        $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'KIB Tanah - '.getTitle();

        // filter pencarian
        $pencarian = request()->input('cari');
        
        $sertifikat = request()->input('sertifikat');
        
        $jumlah_data = KibTanah::where('nama_barang', 'like', '%' . $pencarian . '%')
                        ->where('id_opd', $id_opd)
                        
                        ->when($sertifikat == 'Y', function ($query) {
                            return $query->whereNotNull('nomor_sertifikat')
                                         ->where('nomor_sertifikat', '!=', '-')
                                         ->whereNotNull('tanggal_sertifikat');
                        })
                        ->when($sertifikat == 'N', function ($query) {
                            return $query->where(function ($subQuery) {
                                $subQuery->whereNull('nomor_sertifikat')
                                         ->orWhere('nomor_sertifikat', '-');
                            })
                            ->whereNull('tanggal_sertifikat');
                        })
                        
                        ->count();
        
        $config = paginateRender($jumlah_data);
        
        $limit = $config->limit;
        $offset = $config->offset;
        $render = $config->render;
        $pencarian = $config->cari;
        $jumlah_page = $config->jumlah_page;

        $dataview->datanya = KibTanah::orderBy('id_kib', 'DESC')
        ->where('nama_barang', 'like', '%' . $pencarian . '%')
        ->where('id_opd', $id_opd)
        
        ->when($sertifikat == 'Y', function ($query) {
            return $query->whereNotNull('nomor_sertifikat')
                         ->where('nomor_sertifikat', '!=', '-')
                         ->whereNotNull('tanggal_sertifikat');
        })
        ->when($sertifikat == 'N', function ($query) {
            return $query->where(function ($subQuery) {
                $subQuery->whereNull('nomor_sertifikat')
                         ->orWhere('nomor_sertifikat', '-');
            })
            ->whereNull('tanggal_sertifikat');
        })
        
        ->limit($limit)->offset($offset)
        ->get();

        $dataview->paginate_render = $render;
        $dataview->jumlah_page = $jumlah_page;
        $dataview->pencarian = $pencarian;
        $dataview->offset = $offset;

        return view('pages/opd/kibtanah_pencarian', compact('dataview'));
    }
    
    public function cetak()
    {
        $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'Print Tanah - '.getTitle();

        // filter pencarian
        $pencarian = request()->input('cari');
        
        $sertifikat = request()->input('sertifikat');
        
        $jumlah_data = KibTanah::where('nama_barang', 'like', '%' . $pencarian . '%')
                        ->where('id_opd', $id_opd)
                        
                        ->when($sertifikat == 'Y', function ($query) {
                            return $query->whereNotNull('nomor_sertifikat')
                                         ->where('nomor_sertifikat', '!=', '-')
                                         ->whereNotNull('tanggal_sertifikat');
                        })
                        ->when($sertifikat == 'N', function ($query) {
                            return $query->where(function ($subQuery) {
                                $subQuery->whereNull('nomor_sertifikat')
                                         ->orWhere('nomor_sertifikat', '-');
                            })
                            ->whereNull('tanggal_sertifikat');
                        })
                        
                        ->count();
        
        $config = paginateRender($jumlah_data);
        
        $limit = $config->limit;
        $offset = $config->offset;
        $render = $config->render;
        $pencarian = $config->cari;
        $jumlah_page = $config->jumlah_page;

        $dataview->datanya = KibTanah::orderBy('id_kib', 'DESC')
        ->where('nama_barang', 'like', '%' . $pencarian . '%')
        ->where('id_opd', $id_opd)
        
        ->when($sertifikat == 'Y', function ($query) {
            return $query->whereNotNull('nomor_sertifikat')
                         ->where('nomor_sertifikat', '!=', '-')
                         ->whereNotNull('tanggal_sertifikat');
        })
        ->when($sertifikat == 'N', function ($query) {
            return $query->where(function ($subQuery) {
                $subQuery->whereNull('nomor_sertifikat')
                         ->orWhere('nomor_sertifikat', '-');
            })
            ->whereNull('tanggal_sertifikat');
        })
        
        ->limit($limit)->offset($offset)
        ->get();

        $dataview->paginate_render = $render;
        $dataview->jumlah_page = $jumlah_page;
        $dataview->pencarian = $pencarian;
        $dataview->offset = $offset;

        return view('pages/opd/kibtanah_cetak', compact('dataview'));
    }
    
    public function print()
    {
        $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'Print Tanah - '.getTitle();

        // filter pencarian
        $pencarian = request()->input('cari');
        
        $sertifikat = request()->input('sertifikat');
        
        $dataview->datanya = KibTanah::orderBy('id_kib', 'DESC')
        ->where('nama_barang', 'like', '%' . $pencarian . '%')
        ->where('id_opd', $id_opd)
        
        ->when($sertifikat == 'Y', function ($query) {
            return $query->whereNotNull('nomor_sertifikat')
                         ->where('nomor_sertifikat', '!=', '-')
                         ->whereNotNull('tanggal_sertifikat');
        })
        ->when($sertifikat == 'N', function ($query) {
            return $query->where(function ($subQuery) {
                $subQuery->whereNull('nomor_sertifikat')
                         ->orWhere('nomor_sertifikat', '-');
            })
            ->whereNull('tanggal_sertifikat');
        })
        
        ->get();
        
        $dataview->pencarian = $pencarian;
        
        return view('pages/opd/kibtanah_print', compact('dataview'));
    }

    public function store(Request $request)
    {
        $id_opd = Auth::guard('opd')->id();

        // Validasi input termasuk file upload
        $request->validate([
            'nama_barang' => 'required|string',
            'kode_barang' => 'required|string',
            'kode_register' => 'required|string',
            'luas' => 'required|numeric',
            'tahun_pengadaan' => 'required|integer',
            'alamat' => 'required|string',
            'hak' => 'nullable|string',
            'tanggal_sertifikat' => 'nullable|date',
            'nomor_sertifikat' => 'nullable|string',
            'penggunaan' => 'nullable|string',
            'asal_usul' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'foto_tanah' => 'nullable|mimes:pdf|max:2048', // File jpg dengan ukuran maksimum 2MB
            'dokumen_tanah' => 'nullable|mimes:pdf|max:2048', // File pdf dengan ukuran maksimum 2MB
        ]);
        
        $kib = new KibTanah();
        $kib->id_opd = $id_opd;
        $kib->nama_barang = $request->nama_barang;
        $kib->kode_barang = $request->kode_barang;
        $kib->kode_register = $request->kode_register;
        $kib->luas = $request->luas;
        $kib->tahun_pengadaan = $request->tahun_pengadaan;
        $kib->alamat = $request->alamat;
        $kib->hak = $request->hak;
        $kib->tanggal_sertifikat = $request->tanggal_sertifikat;
        $kib->nomor_sertifikat = $request->nomor_sertifikat;
        $kib->penggunaan = $request->penggunaan;
        $kib->asal_usul = $request->asal_usul;
        $kib->harga = $request->harga;
        $kib->keterangan = $request->keterangan;
        $kib->latitude = $request->latitude;
        $kib->longitude = $request->longitude;
        $kib->created_at = NOW();
        $kib->updated_at = NOW();

        // Proses file foto
        if ($request->hasFile('foto_tanah')) {
            // Simpan file baru
            $fileName = time() . '_' . $request->file('foto_tanah')->getClientOriginalName();
            $request->file('foto_tanah')->move(public_path('storage/foto'), $fileName);
            $kib->foto_tanah = $fileName;
        }

        // Proses file dokumen
        if ($request->hasFile('dokumen_tanah')) {
            // Simpan file baru
            $fileName = time() . '_' . $request->file('dokumen_tanah')->getClientOriginalName();
            $request->file('dokumen_tanah')->move(public_path('storage/dokumen'), $fileName);
            $kib->dokumen_tanah = $fileName;
        }
        
        
        if($kib->save()){
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('failed', 'Data gagal disimpan.');
        }
    }

    public function update(Request $request, $id)
    {
        $kib = KibTanah::find($id);

        // Validasi input termasuk file upload
        $request->validate([
            'nama_barang' => 'required|string',
            'kode_barang' => 'required|string',
            'kode_register' => 'required|string',
            'luas' => 'required|numeric',
            'tahun_pengadaan' => 'required|integer',
            'alamat' => 'required|string',
            'hak' => 'nullable|string',
            'tanggal_sertifikat' => 'nullable|date',
            'nomor_sertifikat' => 'nullable|string',
            'penggunaan' => 'nullable|string',
            'asal_usul' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'foto_tanah' => 'nullable|mimes:pdf|max:2048', // File jpg dengan ukuran maksimum 2MB
            'dokumen_tanah' => 'nullable|mimes:pdf|max:2048', // File pdf dengan ukuran maksimum 2MB
        ]);

        
        $kib->nama_barang = $request->nama_barang;
        $kib->kode_barang = $request->kode_barang;
        $kib->kode_register = $request->kode_register;
        $kib->luas = $request->luas;
        $kib->tahun_pengadaan = $request->tahun_pengadaan;
        $kib->alamat = $request->alamat;
        $kib->hak = $request->hak;
        $kib->tanggal_sertifikat = $request->tanggal_sertifikat;
        $kib->nomor_sertifikat = $request->nomor_sertifikat;
        $kib->penggunaan = $request->penggunaan;
        $kib->asal_usul = $request->asal_usul;
        $kib->harga = $request->harga;
        $kib->keterangan = $request->keterangan;
        $kib->latitude = $request->latitude;
        $kib->longitude = $request->longitude;
        $kib->updated_at = NOW();

        // Proses file foto
        if ($request->hasFile('foto_tanah')) {
            // Hapus file lama jika ada
            if ($kib->foto_tanah) {
                if (file_exists(public_path('storage/foto/' . $kib->foto_tanah))) {
                    unlink(public_path('storage/foto/' . $kib->foto_tanah));
                }
            }
            // Simpan file baru
            $fileName = time() . '_' . $request->file('foto_tanah')->getClientOriginalName();
            $request->file('foto_tanah')->move(public_path('storage/foto'), $fileName);
            $kib->foto_tanah = $fileName;
        }

        // Proses file dokumen
        if ($request->hasFile('dokumen_tanah')) {
            // Hapus file lama jika ada
            if ($kib->dokumen_tanah) {
                if (file_exists(public_path('storage/dokumen/' . $kib->dokumen_tanah))) {
                    unlink(public_path('storage/dokumen/' . $kib->dokumen_tanah));
                }
            }
            // Simpan file baru
            $fileName = time() . '_' . $request->file('dokumen_tanah')->getClientOriginalName();
            $request->file('dokumen_tanah')->move(public_path('storage/dokumen'), $fileName);
            $kib->dokumen_tanah = $fileName;
        }

        
        if($kib->save()){
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->with('failed', 'Data gagal diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $kib = KibTanah::find($id);
    
        if (!$kib) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Hapus file foto jika ada
        if ($kib->foto_tanah) {
            $fotoPath = public_path('storage/foto/' . $kib->foto_tanah);
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }
    
        // Hapus file dokumen jika ada
        if ($kib->dokumen_tanah) {
            $dokumenPath = public_path('storage/dokumen/' . $kib->dokumen_tanah);
            if (file_exists($dokumenPath)) {
                unlink($dokumenPath);
            }
        }
    
        // Hapus data dari database
        if ($kib->delete()) {
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Data gagal dihapus.');
        }
    }

}
