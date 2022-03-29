<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';
    protected $allowedFields = ['id_absensi', 'NIS', 'id_user', 'hari_absen', 'tgl_absen', 'jam_masuk', 'jam_pulang', 'keterangan_absen', 'keterangan_desc'];

    public function search($keyword)
    {
        $NIS = akunSiswa()->NIS;
        return $this->table('absensi')->join('siswa', 'absensi.NIS = siswa.NIS')->where('siswa.NIS', $NIS)->orderBy('absensi.tgl_absen', 'DESC')->like('absensi.id_absensi', $keyword);
    }
    public function searchAdminHadir($keyword)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $data = ['Hadir|Masuk', 'Hadir'];
        $builder = $this->table('absensi');
        $builder->join('siswa', 'absensi.NIS = siswa.NIS');
        $builder->whereIn('absensi.keterangan_absen', $data);
        $builder->where('absensi.tgl_absen', $tanggal);
        $builder->like('siswa.Nama_siswa', $keyword);
        $builder->orLike('siswa.Kelas', $keyword);
        return $builder;
    }
    public function searchAdminSakit($keyword)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $builder = $this->table('absensi');
        $builder->join('siswa', 'absensi.NIS = siswa.NIS');
        $builder->where('absensi.keterangan_absen', 'Sakit');
        $builder->where('absensi.tgl_absen', $tanggal);
        $builder->like('siswa.Nama_siswa', $keyword);
        $builder->orLike('siswa.Kelas', $keyword);
        return $builder;
    }
    public function searchAdminIzin($keyword)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $builder = $this->table('absensi');
        $builder->join('siswa', 'absensi.NIS = siswa.NIS');
        $builder->where('absensi.keterangan_absen', 'Izin');
        $builder->where('absensi.tgl_absen', $tanggal);
        $builder->like('siswa.Nama_siswa', $keyword);
        $builder->orLike('siswa.Kelas', $keyword);
        return $builder;
    }
    public function searchGuruHadir($keyword)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $data = ['Hadir|Masuk', 'Hadir'];
        $kelas = akunGuru()->walikelas;
        $builder = $this->table('absensi');
        $builder->join('siswa', 'absensi.NIS = siswa.NIS');
        $builder->where('siswa.Kelas', $kelas);
        $builder->where('absensi.tgl_absen', $tanggal);
        $builder->whereIn('absensi.keterangan_absen', $data);
        $builder->like('siswa.Nama_siswa', $keyword);
        $builder->orlike('siswa.NIS', $keyword);
        return $builder;
    }
    public function searchGuruSakit($keyword)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $kelas = akunGuru()->walikelas;
        $builder = $this->table('absensi');
        $builder->join('siswa', 'absensi.NIS = siswa.NIS');
        $builder->where('siswa.Kelas', $kelas);
        $builder->where('absensi.keterangan_absen', 'Sakit');
        $builder->where('absensi.tgl_absen', $tanggal);
        $builder->like('siswa.Nama_siswa', $keyword);
        $builder->orlike('siswa.NIS', $keyword);
        return $builder;
    }
    public function searchGuruIzin($keyword)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $kelas = akunGuru()->walikelas;
        $builder = $this->table('absensi');
        $builder->join('siswa', 'absensi.NIS = siswa.NIS');
        $builder->where('siswa.Kelas', $kelas);
        $builder->where('absensi.keterangan_absen', 'Izin');
        $builder->where('absensi.tgl_absen', $tanggal);
        $builder->like('siswa.Nama_siswa', $keyword);
        $builder->orlike('siswa.NIS', $keyword);
        return $builder;
    }
    public function searchPiket($keyword)
    {
        return $this->table('absensi')->join('siswa', 'absensi.NIS = siswa.NIS')->orderBy('absensi.tgl_absen', 'DESC')->like('absensi.keterangan_absen', $keyword)->orlike('siswa.Nama_siswa', $keyword)->orlike('siswa.Kelas', $keyword)->orlike('absensi.hari_absen', $keyword)->orlike('absensi.tgl_absen', $keyword)->orlike('siswa.NIS', $keyword);
    }
}
