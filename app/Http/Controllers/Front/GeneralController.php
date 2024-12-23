<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\FamilyRishtaMeeting;
use App\Models\FooterContent;
use App\Models\OurEvent;
use App\Models\OurOffice;
use App\Models\Package;

class GeneralController extends Controller
{
    public function aboutUS()
    {
        $title = 'About US';
        return view('front.general.aboutUs',compact('title'));
    }

    public function ourVision()
    {
        $title = 'Our Vision';
        return view('front.general.ourVision',compact('title'));
    }

    public function weCare()
    {
        $title = 'We Care';
        return view('front.general.weCare',compact('title'));
    }

    public function donation()
    {
        $title = 'Donation';
        return view('front.general.donation',compact('title'));
    }

    public function whyUs()
    {
        $title = 'Why Us';
        return view('front.general.whyUs',compact('title'));
    }

    public function leadership()
    {
        $title = 'Leadership';
        return view('front.general.leadership',compact('title'));
    }

    public function weddingPlanningServices()
    {
        $title = 'Wedding Planning Services';
        return view('front.general.weddingPlanningServices',compact('title'));
    }

    public function supportMarriage()
    {
        $title = 'Support Marriage';
        return view('front.general.supportMarriage',compact('title'));
    }

    public function specialCases()
    {
        $title = 'Special Cases';
        return view('front.general.specialCases',compact('title'));
    }

    public function safetySecurity()
    {
        $title = 'Safety Security';
        return view('front.general.safetySecurity',compact('title'));
    }

    public function bridesGuide()
    {
        $title = 'Brides Guide';
        return view('front.general.bridesGuide',compact('title'));
    }

    public function groomGuide()
    {
        $title = 'Groom Guide';
        return view('front.general.groomGuide',compact('title'));
    }

    public function ourAffiliates()
    {
        $title = 'Our Affiliates';
        return view('front.general.ourAffiliates',compact('title'));
    }

    public function blog()
    {
        $title = 'Blogs';
        return view('front.general.blog',compact('title'));
    }

    public function freeRishtaServices()
    {
        $title = 'Rishta Services';
        return view('front.general.freeRishtaServices',compact('title'));
    }

    public function eliteMatrimonialService()
    {
        $title = 'Elite Matrimonial Service';
        return view('front.general.eliteMatrimonialService',compact('title'));
    }

    public function myMarriageConsultant()
    {
        $title = 'My Marriage Consultant';
        return view('front.general.myMarriageConsultant',compact('title'));
    }

    public function shaadiKaLaddoo()
    {
        $title = 'Shaadi Ka Laddu';
        $firstSeasonImages = [];
        $firstSeasons = OurEvent::select('main_image')->where('id',31)->first();
        if (!empty($firstSeasons)) {
            $firstSeasonImages = explode("|",$firstSeasons->main_image);
        }
        $secondSeasonImages = [];
        $secondSeasons = OurEvent::select('main_image')->where('id',32)->first();
        if (!empty($secondSeasons)) {
            $secondSeasonImages = explode("|",$secondSeasons->main_image);
        }
        $thirdSeasonImages = [];
        $thirdSeasons = OurEvent::select('main_image')->where('id',33)->first();
        if (!empty($thirdSeasons)) {
            $thirdSeasonImages = explode("|",$thirdSeasons->main_image);
        }
        return view('front.general.shaadiKaLaddoo',compact('title','firstSeasonImages','secondSeasonImages','thirdSeasonImages'));
    }

    public function eliteFamilyRishtaMeetup()
    {
        $title = 'Elite Family Rishta Meetup';
        return view('front.general.eliteFamilyRishtaMeetup',compact('title'));
    }

