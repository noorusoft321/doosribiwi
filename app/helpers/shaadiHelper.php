<?php

use App\Models\City;
use App\Models\CustomerCareerInfo;
use App\Models\CustomerChattingFriend;
use App\Models\CustomerFamilyInfo;
use App\Models\CustomerImage;
use App\Models\CustomerNotificationPreference;
use App\Models\Customer;
use App\Models\CustomerPersonalInfo;
use App\Models\CustomerReligionInfo;
use App\Models\CustomerResidentialInfo;
use App\Models\CustomerSearch;
use App\Models\HobbiesAndInterest;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Pusher\Pusher;

if (!function_exists('testingWithDb')) {
    function testingWithDb() {
        dd('Check');
        $databaseName = DB::getDatabaseName();
        $myPrefixTable = 'shaadi_';
        $prefixForTable = "Tables_in_$databaseName";
        $allTables = DB::select('show tables');

//        $withoutCustomerDb = [];
        foreach($allTables as $table) {
            /* Change table name */
            if ($table->$prefixForTable!='personal_access_tokens') {
                Schema::rename($table->$prefixForTable, $myPrefixTable.$table->$prefixForTable);
            }

            /* for remove extra garbage */
//            if(stripos($table->$prefixForTable, "customer") === FALSE){
//                if (!in_array($table->$prefixForTable,[
//                    $myPrefixTable.'check_req',
//                    $myPrefixTable.'failed_jobs',
//                    $myPrefixTable.'migrations',
//                    $myPrefixTable.'password_resets'
//                ]))
//                DB::table($table->$prefixForTable)->where('deleted','!=',0)->delete();
//            }
        }

        /*Table all fillable columns */
//        $table = 'shaadi_are_you_reverts';
//        $allColumns = DB::select("describe $table");
//        foreach($allColumns as $column) {
//            if (!in_array($column->Field,['id','created_at','updated_at'])) {
//                echo $column->Field.'<br>';
//            }
//        }
        dd('All database name has changed successfully.');
    }
}

if (!function_exists('fireDoctorMessage')){
    function fireDoctorMessage($message){
        $options = array(
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => true
        );
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            $options
        );
        $message['only_time'] = date('h:i A');
        $pusher->trigger('receiver-channel', 'receiver-event', json_encode($message));
    }
}

//if (!function_exists('checkMessageLimit')){
//    function checkMessageLimit($customerId,$fetchCount=false){
//        $messageLimit = 10;
//        $CustomerNotificationPreference = CustomerNotificationPreference::where('customerID',$customerId)->first();
//
//        if (empty($CustomerNotificationPreference)) {
//            $CustomerNotificationPreference = new CustomerNotificationPreference();
//            $CustomerNotificationPreference->customerID = $customerId;
//            $CustomerNotificationPreference->messagelimits = $messageLimit;
//            $CustomerNotificationPreference->limit_start_date = date('Y-m-d');
//            $CustomerNotificationPreference->limit_end_date = date('Y-m-d',strtotime('+30 days'));
//            $CustomerNotificationPreference->save();
//        }
//
//        if (empty($CustomerNotificationPreference->limit_end_date)) {
//            $CustomerNotificationPreference->limit_start_date = date('Y-m-d');
//            $CustomerNotificationPreference->limit_end_date = date('Y-m-d',strtotime('+30 days'));
//            $CustomerNotificationPreference->save();
//        }
//
//        if (!empty($CustomerNotificationPreference)) {
//            $messageLimit = $CustomerNotificationPreference->messagelimits;
//            $messageCount = CustomerChatting::where("sender_id", $customerId)
//                ->whereBetween('created_at',[$CustomerNotificationPreference->limit_start_date." 00:00:00",$CustomerNotificationPreference->limit_end_date." 23:59:59"])
//                ->count();
//            if ($messageCount < $messageLimit) {
//                return (!empty($fetchCount)) ? [$messageLimit,$messageLimit - $messageCount] : true;
//            }
//        }
//        return (!empty($fetchCount)) ? [10,0] : false;
//    }
//}

