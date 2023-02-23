<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMarks extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_marks_id'; 

    protected $fillable = ['marks', 'course_id', 'bin1',
    'bin2',
    'bin3',
    'bin4',
    'bin5',
    'bin6',
    'bin7',
    'bin8',
    'bin9',
    'bin10'];

    // protected static function boot() {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         if($model->marks >= 0 && $model->marks <= 10) {
    //             $model->bin1 = $model->marks;
    //         } elseif($model->marks >= 11 && $model->marks <= 20) {
    //             $model->bin2 = $model->marks;
    //         } elseif($model->marks >= 21 && $model->marks <= 31) {
    //             $model->bin3 = $model->marks;
    //         } elseif($model->marks >= 31 && $model->marks <= 40) {
    //             $model->bin4 = $model->marks;
    //         } elseif($model->marks >= 41 && $model->marks <= 50) {
    //             $model->bin5 = $model->marks;
    //         } elseif($model->marks >= 51 && $model->marks <= 60) {
    //             $model->bin6 = $model->marks;
    //         } elseif($model->marks >= 61 && $model->marks <= 70) {
    //             $model->bin7 = $model->marks;
    //         } elseif($model->marks >= 71 && $model->marks <= 80) {
    //             $model->bin8 = $model->marks;
    //         } elseif($model->marks >= 81 && $model->marks <= 90) {
    //             $model->bin9 = $model->marks;
    //         } else {
    //             $model->bin10 = $model->marks;
    //         }
            
            
            
    //         // $model->total_credit_hours = $model->subj_credit_1 + $model->subj_credit_2 + $model->subj_credit_3 + $model->subj_credit_4 + $model->subj_credit_5 + $model->subj_credit_6 + $model->subj_credit_7 + $model->subj_credit_8 + $model->subj_credit_9 + $model->subj_credit_10;
    //         // $model->total_grade_points = (($model->subj_credit_1)*($model->subj_grade_1)) + (($model->subj_credit_2)*($model->subj_grade_2)) + (($model->subj_credit_3)*($model->subj_grade_3)) + (($model->subj_credit_4)*($model->subj_grade_4)) + (($model->subj_credit_5)*($model->subj_grade_5)) + (($model->subj_credit_6)*($model->subj_grade_6)) + (($model->subj_credit_7)*($model->subj_grade_7)) + (($model->subj_credit_8)*($model->subj_grade_8)) + (($model->subj_credit_9)*($model->subj_grade_9)) + (($model->subj_credit_10)*($model->subj_grade_10));
    //         // if($model->total_credit_hours) {
    //         //     $model->sgpa = ($model->total_grade_points/$model->total_credit_hours);
    //         // } else {
    //         //     $model->sgpa = 0;
    //         // }
    //     });
    // }

    public function Courses () {
        return $this->belongsTo('App/Courses');
    }
}
