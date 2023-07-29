<?php

namespace App\Repositories;

use App\Interfaces\MinCoursePurchaseAtRegInterface;
use App\Models\Configuration\MinCoursePurchaseAtReg;

class MinCoursePurchaseAtRegRepository implements MinCoursePurchaseAtRegInterface
{
    private $minCoursePurchaseAtReg;

    public function __construct(MinCoursePurchaseAtReg $minCoursePurchaseAtReg)
    {
        $this->minCoursePurchaseAtReg = $minCoursePurchaseAtReg;
    }

    public function getAll()
    {
        return $this->minCoursePurchaseAtReg->all();
    }
    public function getById($id)
    {
        return $this->minCoursePurchaseAtReg->find($id);
    }

    public function create($data)
    {
        return $this->minCoursePurchaseAtReg->create($data);
    }

    public function delete($id)
    {
        return $this->minCoursePurchaseAtReg->destroy($id);
    }

    public function update($id, $data)
    {
        return $this->minCoursePurchaseAtReg->find($id)->update($data);
    }
}
