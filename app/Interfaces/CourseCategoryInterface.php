<?php

namespace App\Interfaces;

interface CourseCategoryInterface
{
    public function getAll();
    public function store($data);
}
