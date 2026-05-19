<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'email', 'password', 'role'];
    protected $useTimestamps = false;

    /**
     * Authentifie un utilisateur
     */
    public function authenticate($email, $password)
    {
        $user = $this->where('email', $email)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return null;
    }

    /**
     * Crée un nouvel utilisateur
     */
    public function registerUser($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->insert($data);
    }

    /**
     * Récupère un utilisateur par email
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
