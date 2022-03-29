<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanSaranModel extends Model
{
    protected $table = 'pesan_saran';
    protected $primaryKey = 'id_ps';
    protected $allowedFields = ['id_ps', 'NIS', 'pesan'];
}
