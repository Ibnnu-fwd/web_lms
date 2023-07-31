<?php

namespace App\Interfaces;

interface CourseInterface
{
    public function getByUserId($userId);
    public function getById($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
    public function restore($id);
    public function getAll();
}
