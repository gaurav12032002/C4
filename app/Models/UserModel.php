<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['full_name','email','password','bio','profile_picture','user_id'];
       /**
     * @param false|string $slug
     *
     * @return array|null
     */
    public function getUser($user_id = 0)
    {
        if ($user_id == 0) {
            return [];
        }

        return $this->where(['user_id' => $user_id])->first();
    }
    public function getUserByEmail($email)
    {
        return $this->where(['email' => $email])->first();
    }
}