if (!function_exists('checkMessageLimit')){
    function checkMessageLimit($customerId,$fetchCount=false,$receiverId=null) {
//        $startDate = date('Y-m-d 00:00:00');
//        $customer = Customer::with('customerPackage')->findOrFail($customerId);
//        if (!empty($customer->customerPackage)) {
//            $messageLimit = $customer->customerPackage->direct_messages;
//            $duration = $customer->customerPackage->duration;
//        } else {
//            $messageLimit = 10;
//            $duration = 30;
//        }
//        $endDate = date('Y-m-d 23:59:59', strtotime("+$duration days"));
//        $customerNotificationPreference = CustomerNotificationPreference::where('customerID',$customerId)->first();
//        if (empty($customerNotificationPreference)) {
//            $customerNotificationPreference = CustomerNotificationPreference::create([
//                'customerID'       => $customerId,
//                'messagelimits'    => $messageLimit,
//                'limit_start_date' => $startDate,
//                'limit_end_date'   => $endDate
//            ]);
//        }
//
//        if (empty($customerNotificationPreference->limit_end_date) || $customerNotificationPreference->limit_end_date < $startDate) {
//            $customerNotificationPreference = $customerNotificationPreference->update([
//                'messagelimits'    => 10,
//                'limit_start_date' => $startDate,
//                'limit_end_date'   => date('Y-m-d', strtotime("+30 days"))
//            ]);
//            $customer->update([
//                'package_id' => NULL,
//                'user_package' => 'Free',
//                'user_package_color' => NULL,
//                'package_expiry_date' => NULL
//            ]);
//        }
//
//        if (!empty($customerNotificationPreference)) {
//            $messageLimit = $customerNotificationPreference->messagelimits;
//            $messageCount = CustomerChattingFriend::where("sender_id", $customerId)
//                ->whereBetween('created_at',[$customerNotificationPreference,$customerNotificationPreference->limit_end_date])
//                ->count();
//            if ($messageCount < $messageLimit) {
//                return (!empty($fetchCount)) ? [$messageLimit,$messageLimit - $messageCount] : true;
//            }
//        }
//        return (!empty($fetchCount)) ? [10,0] : false;
//        return (!empty($fetchCount)) ? [$messageLimit,$messageLimit - $messageCount] : false;

//        $endDate = date('Y-m-d 23:59:59', strtotime("+$duration days"));
        $customerNotificationPreference = CustomerNotificationPreference::where('customerID',$customerId)->first();
        if (!empty($customerNotificationPreference)) {
            $messageLimit = $customerNotificationPreference->messagelimits;
            $messageCount = CustomerChattingFriend::where("sender_id", $customerId)
                ->whereBetween('created_at',[$customerNotificationPreference,$customerNotificationPreference->limit_end_date])
                ->count();
            if ($messageCount < $messageLimit) {
                return (!empty($fetchCount)) ? [$messageLimit,$messageLimit - $messageCount] : true;
            }
        } else {
            if (!empty($receiverId)) {
                $chatterAvailable = CustomerChattingFriend::where('deleted',0)->
                where([
                    ['sender_id',$customerId],
                    ['receiver_id',$receiverId]
                ])->orWhere([
                    ['receiver_id',$customerId],
                    ['sender_id',$receiverId]
                ])->count();
                if ($chatterAvailable > 0) {
                    return (!empty($fetchCount)) ? [0,0] : true;
                }
            }
        }
        return (!empty($fetchCount)) ? [0,0] : false;
    }
}

if (!function_exists('giveNewUserName')){
    function giveNewUserName($userName){
        $customerRow = Customer::where('name',$userName)->first();
        if (empty($customerRow)) {
            return $userName;
        }
        $lastWord = substr($userName, -1);
        if (empty(is_numeric($lastWord))) {
            return $userName."1";
        } else {
            $newLastWord = $lastWord + 1;
            return str_replace($lastWord,$newLastWord,$userName);
        }
    }
}

