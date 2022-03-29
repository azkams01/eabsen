<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggalLiburModel extends Model
{
    protected $table = 'libur';
    protected $primaryKey = 'id_libur';
    protected $allowedFields = ['id_libur', 'id_user', 'keterangan_libur', 'tgl_libur'];
}