    public function packages()
    {
//        $packages = [
//            [
//                'package_name' => 'Free',
//                'direct_messages' => '10',
//                'duration' => '30',
//                'profile_status' => 'Not Verified',
//                'profile_status_urdu' => 'غیر تصدیق شدہ',
//                'price' => '0',
//                'background_color' => 'linear-gradient(300deg, #040F2E 50%, #a0465b 50%);',
//                'color' => '#040F2E',
//                'vip_status' => 'No',
//                'vip_status_urdu' => 'نہیں'
//            ],
//            [
//                'package_name' => 'Basic',
//                'direct_messages' => '20',
//                'duration' => '30',
//                'profile_status' => 'Not Verified',
//                'profile_status_urdu' => 'غیر تصدیق شدہ',
//                'price' => '1,000',
//                'background_color' => 'linear-gradient(300deg, #2951b5 50%, #214296 50%);',
//                'color' => '#214296',
//                'vip_status' => 'No',
//                'vip_status_urdu' => 'نہیں'
//            ],
//            [
//                'package_name' => 'Bronze',
//                'direct_messages' => '30',
//                'duration' => '30',
//                'profile_status' => 'Not Verified',
//                'profile_status_urdu' => 'غیر تصدیق شدہ',
//                'price' => '3,000',
//                'background_color' => 'linear-gradient(300deg, #b08d57 50%, #a88041 50%);',
//                'color' => '#b08d57',
//                'vip_status' => 'No',
//                'vip_status_urdu' => 'نہیں'
//            ],
//            [
//                'package_name' => 'Silver',
//                'direct_messages' => '50',
//                'duration' => '30',
//                'profile_status' => 'Not Verified',
//                'profile_status_urdu' => 'غیر تصدیق شدہ',
//                'price' => '5,000',
//                'background_color' => 'linear-gradient(300deg, #C0C0C0 50%, #b2b1b1 50%);',
//                'color' => '#C0C0C0',
//                'vip_status' => 'No',
//                'vip_status_urdu' => 'نہیں'
//            ],
//            [
//                'package_name' => 'Gold',
//                'direct_messages' => '100',
//                'duration' => '45',
//                'profile_status' => 'Semi Verified',
//                'profile_status_urdu' => 'نصف تصدیق شدہ',
//                'price' => '10,000',
//                'background_color' => 'linear-gradient(300deg, #f0ca00 50%, #ddba00 50%);',
//                'color' => '#f0ca00',
//                'vip_status' => 'No',
//                'vip_status_urdu' => 'نہیں'
//            ],
//            [
//                'package_name' => 'Diamond',
//                'direct_messages' => '150',
//                'duration' => '60',
//                'profile_status' => 'Semi Verified',
//                'profile_status_urdu' => 'نصف تصدیق شدہ',
//                'price' => '15,000',
//                'background_color' => 'linear-gradient(300deg, #64cbe2 50%, #5dbdd2 50%);',
//                'color' => '#64cbe2',
//                'vip_status' => 'No',
//                'vip_status_urdu' => 'نہیں'
//            ],
//            [
//                'package_name' => 'Platinum',
//                'direct_messages' => '200',
//                'duration' => '90',
//                'profile_status' => 'Verified',
//                'profile_status_urdu' => 'تصدیق شدہ',
//                'price' => '20,000',
//                'background_color' => 'linear-gradient(300deg, #747068 50%, #6a6862 50%);',
//                'color' => '#747068',
//                'vip_status' => 'No',
//                'vip_status_urdu' => 'نہیں'
//            ],
//            [
//                'package_name' => 'V.I.P',
//                'direct_messages' => '250',
//                'duration' => '90',
//                'profile_status' => 'Verified',
//                'profile_status_urdu' => 'تصدیق شدہ',
//                'price' => '25,000',
//                'background_color' => 'linear-gradient(300deg, #ca3b11 50%, #bb2a00 50%);',
//                'color' => '#ca3b11',
//                'vip_status' => 'Yes',
//                'vip_status_urdu' => 'جی ہاں'
//            ],
//            [
//                'package_name' => 'Elite',
//                'direct_messages' => '400',
//                'duration' => '180',
//                'profile_status' => 'Verified',
//                'profile_status_urdu' => 'تصدیق شدہ',
//                'price' => '100,000',
//                'background_color' => 'linear-gradient(300deg, #597696 50%, #4a698b 50%);',
//                'color' => '#597696',
//                'vip_status' => 'Yes',
//                'vip_status_urdu' => 'جی ہاں'
//            ],
//            [
//                'package_name' => 'Foreign',
//                'direct_messages' => '500',
//                'duration' => '365',
//                'profile_status' => 'Verified',
//                'profile_status_urdu' => 'تصدیق شدہ',
//                'price' => '150,000',
//                'background_color' => 'linear-gradient(300deg, orange 50%, #e59400 50%);',
//                'color' => 'orange',
//                'vip_status' => 'Yes',
//                'vip_status_urdu' => 'جی ہاں'
//            ]
//        ];
        $packages = Package::where('status',1)->get()->toArray();
        $isLogin = auth()->guard('customer')->check();
        $title = 'Rishta Packages';
        return view('front.general.packages',compact('title','packages','isLogin'));
    }

    public function authenticProfile()
    {
        $title = 'Authentic Profile';
        return view('front.general.authenticProfile',compact('title'));
    }

    public function ourEvents()
    {
        $ourEvents = OurEvent::where('deleted', 0);
        $ourEvents = $ourEvents->orderBy('event_date','desc');
        $ourEvents = $ourEvents->paginate(100)->appends(request()->query());
        $title = 'Our Events';
        return view('front.general.ourEvents',compact('title','ourEvents'));
    }

