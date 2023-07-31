<?php

namespace App\Repositories;

use App\Interfaces\QuizInterface;
use App\Models\Course\Quiz\Quiz;

class QuizRepository implements QuizInterface
{
    private $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    // get all quiz by course chapter id
    public function getAll($courseChapterId)
    {
        return $this->quiz->with(['questions'])->where('course_chapter_id', $courseChapterId)->get();
    }

    public function getById($id)
    {
        return $this->quiz->with(['questions'])->find($id);
    }

    public function store($courseChapterId, $data)
    {
        return $this->quiz->create([
            'course_chapter_id' => $courseChapterId,
            'title'             => $data['title'],
            'description'       => $data['description'],
        ]);
    }

    public function update($id, $data)
    {
        return $this->quiz->find($id)->update([
            'title'       => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function destroy($id)
    {
        return $this->quiz->find($id)->update([
            'is_active' => false,
        ]);
    }

    public function restore($id)
    {
        return $this->quiz->find($id)->update([
            'is_active' => true,
        ]);
    }
}