if (!function_exists('getCustomerRow')){
    function getCustomerRow($customerId=''){
        if (empty($customerId)) {
            $customerId = auth()->guard('customer')->id();
        }
        return Customer::where('id',$customerId)->first();
    }
}

if (!function_exists('sendAndroidNotification')){
    function sendAndroidNotification($title,$message,$deviceToken="fpc_Vr92Ts2CFRpYGf-jfo:APA91bG3xH6OArT877TbyUu6wzG94YL0DpsgfmhfW9lRBPbS49CNGjeYSfRM7eV1mxb9_2ahnlMbHSXAXOzdvmxXayYk_52WcABMEX3QntbDBgEt53oJ9aRtOOf85Ml8Q7YklGDzSgn_"){
        $SERVER_API_KEY = env('FIREBASE_SECRET_KEY');
        if (!empty($SERVER_API_KEY)) {
            if (!empty($deviceToken)){
                $data = [
                    "registration_ids" => [
                        $deviceToken
                    ],
                    "notification" => [
                        "title" => $title,
                        "body" => $message,
                    ]
                ];
                $dataString = json_encode($data);

                $headers = [
                    'Authorization: key=' . $SERVER_API_KEY,
                    'Content-Type: application/json',
                ];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

                $response = curl_exec($ch);

                return json_decode($response);
            }
        }
        return null;
    }
}

if (!function_exists('checkProfileComplete')) {
    function checkProfileComplete($customerId='') {
        if (empty($customerId)) {
            $customerId = auth()->id();
        }
        $profileComplete = false;
        $customerCareerInfo = CustomerCareerInfo::where('deleted', 0)
            ->where('CustomerID', $customerId)
            ->count();
        if ($customerCareerInfo > 0) {
            $CustomerPersonalInfoCount = CustomerPersonalInfo::where('deleted', 0)
                ->where('CustomerID', $customerId)
                ->count();
            if ($CustomerPersonalInfoCount > 0) {
                $CustomerReligionInfoCount = CustomerReligionInfo::where('deleted', 0)
                    ->where('CustomerID', $customerId)
                    ->count();
                if ($CustomerReligionInfoCount > 0) {
                    $customerSearchCount = CustomerSearch::where('deleted', 0)
                        ->where('customerID',$customerId)
                        ->count();
                    if ($customerSearchCount > 0) {
                        return true;
                    }
                }
            }
        }
        return $profileComplete;
    }
}

if (!function_exists('sendNewEmail')){
    function sendNewEmail($view,$data,$subject){
        $email = $data['email'];
        $sent = Mail::send($view, $data, function ($message) use ($email,$subject) {
            $message->subject($subject);
            $message->to($email);
//            $message->to(env('DEFAULT_EMAIL'), env('DEFAULT_NAME'));
//            $message->bcc(env('BCC_EMAIL'), env("BCC_NAME"));
        });
        return $sent;
    }
}

if (!function_exists('genericQuery')){
    function genericQuery($primaryId,$modelName,$fieldName='title'){
        try {
            if ($primaryId > 0) {
                $modelInstance = app("App\Models\\$modelName");
                $row = $modelInstance->select($fieldName)->where('id',$primaryId)->first();
                if (!empty($row)) {
                    return $row->$fieldName;
                }
            }
            return 'N/A';
        } catch (Exception $e) {
            return 'N/A';
        }
    }
}

if (!function_exists('getRelatedCities')){
    function getRelatedCities($cityId){
        $city = City::where(['id' => $cityId])->first();
        if (!empty($city)) {
            return City::where([
                'country_id' => $city->country_id,
                'deleted'    => 0
            ])->get();
        }
        return [];
    }
}

if (!function_exists('makeSlugToTitle')){
    function makeSlugToTitle($slug){
        $title = str_replace("-"," ",$slug);
        return ucwords($title);
    }
}

