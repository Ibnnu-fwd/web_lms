<?php

namespace App\Interfaces;

interface VerificatorInterface
{
    public function getAll();
    public function getById($id);
    public function store($data);
    public function destroy($id);
}
