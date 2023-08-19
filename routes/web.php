<?php

use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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
Route::get('clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    return "Cleared!";
 });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });


     ############################ Dashboard Routes ###############################
    Route::get('/dashboard', [UserController::class, 'show'])->name('dashboard');
    Route::get('/user-count', [UserController::class, 'showUserCount'])->name('user.count');

    ############################ Manage User Routes ###############################
    Route::get('manageuser/list', [ManageUserController::class, 'list'])->name('manageuser.list')->middleware('admin');
    Route::get('manageuser/add', [ManageUserController::class, 'add'])->name('manageuser.add')->middleware('admin');
    Route::post('manageuser/postadd', [ManageUserController::class, 'postadd'])->name('manageuser.postadd')->middleware('admin');
    Route::get('manageuser/edit', [ManageUserController::class, 'editUser'])->name('manageuser.edit')->middleware('admin');
    Route::post('manageuser/update', [ManageUserController::class, 'update'])->name('manageuser.update')->middleware('admin');
    Route::get('manageuser/delete', [ManageUserController::class, 'delete'])->name('manageuser.delete')->middleware('admin');
    Route::get('changepassword', [ManageUserController::class, 'changepassword'])->name('changepassword');
    Route::post('updatepassword', [ManageUserController::class, 'updatepassword'])->name('updatepassword');

    Route::get('/user-count',  [ManageUserController::class, 'showUserCount'])->name('user.count');


    ############################ Excel Routes ###############################
    Route::get('uploaddata/excel', [DataController::class, 'index'])->name('uploaddata.excel')->middleware('admin');
    Route::post('uploaddata/import', [DataController::class, 'import'])->name('uploaddata.import')->middleware('admin');
    Route::get('uploaddata/export', [DataController::class, 'export'])->name('uploaddata.export')->middleware('admin');

     ############################ report Routes ###############################
     Route::get('reportwork/report', [ReportController::class, 'report'])->name('reportwork.report')->middleware('admin');
     Route::post('reportwork/daterange', [ReportController::class, 'daterange'])->name('reportwork.daterange')->middleware('admin');
     ############################ Agent Input Routes ###############################
     Route::get('agentfile/agent', [AgentController::class, 'agent'])->name('agentfile.agent');
     Route::post('agentfile/search', [AgentController::class, 'search'])->name('agentfile.search');
     Route::post('agentfile/cti', [AgentController::class, 'cti'])->name('agentfile.cti');
});