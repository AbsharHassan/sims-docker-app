<?php

namespace App\Http\Controllers;

use App\Models\CourseMarks;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseMarksController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Courses $course)
    {
        // dd($request);

        $marks_array = explode("," , $request->marks);

        foreach($marks_array as $marks) {
            CourseMarks::create(['course_id' => $request->course_id, 'marks' => $marks]);
        }

        // $formFields = $request->validate([
        //     'course_id' => 'required',
        //     'marks' => ['required', 'numeric', 'lte:100'],
        //     // '0-10' => ['numeric', 'lte:100'],
        //     // '11-20' => ['numeric', 'lte:100'],
        //     // '21-30' => ['numeric', 'lte:100'],
        //     // '31-40' => ['numeric', 'lte:100'],
        //     // '41-50' => ['numeric', 'lte:100'],
        //     // '51-60' => ['numeric', 'lte:100'],
        //     // '61-70' => ['numeric', 'lte:100'],
        //     // '71-80' => ['numeric', 'lte:100'],
        //     // '81-90' => ['numeric', 'lte:100'],
        //     // '91-100' => ['numeric', 'lte:100'],
        // ]);

        // $course_marks = CourseMarks::create($formFields);
        // // CourseMarksController::average($course_marks);
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
    public function update(Request $request, CourseMarks $course_marks)
    {

        $formFields = $request->validate([
            'course_id' => 'required',
            'marks' => ['required', 'numeric', 'lte:100']
        ]);

        $course_marks->update($formFields);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseMarks $course_marks)
    {
        $course_marks->delete();
    }
}
