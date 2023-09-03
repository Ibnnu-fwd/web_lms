<?php

namespace App\Interfaces;

interface CourseChapterInterface
{
    public function getAll($courseId);
    public function getById($id);
    public function store($data, $courseId);
    public function update($data, $id);
    public function destroy($id);
    public function restore($id);

    public function getPage($id, $page);
    public function isCompleted($id);
    public function getNextChapterId($id);
}
