<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getAll();
    public function getRole();
    public function changeStatus($id, $status);
}
