<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\BusinessController;
use App\Http\Controllers\API\CollectorController;


Route::post('/adminLogin', [AuthController::class, 'adminLogin'])->name('admin-login');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::any('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/add-address', [AddressController::class, 'addAddress']);
    


Route::group(['middleware' => 'collector'], function() {
    Route::post('/add-collector', [CollectorController::class, 'addCollector']);
    Route::post('/add-recyclable', [CollectorController::class, 'addRecyclable']);
    Route::post('/edit-collector-profile', [CollectorController::class, 'editCollectorProfile']);
    Route::post('/delete-recyclable', [CollectorController::class, 'deleteRecyclable']);
    Route::get('/get-unapproved-requests', [CollectorController::class, 'getUnapprovedRequests']);
    Route::get('/get-approved-requests', [CollectorController::class, 'getApprovedRequests']);
    Route::post('/approve-request', [CollectorController::class, 'approveRequest']);
    Route::post('/decline-request', [CollectorController::class, 'declineRequest']);
    Route::get('/get-recyclables', [CollectorController::class, 'getRecyclables']);


});

Route::group(['middleware' => 'business'], function() {
    Route::post('/edit-business', [BusinessController::class, 'editBusiness']);
    Route::post('/add-business', [BusinessController::class, 'addBusiness']);
});

    Route::get('/display-all-collectors', [CollectorController::class, 'displayCollectors']);
    Route::post('/approve-collector', [AuthController::class, 'approveCollector']);
    Route::post('/disapprove-collector', [AuthController::class, 'disapproveCollector']);
    Route::post('/edit-user-profile', [AuthController::class, 'editUserProfile']);
    Route::post('/edit-address', [AddressController::class, 'editAddress']);
    Route::get('/unapproved-collectors', [CollectorController::class, 'getUnapprovedCollectors']);
    Route::post('/request-pickup', [AuthController::class, 'newPickupRequest']);
    Route::get('/my-requests', [AuthController::class, 'getMyRequests']);
    Route::post('/store-token', [AuthController::class, 'storeToken']);
    Route::post('/send-notification', [AuthController::class, 'sendNotification']);
});

