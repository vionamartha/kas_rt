<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertModel extends Model
{
    protected $table = 'alerts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['message', 'status', 'created_at'];
    protected $useTimestamps = false;

    public function getUnreadAlerts($limit = 5)
    {
        return $this->where('status', 'unread')
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit);
    }
}
