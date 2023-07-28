<?php

namespace App\Interfaces;

interface CourseCategoryInterface
{
    public function getAll();
    public function create($data);
    public function delete($id);
}
