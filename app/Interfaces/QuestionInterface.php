<?php

namespace App\Interfaces;

interface QuestionInterface
{
    public function getAll($quizId);
    public function getById($id);
    public function store($quizId, $data);
    public function update($id, $data);
    public function destroy($id);
}
