<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function getAll();
    public function getByUserId($userId);
    public function getById($id);
    public function approve($id);
    public function decline($id);
}
