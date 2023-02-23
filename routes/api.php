<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\CourseMarksController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\studentDataController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//********************* PUBLIC ROUTES *********************//

//           User Register, Login and Register           //

//Regiser new user to database
Route::post('/register', [UserController::class, 'store']);

//Login
Route::post('/login', [UserController::class, 'login']);

//Forgot Password
Route::post('/forgot-password', [UserController::class, 'forgotPasswordForm'])->middleware('guest')->name('password.email');



//********************* PROTECTED ROUTES *********************//
Route::group(['middleware' => ['auth:sanctum']], function() {

        //           User Register, Login and Register           //
    
    //Logout 
    Route::post('/logout', [UserController::class, 'logout']);

    //Verify Password
    Route::post('/users/{user}/verify', [UserController::class, 'verify']);

    //Update details
    Route::put('/users/{user}', [UserController::class, 'update']);

    //Change Password
    Route::put('/users/{user}/change-password', [UserController::class, 'changePassword']);

    // show all users
    Route::get('/users', [UserController::class, 'show']);



        //              Main Student Data Routing               //

    //Show all student entries
    Route::get('/', [studentDataController::class, 'index']);

    //Show create entry form
    Route::get('/students/create', [studentDataController::class, 'create']);

    //Show edit form
    Route::get('/students/{student}/edit', [studentDataController::class, 'edit']);

    //Show single student data entry 
    Route::get('/students/{student}', [studentDataController::class, 'show']);

    //Store to base student data to database
    Route::post('/students', [studentDataController::class, 'store']);

    //Update form
    Route::put('/students/{student}', [studentDataController::class ,'update']);

    //Delete form
    Route::delete('/students/{student}', [studentDataController::class, 'destroy']);



        //              Student Academics Data Routing               //

    //Show create form
    Route::get('/students/{studentData}/academics/create', [AcademicsController::class, 'createVerify']);

    //Store student academics data to database
    Route::post('/students/academics', [AcademicsController::class, 'store']);

    //Update student academics data to database
    Route::put('/students/academics/{academics}', [AcademicsController::class, 'update']);

    //Delete entry from database
    Route::delete('/students/academics/{academics}', [AcademicsController::class, 'destroy']);



        //             Student Family Data Routes                //

    //Show create form
    Route::get('/students/{studentData}/family/create', [FamilyController::class, 'createVerify']);

    //Store student family data to database
    Route::post('/students/family', [FamilyController::class, 'store']);

    //Update student family data to database
    Route::put('/students/{family}/family', [FamilyController::class, 'update']);

    //Delete entry from database
    Route::delete('/students/{student}/family/{family}', [FamilyController::class, 'destroy']);



        //             Course Info Data Routes                //

    //Retrieve all courses 
    Route::get('/courses', [CourseController::class, 'index']);

    //Retrieve/verify single course data
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    //Store course information to database
    Route::post('/courses', [CourseController::class, 'store']);

    //Update course information to database
    Route::put('/courses/{course}', [CourseController::class, 'update']);

    //Delete course from database
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

    //Update course with AVG info
    Route::put('/courses/avg/{course}', [CourseController::class, 'saveAvgStd']); //call when clicking submit for the marks

    //Show histogram data for a course
    Route::get('/courses/histogram/{course}', [CourseController::class, 'histogram']);



        //             CourseMarks Info Data Routes                //

    //Store course marks to database
    Route::post('/courses-marks', [CourseMarksController::class, 'store']);

    //Update course marks to database
    Route::post('/courses-marks/{course_marks}', [CourseMarksController::class, 'update']);

    //Delete course marks from database
    Route::post('/courses-marks/{course_marks}', [CourseMarksController::class, 'destroy']);



        //             Department Info Data Routes                //

    //Store department data to database
    Route::post('/departments', [DepartmentController::class, 'store']);

    //Update department data to database
    Route::post('/departments/{department}', [DepartmentController::class, 'update']);

    //Delete department data from database
    Route::post('/departments/{department}', [DepartmentController::class, 'destroy']);



        //             Department Info Data Routes                //
        
     //Get all users
     Route::get('/users', [UserController::class, 'index']);

     //Get current user
     Route::get('/users/{user}', [UserController::class, 'show']);


});