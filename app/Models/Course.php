<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'metadata',
        'multimedia_links',
        'user_id',
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
