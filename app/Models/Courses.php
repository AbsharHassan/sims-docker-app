<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_id';

    protected $fillable = ['course_id', 'course_code', 'course_name' ,'course_description', 'average', 'std_dev'];

    public function coursemarks() {
        return $this->hasMany('App/CourseMarks');
    }

}
