<?php

use App\Models\Academics;
use App\Models\studentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CgpaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\studentDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//********************* PUBLIC ROUTES *********************//

//               Authentication Routes                  //

//Show register form
Route::get('/register', [UserController::class, 'registerForm']);

//Password Recovery form
Route::get('/forgot-password', [UserController::class, 'showPasswordRecovery']);
        
//Show login form
Route::get('/login', [UserController::class, 'loginForm'])->name('login');

//Reset Password View
Route::get('/reset-password/{token}', [UserController::class, 'showPasswordResetForm'])->middleware('guest')->name('password.reset');









//********************* PROTECTED ROUTES *********************//
Route::group(['middleware' => ['auth:sanctum']], function() {
        

        //HOME PAGE
    Route::get('/', [studentDataController::class, 'view'])->name('home');



            //             Base Student Data Routes                //

    //Show all student entries
    Route::get('/students', [studentDataController::class, 'view']);
    //Show all student entries
    Route::get('/someshit', [studentDataController::class, 'view']);

    //Show Create Entry Form
    Route::get('/students/create', [studentDataController::class, 'view'])->name('create');

    // //Show single student data entry 
    Route::get('/students/{studentData}', [studentDataController::class, 'viewSingle']);



            //             Student Family Data Routes                //

    //Show create form
    Route::get('/students/{studentData}/family/create', [FamilyController::class, 'create']);



            //              Student Academics Data Routing               //

    //Show create form
    Route::get('/students/{studentData}/academics/create', [AcademicsController::class, 'create']);



            //              Student Academics Data Routing               //

//     //Show create form
//     Route::get('/courses/create', [CourseController::class, 'create']);

//     //Get all courses
//     Route::get('/courses', [CourseController::class, 'view']);

        

           //              Users Routing               //

        //Show all users
        Route::get('/list-users', [UserController::class, 'viewAll']);


                //Show create form
        Route::get('/courses/create', [CourseController::class, 'create']);
                
        Route::get('/courses', [CourseController::class, 'view']);

        Route::get('/courses/{id}', [CourseController::class, 'view']); //apply database check

        Route::get('/courses/{id}/edit', [CourseController::class, 'view']);


        Route::get('/students/{id}/edit', [studentDataController::class, 'view']);

        Route::get('/students/{id}/family/edit', [studentDataController::class, 'view']);

        Route::get('/students/{id}/academics/edit', [studentDataController::class, 'view']);


});