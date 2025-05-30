<?php

namespace App\Models;
use App\helpers\FakerURL;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    protected $table = 'shaadi_customers';
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable =[
        'first_name',
        'last_name',
        'name',
        'email',
        'user_type',
        'mobile',
        'image',
        'email_verified_at',
        'email_verified',
        'mobile_verified_at',
        'mobile_verified',
        'age_verification',
        'education_verification',
        'location_verification',
        'meeting_verification',
        'nationality_verification',
        'salary_verification',
        'mobile_country_code',
        'mobile_code',
        'profile_home_page_status',
        'profile_pic_status',
        'profile_pic_client_status',
        'blur_percent',
        'profile_gallery_status',
        'profile_gallery_client_status',
        'profile_status',
        'customer_register_by',
        'password',
        'remember_token',
        'status',
        'deleted',
        'deleted_by',
        'created_by',
        'updated_by',
        'logged_in',
        'logged_in_at',
        'logged_out_at',
        'logged_in_by',
        'agent_mobile',
        'shaadi_org_id',
        'featuredProfile',
        'second_marraige',
        'user_package',
        'user_package_color',
        'package_id',
        'package_expiry_date',
        'CustomerSupportNote',
        'user_id',
        'user_lead_id',
        'assign_datetime',
        'last_activity_datetime',
        'match_user_id',
        'match_user_lead_id',
        'match_assign_datetime',
        'lead_status',
        'source',
        'client_status',
        'data_entry_user_id',
        'ip_address',
        'changes_approval',
        'rejected_reason',
        'blocked_reason',
        'is_highlight',
        'last_activity'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//'lastMessage',
    protected $appends = ['faker_id','full_name','verification_status','imageFullPath','un_seen_messages_count','age','gender_name','assign_user_name','assign_lead_user_name','match_assign_user_name','match_assign_lead_user_name'];

    public function getFakerIdAttribute()
    {
        return FakerURL::id_e($this->id);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getVerificationStatusAttribute()
    {
        if (
            $this->email_verified==1 &&
            $this->mobile_verified==1 &&
            $this->profile_pic_status==1 &&
            $this->meeting_verification==1 &&
            $this->age_verification==1 &&
            $this->education_verification==1 &&
            $this->location_verification==1 &&
            $this->nationality_verification==1
        ) {
            // return 'Verified';
            return '1';
        } elseif ($this->email_verified==1 &&
            $this->mobile_verified==1 &&
            $this->profile_pic_status==1 &&
            $this->meeting_verification==1) {
            // return 'Semi Verified';
            return '3';
        } else {
            // return 'Not Verified';
            return '2';
        }
    }

    public function getImageFullPathAttribute()
    {
        $appUrl = env('APP_URL');
        if ($this->profile_pic_client_status==0) {
            return $appUrl.'/assets/img/only-me.jpg';
        }
        if ($this->profile_pic_client_status==1 && $this->profile_pic_status==1 && !empty($this->image)) {
            if (file_exists(public_path('customer-images/'.$this->image))) {
                return $appUrl.'/customer-images/'.$this->image;
            }
        }
        if (!empty($this->customerOtherInfo()->first())) {
            return ($this->customerOtherInfo()->first()->gender==1) ? $appUrl.'/customer-images/default-male.jpg' : $appUrl.'/customer-images/default-female.jpg';
        }
        return $appUrl.'/customer-images/default-user.png';
    }

    public function getUnSeenMessagesCountAttribute()
    {
        if (auth()->guard('customer')->check()) {
            return CustomerChatting::where('sender_id', $this->id)->where('receiver_id', auth()->guard('customer')->id())->where('message_status',1)->count();
        } else {
            return CustomerChatting::where('sender_id', $this->id)->where('receiver_id', auth()->id())->where('message_status',1)->count();
        }
    }

//    public function getLastMessageAttribute()
//    {
//        if (auth()->check()) {
//            $lastMessage = CustomerChatting::where([
//                ['sender_id', '=', $this->id],
//                ['receiver_id', '=', auth()->id()]
//            ])->orWhere([
//                ['sender_id', '=', auth()->id()],
//                ['receiver_id', '=', $this->id]
//            ])->orderBy('id','desc')->first();
//            if (!empty($lastMessage)) {
//                return $lastMessage->message;
//            }
//        }
//        return null;
//    }

    public function getAgeAttribute()
    {
        if (!empty($this->customerOtherInfo()->first())) {
            return ($this->customerOtherInfo()->first()->age > 0) ? $this->customerOtherInfo()->first()->age : date('Y') - $this->customerOtherInfo()->first()->dob_year;
        }
        return 'N/A';
    }

    public function getGenderNameAttribute()
    {
        if (!empty($this->customerOtherInfo()->first())) {
            return ($this->customerOtherInfo()->first()->gender==1) ? 'male' : 'female';
        }
        return 'na';
    }

    public function getAssignUserNameAttribute()
    {
        if ($this->user_id > 0 && !empty($this->getAssignUser()->first())) {
            return $this->getAssignUser()->first()->name;
        }
        return null;
    }

    public function getAssignLeadUserNameAttribute()
    {
        if ($this->user_lead_id > 0 && !empty($this->getAssignLeadUser()->first())) {
            return $this->getAssignLeadUser()->first()->name;
        }
        return null;
    }

    public function getMatchAssignUserNameAttribute()
    {
        if ($this->match_user_id > 0 && !empty($this->getMatchAssignUser()->first())) {
            return $this->getMatchAssignUser()->first()->name;
        }
        return null;
    }

    public function getMatchAssignLeadUserNameAttribute()
    {
        if ($this->match_user_lead_id > 0 && !empty($this->getMatchAssignLeadUser()->first())) {
            return $this->getMatchAssignLeadUser()->first()->name;
        }
        return null;
    }

    public function getAssignUser()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function getAssignLeadUser()
    {
        return $this->belongsTo(User::class, 'user_lead_id','id');
    }

    public function getMatchAssignUser()
    {
        return $this->belongsTo(User::class, 'match_user_id','id');
    }

    public function getMatchAssignLeadUser()
    {
        return $this->belongsTo(User::class, 'match_user_lead_id','id');
    }

    public function customerOtherInfo()
    {
        return $this->hasOne(CustomerOtherInfo::class, 'RegistrationID');
    }

    public function customerLikeByMe()
    {
        return $this->hasOne(CustomerLike::class, 'like_to')->select('like_by','like_to')->where([
            'like_by' => auth()->id(),
            'deleted' => 0
        ]);
    }

    public function customerPersonalInfo()
    {
        return $this->hasOne(CustomerPersonalInfo::class, 'CustomerID');
    }

    public function customerNotificationPreference()
    {
        return $this->hasOne(CustomerNotificationPreference::class, 'customerID');
    }

    public function customerSearch()
    {
        return $this->hasOne(CustomerSearch::class, 'customerID');
    }

    public function customerReligionInfo()
    {
        return $this->hasOne(CustomerReligionInfo::class, 'CustomerID');
    }

    public function customerCareerInfo()
    {
        return $this->hasOne(CustomerCareerInfo::class, 'CustomerID');
    }

    public function customerFamilyInfo()
    {
        return $this->hasOne(CustomerFamilyInfo::class, 'CustomerID');
    }

    public function customerResidentialInfo()
    {
        return $this->hasOne(CustomerResidentialInfo::class, 'CustomerID');
    }

    public function customerImages()
    {
        return $this->hasMany(CustomerImage::class, 'CustomerID');
    }

    public function getCountryName()
    {
        return $this->hasOneThrough(
            Country::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'country_id'
        )->select('name');
    }

    public function getStateName()
    {
        return $this->hasOneThrough(
            State::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'state_id'
        )->select('title as name');
    }

    public function getCitiesName()
    {
        return $this->hasOneThrough(
            City::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'city_id'
        )->select('title as name');
    }

    public function getOccupationName()
    {
        return $this->hasOneThrough(
            Occupation::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'OccupationID'
        )->select('title as name');
//        return $this->hasOneThrough(
//            Occupation::class,
//            CustomerCareerInfo::class,
//            'CustomerID',
//            'id',
//            'id',
//            'Profession'
//        )->select('title as name');
    }

    public function getEducationName()
    {
        return $this->hasOneThrough(
            Education::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'EducationID'
        )->select('title as name');
    }

    public function getReligionName()
    {
        return $this->hasOneThrough(
            Religion::class,
            CustomerReligionInfo::class,
            'CustomerID',
            'id',
            'id',
            'Religions'
        )->select('title as name');
    }

    public function getSectName()
    {
        return $this->hasOneThrough(
            Sect::class,
            CustomerReligionInfo::class,
            'CustomerID',
            'id',
            'id',
            'Sects'
        )->select('title as name');
    }

    public function getMotherTongueName()
    {
        return $this->hasOneThrough(
            MotherTongue::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'MyFirstLanguageMotherTonguesID'
        )->select('title as name');
    }

    public function getMaritalStatusName()
    {
        return $this->hasOneThrough(
            MaritalStatus::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'MaritalStatusID'
        )->select('title as name');
    }

    public function getHeightName()
    {
        return $this->hasOneThrough(
            Height::class,
            CustomerPersonalInfo::class,
            'CustomerID',
            'id',
            'id',
            'Heights'
        )->select('title as name');
    }

    public function getCasteName()
    {
        return $this->hasOneThrough(
            Caste::class,
            CustomerPersonalInfo::class,
            'CustomerID',
            'id',
            'id',
            'Caste'
        )->select('title as name');
    }

    public function getCountrySlug()
    {
        return $this->hasOneThrough(
            Country::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'country_id'
        )->select('slug');
    }

    public function getCitySlug()
    {
        return $this->hasOneThrough(
            City::class,
            CustomerOtherInfo::class,
            'RegistrationID',
            'id',
            'id',
            'city_id'
        )->select('slug');
    }

    public function unreadMessageNumber()
    {
        return $this->hasMany(CustomerChatting::class, 'receiver_id')->where('message_status',1)->groupBy('sender_id');
    }

    public function customerPackage()
    {
        return $this->hasOne(Package::class, 'id','package_id');
    }

}
