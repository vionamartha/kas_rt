<?php 

namespace App\Models;

use CodeIgniter\Model;

class PermohonanModel extends Model
{
    protected $table = 'permohonan_kas'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['nama_permohonan', 'jumlah_kas', 'status', 'tanggal_permohonan', 'keterangan', 'warga_id']; 
    
    public function getWarga() {
        return $this->db->table('warga')
                        ->select('id, nama')
                        ->get()
                        ->getResultArray();
    }
}