if (!function_exists('getHobbiesAndInterest')){
    function getHobbiesAndInterest($value){
        $realHobby = [];
        if (!empty($value)) {
            $value = explode(",",$value);
            $hobbies = HobbiesAndInterest::where('deleted',0)->whereIn('id',$value)->get();
            if (count($hobbies) > 0) {
                foreach ($hobbies as $val) {
                    $check ='<span class="btn btn-sm bg-red rounded mr-1 text-white">'.$val->title.'</span>';
                    array_push($realHobby,$check);
                }
            }
        }
        if (count($realHobby) > 0) {
            return implode("  ",$realHobby);
        }
        return 'N/A';
    }
}

if (!function_exists('checkProfileCompletePercent')) {
    function checkProfileCompletePercent($customer) {
        $completeProfiles = 0;

        /* Here start profile completion % */
        $customerCareerInfo = CustomerCareerInfo::where('deleted',0)->where('CustomerID',$customer->id)->first();
        $customerFamilyInfo = CustomerFamilyInfo::where('deleted',0)->where('CustomerID',$customer->id)->first();
        $customerResidentialInfo = CustomerResidentialInfo::where('deleted',0)->where('CustomerID',$customer->id)->first();
        $customerSearchingRow = CustomerSearch::where('deleted',0)->where('customerID',$customer->id)->first();
        $customerImagesCount = CustomerImage::where('deleted',0)->where('customerID',$customer->id)->count();

        $completeProfiles += ($customer->age_verification > 0) ? 3 : 0;
        $completeProfiles += ($customer->education_verification > 0) ? 3 : 0;
        $completeProfiles += ($customer->email_verified > 0) ? 3 : 0;
        $completeProfiles += ($customer->location_verification > 0) ? 3 : 0;
        $completeProfiles += ($customer->meeting_verification > 0) ? 3 : 0;
        $completeProfiles += ($customer->nationality_verification > 0) ? 3 : 0;
        $completeProfiles += ($customer->mobile_verified > 0) ? 3 : 0;
        $completeProfiles += ($customer->profile_pic_status > 0) ? 3 : 0;
        $completeProfiles += ($customer->salary_verification > 0) ? 3 : 0;
        $completeProfiles += (in_array($customer->image,["default-male.jpg","default-user.png","default-female.jpg"])===FALSE) ? 5 : 0;

        if (!empty($customerFamilyInfo)) {
            $completeProfiles += 5;
        }
        if (!empty($customerResidentialInfo)) {
            $completeProfiles += 5;
        }
        if ($customerImagesCount > 0) {
            $completeProfiles += 5;
        }

        if (isset($customer->customerOtherInfo) && !empty($customer->customerOtherInfo)) {
            $completeProfiles += ($customer->customerOtherInfo->gender > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerOtherInfo->age > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerOtherInfo->country_id > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerOtherInfo->state_id > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerOtherInfo->city_id > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerOtherInfo->MaritalStatusID > 0) ? 2 : 0;
            $completeProfiles += ($customer->customerOtherInfo->RegistrationsReasonsID > 0) ? 2 : 0;
            $completeProfiles += (!empty($customer->customerOtherInfo->persona_note)) ? 2 : 0;
            $completeProfiles += (!empty($customer->customerOtherInfo->hobbiesAndInterest)) ? 2 : 0;
            $completeProfiles += ($customer->customerOtherInfo->MyFirstLanguageMotherTonguesID > 0) ? 1 : 0;
        }

        if (!empty($customerCareerInfo)) {
            $completeProfiles += ($customerCareerInfo->Qualification > 0) ? 2 : 0;
//            $completeProfiles += ($customerCareerInfo->University > 0) ? 1 : 0;
            $completeProfiles += ($customerCareerInfo->Profession > 0) ? 2 : 0;
//            $completeProfiles += ($customerCareerInfo->JobPost > 0) ? 1 : 0;
            $completeProfiles += ($customerCareerInfo->MonthlyIncome > 0) ? 2 : 0;
//            $completeProfiles += ($customerCareerInfo->FuturePlans > 0) ? 1 : 0;
        } else {
            if (isset($customer->customerOtherInfo) && !empty($customer->customerOtherInfo)) {
                $completeProfiles += (!empty($customer->customerOtherInfo->EducationID) && $customer->customerOtherInfo->EducationID > 0) ? 2 : 0;
                $completeProfiles += (!empty($customer->customerOtherInfo->OccupationID) && $customer->customerOtherInfo->OccupationID > 0) ? 2 : 0;
            }
        }

        if (isset($customer->customerPersonalInfo) && !empty($customer->customerPersonalInfo)) {
//            $completeProfiles += ($customer->customerPersonalInfo->CountryOfOrigin > 0) ? 1 : 0;
//            $completeProfiles += ($customer->customerPersonalInfo->StateOfOrigin > 0) ? 1 : 0;
//            $completeProfiles += ($customer->customerPersonalInfo->CityOfOrigin > 0) ? 1 : 0;
//            $completeProfiles += ($customer->customerPersonalInfo->WillingToRelocate > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->IAmLookingToMarry > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->MyLivingArrangements > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->Heights > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->Weights > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->Complexions > 0) ? 1 : 0;
//            $completeProfiles += ($customer->customerPersonalInfo->MyBuilds > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->HairColors > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->EyeColors > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->Smokes > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->Disabilities > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerPersonalInfo->Caste > 0) ? 1 : 0;
        }

        if (isset($customer->customerReligionInfo) && !empty($customer->customerReligionInfo)) {
            $completeProfiles += ($customer->customerReligionInfo->Religions > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerReligionInfo->Sects > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerReligionInfo->DoYouPreferHijabs > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerReligionInfo->DoYouHaveBeards > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerReligionInfo->AreYouReverts > 0) ? 1 : 0;
            $completeProfiles += ($customer->customerReligionInfo->DoYouKeepHalal > 0) ? 1 : 0;
//            $completeProfiles += ($customer->customerReligionInfo->DoYouPerformSalaah > 0) ? 1 : 0;
        } else {
            if (isset($customer->customerOtherInfo) && !empty($customer->customerOtherInfo)) {
                $completeProfiles += ($customer->customerOtherInfo->ReligionsID > 0) ? 1 : 0;
                $completeProfiles += ($customer->customerOtherInfo->SectID > 0) ? 1 : 0;
            }
        }

        if (!empty($customerSearchingRow) && !empty($customerSearchingRow->title)) {
            $customerSearching = json_decode($customerSearchingRow->title);
            if (!empty($customerSearching)) {
                $completeProfiles += (isset($customerSearching->gender) && $customerSearching->gender > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->ageFrom) && $customerSearching->ageFrom > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->ageTo) && $customerSearching->ageTo > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->country_id) && $customerSearching->country_id > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->state_id) && $customerSearching->state_id > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->city_id) && $customerSearching->city_id > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->Tongue) && $customerSearching->Tongue > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->Religions) && $customerSearching->Religions > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->Sects) && $customerSearching->Sects > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->EducationID) && $customerSearching->EducationID > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->OccupationID) && $customerSearching->OccupationID > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->MyIncome) && $customerSearching->MyIncome > 0) ? 1 : 0;
