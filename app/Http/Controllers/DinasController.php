<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\OPD;
use App\Models\KibTanah;

class DinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Dashboard - '.getTitle();
        
        $jumlah_opd = OPD::count();
        $jumlah_sertifikat = KibTanah::whereNotNull('nomor_sertifikat')
                         ->where('nomor_sertifikat', '!=', '-')
                         ->orWhereNotNull('tanggal_sertifikat')
                        ->count();
        $belum_sertifikat = KibTanah::where(function ($query) {
                            $query->whereNull('nomor_sertifikat')
                                  ->orWhere('nomor_sertifikat', '-');
                        })
                        ->whereNull('tanggal_sertifikat')
                        ->count();
        $total_anggaran = KibTanah::sum('harga');
                        
        $dataview->jumlah_opd = $jumlah_opd;
        $dataview->jumlah_sertifikat = $jumlah_sertifikat;
        $dataview->belum_sertifikat = $belum_sertifikat;
        $dataview->total_anggaran = $total_anggaran;

        return view('pages/dinas/dashboard', compact('dataview'));
    }

    public function kib()
    {
        // $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'KIB Tanah - '.getTitle();

        // // filter pencarian
        $pencarian = request()->input('cari');
        
        $sertifikat = request()->input('sertifikat');
        
        $jumlah_data = KibTanah::where('nama_barang', 'like', '%' . $pencarian . '%')
                        ->where('opd.nama_opd', 'like', '%' . $pencarian . '%')
                        ->join('opd', 'kib.id_opd', '=', 'opd.id_opd')
                        
                        ->when($sertifikat == 'Y', function ($query) {
                            return $query->whereNotNull('nomor_sertifikat')
                                         ->where('nomor_sertifikat', '!=', '-')
                                         ->orWhereNotNull('tanggal_sertifikat');
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
        ->join('opd', 'kib.id_opd', '=', 'opd.id_opd')
        
        ->when($sertifikat == 'Y', function ($query) {
            return $query->whereNotNull('nomor_sertifikat')
                         ->where('nomor_sertifikat', '!=', '-')
                         ->orWhereNotNull('tanggal_sertifikat');
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

        return view('pages/dinas/kibtanah', compact('dataview'));
    }
    
    public function kib_pencarian()
    {
        // $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'Pencarian KIB Tanah - '.getTitle();

        // filter pencarian
        $id_opd = request()->input('id_opd');
        $pencarian = request()->input('cari');
        $jumlah_data = KibTanah::join('opd', 'kib.id_opd', '=', 'opd.id_opd')
                        ->where(function ($query) use ($pencarian) {
                            $query->where('nama_barang', 'like', '%' . $pencarian . '%')
                                  ->orWhere('opd.nama_opd', 'like', '%' . $pencarian . '%');
                        })
                        ->when($id_opd, function ($query) use ($id_opd) {
                            return $query->where('opd.id_opd', $id_opd);
                        })
                        ->count();
        
        $config = paginateRender($jumlah_data);
        
        $limit = $config->limit;
        $offset = $config->offset;
        $render = $config->render;
        $pencarian = $config->cari;
        $jumlah_page = $config->jumlah_page;

        $dataview->datanya = KibTanah::orderBy('id_kib', 'DESC')
        ->join('opd', 'kib.id_opd', '=', 'opd.id_opd')
        ->where(function ($query) use ($pencarian) {
            $query->where('nama_barang', 'like', '%' . $pencarian . '%')
                  ->orWhere('opd.nama_opd', 'like', '%' . $pencarian . '%');
        })
        ->when($id_opd, function ($query) use ($id_opd) {
            return $query->where('opd.id_opd', $id_opd);
        })
        ->limit($limit)->offset($offset)
        ->get();

        $dataview->paginate_render = $render;
        $dataview->jumlah_page = $jumlah_page;
        $dataview->pencarian = $pencarian;
        $dataview->offset = $offset;
        
        $dataview->id_opd = $id_opd;
        $dataview->daftar_opd = OPD::orderBy('singkatan_opd', 'ASC')->get();

        return view('pages/dinas/kibtanah_pencarian', compact('dataview'));
    }
    
    public function kib_cetak()
    {
        // $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'Print KIB Tanah - '.getTitle();

        // filter pencarian
        $id_opd = request()->input('id_opd');
        $pencarian = request()->input('cari');
        $jumlah_data = KibTanah::join('opd', 'kib.id_opd', '=', 'opd.id_opd')
                        ->where(function ($query) use ($pencarian) {
                            $query->where('nama_barang', 'like', '%' . $pencarian . '%')
                                  ->orWhere('opd.nama_opd', 'like', '%' . $pencarian . '%');
                        })
                        ->when($id_opd, function ($query) use ($id_opd) {
                            return $query->where('opd.id_opd', $id_opd);
                        })
                        ->count();
        
        $config = paginateRender($jumlah_data);
        
        $limit = $config->limit;
        $offset = $config->offset;
        $render = $config->render;
        $pencarian = $config->cari;
        $jumlah_page = $config->jumlah_page;

        $dataview->datanya = KibTanah::orderBy('id_kib', 'DESC')
        ->join('opd', 'kib.id_opd', '=', 'opd.id_opd')
        ->where(function ($query) use ($pencarian) {
            $query->where('nama_barang', 'like', '%' . $pencarian . '%')
                  ->orWhere('opd.nama_opd', 'like', '%' . $pencarian . '%');
        })
        ->when($id_opd, function ($query) use ($id_opd) {
            return $query->where('opd.id_opd', $id_opd);
        })
        ->limit($limit)->offset($offset)
        ->get();

        $dataview->paginate_render = $render;
        $dataview->jumlah_page = $jumlah_page;
        $dataview->pencarian = $pencarian;
        $dataview->offset = $offset;
        
        $dataview->id_opd = $id_opd;
        $dataview->daftar_opd = OPD::orderBy('singkatan_opd', 'ASC')->get();

        return view('pages/dinas/kibtanah_cetak', compact('dataview'));
    }
    
    public function kib_print()
    {
        // $id_opd = Auth::guard('opd')->id();
        $dataview = new \stdClass();
        $dataview->title = 'Print KIB Tanah - '.getTitle();

        // filter pencarian
        $id_opd = request()->input('id_opd');
        $pencarian = request()->input('cari');
        
        $dataview->datanya = KibTanah::orderBy('id_kib', 'DESC')
        ->join('opd', 'kib.id_opd', '=', 'opd.id_opd')
        ->where(function ($query) use ($pencarian) {
            $query->where('nama_barang', 'like', '%' . $pencarian . '%')
                  ->orWhere('opd.nama_opd', 'like', '%' . $pencarian . '%');
        })
        ->when($id_opd, function ($query) use ($id_opd) {
            return $query->where('opd.id_opd', $id_opd);
        })
        
        ->get();

        $dataview->id_opd = $id_opd;
        
        return view('pages/dinas/kibtanah_print', compact('dataview'));
    }

    public function opd()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Daftar OPD - '.getTitle();

        // filter pencarian
        $pencarian = request()->input('cari');
        $jumlah_data = OPD::where('nama_opd', 'like', '%' . $pencarian . '%')->count();
        
        $config = paginateRender($jumlah_data);
        
        $limit = $config->limit;
        $offset = $config->offset;
        $render = $config->render;
        $pencarian = $config->cari;
        $jumlah_page = $config->jumlah_page;

        $dataview->datanya = OPD::orderBy('singkatan_opd', 'ASC')
        ->where('nama_opd', 'like', '%' . $pencarian . '%')
        ->limit($limit)->offset($offset)
        ->get();

        $dataview->paginate_render = $render;
        $dataview->jumlah_page = $jumlah_page;
        $dataview->pencarian = $pencarian;
        $dataview->offset = $offset;

        return view('pages/dinas/opd', compact('dataview'));
    }

    public function opd_store(Request $request)
    {
        if(empty($request->nama_opd)){
            return redirect()->back()->with('failed', 'Nama OPD tidak boleh kosong.')->withInput();
        }
        if(empty($request->singkatan_opd)){
            return redirect()->back()->with('failed', 'Singkatan OPD tidak boleh kosong.')->withInput();
        }
        if(empty($request->sub_unit_kerja)){
            return redirect()->back()->with('failed', 'Sub Unit Organisasi tidak boleh kosong.')->withInput();
        }
        if(empty($request->username)){
            return redirect()->back()->with('failed', 'Username tidak boleh kosong.')->withInput();
        }
        
        $opd = new OPD();
        $opd->nama_opd = $request->nama_opd;
        $opd->singkatan_opd = $request->singkatan_opd;
        $opd->sub_unit_kerja = $request->sub_unit_kerja;
        $opd->kode_lokasi = $request->kode_lokasi;

        $opd->username = $request->username;
        $hash = Hash::make('12345');
        $opd->password = $hash;
        
        if($opd->save()){
            return redirect()->back()->with('success', 'Data OPD berhasil disimpan.');
        } else {
            return redirect()->back()->with('failed', 'Data OPD gagal disimpan.');
        }
    }

    public function opd_update(Request $request, $id)
    {
        $opd = OPD::find($id);
        
        if(!$opd){
            return redirect()->back()->with('failed', 'OPD tidak ditemukan.');
        }
        
        if(empty($request->nama_opd)){
            return redirect()->back()->with('failed', 'Nama OPD tidak boleh kosong.')->withInput();
        }
        if(empty($request->singkatan_opd)){
            return redirect()->back()->with('failed', 'Singkatan OPD tidak boleh kosong.')->withInput();
        }
        if(empty($request->sub_unit_kerja)){
            return redirect()->back()->with('failed', 'Sub Unit Organisasi tidak boleh kosong.')->withInput();
        }
        if(empty($request->username)){
            return redirect()->back()->with('failed', 'Username tidak boleh kosong.')->withInput();
        }
        
        $opd->nama_opd = $request->nama_opd;
        $opd->singkatan_opd = $request->singkatan_opd;
        $opd->sub_unit_kerja = $request->sub_unit_kerja;
        $opd->kode_lokasi = $request->kode_lokasi;

        $opd->username = $request->username;
        if(!empty($request->password)){
            $hash = Hash::make($request->password);
            $opd->password = $hash;
        }
        
        if($opd->save()){
            return redirect()->back()->with('success', 'Data opd berhasil diperbarui.');
        } else {
            return redirect()->back()->with('failed', 'Data opd gagal diperbarui.');
        }
    }

    public function opd_delete($id)
    {
        $opd = OPD::find($id);
        
        if(!$opd){
            return redirect()->back()->with('failed', 'OPD tidak ditemukan.');
        }
        
        if($opd->delete()){
            return redirect()->back()->with('success', 'Data opd berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Data opd gagal dihapus.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
