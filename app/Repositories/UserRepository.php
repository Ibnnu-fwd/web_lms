<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $users = $this->user->all();
        foreach ($users as $user) {
            $user->status = $user->getStatusLabel();
        }

        return $users;
    }

    public function getRole()
    {
        $user = auth()->user();
        if ($user->is_verificator == true) {
            return User::ROLE_VERIFICATOR_LABEL;
        }

        switch ($user->role) {
            case User::ROLE_ADMIN:
                return User::ROLE_ADMIN_LABEL;
                break;
            case User::ROLE_INSTITUTION:
                return User::ROLE_INSTITUTION_LABEL;
                break;
            case User::ROLE_USER:
                return User::ROLE_USER_LABEL;
                break;
            default:
                return 'Unknown';
                break;
        }
    }

    public function changeStatus($id, $status)
    {
        return $this->user->where('id', $id)->update(['status' => $status]);
    }
}
