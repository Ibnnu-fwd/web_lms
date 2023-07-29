<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseCategoryInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $courseCategory;

    public function __construct(CourseCategoryInterface $courseCategory)
    {
        $this->courseCategory = $courseCategory;
    }

    public function index()
    {
        return view('admin.course.index');
    }

    public function create()
    {
        return view('admin.course.create', [
            'courseCategories' => $this->courseCategory->getAll(),
        ]);
    }
}
