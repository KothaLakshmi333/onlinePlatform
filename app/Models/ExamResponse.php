<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'examination_id',
        'course_id',
        'question',
        'options',
        'selected_option',
        'correct_answer_index',
    ];
    protected $casts = [
        'options' => 'array', // Cast JSON to array
    ];
}
