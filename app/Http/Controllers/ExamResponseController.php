<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\ExamResponse;

class ExamResponseController extends Controller
{
    //
    public function show(Notification $notification)
    {
        $userId = $notification->user_id;
        $examinationId = $notification->examination_id;
        $courseId = $notification->course_id;

        // Fetch exam responses based on user_id, examination_id, and course_id
        $examResponses = ExamResponse::where([
            'user_id' => $userId,
            'examination_id' => $examinationId,
            'course_id' => $courseId,
        ])->get();

        return view('notifications.show', compact('examResponses'));
    }
}
