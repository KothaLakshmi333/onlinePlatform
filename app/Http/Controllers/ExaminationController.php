<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExamQuestion;
use App\Models\Course;
use App\Models\User;
use App\Models\Notification;
use App\Models\ExamResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    //
    public function index($course_id)
    {
        // Fetch the course title
        $course = Course::findOrFail($course_id);

        // Fetch examinations related to the specified course_id
        $examinations = Examination::where('course_id', $course_id)->get();

        return view('examinations.index', compact('examinations', 'course'));
    }
    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('examinations.create', compact('course'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        // Create a new Examination instance
        $examination = new Examination();
        $examination->course_id = $request->course_id;
        $examination->title = $request->title;
        // Add more fields to populate here as needed
        $examination->save();

        // Redirect back to examinations index for the specific course
        return redirect()->route('examinations.index', ['course_id' => $request->course_id])
                         ->with('success', 'Examination created successfully.');
    }
    public function submit(Request $request, $examinationId)
    {
    $examination = Examination::find($examinationId);
    $courseId = $examination->course_id;

    foreach ($request->answers as $questionId => $selectedOption) {
        $question = ExamQuestion::find($questionId);
        $userId = Auth::id();

        // Fetch the authenticated user
        $user = User::find($userId);
    
        ExamResponse::create([
            'user_id' => $userId,
            'examination_id' => $examinationId,
            'course_id' => $courseId,
            'question' => $question->question,
            'options' => json_encode($question->options),
            'selected_option' => $selectedOption,
            'correct_answer_index' => $question->correct_answer_index,
        ]);
    }
    // Create a notification for the course creator
    $courseCreatorId = $examination->course->user_id;
    
    Notification::create([
        'user_id' =>  $userId,
        'create_id'=> $courseCreatorId,
        'course_id' => $examination->course_id,
        'examination_id' => $examinationId,
        'message' => 'User ' . $user->email . ' has submitted answers to this examination: ',
    ]);
    $course = Course::find($courseId);
    return redirect()->back()->with('success', 'Answers submitted successfully.');
}
}
