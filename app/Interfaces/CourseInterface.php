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
    public function discount($id);

    public function approve($id);
    public function reject($id);
    public function pending($id);
    public function publish($id);
    public function unpublish($id);

    public function getLearnProgress($courseId, $userId);
    public function isLearned($chapterId, $userId);
}
