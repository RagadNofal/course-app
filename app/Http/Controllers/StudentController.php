<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{
    public function index(){
    $students = Student::all();
    return $this->api_response(true, 'Students retrieved successfully', $students);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'  => 'required|string',
        'email' => 'required|email|unique:students',
    ]);

    if ($validator->fails()) {
        return $this->api_response(false, 'Validation error', $validator->errors(), 422);
    }

    $student = Student::create($validator->validated());
    return $this->api_response(true, 'Student created successfully', $student, 201);
}



public function update(Request $request, Student $student)
{
    $validator = Validator::make($request->all(), [
        'name'  => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
    ]);

    if ($validator->fails()) {
        return $this->api_response(false, 'Validation error', $validator->errors(), 422);
    }

    $student->update($validator->validated());
    return $this->api_response(true, 'Student updated successfully', $student);
}
public function show(Student $student)
{
    $data = $student;
    return $this->api_response(true, 'Student details retrieved successfully', $data);
}
public function destroy(Student $student)
{
    $student->delete();
    return $this->api_response(true, 'Student deleted successfully');
}



}
