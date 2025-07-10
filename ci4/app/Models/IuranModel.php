<?php
namespace App\Models;

use CodeIgniter\Model;

class IuranModel extends Model
{
    protected $table = 'iuran';
    protected $allowedFields = ['warga_id', 'bulan', 'tahun', 'jumlah', 'tanggal_bayar', 'keterangan'];
}
