<?php

use Illuminate\Support\Facades\Hash;
use App\Models\OPD;

if(!function_exists('getTitle')){
	function getTitle(){
		return env('APP_TITLE');
	}
}

if(!function_exists('getOPD')){
	function getOPD($id)
	{
	    $opd = OPD::find($id);
	    return $opd;
	}
}

if(!function_exists('getOPDSingkatan')){
	function getOPDSingkatan($singkatan)
	{
	    $opd = OPD::where('singkatan_opd', $singkatan)->first();
        return $opd;
	}
}

if(!function_exists('buatHash')){
	function buatHash($string)
	{
	dd(Hash::make($string));
	}
}

if(!function_exists('tanggalIndonesia')){
	function tanggalIndonesia($dateString, $time = true)
	{
	$timestamp = strtotime($dateString);
	if($time){
		$formattedDate = date('j M Y, H:i', $timestamp);
	}
	else{
		$formattedDate = date('j M Y', $timestamp);
	}
	return $formattedDate;
	}
}

if(!function_exists('tanggal_indonesia')){
	function tanggal_indonesia($tanggal, $showDay = false)
    {
        // Daftar nama bulan dalam bahasa Indonesia
        $namaBulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Daftar nama hari dalam bahasa Indonesia
        $namaHari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        // Memisahkan tahun, bulan, dan hari dari tanggal input
        $tanggalObj = strtotime($tanggal);
        $hari = $namaHari[date('l', $tanggalObj)];
        $tgl = date('j', $tanggalObj);
        $bulan = $namaBulan[(int)date('n', $tanggalObj)];
        $tahun = date('Y', $tanggalObj);

        // Mengembalikan hasil dalam format yang sesuai
        $hasilTanggal = "$tgl $bulan $tahun";
        if ($showDay) {
            $hasilTanggal = "$hari, " . $hasilTanggal;
        }

        return $hasilTanggal;
    }
}

if(!function_exists('paginateRender')){
	function paginateRender($total_data)
	{
		$data = array();
		$results_per_page = 10;
		$cari = null;
		$render = null;
		$custom_param = null; // Tambahkan parameter custom

		// Ambil nilai dari parameter custom dari URL
		foreach ($_GET as $key => $value) {
			if ($key !== 'page' && $key !== 'cari') {
				$custom_param .= '&' . $key . '=' . $value;
			}
		}

		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		} else {
			$page = 1;
		}
		;
		$start_from = ($page - 1) * $results_per_page;

		$cari = empty($_GET['cari']) ? null : $_GET['cari'];
		$render .= '<ul class="pagination">';
		//LINK FIRST AND PREV

		if ($page == 1) { // Jika page adalah page ke 1, maka disable link PREV

			$render .= '
			<li class="page-item disabled">
				<a class="page-link" href="javascript:;" aria-label="First">
					<span aria-hidden="true">First</span>
					<span class="sr-only">First</span>
				</a>
			</li>';
		} else { // Jika page bukan page ke 1
			$link_prev = ($page > 1) ? $page - 1 : 1;

			$render .= '
			<li class="page-item">
				<a class="page-link" href="?page=1&cari=' . $cari . $custom_param . '" aria-label="First">
					<span aria-hidden="true">First</span>
					<span class="sr-only">First</span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="?page=' . $link_prev . '&cari=' . $cari . $custom_param . '" aria-label="Prev">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Prev</span>
				</a>
			</li>';
		}
		// LINK NUMBER					
		$jumlah_page = ceil($total_data / $results_per_page); // Hitung jumlah halamannya
		$jumlah_number = 1; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
		$start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link number
		$end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

		for ($i = $start_number; $i <= $end_number; $i++) {
			$link_active = ($page == $i) ? ' class="page-item active"' : 'class="page-item"';

			$render .= '
			<li ' . $link_active . '><a class="page-link" href="?page=' . $i . '&cari=' . $cari . $custom_param . '">' . $i . '</a></li>';

		}

		// LINK NEXT AND LAST
		// Jika page sama dengan jumlah page, maka disable link NEXT nya
		// Artinya page tersebut adalah page terakhir 
		if ($page == $jumlah_page) { // Jika page terakhir

			$render .= '
			<li class="page-item disabled">
				<a class="page-link" href="javascript:;" aria-label="Next">
					<span aria-hidden="true">Last</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
			';

		} else { // Jika Bukan page terakhir
			$link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;

			$render .= '
			<li class="page-item">
				<a class="page-link" href="?page=' . $link_next . '&cari=' . $cari . $custom_param . '" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="?page=' . $jumlah_page . '&cari=' . $cari . $custom_param . '" aria-label="Last">
					<span aria-hidden="true">Last</span>
					<span class="sr-only">Last</span>
				</a>
			</li>
			';
		}

		$render .= '</ul>';

		$data = new \stdClass();
		$data->cari = $cari;
		$data->render = $render;
		$data->offset = $start_from;
		$data->limit = $results_per_page;
		$data->jumlah_page = $jumlah_page;
		return $data;
	}
}

if(!function_exists('highlight')){
	function highlight($text, $search) {
		$highlighted = preg_replace('/' . preg_quote($search, '/') . '/i', '<span style="background-color: yellow">$0</span>', $text);
		return $highlighted;
	}
}

if(!function_exists('formatSizeUnits')){
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}


if(!function_exists('haversineGreatCircleDistance')){
	function haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2) {
		$earthRadius = 6371; // Earth's radius in km

		$dLat = deg2rad((float)$lat2) - deg2rad((float)$lat1);
		$dLon = deg2rad((float)$lon2) - deg2rad((float)$lon1);

		$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad((float)$lat1)) * cos(deg2rad((float)$lat2)) * sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * asin(sqrt($a));

		$distance = $earthRadius * $c * 1000; // Convert to meters

		return $distance;
	}
}
