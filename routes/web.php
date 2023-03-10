<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PaymentSpaController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
// use App\Http\Controllers\Essential\KlassController;
// use App\Http\Controllers\Essential\YearController;
// use App\Http\Controllers\Essential\GradeController;
// use App\Http\Controllers\Essential\YearPlanController;
use App\Http\Controllers\Essential\PromotionController;
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


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::prefix('admin')->group(function(){
        Route::resource('/surveys',App\Http\Controllers\Admin\SurveyController::class);
        Route::resource('/questions',App\Http\Controllers\Admin\QuestionController::class);
    });
});

Route::resource('/questionnaire',App\Http\Controllers\QuestionnaireController::class);

Route::resource('/payments',PaymentSpaController::class);
Route::resource('/subjects',SubjectController::class);
Route::resource('/courses',CourseController::class);
Route::prefix('manage/')->group(function(){
    Route::resource('/grades',App\Http\Controllers\Manage\GradeController::class);
    //Route::get('/courses/{klassId}',[App\Http\Controllers\Manage\GradeController::class, 'courses']);
    Route::get('/students/{klassId}',[App\Http\Controllers\Manage\GradeController::class,'students']);
    Route::get('/scores/{klassId}',[App\Http\Controllers\Manage\GradeController::class,'scores']);
    Route::resource('/course',App\Http\Controllers\Manage\CourseController::class);
    Route::resource('/klass',App\Http\Controllers\Manage\KlassController::class);
    Route::get('/test_data',[App\Http\Controllers\Manage\KlassController::class,'test_data']);

});


Route::get('/year/klass/disciplines/{klassId}',[KlassController::class,'disciplines']);
Route::get('/year/klasses/{yearId}',[YearController::class,'year']);
Route::get('/year/subjects/{yearId}',[YearController::class,'subjects']);

// Route::resource('/promotion',PromotionController::class);
// Route::get('/promotion/klass/{klassId}',[PromotionController::class,'klass']);
// Route::get('/promotion/grade/{gradeId}',[PromotionController::class,'grade']);
//Route::get('/promotion/data/{gradesklassId}',[PromotionController::class,'data']);

Route::prefix('essential')->group(function(){
    Route::resource('/dashboard',App\Http\Controllers\Essential\YearPlanController::class);
    Route::resource('/years',App\Http\Controllers\Essential\YearController::class);
    Route::resource('/grades',App\Http\Controllers\Essential\GradeController::class);
    Route::resource('/klasses',App\Http\Controllers\Essential\KlassController::class);
    Route::resource('/subjects',App\Http\Controllers\Essential\SubjectController::class);
});

Route::prefix('promote')->group(function(){
    Route::resource('/',App\Http\Controllers\Essential\PromotionController::class);
    Route::get('getStudents/{klassId}',[App\Http\Controllers\Essential\PromotionController::class,'getStudents']);
    Route::get('getPromotedStudents/{klassId}',[App\Http\Controllers\Essential\PromotionController::class,'getPromotedStudents']);
    Route::post('updateStudents',[App\Http\Controllers\Essential\PromotionController::class,'updateStudents']);
    Route::get('data/{yearId}',[App\Http\Controllers\Essential\PromotionController::class, 'data']);
});


