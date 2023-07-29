<?php

namespace App\Interfaces;

interface CourseInterface
{
    public function getByUserId($userId);
    public function store($data);
}