    public function socialConnections()
    {
        $title = 'Social Connections';
        return view('front.general.socialConnections',compact('title'));
    }

    public function mediaRoom()
    {
        $title = 'Media Room';
        $mediaVideos = [
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/E1XjibRb_rs" title="Chupp kar shaadi karne waaley log..😳🤔" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/g6NFNC51cqw" title="@9T9newsChannel Coverage at Shaadi Ka Laddu Season-2 | Family Rishta Meeting Event | Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/AXcHAIsb4dY" title="Mrs. Ali - Director of @ShaadiOrgPk  at @PTVNationalOfficial | Discussion on Rishta Services" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/G_A_uOchyJc" title="Mrs.Ali | Shadi Organization Pakistan | Muskurati Subha | 24 5 23" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/YmkvgY0N7JQ" title="How important is counseling for boys and girls before Marriage? | G Utha Pakistan with Nusrat Haris" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/Ri_t-9BkIAU" title="Our Grand Family Rishta Meeting Event | 250+ Rishtey Done | Best Marriage Bureau in Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/IiUjZEfLJwI" title="Shaadi Ka Laddu - Season 3 Highlights | Family to Family Rishta Meeting Event | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/VzvsMAErcag" title="Shaadi Ka Laddu - Season 3 | Family to Family Rishta Meeting | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/CXTPSKy9ok8" title="Shaadi Ka Laddu Season II - Sunday July 16, 2023 | Direct Family to Family Rishta | DoosriBiwi.com" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/Y4MRGmUyvio" title="Shaadi Ka Laddu Season II - Sunday, July 16, 2023 | Direct Family to Family Rishta | DoosriBiwi.com" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/EbFub7qoMMA" title="Shaadi Ka Laddu  Season - 2 Highlights | 300+ Rishtey Done | Family Event | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/zQBqW2YtRiQ" title="The Biggest &amp; Best Marriage Bureau in Pakistan | Doosri Biwi | Find Rishta Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/amm8hZTuMX8" title="Free Rishta Meeting | Direct Family to Family Rishta | Doosri Biwi, Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/w-lJiIzOPg0" title="Find your Life Partner | Free Rishta Meeting | Best Matchmakers | Doosri Biwi." frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/T9fg96pRu4o" title="Discover Your Perfect Life Partner | Free Family Rishta Meeting | Doosri Biwi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/gIeYEqS5ySo" title="Shaadi Ka Laddoo Event Highlights | Family to Family Free Rishta | Doosri Biwi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/3zhU5WdR54A" title="How to find the Best Proposal (Rishta) | Shaadi Organization | Best Marriage Bureau in Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/Dn8Ysxa9fKA" title="Eid Mubarak | Doosri Biwi | Best Marriage Bureau in Pakistan  | Best Matchmakers" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/u4qAt2ZSUfQ" title="Single Proposal (Rishta) | Doosri Biwi | Best Marriage Bureau in Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/jXvT070dmaE" title="Grand Family Matchmaking (Rishta) Event 2022 | DoosriBiwi.com | Best Marriage Bureau in Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/0VFlk7Hlmvc" title="Doosri Biwi Ramadan Timings | Shaadi Organization | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/pyUra5Rx6iI" title="Mirror Mirror  Shaadi YT" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/vUZCIHPJzRY" title="Mrs. Shehryar the event consultant | Grand Family Matchmaking (Rishta) Event 2022 | DoosriBiwi.com" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/IFRk_Pek0so" title="Guest of Honor Mr Saleem Afridi | Grand Family Matchmaking (Rishta) Event 2022 | Shaadi Organization" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/RlwxQCuLWXg" title="Social Worker and boutique owner Sakina Zafar in Grand Family Matchmaking (Rishta) Event 2022" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/xSHwfoagzK8" title="Director of Doosri Biwi | Shaadi Organization | Best Marriage Bureau in Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/Jh2ur0RI8OU" title="Mr. Ayaz Khan shares his experience of being an integral part of the Grand Matchmaking Event" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/_jme1dLM6vw" title="The Guest of honor of our 5th Grand Family Matchmaking (Rishta) Event 2022 | Best Marriage Bureau" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/-Qt_M3dn1cg" title="Highlights of Grand Family Matchmaking (Rishta) Event DoosriBiwi.com | Best Matchmaker in Pakistan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="100%" height="270px" src="https://www.youtube.com/embed/H9TCg8dWiPQ" title="Stock Broker Mr. Jibran Safdar | Grand Family Matchmaking (Rishta) Event 2022 | Shaadi Organization" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
        ];
        return view('front.general.mediaRoom',compact('title','mediaVideos'));
    }

