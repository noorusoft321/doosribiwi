<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MessengerController;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['namespace' => 'Api'], function () {
    Route::post('/auth/sign-up', [AuthController::class,'signUp']);
    Route::post('/auth/login', [AuthController::class,'login']);

    Route::get('/get-all-data', [HomeController::class,'getAllData']);
    Route::get('/get-states/{countryId?}', [HomeController::class,'getStates']);
    Route::get('/get-cities/{stateId?}', [HomeController::class,'getCities']);
    Route::get('/get-sects/{religionId?}', [HomeController::class,'getSects']);
    Route::get('/get-major-courses/{educationId?}', [HomeController::class,'getMajorCourses']);
    Route::post('/contact-us', [HomeController::class,'contactUs']);
    Route::post('/customer-check-exists', [HomeController::class, 'customerCheckExists'])->name('customer.check.exists');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [HomeController::class,'profile']);
        Route::get('/get-profile-complete-data', [HomeController::class,'getProfileCompleteData']);
        Route::post('/update-device-token', [HomeController::class,'updateDeviceToken']);
        Route::post('/update-profile', [HomeController::class,'updateProfile']);
        Route::post('/get-all-customers', [CustomerController::class,'index']);
        Route::get('/get-customer-detail/{customerId}', [CustomerController::class,'customerDetail']);
        Route::get('/customer-like-unlike/{customerId}', [CustomerController::class,'customerLikeUnlike']);
        Route::get('/who-liked-by-me', [CustomerController::class,'whoLikedByMe']);
        Route::get('/who-liked-my-profile', [CustomerController::class,'whoLikedMyProfile']);
        Route::get('/customer-save-remove/{customerId}', [CustomerController::class,'customerSaveRemove']);
        Route::get('/get-save-customers', [CustomerController::class,'getSaveCustomers']);
        Route::post('/search-customers', [CustomerController::class,'searchCustomers']);

        /*Messenger*/
        Route::get('/get-messenger-friends/{receiverId?}', [MessengerController::class, 'index'])->name('getMessengerFriends');
        Route::get('/get-chat-messages/{receiverId}', [MessengerController::class, 'getMessage'])->name('getChatMessages');
        Route::post('/send-message', [MessengerController::class, 'sendMessage'])->name('sendMessage');

        /*Firebase notification*/
        Route::get('/test-firebase-notification', [CustomerController::class,'testFirebaseNotification']);

        /*Customer more detail form*/
        Route::post('/save-education-form', [CustomerController::class, 'saveEducationForm'])->name('saveEducationForm');
        Route::post('/save-personal-form', [CustomerController::class, 'savePersonalForm'])->name('savePersonalForm');
        Route::post('/save-religion-form', [CustomerController::class, 'saveReligionForm'])->name('saveReligionForm');
        Route::post('/save-expectation-form', [CustomerController::class, 'saveExpectationForm'])->name('saveExpectationForm');
        Route::post('/upload-image-form', [CustomerController::class, 'saveUploadImageForm'])->name('saveUploadImageForm');
    });

});
