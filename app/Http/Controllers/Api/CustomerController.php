<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnnualInCome;
use App\Models\AreYouRevert;
use App\Models\Caste;
use App\Models\Complexion;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerBlock;
use App\Models\CustomerCareerInfo;
use App\Models\CustomerImage;
use App\Models\CustomerLike;
use App\Models\CustomerOtherInfo;
use App\Models\CustomerPersonalInfo;
use App\Models\CustomerProfileView;
use App\Models\CustomerReligionInfo;
use App\Models\CustomerReport;
use App\Models\CustomerSaved;
use App\Models\CustomerSearch;
use App\Models\Disability;
use App\Models\DoYouHaveBeard;
use App\Models\DoYouKeepHalal;
use App\Models\DoYouPerformSalaah;
use App\Models\DoYouPreferHijab;
use App\Models\Education;
use App\Models\EyeColor;
use App\Models\FuturePlan;
use App\Models\HairColor;
use App\Models\Height;
use App\Models\HobbiesAndInterest;
use App\Models\IAmLookingToMarry;
use App\Models\JobPost;
use App\Models\MaritalStatus;
use App\Models\MotherTongue;
use App\Models\MyBuild;
use App\Models\MyLivingArrangement;
use App\Models\Occupation;
use App\Models\Religion;
use App\Models\Smoke;
use App\Models\University;
use App\Models\Weight;
use App\Models\WillingToRelocate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;

class CustomerController extends Controller
{

    public function index()
    {
        $request = request()->all();
        $skipProposals = (isset($request['page']) && $request['page'] > 0) ? ($request['page']-1) * 6 : 0;
        $currentUserGenderExp = '';
        $currentAuthId = '';
        if (isset($request['gender']) && !empty($request['gender'])) {
            $currentUserGenderExp = $request['gender'];
        } else {
            if (auth()->check()) {
                $currentUserGenderExp = (auth()->user()->gender_name=='Female') ? '1' : '2';
                $currentAuthId = auth()->id();
            }
        }

        $customers = Customer::select(
            'id',
            'first_name',
            'last_name',
            'name',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'featuredProfile',
            'email_verified',
            'mobile_verified',
            'profile_pic_status',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification',
            'salary_verification',
            'user_package',
            'user_package_color',
            'profile_status',
            'deleted',
            'is_highlight'
        )->with([
            'customerLikeByMe',
            'getCountryName',
            'getCitiesName',
            'getMaritalStatusName',
            'getHeightName',
            'customerOtherInfo' => function($q) use($request, $currentUserGenderExp){
                if (!empty($currentUserGenderExp)) {
                    $q->where('gender', $currentUserGenderExp);
                }
                if (!empty($request['ageFrom']) && !empty($request['ageTo'])) {
                    $q->whereBetween('age', [$request['ageFrom'], $request['ageTo']]);
                } elseif (!empty($request['ageFrom'])) {
                    $q->where('age', '>=', $request['ageFrom']);
                } elseif (!empty($request['ageTo'])) {
                    $q->where('age', '<=', $request['ageTo']);
                }
                if (!empty($request['countryId'])) {
                    $q->where('country_id', $request['countryId']);
                }
                if (!empty($request['stateId'])) {
                    $q->where('state_id', $request['stateId']);
                }
                if (!empty($request['cityId'])) {
                    $q->where('city_id', $request['cityId']);
                }
                if (!empty($request['tongueId'])) {
                    $q->where('MyFirstLanguageMotherTonguesID', $request['tongueId']);
                }
            },
            'customerReligionInfo' => function($q) use ($request) {
                if (!empty($request['religionId'])) {
                    $q->where('Religions', $request['religionId']);
                }
                if (!empty($request['sectId'])) {
                    $q->where('Sects', $request['sectId']);
                }
            },
            'customerCareerInfo' => function($q) use ($request) {
                if (!empty($request['qualificationId'])) {
                    $q->where('Qualification', $request['qualificationId']);
                }
                if (!empty($request['professionId'])) {
                    $q->where('Profession', $request['professionId']);
                }
                if (!empty($request['incomeId'])) {
                    $q->where('MonthlyIncome', $request['incomeId']);
                }
            },
            'customerPersonalInfo' => function($q) use ($request) {
                if (!empty($request['casteId'])) {
                    $q->where('Caste', $request['casteId']);
                }
                if (!empty($request['livingArrangementId'])) {
                    $q->where('MyLivingArrangements', $request['livingArrangementId']);
                }
                if (!empty($request['heightId'])) {
                    $q->where('Heights', $request['heightId']);
                }
                if (!empty($request['disabilityId'])) {
                    $q->where('Disabilities', $request['disabilityId']);
                }
            }
        ]);

        if (isset($currentUserGenderExp) ||
            isset($request['ageFrom']) ||
            isset($request['ageTo']) ||
            isset($request['maritalStatusId']) ||
            isset($request['countryId']) ||
            isset($request['stateId']) ||
            isset($request['cityId']) ||
            isset($request['tongueId'])) {
            $customers = $customers->whereHas('customerOtherInfo', function($q) use($request, $currentUserGenderExp){
                if (!empty($request['maritalStatusId'])) {
                    $q->where('MaritalStatusID',$request['maritalStatusId']);
                }
                if (!empty($currentUserGenderExp)) {
                    $q->where('gender', $currentUserGenderExp);
                }
                if (!empty($request['ageFrom']) && !empty($request['ageTo'])) {
                    $q->whereBetween('age', [$request['ageFrom'], $request['ageTo']]);
                } elseif (!empty($request['ageFrom'])) {
                    $q->where('age', '>=', $request['ageFrom']);
                } elseif (!empty($request['ageTo'])) {
                    $q->where('age', '<=', $request['ageTo']);
                }
                if (!empty($request['countryId'])) {
                    $q->where('country_id', $request['countryId']);
                }
                if (!empty($request['stateId'])) {
                    $q->where('state_id', $request['stateId']);
                }
                if (!empty($request['cityId'])) {
                    $q->where('city_id', $request['cityId']);
                }
                if (!empty($request['tongueId'])) {
                    $q->where('MyFirstLanguageMotherTonguesID', $request['tongueId']);
                }
            });
        }

        if (isset($request['religionId']) || isset($request['sectId'])) {
            $customers = $customers->whereHas('customerReligionInfo', function($q) use ($request) {
                if (!empty($request['religionId'])) {
                    $q->where('Religions', $request['religionId']);
                }
                if (!empty($request['sectId'])) {
                    $q->where('Sects', $request['sectId']);
                }
            });
        }

        if (isset($request['qualificationId']) || isset($request['professionId']) || isset($request['incomeId'])) {
            $customers = $customers->whereHas('customerCareerInfo', function($q) use ($request) {
                if (!empty($request['qualificationId'])) {
                    $q->where('Qualification', $request['qualificationId']);
                }
                if (!empty($request['professionId'])) {
                    $q->where('Profession', $request['professionId']);
                }
                if (!empty($request['incomeId'])) {
                    $q->where('MonthlyIncome', $request['incomeId']);
                }
            });
        }

        if (isset($request['casteId']) || isset($request['livingArrangementId']) || isset($request['heightId']) || isset($request['disabilityId'])) {
            $customers = $customers->whereHas('customerPersonalInfo', function($q) use ($request) {
                if (!empty($request['casteId'])) {
                    $q->where('Caste', $request['casteId']);
                }
                if (!empty($request['livingArrangementId'])) {
                    $q->where('MyLivingArrangements', $request['livingArrangementId']);
                }
                if (!empty($request['heightId'])) {
                    $q->where('Heights', $request['heightId']);
                }
                if (!empty($request['disabilityId'])) {
                    $q->where('Disabilities', $request['disabilityId']);
                }
            });
        }

        if (!empty($request['featuredProfile'])) {
            $customers = $customers->where('featuredProfile', 1);
        }

        if (!empty($request['verifiedProfile'])) {
            $customers = $customers
                ->where('mobile_verified',1)
//                ->where('email_verified',1)
                ->where('profile_pic_status',1)
                ->where('age_verification',1)
                ->where('education_verification',1)
                ->where('location_verification',1)
                ->where('meeting_verification',1)
                ->where('nationality_verification',1);
        }

        if (!empty($currentAuthId)) {
            $customers = $customers->where('id','!=',$currentAuthId);
        }

        $customers = $customers->where('deleted','=',0)
            ->where('profile_status','=',1)
            ->where('email_verified','=',1)
            ->orderBy('blur_percent', 'asc')
            ->orderBy('profile_pic_client_status', 'desc')
            ->orderBy('profile_pic_status', 'desc')
            ->orderBy('id', 'desc');
        $totalCustomersCount = $customers->count();
        $customers = $customers
            ->without([
                'customerOtherInfo',
                'customerReligionInfo',
                'customerCareerInfo',
                'customerPersonalInfo'
            ])
            ->skip($skipProposals)
            ->take(6)
            ->get();
        $customers->makeHidden([
            'match_assign_lead_user_name',
            'match_assign_user_name',
            'assign_lead_user_name',
            'assign_user_name',
            'name',
            'gender_name',
            'image',
            'profile_pic_client_status',
            'faker_id',
            'un_seen_messages_count',
            'first_name',
            'last_name',
            'is_highlight',
            'profile_pic_status',
            'email_verified',
            'mobile_verified',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification',
            'salary_verification',
            'deleted',
            'profile_status'
        ]);
        return response()->json([
            'success'  => true,
            'message' => 'Customers has been fetched successfully.',
            'data'    => [
                'customersList'       => $customers,
                'totalCustomersCount' => $totalCustomersCount
            ],
            'code'    => 200
        ], 200);
    }

