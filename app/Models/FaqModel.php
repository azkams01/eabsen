<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'faq';
    protected $primaryKey = 'id_faq';
    protected $allowedFields = ['id_faq', 'id_user', 'faq', 'isi_faq'];
}
