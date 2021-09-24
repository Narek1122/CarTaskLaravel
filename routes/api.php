<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskImagesController;

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

Route::group([
    'prefix' => 'auth',


], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/admin_login', [AuthController::class, 'adminLogin']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/add_car_brand', [CarBrandController::class, 'addCarBrand']);
    Route::post('/add_car_model', [CarModelController::class, 'addCarModel']);
    Route::post('/add_task', [TaskController::class, 'addTask']);
    Route::post('/add_task_image/{id}', [TaskImagesController::class, 'addTaskImage']);
    Route::delete('/delete_task_image/{img}/{img2}/{img3}',[TaskImagesController::class, 'deletesTaskImage']);
    Route::get('/admin_get_tasks', [TaskController::class, 'adminGetTasks']);
    Route::post('/change_task_brand_model/{id}', [TaskController::class, 'changeTaskBrandModel']);


});

Route::get('/get_car_brands', [CarBrandController::class, 'getCarBrands']);
Route::get('/get_car_brands_and_models', [CarBrandController::class, 'getCarBrandsAndModels']);
Route::get('/get_tasks', [TaskController::class, 'getTasks']);
Route::get('/get_tasks_by/{name}', [TaskController::class, 'getTasksBy']);
Route::get('/get_image/{img}/{img2}/{img3}', [TaskImagesController::class, 'getImage']);




