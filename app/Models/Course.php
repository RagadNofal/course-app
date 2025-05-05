<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'teacher_id'];
    use HasFactory;
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class, 'enrollments');
    }
}
