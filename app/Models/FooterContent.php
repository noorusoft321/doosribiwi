<?php

namespace App\Models;

class FooterContent extends CoreModel
{
    protected $table = 'shaadi_footer_contents';

    protected $fillable =[
        'logo',
        'short_des',
        'long_desc',
        'address',
        'address_map_link',
        'phone',
        'email',
        'facebook',
        'twitter',
        'youtube',
        'linked_in',
        'instagram',
        'ourSpecialGuestDescription',
        'grandMatchmakingEventsDescription',
        'ourOfficeDescription',
        'familyRishtaMeetingDescription',
        'rishtaServicesDescription',
        'status',
        'created_by',
        'updated_by',
        'deleted',
        'deleted_by',
        'ourEventsDescription',
        'govermentRegisteredMarraigeBureauDescription',
        'Pinterest',
    ];
}