    public function customerDetail($customerId)
    {
        $currentCustomerId = auth()->id();
        $customer = Customer::select(
            'id',
            'first_name',
            'last_name',
            'name',
            'email',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'profile_gallery_client_status',
            'profile_gallery_status',
            'featuredProfile',
            'email_verified',
            'mobile_verified',
            'profile_pic_status',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification',
            'salary_verification',
            'user_package',
            'user_package_color',
            'agent_mobile'
        )->with([
            'getCitySlug',
            'getCountrySlug',
            'customerOtherInfo',
            'customerPersonalInfo',
            'customerCareerInfo',
            'customerReligionInfo',
            'customerSearch'
        ])->findOrFail($customerId);
        $viewRequest = [
            'view_to' => $customer->id,
            'view_by' => $currentCustomerId
        ];
        $viewExist = CustomerProfileView::where($viewRequest)->first();
        if (empty($viewExist)) {
            CustomerProfileView::create($viewRequest);
        }
//        $customer->totalLikes = CustomerLike::where('like_to', $customerId)->count();
        $customer->isMyLike = !! CustomerLike::where([
            'like_to' => $customerId,
            'like_by' => $currentCustomerId
        ])->count();
        $customer->isMySave = !! CustomerSaved::where([
            'save_to' => $customerId,
            'save_by' => $currentCustomerId
        ])->count();
        $customer->isMyBlock = !! CustomerBlock::where([
            'blockTo' => $customerId,
            'blockBy' => $currentCustomerId
        ])->count();

        $personalInfo = [
            'gender' => 'N/A',
            'age' => 'N/A',
            'country' => 'N/A',
            'state' => 'N/A',
            'city' => 'N/A',
            'maritalStatus' => 'N/A',
            'children' => 'N/A',
            'motherTongue' => 'N/A',
            'registrationReason' => 'N/A',
            'caste' => 'N/A',
            'countryOfOrigin' => 'N/A',
            'stateOfOrigin' => 'N/A',
            'cityOfOrigin' => 'N/A',
            'willingToRelocate' => 'N/A',
            'iAmLookingToMarry' => 'N/A',
            'livingArrangement' => 'N/A',
            'smoke' => 'N/A',
        ];
        $appearance = [
            'height' => 'N/A',
            'weight' => 'N/A',
            'complexion' => 'N/A',
            'myBuild' => 'N/A',
            'hairColor' => 'N/A',
            'eyeColor' => 'N/A',
            'disability' => 'N/A',
        ];
        $about = '';
        $hobbies = [];
        if (!empty($customer->customerOtherInfo)) {
            $personalInfo['gender'] = $customer->gender_name;
            $personalInfo['age'] = $customer->age;
            $personalInfo['country'] = genericQuery($customer->customerOtherInfo->country_id,'Country','name');
            $personalInfo['state'] = genericQuery($customer->customerOtherInfo->state_id,'State');
            $personalInfo['city'] = genericQuery($customer->customerOtherInfo->city_id,'City');
            $personalInfo['maritalStatus'] = genericQuery($customer->customerOtherInfo->MaritalStatusID,'MaritalStatus');
            $personalInfo['children'] = $customer->customerOtherInfo->childrenQuantity;
            $personalInfo['motherTongue'] = genericQuery($customer->customerOtherInfo->MyFirstLanguageMotherTonguesID,'MotherTongue');
            $personalInfo['registrationReason'] = genericQuery($customer->customerOtherInfo->RegistrationsReasonsID,'RegistrationsReason');
            if ($customer->customerOtherInfo->hobbiesAndInterest) {
                $hobbiesIds = explode(",",$customer->customerOtherInfo->hobbiesAndInterest);
                $hobbies = HobbiesAndInterest::select('id','title as name','icon')->whereIn('id', $hobbiesIds)->orderBy('order_at','asc')->get()->makeHidden(['faker_id']);
            }
            if (!empty($customer->customerOtherInfo->persona_note) && $customer->customerOtherInfo->personal_note_approve==1) {
                $about = $customer->customerOtherInfo->persona_note;
            }
        }

        if (!empty($customer->customerPersonalInfo)) {
            $personalInfo['caste'] = genericQuery($customer->customerPersonalInfo->Caste,'Caste');
            $personalInfo['countryOfOrigin'] = genericQuery($customer->customerPersonalInfo->CountryOfOrigin,'Country','name');
            $personalInfo['stateOfOrigin'] = genericQuery($customer->customerPersonalInfo->StateOfOrigin,'State');
            $personalInfo['cityOfOrigin'] = genericQuery($customer->customerPersonalInfo->CityOfOrigin,'City');
            $personalInfo['willingToRelocate'] = genericQuery($customer->customerPersonalInfo->WillingToRelocate,'WillingToRelocate');
            $personalInfo['iAmLookingToMarry'] = genericQuery($customer->customerPersonalInfo->IAmLookingToMarry,'IAmLookingToMarry');
            $personalInfo['livingArrangement'] = genericQuery($customer->customerPersonalInfo->MyLivingArrangements,'MyLivingArrangement');
            $personalInfo['smoke'] = genericQuery($customer->customerPersonalInfo->Smokes,'Smoke');

            $appearance['height'] = genericQuery($customer->customerPersonalInfo->Heights,'Height');
            $appearance['weight'] = genericQuery($customer->customerPersonalInfo->Weights,'Weight');
            $appearance['complexion'] = genericQuery($customer->customerPersonalInfo->Complexions,'Complexion');
            $appearance['myBuild'] = genericQuery($customer->customerPersonalInfo->MyBuilds,'MyBuild');
            $appearance['hairColor'] = genericQuery($customer->customerPersonalInfo->HairColors,'HairColor');
            $appearance['eyeColor'] = genericQuery($customer->customerPersonalInfo->EyeColors,'EyeColor');
            $appearance['disability'] = genericQuery($customer->customerPersonalInfo->Disabilities,'Disability');
        }

        if (!empty($customer->customerCareerInfo)) {
            $careerInfo['qualification'] = genericQuery($customer->customerCareerInfo->Qualification,'Education').'('.genericQuery($customer->customerCareerInfo->major_course_id,'MajorCourse').')';
            $careerInfo['university'] = genericQuery($customer->customerCareerInfo->University,'University');
            $careerInfo['occupation'] = genericQuery($customer->customerCareerInfo->Profession,'Occupation');
            $careerInfo['jobPost'] = genericQuery($customer->customerCareerInfo->JobPost,'JobPost');
            $careerInfo['monthlyIncome'] = genericQuery($customer->customerCareerInfo->MonthlyIncome,'AnnualInCome');
            $careerInfo['futurePlan'] = genericQuery($customer->customerCareerInfo->FuturePlans,'FuturePlan');
        } else {
            $careerInfo = [
                'university' => 'N/A',
                'jobPost' => 'N/A',
                'monthlyIncome' => 'N/A',
                'futurePlan' => 'N/A',
            ];
            if (!empty($customer->customerOtherInfo)) {
                $careerInfo['qualification'] = genericQuery($customer->customerOtherInfo->EducationID,'Education');
                $careerInfo['occupation'] = genericQuery($customer->customerOtherInfo->OccupationID,'Occupation');
            }
        }

        if (!empty($customer->customerReligionInfo)) {
            $religionInfo['religion'] = genericQuery($customer->customerReligionInfo->Religions,'Religion');
            $religionInfo['sect'] = genericQuery($customer->customerReligionInfo->Sects,'Sect');
            $religionInfo['doYouPreferHijaab'] = genericQuery($customer->customerReligionInfo->DoYouPreferHijabs,'DoYouPreferHijab');
            $religionInfo['doYouPreferBeard'] = genericQuery($customer->customerReligionInfo->DoYouHaveBeards,'DoYouHaveBeard');
            $religionInfo['areYouRevert'] = genericQuery($customer->customerReligionInfo->AreYouReverts,'AreYouRevert');
            $religionInfo['doYouKeepHalal'] = genericQuery($customer->customerReligionInfo->DoYouKeepHalal,'DoYouKeepHalal');
            $religionInfo['doYouPerformSalaah'] = genericQuery($customer->customerReligionInfo->DoYouPerformSalaah,'DoYouPerformSalaah');
        } else {
            $religionInfo = [
                'religion' => 'N/A',
                'sect' => 'N/A',
                'doYouPreferHijaab' => 'N/A',
                'doYouPreferBeard' => 'N/A',
                'areYouRevert' => 'N/A',
                'doYouKeepHalal' => 'N/A',
                'doYouPerformSalaah' => 'N/A',
            ];
        }

        if (!empty($customer->customerSearch) && !empty($customer->customerSearch->title)) {
            $customerSearch = json_decode($customer->customerSearch->title);
            $lifePartnerExpectation['gender'] = (isset($customerSearch->gender) && $customerSearch->gender==1) ? 'Male' :'Female';
            $lifePartnerExpectation['ageFrom'] = (isset($customerSearch->ageFrom)) ? $customerSearch->ageFrom : 'N/A';
            $lifePartnerExpectation['ageTo'] = (isset($customerSearch->ageTo)) ? $customerSearch->ageTo : 'N/A';
            $lifePartnerExpectation['country'] = (isset($customerSearch->country_id)) ? genericQuery($customerSearch->country_id,'Country','name') : 'N/A';
            $valNew = 'Any';
            if (isset($customerSearch->state_id)) {
                $valNew = genericQuery($customerSearch->state_id,'State');
            }
            $lifePartnerExpectation['state'] = ($valNew=='N/A') ? 'Any' : $valNew;
            $valNew = 'Any';
            if (isset($customerSearch->city_id)) {
                $valNew = genericQuery($customerSearch->city_id,'City');
            }
            $lifePartnerExpectation['city'] = ($valNew=='N/A') ? 'Any' : $valNew;
            $lifePartnerExpectation['tongue'] = (isset($customerSearch->Tongue)) ? genericQuery($customerSearch->Tongue,'MotherTongue') : 'N/A';
            $lifePartnerExpectation['religion'] = (isset($customerSearch->Religions)) ? genericQuery($customerSearch->Religions,'Religion') : 'N/A';
            $lifePartnerExpectation['sect'] = (isset($customerSearch->Sects)) ? genericQuery($customerSearch->Sects,'Sect') : 'N/A';
            $lifePartnerExpectation['qualification'] = (isset($customerSearch->EducationID)) ? genericQuery($customerSearch->EducationID,'Education') : 'N/A';
            $lifePartnerExpectation['profession'] = (isset($customerSearch->OccupationID)) ? genericQuery($customerSearch->OccupationID,'Occupation') : 'N/A';
            $lifePartnerExpectation['willingToRelocate'] = (isset($customerSearch->WillingToRelocate)) ? genericQuery($customerSearch->WillingToRelocate,'WillingToRelocate') : 'N/A';
            $lifePartnerExpectation['income'] = (isset($customerSearch->MyIncome)) ? genericQuery($customerSearch->MyIncome,'AnnualInCome') : 'N/A';
            $lifePartnerExpectation['maritalStatus'] = (isset($customerSearch->MaritalStatus)) ? genericQuery($customerSearch->MaritalStatus,'MaritalStatus') : 'N/A';
            $lifePartnerExpectation['livingArrangements'] = (isset($customerSearch->MyLivingArrangements)) ? genericQuery($customerSearch->MyLivingArrangements,'MyLivingArrangement') : 'N/A';
            $lifePartnerExpectation['heights'] = (isset($customerSearch->Heights)) ? genericQuery($customerSearch->Heights,'Height') : 'N/A';
            $lifePartnerExpectation['builds'] = (isset($customerSearch->MyBuilds)) ? genericQuery($customerSearch->MyBuilds,'MyBuild') : 'N/A';
            $lifePartnerExpectation['disabilities'] = (isset($customerSearch->Disabilities)) ? genericQuery($customerSearch->Disabilities,'Disability') : 'N/A';
            $lifePartnerExpectation['caste'] = (isset($customerSearch->Castes)) ? genericQuery($customerSearch->Castes,'Caste') : 'N/A';
        } else {
            $lifePartnerExpectation = [
                'gender' => 'N/A',
                'ageFrom' => 'N/A',
                'ageTo' => 'N/A',
                'country' => 'N/A',
                'state' => 'N/A',
                'city' => 'N/A',
                'tongue' => 'N/A',
                'religion' => 'N/A',
                'sect' => 'N/A',
                'qualification' => 'N/A',
                'profession' => 'N/A',
                'willingToRelocate' => 'N/A',
                'income' => 'N/A',
                'maritalStatus' => 'N/A',
                'livingArrangements' => 'N/A',
                'heights' => 'N/A',
                'builds' => 'N/A',
                'disabilities' => 'N/A',
                'caste' => 'N/A',
            ];
        }

        $gallery = [];
        if ($customer->profile_gallery_status==1 && $customer->profile_gallery_client_status==1) {
            $galleryData = CustomerImage::where([
                'CustomerID' => $customerId,
                'deleted'    => 0
            ])->get();
            $gallery = $galleryData->map(function ($row) {
                return $row->imageFullPath;
            });
        }
        $customer->gallery = $gallery;

        $customer->profileLikesCount = CustomerLike::where([
            'like_to' => $customer->id,
            'deleted' => 0
        ])->count();

        $customer->profileSavesCount = CustomerSaved::where([
            'save_to' => $customer->id,
            'deleted' => 0
        ])->count();

        $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
        $baseUrl = env('APP_URL');
        $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
        if (empty($customer->user_package)) {
            $customer->user_package = 'Free';
        }
        if (empty($customer->user_package_color)) {
            $customer->user_package_color = '#9b2c47';
        }

        $customer->isPersonalizedMatchmaking = false;
        if (str_contains($customer->email, '@shaadi.org.pk')) {
            $customer->isPersonalizedMatchmaking = true;
        }

        $customer->makeHidden([
            'assign_user_name',
            'assign_lead_user_name',
            'match_assign_user_name',
            'match_assign_lead_user_name',
            'faker_id',
            'un_seen_messages_count',
            'first_name',
            'last_name',
            'email',
            'image',
            'profile_pic_client_status',
            'customerOtherInfo',
            'customerPersonalInfo',
            'customerCareerInfo',
            'customerReligionInfo',
            'customerSearch',
            'getCitySlug',
            'getCountrySlug',
            'profile_gallery_client_status',
            'profile_gallery_status'
        ]);

        $customer->personalInfo = $personalInfo;
        $customer->careerInfo = $careerInfo;
        $customer->appearance = $appearance;
        $customer->religionInfo = $religionInfo;
        $customer->lifePartnerExpectation = $lifePartnerExpectation;
        $customer->about = $about;
        $customer->hobbies = $hobbies;

        $relatedProposals = Customer::select(
            'id',
            'first_name',
            'last_name',
            'name',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'featuredProfile',
            'email_verified',
            'mobile_verified',
            'profile_pic_status',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification'
        )->with([
            'getCountryName',
            'getStateName',
            'getCitiesName',
            'customerOtherInfo' => function($query) use ($customer) {
                if (!empty($customer->customerOtherInfo)) {
                    $query->where('gender',$customer->customerOtherInfo->gender);
                    $query->where('country_id',$customer->customerOtherInfo->country_id);
                    $query->where('state_id',$customer->customerOtherInfo->state_id);
                    $query->where('city_id',$customer->customerOtherInfo->city_id);
                }
            }])->whereHas('customerOtherInfo', function($q) use ($customer) {
            if (!empty($customer->customerOtherInfo)) {
                if (!empty($customer->customerOtherInfo->gender)) {
                    $q->where('gender',$customer->customerOtherInfo->gender);
                }
                if (!empty($customer->customerOtherInfo->country_id)) {
                    $q->where('country_id',$customer->customerOtherInfo->country_id);
                }
                if (!empty($customer->customerOtherInfo->state_id)) {
                    $q->where('state_id',$customer->customerOtherInfo->state_id);
                }
                if (!empty($customer->customerOtherInfo->city_id)) {
                    $q->where('city_id',$customer->customerOtherInfo->city_id);
                }
            }
        })->where('id','!=',$customerId)->where([
            'status'         => 1,
            'profile_status' => 1,
            'email_verified' => 1
        ])->without([
            'customerOtherInfo'
        ])->limit(6)->get();

        $relatedProposals->makeHidden([
            'match_assign_lead_user_name',
            'match_assign_user_name',
            'assign_lead_user_name',
            'assign_user_name',
            'name',
            'gender_name',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'faker_id',
            'un_seen_messages_count',
            'first_name',
            'last_name',
            'email_verified',
            'mobile_verified',
            'profile_pic_status',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification',
            'customer_other_info'
        ]);

        return response()->json([
            'success'  => true,
            'message' => 'Customer detail has been fetched successfully.',
            'data'    => [
                'customerDetail'   => $customer,
                'relatedProposals' => $relatedProposals
            ],
            'code'    => 200
        ], 200);
    }

