<?php
namespace Models\User;

use Models\Database\Database;

class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}

