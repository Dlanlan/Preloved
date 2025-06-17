<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'total', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getAllWithDetails()
    {
        return $this->db->table('orders o')
            ->select('o.*, p.title as product_title, u.username as buyer_username')
            ->join('products p', 'p.id = o.product_id')
            ->join('users u', 'u.id = o.buyer_id') // sesuaikan dengan kolom yang benar
            ->orderBy('o.created_at', 'DESC')
            ->get()->getResultArray();
    }

}
