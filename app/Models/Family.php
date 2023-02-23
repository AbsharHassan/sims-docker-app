<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';

    protected $fillable = ['student_id', 'father_name', 'mother_name', 'home_phone', 'father_phone', 'mother_phone', 'address', 'number_siblings', 'father_occupation', 'mother_occupation'];

    public function studentData () {
        return $this->belongsTo('App/studentData');
    }
}
