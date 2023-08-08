<?php

namespace App\Interfaces\User;

interface UserTransactionInterface
{
    public function getAll();
    public function getByUserId($userId);
}
