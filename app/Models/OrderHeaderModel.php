<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderHeaderModel extends Model
{
    protected $table = 'order_headers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'buyer_id',
        'total_amount',
        'nama_penerima',
        'alamat',
        'telepon',
        'status',
        'created_at'
    ];

    // Matikan otomatisasi timestamps karena created_at diatur manual
    protected $useTimestamps = false;

    // Jika suatu saat ingin menggunakan created_at otomatis, aktifkan baris di bawah ini
    // protected $createdField = 'created_at';
}
