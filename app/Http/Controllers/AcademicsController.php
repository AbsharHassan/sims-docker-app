<?php

namespace App\Http\Controllers;

use App\Models\Academics;
use App\Models\Family;
use App\Models\studentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicsController extends Controller
{
    public function show($id)
    {
        //
    }

    // show the create form
    public function create()
    {
        return view('layout');
    }

    public function createVerify($studentData)
    {
        if(Family::find($studentData)) {
            $count = DB::table('academics')
            ->select('*')
            ->where('student_id', '=', $studentData)
            ->count();

            if($count > 0) {
                return [
                    'canProceed' => false,
                    'redirectToMain' => false,
                    'redirectToDashboard' => true, 
                    'message' => 'Academic Information of this student has already been entered. Create a new entry or edit the existing entry'
                ];
            } else {
                return [
                    'canProceed' => true,
                    'redirectToDashboard' => false,
                ];
            }
        } else {
            if(studentData::find($studentData)) {
                return [
                    'canProceed' => false,
                    'redirectToMain' => false,
                    'redirectToDashboard' => false, 
                    'message' => 'Please enter the required family information first'
                ];
            } else {
                return [
                    'canProceed' => false,
                    'redirectToMain' => true,
                    'redirectToDashboard' => false, 
                    'message' => 'Please create a student entry first'
                ];
            }
        }
    }

    // store to database
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'student_id' => ['required', 'numeric'],
            'semester' => ['required', 'numeric', 'gte:1','lte:8'],
            'subject_1' => 'nullable',
            'subject_2' => 'nullable',
            'subject_3' => 'nullable',
            'subject_4' => 'nullable',
            'subject_5' => 'nullable',
            'subject_6' => 'nullable',
            'subject_7' => 'nullable',
            'subject_8' => 'nullable',
            'subject_9' => 'nullable',
            'subject_10' => 'nullable',
            'subject_1_id' => 'nullable',
            'subject_2_id' => 'nullable',
            'subject_3_id' => 'nullable',
            'subject_4_id' => 'nullable',
            'subject_5_id' => 'nullable',
            'subject_6_id' => 'nullable',
            'subject_7_id' => 'nullable',
            'subject_8_id' => 'nullable',
            'subject_9_id' => 'nullable',
            'subject_10_id' => 'nullable',
            'subj_credit_1' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_2' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_3' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_4' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_5' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_6' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_7' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_8' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_9' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_10' => ['nullable', 'gt:0', 'lte:6'],
            'subj_grade_1' => 'nullable',
            'subj_grade_2' => 'nullable',
            'subj_grade_3' => 'nullable',
            'subj_grade_3' => 'nullable',  
            'subj_grade_4' => 'nullable',
            'subj_grade_5' => 'nullable',
            'subj_grade_6' => 'nullable',
            'subj_grade_7' => 'nullable',
            'subj_grade_8' => 'nullable',
            'subj_grade_9' => 'nullable',
            'subj_grade_10' => 'nullable'
        ]);
        
        $academics = Academics::create($formFields);

        // $json_data = DB::table('academics')
        // ->select(DB::raw('SUM(total_grade_points) AS total_grade_points, SUM(total_credit_hours) AS total_credit_hours'))
        // ->where('students_id', '=', $request->students_id)
        // ->groupBy('students_id')
        // ->get();
        
        // $data = json_decode($json_data, true)[0];

        AcademicsController::CGPA($request, $academics);

        // Academics::updating([
        //     'cgpa' => ($data['total_grade_points'])/($data['total_credit_hours'])
        // ]);
        

        // Academics::create($formFields + ['cgpa' => ($data['total_grade_points'])/($data['total_credit_hours'])]);
    }
    
    // update the database
    public function update(Request $request, Academics $academics)
    {
        // dd($request);

        // dd($academics->academic_id);

        $formFields['academic_id'] = $request->academic_id;

        $formFields = $request->validate([
            'academic_id' => ['required'],
            'student_id' => ['required', 'numeric'],
            'semester' => ['required', 'numeric', 'gte:1','lte:8'],
            'subject_1' => 'nullable',
            'subject_2' => 'nullable',
            'subject_3' => 'nullable',
            'subject_4' => 'nullable',
            'subject_5' => 'nullable',
            'subject_6' => 'nullable',
            'subject_7' => 'nullable',
            'subject_8' => 'nullable',
            'subject_9' => 'nullable',
            'subject_10' => 'nullable',
            'subject_1_id' => 'nullable',
            'subject_2_id' => 'nullable',
            'subject_3_id' => 'nullable',
            'subject_4_id' => 'nullable',
            'subject_5_id' => 'nullable',
            'subject_6_id' => 'nullable',
            'subject_7_id' => 'nullable',
            'subject_8_id' => 'nullable',
            'subject_9_id' => 'nullable',
            'subject_10_id' => 'nullable',
            'subj_credit_1' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_2' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_3' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_4' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_5' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_6' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_7' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_8' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_9' => ['nullable', 'gt:0', 'lte:6'],
            'subj_credit_10' => ['nullable', 'gt:0', 'lte:6'],
            'subj_grade_1' => 'nullable',
            'subj_grade_2' => 'nullable',
            'subj_grade_3' => 'nullable',
            'subj_grade_3' => 'nullable',
            'subj_grade_4' => 'nullable',
            'subj_grade_5' => 'nullable',
            'subj_grade_6' => 'nullable',
            'subj_grade_7' => 'nullable',
            'subj_grade_8' => 'nullable',
            'subj_grade_9' => 'nullable',
            'subj_grade_10' => 'nullable'
        ]);

        // dd($formFields['academic_id']);

        $academics->update($formFields);

        // dd(Academics::find(1));

        // dd($academics);

        // $a = Academics::get();
        // $b = $a->where('semester', '=', $academics->semester)->where('students_id', '=', $academics->students_id)->first();
        // dd($b);

        // $data = json_decode($b, true);
        // dd($data);
        // dd($a[0]);
        
        $count = DB::table('academics')
        ->select('*')
        ->where('student_id', '=', $request->student_id)
        ->count();
        // dd($count);
        // $count = $count - ($academics->semester - 1);
        $semester_count = $request->semester;
        $startingSemester = $request->semester;
        // dd($semester_count);
        // $dummy = $academics;
        // $dummy->semester = $dummy->semester + 1;
        // dd($request->student_id);

        for($i=$startingSemester; $i<=$count; $i++){
            $dummy = Academics::get()->where('semester', '=', $i)->where('student_id', '=', $request->student_id)->first();
            // dd($dummy);
            AcademicsController::CGPA($request, $dummy);
            // $semester_count = $semester_count + 1;
        }

        // foreach ($academics as $entry => $value) {
        //     $var1 = $var1 + 1;
        //     AcademicsController::CGPA($request, $academics);
        // }

        // return $var1;

        // AcademicsController::CGPA($request, $academics);

        // $json_data = DB::table('academics')
        // ->select(DB::raw('SUM(total_grade_points) AS total_grade_points, SUM(total_credit_hours) AS total_credit_hours'))
        // ->where('students_id', '=', $request->students_id)
        // ->groupBy('students_id')
        // ->get();

        // $data = json_decode($json_data, true)[0];

        // $academics->update([
        //     'cgpa' => ($data['total_grade_points'])/($data['total_credit_hours'])
        // ]);

        return response([
            'message' => 'Semester details have been updated successfully'
        ], 200);
    }

    // delete the entry
    public function destroy(Request $request, Academics $academics)
    {
        $academics->delete();
        
        $count = DB::table('academics')
        ->select('*')
        ->where('student_id', '=', $request->student_id)
        ->count();
        $count = $count - ($academics->semester - 1);
        // dd($count);
        $semester_count = $request->semester;
        // dd($semester_count);
        // $dummy = $academics;
        // $dummy->semester = $dummy->semester + 1;

        for($i=1; $i<=$count; $i++){
            $dummy = Academics::get()->where('semester', '=', $semester_count)->where('student_id', '=', $academics->student_id)->first();
            // dd($dummy);
            AcademicsController::CGPA($request, $dummy);
            $semester_count = $semester_count + 1;
        }
    }
    
    public function CGPA(Request $request, Academics $academics) 
    {
        $json_data = DB::table('academics')
        ->select(DB::raw('SUM(total_grade_points) AS total_grade_points, SUM(total_credit_hours) AS total_credit_hours'))
        ->where('student_id', '=', $request->student_id)
        ->where('semester', '<=', $academics->semester)
        ->groupBy('student_id')
        ->get();

        // dd($json_data);

        $data = json_decode($json_data, true)[0];
        // dd($data);

        if($data['total_credit_hours'] != 0) {
            $academics->update(['cgpa' => ($data['total_grade_points'])/($data['total_credit_hours'])]);
        } else {
            $academics->update(['cgpa' => 0.0]);
        }
    }
}
