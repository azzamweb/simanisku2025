<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::guard('dinas')->check()){
            return redirect('/dashboard-dinas');
        }

        $dataview = new \stdClass();
        $dataview->title = env('APP_NAME').' - '.getTitle();
        return view('pages/dinas/login', compact('dataview'));
    }

    public function buat_hash()
    {
        $hash = Hash::make('12345');
        return dd($hash);
    }

    /*public function registrasi()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Registrasi Akun - '.getTitle();
        return view('pages/siswa/registrasi', compact('dataview'));
    }*/

    /*public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if(empty($username) && empty($password)){
            return redirect()->back()->with('failed', 'Maaf, username dan password tidak boleh kosong.'); 
        }
        else{
            // return redirect()->back()->with('success', 'NISN: '.$username); 
            $pengguna = DB::table('siswa')->where('nisn', $username)->first();
            // kalau data pengguna tidak ada,
            if(!$pengguna) {
                return redirect()->back()->with('failed', 'Maaf, akun tidak terdaftar/tidak tersedia.<br><br>Mohon periksa kembali kebenaran nomor NISN anda atau jika belum terdaftar, silakan hubungi Admin Dinas Pendidikan.')->withInput();
            }
            else{
                // kalau pengguna sudah ada terdaftar,
                if (!Hash::check($password, $pengguna->password)) {
                    return redirect()->back()->with('failed', 'NISN atau password salah.')->withInput();
                }

                // cek status siswa
                if($pengguna->status_akun=='W'){
                    return redirect()->back()->with('warning', 'Akun anda belum aktif.<br>Silakan lakukan aktivasi akun melalui Admin Sekolah Anda.<br><br>Jika anda adalah calon peserta didik database Non-DAPODIK, silakan lakukan aktivasi ke SMP terdekat.')->withInput();
                }
                elseif($pengguna->status_akun=='A'){
                    // login
                    Auth::guard('siswa')->LoginUsingId($pengguna->id_siswa);
                    return redirect('/dashboard');
                }
            }
        } 
    }*/

    public function login(Request $request)
    {
        $akses_login = $request->akses_login;
        $username = $request->username;
        $password = $request->password;

        if(empty($username) && empty($password)){
            return redirect()->back()->with('failed', 'Username dan password tidak boleh kosong.')->withInput(); 
        }
        else{

            if($akses_login=='adm'){
                $pengguna = DB::table('akun_dinas')->where('username', $username)->first();
                // kalau data pengguna tidak ada,
                if(!$pengguna) {
                    return redirect()->back()->with('failed', 'Login gagal. Mohon periksa kembali username atau password anda.')->withInput();
                }
                else{
                    // kalau pengguna sudah ada terdaftar,
                    if (!Hash::check($password, $pengguna->password)) {
                        return redirect()->back()->with('failed', 'Username atau password salah.')->withInput();
                    }

                    Auth::guard('dinas')->LoginUsingId($pengguna->id_akun_dinas);

                    return redirect('/dashboard-dinas');
                }

            }
            elseif($akses_login=='opd'){
                $pengguna = DB::table('opd')->where('username', $username)->first();
                // kalau data pengguna tidak ada,
                if(!$pengguna) {
                    return redirect()->back()->with('failed', 'Login gagal. Mohon periksa kembali username atau password anda.')->withInput();
                }
                else{
                    // kalau pengguna sudah ada terdaftar,
                    if (!Hash::check($password, $pengguna->password)) {
                        return redirect()->back()->with('failed', 'Username atau password salah.')->withInput();
                    }

                    Auth::guard('opd')->LoginUsingId($pengguna->id_opd);

                    return redirect('/dashboard-opd');
                }
            }

        } 
    }

    /*public function login_sekolah(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if(empty($username) && empty($password)){
            return redirect()->back()->with('failed', 'Maaf, Username dan password tidak boleh kosong.'); 
        }
        else{
            $pengguna = DB::table('sekolah_sd')->where('npsn', $username)->orWhere('email', $username)->first();
            // kalau data pengguna tidak ada,
            if(!$pengguna) {
                return redirect()->back()->with('failed', 'Login gagal. Mohon periksa kembali username anda.')->withInput();
            }
            else{
                // kalau pengguna sudah ada terdaftar,
                if (!Hash::check($password, $pengguna->password)) {
                    return redirect()->back()->with('failed', 'Username atau password salah.')->withInput();
                }

                Auth::guard('sekolah')->LoginUsingId($pengguna->id_sekolah_sd);

                return redirect('/dashboard-sekolah');
            }
        }
    }

    public function login_verifikator(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if(empty($username) && empty($password)){
            return redirect()->back()->with('failed', 'Maaf, Username dan password tidak boleh kosong.'); 
        }
        else{
            $pengguna = DB::table('sekolah_smp')->where('npsn', $username)->orWhere('email', $username)->first();
            // kalau data pengguna tidak ada,
            if(!$pengguna) {
                return redirect()->back()->with('failed', 'Login gagal. Mohon periksa kembali username anda.')->withInput();
            }
            else{
                // kalau pengguna sudah ada terdaftar,
                if (!Hash::check($password, $pengguna->password)) {
                    return redirect()->back()->with('failed', 'Username atau password salah.')->withInput();
                }

                Auth::guard('verifikator')->LoginUsingId($pengguna->id_sekolah_smp);

                return redirect('/dashboard-verifikator');
            }
        }
    }

    public function daftar(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $nomor_hp = $request->nomor_hp;
        $password = $request->password;

        if(empty($email) && empty($password) && empty($nomor_hp) && empty($nama)){
            return redirect()->back()->with('failed', 'Maaf, field tidak boleh kosong.'); 
        }
        else{
            $pengguna = Pengguna::all()->where('email', $email)->first();
            // kalau data pengguna tidak ada,
            if(!$pengguna)
            {
                // daftar pengguna tersebut ke database
                $user = new Pengguna();
                $user->nama = $nama;
                $user->email = $email;
                $user->nomor_hp = $nomor_hp;
                $user->jenis_pengguna = 'registered';
                $user->password = Hash::make($password);
                $user->save();

                Session::put('id_pengguna', $user->id);
                Session::put('jenis_pengguna', $user->jenis_pengguna);
                    
                return redirect('/beranda')->with('success', 'Anda berhasil terdaftar.');
            }
            else{
                // kalau pengguna sudah ada terdaftar,
                // cek apakah pengguna ini admin atau registered
                $jenis_pengguna = $pengguna['jenis_pengguna'];
                if($jenis_pengguna=='admin'){
                    return redirect()->back()->with('failed', 'Maaf, email ini tidak dapat digunakan. Silakan gunakan email yang lain.');
                }
                elseif($jenis_pengguna=='registered'){
                    return redirect()->back()->with('warning', 'Maaf, email ini telah terdaftar. Silakan gunakan email yang lain.');
                }
                elseif($jenis_pengguna=='guest'){
                    // update pengguna tersebut ke database menjadi registered
                    
                    $pengguna->nama = $nama;
                    $pengguna->nomor_hp = $nomor_hp;
                    $pengguna->jenis_pengguna = 'registered';
                    $pengguna->password = Hash::make($password);
                    $pengguna->save();


                    Session::put('id_pengguna', $pengguna->id);
                    Session::put('jenis_pengguna', $pengguna->jenis_pengguna);
                    
                    return redirect('/beranda')->with('success', 'Anda berhasil terdaftar.');
                }
            }
        }
      
    }*/

    /*public function verifikator_login_page()
    {
        if(Auth::guard('verifikator')->check()){
            return redirect('/dashboard-verifikator');
        }

        $dataview = new \stdClass();
        $dataview->title = 'Login Verifikator - '.getTitle();
        return view('pages/verifikator/login', compact('dataview'));
    }*/

    /*public function sekolah_login_page()
    {
        if(Auth::guard('sekolah')->check()){
            return redirect('/dashboard-sekolah');
        }

        $dataview = new \stdClass();
        $dataview->title = 'Login Sekolah Asal - '.getTitle();
        return view('pages/sekolahasal/login', compact('dataview'));
    }*/

    /*public function logout()
    {
        session()->invalidate();
        return redirect('/login')->with('success', 'Anda telah keluar dari sistem');
    }*/

    public function logout()
    {
        session()->invalidate();
        session()->regenerateToken();
        // return redirect('/dinas')->with('success', 'Anda telah keluar dari sistem');
        return redirect('/')->with('success', 'Anda telah keluar dari sistem');
    }

    /*public function logout_sekolah()
    {
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/sekolah-asal')->with('success', 'Anda telah keluar dari sistem');
    }*/

    /*public function logout_verifikator()
    {
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/verifikator')->with('success', 'Anda telah keluar dari sistem');
    }*/

    public function ganti_password(Request $request)
    {
        $guards = ['siswa', 'dinas', 'sekolah', 'verifikator'];
        
        foreach ($guards as $guard) {
            $user = Auth::guard($guard)->user();
            
            if ($user) {
                $oldPassword = $request->old_password;
                $newPassword = $request->new_password;

                // Periksa apakah password lama sesuai dengan password pengguna
                if (Hash::check($oldPassword, $user->password)) {
                    // Jika sesuai, update password pengguna dengan password baru
                    $user->password = Hash::make($newPassword);
                    $user->save();

                    return redirect()->back()->with('success', 'Password berhasil diubah.');
                } else {
                    // Jika password lama tidak sesuai, kembalikan dengan pesan error
                    return redirect()->back()->with('failed', 'Password lama tidak sesuai. Silakan coba lagi.');
                }
            }
        }

        return redirect()->back()->with('failed', 'User tidak ditemukan. Silakan login kembali.');
    }
}
