<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'rol'];
    public function checkUser($user, $pass)
    {
        return $this->where(['username' => $user, 'password' => $pass])->find();
    }
    public function getById($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}