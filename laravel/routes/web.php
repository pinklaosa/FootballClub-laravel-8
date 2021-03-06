<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\firstController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RivalController;

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


// Route::get('login', function () {
//     return view('user.login');
// });

// Route::get('register', function () {
//     return view('user.create');
// });
// Route::get('member', function () {
//     return view('page.member');
// });

// Route::resource('user',UsersController::class);
// Route::get('admin/create',[UsersController::class,'create'])->name('admin.create')->middleware('is_admin');

Route::get('/',[CustomAuthController::class,function(){
    return redirect('login');
}]);

Route::get('/member',[MemberController::class,'member'])->middleware('isLogged');
Route::get('/geteditmember/{id_m}',[MemberController::class,'getEditMember']);
Route::post('/updateplayer',[MemberController::class,'updateMember'])->name('update.player');
Route::get('/deletedplayer/{id_m}',[MemberController::class,'deletedPlayer']);

Route::get('/login',[CustomAuthController::class,'login']);
Route::get('/register',[CustomAuthController::class,'register'])->middleware('isLogged');

Route::post('methodLogin',[CustomAuthController::class,'postLogin'])->name('custom.check');
Route::post('methodRegister',[CustomAuthController::class,'postRegister'])->name('custom.register');

Route::get('/logout',[CustomAuthController::class,'logout']);

Route::get('/add',[MemberController::class,'addM'])->middleware('isLogged');
Route::post('/added',[MemberController::class,'addedMember'])->name('player.add');

Route::get('/fullcalender', [FullCalenderController::class,'index'])->middleware('isLogged');
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);

Route::get('/rival',[RivalController::class,'rival'])->middleware('isLogged');
Route::get('/getrivalteam',[RivalController::class,'getRiavalTeam']);
Route::get('/rivalmember',[RivalController::class,'rivalMembers']);
Route::get('/rivalmember/{id_mr}',[RivalController::class,'statistics']);
Route::post('/addrivalteam',[RivalController::class,'addRivalTeam'])->name('rival.addteam');
Route::post('/addrivalmember',[RivalController::class,'addRivalMember'])->name('member.addrival');
Route::post('/addstatrivalmember',[RivalController::class,'addStatRivalMember'])->name('stat.addmember');
Route::post('/editrivalmember',[RivalController::class,'editRivalMember'])->name('edit.rivalmember');
Route::get('/deletedmember/{id_mr}',[RivalController::class,'deletedMember']);

Route::get('/statistics',[MemberController::class,'showStatistics'])->middleware('isLogged');
Route::get('/getstatistics',[MemberController::class,'usStatistics']);
Route::get('/statistics/{id_m}',[MemberController::class,'detailStatistics']);
Route::post('/addstatistics',[MemberController::class,'addStatistics'])->name('add.statistics');

Route::get('/analysis',[AnalysisController::class,'pAnalysis'])->middleware('isLogged');
Route::post('/recommend',[AnalysisController::class,'selectedRival'])->name('select.rival');
Route::get('/analysis/{id_mr}',[AnalysisController::class,'getMemberRival']);

