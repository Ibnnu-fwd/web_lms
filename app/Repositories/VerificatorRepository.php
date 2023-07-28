<?php

namespace App\Repositories;

use App\Interfaces\VerificatorInterface;
use App\Models\User;

class VerificatorRepository implements VerificatorInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->active()->where('role', User::ROLE_VERIFICATOR)->get();
    }
}