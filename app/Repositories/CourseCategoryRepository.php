<?php

namespace App\Repositories;

use App\Interfaces\CourseCategoryInterface;
use App\Models\Course\CourseCategory;

class CourseCategoryRepository implements CourseCategoryInterface
{
    private $courseCategory;

    public function __construct(CourseCategory $courseCategory)
    {
        $this->courseCategory = $courseCategory;
    }

    public function getAll()
    {
        return $this->courseCategory->all();
    }

    public function getById($id)
    {
        return $this->courseCategory->find($id);
    }

    public function create($data)
    {
        return $this->courseCategory->create($data);
    }

    public function delete($id)
    {
        return $this->courseCategory->destroy($id);
    }

    public function update($id, $data)
    {
        return $this->courseCategory->find($id)->update($data);
    }
}
