<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function klass(){
        return $this->belongsTo(Klass::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }

    public function students(){
        return $this->belongsToMany(Student::class,'klass_students','klass_id','student_id')->withPivot(['id as pivot_klass_student_id','student_number','stream','state','promote','promote_to']);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public static function gather_scores($courseId){
        $students=Course::find($courseId)->students;
        foreach($students as $student){
            $student->scores=Score::where('klass_student_id',$student->pivot->klass_student_id)->get();
        }
        return $students;
    }
}