    /* This method for related customer in profile view detail */
    public function getRelatedProposals($customerId)
    {
        $currentCustomerId = auth()->id();
        $customer = Customer::select(
            'id',
            'first_name',
            'last_name',
            'name',
            'email',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'featuredProfile',
            'email_verified',
            'mobile_verified',
            'profile_pic_status',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification',
            'salary_verification',
            'user_package',
            'user_package_color'
        )->with([
            'getCitySlug',
            'getCountrySlug',
            'customerOtherInfo',
            'customerPersonalInfo',
            'customerCareerInfo',
            'customerReligionInfo',
            'customerSearch'
        ])->findOrFail($customerId);

        $relatedProposals = Customer::select(
            'id',
            'first_name',
            'last_name',
            'name',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'featuredProfile',
            'email_verified',
            'mobile_verified',
            'profile_pic_status',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification'
        )->with([
            'getCountryName',
            'getStateName',
            'getCitiesName',
            'customerOtherInfo' => function($query) use ($customer) {
                if (!empty($customer->customerOtherInfo)) {
                    $query->where('gender',$customer->customerOtherInfo->gender);
                    $query->where('country_id',$customer->customerOtherInfo->country_id);
                    $query->where('state_id',$customer->customerOtherInfo->state_id);
                    $query->where('city_id',$customer->customerOtherInfo->city_id);
                }
            }])->whereHas('customerOtherInfo', function($q) use ($customer) {
            if (!empty($customer->customerOtherInfo)) {
                if (!empty($customer->customerOtherInfo->gender)) {
                    $q->where('gender',$customer->customerOtherInfo->gender);
                }
                if (!empty($customer->customerOtherInfo->country_id)) {
                    $q->where('country_id',$customer->customerOtherInfo->country_id);
                }
                if (!empty($customer->customerOtherInfo->state_id)) {
                    $q->where('state_id',$customer->customerOtherInfo->state_id);
                }
                if (!empty($customer->customerOtherInfo->city_id)) {
                    $q->where('city_id',$customer->customerOtherInfo->city_id);
                }
            }
        })->where('id','!=',$currentCustomerId)->where([
            'status'         => 1,
            'profile_status' => 1,
            'email_verified' => 1
        ])->without([
            'customerOtherInfo'
        ])->limit(6)->get();

        $relatedProposals->makeHidden([
            'match_assign_lead_user_name',
            'match_assign_user_name',
            'assign_lead_user_name',
            'assign_user_name',
            'name',
            'gender_name',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'faker_id',
            'un_seen_messages_count',
            'first_name',
            'last_name',
            'email_verified',
            'mobile_verified',
            'profile_pic_status',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification',
            'customer_other_info'
        ]);

        return response()->json([
            'success'  => true,
            'message' => 'Related customer has been fetched successfully.',
            'data'    => [
                'relatedCustomer' => $relatedProposals,
            ],
            'code'    => 200
        ], 200);
    }

