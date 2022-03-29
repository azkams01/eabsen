<?php
function akunSiswa()
{
    $db = \config\Database::connect();
    return $db->table('user')
        ->join('siswa', 'user.id_user = siswa.id_user')
        ->where('NIS', session('NIS'))
        ->get()
        ->getRow();
}
function akunUser()
{
    $db = \config\Database::connect();
    return $db->table('user')
        ->where('username', session('username'))
        ->get()
        ->getRow();
}
function akunGuru()
{
    $db = \config\Database::connect();
    return $db->table('guru')->where('NIP', session('NIP'))->get()->getRow();
}
function userSiswa()
{
    $db = \config\Database::connect();
    return $db->table('user')->where('username', 'siswa')->get()->getRow();
}
function siswaAbsen()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', session('NIS'))
        ->where('absensi.tgl_absen', $tanggal)
        ->get()
        ->getRow();
}
function absenMasuk()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', session('NIS'))->where('absensi.tgl_absen', $tanggal)->where('absensi.keterangan_absen', 'Hadir|Masuk')->get()->getRow();
}
function dataHadir($NIS)
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', $NIS)->where('absensi.keterangan_absen', 'Hadir')->countAllResults();
}
function dataSakit($NIS)
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', $NIS)->where('absensi.keterangan_absen', 'Sakit')->countAllResults();
}
function dataIzin($NIS)
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', $NIS)->where('absensi.keterangan_absen', 'Izin')->countAllResults();
}
function absenSakit()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', session('NIS'))->where('absensi.tgl_absen', $tanggal)->where('absensi.keterangan_absen', 'Sakit')->get()->getRow();
}
function absenIzin()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', session('NIS'))->where('absensi.tgl_absen', $tanggal)->where('absensi.keterangan_absen', 'Izin')->get()->getRow();
}
function pendingSakit()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', session('NIS'))->where('absensi.tgl_absen', $tanggal)->where('absensi.keterangan_absen', 'Sakit|Pending')->get()->getRow();
}
function pendingIzin()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', session('NIS'))->where('absensi.tgl_absen', $tanggal)->where('absensi.keterangan_absen', 'Izin|Pending')->get()->getRow();
}
function absenPulang()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')
        ->join('absensi', 'absensi.NIS = siswa.NIS')
        ->where('siswa.NIS', session('NIS'))->where('absensi.tgl_absen', $tanggal)->where('absensi.keterangan_absen', 'Hadir')->get()->getRow();
}
function historySekarang()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('siswa')->join('absensi', 'absensi.NIS = siswa.NIS')->where('siswa.NIS', akunSiswa()->NIS)->where('absensi.tgl_absen', $tanggal)->orderBy('absensi.id', 'DESC')->get()->getRow();
}
function tgl_libur()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('libur')->where('tgl_libur', $tanggal)->get()->getRow();
}
function tenggat_absen()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
    $db = \config\Database::connect();
    return $db->table('tenggat_absen')->where('tgl_tenggat', $tanggal)->get()->getRow();
}
function id_log()
{
    $db = \config\Database::connect();
    $kode_log = $db->table('log_aktivitas')->selectMax('id_la')->get()->getRow();
    $nourut = substr($kode_log->id_la, 2, 4);
    $kode_sekarang = $nourut + 1;
    $kode = "LA" . sprintf("%04s", $kode_sekarang);
    return $kode;
}
function id_min_log()
{
    $db = \config\Database::connect();
    $kode_log = $db->table('log_aktivitas')->selectMin('tanggal')->get()->getRow();
    $id_log = $kode_log->tanggal;
    return $id_log;
}
function id_max_log()
{
    $db = \config\Database::connect();
    $kode_log = $db->table('log_aktivitas')->selectMax('tanggal')->get()->getRow();
    $id_log = $kode_log->tanggal;
    return $id_log;
}
function id_pemberitahuan()
{
    $db = \config\Database::connect();
    $kode_pb = $db->table('pemberitahuan')->selectMax('id_pemberitahuan')->get()->getRow();
    $nourut = substr($kode_pb->id_pemberitahuan, 2, 2);
    $kode_sekarang = $nourut + 1;
    $kode = "PB" . sprintf("%02s", $kode_sekarang);
    return $kode;
}
function id_ta()
{
    $db = \config\Database::connect();
    $kode_ta = $db->table('tenggat_absen')->selectMax('id_ta')->get()->getRow();
    $nourut = substr($kode_ta->id_ta, 2, 2);
    $kode_sekarang = $nourut + 1;
    $kode = "TA" . sprintf("%02s", $kode_sekarang);
    return $kode;
}
function id_libur()
{
    $db = \config\Database::connect();
    $kode_libur = $db->table('libur')->selectMax('id_libur')->get()->getRow();
    $nourut = substr($kode_libur->id_libur, 1, 2);
    $kode_sekarang = $nourut + 1;
    $kode = "L" . sprintf("%02s", $kode_sekarang);
    return $kode;
}
function id_faq()
{
    $db = \config\Database::connect();
    $kode_libur = $db->table('faq')->selectMax('id_faq')->get()->getRow();
    $nourut = substr($kode_libur->id_faq, 1, 2);
    $kode_sekarang = $nourut + 1;
    $kode = "F" . sprintf("%02s", $kode_sekarang);
    return $kode;
}
function id_absen_hadir()
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal_sekarang = date("Y-m-d");
    $pisah_tanggal = explode("-", $tanggal_sekarang);
    $tahun = $pisah_tanggal[0];
    $tahun2digit = substr($tahun, 2, 2);
    $bulan = $pisah_tanggal[1];
    $tanggal = $pisah_tanggal[2];
    $NIS = substr(akunSiswa()->NIS, 7, 3);
    $id_absensi = "AH" . $tahun2digit . $bulan . $tanggal . $NIS;
    return $id_absensi;
}
function id_absen_keterangan($keterangan)
{
    date_default_timezone_set("Asia/Jakarta");
    $tanggal_sekarang = date("Y-m-d");
    $pisah_tanggal = explode("-", $tanggal_sekarang);
    $tahun = $pisah_tanggal[0];
    $tahun2digit = substr($tahun, 2, 2);
    $bulan = $pisah_tanggal[1];
    $tanggal = $pisah_tanggal[2];
    $NIS = substr(akunSiswa()->NIS, 7, 3);
    if ($keterangan == "Sakit|Pending") {
        $id_absensi = "AS" . $tahun2digit . $bulan . $tanggal . $NIS;
    } else {
        $id_absensi = "AI" . $tahun2digit . $bulan . $tanggal . $NIS;
    }
    return $id_absensi;
}
function hari_ini()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return  $hari_ini;
}
