<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\TeamController;
use App\Http\Controllers\Student\MemberController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\InstructionController;
use App\Http\Controllers\Supervisor\SupervisorController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
// Auth::routes(['verify' => true]);

Route::group(['prefix' => LaravelLocalization::setLocale()], function() {

    Route::middleware(['auth'])->group(function () {
        Route::controller(PasswordController::class)->group(function(){
            Route::prefix('passwords')->name('passwords.')->group(function () {
                Route::get('change-password', 'changePassword')->name('change-password');
                Route::post('password/update', 'updatePassword')->name('update');
                Route::post('password/skip', 'skip')->name('skip');
            });
        });
        Route::middleware('is-password-changed')->group(function () {

            Route::controller(ProfileController::class)->group(function(){
                Route::get('supervisors/profile', 'showProfile')->name('supervisors.profile');
                Route::get('students/profile', 'showProfile')->name('students.profile');
                Route::get('admins/profile', 'showProfile')->name('admins.profile');
                Route::post('profile/update', 'updateProfile')->name('profile.update');
            });

            Route::middleware(['role:'.User::ROLE_USER])->group(function () {

                Route::controller(StudentController::class)->group(function(){
                    Route::get('/', 'home')->name('students.dashboard');
                    Route::prefix('students')->name('students.')->group(function () {
                        Route::get('dashboard', 'home')->name('dashboard');
                        Route::get('my-team', 'getMyTeam')->name('my-team');
                    });
                });

                Route::controller(TeamController::class)->group(function(){
                    Route::prefix('teams')->name('teams.')->group(function () {
                        Route::post('store', 'store')->name('store');
                        Route::post('update/{id}', 'update')->name('update');
                        Route::post('members/store/{id}', 'addMemberTeam')->name('members.store');
                        Route::post('member/delete/{id}', 'deleteMember')->name('member.delete');
                        Route::post('member/accept/{id}', 'acceptMember')->name('member.accept');
                        Route::post('member/refus/{id}', 'refusMember')->name('member.refus');
                        Route::post('delete/{id}', 'delete')->name('delete');
                    });
                });
                Route::controller(MemberController::class)->group(function(){
                    Route::prefix('members')->name('members.')->group(function () {
                        Route::post('store/{id}', 'store')->name('store');
                        Route::post('delete/{id}', 'delete')->name('delete');
                        Route::post('accept/{id}', 'acceptMember')->name('accept');
                    });
                });
            });

            Route::middleware(['not-role:'.User::ROLE_SUPERVISOR])->group(function () {
                Route::controller(TeamController::class)->group(function(){
                    Route::prefix('teams')->name('teams.')->group(function () {
                        Route::post('supervisor/store/{id}', 'addSupervisorTeam')->name('supervisor.store');
                        Route::post('supervisor/delete/{id}', 'deleteSupervisor')->name('supervisor.delete');
                        Route::post('delete/{id}', 'delete')->name('delete');
                    });
                });

                Route::controller(InstructionController::class)->group(function(){
                    Route::prefix('students')->name('students.')->group(function () {
                        Route::get('instructions', 'index')->name('instructions');
                    });

                    Route::prefix('admins')->name('admins.')->group(function () {
                        Route::get('instructions', 'index')->name('instructions');
                    });
                });
            });

            Route::middleware(['role:'.User::ROLE_SUPERVISOR])->group(function () {
                Route::controller(SupervisorController::class)->group(function(){
                    Route::get('/', 'home')->name('supervisors.dashboard');
                    Route::prefix('supervisors')->name('supervisors.')->group(function () {
                        Route::get('dashboard', 'home')->name('dashboard');
                        Route::post('approve/{id}', 'approveTeam')->name('approve');
                        Route::post('reject/{id}', 'rejectTeam')->name('reject');
                    });
                });
            });

            Route::middleware(['not-role:'.User::ROLE_USER])->group(function () {
                Route::controller(SupervisorController::class)->group(function(){
                    Route::prefix('supervisors')->name('supervisors.')->group(function () {
                        Route::get('my-teams', 'getMyTeams')->name('my-teams');
                        Route::get('teams', 'getTeams')->name('teams');
                        Route::get('team-members/{team_id}', 'getTeamMembers')->name('team-members');
                    });

                    Route::prefix('admins')->name('admins.')->group(function () {
                        Route::get('teams', 'getMyTeams')->name('teams');
                    });
                });

                Route::controller(MemberController::class)->group(function(){
                        Route::post('deletemember/{id}', 'delete')->name('delete.member');
                        Route::post('storemember/{id}', 'store')->name('store.member');
                });

                Route::controller(TeamController::class)->group(function(){
                    Route::get('supervisors/teams/show/{id}', 'show')->name('supervisors.teams.show');
                    Route::get('admins/teams/show/{id}', 'show')->name('admins.teams.show');
                });
            });

            Route::middleware(['role:'.User::ROLE_ADMIN])->group(function () {
                Route::controller(AdminController::class)->group(function(){
                    Route::get('/', 'home')->name('admins.dashboard');
                    Route::prefix('admin')->name('admins.')->group(function () {
                        Route::get('dashboard', 'home')->name('dashboard');
                        Route::get('settings', 'settings')->name('settings');
                        Route::post('settings', 'storeSettings')->name('settings.store');
                    });
                });

                Route::prefix('admin')->group(function () {
                    Route::controller(DepartmentController::class)->group(function(){
                        Route::prefix('departments')->name('departments.')->group(function () {
                            Route::get('get', 'getDepartments')->name('get');
                            Route::post('delete/{id}', 'destroy')->name('delete');
                            Route::post('change-status/{id}', 'changeStatus')->name('change-status');
                        });
                    });
                    Route::resource('departments', DepartmentController::class);

                    Route::controller(TagController::class)->group(function(){
                        Route::prefix('tags')->name('tags.')->group(function () {
                            Route::get('get', 'getTags')->name('get');
                            Route::post('delete/{id}', 'destroy')->name('delete');
                            Route::post('change-status/{id}', 'changeStatus')->name('change-status');
                        });
                    });
                    Route::resource('tags', TagController::class);

                    Route::controller(UserController::class)->group(function(){
                        Route::prefix('users')->name('users.')->group(function () {
                            Route::get('get', 'getUsers')->name('get');
                            Route::post('delete/{id}', 'destroy')->name('delete');
                        });
                    });
                    Route::resource('users', UserController::class);
                });

            });
        });

    });
});
