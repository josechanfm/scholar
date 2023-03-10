<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Year;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Klass;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $year=Year::currentYear();
        $subjects=Subject::where('year_id',$year->id)->get();
        $klasses=Klass::take(2)->get();
        foreach($klasses as $klass){
            foreach($subjects as $subject){
                Course::create([
                    'klass_id'=>$klass->id,
                    'abbr'=>$subject->abbr,
                    'title_zh'=>$subject->title_zh,
                    'title_en'=>$subject->title_en,
                    'stream'=>$subject->stream,
                    'elective'=>$subject->elective,
                    'active'=>$subject->active,
                    'subject_id'=>$subject->id
                ]);
            }
        }
    }
}
