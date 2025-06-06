<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PortalSeoToolController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Bdo\CallCenterController;
use App\Http\Controllers\MatchMaking\MatchCenterController;
use App\Http\Controllers\Front\CustomerAuthController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
//     return redirect()->route('admin.dashboard');
// });
Route::get('/testing-with-db/{genderName?}', function ($genderName = null) {
    $gender = ($genderName=='male') ? 1 : 2;
    $customersCollection = \App\Models\Customer::select(
        'id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'mobile_country_code',
        'email_verified',
        'deleted',
    )->with(['customerOtherInfo' => function($q) use($gender){
        $q->where('gender', $gender);
        $q->where('city_id', 551);
    },])->whereHas('customerOtherInfo', function($q) use($gender){
        $q->where('gender', $gender);
        $q->where('city_id', 551);
    })->where('deleted','=',0)->where('email_verified','=',1)->orderBy('id','desc')->get()->toArray();
    $customers = array_chunk($customersCollection,count($customersCollection)/2);
    return view('customer_list', compact('customers'));
});

//Route::get('/', function () {
//    return redirect()->away('https://doosribiwi.com');
//});

Route::get('/confirm-customer-account/{email}', [CustomerAuthController::class, 'confirmCustomerAccount'])->name('confirm.customer.account');

/* Image preview template */
Route::post('/image-preview-pixelate', [CustomerAuthController::class, 'imagePreviewPixelate'])->name('image.preview.pixelate');

