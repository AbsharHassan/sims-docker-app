<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CourseMarksController;

class CourseController extends Controller
{
    //Return view for the vue app
    public function view()
    {
        return view('layout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Courses::all();
    }

    public function create()
    {
        return view('layout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'course_id' => ['required', 'unique:courses'],
            'course_code' => 'required',
            'course_name' => 'required',
            'course_description' => 'nullable'
        ]);

        Courses::create($formFields);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Courses::find($id);

        if($course) {
            CourseController::saveAvgStd($course);
            return [
                'course' => $course,
                'canProceed' => true,
            ];
        } else {
            return [
                'canProceed' => false,
                'redirectTo' => 'CreateCourse', 
                'message' => 'This course does not exist yet.'
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $course)
    {
        $formFields = $request->validate([
            'course_id' => ['required', Rule::unique('courses')->ignore($course->id)],
            'course_code' => 'required',
            'course_name' => 'required',
            'course_description' => 'nullable'
        ]);

        $course->update($formFields);
    }

    // update average and standard deviation ONLY
    // public function saveAvgStd(Request $request, Courses $course)
    // {
    //     CourseController::average($course);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $course)
    {
        $course->delete();
        return response([
            'message' => 'The course has been deleted from the database.'
        ], 204);
    }

    public function histogram($course)
    {
        if(Courses::find($course)) {
            // $histogram = DB::table('course_marks')
            // ->selectRaw('bin1, bin2, bin3, bin4, bin5, bin6, bin7, bin8, bin9, bin10')
            // ->where('course_id', '=', $course)
            // // ->groupBy('marks')
            // // ->orderByRaw(1)
            // ->get();

            // dd($histogram);

            $histogram = DB::table('course_marks')
            ->selectRaw('floor(marks/10.00)*10 as bin, count(*) as count')
            ->where('course_id', '=', $course)
            ->groupByRaw(1)
            ->orderByRaw(1)
            ->get();

            $histogram = json_decode($histogram, true);

            // dd($histogram);
            return $histogram;

        } else {
            return 0;
        }

        // dd($id);
        // if(Courses::find($course)) {
        //     // $histogram = DB::table('course_marks')
        //     // ->selectRaw('floor(marks/10.00)*10 as bin, count(*) as count')
        //     // ->where('course_id', '=', $course)
        //     // ->groupByRaw(1)
        //     // ->orderByRaw(1)
        //     // ->get();

        //     // $histogram = json_decode($histogram, true);

        //     // return $histogram;

        //     $histogram = DB::table('course_marks')
        //     ->selectRaw('case
        //     when marks between 0 and 10 then \'0-10\'
        //     when marks between 11 and 20 then \'11-20\'
        //     when marks between 21 and 30 then \'21-30\'
        //     when marks between 31 and 40 then \'31-40\'
        //     when marks between 41 and 50 then \'41-50\'
        //     when marks between 51 and 60 then \'51-60\'
        //     when marks between 61 and 70 then \'61-70\'
        //     when marks between 71 and 80 then \'71-80\'
        //     when marks between 81 and 90 then \'81-90\'
        //     when marks between 91 and 100 then \'91-100\'
        //     end as bin, count(*) as count
        //     LEFT JOIN 
        //     case
        //     when marks between 0 and 10 then \'0-10\'
        //     when marks between 11 and 20 then \'11-20\'
        //     when marks between 21 and 30 then \'21-30\'
        //     when marks between 31 and 40 then \'31-40\'
        //     when marks between 41 and 50 then \'41-50\'
        //     when marks between 51 and 60 then \'51-60\'
        //     when marks between 61 and 70 then \'61-70\'
        //     when marks between 71 and 80 then \'71-80\'
        //     when marks between 81 and 90 then \'81-90\'
        //     when marks between 91 and 100 then \'91-100\'
        //     end')
        //     ->where('course_id', '=', $course)
        //     ->groupByRaw(1)
        //     ->orderByRaw(1)
        //     ->get();

        //     dd($histogram);
            
        // }
        // else return 0;
        
    }

    public function saveAvgStd(Courses $course)
    {
        if(
            DB::table('course_marks')
            ->select(DB::raw('AVG(marks) AS average, STDDEV_SAMP(marks) AS std_dev'))
            ->where('course_id', '=', $course->course_id)
            ->groupBy('course_id')
            ->count()
        ) {
            $data = DB::table('course_marks')
            ->select(DB::raw('AVG(marks) AS average, STDDEV_SAMP(marks) AS std_dev'))
            ->where('course_id', '=', $course->course_id)
            ->groupBy('course_id')
            ->get();
    
            $data = json_decode($data, true)[0];
            
            $histogram = DB::table('course_marks')
            ->selectRaw('floor(marks/10.00)*10 as bin, count(*) as count')
            ->where('course_id', '=', $course->course_id)
            ->groupByRaw(1)
            ->orderByRaw(1)
            ->get();
    
            $histogram = json_decode($histogram, true);
            // dd($histogram);
            
            $course->update(['average' => $data['average'], 'std_dev' => $data['std_dev']]);
        } else {
            $course->update(['average' => 0, 'std_dev' => 0]);
        }

    }
}
