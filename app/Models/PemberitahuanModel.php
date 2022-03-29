<?php

namespace App\Models;

use CodeIgniter\Model;

class PemberitahuanModel extends Model
{
    protected $table = 'pemberitahuan';
    protected $primaryKey = 'id_pemberitahuan';
    protected $allowedFields = ['id_pemberitahuan', 'id_user', 'informasi', 'tgl_info', 'narasumber'];
}
