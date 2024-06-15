<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'create_id',
        'course_id',
        'examination_id',
        'message',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
