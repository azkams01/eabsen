<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunSiswaModel extends Model
{
    protected $table = 'akun_siswa';
    protected $allowedFields = ['Foto', 'JenisKelamin', 'Email', 'NomorHp', 'Alamat', 'Password'];
}