    public function customerLikeUnlike($customerId)
    {
        $senderRow = auth()->user();
        $customerLikeRow = CustomerLike::where([
            'like_to' => $customerId,
            'like_by' => $senderRow->id
        ])->orderBy('id','desc')->first();

        if (empty($customerLikeRow)) {
            CustomerLike::insert([
                'like_to' => $customerId,
                'like_by' => $senderRow->id
            ]);
//            $message = 'Liked your profile.';
//            saveAndSendNotification($senderRow->full_name,$message,$customerId,$senderRow->id,"ProfileDetailScreen");
            return response()->json([
                'success'  => true,
                'message' => 'Customer has been liked successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        } else {
            $customerLikeRow->delete();
            return response()->json([
                'success'  => true,
                'message' => 'Customer has been unliked successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        }
    }

    public function whoLikedByMe()
    {
        $request = request()->all();
        $skipProposals = (isset($request['page']) && $request['page'] > 0) ? ($request['page']-1) * 6 : 0;
        $customerIds = CustomerLike::select('like_to')->where([
            'like_by' => auth()->id()
        ])->pluck('like_to')->toArray();
        $customers = [];
        if (count($customerIds) > 0) {
            $customers = Customer::with([
                'getCountryName',
                'getCitiesName'
            ])->select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'deleted',
                'profile_pic_client_status',
                'profile_pic_status'
            )
                ->where('deleted', 0)
                ->whereIn('id',$customerIds)
                ->skip($skipProposals)
                ->take(6)
                ->get();

            $customers->makeHidden([
                'first_name',
                'last_name',
                'name',
                'image',
                'faker_id',
                'verification_status',
                'un_seen_messages_count',
                'age',
                'gender_name',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'profile_pic_client_status',
                'profile_pic_status',
                'deleted'
            ]);
        }

        return response()->json([
            'success'  => true,
            'message' => 'Customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);
    }

    public function whoLikedMyProfile()
    {
        $request = request()->all();
        $skipProposals = (isset($request['page']) && $request['page'] > 0) ? ($request['page']-1) * 6 : 0;
        $customerIds = CustomerLike::select('like_by')->where([
            'like_to' => auth()->id()
        ])->pluck('like_by')->toArray();
        $customers = [];
        if (count($customerIds) > 0) {
            $customers = Customer::with([
                'getCountryName',
                'getCitiesName'
            ])->select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'deleted',
                'profile_pic_client_status',
                'profile_pic_status'
            )
                ->where('deleted', 0)
                ->whereIn('id',$customerIds)
                ->skip($skipProposals)
                ->take(6)
                ->get();

            $customers->makeHidden([
                'first_name',
                'last_name',
                'name',
                'image',
                'faker_id',
                'verification_status',
                'un_seen_messages_count',
                'age',
                'gender_name',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'profile_pic_client_status',
                'profile_pic_status',
                'deleted'
            ]);
        }

        return response()->json([
            'success'  => true,
            'message' => 'Customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);
    }

    public function customerSaveRemove($customerId)
    {
        $senderRow = auth()->user();
        $customerLikeRow = CustomerSaved::where([
            'save_to' => $customerId,
            'save_by' => $senderRow->id
        ])->orderBy('id','desc')->first();

        if (empty($customerLikeRow)) {
            CustomerSaved::insert([
                'save_to' => $customerId,
                'save_by' => $senderRow->id
            ]);
//            $message = 'Saved your profile.';
//            saveAndSendNotification($senderRow->full_name,$message,$customerId,$senderRow->id,"ProfileDetailScreen");
            return response()->json([
                'success'  => true,
                'message' => 'Customer has been saved successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        } else {
            $customerLikeRow->delete();
            return response()->json([
                'success'  => true,
                'message' => 'Customer has been removed successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        }
    }

    public function whoSavedByMe()
    {
        $request = request()->all();
        $skipProposals = (isset($request['page']) && $request['page'] > 0) ? ($request['page']-1) * 6 : 0;
        $customerIds = CustomerSaved::select('save_to')->where([
            'save_by' => auth()->id()
        ])->pluck('save_to')->toArray();
        $customers = [];
        if (count($customerIds) > 0) {
            $customers = Customer::with([
                'getCountryName',
                'getCitiesName'
            ])->select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'deleted',
                'profile_pic_client_status',
                'profile_pic_status'
            )
                ->where('deleted', 0)
                ->whereIn('id',$customerIds)
                ->skip($skipProposals)
                ->take(6)
                ->get();

            $customers->makeHidden([
                'first_name',
                'last_name',
                'name',
                'image',
                'faker_id',
                'verification_status',
                'un_seen_messages_count',
                'age',
                'gender_name',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'profile_pic_client_status',
                'profile_pic_status',
                'deleted'
            ]);
        }

        return response()->json([
            'success'  => true,
            'message' => 'Customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);
    }

    public function whoSavedMyProfile()
    {
        $request = request()->all();
        $skipProposals = (isset($request['page']) && $request['page'] > 0) ? ($request['page']-1) * 6 : 0;
        $customerIds = CustomerSaved::select('save_by')->where([
            'save_to' => auth()->id()
        ])->pluck('save_by')->toArray();
        $customers = [];
        if (count($customerIds) > 0) {
            $customers = Customer::with([
                'getCountryName',
                'getCitiesName'
            ])->select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'deleted',
                'profile_pic_client_status',
                'profile_pic_status'
            )
                ->where('deleted', 0)
                ->whereIn('id',$customerIds)
                ->skip($skipProposals)
                ->take(6)
                ->get();

            $customers->makeHidden([
                'first_name',
                'last_name',
                'name',
                'image',
                'faker_id',
                'verification_status',
                'un_seen_messages_count',
                'age',
                'gender_name',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'profile_pic_client_status',
                'profile_pic_status',
                'deleted'
            ]);
        }

        return response()->json([
            'success'  => true,
            'message' => 'Customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);
    }

    public function searchCustomers()
    {
        $request = request()->all();

        $customers = Customer::select('id','first_name','last_name','name','image','profile_pic_client_status','profile_pic_status','email_verified')
            ->with([
                'getCountryName',
                'getStateName',
                'getCitiesName',
                'customerOtherInfo' => function($q) use($request){
                    if (!empty($request['maritalStatus'])) {
                        $q->where('MaritalStatusID', $request['maritalStatus']);
                    }
                    if (!empty($request['gender'])) {
                        $q->where('gender', $request['gender']);
                    }
                    if (!empty($request['ageFrom']) && !empty($request['ageTo'])) {
                        $q->whereBetween('age', [$request['ageFrom'], $request['ageTo']]);
                    } elseif (!empty($request['ageFrom'])) {
                        $q->where('age', '>=', $request['ageFrom']);
                    } elseif (!empty($request['ageTo'])) {
                        $q->where('age', '<=', $request['ageTo']);
                    }
                    if (!empty($request['countryId'])) {
                        $q->where('country_id', $request['countryId']);
                    }
                    if (!empty($request['stateId'])) {
                        $q->where('state_id', $request['stateId']);
                    }
                    if (!empty($request['cityId'])) {
                        $q->where('city_id', $request['cityId']);
                    }
                },
                'customerReligionInfo' => function($q) use ($request) {
                    if (!empty($request['relegion'])) {
                        $q->where('Religions', $request['relegion']);
                    }
                }
            ]);

        if (!empty($request['gender']) ||
            !empty($request['ageFrom']) ||
            !empty($request['ageTo']) ||
            !empty($request['maritalStatus']) ||
            !empty($request['countryId']) ||
            !empty($request['stateId']) ||
            !empty($request['cityId'])) {
            $customers = $customers->whereHas('customerOtherInfo', function($q) use($request){
                if (!empty($request['maritalStatusId'])) {
                    $q->where('MaritalStatusID',$request['maritalStatusId']);
                }
                if (!empty($request['gender'])) {
                    $q->where('gender', $request['gender']);
                }
                if (!empty($request['ageFrom']) && !empty($request['ageTo'])) {
                    $q->whereBetween('age', [$request['ageFrom'], $request['ageTo']]);
                } elseif (!empty($request['ageFrom'])) {
                    $q->where('age', '>=', $request['ageFrom']);
                } elseif (!empty($request['ageTo'])) {
                    $q->where('age', '<=', $request['ageTo']);
                }
                if (!empty($request['countryId'])) {
                    $q->where('country_id', $request['countryId']);
                }
                if (!empty($request['stateId'])) {
                    $q->where('state_id', $request['stateId']);
                }
                if (!empty($request['cityId'])) {
                    $q->where('city_id', $request['cityId']);
                }
            });
        }

        if (!empty($request['religionId'])) {
            $customers = $customers->whereHas('customerReligionInfo', function($q) use ($request) {
                if (!empty($request['religionId'])) {
                    $q->where('Religions', $request['religionId']);
                }
            });
        }

        $customers = $customers->where('deleted',0)
            ->where('profile_status',1)
            ->where('email_verified',1)
            ->orderBy('blur_percent','asc')
            ->orderBy('profile_pic_status','desc')
            ->orderBy('profile_pic_client_status','desc')
            ->paginate(10);

        return response()->json([
            'success'  => true,
            'message' => 'Customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);
    }

    public function testFirebaseNotification()
    {
        $customerRow = Customer::where('id',auth()->id())->first();
        if (empty($customerRow)) {
            return response()->json([
                'success'  => false,
                'message' => 'Customer not found.',
                'data'    => [],
                'code'    => 404
            ], 404);
        }

        if (empty($customerRow->device_token)) {
            return response()->json([
                'success'  => false,
                'message' => 'Customer device token not found.',
                'data'    => [],
                'code'    => 200
            ], 200);
        }
        $title = 'Testing title';
        $message = 'This is testing firebase message.';
        $notificationSuccess = sendAndroidNotification($title,$message,$customerRow->device_token,$senderId=25910);
        if (!empty($notificationSuccess)) {
            return response()->json([
                'success'  => true,
                'message' => 'Firebase notification has been sent successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Firebase notification has not been sent.',
                'data'    => [],
                'code'    => 200
            ], 200);
        }
    }

    public function saveEducationForm()
    {
        $request = request()->all();
        $rules = [
            'qualification'   => 'required|numeric',
//            'majorCourseId'   => 'required|numeric',
            'profession'      => 'required|numeric',
            'monthlyIncome'   => 'required|numeric',
//            'university'      => 'required|numeric',
//            'jobPost'         => 'required|numeric',
//            'futurePlans'     => 'required|numeric'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'code'    => 200,
                'errors'   => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {
            $currentAuthId = auth()->id();

            CustomerCareerInfo::updateOrCreate([
                'CustomerID' => $currentAuthId
            ],[
                'CustomerID' => $currentAuthId,
                'Qualification' => $request['qualification'],
//                'major_course_id' => $request['majorCourseId'],
                'Profession' => $request['profession'],
                'MonthlyIncome' => $request['monthlyIncome'],
//                'University' => $request['university'],
//                'JobPost' => $request['jobPost'],
//                'FuturePlans' => $request['futurePlans']
            ]);

            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => $currentAuthId
            ],[
                'RegistrationID' => $currentAuthId,
                'EducationID' => $request['qualification'],
                'OccupationID' => $request['profession']
            ]);;

            DB::commit();

            $customer = Customer::select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'email',
                'password',
                'mobile',
                'profile_pic_client_status',
                'profile_pic_status',
                'email_verified'
            )->with([
                'getCitySlug',
                'getCountrySlug',
                'getCountryName',
                'getStateName',
                'getCitiesName'
            ])->findOrFail($currentAuthId);
            $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
            $baseUrl = env('APP_URL');
            $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
            $customer->profileComplete = checkProfileComplete($customer->id);
            $customer->makeHidden([
                'getCitySlug',
                'getCountrySlug',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'email_verified',
                'profile_pic_status',
                'profile_pic_client_status',
                'faker_id',
                'un_seen_messages_count',
                'image'
            ]);
            $imageFullPath = $baseUrl.'/customer-images/'.$customer->image;
            $customer = $customer->toArray();
            $customer['imageFullPath'] = $imageFullPath;

            return response()->json([
                'success' => true,
                'message' => 'Education form has been saved successfully.',
                'data'    => $customer,
                'code'    => 200,
                'errors'  => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success'  => false,
                'message' => 'Education form has not been saved.',
                'data'    => [],
                'code'    => 200,
                'errors'   => $e
            ], 200);
        }
    }

    public function savePersonalForm()
    {
        $request = request()->all();
        $rules = [
//            'countryOfOrigin'                => 'required|numeric',
//            'stateOfOrigin'                  => 'required|numeric',
//            'cityOfOrigin'                   => 'required|numeric',
//            'willingToRelocate'              => 'required|numeric',
            'iAmLookingToMarry'              => 'required|numeric',
            'myLivingArrangements'           => 'required|numeric',
            'heights'                        => 'required|numeric',
            'weights'                        => 'required|numeric',
            'complexions'                    => 'required|numeric',
//            'myBuilds'                       => 'required|numeric',
            'hairColors'                     => 'required|numeric',
            'eyeColors'                      => 'required|numeric',
            'smokes'                         => 'required|numeric',
            'disabilities'                   => 'required|numeric',
            'caste'                          => 'required|numeric',
            'myFirstLanguageMotherTonguesId' => 'required|numeric',
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'code'    => 200,
                'errors'   => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {
            $currentAuthId = auth()->id();
            CustomerPersonalInfo::updateOrCreate([
                'CustomerID' => $currentAuthId
            ],[
                'CustomerID' => $currentAuthId,
//                'CountryOfOrigin' => $request['countryOfOrigin'],
//                'StateOfOrigin' => $request['stateOfOrigin'],
//                'CityOfOrigin' => $request['cityOfOrigin'],
//                'WillingToRelocate' => $request['willingToRelocate'],
                'IAmLookingToMarry' => $request['iAmLookingToMarry'],
                'MyLivingArrangements' => $request['myLivingArrangements'],
                'Heights' => $request['heights'],
//                'MyBuilds' => $request['myBuilds'],
                'HairColors' => $request['hairColors'],
                'EyeColors' => $request['eyeColors'],
                'Smokes' => $request['smokes'],
                'Disabilities' => $request['disabilities'],
                'Weights' => $request['weights'],
                'Complexions' => $request['complexions'],
                'Caste' => $request['caste']
            ]);

            CustomerOtherInfo::updateOrCreate([
                'RegistrationID' => $currentAuthId
            ],[
                'RegistrationID'                  => $currentAuthId,
                'MyFirstLanguageMotherTonguesID'  => $request['myFirstLanguageMotherTonguesId'],
                'MySecondLanguageMotherTonguesID' => $request['myFirstLanguageMotherTonguesId']
            ]);

            DB::commit();

            $customer = Customer::select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'email',
                'password',
                'mobile',
                'profile_pic_client_status',
                'profile_pic_status',
                'email_verified'
            )->with([
                'getCitySlug',
                'getCountrySlug',
                'getCountryName',
                'getStateName',
                'getCitiesName'
            ])->findOrFail($currentAuthId);
            $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
            $baseUrl = env('APP_URL');
            $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
            $customer->profileComplete = checkProfileComplete($customer->id);
            $customer->makeHidden([
                'getCitySlug',
                'getCountrySlug',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'email_verified',
                'profile_pic_status',
                'profile_pic_client_status',
                'faker_id',
                'un_seen_messages_count',
                'image'
            ]);
            $imageFullPath = $baseUrl.'/customer-images/'.$customer->image;
            $customer = $customer->toArray();
            $customer['imageFullPath'] = $imageFullPath;

            return response()->json([
                'success' => true,
                'message' => 'Personal form has been saved successfully.',
                'data'    => $customer,
                'code'    => 200,
                'errors'  => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success'  => false,
                'message' => 'Personal form has not been saved.',
                'data'    => [],
                'code'    => 200,
                'error'   => $e
            ], 200);
        }
    }

    public function saveReligionForm()
    {
        $request = request()->all();
        $rules = [
            'religions'          => 'required|numeric',
            'sects'              => 'required|numeric',
            'doYouPreferHijabs'  => 'required|numeric',
            'doYouHaveBeards'    => 'required|numeric',
            'areYouReverts'      => 'required|numeric',
            'doYouKeepHalal'     => 'required|numeric',
//            'doYouPerformSalaah' => 'required|numeric'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'code'    => 200,
                'errors'   => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {

            $currentAuthId = auth()->id();
            CustomerReligionInfo::updateOrCreate([
                'CustomerID' => $currentAuthId
            ],[
                'CustomerID' => $currentAuthId,
                'Religions' => $request['religions'],
                'Sects' => $request['sects'],
                'DoYouPreferHijabs' => $request['doYouPreferHijabs'],
                'DoYouHaveBeards' => $request['doYouHaveBeards'],
                'AreYouReverts' => $request['areYouReverts'],
                'DoYouKeepHalal' => $request['doYouKeepHalal'],
//                'DoYouPerformSalaah' => $request['doYouPerformSalaah']
            ]);
            DB::commit();

            $customer = Customer::select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'email',
                'password',
                'mobile',
                'profile_pic_client_status',
                'profile_pic_status',
                'email_verified'
            )->with([
                'getCitySlug',
                'getCountrySlug',
                'getCountryName',
                'getStateName',
                'getCitiesName'
            ])->findOrFail($currentAuthId);
            $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
            $baseUrl = env('APP_URL');
            $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
            $customer->profileComplete = checkProfileComplete($customer->id);
            $customer->makeHidden([
                'getCitySlug',
                'getCountrySlug',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'email_verified',
                'profile_pic_status',
                'profile_pic_client_status',
                'faker_id',
                'un_seen_messages_count',
                'image'
            ]);
            $imageFullPath = $baseUrl.'/customer-images/'.$customer->image;
            $customer = $customer->toArray();
            $customer['imageFullPath'] = $imageFullPath;

            return response()->json([
                'success'  => true,
                'message' => 'Religion form has been saved successfully.',
                'data'    => $customer,
                'code'    => 200,
                'errors'   => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success'  => false,
                'message' => 'Religion form has not been saved.',
                'data'    => [],
                'code'    => 200,
                'errors'   => $e
            ], 200);
        }
    }

    public function saveExpectationForm()
    {
        $request = request()->all();
        $rules = [
            'gender'                          => 'required|numeric',
            'ageFrom'                         => 'required|numeric',
            'ageTo'                           => 'required|numeric',
            'country_id'                      => 'required|numeric',
            'state_id'                        => 'required|numeric',
            'city_id'                         => 'required|numeric',
            'Tongue'                          => 'required|numeric',
            'Religions'                       => 'required|numeric',
            'Sects'                           => 'required|numeric',
            'EducationID'                     => 'required|numeric',
            'OccupationID'                    => 'required|numeric',
            'MyIncome'                        => 'required|numeric',
//            'WillingToRelocate'               => 'required|numeric',
//            'MyBuilds'                        => 'required|numeric',
            'MaritalStatus'                   => 'required|numeric',
            'MyLivingArrangements'            => 'required|numeric',
            'Heights'                         => 'required|numeric',
            'Disabilities'                    => 'required|numeric',
            'Castes'                          => 'required|numeric'
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Please fill out all required fields.',
                'data'    => [],
                'code'    => 200,
                'errors'   => $validator->errors()
            ], 200);
        }
        DB::beginTransaction();
        try {
            $currentAuthId = auth()->id();
            $request['customerID'] = $currentAuthId;
            $request['title'] = json_encode($request);
            CustomerSearch::updateOrCreate([
                'customerID' => $currentAuthId
            ],$request);
            DB::commit();

            $customer = Customer::select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'email',
                'password',
                'mobile',
                'profile_pic_client_status',
                'profile_pic_status',
                'email_verified'
            )->with([
                'getCitySlug',
                'getCountrySlug',
                'getCountryName',
                'getStateName',
                'getCitiesName'
            ])->findOrFail($currentAuthId);
            $uniqueProfileSlug = $customer->gender_name.'-proposal-'.(!empty($customer->getCitySlug)?$customer->getCitySlug->slug:'na').'-'.(!empty($customer->getCountrySlug)?$customer->getCountrySlug->slug:'na').'-'.$customer->id;
            $baseUrl = env('APP_URL');
            $customer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
            $customer->profileComplete = checkProfileComplete($customer->id);
            $customer->makeHidden([
                'getCitySlug',
                'getCountrySlug',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'email_verified',
                'profile_pic_status',
                'profile_pic_client_status',
                'faker_id',
                'un_seen_messages_count',
                'image'
            ]);
            $imageFullPath = $baseUrl.'/customer-images/'.$customer->image;
            $customer = $customer->toArray();
            $customer['imageFullPath'] = $imageFullPath;

            return response()->json([
                'success' => true,
                'message' => 'Expectation form has been saved successfully.',
                'data'    => $customer,
                'code'    => 200,
                'errors'  => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success'  => false,
                'message' => 'Expectation form has not been saved.',
                'data'    => [],
                'code'    => 200,
                'errors'   => $e
            ], 200);
        }
    }

    public function saveUploadImageFormOld() {
        $image = request()->file;
        $profile_pic_client_status = request()->profile_pic_client_status;
        if (isset($image) && !empty($image)) {
            $customer = Customer::findOrFail(auth()->id());
            $image_base64 = base64_decode($image);
            $thumbnailImgNameOne = uniqid() . Str::random(25) . '.jpg';
            $file = public_path().'/customer-images/'.$thumbnailImgNameOne;
            file_put_contents($file, $image_base64);
            if (!in_array($customer->image,['default-female.jpg','default-male.jpg','default-user.png'])) {
                if (file_exists(public_path('customer-images/'.$customer->image))) {
                    unlink(public_path('customer-images/'.$customer->image));
                }
            }
            $res = $customer->update([
                'image' => $thumbnailImgNameOne,
                'profile_pic_client_status' => $profile_pic_client_status,
                'profile_pic_status' => 0
            ]);
            if (!empty($res)) {

                $currentCustomer = Customer::select(
                    'id',
                    'first_name',
                    'last_name',
                    'name',
                    'image',
                    'email',
                    'password',
                    'mobile',
                    'profile_pic_client_status',
                    'profile_pic_status',
                    'email_verified'
                )->with(['getCountryName','getStateName','getCitiesName'])->findOrFail($customer->id);
                $currentCustomer->imageFullPath = env('APP_URL').'/customer-images/'.$currentCustomer->image;

                $countryName = (!empty($currentCustomer->getCountryName)?$currentCustomer->getCountryName->name:'NA');
                $countrySlug = strtolower($countryName);
                $countrySlug = str_replace(' ', '-', $countrySlug);
                $countrySlug = str_replace('/', '-', $countrySlug);
                $cityName = (!empty($currentCustomer->getCitiesName)?$currentCustomer->getCitiesName->name:'NA');
                $citySlug = strtolower($cityName);
                $citySlug = str_replace(' ', '-', $citySlug);
                $citySlug = str_replace('/', '-', $citySlug);
                $currentCustomer->profileLink = $currentCustomer->gender_name.'-proposal-'.$citySlug.'-'.$countrySlug.'-'.$currentCustomer->faker_id;
                $currentCustomer->profileComplete = checkProfileComplete($currentCustomer->id);

                $currentCustomer->makeHidden([
                    'getCitySlug',
                    'getCountrySlug',
                    'assign_user_name',
                    'assign_lead_user_name',
                    'match_assign_user_name',
                    'match_assign_lead_user_name',
                    'email_verified',
                    'profile_pic_status',
                    'profile_pic_client_status',
                    'faker_id',
                    'un_seen_messages_count',
                    'image'
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Profile image has saved successfully.',
                    'data'    => $currentCustomer,
                    'code'    => 200,
                    'errors'  => []
                ], 200);
            }
        }
        return response()->json([
            'success'  => false,
            'message' => 'Profile image has not saved.',
            'data'    => [],
            'code'    => 200,
            'errors'  => []
        ], 200);
    }

    public function saveUploadImageForm()
    {
        $request = request();
        $rules = [
            'image'                     => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'blur_percent'              => 'required|numeric|in:0,10,15,25',
            'profile_pic_client_status' => 'required|numeric|in:0,1'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail(auth()->id());
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) .time(). '.' . $extension;
                    $blur_percent = (isset($request->blur_percent) && $request->blur_percent > 0 ? $request->blur_percent : 0);
                    $profile_pic_client_status = (isset($request->profile_pic_client_status) && $request->profile_pic_client_status > 0 ? $request->profile_pic_client_status : 0);
                    if ($blur_percent > 0) {
                        $main_image = public_path('customer-images/original_images/' . $imageName);
                        Image::make($image_tmp)->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($main_image,60);

                        $this->makeBlurImage($imageName,$blur_percent);
                    } else {
                        $main_image = public_path('customer-images/' . $imageName);
                        Image::make($image_tmp)->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($main_image,60);
                    }

                    if (!in_array($customer->image,['default-female.jpg','default-male.jpg','default-user.png']) && file_exists(public_path('customer-images/'.$customer->image))) {
                        unlink(public_path('customer-images/'.$customer->image));
                    }
                    if (!in_array($customer->image,['default-female.jpg','default-male.jpg','default-user.png']) && file_exists(public_path('customer-images/original_images/'.$customer->image))) {
                        unlink(public_path('customer-images/original_images/'.$customer->image));
                    }

                    $customer->update([
                        'image' => $imageName,
                        'profile_pic_client_status' => $profile_pic_client_status,
                        'blur_percent'              => $blur_percent,
                        'profile_pic_status'        => 0
                    ]);
                    DB::commit();

                    $currentCustomer = Customer::select(
                        'id',
                        'first_name',
                        'last_name',
                        'name',
                        'image',
                        'email',
                        'password',
                        'mobile',
                        'profile_pic_client_status',
                        'profile_pic_status',
                        'email_verified'
                    )->with([
                        'getCitySlug',
                        'getCountrySlug',
                        'getCountryName',
                        'getStateName',
                        'getCitiesName'
                    ])->findOrFail($customer->id);
                    $uniqueProfileSlug = $currentCustomer->gender_name.'-proposal-'.(!empty($currentCustomer->getCitySlug)?$currentCustomer->getCitySlug->slug:'NA').'-'.(!empty($currentCustomer->getCountrySlug)?$currentCustomer->getCountrySlug->slug:'NA').'-'.$currentCustomer->faker_id;
                    $baseUrl = env('APP_URL');
                    $currentCustomer->profile_link = $baseUrl.'/'.$uniqueProfileSlug;
                    $currentCustomer->profileComplete = checkProfileComplete($currentCustomer->id);
                    $currentCustomer->makeHidden([
                        'getCitySlug',
                        'getCountrySlug',
                        'assign_user_name',
                        'assign_lead_user_name',
                        'match_assign_user_name',
                        'match_assign_lead_user_name',
                        'email_verified',
                        'profile_pic_status',
                        'profile_pic_client_status',
                        'faker_id',
                        'un_seen_messages_count',
                        'image'
                    ]);
                    $imageFullPath = $baseUrl.'/customer-images/'.$currentCustomer->image;
                    $currentCustomer = $currentCustomer->toArray();
                    $currentCustomer['imageFullPath'] = $imageFullPath;

                    return response()->json([
                        'success' => true,
                        'message' => 'Profile image has saved successfully.',
                        'data'    => $currentCustomer,
                        'code'    => 200,
                        'errors'  => $imageName
                    ], 200);
                }
            }
            return response()->json([
                'success'  => false,
                'message' => 'Profile image has not saved.',
                'data'    => [],
                'code'    => 200,
                'errors'  => []
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success'  => false,
                'message' => 'Profile image has not saved.',
                'data'    => [],
                'code'    => 200,
                'errors'  => $e
            ], 200);
        }
    }

    public function makeBlurImage($imageName,$blur_percent)
    {
        switch ($blur_percent)
        {
            case '10':
                $blur_percent = 5;
                break;
            case '15':
                $blur_percent = 10;
                break;
            case '25':
                $blur_percent = 15;
                break;
        }
        $file = public_path('customer-images/original_images/'.$imageName);
        $fileUrl = asset('/customer-images/original_images/'.$imageName);
        if (env('APP_ENV')=='local') {
            $fileUrl = str_replace("https","http",$fileUrl);
        }
        $imageNewPath = public_path('customer-images/' . $imageName);
        $headers = get_headers($fileUrl, 1);
        $contentType = (isset($headers['Content-Type'])) ? $headers['Content-Type'] : $headers['content-type'];
        if (is_array($contentType)) {
            if (count($contentType) > 1) {
                $contentType = $contentType[1];
            } else {
                $contentType = $contentType[0];
            }
        }
        switch ($contentType)
        {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($file);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file);
                break;
        }

        list($w, $h) = getimagesize($file);

        $size = array('sm'=>array('w'=>intval($w/4), 'h'=>intval($h/4)),
            'md'=>array('w'=>intval($w/2), 'h'=>intval($h/2))
        );

        $sm = imagecreatetruecolor($size['sm']['w'],$size['sm']['h']);
        imagecopyresampled($sm, $image, 0, 0, 0, 0, $size['sm']['w'], $size['sm']['h'], $w, $h);

        for ($x=1; $x <=$blur_percent*2; $x++){
            imagefilter($sm, IMG_FILTER_GAUSSIAN_BLUR, 999);
        }

        imagefilter($sm, IMG_FILTER_SMOOTH,99);
        imagefilter($sm, IMG_FILTER_BRIGHTNESS, 10);

        $md = imagecreatetruecolor($size['md']['w'], $size['md']['h']);
        imagecopyresampled($md, $sm, 0, 0, 0, 0, $size['md']['w'], $size['md']['h'], $size['sm']['w'], $size['sm']['h']);
        imagedestroy($sm);

        for ($x=1; $x <=$blur_percent; $x++){
            imagefilter($md, IMG_FILTER_GAUSSIAN_BLUR, 999);
        }

        imagefilter($md, IMG_FILTER_SMOOTH,99);
        imagefilter($md, IMG_FILTER_BRIGHTNESS, 10);

        imagecopyresampled($image, $md, 0, 0, 0, 0, $w, $h, $size['md']['w'], $size['md']['h']);
        imagedestroy($md);

        imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
        switch ($contentType)
        {
            case 'image/jpeg':
                imagejpeg($image,$imageNewPath);
                break;
            case 'image/gif':
                imagegif($image,$imageNewPath);
                break;
            case 'image/png':
                imagepng($image,$imageNewPath);
                break;
        }
        imagedestroy($image);

        return true;
    }

    public function getEducationForm()
    {
        $data = [
            'customerData' => [
                'qualification' => '',
//                'majorCourseId' => '',
                'profession'    => '',
                'monthlyIncome' => '',
//                'university'    => '',
//                'jobPost'       => '',
//                'futurePlans'   => '',
            ],
            'formData' => [
                'educations'    => Education::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'universities'  => University::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'occupations'   => Occupation::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'jobPosts'      => JobPost::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'incomes'       => AnnualInCome::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'futurePlans'   => FuturePlan::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ];

        $currentAuthId = auth()->id();

        $customerCareerInfo = CustomerCareerInfo::where('CustomerID', $currentAuthId)->first();
        if (!empty($customerCareerInfo)) {
            $data['customerData']['qualification'] = (int) $customerCareerInfo->Qualification;
//            $data['customerData']['majorCourseId'] = (int) $customerCareerInfo->major_course_id;
            $data['customerData']['profession']    = (int) $customerCareerInfo->Profession;
            $data['customerData']['monthlyIncome'] = (int) $customerCareerInfo->MonthlyIncome;
//            $data['customerData']['university']    = (int) $customerCareerInfo->University;
//            $data['customerData']['jobPost']       = (int) $customerCareerInfo->JobPost;
//            $data['customerData']['futurePlans']   = (int) $customerCareerInfo->FuturePlans;
        }
        return response()->json([
            'success' => true,
            'message' => 'Education form data has been fetched successfully.',
            'data'    => $data,
            'code'    => 200,
            'errors'  => []
        ], 200);
    }

    public function getPersonalForm()
    {
        $data = [
            'customerData' => [
//                'countryOfOrigin'                => '',
//                'stateOfOrigin'                  => '',
//                'cityOfOrigin'                   => '',
//                'willingToRelocate'              => '',
                'iAmLookingToMarry'              => '',
                'myLivingArrangements'           => '',
                'heights'                        => '',
                'weights'                        => '',
                'complexions'                    => '',
//                'myBuilds'                       => '',
                'hairColors'                     => '',
                'eyeColors'                      => '',
                'smokes'                         => '',
                'disabilities'                   => '',
                'caste'                          => '',
                'myFirstLanguageMotherTonguesId' => '',
            ],
            'formData' => [
//                'countries'          => Country::select('id','name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'WillingToRelocates' => WillingToRelocate::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'IAmLookingToMarry'  => IAmLookingToMarry::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'livingArrangement'  => MyLivingArrangement::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'heights'            => Height::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'weights'            => Weight::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'complexions'        => Complexion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'myBuilds'           => MyBuild::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'hairColor'          => HairColor::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'eyeColor'           => EyeColor::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'smokes'             => Smoke::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'disability'         => Disability::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'castes'             => Caste::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'tongues'            => MotherTongue::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ];

        $currentAuthId = auth()->id();

        $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID', $currentAuthId)->first();
        if (!empty($customerPersonalInfo)) {
//            $data['customerData']['countryOfOrigin'] = (int) $customerPersonalInfo->CountryOfOrigin;
//            $data['customerData']['stateOfOrigin'] = (int) $customerPersonalInfo->StateOfOrigin;
//            $data['customerData']['cityOfOrigin'] = (int) $customerPersonalInfo->CityOfOrigin;
//            $data['customerData']['willingToRelocate'] = (int) $customerPersonalInfo->WillingToRelocate;
            $data['customerData']['iAmLookingToMarry'] = (int) $customerPersonalInfo->IAmLookingToMarry;
            $data['customerData']['myLivingArrangements'] = (int) $customerPersonalInfo->MyLivingArrangements;
            $data['customerData']['heights'] = (int) $customerPersonalInfo->Heights;
            $data['customerData']['weights'] = (int) $customerPersonalInfo->Weights;
            $data['customerData']['complexions'] = (int) $customerPersonalInfo->Complexions;
//            $data['customerData']['myBuilds'] = (int) $customerPersonalInfo->MyBuilds;
            $data['customerData']['hairColors'] = (int) $customerPersonalInfo->HairColors;
            $data['customerData']['eyeColors'] = (int) $customerPersonalInfo->EyeColors;
            $data['customerData']['smokes'] = (int) $customerPersonalInfo->Smokes;
            $data['customerData']['disabilities'] = (int) $customerPersonalInfo->Disabilities;
            $data['customerData']['caste'] = (int) $customerPersonalInfo->Caste;
        }

        $customerOtherInfo = CustomerOtherInfo::where('RegistrationID', $currentAuthId)->first();
        if (!empty($customerOtherInfo)) {
            $data['customerData']['myFirstLanguageMotherTonguesId'] = (int) $customerOtherInfo->MyFirstLanguageMotherTonguesID;
        }
        return response()->json([
            'success' => true,
            'message' => 'Personal form data has been fetched successfully.',
            'data'    => $data,
            'code'    => 200,
            'errors'  => []
        ], 200);
    }

    public function getReligionForm()
    {
        $data = [
            'customerData' => [
                'religions'          => '',
                'sects'              => '',
                'doYouPreferHijabs'  => '',
                'doYouHaveBeards'    => '',
                'areYouReverts'      => '',
                'doYouKeepHalal'     => '',
//                'doYouPerformSalaah' => ''
            ],
            'formData' => [
                'religions'          => Religion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouPreferHijab'   => DoYouPreferHijab::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouHaveBeard'     => DoYouHaveBeard::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'areYouRevert'       => AreYouRevert::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'doYouKeepHalal'     => DoYouKeepHalal::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'doYouPerformSalaah' => DoYouPerformSalaah::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
            ]
        ];
        $currentAuthId = auth()->id();
        $customerReligionInfo = CustomerReligionInfo::where('CustomerID',$currentAuthId)->first();
        if (!empty($customerReligionInfo)) {
            $data['customerData']['religions'] = (int) $customerReligionInfo->Religions;
            $data['customerData']['sects'] = (int) $customerReligionInfo->Sects;
            $data['customerData']['doYouPreferHijabs'] = (int) $customerReligionInfo->DoYouPreferHijabs;
            $data['customerData']['doYouHaveBeards'] = (int) $customerReligionInfo->DoYouHaveBeards;
            $data['customerData']['areYouReverts'] = (int) $customerReligionInfo->AreYouReverts;
            $data['customerData']['doYouKeepHalal'] = (int) $customerReligionInfo->DoYouKeepHalal;
//            $data['customerData']['doYouPerformSalaah'] = (int) $customerReligionInfo->DoYouPerformSalaah;
        }
        return response()->json([
            'success' => true,
            'message' => 'Religion form data has been fetched successfully.',
            'data'    => $data,
            'code'    => 200,
            'errors'  => []
        ]);
    }

    public function getExpectationForm()
    {
        $data = [
            'customerData' => [
                'gender'               => '',
                'ageFrom'              => '',
                'ageTo'                => '',
                'country_id'           => '',
                'state_id'             => '',
                'city_id'              => '',
                'Tongue'               => '',
                'Religions'            => '',
                'Sects'                => '',
                'EducationID'          => '',
                'OccupationID'         => '',
                'MyIncome'             => '',
//                'WillingToRelocate'    => '',
//                'MyBuilds'             => '',
                'MaritalStatus'        => '',
                'MyLivingArrangements' => '',
                'Heights'              => '',
                'Disabilities'         => '',
                'Castes'               => '',
            ],
            'formData' => [
                'gender' => [
                    [
                        'id' => 1,
                        'name' => 'Male'
                    ],
                    [
                        'id' => 2,
                        'name' => 'Female'
                    ]
                ],
                'countries'          => Country::select('id','name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'tongues'            => MotherTongue::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'religions'          => Religion::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'educations'         => Education::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'occupations'        => Occupation::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'WillingToRelocates' => WillingToRelocate::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'incomes'            => AnnualInCome::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'maritalStatus'      => MaritalStatus::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'livingArrangement'  => MyLivingArrangement::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'heights'            => Height::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
//                'myBuilds'           => MyBuild::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'disability'         => Disability::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get(),
                'castes'             => Caste::select('id','title as name')->where('deleted', 0)->orderBy('order_at','asc')->get()
            ]
        ];

        $customerSearchRow = CustomerSearch::where('customerID',auth()->id())->first();
        if (!empty($customerSearchRow) && !empty($customerSearchRow->title)) {
            $customerSearch = json_decode($customerSearchRow->title);
            $data['customerData']['gender'] = (isset($customerSearch->gender)) ? (int) $customerSearch->gender : '';
            $data['customerData']['ageFrom'] = (isset($customerSearch->ageFrom)) ? (int) $customerSearch->ageFrom : '';
            $data['customerData']['ageTo'] = (isset($customerSearch->ageTo)) ? (int) $customerSearch->ageTo : '';
            $data['customerData']['country_id'] = (isset($customerSearch->country_id)) ? (int) $customerSearch->country_id : '';
            $data['customerData']['state_id'] = (isset($customerSearch->state_id)) ? (int) $customerSearch->state_id : '';
            $data['customerData']['city_id'] = (isset($customerSearch->city_id)) ? (int) $customerSearch->city_id : '';
            $data['customerData']['Tongue'] = (isset($customerSearch->Tongue)) ? (int) $customerSearch->Tongue : '';
            $data['customerData']['Religions'] = (isset($customerSearch->Religions)) ? (int) $customerSearch->Religions : '';
            $data['customerData']['Sects'] = (isset($customerSearch->Sects)) ? (int) $customerSearch->Sects : '';
            $data['customerData']['EducationID'] = (isset($customerSearch->EducationID)) ? (int) $customerSearch->EducationID : '';
            $data['customerData']['OccupationID'] = (isset($customerSearch->OccupationID)) ? (int) $customerSearch->OccupationID : '';
            $data['customerData']['MyIncome'] = (isset($customerSearch->MyIncome)) ? (int) $customerSearch->MyIncome : '';
//            $data['customerData']['WillingToRelocate'] = (isset($customerSearch->WillingToRelocate)) ? (int) $customerSearch->WillingToRelocate : '';
//            $data['customerData']['MyBuilds'] = (isset($customerSearch->MyBuilds)) ? (int) $customerSearch->MyBuilds : '';
            $data['customerData']['MaritalStatus'] = (isset($customerSearch->MaritalStatus)) ? (int) $customerSearch->MaritalStatus : '';
            $data['customerData']['MyLivingArrangements'] = (isset($customerSearch->MyLivingArrangements)) ? (int) $customerSearch->MyLivingArrangements : '';
            $data['customerData']['Heights'] = (isset($customerSearch->Heights)) ? (int) $customerSearch->Heights : '';
            $data['customerData']['Disabilities'] = (isset($customerSearch->Disabilities)) ? (int) $customerSearch->Disabilities : '';
            $data['customerData']['Castes'] = (isset($customerSearch->Castes)) ? (int) $customerSearch->Castes : '';
        }
        return response()->json([
            'success' => true,
            'message' => 'Expectation form data has been fetched successfully.',
            'data'    => $data,
            'code'    => 200,
            'errors'  => []
        ]);
    }

    public function getGallery($customerId='')
    {
        if (empty($customerId)) {
            $customerId = auth()->id();
        }

        $customer = Customer::where('id',$customerId)->first();

        $gallery = [];
        if (!empty($customer)) {
            if ($customer->id==auth()->id()) {
                $gallery = CustomerImage::select('id','image','deleted','CustomerID as customerId')->where([
                    'CustomerID' => $customerId,
                    'deleted'    => 0
                ])->get();

                $gallery->makeHidden([
                    "deleted",
                    "image",
                    "faker_id"
                ]);
            } elseif ($customer->profile_gallery_status==1 && $customer->profile_gallery_client_status==1) {
                $gallery = CustomerImage::select('id','image','deleted','CustomerID as customerId')->where([
                    'CustomerID' => $customerId,
                    'deleted'    => 0
                ])->get();

                $gallery->makeHidden([
                    "deleted",
                    "image",
                    "faker_id"
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Gallery has been fetched successfully.',
            'data'    => $gallery,
            'code'    => 200,
            'errors'  => []
        ], 200);
    }

    public function saveGalleryImageForm() {
        $request = request();
        $rules = [
            'images*' => 'required|image|mimes:jpeg,png,jpg|max:4096'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors(),
                'status'=>'error'
            ],422);
        }
        try {
            $customerId = auth()->id();
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    if ($image->isValid()) {
                        $extension = $image->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . time() . '.' . $extension;
                        $main_image = public_path('customer-images/' . $imageName);
                        Image::make($image)->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($main_image, 60);

                        CustomerImage::create([
                            'CustomerID' => $customerId,
                            'image' => $imageName
                        ]);
                    }
                }
            }

            $gallery = CustomerImage::select('id','image','deleted','CustomerID as customerId')->where([
                'CustomerID' => $customerId,
                'deleted'    => 0
            ])->get();

            $gallery->makeHidden([
                "deleted",
                "image",
                "faker_id"
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Gallery image has saved successfully.',
                'data'    => $gallery,
                'code'    => 200,
                'errors'  => []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'message' => 'Gallery image has not saved.',
                'data'    => [],
                'code'    => 200,
                'errors'  => $e
            ], 200);
        }
    }

    public function deleteGalleryImage($galleryImageId)
    {
        $imageRow = CustomerImage::where('id', $galleryImageId)->first();
        if (empty($imageRow)) {
            return response()->json([
                'success' => true,
                'message' => 'Gallery image has already deleted.',
                'data'    => [],
                'code'    => 200,
                'errors'  => []
            ], 200);
        }
        if (file_exists(public_path('customer-images/'.$imageRow->image))) {
            unlink(public_path('customer-images/'.$imageRow->image));
        }
        $imageRow->delete();
        return response()->json([
            'success' => true,
            'message' => 'Gallery image has deleted successfully.',
            'data'    => [],
            'code'    => 200,
            'errors'  => []
        ], 200);
    }

    public function customerBlockUnlock($customerId)
    {
        $customerBlockRow = CustomerBlock::where([
            'blockTo' => $customerId,
            'blockBy' => auth()->id()
        ])->orderBy('id','desc')->first();

        if (empty($customerBlockRow)) {
            CustomerBlock::insert([
                'blockTo' => $customerId,
                'blockBy' => auth()->id()
            ]);
            return response()->json([
                'success'  => true,
                'message' => 'Customer has been blocked successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        } else {
            $customerBlockRow->delete();
            return response()->json([
                'success'  => true,
                'message' => 'Customer has been unblocked successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        }
    }

    public function customerReport()
    {
        if (request()->customerId) {
            $where = [
                'reportTo' => request()->customerId,
                'reportBy' => auth()->id()
            ];
            $newRequest = $where;
            $newRequest['desc'] = request()->description;
            CustomerReport::updateOrCreate($where,$newRequest);

            return response()->json([
                'success' => true,
                'message' => 'Customer has been reported successfully.',
                'data'    => [],
                'code'    => 200
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Customer has not been reported.',
            'data'    => [],
            'code'    => 200
        ], 200);
    }

    public function getBlockCustomers()
    {
        $customerIds = CustomerBlock::select('blockTo')->where([
            'blockBy' => auth()->id()
        ])->pluck('blockTo')->toArray();
        $customers = [];
        if (count($customerIds) > 0) {
            $customers = Customer::with([
                'getCountryName',
                'getCitiesName'
            ])->select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'deleted',
                'profile_pic_client_status',
                'profile_pic_status'
            )
                ->where('deleted', 0)
                ->whereIn('id',$customerIds)
                ->get();

            $customers->makeHidden([
                'first_name',
                'last_name',
                'name',
                'image',
                'faker_id',
                'verification_status',
                'un_seen_messages_count',
                'age',
                'gender_name',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'profile_pic_client_status',
                'profile_pic_status',
                'deleted'
            ]);
        }

        return response()->json([
            'success'  => true,
            'message' => 'Block customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);
    }

    public function getReportCustomers()
    {
        $customerIds = CustomerReport::select('reportTo')->where([
            'reportBy' => auth()->id()
        ])->pluck('reportTo')->toArray();
        $customers = [];
        if (count($customerIds) > 0) {
            $customers = Customer::select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'deleted',
                'profile_pic_client_status',
                'profile_pic_status'
            )
                ->where('deleted', 0)
                ->whereIn('id',$customerIds)
                ->get();

            $customers->makeHidden([
                'first_name',
                'last_name',
                'name',
                'image',
                'faker_id',
                'verification_status',
                'un_seen_messages_count',
                'age',
                'gender_name',
                'assign_user_name',
                'assign_lead_user_name',
                'match_assign_user_name',
                'match_assign_lead_user_name',
                'profile_pic_client_status',
                'profile_pic_status',
                'deleted'
            ]);
        }

        return response()->json([
            'success'  => true,
            'message' => 'Report customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);
    }

    public function myMatches()
    {
        $request = request()->all();
        $skipProposals = (isset($request['page']) && $request['page'] > 0) ? ($request['page']-1) * 5 : 0;
        $currentCustomerId = auth()->id();
        $customerSearch = null;
        $customerSearchRow = CustomerSearch::where('customerID',$currentCustomerId)->first();
        if (!empty($customerSearchRow) && !empty($customerSearchRow->title)) {
            $customerSearch = json_decode($customerSearchRow->title);
        }
        $customers = [];
        if (!empty($customerSearch)) {
            $customers = Customer::select(
                'id',
                'first_name',
                'last_name',
                'name',
                'image',
                'profile_pic_client_status',
                'profile_pic_status',
                'featuredProfile',
                'email_verified',
                'mobile_verified',
                'profile_pic_status',
                'meeting_verification',
                'age_verification',
                'education_verification',
                'location_verification',
                'nationality_verification',
                'salary_verification',
                'user_package',
                'user_package_color',
                'profile_status',
                'deleted',
                'is_highlight'
            )->where('profile_status',1)
                ->with([
                    'customerLikeByMe',
                    'getCountryName',
                    'getCitiesName',
                    'getMaritalStatusName',
                    'getHeightName',
                    'customerOtherInfo' => function($query) use ($customerSearch) {
                        if (isset($customerSearch->gender) && !empty($customerSearch->gender)) {
                            $query->where('gender', $customerSearch->gender);
                        }
                        if (!empty($customerSearch->ageFrom) && !empty($customerSearch->ageTo)) {
                            $query->whereBetween('age', [$customerSearch->ageFrom, $customerSearch->ageTo]);
                        } elseif (!empty($customerSearch->ageFrom)) {
                            $query->where('age', '>=', $customerSearch->ageFrom);
                        } elseif (!empty($customerSearch->ageTo)) {
                            $query->where('age', '<=', $customerSearch->ageTo);
                        }
                        if (isset($customerSearch->country_id) && !empty($customerSearch->country_id)) {
                            $query->where('country_id', $customerSearch->country_id);
                        }
                        if (isset($customerSearch->state_id) && !empty($customerSearch->state_id)) {
                            $query->where('state_id', $customerSearch->state_id);
                        }
                        if (isset($customerSearch->city_id) && !empty($customerSearch->city_id)) {
                            $query->where('city_id', $customerSearch->city_id);
                        }
                    },
                    'customerReligionInfo' => function($query) use ($customerSearch) {
                        if (isset($customerSearch->Religions) && !empty($customerSearch->Religions)) {
                            $query->where('Religions', $customerSearch->Religions);
                        }
                    }
                ]);

            if (
                isset($customerSearch->gender) ||
                isset($customerSearch->ageFrom) ||
                isset($customerSearch->ageTo) ||
                isset($customerSearch->country_id) ||
                isset($customerSearch->state_id) ||
                isset($customerSearch->city_id)
            ) {
                $customers = $customers->whereHas('customerOtherInfo', function($query) use ($customerSearch) {
                    if (isset($customerSearch->gender) && !empty($customerSearch->gender)) {
                        $query->where('gender', $customerSearch->gender);
                    }
                    if (!empty($customerSearch->ageFrom) && !empty($customerSearch->ageTo)) {
                        $query->whereBetween('age', [$customerSearch->ageFrom, $customerSearch->ageTo]);
                    } elseif (!empty($customerSearch->ageFrom)) {
                        $query->where('age', '>=', $customerSearch->ageFrom);
                    } elseif (!empty($customerSearch->ageTo)) {
                        $query->where('age', '<=', $customerSearch->ageTo);
                    }
                    if (isset($customerSearch->country_id) && !empty($customerSearch->country_id)) {
                        $query->where('country_id', $customerSearch->country_id);
                    }
                    if (isset($customerSearch->state_id) && $customerSearch->state_id > 0) {
                        $query->where('state_id', $customerSearch->state_id);
                    }
                    if (isset($customerSearch->city_id) && $customerSearch->city_id > 0) {
                        $query->where('city_id', $customerSearch->city_id);
                    }
                });
            }
            if (isset($customerSearch->Religions) && !empty($customerSearch->Religions)) {
                $customers = $customers->whereHas('customerReligionInfo', function($query) use ($customerSearch) {
                    $query->where('Religions', $customerSearch->Religions);
                });
            }
        }

        $customers = $customers->where('id','!=',$currentCustomerId)
//            ->orderByRaw("profile_pic_status DESC, profile_pic_client_status DESC")
            ->skip($skipProposals)
            ->take(5)
            ->without([
                'customerOtherInfo',
                'customerReligionInfo'
            ])
            ->orderBy('id','desc')
            ->get();

        $customers->makeHidden([
            'match_assign_lead_user_name',
            'match_assign_user_name',
            'assign_lead_user_name',
            'assign_user_name',
            'name',
            'gender_name',
            'image',
            'profile_pic_client_status',
            'faker_id',
            'un_seen_messages_count',
            'first_name',
            'last_name',
            'is_highlight',
            'profile_pic_status',
            'email_verified',
            'mobile_verified',
            'meeting_verification',
            'age_verification',
            'education_verification',
            'location_verification',
            'nationality_verification',
            'salary_verification',
            'deleted',
            'profile_status'
        ]);

        return response()->json([
            'success'  => true,
            'message' => 'My matches customers has been fetched successfully.',
            'data'    => $customers,
            'code'    => 200
        ], 200);

    }

}
