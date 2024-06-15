<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\Student\TeamController;
use App\Http\Controllers\Api\Student\MemberController;
use App\Http\Controllers\Api\Student\StudentController;
use App\Http\Controllers\Api\Admin\DepartmentController;
use App\Http\Controllers\Api\Supervisor\SupervisorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['guest:sanctum'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('auth/login','login');
        Route::get('auth/showRegistrationForm','showRegistrationForm');
        Route::post('auth/register','register');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)->group(function() {
        Route::delete('auth/logout/{token?}', 'destroy');
    });

    Route::middleware('is-password-changed')->group(function () {
        Route::controller(ProfileController::class)->group(function(){
            Route::post('profile/update', 'updateProfile')->name('update');
        });

        Route::controller(StudentController::class)->group(function(){
            Route::get('students/dashboard', 'home');
            Route::get('supervisors/dashboard', 'home');
        });

        Route::middleware(['role:'.User::ROLE_USER])->group(function () {

            Route::controller(StudentController::class)->group(function(){
                Route::prefix('students')->group(function () {
                    Route::get('my-team', 'getMyTeam');
                    Route::get('show-users', 'showUsers');
                    Route::get('instruction', 'getInstructions');
                    Route::get('project', 'getProjects');
                });
            });

            Route::controller(TeamController::class)->group(function(){
                Route::prefix('teams')->group(function () {
                    Route::post('store', 'store');
                    Route::put('update/{id}', 'update');
                });
                Route::prefix('students')->group(function () {
                    Route::get('upload-book/{id}', 'edit');
                    Route::post('book/store/{id}', 'addBookTeam');
                });
            });

            Route::controller(MemberController::class)->group(function(){
                Route::prefix('members')->group(function () {
                    Route::post('store/{id}', 'store');
                    Route::delete('delete/{id}', 'delete');
                    Route::post('accept/{id}', 'acceptMember');
                });
            });
        });

        Route::middleware(['not-role:'.User::ROLE_SUPERVISOR])->group(function () {
            Route::controller(TeamController::class)->group(function(){
                Route::prefix('teams')->group(function () {
                    Route::post('supervisor/store/{id}', 'addSupervisorTeam');
                    Route::delete('supervisor/delete/{id}', 'deleteSupervisor');
                    Route::delete('delete/{id}', 'delete');
                });
            });
        });

        Route::middleware(['role:'.User::ROLE_SUPERVISOR])->group(function () {
            Route::controller(SupervisorController::class)->group(function(){
                Route::prefix('supervisors')->group(function () {
                    Route::post('approve/{id}', 'approveTeam');
                    Route::post('reject/{id}', 'rejectTeam');
                });
            });
        });

        Route::middleware(['not-role:'.User::ROLE_USER])->group(function () {
            Route::controller(SupervisorController::class)->group(function(){
                Route::prefix('supervisors')->group(function () {
                    Route::get('teams', 'getTeams');
                });
            });

            Route::controller(MemberController::class)->group(function(){
                Route::prefix('admins')->group(function () {
                    Route::post('storemember/{id}', 'store');
                    Route::delete('deletemember/{id}', 'delete');
                });
            });

            Route::controller(TeamController::class)->group(function(){
                Route::get('supervisors/teams/show/{id}', 'show');
                Route::get('admins/teams/show/{id}', 'show');
            });
        });

        Route::middleware(['role:'.User::ROLE_ADMIN])->group(function () {
            Route::controller(AdminController::class)->group(function(){
                Route::prefix('admin')->group(function () {
                    Route::get('dashboard', 'home');
                    Route::get('settings', 'settings');
                    Route::post('settings', 'storeSettings');
                });
            });

            Route::prefix('admin')->group(function () {
                Route::controller(DepartmentController::class)->group(function(){
                    Route::prefix('departments')->group(function () {
                        Route::get('get', 'getDepartments');
                        Route::post('change-status/{id}', 'changeStatus');
                    });
                });
                Route::apiResource('departments', DepartmentController::class);

                Route::controller(TagController::class)->group(function(){
                    Route::prefix('tags')->group(function () {
                        Route::get('get', 'getTags');
                        Route::post('change-status/{id}', 'changeStatus');
                    });
                });
                Route::apiResource('tags', TagController::class);

                Route::controller(UserController::class)->group(function(){
                    Route::prefix('users')->group(function () {
                        Route::get('get', 'getUsers');
                        Route::get('create', 'create');
                    });
                });
                Route::resource('users', UserController::class);
            });
        });
    });
});