//                $completeProfiles += (isset($customerSearching->WillingToRelocate) && $customerSearching->WillingToRelocate > 0) ? 1 : 0;
//                $completeProfiles += (isset($customerSearching->MyBuilds) && $customerSearching->MyBuilds > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->MaritalStatus) && $customerSearching->MaritalStatus > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->MyLivingArrangements) && $customerSearching->MyLivingArrangements > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->Heights) && $customerSearching->Heights > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->Disabilities) && $customerSearching->Disabilities > 0) ? 1 : 0;
                $completeProfiles += (isset($customerSearching->Castes) && $customerSearching->Castes > 0) ? 1 : 0;
            }
        }
        return $completeProfiles;
    }
}

if (!function_exists('customerMatchesPercentage')) {
    function customerMatchesPercentage($customer) {
        $customerMatchesPercentage = 0;

        $customerCareerInfo = CustomerCareerInfo::where('deleted',0)->where('CustomerID',$customer->id)->first();
        if (auth()->guard('customer')->check()) {
            $customerSearchingRow = CustomerSearch::where('customerID', auth()->guard('customer')->id())->first();
            if (!empty($customerSearchingRow)) {
                $customerSearching = json_decode($customerSearchingRow->title);
                if (isset($customer->customerOtherInfo) && !empty($customer->customerOtherInfo)) {
                    $customerMatchesPercentage += (isset($customerSearching->ageFrom) && isset($customerSearching->ageTo) && $customer->customerOtherInfo->age >= $customerSearching->ageFrom && $customer->customerOtherInfo->age <= $customerSearching->ageTo) ? 20 : 0;
                    $customerMatchesPercentage += (isset($customerSearching->gender) && $customer->customerOtherInfo->gender == $customerSearching->gender) ? 20 : 0;
                    $customerMatchesPercentage += (isset($customerSearching->MaritalStatus) ? (empty($customerSearching->MaritalStatus) || $customerSearching->MaritalStatus==0 ? 15 : ($customer->customerOtherInfo->MaritalStatusID == $customerSearching->MaritalStatus ? 15 : 0) ) : 0);
                    $customerMatchesPercentage += (isset($customerSearching->country_id) && $customer->customerOtherInfo->country_id == $customerSearching->country_id) ? 8 : 0;
                    $customerMatchesPercentage += (isset($customerSearching->state_id) ? (empty($customerSearching->state_id) || $customerSearching->state_id==0 ? 7 : ($customer->customerOtherInfo->state_id == $customerSearching->state_id ? 7 : 0) ) : 0);
                }

                if (isset($customer->customerReligionInfo) && !empty($customer->customerReligionInfo)) {
                    $customerMatchesPercentage += (isset($customerSearching->Religions) && $customer->customerReligionInfo->Religions == $customerSearching->Religions) ? 15 : 0;
                }

                if (!empty($customerCareerInfo)) {
                    $customerMatchesPercentage += (isset($customerSearching->EducationID) ? (empty($customerSearching->EducationID) || $customerSearching->EducationID==0 ? 7 : ($customerCareerInfo->Qualification == $customerSearching->EducationID ? 7 : 0) ) : 0);
                } else {
                    if (isset($customer->customerOtherInfo) && !empty($customer->customerOtherInfo)) {
                        $customerMatchesPercentage += (isset($customerSearching->EducationID) ? (empty($customerSearching->EducationID) || $customerSearching->EducationID==0 ? 7 : ($customer->customerOtherInfo->EducationID == $customerSearching->EducationID ? 7 : 0) ) : 0);
                    }
                }
                return $customerMatchesPercentage;
            }
        }
        return $customerMatchesPercentage;
    }
}

if (!function_exists('requestFetchStatesByApi')) {
    function requestFetchStatesByApi($countryName) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://countriesnow.space/api/v0.1/countries/states/q?country='.$countryName,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        if (isset($result->error) && $result->error==false && isset($result->data->states)) {
            return $result->data->states;
        }
        return false;
    }
}

if (!function_exists('requestFetchCitiesByApi')) {
    function requestFetchCitiesByApi($countryName,$stateName){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://countriesnow.space/api/v0.1/countries/state/cities/q?country=$countryName&state=$stateName",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        if (isset($result->error) && $result->error==false && isset($result->data)) {
            return $result->data;
        }
        return false;
    }
}

if (!function_exists('getMyPackage')) {
    function getMyPackage($packageId){
        return Package::findOrFail($packageId);
    }
}

if (!function_exists('getCurrentPackageExpiryDate')) {
    function getCurrentPackageExpiryDate(){
        if (auth()->guard('customer')->check()) {
            return Customer::where('id',$customerId)->first();
            $customerId = auth()->guard('customer')->id();
        }
        if (empty($customerId)) {
            $customerId = auth()->guard('customer')->id();
        }
        return Customer::where('id',$customerId)->first();
        return Package::findOrFail($packageId);
    }
}