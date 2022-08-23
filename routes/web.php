<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Models\Employee;

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
// Route::get('/', function () {
//     return view('welcome',["title" => "Home"]);

// });

Route::get('/pegawai',[EmployeeController::class,'index'])->middleware('auth');

Route::get('/tambahpegawai',[EmployeeController::class,'tambah']);
Route::post('/insertdata',[EmployeeController::class,'insert']);

Route::get('/editdata/{id}',[EmployeeController::class,'edit']);
Route::post('/updatedata/{id}',[EmployeeController::class,'update']);

Route::get('/deletedata/{id}',[EmployeeController::class,'delete']);

// export pdf
Route::get('/exportpdf',[EmployeeController::class,'exportpdf']);

// export excel
Route::get('/exportexcel',[EmployeeController::class,'exportexcel']);

//import excel
Route::post('/importexcel',[EmployeeController::class,'importexcel']);


Route::get('/',[LoginController::class,'login']);
Route::post('/loginproses',[LoginController::class,'loginproses']);

Route::get('/register',[LoginController::class,'register']);
Route::post('/registeruser',[LoginController::class,'registeruser']);

Route::get('/logout',[LoginController::class,'logout']);
