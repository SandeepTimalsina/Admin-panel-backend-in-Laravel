<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;


// Route::get('/user', function (Request $request) {
//     return 'API';
// })->middleware('auth:sanctum');

Route::get('/users', [AuthController::class, 'index']); // List all users
Route::get('/users/role/{role}', [AuthController::class, 'getUsersByRole']); // Get users by role
Route::post('/users', [AuthController::class, 'store']); // Create a user
Route::put('/users/{id}/role', [AuthController::class, 'updateRole']); // Update user role
Route::delete('/users/{id}', [AuthController::class, 'destroy']); // Delete a user
Route::post('/bookings', [BookingController::class, 'store']);  // Create booking
Route::get('/bookings/{id}', [BookingController::class, 'view']);  // View booking
Route::put('/bookings/{id}', [BookingController::class, 'update']);  // Edit booking
Route::post('/contacts', [ContactController::class, 'store']); //contact us save
Route::get('/contacts', [ContactController::class, 'index']); //get all contacts
Route::get('menus', [MenuController::class, 'index']);
Route::post('menus', [MenuController::class, 'store']);// Create a new menu item
Route::get('menus/{menu}', [MenuController::class, 'show']);// Get a specific menu item by its ID
Route::put('menus/{menu}', [MenuController::class, 'update']);// Update a specific menu item by its ID
Route::delete('menus/{menu}', [MenuController::class, 'destroy']);// Delete a menu item by its ID

