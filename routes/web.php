<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\AuthController;

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

Route::prefix('/')->group(function () {
    Route::get('/',[AuthController::class,'getLogin']);
    Route::post('/',[AuthController::class,'postLogin'])->name('auth.login');
});

Route::prefix('logout')->group(function () {
    Route::post('/',[AuthController::class,'postLogout'])->name('auth.logout');
});

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    // admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/',[AdminController::class,'Adminindex'])->name('admin.index');
        Route::prefix('role')->group(function () {
            Route::get('/',[AdminController::class,'Roleindex'])->name('admin.role.index');
            Route::get('add/',[AdminController::class,'getAddRole']);
            Route::post('add/',[AdminController::class,'postAddRole'])->name('admin.role.add');
            Route::get('update/{id}',[AdminController::class,'getUpdateRole']);
            Route::post('update/{id}',[AdminController::class,'postUpdateRole'])->name('admin.role.update');
            Route::get('delete/{id}',[AdminController::class,'deleteRole']);
        });
        Route::prefix('account')->group(function () {
            Route::get('/',[AdminController::class,'Accountindex'])->name('admin.account.index');
            Route::get('add/',[AdminController::class,'getAddAccount']);
            Route::post('add/',[AdminController::class,'postAddAccount'])->name('admin.account.add');
            Route::get('update/{id}',[AdminController::class,'getUpdateAccount']);
            Route::post('update/{id}',[AdminController::class,'postUpdateAccount'])->name('admin.account.update');
            Route::get('delete/{id}',[AdminController::class,'deleteAccount']);
        });
    });
});

Route::group(['middleware' => ['auth', 'role:Staff']], function () {
    // staff routes
    Route::prefix('staff')->group(function () {
        Route::get('/',[StaffController::class,'Staffindex'])->name('staff.index');
        Route::prefix('trainee')->group(function () {
            Route::get('/',[StaffController::class,'Traineeindex'])->name('staff.trainee.index');
            Route::get('add/',[StaffController::class,'getAddTrainee']);
            Route::post('add/',[StaffController::class,'postAddTrainee'])->name('staff.trainee.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateTrainee']);
            Route::post('update/{id}',[StaffController::class,'postUpdateTrainee'])->name('staff.trainee.update');
            Route::get('delete/{id}',[StaffController::class,'deleteTrainee']);
            Route::get('search',[StaffController::class,'searchTrainee'])->name('staff.trainee.search');
        });
        Route::prefix('category')->group(function () {
            Route::get('/',[StaffController::class,'Categoryindex'])->name('staff.category.index');
            Route::get('add/',[StaffController::class,'getAddCategory']);
            Route::post('add/',[StaffController::class,'postAddCategory'])->name('staff.category.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateCategory']);
            Route::post('update/{id}',[StaffController::class,'postUpdateCategory'])->name('staff.category.update');
            Route::get('delete/{id}',[StaffController::class,'deleteCategory']);
            Route::get('search',[StaffController::class,'searchCategory'])->name('staff.category.search');
        });
        Route::prefix('course')->group(function () {
            Route::get('/',[StaffController::class,'Courseindex'])->name('staff.course.index');
            Route::get('add/',[StaffController::class,'getAddCourse']);
            Route::post('add/',[StaffController::class,'postAddCourse'])->name('staff.course.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateCourse']);
            Route::post('update/{id}',[StaffController::class,'postUpdateCourse'])->name('staff.course.update');
            Route::get('delete/{id}',[StaffController::class,'deleteCourse']);
            Route::get('search',[StaffController::class,'searchCourse'])->name('staff.course.search');
        });
        Route::prefix('topic')->group(function () {
            Route::get('/',[StaffController::class,'Topicindex'])->name('staff.topic.index');
            Route::get('add/',[StaffController::class,'getAddTopic']);
            Route::post('add/',[StaffController::class,'postAddTopic'])->name('staff.topic.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateTopic']);
            Route::post('update/{id}',[StaffController::class,'postUpdateTopic'])->name('staff.topic.update');
            Route::get('delete/{id}',[StaffController::class,'deleteTopic']);
        });
        Route::prefix('trainer')->group(function () {
            Route::get('/',[StaffController::class,'Trainerindex'])->name('staff.trainer.index');
            Route::get('add/',[StaffController::class,'getAddTrainer']);
            Route::post('add/',[StaffController::class,'postAddTrainer'])->name('staff.trainer.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateTrainer']);
            Route::post('update/{id}',[StaffController::class,'postUpdateTrainer'])->name('staff.trainer.update');
            Route::get('delete/{id}',[StaffController::class,'deleteTrainer']);
        });
        Route::prefix('assignCourse')->group(function () {
            Route::get('/',[StaffController::class,'AssignCourseindex'])->name('staff.assigncourse.index');
            Route::get('add/',[StaffController::class,'getAddAssignCourse']);
            Route::post('add/',[StaffController::class,'postAddAssignCourse'])->name('staff.assigncourse.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateAssignCourse']);
            Route::post('update/{id}',[StaffController::class,'postUpdateAssignCourse'])->name('staff.assigncourse.update');
            Route::get('delete/{id}',[StaffController::class,'deleteAssignCourse']);
        });
        Route::prefix('assigntopic')->group(function () {
            Route::get('/',[StaffController::class,'AssignTopicindex'])->name('staff.assigntopic.index');
            Route::get('add/',[StaffController::class,'getAddAssignTopic']);
            Route::post('add/',[StaffController::class,'postAddAssignTopic'])->name('staff.assigntopic.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateAssignTopic']);
            Route::post('update/{id}',[StaffController::class,'postUpdateAssignTopic'])->name('staff.assigntopic.update');
            Route::get('delete/{id}',[StaffController::class,'deleteAssignTopic']);
        });
    });
});

Route::group(['middleware' => ['auth', 'role:Trainer']], function () {
    // trainer routes
    Route::prefix('trainer')->group(function () {
        Route::get('/',[TrainerController::class,'Trainerindex'])->name('trainer.index');
        Route::get('assigntopic',[TrainerController::class,'Topicindex'])->name('trainer.topic.index');
        Route::prefix('profile')->group(function () {
            Route::get('/',[TrainerController::class,'Profileindex'])->name('trainer.profile');
            Route::get('/update',[TrainerController::class,'getUpdateProfile']);
            Route::post('/update',[TrainerController::class,'postUpdateProfile'])->name('trainer.profile.update');
        });
    });
});