    public function faqs()
    {
        $title = 'Faqs';
        return view('front.general.faqs',compact('title'));
    }

    public function contact()
    {
        $title = 'Contact';
        return view('front.general.contact',compact('title'));
    }

    public function affiliateProgram()
    {
        $title = 'Affiliate Program';
        return view('front.general.affiliateprogram',compact('title'));
    }

    public function advertiseWithUs()
    {
        $title = 'Advertise With Us';
        return view('front.general.advertisewithus',compact('title'));
    }

    public function becomeAPartner()
    {
        $title = 'Become A Partner';
        return view('front.general.becomeapartner',compact('title'));
    }

    public function privacyPolicy()
    {
        $title = 'Privacy Policy';
        return view('front.general.privacypolicy',compact('title'));
    }

    public function termsOfServices()
    {
        $title = 'Terms Of Services';
        return view('front.general.termsofservices',compact('title'));
    }

    public function picturePolicy()
    {
        $title = 'Picture Policy';
        return view('front.general.picturepolicy',compact('title'));
    }

    public function disclaimer()
    {
        $title = 'Disclaimer';
        return view('front.general.disclaimer',compact('title'));
    }

    public function reportMisuse()
    {
        $title = 'Report Misuse';
        return view('front.general.reportmisuse',compact('title'));
    }

    public function safetyTips()
    {
        $title = 'Safety Tips';
        return view('front.general.safetytips',compact('title'));
    }

    public function rishtaGuests()
    {
        $title = 'Rishta Guests';
        $ourSpecialGuestDescription = FooterContent::select('ourSpecialGuestDescription')->where('deleted', 0)->first();
        return view('front.general.rishtaGuests',compact('title','ourSpecialGuestDescription'));
    }

    public function rishtaPakistanOffice()
    {
        $title = 'Rishta Pakistan Office';
        $ourOfficeDescription = FooterContent::select('ourOfficeDescription')->where('deleted', 0)->first();
        $ourOffices = OurOffice::orderBy('order_at','asc')->where('deleted',0)->get();
        return view('front.general.rishtaPakistanOffice',compact('title','ourOfficeDescription','ourOffices'));
    }

    public function familyRishtaMeeting()
    {
        $title = 'Family Rishta Meeting';
        $familyRishtaMeetingDescription = FooterContent::select('familyRishtaMeetingDescription')->where('deleted', 0)->first();
        $familyRishtaMeetings = FamilyRishtaMeeting::orderBy('order_at','asc')->where('deleted',0)->get();
        return view('front.general.familyRishtaMeeting',compact('title','familyRishtaMeetingDescription','familyRishtaMeetings'));
    }

    public function publicNotices()
    {
        $title = 'Public Notices';
        return view('front.general.publicNotices',compact('title'));
    }

    public function career()
    {
        $benifits = [
            'Fixed Basic Salary',
            'Medical Allowance',
            'Maternity Reimbursement',
            'Un-utilized Leaves Encashments',
            'Transport Allowance',
            'Entertainment Allowance',
            'Monthly Performance Bonus',
            'Monthly Commission to BDOs',
            'Annual Performance Bonus',
            'Two Paid Leaves per Month',
            'Weekly Gifts (Clothes, Makeup, Jewelry on Performance)',
            'Monthly Cash Envelops on Performance',
            'Full Cash Envelop (Methai from Client)',
            'Pick & Drop from Office to the Bus Stop',
            'Female Friendly Environment',
            '90% of Staff in our Shaadi Office are Female',
            'Female HR Officer to handle Females issues',
            'Female Manager',
            'Female Director',
            'Separate Prayer Room for Females',
            'Separate Washroom for Females',
            'Kids Play Room for the Female Staff',
            'Female Bed Room to rest during medical issues',
            'Female Only Parties / Lunches / Dinners',
            'Females Only Picnics',
            'Makeup / Spa / Saloon – Discount Vouchers',
            'Separate Fridge for Females',
            'Flexible Timings',
            'No Late Coming Deductions',
            'Politics Free Environment',
            'Open Door Policy / Access to Management',
            'Air-Conditioned Environment',
            'Two Times Tea per Day',
            'Security Guard',
            'Day and Evening Maids to Look after Kids',
            'Kitchen / Fridge / Owen',
            'EOBI Pension',
            'Provident Fund',
            'Gratuity',
            'Vehicle',
        ];
        $packagesBenifits = array_chunk($benifits,3);
        $title = 'Career';
        return view('front.general.career',compact('title','packagesBenifits'));
    }

}
