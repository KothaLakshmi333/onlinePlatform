<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', ['courses' => $courses]);
    }
    public function add()
    {
        return view('courses.add');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string', // Validate description as string
            'metadata' => 'nullable|string', // Validate metadata as string
            'multimedia_links' => 'required|string', // Validate each multimedia_link as a URL
        ]);
    
         // Retrieve the authenticated user's ID
    $userId = Auth::id();

    // Create a new Course instance and fill it with validated data
    $course = new Course();
    $course->fill($validatedData);
    $course->user_id = $userId; // Assign the authenticated user's ID
    $course->save();
    return Redirect::route('courses.index')->with('success', 'Course added successfully.');
    }
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'metadata' => 'nullable|string',
            'multimedia_links' => 'nullable|string',
        ]);

        $course->update($validatedData);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }
    public function destroy(Request $request, Course $course)
    {

     // Delete the course
     $course->delete();


     return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
    public function search($id)
    {
       

        $course = Course::findOrFail($id);
    
        return view('courses.search', compact('course'));
    
    }
    public function show(Course $course)
    {
        $course->load('quizzes.questions'); // Load quizzes and their questions
        return view('courses.show', compact('course'));
    }
}
