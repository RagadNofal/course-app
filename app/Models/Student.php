<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'email'];

    public function teacher(){
        return $this->hasManyThrough(Teacher::class,Course::class,'id','id','id','teacher_id')->distinct();
    }//With distinct(), Laravel ensures you only get one copy of each teacher — even if that teacher comes from multiple courses.

    public function courses()   {
        return $this->belongsToMany(Course::class, 'enrollments');
        
    }
}

