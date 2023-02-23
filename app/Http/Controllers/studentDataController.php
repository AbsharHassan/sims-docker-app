<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Academics;
use App\Models\studentData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class studentDataController extends Controller
{
    public function view()
    {
        return view('layout');
    }

    public function viewSingle($studentData)
    {
        if(studentData::find($studentData) && Family::find($studentData)) {
            return view('layout');
        } else {
            return redirect('/students/create'); //with flash message saying no student w this id so create one
        }
    }

    // show all students
    public function index() 
    {
        $students = studentData::all();

        return studentData::all();

        // return view('layout', [
        //     // 'students' => studentData::latest()->filter(request(['search']))->get()
        //     'students' => studentData::all()
        // ]);
        // return view('layout');

        // return view('layout')->studentData::all();
    }

    // show single student entry
    public function show(studentData $student) 
    {
        // return $student->id;

        $academics = DB::table('academics')
        ->select('*')
        ->where('student_id', '=', $student->id)
        ->get();
        //  dd($academics[2]->semester);

        // foreach ($academics as $entry) {
        //     for($x = 1; $x <= 10; $x++) {
        //         if ($entry->subj_grade_[$x] == 4.0) {
        //             $entry->subj_grade_[$x] = 'A';
        //         } elseif ($entry->subj_grade_[$x] == 3.5) {
        //             $entry->subj_grade_[$x] = 'B+';
        //         } elseif ($entry->subj_grade_[$x] == 3.0) {
        //             $entry->subj_grade_[$x] = 'B';
        //         } elseif ($entry->subj_grade_[$x] == 2.5) {
        //             $entry->subj_grade_[$x] = 'C+';
        //         } elseif ($entry->subj_grade_[$x] == 2.0) {
        //             $entry->subj_grade_[$x]= 'C';
        //         } elseif ($entry->subj_grade_[$x] == 1.5) {
        //             $entry->subj_grade_[$x] = 'D+';
        //         } elseif ($entry->subj_grade_[$x] == 1.0) {
        //             $entry->subj_grade_[$x] = 'D';
        //         } elseif ($entry->subj_grade_[$x] == 0.0) {
        //             $entry->subj_grade_[$x] = 'F';
        //         }
        //     }
        // }

        // dd($academics[0]);
        
        $count = DB::table('families')
        ->select('*')
        ->where('student_id', '=', $student->id)
        ->count();

        if($count) {
            $family = DB::table('families')
            ->select('*')
            ->where('student_id', '=', $student->id)
            ->get()
            ->first();
        } else {
            return 0;
        }
        
        // return ($family);
        
        return ([
            'student' => $student,
            'family' => $family,
            'academics' => $academics,
        ]);
    }

    // show create entry form
    public function create() 
    {
        return view('layout');
    }

    // store to database
    public function store(Request $request) 
    {
        if(!studentData::find($request->id)) {
            $formFields = $request->validate([
                'id' => ['required', 'unique:student_data'],
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => ['required', 'date_format:Y-m-d'],
                'joining_date' => ['required', 'date_format:Y-m-d'],
                'reg_no' => 'numeric',
                'phone_number' => 'required',
                'gender' => 'required',
                'fsc_marks' => ['required', 'numeric', 'lte:1100'],
                'fsc_year' => ['required'],
                'fsc_div' => ['required', 'gte:1', 'lte:3'],
                'matric_marks' => ['required', 'numeric', 'lte:1100'],
                'matric_year' => ['required'],
                'matric_div' => ['required', 'gte:1', 'lte:3'],
                'current_sem' => ['required', 'numeric', 'gte:1','lte:8'],
                'department' => 'required',
                'degree' => ['required', 'numeric', 'gte:40', 'lte:44'],
                'syn' => 'required',
                'reason' => 'nullable',
                'img' => 'nullable'
            ]);
    
            // if($request->hasFile('img')) {
            //     $formFields['img'] = $request->file('img')->store('portraits', 'public');
            // }
    
            studentData::create($formFields);
            
            // return redirect('/')->with('message', 'Entry Added Succesfully');
            // return redirect('/students/{studentData}/family/create');
        } else {
            // return redirect('/students/{studentData}/family/create');
        }
        
    }
    

    // show edit form 
    public function edit(studentData $student) 
    {
        return view('students.edit', ['student' => $student]);
    }

    // update the database
    public function update(Request $request, studentData $student) 
    {
        $json_data = DB::table('student_data')
        ->select(DB::raw('img AS picturePath'))
        ->where('id', '=', $student->id)
        ->get();

        // $old_student = studentData::find($re)

        $oldPicturePath = json_decode($json_data, true)[0]['picturePath']; 

        // dd($oldPicturePath);

        $formFields = $request->validate([
            'id' => ['required', Rule::unique('student_data')->ignore($student->id),],
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => ['required', 'date_format:Y-m-d'],
            'joining_date' => ['required', 'date_format:Y-m-d'],
            'phone_number' => 'required',
            'gender' => 'required',
            'fsc_marks' => ['required', 'numeric', 'lte:1100'],
            'fsc_year' => ['required'],
            'fsc_div' => ['required', 'gte:1', 'lte:3'],
            'matric_marks' => ['required', 'numeric', 'lte:1100'],
            'matric_year' => ['required'],
            'matric_div' => ['required', 'gte:1', 'lte:3'],
            'current_sem' => ['required', 'numeric', 'gte:1','lte:8'],
            'department' => 'required',
            'degree' => ['required', 'numeric', 'gte:40', 'lte:44'],
            'syn' => 'required',
            'reason' => 'nullable',
            'img' => 'nullable'
        ]);

        $formFields['img'] = $oldPicturePath;

        $student->update($formFields);
        
        return response([
            'message' => 'Student details updated successfully'
        ], 200);
    }

    // delete the entry
    public function destroy(studentData $student) 
    {
        $student->delete();
        
        return response([
            'message' => 'Entry deleted successfully.'
        ], 200);
        // return redirect('/')->with('message', 'Entry Deleted Succesfully');
    }
}