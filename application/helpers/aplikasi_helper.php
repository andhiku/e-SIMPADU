<?php

function menu($menu, $blnReturn = false) {
    $out = '<ul class="nav" id="side-menu">';
    foreach ($menu as $menu_kelompok => $menu_item) {
        if (is_array($menu_item)) {
            $out .= '<li>';
            $out .= '<a href="#"><i class="fa  fa-book  fa-fw"></i>' . $menu_kelompok . '<span class="fa arrow"></span></a>';
//$out .= '<a href="#">' . $menu_kelompok . '</a>';
            $out .= '<ul class="nav nav-second-level">';
            foreach ($menu_item as $menu_judul => $menu_link) {
                $out .= '<li><a href="' . base_url() . $menu_link . '">' . $menu_judul . '</a></li>';
            }
            $out .= '</ul>';
            $out .= '</li>';
        } else {
            $out .= '<li>';
//$out .= '<a href="' . base_url() . $menu_item . '">' . $menu_kelompok . '</a>';
            $out .= '<a href="' . base_url() . $menu_item . '"><i class="fa fa-files-o fa-fw"></i>' . $menu_kelompok . '</a>';
            $out .= '</li>';
        }
    }
    $out .= '</ul>';

    if ($blnReturn) {
        return $out;
    } else {
        echo $out;
    }
}

function checkDateTime($data) {
    if (date('Y-m-d H:i:s', strtotime($data)) == $data) {
        return true;
    } else {
        return false;
    }
}

function tgl($vtgl) {
    if (date('Y-m-d H:i:s', strtotime($vtgl)) == $vtgl) {
        $vartg = date('d-m-Y', strtotime($vtgl));
        list( $tgl, $bll, $thl) = explode("-", $vartg);
        $res_tgl = $tgl . '-' . $bll . '-' . $thl;
        return $res_tgl;
    } else {
        return '00-00-0000';
    }
}

function post_tgl($vtgl) {
//$vartg = date('d-m-Y', strtotime($vtgl));
    list( $bll, $tgl, $thl) = explode("/", $vtgl);
    $res_tgl = $thl . '-' . $bll . '-' . $tgl;
    return $res_tgl;
}

function post_tgl_id($vtgl) {
    list( $tgl, $bll, $thl) = explode("/", $vtgl);
    $res_tgl = $thl . '-' . $bll . '-' . $tgl;
    return $res_tgl;
}

function tempel($tabel, $hasilcari, $kondisi = null) {
    $res_cari = mysql_query("SELECT * FROM $tabel WHERE $kondisi");
    if ($res_cari) {
        if ($row_cari = mysql_fetch_array($res_cari)) {
            return $row_cari[$hasilcari];
        }
    } else {
        return '-- no data result --';
    }
}

function item_array($tabel, $kondisi = null) {
    $res_cari = mysql_query("SELECT * FROM $tabel WHERE $kondisi");
    $rows = array();
    while ($row = mysql_fetch_array($res_cari)) {
        $rows[] = $row;
    }
    return $rows;
}

function f_get_bulan($data = null) {
    $blpan = array(
        '01' => 'JANUARI',
        '02' => 'FEBRUARI',
        '03' => 'MARET',
        '04' => 'APRIL',
        '05' => 'MEI',
        '06' => 'JUNI',
        '07' => 'JULI',
        '08' => 'AGUSTUS',
        '09' => 'SEPTEMBER',
        '10' => 'OKTOBER',
        '11' => 'NOVEMBER',
        '12' => 'DESEMBER'
    );
    if ($data != NULL) {
        return element($data, $blpan);
    } else {
        return $blpan;
    }
}

function hit_baris($tbl, $row_cari, $kondisi) {
    if ($kondisi != null) {
        $result = mysql_query("SELECT $row_cari FROM $tbl WHERE $kondisi");
    } else {
        $result = mysql_query("SELECT $row_cari FROM $tbl WHERE 1");
    }
    $num_rows = mysql_num_rows($result);
    return $num_rows;
}

