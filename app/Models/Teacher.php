<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email'];

    public function students(){
        return $this->hasManyThrough(Student::class,Course::class,'course_id','id','id','student_id')->distinct();
        
    }
    public function courses(){
        return $this->hasMany(Course::class);
    }
}
