<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\OPD;
use App\Models\KibTanah;

class PenandatanganController extends Controller
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
        $dataview->title = 'Penandatangan KIB A - '.getTitle();

        $opd = OPD::find($id_opd);
        
        $dataview->detail_opd = $opd;
        
        return view('pages/opd/penandatangan', compact('dataview'));
    }
    
    public function update_pimpinan(Request $request, $id)
    {
        $opd = OPD::find($id);
        
        $opd->pejabat_tandatangan = $request->pejabat_tandatangan;
        $opd->pejabat_tandatangan_nip = $request->pejabat_tandatangan_nip;
        
        if($opd->save()){
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->with('failed', 'Data gagal diperbarui.');
        }
    }
    
    public function update_pengurus(Request $request, $id)
    {
        $opd = OPD::find($id);
        
        $opd->pengurus_barang = $request->pengurus_barang;
        $opd->pengurus_barang_nip = $request->pengurus_barang_nip;
        
        if($opd->save()){
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