function fRoleUser($data = null) {
    $role = array(
        'admin' => 'ADMINISTRATOR',
        'op1' => 'OP-LEVEL 1',
        'op2' => 'OP-LEVEL 2',
        'op3' => 'OP-LEVEL 3',
        'op4' => 'OP-LEVEL 4',
        'op5' => 'OP-LEVEL 5',
        'op6' => 'OP-LEVEL 6',
        'op7' => 'OP-LEVEL 7',
        'op8' => 'OP-LEVEL 8',
        'op9' => 'OP-LEVEL 9',
        'publik' => 'PUBLIK',
    );
    if ($data != NULL) {
        return element($data, $role);
    } else {
        return $role;
    }
}

function roleUser($tbl, $idx, $nama ) {
    // ambil data dari db
    $this->db->order_by($tbl, 'asc');
    $result = $this->db->get($tbl);

    // bikin array
    // please select berikut ini merupakan tambahan saja agar saat pertama
    // diload akan ditampilkan text please select.
    $dd[''] = 'Please Select';
    if ($result->num_rows() > 0) {
        foreach ($result->result() as $row) {
            // tentukan idx (sebelah kiri) dan $nama (sebelah kanan)
            $dd[$row->$idx] = $row->$nama;
        }
    }
    return $dd;
}

function hitung_waktu($time1 = null, $time2 = null) {
    $timezone = "Singapore";
    date_default_timezone_set($timezone);
//$waktu1 = date('H:i', time()); //mulai 
//$time2 = '01:43';

    $time1_unix = strtotime(date('Y-m-d') . ' ' . $time1 . ':00');
    $time2_unix = strtotime(date('Y-m-d') . ' ' . $time2 . ':00');
    $begin_day_unix = strtotime(date('Y-m-d') . ' 00:00:00');
    $jumlah_time = date('H:i', ($time1_unix + ($time2_unix - $begin_day_unix)));
    return $jumlah_time;
}

function f_jam() {
    $jamlist = array(
        '00' => '00',
        '01' => '01',
        '02' => '02',
        '03' => '03',
        '04' => '04',
        '05' => '05',
        '06' => '06',
        '07' => '07',
        '08' => '08',
        '09' => '09',
        '10' => '10',
        '11' => '11',
        '12' => '12',
        '13' => '13',
        '14' => '14',
        '15' => '15',
        '16' => '16',
        '17' => '17',
        '18' => '18',
        '19' => '19',
        '20' => '20',
        '21' => '21',
        '22' => '22',
        '23' => '23'
    );
    return $jamlist;
}

function terbilang($satuan) {
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($satuan < 12)
        return " " . $huruf[$satuan];
    elseif ($satuan < 20)
        return Terbilang($satuan - 10) . " belas";
    elseif ($satuan < 100)
        return Terbilang($satuan / 10) . " puluh" .
                Terbilang($satuan % 10);
    elseif ($satuan < 200)
        return "seratus" . Terbilang($satuan - 100);
    elseif ($satuan < 1000)
        return Terbilang($satuan / 100) . " ratus" .
                Terbilang($satuan % 100);
    elseif ($satuan < 2000)
        return "seribu" . Terbilang($satuan - 1000);
    elseif ($satuan < 1000000)
        return Terbilang($satuan / 1000) . " ribu" .
                Terbilang($satuan % 1000);
    elseif ($satuan < 1000000000)
        return Terbilang($satuan / 1000000) . " juta" .
                Terbilang($satuan % 1000000);
    elseif ($satuan >= 1000000000)
        echo "Angka terlalu Besar";
}

function random($panjang) {
    $pengacak = 'ABCDEFGHIJKLMNPQRSTU1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($pengacak) - 1);
        $string .= $pengacak{$pos};
    }
    return $string;
}

function random_angka($panjang) {
    $pengacak = '123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($pengacak) - 1);
        $string .= $pengacak{$pos};
    }
    return $string;
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>