<?php

namespace App\Interfaces\User;

interface UserTransactionInterface
{
    public function getAll();
    public function getByUserId($userId);
    public function getById($id);
    public function uploadPayment($id, $data);
    public function cancel($id);
    public function getApprovedTransactionUser($userId);
}
