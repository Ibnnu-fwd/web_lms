<?php

namespace App\Interfaces;

interface CourseSubChapterInterface
{
    public function getAll($courseChapterId);
    public function getById($id);
    public function store($courseChapterId, $data);
    public function update($courseChapterId, $id, $data);
    public function deleteFile($id);
    public function deleteVideo($id);
}
