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
    protected $allowedFields = ['username', 'password', 'role', 'photo', 'created_at', 'updated_at'];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'role' => 'in_list[user,admin]',
        // password dan username divalidasi manual di controller
    ];


    protected $validationMessages = [
        'username' => [
            'required' => 'Username wajib diisi.',
            'min_length' => 'Username minimal 3 karakter.',
            'is_unique' => 'Username sudah terdaftar.',
        ],
        'role' => [
            'in_list' => 'Role tidak valid.',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Hooks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['beforeSave'];
    protected $beforeUpdate = ['beforeSave'];

    /**
     * Auto-hash password sebelum disimpan
     */
    protected function beforeSave(array $data): array
    {
        if (isset($data['data']['password']) && !password_get_info($data['data']['password'])['algo']) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
