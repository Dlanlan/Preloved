<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'order_id',
        'product_id',
        'size',
        'qty',
        'price',
        'subtotal'
    ];

    // Matikan timestamps karena kolom created_at/updated_at tidak ada
    protected $useTimestamps = false;
}
