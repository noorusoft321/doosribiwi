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
    Route::get('/login', function () {
        return response()->json([
            'success' => false,
            'message' => 'Access token is not valid, please login & continue.'
        ]);
    })->name('login');
    Route::post('/auth/sign-up', [AuthController::class,'signUp']);
    Route::post('/auth/login', [AuthController::class,'login']);

    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    Route::get('/get-all-data', [HomeController::class,'getAllData']);
    Route::get('/get-states/{countryId?}', [HomeController::class,'getStates']);
    Route::get('/get-cities/{stateId?}', [HomeController::class,'getCities']);
    Route::get('/get-areas/{cityId?}', [HomeController::class, 'getAreas']);
    Route::get('/get-sects/{religionId?}', [HomeController::class,'getSects']);
    Route::get('/get-major-courses/{educationId?}', [HomeController::class,'getMajorCourses']);
    Route::post('/contact-us', [HomeController::class,'contactUs']);
    Route::post('/customer-check-exists', [HomeController::class, 'customerCheckExists']);
    Route::post('/customer-support-message', [HomeController::class, 'customerSupportMessage']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [HomeController::class,'profile']);
        Route::get('/send-confirmation-email', [HomeController::class, 'sendConfirmationEmail']);
        Route::post('/confirm-customer-account', [HomeController::class,'confirmCustomerAccount']);

        Route::get('/get-profile-info', [HomeController::class,'getProfileInfo']);
        Route::post('/update-profile', [HomeController::class,'updateProfile']);

        Route::get('/get-family-information', [HomeController::class,'getFamilyInformation']);
        Route::post('/save-family-information', [HomeController::class,'saveFamilyInformation']);

        Route::get('/get-residence-information', [HomeController::class,'getResidenceInformation']);
        Route::post('/save-residence-information', [HomeController::class,'saveResidenceInformation']);

        Route::get('/get-personal-note', [HomeController::class,'getPersonalNote']);
        Route::post('/save-personal-note', [HomeController::class,'savePersonalNote']);

        Route::get('/get-hobbies-interest', [HomeController::class,'getHobbiesInterest']);
        Route::post('/save-hobbies-interest', [HomeController::class,'saveHobbiesInterest']);

        Route::post('/update-device-token', [HomeController::class,'updateDeviceToken']);
        Route::post('/get-all-customers', [CustomerController::class,'index']);
        Route::get('/get-customer-detail/{customerId}', [CustomerController::class,'customerDetail']);
        Route::get('/customer-like-unlike/{customerId}', [CustomerController::class,'customerLikeUnlike']);
        Route::get('/who-liked-by-me', [CustomerController::class,'whoLikedByMe']);
        Route::get('/who-liked-my-profile', [CustomerController::class,'whoLikedMyProfile']);
        Route::get('/customer-save-remove/{customerId}', [CustomerController::class,'customerSaveRemove']);
        Route::get('/who-saved-by-me', [CustomerController::class,'whoSavedByMe']);
        Route::get('/who-saved-my-profile', [CustomerController::class,'whoSavedMyProfile']);

        /*Messenger*/
        Route::get('/get-messenger-friends', [MessengerController::class, 'index']);
        Route::get('/get-chat-messages/{receiverId}', [MessengerController::class, 'getMessage']);
        Route::post('/send-message', [MessengerController::class, 'sendMessage']);

        /*Customer more detail form*/
        Route::get('/get-education-form', [CustomerController::class, 'getEducationForm']);
        Route::post('/save-education-form', [CustomerController::class, 'saveEducationForm']);

        Route::get('/get-personal-form', [CustomerController::class, 'getPersonalForm']);
        Route::post('/save-personal-form', [CustomerController::class, 'savePersonalForm']);

        Route::get('/get-religion-form', [CustomerController::class, 'getReligionForm']);
        Route::post('/save-religion-form', [CustomerController::class, 'saveReligionForm']);

        Route::get('/get-expectation-form', [CustomerController::class, 'getExpectationForm']);
        Route::post('/save-expectation-form', [CustomerController::class, 'saveExpectationForm']);

        Route::post('/upload-image-form', [CustomerController::class, 'saveUploadImageForm']);

        Route::get('/get-gallery/{customerId?}', [CustomerController::class, 'getGallery']);
        Route::post('/upload-gallery-image-form', [CustomerController::class, 'saveGalleryImageForm']);
        Route::get('/delete-gallery-image/{galleryImageId?}', [CustomerController::class, 'deleteGalleryImage']);

        Route::get('/customer-block-unblock/{customerId}', [CustomerController::class,'customerBlockUnlock']);
        Route::post('/customer-report', [CustomerController::class, 'customerReport']);

        Route::get('/get-block-customers', [CustomerController::class,'getBlockCustomers']);
        Route::get('/get-report-customers', [CustomerController::class,'getReportCustomers']);
        Route::get('/my-matches', [CustomerController::class,'myMatches']);

        Route::get('/get-notifications', [HomeController::class,'getNotifications']);

        Route::post('/save-general-info', [AuthController::class,'saveGeneralInfo']);

        Route::get('/get-packages', [HomeController::class,'getPackages']);

        Route::post('/save-new-email', [HomeController::class, 'saveNewEmail']);
        Route::post('/save-new-password', [HomeController::class, 'saveNewPassword']);

        Route::post('/media-change-status', [HomeController::class, 'mediaChangeStatus']);

        Route::post('/send-notification', [HomeController::class, 'sendNotification']);

        Route::get('/seen-notification/{notificationId}', [HomeController::class, 'seenNotification']);

        Route::post('/customer-buy-package', [HomeController::class, 'customerBuyPackage']);
        Route::get('/purchase-history', [HomeController::class, 'purchaseHistory']);
        Route::get('/payment-check/{orderNo}', [HomeController::class, 'paymentCheck']);
    });

});
