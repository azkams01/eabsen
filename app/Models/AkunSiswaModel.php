<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunSiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'NIS';
    protected $allowedFields = ['id_user', 'NIS', 'Nama_siswa', 'Kelas', 'Foto_siswa', 'JenisKelamin_siswa', 'Email_siswa', 'NomorHp_siswa', 'Alamat_siswa', 'Password_siswa'];

    public function search($keyword)
    {
        return $this->table('siswa')->like('NIS', $keyword)->orlike('Nama_siswa', $keyword)->orlike('Kelas', $keyword)->orlike('JenisKelamin_siswa', $keyword)->orlike('Email_siswa', $keyword)->orlike('NomorHp_siswa', $keyword)->orlike('Alamat_siswa', $keyword);
    }
    public function searchPersetujuan($keyword)
    {
        $kelas = akunGuru()->walikelas;
        $data = ['Hadir', 'Sakit', 'Izin'];
        $builder = $this->table('siswa');
        $builder->join('absensi', 'absensi.NIS = siswa.NIS');
        $builder->where('siswa.Kelas', $kelas);
        $builder->whereNotIn('absensi.keterangan_absen', $data);
        $builder->like('siswa.Nama_siswa', $keyword);
        $builder->orlike('absensi.tgl_absen', $keyword);
        return $builder;
    }
    public function searchSiswaGuru($keyword)
    {
        $kelas = akunGuru()->walikelas;
        $builder = $this->table('siswa');
        $builder->where('Kelas', $kelas);
        $builder->like('Nama_siswa', $keyword);
        $builder->orlike('NIS', $keyword);
        return $builder;
    }
    public function searchAdminReport($keyword)
    {
        $builder = $this->table('siswa');
        $builder->like('Nama_siswa', $keyword);
        $builder->orlike('NIS', $keyword);
        $builder->orlike('Kelas', $keyword);
        return $builder;
    }
    public function searchGuruReport($keyword)
    {
        $builder = $this->table('siswa');
        $builder->where('Kelas', akunGuru()->walikelas);
        $builder->like('Nama_siswa', $keyword);
        $builder->orlike('NIS', $keyword);
        return $builder;
    }
    public function searchRekapAdmin($isi)
    {
        $builder = $this->table('siswa');
        $builder->join('absensi', 'siswa.NIS = absensi.NIS');
        $builder->where('siswa.NIS', $isi[1]);
        $builder->like('absensi.tgl_absen', $isi[0]);
        $builder->orlike('absensi.keterangan_absen', $isi[0]);
        return $builder;
    }
    public function searchRekapGuru($isi)
    {
        $builder = $this->table('siswa');
        $builder->join('absensi', 'siswa.NIS = absensi.NIS');
        $builder->where('siswa.NIS', $isi[1]);
        $builder->where('siswa.Kelas', akunGuru()->walikelas);
        $builder->like('absensi.tgl_absen', $isi[0]);
        $builder->orlike('absensi.keterangan_absen', $isi[0]);
        return $builder;
    }
    public function filterReport($isi)
    {
        $builder = $this->table('siswa')->join('absensi', 'absensi.NIS = siswa.NIS')->where('siswa.Kelas', $isi[0])->where('absensi.tgl_absen', $isi[1])->where('absensi.keterangan_absen', $isi[2]);
        return $builder;
    }
    public function cekdata($nis)
    {
        return $this->db->table('siswa')
            ->where('NIS', $nis)
            ->get()->getRowArray();
    }
}