Route::get('/get-states/{countryId?}', [CustomerAuthController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{stateId?}', [CustomerAuthController::class, 'getCities'])->name('get.cities');
Route::get('/get-areas/{cityId?}', [CustomerAuthController::class, 'getAreas'])->name('get.areas');
Route::get('/get-sects/{religionId?}', [CustomerAuthController::class, 'getSects'])->name('get.sects');
Route::get('/get-major-courses/{educationId?}', [CustomerAuthController::class, 'getMajorCourses'])->name('get.major.courses');
Route::post('/customer-check-exists', [CustomerAuthController::class, 'customerCheckExists'])->name('customer.check.exists');

/* Start Admin here */
Route::prefix('shaadi-portal')->group(function () {
    Route::view('/auth-login', 'admin.login')->name('admin.view.login');
    Route::post('/login-process', [AdminController::class, 'loginProcess'])->name('admin.login.process');

    /*Super Admin Middleware*/
    Route::group([ 'middleware' => 'admin.shaadi.auth'], function () {

        /*Login as Customer*/
        Route::get('/login-as-customer/{customerFakerId?}', [AdminController::class, 'loginAsCustomer'])->name('admin.login.as.customer');

        /*Dashboard*/
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        /* Packages */
        Route::get('/packages-get', [PackageController::class, 'getPackages'])->name('admin.get.packages');
        Route::get('/package-detail/{packageId?}', [PackageController::class, 'packageDetail'])->name('admin.package.detail');
        Route::post('/package-save/{packageId?}', [PackageController::class, 'packageSave'])->name('admin.package.save');
        Route::get('/package-delete/{packageId?}', [PackageController::class, 'packageDelete'])->name('admin.package.delete');

        /* Countries */
        Route::get('/countries-get', [SetupController::class, 'getCountries'])->name('admin.get.countries');
        Route::get('/country-detail/{countryId?}', [SetupController::class, 'countryDetail'])->name('admin.country.detail');
        Route::post('/country-save/{countryId?}', [SetupController::class, 'countrySave'])->name('admin.country.save');
        Route::get('/country-delete/{countryId?}', [SetupController::class, 'countryDelete'])->name('admin.country.delete');

        /* States */
        Route::get('/states-get', [SetupController::class, 'getStates'])->name('admin.get.states');
        Route::get('/state-detail/{stateId?}', [SetupController::class, 'stateDetail'])->name('admin.state.detail');
        Route::post('/state-save/{stateId?}', [SetupController::class, 'stateSave'])->name('admin.state.save');
        Route::get('/state-delete/{stateId?}', [SetupController::class, 'stateDelete'])->name('admin.state.delete');

        /* Cities */
        Route::get('/cities-get', [SetupController::class, 'getCities'])->name('admin.get.cities');
        Route::get('/city-detail/{cityId?}', [SetupController::class, 'cityDetail'])->name('admin.city.detail');
        Route::post('/city-save/{cityId?}', [SetupController::class, 'citySave'])->name('admin.city.save');
        Route::get('/city-delete/{cityId?}', [SetupController::class, 'cityDelete'])->name('admin.city.delete');

        /* Religions */
        Route::get('/religions-get', [SetupController::class, 'getReligions'])->name('admin.get.religions');
        Route::get('/religion-detail/{religionId?}', [SetupController::class, 'religionDetail'])->name('admin.religion.detail');
        Route::post('/religion-save/{religionId?}', [SetupController::class, 'religionSave'])->name('admin.religion.save');
        Route::get('/religion-delete/{religionId?}', [SetupController::class, 'religionDelete'])->name('admin.religion.delete');

        /* Sects */
        Route::get('/sects-get', [SetupController::class, 'getSects'])->name('admin.get.sects');
        Route::get('/sect-detail/{sectId?}', [SetupController::class, 'sectDetail'])->name('admin.sect.detail');
        Route::post('/sect-save/{sectId?}', [SetupController::class, 'sectSave'])->name('admin.sect.save');
        Route::get('/sect-delete/{sectId?}', [SetupController::class, 'sectDelete'])->name('admin.sect.delete');

        /* Castes */
        Route::get('/castes-get', [SetupController::class, 'getCastes'])->name('admin.get.castes');
        Route::get('/caste-detail/{casteId?}', [SetupController::class, 'casteDetail'])->name('admin.caste.detail');
        Route::post('/caste-save/{casteId?}', [SetupController::class, 'casteSave'])->name('admin.caste.save');
        Route::get('/caste-delete/{casteId?}', [SetupController::class, 'casteDelete'])->name('admin.caste.delete');

        /* MaritalStatuses */
        Route::get('/marital-statuses-get', [SetupController::class, 'getMaritalStatuses'])->name('admin.get.maritalStatuses');
        Route::get('/marital-status-detail/{maritalStatusId?}', [SetupController::class, 'maritalStatusDetail'])->name('admin.maritalStatus.detail');
        Route::post('/marital-status-save/{maritalStatusId?}', [SetupController::class, 'maritalStatusSave'])->name('admin.maritalStatus.save');
        Route::get('/marital-status-delete/{maritalStatusId?}', [SetupController::class, 'maritalStatusDelete'])->name('admin.maritalStatus.delete');

        /* HobbiesInterests */
        Route::get('/hobbies-interests-get', [SetupController::class, 'getHobbiesInterests'])->name('admin.get.hobbiesInterests');
        Route::get('/hobbies-interest-detail/{hobbiesInterestId?}', [SetupController::class, 'hobbiesInterestDetail'])->name('admin.hobbiesInterest.detail');
        Route::post('/hobbies-interest-save/{hobbiesInterestId?}', [SetupController::class, 'hobbiesInterestSave'])->name('admin.hobbiesInterest.save');
        Route::get('/hobbies-interest-delete/{hobbiesInterestId?}', [SetupController::class, 'hobbiesInterestDelete'])->name('admin.hobbiesInterest.delete');

        /* OnBehalfs */
        Route::get('/on-behalfs-get', [SetupController::class, 'getOnBehalfs'])->name('admin.get.onBehalfs');
        Route::get('/on-behalf-detail/{onBehalfId?}', [SetupController::class, 'onBehalfDetail'])->name('admin.onBehalf.detail');
        Route::post('/on-behalf-save/{onBehalfId?}', [SetupController::class, 'onBehalfSave'])->name('admin.onBehalf.save');
        Route::get('/on-behalf-delete/{onBehalfId?}', [SetupController::class, 'onBehalfDelete'])->name('admin.onBehalf.delete');

        /* MotherTongues */
        Route::get('/mother-tongues-get', [SetupController::class, 'getMotherTongues'])->name('admin.get.motherTongues');
        Route::get('/mother-tongue-detail/{motherTongueId?}', [SetupController::class, 'motherTongueDetail'])->name('admin.motherTongue.detail');
        Route::post('/mother-tongue-save/{motherTongueId?}', [SetupController::class, 'motherTongueSave'])->name('admin.motherTongue.save');
        Route::get('/mother-tongue-delete/{motherTongueId?}', [SetupController::class, 'motherTongueDelete'])->name('admin.motherTongue.delete');

        /* FamilyValues */
        Route::get('/family-values-get', [SetupController::class, 'getFamilyValues'])->name('admin.get.familyValues');
        Route::get('/family-value-detail/{familyValueId?}', [SetupController::class, 'familyValueDetail'])->name('admin.familyValue.detail');
        Route::post('/family-value-save/{familyValueId?}', [SetupController::class, 'familyValueSave'])->name('admin.familyValue.save');
        Route::get('/family-value-delete/{familyValueId?}', [SetupController::class, 'familyValueDelete'])->name('admin.familyValue.delete');

        /* Educations */
        Route::get('/educations-get', [SetupController::class, 'getEducations'])->name('admin.get.educations');
        Route::get('/education-detail/{educationId?}', [SetupController::class, 'educationDetail'])->name('admin.education.detail');
        Route::post('/education-save/{educationId?}', [SetupController::class, 'educationSave'])->name('admin.education.save');
        Route::get('/education-delete/{educationId?}', [SetupController::class, 'educationDelete'])->name('admin.education.delete');

        /* Occupations */
        Route::get('/occupations-get', [SetupController::class, 'getOccupations'])->name('admin.get.occupations');
        Route::get('/occupation-detail/{occupationId?}', [SetupController::class, 'occupationDetail'])->name('admin.occupation.detail');
        Route::post('/occupation-save/{occupationId?}', [SetupController::class, 'occupationSave'])->name('admin.occupation.save');
        Route::get('/occupation-delete/{occupationId?}', [SetupController::class, 'occupationDelete'])->name('admin.occupation.delete');

        /* MonthlyInComes */
        Route::get('/monthly-incomes-get', [SetupController::class, 'getMonthlyInComes'])->name('admin.get.monthlyInComes');
        Route::get('/monthly-income-detail/{monthlyInComeId?}', [SetupController::class, 'monthlyInComeDetail'])->name('admin.monthlyInCome.detail');
        Route::post('/monthly-income-save/{monthlyInComeId?}', [SetupController::class, 'monthlyInComeSave'])->name('admin.monthlyInCome.save');
        Route::get('/monthly-income-delete/{monthlyInComeId?}', [SetupController::class, 'monthlyInComeDelete'])->name('admin.monthlyInCome.delete');

        /* Complexions */
        Route::get('/complexions-get', [SetupController::class, 'getComplexions'])->name('admin.get.complexions');
        Route::get('/complexion-detail/{complexionId?}', [SetupController::class, 'complexionDetail'])->name('admin.complexion.detail');
        Route::post('/complexion-save/{complexionId?}', [SetupController::class, 'complexionSave'])->name('admin.complexion.save');
        Route::get('/complexion-delete/{complexionId?}', [SetupController::class, 'complexionDelete'])->name('admin.complexion.delete');

        /* Disabilities */
        Route::get('/disabilities-get', [SetupController::class, 'getDisabilities'])->name('admin.get.disabilities');
        Route::get('/disability-detail/{disabilityId?}', [SetupController::class, 'disabilityDetail'])->name('admin.disability.detail');
        Route::post('/disability-save/{disabilityId?}', [SetupController::class, 'disabilitySave'])->name('admin.disability.save');
        Route::get('/disability-delete/{disabilityId?}', [SetupController::class, 'disabilityDelete'])->name('admin.disability.delete');

        /* WhereDidYouHearAbouts */
        Route::get('/where-did-you-hear-abouts-get', [SetupController::class, 'getWhereDidYouHearAbouts'])->name('admin.get.whereDidYouHearAbouts');
        Route::get('/where-did-you-hear-about-detail/{whereDidYouHearAboutId?}', [SetupController::class, 'whereDidYouHearAboutDetail'])->name('admin.whereDidYouHearAbout.detail');
        Route::post('/where-did-you-hear-about-save/{whereDidYouHearAboutId?}', [SetupController::class, 'whereDidYouHearAboutSave'])->name('admin.whereDidYouHearAbout.save');
        Route::get('/where-did-you-hear-about-delete/{whereDidYouHearAboutId?}', [SetupController::class, 'whereDidYouHearAboutDelete'])->name('admin.whereDidYouHearAbout.delete');

        /* RegistrationsReasons */
        Route::get('/registrations-reasons-get', [SetupController::class, 'getRegistrationsReasons'])->name('admin.get.registrationsReasons');
        Route::get('/registrations-reason-detail/{registrationsReasonId?}', [SetupController::class, 'registrationsReasonDetail'])->name('admin.registrationsReason.detail');
        Route::post('/registrations-reason-save/{registrationsReasonId?}', [SetupController::class, 'registrationsReasonSave'])->name('admin.registrationsReason.save');
        Route::get('/registrations-reason-delete/{registrationsReasonId?}', [SetupController::class, 'registrationsReasonDelete'])->name('admin.registrationsReason.delete');

        /* Heights */
        Route::get('/heights-get', [SetupController::class, 'getHeights'])->name('admin.get.heights');
        Route::get('/height-detail/{heightId?}', [SetupController::class, 'heightDetail'])->name('admin.height.detail');
        Route::post('/height-save/{heightId?}', [SetupController::class, 'heightSave'])->name('admin.height.save');
        Route::get('/height-delete/{heightId?}', [SetupController::class, 'heightDelete'])->name('admin.height.delete');

        /* Weights */
        Route::get('/weights-get', [SetupController::class, 'getWeights'])->name('admin.get.weights');
        Route::get('/weight-detail/{weightId?}', [SetupController::class, 'weightDetail'])->name('admin.weight.detail');
        Route::post('/weight-save/{weightId?}', [SetupController::class, 'weightSave'])->name('admin.weight.save');
        Route::get('/weight-delete/{weightId?}', [SetupController::class, 'weightDelete'])->name('admin.weight.delete');

        /* Universities */
        Route::get('/universities-get', [SetupController::class, 'getUniversities'])->name('admin.get.universities');
        Route::get('/university-detail/{universityId?}', [SetupController::class, 'universityDetail'])->name('admin.university.detail');
        Route::post('/university-save/{universityId?}', [SetupController::class, 'universitySave'])->name('admin.university.save');
        Route::get('/university-delete/{universityId?}', [SetupController::class, 'universityDelete'])->name('admin.university.delete');

        /* ResidenceStatuses */
        Route::get('/residence-statuses-get', [SetupController::class, 'getResidenceStatuses'])->name('admin.get.residenceStatuses');
        Route::get('/residence-status-detail/{residenceStatusId?}', [SetupController::class, 'residenceStatusDetail'])->name('admin.residenceStatus.detail');
        Route::post('/residence-status-save/{residenceStatusId?}', [SetupController::class, 'residenceStatusSave'])->name('admin.residenceStatus.save');
        Route::get('/residence-status-delete/{residenceStatusId?}', [SetupController::class, 'residenceStatusDelete'])->name('admin.residenceStatus.delete');

        /* HouseSizes */
        Route::get('/house-sizes-get', [SetupController::class, 'getHouseSizes'])->name('admin.get.houseSizes');
        Route::get('/house-size-detail/{houseSizeId?}', [SetupController::class, 'houseSizeDetail'])->name('admin.houseSize.detail');
        Route::post('/house-size-save/{houseSizeId?}', [SetupController::class, 'houseSizeSave'])->name('admin.houseSize.save');
        Route::get('/house-size-delete/{houseSizeId?}', [SetupController::class, 'houseSizeDelete'])->name('admin.houseSize.delete');

        /* ResidenceArea */
        Route::get('/residence-areas-get', [SetupController::class, 'getResidenceAreas'])->name('admin.get.residenceAreas');
        Route::get('/residence-area-detail/{residenceAreaId?}', [SetupController::class, 'residenceAreaDetail'])->name('admin.residenceArea.detail');
        Route::post('/residence-area-save/{residenceAreaId?}', [SetupController::class, 'residenceAreaSave'])->name('admin.residenceArea.save');
        Route::get('/residence-area-delete/{residenceAreaId?}', [SetupController::class, 'residenceAreaDelete'])->name('admin.residenceArea.delete');

        /* JobPost */
        Route::get('/job-posts-get', [SetupController::class, 'getJobPosts'])->name('admin.get.jobPosts');
        Route::get('/job-post-detail/{jobPostId?}', [SetupController::class, 'jobPostDetail'])->name('admin.jobPost.detail');
        Route::post('/job-post-save/{jobPostId?}', [SetupController::class, 'jobPostSave'])->name('admin.jobPost.save');
        Route::get('/job-post-delete/{jobPostId?}', [SetupController::class, 'jobPostDelete'])->name('admin.jobPost.delete');

        /* FuturePlans */
        Route::get('/future-plans-get', [SetupController::class, 'getFuturePlans'])->name('admin.get.futurePlans');
        Route::get('/future-plan-detail/{futurePlanId?}', [SetupController::class, 'futurePlanDetail'])->name('admin.futurePlan.detail');
        Route::post('/future-plan-save/{futurePlanId?}', [SetupController::class, 'futurePlanSave'])->name('admin.futurePlan.save');
        Route::get('/future-plan-delete/{futurePlanId?}', [SetupController::class, 'futurePlanDelete'])->name('admin.futurePlan.delete');

        /* EyeColors */
        Route::get('/eye-colors-get', [SetupController::class, 'getEyeColors'])->name('admin.get.eyeColors');
        Route::get('/eye-color-detail/{eyeColorId?}', [SetupController::class, 'eyeColorDetail'])->name('admin.eyeColor.detail');
        Route::post('/eye-color-save/{eyeColorId?}', [SetupController::class, 'eyeColorSave'])->name('admin.eyeColor.save');
        Route::get('/eye-color-delete/{eyeColorId?}', [SetupController::class, 'eyeColorDelete'])->name('admin.eyeColor.delete');

        /* HairColors */
        Route::get('/hair-colors-get', [SetupController::class, 'getHairColors'])->name('admin.get.hairColors');
        Route::get('/hair-color-detail/{hairColorId?}', [SetupController::class, 'hairColorDetail'])->name('admin.hairColor.detail');
        Route::post('/hair-color-save/{hairColorId?}', [SetupController::class, 'hairColorSave'])->name('admin.hairColor.save');
        Route::get('/hair-color-delete/{hairColorId?}', [SetupController::class, 'hairColorDelete'])->name('admin.hairColor.delete');

        /* Smokes */
        Route::get('/smokes-get', [SetupController::class, 'getSmokes'])->name('admin.get.smokes');
        Route::get('/smoke-detail/{smokeId?}', [SetupController::class, 'smokeDetail'])->name('admin.smoke.detail');
        Route::post('/smoke-save/{smokeId?}', [SetupController::class, 'smokeSave'])->name('admin.smoke.save');
        Route::get('/smoke-delete/{smokeId?}', [SetupController::class, 'smokeDelete'])->name('admin.smoke.delete');

        /* Drinks */
        Route::get('/drinks-get', [SetupController::class, 'getDrinks'])->name('admin.get.drinks');
        Route::get('/drink-detail/{drinkId?}', [SetupController::class, 'drinkDetail'])->name('admin.drink.detail');
        Route::post('/drink-save/{drinkId?}', [SetupController::class, 'drinkSave'])->name('admin.drink.save');
        Route::get('/drink-delete/{drinkId?}', [SetupController::class, 'drinkDelete'])->name('admin.drink.delete');

        /* DoYouPreferHijabs */
        Route::get('/do-you-prefer-hijabs-get', [SetupController::class, 'getDoYouPreferHijabs'])->name('admin.get.doYouPreferHijabs');
        Route::get('/do-you-prefer-hijab-detail/{doYouPreferHijabId?}', [SetupController::class, 'doYouPreferHijabDetail'])->name('admin.doYouPreferHijab.detail');
        Route::post('/do-you-prefer-hijab-save/{doYouPreferHijabId?}', [SetupController::class, 'doYouPreferHijabSave'])->name('admin.doYouPreferHijab.save');
        Route::get('/do-you-prefer-hijab-delete/{doYouPreferHijabId?}', [SetupController::class, 'doYouPreferHijabDelete'])->name('admin.doYouPreferHijab.delete');

        /* DoYouHaveBeards */
        Route::get('/do-you-have-beards-get', [SetupController::class, 'getDoYouHaveBeards'])->name('admin.get.doYouHaveBeards');
        Route::get('/do-you-have-beard-detail/{doYouHaveBeardId?}', [SetupController::class, 'doYouHaveBeardDetail'])->name('admin.doYouHaveBeard.detail');
        Route::post('/do-you-have-beard-save/{doYouHaveBeardId?}', [SetupController::class, 'doYouHaveBeardSave'])->name('admin.doYouHaveBeard.save');
        Route::get('/do-you-have-beard-delete/{doYouHaveBeardId?}', [SetupController::class, 'doYouHaveBeardDelete'])->name('admin.doYouHaveBeard.delete');

        /* AreYouReverts */
        Route::get('/are-you-reverts-get', [SetupController::class, 'getAreYouReverts'])->name('admin.get.areYouReverts');
        Route::get('/are-you-revert-detail/{areYouRevertId?}', [SetupController::class, 'areYouRevertDetail'])->name('admin.areYouRevert.detail');
        Route::post('/are-you-revert-save/{areYouRevertId?}', [SetupController::class, 'areYouRevertSave'])->name('admin.areYouRevert.save');
        Route::get('/are-you-revert-delete/{areYouRevertId?}', [SetupController::class, 'areYouRevertDelete'])->name('admin.areYouRevert.delete');

        /* DoYouKeepHalals */
        Route::get('/doYouKeepHalals-get', [SetupController::class, 'getDoYouKeepHalals'])->name('admin.get.doYouKeepHalals');
        Route::get('/doYouKeepHalal-detail/{doYouKeepHalalId?}', [SetupController::class, 'doYouKeepHalalDetail'])->name('admin.doYouKeepHalal.detail');
        Route::post('/doYouKeepHalal-save/{doYouKeepHalalId?}', [SetupController::class, 'doYouKeepHalalSave'])->name('admin.doYouKeepHalal.save');
        Route::get('/doYouKeepHalal-delete/{doYouKeepHalalId?}', [SetupController::class, 'doYouKeepHalalDelete'])->name('admin.doYouKeepHalal.delete');

        /* DoYouPerformSalaahs */
        Route::get('/doYouPerformSalaahs-get', [SetupController::class, 'getDoYouPerformSalaahs'])->name('admin.get.doYouPerformSalaahs');
        Route::get('/doYouPerformSalaah-detail/{doYouPerformSalaahId?}', [SetupController::class, 'doYouPerformSalaahDetail'])->name('admin.doYouPerformSalaah.detail');
        Route::post('/doYouPerformSalaah-save/{doYouPerformSalaahId?}', [SetupController::class, 'doYouPerformSalaahSave'])->name('admin.doYouPerformSalaah.save');
        Route::get('/doYouPerformSalaah-delete/{doYouPerformSalaahId?}', [SetupController::class, 'doYouPerformSalaahDelete'])->name('admin.doYouPerformSalaah.delete');

        /* WillingToRelocates */
        Route::get('/willingToRelocates-get', [SetupController::class, 'getWillingToRelocates'])->name('admin.get.willingToRelocates');
        Route::get('/willingToRelocate-detail/{willingToRelocateId?}', [SetupController::class, 'willingToRelocateDetail'])->name('admin.willingToRelocate.detail');
        Route::post('/willingToRelocate-save/{willingToRelocateId?}', [SetupController::class, 'willingToRelocateSave'])->name('admin.willingToRelocate.save');
        Route::get('/willingToRelocate-delete/{willingToRelocateId?}', [SetupController::class, 'willingToRelocateDelete'])->name('admin.willingToRelocate.delete');

        /* IAmLookingToMarries */
        Route::get('/iAmLookingToMarries-get', [SetupController::class, 'getIAmLookingToMarries'])->name('admin.get.iAmLookingToMarries');
        Route::get('/iAmLookingToMarry-detail/{iAmLookingToMarryId?}', [SetupController::class, 'iAmLookingToMarryDetail'])->name('admin.iAmLookingToMarry.detail');
        Route::post('/iAmLookingToMarry-save/{iAmLookingToMarryId?}', [SetupController::class, 'iAmLookingToMarrySave'])->name('admin.iAmLookingToMarry.save');
        Route::get('/iAmLookingToMarry-delete/{iAmLookingToMarryId?}', [SetupController::class, 'iAmLookingToMarryDelete'])->name('admin.iAmLookingToMarry.delete');

        /* MyLivingArrangements */
        Route::get('/myLivingArrangements-get', [SetupController::class, 'getMyLivingArrangements'])->name('admin.get.myLivingArrangements');
        Route::get('/myLivingArrangement-detail/{myLivingArrangementId?}', [SetupController::class, 'myLivingArrangementDetail'])->name('admin.myLivingArrangement.detail');
        Route::post('/myLivingArrangement-save/{myLivingArrangementId?}', [SetupController::class, 'myLivingArrangementSave'])->name('admin.myLivingArrangement.save');
        Route::get('/myLivingArrangement-delete/{myLivingArrangementId?}', [SetupController::class, 'myLivingArrangementDelete'])->name('admin.myLivingArrangement.delete');

        /* MyBuilds */
        Route::get('/myBuilds-get', [SetupController::class, 'getMyBuilds'])->name('admin.get.myBuilds');
        Route::get('/myBuild-detail/{myBuildId?}', [SetupController::class, 'myBuildDetail'])->name('admin.myBuild.detail');
        Route::post('/myBuild-save/{myBuildId?}', [SetupController::class, 'myBuildSave'])->name('admin.myBuild.save');
        Route::get('/myBuild-delete/{myBuildId?}', [SetupController::class, 'myBuildDelete'])->name('admin.myBuild.delete');

        /* Blogs & Categories */
        /*Route::get('/categories-get', [BlogController::class, 'getCategories'])->name('admin.get.categories');
        Route::get('/category-detail/{categoryId?}', [BlogController::class, 'categoryDetail'])->name('admin.category.detail');
        Route::post('/category-save/{categoryId?}', [BlogController::class, 'categorySave'])->name('admin.category.save');
        Route::get('/category-delete/{categoryId?}', [BlogController::class, 'categoryDelete'])->name('admin.category.delete');

        Route::get('/blogs-get', [BlogController::class, 'getBlogs'])->name('admin.get.blogs');
        Route::get('/add-edit-blog/{blogId?}', [BlogController::class, 'addEditBlog'])->name('admin.addEdit.blog');
        Route::get('/blog-delete/{blogId?}', [BlogController::class, 'blogDelete'])->name('admin.blog.delete');
        Route::post('/blog-save/{blogId?}', [BlogController::class, 'blogSave'])->name('admin.blog.save');*/

        /* User Setting */
        Route::get('/users-get', [UserController::class, 'getUsers'])->name('admin.get.users');
        Route::get('/user-detail/{userId?}', [UserController::class, 'userDetail'])->name('admin.user.detail');
        Route::post('/user-save/{userId?}', [UserController::class, 'userSave'])->name('admin.user.save');
        Route::get('/user-delete/{userId?}', [UserController::class, 'userDelete'])->name('admin.user.delete');

        Route::get('/get-roles', [RoleController::class, 'getRoles'])->name('admin.get.roles');
        Route::post('/role-save/{roleId?}', [RoleController::class, 'roleSave'])->name('admin.role.save');
        Route::get('/role-delete/{roleId?}', [RoleController::class, 'roleDelete'])->name('admin.role.delete');

        Route::get('/get-routes', [RoleController::class, 'getRoutes'])->name('admin.get.routes');
        Route::get('/route-detail/{routeId?}', [RoleController::class, 'routeDetail'])->name('admin.route.detail');
        Route::post('/route-save/{routeId?}', [RoleController::class, 'routeSave'])->name('admin.route.save');
        Route::get('/route-delete/{routeId?}', [RoleController::class, 'routeDelete'])->name('admin.route.delete');

        Route::get('/get-permissions', [RoleController::class, 'getPermissions'])->name('admin.get.permissions');
        Route::post('/get-related-permissions', [RoleController::class, 'getRelatedPermissions'])->name('admin.get.related.permissions');
        Route::post('/save-permissions', [RoleController::class, 'savePermissions'])->name('admin.save.permissions');

        /* Customers */
        Route::get('/customers-get/{fromToData?}', [CustomerController::class, 'getCustomers'])->name('admin.get.customers');
        Route::get('/get-filters-customers', [CustomerController::class, 'getFiltersCustomers'])->name('admin.get.filters.customers');
        Route::post('/change-customer-status', [CustomerController::class, 'changeCustomerStatus'])->name('admin.change.customer.status');
        Route::get('/get-customer-detail/{customerId?}', [CustomerController::class, 'getCustomerDetail'])->name('admin.get.customer.detail');
        Route::post('/save-customer-badges/{customerId?}', [CustomerController::class, 'saveCustomerBadges'])->name('admin.save.customer.badges');
        Route::get('/delete-customer/{customerId?}', [CustomerController::class, 'deleteCustomer'])->name('admin.delete.customer');
        Route::post('/personal-note-save', [CustomerController::class, 'personalNoteSave'])->name('admin.personal.note.save');
        Route::post('/customer-package-save', [CustomerController::class, 'customerPackageSave'])->name('admin.customer.package.save');
        Route::get('/add-edit-customer/{customerId?}', [CustomerController::class, 'addEditCustomer'])->name('admin.add.edit.customer');
        Route::post('/create-update-customer/{customerId?}', [CustomerController::class, 'createUpdateCustomer'])->name('admin.create.update.customer');
        Route::post('/admin-customer-gallery-photos-save', [CustomerController::class, 'galleryPhotosSave'])->name('admin.gallery.photos.save');
        Route::post('/admin-customer-delete-photo', [CustomerController::class, 'deletePhoto'])->name('admin.gallery.delete.photo');
        Route::post('/admin-change-profile-blur', [CustomerController::class, 'changeProfileBlur'])->name('admin.change.profile.blur');
        /*Block Customers*/
        Route::get('/get-all-block-customers', [CustomerController::class, 'getAllBlockCustomers'])->name('admin.get.all.block.customers');
        /*Report Customers*/
        Route::get('/get-all-report-customers', [CustomerController::class, 'getAllReportCustomers'])->name('admin.get.all.report.customers');
        /* Customers Messages */
        Route::get('/get-all-customers-messages', [CustomerController::class, 'getAllCustomersMessages'])->name('admin.get.all.customers.messages');

        /* Portal seo tools */
        Route::get('/customer-portal-seo-tool', [PortalSeoToolController::class, 'index'])->name('admin.customer.portal.seo.tool');
        Route::get('/add-edit-seo-tool/{id?}', [PortalSeoToolController::class, 'addEditSeoTool'])->name('add.edit.portal.seo.tool');
        Route::post('/admin-fetch-seo-related-images', [PortalSeoToolController::class, 'fetchSeoRelatedImages'])->name('admin.fetch.seo.related.images');
        Route::post('/admin-seo-photos-save', [PortalSeoToolController::class, 'seoPhotosSave'])->name('admin.seo.photos.save');
        Route::post('/create-update-seo-tool/{id?}', [PortalSeoToolController::class, 'createUpdateSeoTool'])->name('admin.create.update.portal.seo.tool');
        Route::get('/delete-seo-tool/{id?}', [PortalSeoToolController::class, 'deleteSeoTool'])->name('admin.delete.seo.tool');

        /*Optimize clear*/
        Route::get('/optimize-clear-all', function () {
            Artisan::call('optimize:clear');
            return redirect()->back();
        })->name('optimize.clear.all');

    });

    /*Logout*/
    Route::get('/logout-process', [AdminController::class, 'logoutProcess'])->name('admin.logout.process');
    Route::get('/view-user-profile', [AdminController::class, 'viewProfile'])->name('admin.view.profile');
    Route::post('/admin-save-new-password', [AdminController::class, 'adminSaveNewPassword'])->name('admin.save.new.password');
});
/* Call center / BDO middleware */
Route::get('/bdo-portal', [CallCenterController::class, 'index'])->name('bdo.decider');
Route::prefix('bdo-portal')->group(function () {

    Route::get('/auth-login', [CallCenterController::class, 'loginView'])->name('bdo.view.login');
    Route::post('/login-process', [CallCenterController::class, 'loginProcess'])->name('bdo.login.process');

    Route::group([ 'middleware' => 'call.center.shaadi.auth'], function () {
        Route::get('/customers-center', [CallCenterController::class, 'getCustomers'])->name('bdo.get.customers.center');
        Route::get('/customers-manage', [CallCenterController::class, 'getCustomersManage'])->name('bdo.get.customers.manage');
        Route::get('/get-customer-center-detail/{customerId?}', [CallCenterController::class, 'getCustomerDetail'])->name('bdo.get.customer.center.detail');
        Route::post('/customers-assign', [CallCenterController::class, 'customersAssign'])->name('bdo.customers.assign');
        Route::post('/customers-request', [CallCenterController::class, 'customersRequest'])->name('bdo.customers.request');
        Route::post('/save-call-history', [CallCenterController::class, 'saveCallHistory'])->name('bdo.save.call.history');
        Route::post('/save-customer-other-status', [CallCenterController::class, 'saveCustomerOtherStatus'])->name('bdo.save.customer.other.status');

        Route::post('/bdo-customer-profile-image-save', [CallCenterController::class, 'profileImageSave'])->name('bdo.profile.image.save');
        Route::post('/bdo-customer-gallery-photos-save', [CallCenterController::class, 'galleryPhotosSave'])->name('bdo.gallery.photos.save');
        Route::post('/bdo-customer-delete-photo', [CustomerAuthController::class, 'deletePhoto'])->name('bdo.gallery.delete.photo');

        /* Support */
        Route::get('/get-support', [CallCenterController::class, 'getSupport'])->name('bdo.get.support');
        Route::get('/get-support-detail/{id?}', [CallCenterController::class, 'getSupportDetail'])->name('bdo.get.support.detail');
        Route::post('/support-status', [CallCenterController::class, 'supportStatus'])->name('bdo.support.status');
        Route::post('/save-support-history', [CallCenterController::class, 'saveSupportHistory'])->name('bdo.save.support.history');

        /* Support */
        Route::get('/get-package-request', [CallCenterController::class, 'getPackageRequest'])->name('bdo.get.package.request');
        Route::get('/package-request-delete/{id?}', [CallCenterController::class, 'packageRequestDelete'])->name('bdo.package.request.delete');
        Route::get('/add-new-package-request', [CallCenterController::class, 'newPackageRequest'])->name('bdo.new.package.request');
        Route::post('/fetch-customer', [CallCenterController::class, 'fetchCustomer'])->name('bdo.fetch.customer');
        Route::post('/save-package-request', [CallCenterController::class, 'savePackageRequest'])->name('bdo.save.package.request');

        Route::post('/save-customer-badges/{customerId?}', [CallCenterController::class, 'saveCustomerBadges'])->name('bdo.save.customer.badges');

    });
    Route::get('/logout-process', [CallCenterController::class, 'logoutProcess'])->name('bdo.logout.process');
});

Route::post('/get-media-package-request', [CallCenterController::class, 'getMediaPackageRequest'])->name('get.media.package.request');
Route::post('/save-media-package-request', [CallCenterController::class, 'saveMediaPackageRequest'])->name('save.media.package.request');
Route::post('/delete-media-package-request', [CallCenterController::class, 'deleteMediaPackageRequest'])->name('delete.media.package.request');

/* Match Maker / Match Maker middleware */
Route::get('/match-portal', [MatchCenterController::class, 'index'])->name('match.decider');
Route::prefix('match-portal')->group(function () {
    Route::get('/auth-login', [MatchCenterController::class, 'loginView'])->name('match.view.login');
    Route::post('/login-process', [MatchCenterController::class, 'loginProcess'])->name('match.login.process');

    Route::group([ 'middleware' => 'match.center.shaadi.auth'], function () {
        Route::get('/all-customers', [MatchCenterController::class, 'allCustomers'])->name('match.get.all.customers');
        Route::get('/customers-center', [MatchCenterController::class, 'getCustomers'])->name('match.get.customers.center');
        Route::get('/get-customer-center-detail/{customerId?}', [MatchCenterController::class, 'getCustomerDetail'])->name('match.get.customer.center.detail');
        Route::post('/customers-assign', [MatchCenterController::class, 'customersAssign'])->name('match.customers.assign');
        Route::post('/save-call-history', [MatchCenterController::class, 'saveCallHistory'])->name('match.save.call.history');
    });
    Route::get('/logout-process', [MatchCenterController::class, 'logoutProcess'])->name('match.logout.process');
});
