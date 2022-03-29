<?php

namespace App\Models;

use CodeIgniter\Model;

class TenggatAbsenModel extends Model
{
    protected $table = 'tenggat_absen';
    protected $primaryKey = 'id_ta';
    protected $allowedFields = ['id_ta', 'id_user', 'bm_awal', 'bm_akhir', 'bp_awal', 'bp_akhir', 'tgl_tenggat'];
}
