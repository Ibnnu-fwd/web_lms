<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->active()->get();
    }
}