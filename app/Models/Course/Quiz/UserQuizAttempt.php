<?php

namespace App\Models\Course\Quiz;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuizAttempt extends Model
{
    use HasFactory;

    public $table = 'user_quiz_attempts';
    protected $fillable = [
        'quiz_id',
        'user_id',
        'count_correct',
        'count_incorrect',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
