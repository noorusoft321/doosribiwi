<?php

namespace App\Http\Controllers\Front;

use App\helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\AnnualInCome;
use App\Models\AreYouRevert;
use App\Models\Caste;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerBlock;
//use App\Models\CustomerCareerInfo;
use App\Models\CustomerImage;
use App\Models\CustomerLike;
//use App\Models\CustomerPersonalInfo;
use App\Models\CustomerProfileView;
//use App\Models\CustomerReligionInfo;
use App\Models\CustomerSaved;
use App\Models\CustomerSearch;
use App\Models\Disability;
use App\Models\DoYouHaveBeard;
use App\Models\DoYouKeepHalal;
use App\Models\DoYouPerformSalaah;
use App\Models\DoYouPreferHijab;
use App\Models\Education;
use App\Models\EyeColor;
//use App\Models\FamilyRishtaMeeting;
use App\Models\GovermentRegisteredMarraigeBureau;
//use App\Models\GrandMatchmakingEvent;
use App\Models\HairColor;
use App\Models\Height;
use App\Models\IAmLookingToMarry;
use App\Models\MaritalStatus;
use App\Models\MotherTongue;
use App\Models\MyBuild;
use App\Models\MyLivingArrangement;
use App\Models\Occupation;
//use App\Models\OurOffice;
use App\Models\Religion;
//use App\Models\SpecialGuest;
use App\Models\State;
use App\Models\WillingToRelocate;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        /*If Customer Logged In*/
//        if (auth()->guard('customer')->check()) {
//            $customer = Customer::findOrFail(auth()->guard('customer')->id());
//            if ($customer->profile_status == 2) {
//                auth()->guard('customer')->logout();
//                session::flash('error_message', "Your account blocked / deleted please contact administration thanks");
//                return redirect()->route('landing.page');
//            }
//
//            if ($customer->mobile_verified == 0 && $customer->email_verified == 0) {
//                session::flash('error_message', "Please verify your mobile number or email first");
//                return redirect()->route('auth.verify');
//            }
//
//            $customerCareerInfo = CustomerCareerInfo::where('CustomerID',$customer->id)->count();
//            if ($customerCareerInfo==0) {
//                session::flash('error_message', "Please add education info first thanks...!");
//                return redirect()->route('education.form');
//            }
//
//            $customerPersonalInfo = CustomerPersonalInfo::where('CustomerID',$customer->id)->count();
//            if ($customerPersonalInfo==0) {
//                session::flash('error_message', "Please add Personal Information info first thanks...!");
//                return redirect()->route('personal.form');
//            }
//
//            $customerReligionInfo = CustomerReligionInfo::where('CustomerID',$customer->id)->count();
//            if ($customerReligionInfo==0) {
//                session::flash('error_message', "Please add Religion info first thanks...!");
//                return redirect()->route('religion.form');
//            }
//
//            $customerSearch = CustomerSearch::where('customerID',$customer->id)->count();
//            if ($customerSearch==0) {
//                session::flash('error_message', "Please add Expectations info first thanks...!");
//                return redirect()->route('expectation.form');
//            }
//        }

        /*Government Registered Marriage Bureau*/
        $govermentRegisteredMarraigeBureau = GovermentRegisteredMarraigeBureau::where('deleted', 0)->limit(5)->inRandomOrder()->get();
        $oppositeGender = (auth()->guard('customer')->check()) ? auth()->guard('customer')->user()->gender_name : null;
        $title = 'Rishta Pakistan, Shaadi Marriage Bureau, Best Muslima Matrimonial in Pakistan Karachi, Lahore, Islamabad, Faisalabad, Rawalpindi, Gujranwala, Peshawar, Multan, Hyderabad, Islamabad, Quetta. Shia Match available.';
        return view('front.index',compact(
            'title',
            'govermentRegisteredMarraigeBureau',
            'oppositeGender'
        ));
    }

    public function getAllProposals()
    {
        $customersSecondMarriageFemale = Customer::where([
            'profile_home_page_status' => 1,
            'profile_status'           => 1,
            'second_marraige'          => 2,
            'mobile_verified'          => 1,
            'email_verified'           => 1,
            'age_verification'         => 1,
            'education_verification'   => 1,
            'location_verification'    => 1,
            'meeting_verification'     => 1,
            'nationality_verification' => 1,
            'salary_verification'      => 1,
        ])->with(['getCountryName','getCitiesName','getOccupationName','customerOtherInfo' => function($query) {
            $query->where('gender', 2);
        }])->whereHas('customerOtherInfo', function($query) {
            $query->where('gender', 2);
        })->inRandomOrder()->limit(5)->get();

        $customersSecondMarriageMan = Customer::where([
//            'profile_home_page_status' => 1,
            'profile_status'           => 1,
            'second_marraige'          => 1,
            'mobile_verified'          => 1,
            'email_verified'           => 1,
//            'age_verification'         => 1,
//            'education_verification'   => 1,
//            'location_verification'    => 1,
//            'meeting_verification'     => 1,
//            'nationality_verification' => 1,
//            'salary_verification'      => 1,
        ])->with(['getCountryName','getCitiesName','getOccupationName','customerOtherInfo' => function($query) {
            $query->where('gender', 1);
        }])->whereHas('customerOtherInfo', function($query) {
            $query->where('gender', 1);
        })->inRandomOrder()->limit(5)->get();

        $result = [
            'females_ready' => view('front.partial_proposal',['customers' => $customersSecondMarriageFemale])->render(),
            'males_looking' => view('front.partial_proposal',['customers' => $customersSecondMarriageMan])->render()
        ];
        return response()->json($result);
    }

    public function searchBySlug($slug)
    {
        $slugArr = explode("-",$slug);
        if (in_array($slugArr[0],["male","female","NA"]) && $slugArr[1]=="proposal") {
            $customerFakerId = end($slugArr);
            $customer = Customer::with([
                'customerOtherInfo',
                'customerPersonalInfo',
                'customerSearch',
                'customerReligionInfo',
                'customerCareerInfo'
            ])->where('id',$customerFakerId)->first();
            if (!empty($customer)) {

                $customerBlockByMe = false;
                $customerLikedByMe = false;
                $customerSaveByMe = false;
                if (auth()->guard('customer')->check()) {
                    $currentCustomerId = auth()->guard('customer')->id();
                    $customerBlockByMe = !! CustomerBlock::where([
                        'blockBy' => $currentCustomerId,
                        'blockTo' => $customer->id
                    ])->count();

                    $customerLikedByMe = !! CustomerLike::where([
                        'like_by' => $currentCustomerId,
                        'like_to' => $customer->id
                    ])->count();

                    $customerSaveByMe = !! CustomerSaved::where([
                        'save_by' => $currentCustomerId,
                        'save_to' => $customer->id
                    ])->count();
                    $viewRequest = [
                        'view_to' => $customer->id,
                        'view_by' => $currentCustomerId
                    ];
                    $viewExist = CustomerProfileView::where($viewRequest)->first();
                    if (empty($viewExist)) {
                        CustomerProfileView::create($viewRequest);
                    }
                }

                $profileViewsCount = CustomerProfileView::where([
                    'view_to' => $customer->id,
                    'deleted' => 0
                ])->count();

                $profileLikesCount = CustomerLike::where([
                    'like_to' => $customer->id,
                    'deleted' => 0
                ])->count();

                $profileSavesCount = CustomerSaved::where([
                    'save_to' => $customer->id,
                    'deleted' => 0
                ])->count();

                $customerImages = CustomerImage::where([
                    'CustomerID' => $customer->id,
                    'deleted'    => 0
                ])->get();

                $title = $slug;
                $noCanonicalTitle = true;

                return view('front.customer.view_profile',compact(
                    'title',
                    'customer',
                    'profileViewsCount',
                    'profileLikesCount',
                    'profileSavesCount',
                    'customerBlockByMe',
                    'customerLikedByMe',
                    'customerSaveByMe',
                    'customerImages',
                    'noCanonicalTitle'
                ));
            }
        }
        $customerSearch = null;
        $currentCustomerId = '';
        $states            = [];
        $cities            = [];
        $currentUserGenderExp = '';
        if (auth()->guard('customer')->check()) {
            $currentCustomerId = auth()->guard('customer')->id();
            $currentUserGenderExp = (auth()->guard('customer')->user()->gender_name=='Male') ? 2 : 1;
        }
//        $needStatusWhere = [
//            'profile_status'           => 1,
//            'email_verified'           => 1,
//            'age_verification'         => 1,
//            'education_verification'   => 1,
//            'location_verification'    => 1,
//            'meeting_verification'     => 1,
//            'nationality_verification' => 1,
//            'salary_verification'      => 1,
//            'profile_pic_status'       => 1
//        ];
//        $needStatusWhere2 = [
//            'profile_status'           => 1,
//            'profile_pic_status'       => 1
//        ];
        switch ($slug) {
//            case "foreign-proposals":
//                $customers = Customer::where($needStatusWhere2)->with(['customerOtherInfo' => function($query) {
//                    $query->where('country_id','!=',162);
//                }])->whereHas('customerOtherInfo', function($query) {
//                    $query->where('country_id','!=',162);
//                });
//                break;
//            case "verified-proposals":
//                $customers = Customer::where($needStatusWhere);
//                break;
//            case "featured-proposals":
//                $customers = Customer::where($needStatusWhere)->where('featuredProfile',1);
//                break;
            case "females-Ready-for-second-marriage":
                $customers = Customer::where('second_marraige',2)
                    ->with(['customerOtherInfo' => function($query) {
                    $query->where('gender', 2);
                }])->whereHas('customerOtherInfo', function($query) {
                    $query->where('gender', 2);
                });
                break;
            case "males-Looking-for-second-Wife":
                $customers = Customer::where('second_marraige',1)
                    ->with(['customerOtherInfo' => function($query) {
                    $query->where('gender', 1);
                }])->whereHas('customerOtherInfo', function($query) {
                    $query->where('gender', 1);
                });
                break;
            case "my-matches":
                if (!empty($currentCustomerId)) {
                    $customerSearchRow = CustomerSearch::where('customerID',$currentCustomerId)->first();
                    if (!empty($customerSearchRow) && !empty($customerSearchRow->title)) {
                        $customerSearch = json_decode($customerSearchRow->title);
                    }
                }
                $customers = Customer::where([
                    'profile_status' => 1
                ])->with([
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
                        if (isset($customerSearch->state_id) && $customerSearch->state_id > 0) {
                            $query->where('state_id', $customerSearch->state_id);
                        }
                        if (isset($customerSearch->city_id) && $customerSearch->city_id > 0) {
                            $query->where('city_id', $customerSearch->city_id);
                        }
                    }, 'customerReligionInfo' => function($query) use ($customerSearch) {
                        if (isset($customerSearch->Religions) && !empty($customerSearch->Religions)) {
                            $query->where('Religions', $customerSearch->Religions);
                        }
                    }]);

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
                    if (isset($customerSearch->country_id) && !empty($customerSearch->country_id)) {
                        $states = State::where('deleted',0)->where('country_id',$customerSearch->country_id)->get();
                    }
                    if (isset($customerSearch->state_id) && !empty($customerSearch->state_id)) {
                        $cities = City::where('deleted',0)->where('state_id',$customerSearch->state_id)->get();
                    }

                }
                if (isset($customerSearch->Religions) && !empty($customerSearch->Religions)) {
                    $customers = $customers->whereHas('customerReligionInfo', function($query) use ($customerSearch) {
                        $query->where('Religions', $customerSearch->Religions);
                    });
                }
                break;
            default:
                $customers = Customer::with([
                    'getCountryName',
                    'getCitiesName',
                    'getReligionName',
                    'getSectName',
                    'getCasteName',
                    'getMotherTongueName',
                    'getMaritalStatusName',
                    'getHeightName',
                    'getCountrySlug',
                    'getCitySlug',
                    'customerOtherInfo' => function($q) use($currentUserGenderExp){
                        if (!empty($currentUserGenderExp)) {
                            $q->where('gender', $currentUserGenderExp);
                        }
                    }
                ]);

                if (!empty($currentUserGenderExp)) {
                    $customers = $customers->whereHas('customerOtherInfo', function($q) use($currentUserGenderExp){
                        $q->where('gender', $currentUserGenderExp);
                    });
                }
        }

        if (!empty($currentCustomerId)) {
            $customers = $customers->where('id','!=',$currentCustomerId);
        }

        $customers = $customers->where([
            'deleted'        => 0,
            'profile_status' => 1,
            'email_verified' => 1
        ])->orderBy('profile_pic_client_status','desc')
            ->limit(10)
            ->get();

        $countries         = Country::where('deleted',0)->get();
        $religions         = Religion::where('deleted',0)->get();
        $sects             = [];
        $preferHijabs      = DoYouPreferHijab::where('deleted',0)->get();
        $beards            = DoYouHaveBeard::where('deleted',0)->get();
        $reverts           = AreYouRevert::where('deleted',0)->get();
        $halals            = DoYouKeepHalal::where('deleted',0)->get();
        $performSalaahs    = DoYouPerformSalaah::where('deleted',0)->get();
        $educations        = Education::where('deleted',0)->get();
        $tongues           = MotherTongue::where('deleted',0)->get();
        $occupations       = Occupation::where('deleted',0)->get();
        $willingToRelocate = WillingToRelocate::where('deleted',0)->get();
        $incomes           = AnnualInCome::where('deleted',0)->get();
        $lookingToMarry    = IAmLookingToMarry::where('deleted',0)->get();
        $maritalStatuses   = MaritalStatus::where('deleted',0)->get();
        $livingArrangement = MyLivingArrangement::where('deleted',0)->get();
        $heights           = Height::where('deleted',0)->get();
        $myBuilds          = MyBuild::where('deleted',0)->get();
        $hairColors        = HairColor::where('deleted',0)->get();
        $eyeColors         = EyeColor::where('deleted',0)->get();
        $disabilities      = Disability::where('deleted',0)->get();
        $castes            = Caste::where('deleted',0)->get();

        $title = $slug;

        return view('front.search',compact(
            'title',
            'customers',
            'countries',
            'states',
            'cities',
            'religions',
            'sects',
            'preferHijabs',
            'beards',
            'reverts',
            'halals',
            'performSalaahs',
            'educations',
            'tongues',
            'occupations',
            'willingToRelocate',
            'incomes',
            'lookingToMarry',
            'maritalStatuses',
            'livingArrangement',
            'heights',
            'myBuilds',
            'hairColors',
            'eyeColors',
            'disabilities',
            'castes',
            'slug',
            'customerSearch'
        ));

    }

    public function blog()
    {
        $title = 'Blogs';
        return view('front.blog.index',compact('title'));
    }

    public function secretstoahappymarriedlife()
    {
        $title = 'secrets to a happy married life';
        return view('front.blog.secretstoahappymarriedlife',compact('title'));
    }

    /*Safety Security and Privacy*/
    public function besthoneymoondestinationsinpakistan()
    {
        $title = 'best honey moon destinations in pakistan';
        return view('front.blog.besthoneymoondestinationsinpakistan',compact('title'));
    }

    /*Safety Security and Privacy*/
    public function bestmarriagebureauinkarachishaadiorganizationpakistan()
    {
        $title = 'best marriage bureau in karachi Doosri Biwi';
        return view('front.blog.bestmarriagebureauinkarachishaadiorganizationpakistan',compact('title'));
    }

    /*Safety Security and Privacy*/
    public function howmatrimonialsitescanhelpyoufindarishtaintheusa()
    {
        $title = 'how matrimonial sites can help you find a rishta in theusa';
        return view('front.blog.howmatrimonialsitescanhelpyoufindarishtaintheusa',compact('title'));
    }

    /*Safety Security and Privacy*/
    public function howtodealwithdifferencesinamarriage()
    {
        $title = 'how to deal with differences in a marriage';
        return view('front.blog.howtodealwithdifferencesinamarriage',compact('title'));
    }

    public function howtofindthebestauthenticshaadiwebsitesinpakistan()
    {
        $title = 'how to find the best authentic shaadi websites in pakistan';
        return view('front.blog.howtofindthebestauthenticshaadiwebsitesinpakistan',compact('title'));
    }


    public function howtofindyourideallifepartner()
    {
        $title = 'how to find your ideal life partner';
        return view('front.blog.howtofindyourideallifepartner',compact('title'));
    }

    public function howtofindyourperfectbrideintodaysmodernera()
    {
        $title = 'how to find your perfect bride in todays modern era';
        return view('front.blog.howtofindyourperfectbrideintodaysmodernera',compact('title'));
    }

    public function howtoliveyourhappilyeveafter()
    {
        $title = 'how to live your happilyeve after';
        return view('front.blog.howtoliveyourhappilyeveafter',compact('title'));
    }

    public function howtolookforaperfectrishtainpakistan()
    {
        $title = 'how to look for a perfect rishta in pakistan';
        return view('front.blog.howtolookforaperfectrishtainpakistan',compact('title'));
    }

    public function howtolookfortheperfectgroominpakistan()
    {
        $title = 'how to look for the perfect groom in pakistan';
        return view('front.blog.howtolookfortheperfectgroominpakistan',compact('title'));
    }

    public function howtoplanaweddinginpakistanwhilestayingonbudget()
    {
        $title = 'how top lana wedding in pakistan while stay in gon budget';
        return view('front.blog.howtoplanaweddinginpakistanwhilestayingonbudget',compact('title'));
    }

    public function howtoseekyourlifepartnerthroughshaadiwebsites()
    {
        $title = 'how to seek your life partner through shaadi websites';
        return view('front.blog.howtoseekyourlifepartnerthroughshaadiwebsites',compact('title'));
    }

    public function marriagetrendsinpakistanthenvsnow()
    {
        $title = 'marriage trends in pakistan then v snow';
        return view('front.blog.marriagetrendsinpakistanthenvsnow',compact('title'));
    }

    public function onlinemarriagesitesthebestwaytofindtherightpartner()
    {
        $title = 'online marriage sites the best way to find the right partner';
        return view('front.blog.onlinemarriagesitesthebestwaytofindtherightpartner',compact('title'));
    }

    public function pakistaniweddingpreparationthingstonotleavetothelastminute()
    {
        $title = 'pakistani wedding preparation things to not leave to the last minute';
        return view('front.blog.pakistaniweddingpreparationthingstonotleavetothelastminute',compact('title'));
    }

    public function premarriagetodolistforbrides()
    {
        $title = 'pre marriage todo list for brides';
        return view('front.blog.premarriagetodolistforbrides',compact('title'));
    }

    public function reasonstoInvestinamatrimonialserviceprovider()
    {
        $title = 'reasons to Invest in a matrimonial service provider';
        return view('front.blog.reasonstoInvestinamatrimonialserviceprovider',compact('title'));
    }

    public function reasonswhydesiweddingsarethebest()
    {
        $title = 'reasons why desi weddings are the best';
        return view('front.blog.reasonswhydesiweddingsarethebest',compact('title'));
    }

    public function reasonswhyyoushouldhirematchmakers()
    {
        $title = 'reasons why you should hire match makers';
        return view('front.blog.reasonswhyyoushouldhirematchmakers',compact('title'));
    }

    public function roleofkarachimatrimonialservicesinfindingyouasuitablepartner()
    {
        $title = 'role of karachi matrimonial services in finding you a suitable partner';
        return view('front.blog.roleofkarachimatrimonialservicesinfindingyouasuitablepartner',compact('title'));
    }

    public function shaadiexpopakistanwhatItisallabout()
    {
        $title = 'shaadi expo pakistan what It is all about';
        return view('front.blog.shaadiexpopakistanwhatItisallabout',compact('title'));
    }

    public function shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings()
    {
        $title = 'Doosri Biwi match making events to facility a to new beginnings';
        return view('front.blog.shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings',compact('title'));
    }

    public function theroleofshaadiwebsitesinpakistaniculture()
    {
        $title = 'the role of shaadi websites in pakistani culture';
        return view('front.blog.theroleofshaadiwebsitesinpakistaniculture',compact('title'));
    }

    public function theultimateguidetosettingtherightbeautyregimenforradiantbeauty()
    {
        $title = 'the ultimate guide to setting the right beauty regimen forradiant beauty';
        return view('front.blog.theultimateguidetosettingtherightbeautyregimenforradiantbeauty',compact('title'));
    }

    public function thingseverygirlmustdobeforeherbigday()
    {
        $title = 'things every girl must do before her big day';
        return view('front.blog.thingseverygirlmustdobeforeherbigday',compact('title'));
    }

    public function thingstoavoidinmarriage()
    {
        $title = 'things to avoid in marriage';
        return view('front.blog.thingstoavoidinmarriage',compact('title'));
    }

    public function thingsyouneedtoknowaboutelitematrimonialservice()
    {
        $title = 'things you need to know about elite matrimonial service';
        return view('front.blog.thingsyouneedtoknowaboutelitematrimonialservice',compact('title'));
    }

    public function tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws()
    {
        $title = 'tips that will help you build a good relationship with your in laws';
        return view('front.blog.tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws',compact('title'));
    }

    public function topadvantagesofpakistanrishtasites()
    {
        $title = 'top a dvantages of pakistan rishta sites';
        return view('front.blog.topadvantagesofpakistanrishtasites',compact('title'));
    }

    public function whatthetopmatrimonialservicesinpakistanpromisetodeliver()
    {
        $title = 'what the top matrimonial services in pakistan promise to deliver';
        return view('front.blog.whatthetopmatrimonialservicesinpakistanpromisetodeliver',compact('title'));
    }

    public function whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices()
    {
        $title = 'why choose pakistan matrimonial sites for top not match making services';
        return view('front.blog.whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices',compact('title'));
    }

    public function eliteMatrimonial()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'your_name'    => 'required|max:255',
            'your_number'  => 'required|max:255',
            'your_message' => 'required|max:255',
            'your_email'   => 'required|email|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status'=>'error'],422);
        }

        $data = $request;
        $data['email'] = 'admin@DoosriBiwi.com';

        sendNewEmail('emails.elite_matrimonial_email',$data,'Elite Matrimony Consultant - LEAD - DoosriBiwi.com');

        return response()->json([
            'status' => 'success',
            'msg'    => 'Thanks for contact we will response soon.'
        ]);
    }

    public function paymentOption()
    {
        $title = 'Payment Options';
        return view('front.general.payment',compact('title'));
    }

    public function fetchStatesAndCities($countryName='')
    {
        if (!empty($countryName)) {
            $countryRow = Country::where('name',$countryName)->first();
            if (empty($countryRow)) {
                abort(404);
            }
            $states = requestFetchStatesByApi($countryRow->name);
            if (!empty($states)) {
                foreach($states as $state) {
                    $stateRow = State::where([
                        'country_id' => $countryRow->id,
                        'title'      => $state->name
                    ])->first();
                    if (empty($stateRow)) {
                        $stateRow = State::create([
                            'country_id' => $countryRow->id,
                            'title'      => $state->name,
                            'slug'       => Str::slug($state->name)
                        ]);
                    }
                    $cities = requestFetchCitiesByApi($countryRow->name,$stateRow->title);
                    if (!empty($cities)) {
                        foreach ($cities as $city) {
                            $cityRow = City::where([
                                'country_id' => $countryRow->id,
                                'state_id'   => $stateRow->id,
                                'title'      => $city,
                            ])->first();
                            if (empty($cityRow)) {
                                City::create([
                                    'country_id' => $countryRow->id,
                                    'state_id'   => $stateRow->id,
                                    'title'      => $city,
                                    'slug'       => Str::slug($city)
                                ]);
                            }
                        }
                    } else {
                        City::create([
                            'country_id' => $countryRow->id,
                            'state_id'   => $stateRow->id,
                            'title'      => 'Other',
                            'slug'       => 'other'
                        ]);
                    }

                }
            } else {
                $stateRow = State::create([
                    'country_id' => $countryRow->id,
                    'title'      => 'Other',
                    'slug'       => 'other'
                ]);
                if (!empty($stateRow)) {
                    City::create([
                        'country_id' => $countryRow->id,
                        'state_id'   => $stateRow->id,
                        'title'      => 'Other',
                        'slug'       => 'other'
                    ]);
                }
            }
            return redirect()->route('fetch.states.and.cities');
        } else {
            $countries = Country::with('getStates')->where('deleted',0)->doesntHave('getStates')->pluck('name')->toArray();
            return view('only_countries',compact('countries'));
        }
    }

    public function getMatchMaker($slug)
    {
        switch ($slug) {
            case "mrs-ali":
                $title = 'Mrs Ali';
                break;
            case "mrs-syed":
                $title = 'Mrs Syed';
                break;
            case 2:
                $title = 'Mrs Ali';
                break;
        }
        return view("front.matchmaker.$slug",compact('title'));
    }
}
