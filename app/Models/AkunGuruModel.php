<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunGuruModel extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'NIP';
    protected $allowedFields = ['id_user', 'NIP', 'Nama_guru', 'walikelas', 'Foto_guru', 'JenisKelamin_guru', 'Email_guru', 'NomorHp_guru', 'Alamat_guru', 'Password_guru'];

    public function search($keyword)
    {
        return $this->table('guru')->like('NIP', $keyword)->orlike('Nama_guru', $keyword)->orlike('walikelas', $keyword)->orlike('JenisKelamin_guru', $keyword)->orlike('Email_guru', $keyword)->orlike('NomorHp_guru', $keyword)->orlike('Alamat_guru', $keyword);
    }
    // cek data apakah ada nip yang sama saat impor
    public function cekdata($nip)
    {
        return $this->db->table('guru')
            ->where('NIP', $nip)
            ->get()->getRowArray();
    }
}
