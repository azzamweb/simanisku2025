<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class CheckUserSession
{

    public function handle($request, Closure $next, ...$levels)
    {
        // Cek untuk setiap level yang diberikan sebagai parameter
        foreach ($levels as $level) {
            // Gunakan guard sesuai dengan level yang diperiksa
            if (Auth::guard($level)->check()) {
                // Jika pengguna terautentikasi dengan guard ini, lanjutkan request
                return $next($request);
            }
            else{
                // dd($level);
                // ini coding berfungsi, tetapi untuk amannya, redirect ke paling luar ajalah
                // if($level=='siswa'){
                //     return redirect('/logout');
                // }
                // elseif($level=='dinas'){
                //     return redirect('/logout-dinas');
                // }
                // elseif($level=='sekolah'){
                //     return redirect('/logout-sekolah');
                // }
                // elseif($level=='verifikator'){
                //     return redirect('/logout-verifikator');
                // }
                // else{
                //     return redirect('/')->with('failed', 'Anda tidak memiliki otoritas ke halaman ini');
                // }
                return redirect('/login')->with('warning', 'Silakan login kembali');
            }
        }
        
    }

}