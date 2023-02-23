<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentData extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    
    protected $fillable = ['id', 'first_name', 'last_name', 'dob', 'joining_date', 'reg_no', 'reason', 'fsc_marks', 'fsc_year', 'fsc_div', 'matric_marks', 'matric_year', 'matric_div', 'current_sem', 'phone_number', 'department', 'degree', 'syn', 'img', 'gender'];

    // protected static function boot() {
    //     parent::boot();

    //     self::creating(function($model) {
    //         $model->fsc_marks = ($model->fsc_marks/1100);
    //         $model->matric_marks = ($model->matric_marks/1100);
    //     }); 

    //     self::updating(function($model) {
    //         $model->fsc_marks = ($model->fsc_marks/1100);
    //         $model->matric_marks = ($model->matric_marks/1100);
    //     }); 
    // }

    // protected $dateFormat = 'd/m/Y';

    // protected $casts = [
    //     'created_at' => 'datetime:d/m/Y', // Change your format
    //     'updated_at' => 'datetime:d/m/Y',
    //     'dob' => 'datetime:d/m/Y',
    //     'joining_date' => 'datetime:d/m/Y'
    // ];

    // public function scopeFilter($query, array $filters) {
    //     if ($filters['search'] ?? false) {
    //         $query->where('id', 'like', '%' . request('search') . '%')
    //         ->orWhere('name', 'like', '%' . request('search') . '%')
    //         ->orWhere('CGPA', 'like', '%' . request('search') . '%')
    //         ->orWhere('SGPA', 'like', '%' . request('search') . '%')
    //         ->orWhere('age', 'like', '%' . request('search') . '%')
    //         ->orWhere('FSC', 'like', '%' . request('search') . '%')
    //         ->orWhere('Matric', 'like', '%' . request('search') . '%');
    //     }
    // }

    public function academics() {
        return $this->hasMany('App/Academics');
    }

    public function familyinfos() {
        return $this->hasMany('App/FamilyInfo');
    }
}
