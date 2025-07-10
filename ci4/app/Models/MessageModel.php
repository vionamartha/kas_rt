<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sender', 'message', 'status', 'created_at'];
    protected $useTimestamps = false;

    public function getRecentMessages($limit = 5)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->findAll($limit);
    }
}
