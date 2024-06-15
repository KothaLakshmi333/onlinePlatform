<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examination;
use App\Models\ExamQuestion;

class ExamQuestionController extends Controller
{
    //
    public function index($examination_id)
    {
        $examination = Examination::findOrFail($examination_id);
        $questions = ExamQuestion::where('examination_id', $examination_id)->get();

        return view('examquestions.index', compact('examination', 'questions'));
    }
    public function create($examination_id)
    {
        $examination = Examination::findOrFail($examination_id);
        return view('examquestions.create', compact('examination'));
    }
    public function store(Request $request, $examination_id)
    {
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array',
            'correct_answer_index' => 'required|integer|min:0|max:' . (count($request->options) - 1),
        ]);

        $examQuestion = new ExamQuestion();
        $examQuestion->examination_id = $examination_id;
        $examQuestion->question = $request->question;
        $examQuestion->options = json_encode($request->options);
        $examQuestion->correct_answer_index = $request->correct_answer_index;
        $examQuestion->save();

        $examination = Examination::findOrFail($examination_id);
        $questions = $examination->questions;
    
        return view('examquestions.index', compact('examination', 'questions'))->with('success', 'Question added successfully!');    }

}
