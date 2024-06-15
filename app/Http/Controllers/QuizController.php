<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function index(Course $course)
    {
        $quizzes = $course->quizzes; // Assuming you have a relationship set up in the Course model

        return view('quizzes.index', compact('course', 'quizzes'));
    }
    public function create(Course $course)
    {
        return view('quizzes.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $quiz = new Quiz();
        $quiz->course_id = $course->id;
        $quiz->title = $request->title;
        $quiz->save();

    }
    public function showQuestions(Quiz $quiz)
    {
        $quiz->load('questions'); // Eager load questions

        return view('quizzes.questions.index', compact('quiz'));
    }
}
