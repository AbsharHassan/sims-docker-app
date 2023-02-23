<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Academics extends Model
{
    use HasFactory;

    protected $primaryKey = 'academic_id';

    protected $fillable = ['student_id', 'semester', 'subject_1', 'subject_2', 'subject_3', 'subject_4', 'subject_5', 'subject_6', 'subject_7', 'subject_8', 'subject_9', 'subject_10', 'subj_credit_1', 'subj_credit_2', 'subj_credit_3', 'subj_credit_4', 'subj_credit_5', 'subj_credit_6', 'subj_credit_7', 'subj_credit_8', 'subj_credit_9', 'subj_credit_10', 'subj_grade_1', 'subj_grade_2', 'subj_grade_3', 'subj_grade_4', 'subj_grade_5', 'subj_grade_6', 'subj_grade_7', 'subj_grade_8', 'subj_grade_9', 'subj_grade_10', 'total_grade_points', 'total_grade_points', 'sgpa', 'cgpa', 'subject_1_id', 'subject_2_id', 'subject_3_id', 'subject_4_id', 'subject_5_id', 'subject_6_id', 'subject_7_id', 'subject_8_id', 'subject_9_id', 'subject_10_id'];

    public function studentData () {
        return $this->belongsTo('App/studentData');
    }

    protected static function boot() {
        parent::boot();

        self::creating(function ($model) {
            $model->total_credit_hours = $model->subj_credit_1 + $model->subj_credit_2 + $model->subj_credit_3 + $model->subj_credit_4 + $model->subj_credit_5 + $model->subj_credit_6 + $model->subj_credit_7 + $model->subj_credit_8 + $model->subj_credit_9 + $model->subj_credit_10;
            $model->total_grade_points = (($model->subj_credit_1)*($model->subj_grade_1)) + (($model->subj_credit_2)*($model->subj_grade_2)) + (($model->subj_credit_3)*($model->subj_grade_3)) + (($model->subj_credit_4)*($model->subj_grade_4)) + (($model->subj_credit_5)*($model->subj_grade_5)) + (($model->subj_credit_6)*($model->subj_grade_6)) + (($model->subj_credit_7)*($model->subj_grade_7)) + (($model->subj_credit_8)*($model->subj_grade_8)) + (($model->subj_credit_9)*($model->subj_grade_9)) + (($model->subj_credit_10)*($model->subj_grade_10));
            if($model->total_credit_hours) {
                $model->sgpa = ($model->total_grade_points/$model->total_credit_hours);
            } else {
                $model->sgpa = 0;
            }
        });

        self::updating(function ($model) {
            $model->total_credit_hours = $model->subj_credit_1 + $model->subj_credit_2 + $model->subj_credit_3 + $model->subj_credit_4 + $model->subj_credit_5 + $model->subj_credit_6 + $model->subj_credit_7 + $model->subj_credit_8 + $model->subj_credit_9 + $model->subj_credit_10;
            $model->total_grade_points = (($model->subj_credit_1)*($model->subj_grade_1)) + (($model->subj_credit_2)*($model->subj_grade_2)) + (($model->subj_credit_3)*($model->subj_grade_3)) + (($model->subj_credit_4)*($model->subj_grade_4)) + (($model->subj_credit_5)*($model->subj_grade_5)) + (($model->subj_credit_6)*($model->subj_grade_6)) + (($model->subj_credit_7)*($model->subj_grade_7)) + (($model->subj_credit_8)*($model->subj_grade_8)) + (($model->subj_credit_9)*($model->subj_grade_9)) + (($model->subj_credit_10)*($model->subj_grade_10));
            if($model->total_credit_hours) {
                $model->sgpa = ($model->total_grade_points/$model->total_credit_hours);
            } else {
                $model->sgpa = 0;
            }
        });
    }

    public function setSubjGrade1Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_1'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_1'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_1'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_1'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_1'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_1'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_1'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_1'] = 0.0;
        }
    }

    // public function getSubjGrade1Attribute($value) {
    //     if ($value == 4.0) {
    //         return $value = 'A';
    //     } elseif ($value == 3.5) {
    //         return $value = 'B+';
    //     } elseif ($value ==='B') {
    //         $this->attributes['subj_grade_1'] = 3.0;
    //     } elseif ($value ==='C+') {
    //         $this->attributes['subj_grade_1'] = 2.5;
    //     } elseif ($value ==='C') {
    //         $this->attributes['subj_grade_1'] = 2.0;
    //     } elseif ($value ==='D+') {
    //         $this->attributes['subj_grade_1'] = 1.5;
    //     } elseif ($value ==='D') {
    //         $this->attributes['subj_grade_1'] = 1.0;
    //     } elseif ($value ==='F') {
    //         $this->attributes['subj_grade_1'] = 0.0;
    //     }
    // }

    protected function SubjGrade1(): Attribute
    {
        return Attribute::make(
            // get: function ($value) {
                // if ($value == 4.0) {
                //     $value = 'A';
                //     // return $value;
                // } elseif ($value == 3.5) {
                //     $value = 'B+';
                //     // return $value;
                // } elseif ($value == 3.0) {
                //     $value = 'B';
                //     // return $value;
                // } elseif ($value == 2.5) {
                //     $value = 'C+';
                //     // return $value;
                // } elseif ($value == 2.0) {
                //     $value = 'C';
                //     // return $value;
                // } elseif ($value == 1.5) {
                //     $value = 'D+';
                //     // return $value;
                // } elseif ($value == 1.0) {
                //     $value = 'D';
                //     // return $value;
                // } elseif ($value == 0.0) {
                //     $value = 'F';
                //     // return $value;
                // }
            //     // return $value; 
            // },
            set: function ($value) {
                if ($value === 'A') {
                    $this->attributes['subj_grade_1'] = 4.0;
                } elseif ($value === 'B+') {
                    $this->attributes['subj_grade_1'] = 3.5;
                } elseif ($value ==='B') {
                    $this->attributes['subj_grade_1'] = 3.0;
                } elseif ($value ==='C+') {
                    $this->attributes['subj_grade_1'] = 2.5;
                } elseif ($value ==='C') {
                    $this->attributes['subj_grade_1'] = 2.0;
                } elseif ($value ==='D+') {
                    $this->attributes['subj_grade_1'] = 1.5;
                } elseif ($value ==='D') {
                    $this->attributes['subj_grade_1'] = 1.0;
                } elseif ($value ==='F') {
                    $this->attributes['subj_grade_1'] = 0.0;
                }
            },
        );
    }

    public function setSubjGrade2Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_2'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_2'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_2'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_2'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_2'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_2'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_2'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_2'] = 0.0;
        }
    }

    public function setSubjGrade3Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_3'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_3'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_3'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_3'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_3'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_3'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_3'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_3'] = 0.0;
        }
    }

    public function setSubjGrade4Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_4'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_4'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_4'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_4'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_4'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_4'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_4'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_4'] = 0.0;
        }
    }

    public function setSubjGrade5Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_5'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_5'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_5'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_5'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_5'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_5'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_5'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_5'] = 0.0;
        }
    }

    public function setSubjGrade6Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_6'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_6'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_6'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_6'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_6'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_6'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_6'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_6'] = 0.0;
        }
    }

    public function setSubjGrade7Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_7'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_7'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_7'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_7'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_7'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_7'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_7'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_7'] = 0.0;
        }
    }

    public function setSubjGrade8Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_8'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_8'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_8'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_8'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_8'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_8'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_8'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_8'] = 0.0;
        }
    }

    public function setSubjGrade9Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_9'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_9'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_9'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_9'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_9'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_9'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_9'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_9'] = 0.0;
        }
    }

    public function setSubjGrade10Attribute($value) {
        if ($value === 'A') {
            $this->attributes['subj_grade_10'] = 4.0;
        } elseif ($value === 'B+') {
            $this->attributes['subj_grade_10'] = 3.5;
        } elseif ($value ==='B') {
            $this->attributes['subj_grade_10'] = 3.0;
        } elseif ($value ==='C+') {
            $this->attributes['subj_grade_10'] = 2.5;
        } elseif ($value ==='C') {
            $this->attributes['subj_grade_10'] = 2.0;
        } elseif ($value ==='D+') {
            $this->attributes['subj_grade_10'] = 1.5;
        } elseif ($value ==='D') {
            $this->attributes['subj_grade_10'] = 1.0;
        } elseif ($value ==='F') {
            $this->attributes['subj_grade_10'] = 0.0;
        }
    }
}