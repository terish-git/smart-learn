<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Uploads\UploadController;

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


Route::post('/register', [AuthController::class, 'register']); // Register (Admin or Student)
Route::post('/login', [AuthController::class, 'login']); // Login
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']); // Logout


Route::middleware('auth:api')->group(function () {

    // Super Admin Routes (Access to all)
    Route::middleware(['role:super-admin'])->group(function () {
        Route::prefix('super-admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard']);

        });
    });

    // Admin Routes (Access to their own dashboard and managing students)
    Route::middleware(['role:admin|super-admin'])->group(function () {
        
        Route::prefix('admin')->group(function () {
            // Business Dashboard
            Route::get('/dashboard', [BusinessController::class, 'dashboard']);
            Route::post('/business/profile/update', [BusinessController::class, 'updateProfile']);

            Route::prefix('categories')->group(function () {
                Route::get('/', [CategoryController::class, 'index']);
                Route::post('/', [CategoryController::class, 'store']);
                Route::get('/by-business', [CategoryController::class, 'getCategoriesByBusinessType']);
                Route::get('/child', [CategoryController::class, 'getChildCategoriesByParentId']);
                Route::get('/parents', [CategoryController::class, 'getAllParentsOfCategory']);
                Route::get('/children', [CategoryController::class, 'getAllChildrenOfCategory']);
            });
            
            Route::prefix('upload')->group(function () {
                Route::post('/', [UploadController::class, 'storeUpload']);
                Route::get('/', [UploadController::class, 'getUploadsByCategory']);
                Route::delete('/', [UploadController::class, 'deleteUpload']);
            });
        });
        
    });

    // Student Routes (Limited to student-specific functionalities)
    // Route::middleware(['role:student'])->group(function () {
    //     Route::prefix('student')->group(function () {
    //         Route::get('/dashboard', [StudentController::class, 'dashboard']);
    //         // Add more Student-specific routes here
    //     });
    // });


    // Route::get('/user', [AuthController::class, 'userProfile']);
    // Route::post('/business/register', [BusinessController::class, 'register']);
    // Route::put('/business/update/{id}', [BusinessController::class, 'update']);
    // Route::get('/business/{id}', [BusinessController::class, 'show']);
});


