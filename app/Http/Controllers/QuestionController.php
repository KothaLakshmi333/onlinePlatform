<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index(Quiz $quiz)
    {
        // Load questions related to the quiz
        $questions = $quiz->questions()->get();

        return view('questions.index', [
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }
    public function create(Quiz $quiz)
    {
        return view('questions.create', [
            'quiz' => $quiz,
        ]);
    }

    public function store(Request $request, Quiz $quiz)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'question' => 'required|string',
            'options' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        // Create the question
        $question = new Question();
        $question->quiz_id = $quiz->id;
        $question->question = $validatedData['question'];
        $question->options = json_encode(explode(',', $validatedData['options'])); // Convert options to JSON array
        $question->correct_answer = $validatedData['correct_answer'];
        $question->save();

        // Optionally, you can return a response or redirect back
        return redirect()->route('questions.index', ['quiz' => $quiz->id])
                         ->with('success', 'Question added successfully.');
    }
}
