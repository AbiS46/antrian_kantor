<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'role'];

    // Mengambil user berdasarkan username
    public function getUser($username)
    {
        return $this->where('username', $username)->first();
    }

    // Mengambil role user berdasarkan ID
    public function getUserRole($userId)
    {
        $user = $this->where('id', $userId)->first();
        return $user ? $user['role'] : 'Guest';
    }
}

