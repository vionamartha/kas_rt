<?php
namespace App\Models;

use CodeIgniter\Model;

class WargaModel extends Model
{
    protected $table = 'warga';
    protected $allowedFields = ['nama', 'alamat', 'no_hp', 'status'];
}
