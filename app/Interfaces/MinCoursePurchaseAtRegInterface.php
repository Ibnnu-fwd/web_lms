<?php

namespace App\Interfaces;

interface MinCoursePurchaseAtRegInterface
{
    public function getById($id);
    public function getAll();
    public function create($data);
    public function delete($id);
    public function update($id, $data);
}
