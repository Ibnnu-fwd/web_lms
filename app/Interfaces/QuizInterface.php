<?php

namespace App\Interfaces;

interface QuizInterface
{
    public function getAll($courseChapterId);
    public function getById($id);
    public function store($courseChapterId, $data);
    public function update($id, $data);
    public function destroy($id);
    public function restore($id);

    public function isCompleted($id);
    public function checkAnswer($id, $answer);
    public function getUserQuizAttempt($id);
}
