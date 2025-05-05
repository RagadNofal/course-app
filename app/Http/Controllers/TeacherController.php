<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return $this->api_response(true, 'Teachers retrieved successfully', $teachers);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'  => 'required|string',
        'email' => 'required|email|unique:teachers',
    ]);

    if ($validator->fails()) {
        return $this->api_response(false, 'Validation error', $validator->errors(), 422);
    }

    $teacher = Teacher::create($validator->validated());
    return $this->api_response(true, 'Teacher created successfully', $teacher, 201);
}

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $data = $teacher;
        return $this->api_response(true, 'Teacher details retrieved successfully', $data);
    }
    

    /**
     * Update the specified resource in storage.
     */
   

public function update(Request $request, Teacher $teacher)
{
    $validator = Validator::make($request->all(), [
        'name'  => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|email|unique:teachers,email,' . $teacher->id,
    ]);

    if ($validator->fails()) {
        return $this->api_response(false, 'Validation error', $validator->errors(), 422);
    }

    $teacher->update($validator->validated());
    return $this->api_response(true, 'Teacher updated successfully', $teacher);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return $this->api_response(true, 'Teacher deleted successfully');
    }

    public function listCourses(Teacher $teacher)
{
    $courses = $teacher->courses;
    return $this->api_response(true, 'Courses taught by teacher retrieved successfully', $courses);
}

    
}
