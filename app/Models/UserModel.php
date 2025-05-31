<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['username', 'password', 'role', 'created_at', 'updated_at'];

    // Timestamp auto-fill
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules (optional but good to have)
    protected $validationRules = [
        'username' => 'required|min_length[3]|is_unique[users.username]',
        'password' => 'required|min_length[6]',
        'role' => 'required|in_list[penjual,pembeli]',
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username wajib diisi.',
            'min_length' => 'Username minimal 3 karakter.',
            'is_unique' => 'Username sudah terdaftar.'
        ],
        'password' => [
            'required' => 'Password wajib diisi.',
            'min_length' => 'Password minimal 6 karakter.'
        ],
        'role' => [
            'required' => 'Role wajib dipilih.',
            'in_list' => 'Role harus penjual atau pembeli.'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}
