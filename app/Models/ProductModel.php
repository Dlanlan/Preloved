<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'title',
        'description',
        'photo',
        'price',
        'product_condition',
        'status',
        'category_id'
    ];
    protected $useTimestamps = true;

    /**
     * Ambil semua produk dengan username penjual
     */
    public function getAllWithSeller()
    {
        return $this->select('products.*, users.username as seller_username')
            ->join('users', 'users.id = products.user_id')
            ->orderBy('products.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Ambil semua produk beserta nama kategori
     */
    public function getAllWithCategory()
    {
        return $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->orderBy('products.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Ambil satu produk berdasarkan ID dengan nama kategori
     */
    public function getByIdWithCategory($id)
    {
        return $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->where('products.id', $id)
            ->first();
    }
}
