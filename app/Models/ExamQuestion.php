<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'examination_id',
        'question',
        'options',
        'correct_answer_index',
    ];

    protected $casts = [
        'options' => 'array', // Cast options attribute as array
    ];
    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
