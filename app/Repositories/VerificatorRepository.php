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
        return $this->user->active()->where('is_verificator', true)->get();
    }

    public function getById($id)
    {
        return $this->user->active()->where('id', $id)->first();
    }

    public function store($data)
    {
        return $this->user->where('id', $data->user_id)->update([
            'is_verificator' => true,
        ]);
    }

    public function destroy($id)
    {
        return $this->user->where('id', $id)->update([
            'is_verificator' => false,
        ]);
    }
}
