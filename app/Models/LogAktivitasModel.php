<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAktivitasModel extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_la';
    protected $allowedFields = ['id_la', 'id_user', 'username', 'aktivitas', 'deskripsi', 'alamat_akses'];

    public function search($keyword)
    {
        $builder = $this->table('log_aktivitas');
        $builder->like('tanggal', $keyword);
        $builder->orLike('id_la', $keyword);
        $builder->orLike('waktu', $keyword);
        $builder->orLike('alamat_akses', $keyword);
        $builder->orLike('deskripsi', $keyword);
        return $builder;
    }
}
