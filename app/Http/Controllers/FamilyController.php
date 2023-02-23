<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\studentData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // web route to create page 
    public function create() 
    {
        return view('layout');
    }

    // show create entry form
    public function createVerify($studentData) 
    {
        if(studentData::find($studentData)) {
            if(!Family::find($studentData)) {
                return [
                    'canProceed' => true,
                ];
            } else {
                $count = DB::table('academics')
                ->select('*')
                ->where('student_id', '=', $studentData)
                ->count();

                if($count > 0) {
                    return [
                        'canProceed' => false,
                        'redirectTo' => 'dashboard', 
                        'message' => 'This student is already in the system'
                    ];
                } else {
                    return [
                        'canProceed' => false,
                        'redirectTo' => 'academics', 
                        'message' => 'Family data has already been entered for this student'
                    ];
                }
                
                // return redirect("/students/$studentData/academics/create"); //with relevant FLASH message
            }
        } else {
            return [
                'canProceed' => false,
                'redirectTo' => 'base', 
                'message' => 'Please create a student entry first'
            ];
        }
        
        // $minutes = 5;
        // Cookie::queue('allowed', 'yes', $minutes);
        // // return view('layout');
        // if(studentData::find($studentData)) {
        //     return response()->view('layout');
        // } else {
        //     return response()->view('layout');
        // }
        
        
        // if(studentData::find($studentData)) {
        //     return response()->view('layout')->cookie('allowed', 'pain', 60 );
        // } else {
        //     return response()->view('layout')->cookie('allowed', 'hurt', 60 );
        // }
        // if(studentData::find($studentData)) {
        //     return response(view('layout'))->cookie('allowed', false, 60 );
        // } else {
        //     return back();
        // }
        // dd($studentData);
        // return view('layout');
    }
    // public function see(Request $request) 
    // {
    //     $value = $request->cookie('allowed');
    //     echo $value;
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            // 'student_id' => ['required', 'numeric', 'unique:families'],
            // 'father_name' => 'required',
            // 'father_occupation' => 'required',
            // 'mother_name' => 'nullable',
            // 'home_phone' => 'nullable',
            // 'father_phone' => 'nullable',
            // 'mother_phone' => 'nullable',
            // 'address' => 'nullable',
            // 'mother_occupation' => 'nullable',
            // 'number_siblings' => ['nullable', 'numeric']
            'student_id' => ['required', 'numeric', 'unique:families'],
            'father_name' => 'required',
            'father_occupation' => 'required',
            'mother_name' => 'nullable',
            'home_phone' => 'nullable',
            'father_phone' => 'nullable',
            'mother_phone' => 'nullable',
            'address' => 'nullable',
            'mother_occupation' => 'nullable',
            'number_siblings' => ['nullable', 'numeric']
        ]);

        Family::create($formFields);
        
        // return redirect('/')->with('message', 'Entry Added Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        // dd($family->student_id);
        $formFields = $request->validate([
            'student_id' => ['required', 'numeric'],
            'father_name' => 'required',
            'father_occupation' => 'required',
            'mother_name' => 'nullable',
            'home_phone' => 'nullable',
            'father_phone' => 'nullable',
            'mother_phone' => 'nullable',
            'address' => 'nullable',
            'mother_occupation' => 'nullable',
            'number_siblings' => ['nullable', 'numeric']
        ]);

        $family->update($formFields);

        return response([
            'message' => 'Family data updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        $family->delete();

        // return redirect('/')->with('message', 'Entry Deleted Succesfully');
    }
}
