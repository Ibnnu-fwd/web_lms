<?php

namespace App\Repositories;

use App\Interfaces\QuizInterface;
use App\Models\Course\Quiz\Quiz;
use App\Models\Course\Quiz\UserQuizAttempt;

class QuizRepository implements QuizInterface
{
    private $quiz;
    private $userQuizAttempt;

    public function __construct(Quiz $quiz, UserQuizAttempt $userQuizAttempt)
    {
        $this->quiz = $quiz;
        $this->userQuizAttempt = $userQuizAttempt;
    }

    // get all quiz by course chapter id
    public function getAll($courseChapterId)
    {
        $quizess = $this->quiz->with(['questions'])->where('course_chapter_id', $courseChapterId)->get();
        foreach ($quizess as $quiz) {
            $quiz->user_quiz_attempt = $this->userQuizAttempt->where('quiz_id', $quiz->id)->where('user_id', auth()->id())->first();
        }

        return $quizess;
    }

    public function getById($id)
    {
        return $this->quiz->with(['questions', 'courseChapter'])->find($id);
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

    public function isCompleted($id)
    {
        return UserQuizAttempt::where('quiz_id', $id)->where('user_id', auth()->id())->first() ? true : false;
    }

    public function checkAnswer($id, $answer)
    {
        $questions = $this->quiz->find($id)->questions;
        $correct = 0;
        foreach ($questions as $key => $value) {
            if (strtolower($value->answer) == $answer[$key]['option']) {
                $correct++;
            }
        }

        return $correct == count($questions) ? true : false;
    }

    public function getUserQuizAttempt($id)
    {
        $userQuizAttempt = $this->userQuizAttempt->where('quiz_id', $id)->where('user_id', auth()->id())->first();
        $questions = $this->quiz->find($id)->questions;

        if (!$userQuizAttempt) {
            $userQuizAttempt = $this->userQuizAttempt->create([
                'user_id'         => auth()->id(),
                'quiz_id'         => $id,
                'count_correct'   => $questions->count(),
                'count_incorrect' => 0,
            ]);

            return $userQuizAttempt;
        }

        return $userQuizAttempt;
    }
}
