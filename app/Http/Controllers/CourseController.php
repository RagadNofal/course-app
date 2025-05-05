<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('teacher')->get();
        return $this->api_response(true, 'Courses retrieved successfully', $courses);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'teacher_id'  => 'required|exists:teachers,id',
    ]);

    if ($validator->fails()) {
        return $this->api_response(false, 'Validation error', $validator->errors(), 422);
    }

    $course = Course::create($validator->validated());
    return $this->api_response(true, 'Course created successfully', $course, 201);
}

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $data = $course->load('teacher', 'students');
        return $this->api_response(true, 'Course details retrieved successfully', $data);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
{
    $validator = Validator::make($request->all(), [
        'title'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'teacher_id'  => 'sometimes|required|exists:teachers,id',
    ]);

    if ($validator->fails()) {
        return $this->api_response(false, 'Validation error', $validator->errors(), 422);
    }

    $course->update($validator->validated());
    return $this->api_response(true, 'Course updated successfully', $course);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return $this->api_response(true, 'Course deleted successfully');
    }

    public function enrollStudent(Request $request, Course $course)
{
    $validator = Validator::make($request->all(), [
        'student_id' => 'required|exists:students,id',
    ]);

    if ($validator->fails()) {
        return $this->api_response(false, 'Validation error', $validator->errors(), 422);
    }

    $course->students()->syncWithoutDetaching($request->student_id);
    return $this->api_response(true, 'Student enrolled successfully');
}

public function listStudents(Course $course)
{
    $students = $course->students;
    return $this->api_response(true, 'Enrolled students retrieved successfully', $students);
}
// public function listStudents(Course $course)
// {
//     $data = [
//         'course_name' => $course->title,
//         'students' => $course->students
//     ];

//     return $this->api_response(true, 'Enrolled students retrieved successfully', $data);
// }
    
}
