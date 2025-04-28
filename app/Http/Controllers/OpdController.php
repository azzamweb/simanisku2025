<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\OPD;
use App\Models\KibTanah;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $id_opd = Auth::guard('opd')->id();
        
        $dataview = new \stdClass();
        $dataview->title = 'Dashboard - '.getTitle();
        
        $jumlah_sertifikat = KibTanah::where('id_opd', $id_opd)
                         ->whereNotNull('nomor_sertifikat')
                        //  ->where('nomor_sertifikat', '!=', '-')
                         ->whereNotNull('tanggal_sertifikat')
                        ->count();
                        
        $belum_sertifikat = KibTanah::where('id_opd', $id_opd)
                        ->where(function ($query) {
                            $query->whereNull('nomor_sertifikat')
                                  ->orWhere('nomor_sertifikat', '-');
                        })
                        ->whereNull('tanggal_sertifikat')
                        ->count();
                        
        $total_anggaran = KibTanah::where('id_opd', $id_opd)
                        ->sum('harga');
        
        $dataview->jumlah_sertifikat = $jumlah_sertifikat;
        $dataview->belum_sertifikat = $belum_sertifikat;
        $dataview->total_anggaran = $total_anggaran;

        return view('pages/opd/dashboard', compact('dataview'));
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
