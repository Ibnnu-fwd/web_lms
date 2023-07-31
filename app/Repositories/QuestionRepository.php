<?php

namespace App\Repositories;

use App\Interfaces\QuestionInterface;
use App\Models\Course\Quiz\Question;

class QuestionRepository implements QuestionInterface
{
    private $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function getAll($quizId)
    {
        return $this->question->where('quiz_id', $quizId)->with('quiz')->get();
    }

    public function getById($id)
    {
        return $this->question->with('quiz')->find($id);
    }

    public function store($quizId, $data)
    {
        return $this->question->create([
            'quiz_id'  => $quizId,
            'question' => $data['question'],
            'option_a' => $data['option_a'],
            'option_b' => $data['option_b'],
            'option_c' => isset($data['option_c']) ? $data['option_c'] : null,
            'option_d' => isset($data['option_d']) ? $data['option_d'] : null,
            'answer'   => $data['answer'],
        ]);
    }

    public function update($id, $data)
    {
        return $this->question->find($id)->update([
            'question' => $data['question'],
            'option_a' => $data['option_a'],
            'option_b' => $data['option_b'],
            'option_c' => $data['option_c'] ?? null,
            'option_d' => $data['option_d'] ?? null,
            'answer'   => $data['answer'],
        ]);
    }

    public function destroy($id)
    {
        return $this->question->find($id)->delete();
    }
}
