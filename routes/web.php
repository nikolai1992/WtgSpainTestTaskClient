<?php

use App\Http\Controllers\Dashboard\Task\TaskCommentController;
use App\Http\Controllers\Dashboard\Task\TaskController;
use App\Http\Controllers\Dashboard\Team\TeamController;
use Illuminate\Support\Facades\Route;

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
Route::group([
    'middleware' => 'checkAuthToken',
    'prefix' => 'dashboard'
], function () {
    Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('task', TaskController::class)->except('index', 'destroy');
    Route::get('/task/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

    Route::resource('task_comment', TaskCommentController::class)->except('index');

    Route::get('/team/add-member/{teamId}', [TeamController::class, 'addMember'])->name('team.addMember');
    Route::post('/team/add-member/{teamId}', [TeamController::class, 'addMemberRequest'])->name('team.addMemberRequest');
    Route::get('/team/remove-member/{teamId}/{userId}', [TeamController::class, 'removeMemberRequest'])->name('team.removeMemberRequest');
    Route::resource('team', TeamController::class);
});

Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('main');
