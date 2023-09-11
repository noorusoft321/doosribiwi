<?php

namespace App\Models;

class CustomerNotificationPreference extends CoreModel
{
    protected $table = 'shaadi_customer_notification_preferences';

    protected $fillable =[
        'customerID',
        'profileStatus',
        'showPictureGuidelines',
        'showProfilePicture',
        'showEmail',
        'showCell',
        'showDob',
        'showLastName',
        'showCompleteAddress',
        'someOneViewsYourProfile',
        'aFavouriteUserIsOnline',
        'profileIsApproved',
        'privateGalleryRequests',
        'privateGalleryRequestsApprovedDeclined',
        'someoneLikesYou',
        'someoneMatchedWithYou',
        'seeYourRecommendations',
        'emailOptIn',
        'pictureAreApproved',
        'newMesssages',
        'newSearchMatches',
        'messagelimits',
        'status',
        'limit_start_date',
        'limit_end_date',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
    ];
}
