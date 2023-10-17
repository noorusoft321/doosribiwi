@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('shaadi-admin/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    <style>
        .form-group {
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                {{$title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <hr/>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    @if(!empty($seoTool))
                        <form action="{{route('admin.create.update.portal.seo.tool',[$seoTool->faker_id])}}" id="addEditForm" class="row g-3">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">*Type</label>
                                        <select onchange="checkType()" class="form-control" name="type" id="type">
                                            <option value=""> -- Select -- </option>
                                            <option value="Page" {{($seoTool->type=="Page") ? 'selected' : ''}}>Page</option>
                                            <option value="Profile" {{($seoTool->type=="Profile") ? 'selected' : ''}}>Profile</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 data--Page" style="display: none;">
                                    <div class="form-group">
                                        <label for="page_url">*Page Url</label>
                                        <select class="multiple-select" name="page_url" id="page_url">
                                            <option value="" data-foo="Select at least one"> -- Select -- </option>
                                            <option value="landing.page" {{($seoTool->page_url=='landing.page') ? 'selected' : ''}} data-foo="{{route('landing.page')}}">Home</option>
                                            <option value="view.login" {{($seoTool->page_url=='view.login') ? 'selected' : ''}} data-foo="{{route('view.login')}}">Login</option>
                                            <option value="view.register" {{($seoTool->page_url=='view.register') ? 'selected' : ''}} data-foo="{{route('view.register')}}">Register</option>
                                            <option value="view.forgot.password" {{($seoTool->page_url=='view.forgot.password') ? 'selected' : ''}} data-foo="{{route('view.forgot.password')}}">Forgot Password</option>
                                            <option value="forget.password.confirm" {{($seoTool->page_url=='forget.password.confirm') ? 'selected' : ''}} data-foo="{{route('forget.password.confirm',['info@DoosriBiwi.com'])}}">Reset Password</option>
                                            <option value="customer.search" {{($seoTool->page_url=='customer.search') ? 'selected' : ''}} data-foo="{{route('customer.search')}}">Customer Search</option>
                                            <option value="payment.options" {{($seoTool->page_url=='payment.options') ? 'selected' : ''}} data-foo="{{route('payment.options')}}">Payment Option</option>
                                            <option value="blog" {{($seoTool->page_url=='blog') ? 'selected' : ''}} data-foo="{{route('blog')}}">Blog Main</option>
                                            <option value="secretstoahappymarriedlife" {{($seoTool->page_url=='secretstoahappymarriedlife') ? 'selected' : ''}} data-foo="{{route('secretstoahappymarriedlife')}}">Blog secretstoahappymarriedlife</option>
                                            <option value="besthoneymoondestinationsinpakistan" {{($seoTool->page_url=='besthoneymoondestinationsinpakistan') ? 'selected' : ''}} data-foo="{{route('besthoneymoondestinationsinpakistan')}}">Blog besthoneymoondestinationsinpakistan</option>
                                            <option value="bestmarriagebureauinkarachishaadiorganizationpakistan" {{($seoTool->page_url=='bestmarriagebureauinkarachishaadiorganizationpakistan') ? 'selected' : ''}} data-foo="{{route('bestmarriagebureauinkarachishaadiorganizationpakistan')}}">Blog bestmarriagebureauinkarachishaadiorganizationpakistan</option>
                                            <option value="howmatrimonialsitescanhelpyoufindarishtaintheusa" {{($seoTool->page_url=='howmatrimonialsitescanhelpyoufindarishtaintheusa') ? 'selected' : ''}} data-foo="{{route('howmatrimonialsitescanhelpyoufindarishtaintheusa')}}">Blog howmatrimonialsitescanhelpyoufindarishtaintheusa</option>
                                            <option value="howtodealwithdifferencesinamarriage" {{($seoTool->page_url=='howtodealwithdifferencesinamarriage') ? 'selected' : ''}} data-foo="{{route('howtodealwithdifferencesinamarriage')}}">Blog howtodealwithdifferencesinamarriage</option>
                                            <option value="howtofindthebestauthenticshaadiwebsitesinpakistan" {{($seoTool->page_url=='howtofindthebestauthenticshaadiwebsitesinpakistan') ? 'selected' : ''}} data-foo="{{route('howtofindthebestauthenticshaadiwebsitesinpakistan')}}">Blog howtofindthebestauthenticshaadiwebsitesinpakistan</option>
                                            <option value="howtofindyourideallifepartner" {{($seoTool->page_url=='howtofindyourideallifepartner') ? 'selected' : ''}} data-foo="{{route('howtofindyourideallifepartner')}}">Blog howtofindyourideallifepartner</option>
                                            <option value="howtofindyourperfectbrideintodaysmodernera" {{($seoTool->page_url=='howtofindyourperfectbrideintodaysmodernera') ? 'selected' : ''}} data-foo="{{route('howtofindyourperfectbrideintodaysmodernera')}}">Blog howtofindyourperfectbrideintodaysmodernera</option>
                                            <option value="howtoliveyourhappilyeveafter" {{($seoTool->page_url=='howtoliveyourhappilyeveafter') ? 'selected' : ''}} data-foo="{{route('howtoliveyourhappilyeveafter')}}">Blog howtoliveyourhappilyeveafter</option>
                                            <option value="howtolookforaperfectrishtainpakistan" {{($seoTool->page_url=='howtolookforaperfectrishtainpakistan') ? 'selected' : ''}} data-foo="{{route('howtolookforaperfectrishtainpakistan')}}">Blog howtolookforaperfectrishtainpakistan</option>
                                            <option value="howtolookfortheperfectgroominpakistan" {{($seoTool->page_url=='howtolookfortheperfectgroominpakistan') ? 'selected' : ''}} data-foo="{{route('howtolookfortheperfectgroominpakistan')}}">Blog howtolookfortheperfectgroominpakistan</option>
                                            <option value="howtoplanaweddinginpakistanwhilestayingonbudget" {{($seoTool->page_url=='howtoplanaweddinginpakistanwhilestayingonbudget') ? 'selected' : ''}} data-foo="{{route('howtoplanaweddinginpakistanwhilestayingonbudget')}}">Blog howtoplanaweddinginpakistanwhilestayingonbudget</option>
                                            <option value="howtoseekyourlifepartnerthroughshaadiwebsites" {{($seoTool->page_url=='howtoseekyourlifepartnerthroughshaadiwebsites') ? 'selected' : ''}} data-foo="{{route('howtoseekyourlifepartnerthroughshaadiwebsites')}}">Blog howtoseekyourlifepartnerthroughshaadiwebsites</option>
                                            <option value="marriagetrendsinpakistanthenvsnow" {{($seoTool->page_url=='marriagetrendsinpakistanthenvsnow') ? 'selected' : ''}} data-foo="{{route('marriagetrendsinpakistanthenvsnow')}}">Blog marriagetrendsinpakistanthenvsnow</option>
                                            <option value="onlinemarriagesitesthebestwaytofindtherightpartner" {{($seoTool->page_url=='onlinemarriagesitesthebestwaytofindtherightpartner') ? 'selected' : ''}} data-foo="{{route('onlinemarriagesitesthebestwaytofindtherightpartner')}}">Blog onlinemarriagesitesthebestwaytofindtherightpartner</option>
                                            <option value="pakistaniweddingpreparationthingstonotleavetothelastminute" {{($seoTool->page_url=='pakistaniweddingpreparationthingstonotleavetothelastminute') ? 'selected' : ''}} data-foo="{{route('pakistaniweddingpreparationthingstonotleavetothelastminute')}}">Blog pakistaniweddingpreparationthingstonotleavetothelastminute</option>
                                            <option value="premarriagetodolistforbrides" {{($seoTool->page_url=='premarriagetodolistforbrides') ? 'selected' : ''}} data-foo="{{route('premarriagetodolistforbrides')}}">Blog premarriagetodolistforbrides</option>
                                            <option value="reasonstoInvestinamatrimonialserviceprovider" {{($seoTool->page_url=='reasonstoInvestinamatrimonialserviceprovider') ? 'selected' : ''}} data-foo="{{route('reasonstoInvestinamatrimonialserviceprovider')}}">Blog reasonstoInvestinamatrimonialserviceprovider</option>
                                            <option value="reasonswhydesiweddingsarethebest" {{($seoTool->page_url=='reasonswhydesiweddingsarethebest') ? 'selected' : ''}} data-foo="{{route('reasonswhydesiweddingsarethebest')}}">Blog reasonswhydesiweddingsarethebest</option>
                                            <option value="reasonswhyyoushouldhirematchmakers" {{($seoTool->page_url=='reasonswhyyoushouldhirematchmakers') ? 'selected' : ''}} data-foo="{{route('reasonswhyyoushouldhirematchmakers')}}">Blog reasonswhyyoushouldhirematchmakers</option>
                                            <option value="roleofkarachimatrimonialservicesinfindingyouasuitablepartner" {{($seoTool->page_url=='roleofkarachimatrimonialservicesinfindingyouasuitablepartner') ? 'selected' : ''}} data-foo="{{route('roleofkarachimatrimonialservicesinfindingyouasuitablepartner')}}">Blog roleofkarachimatrimonialservicesinfindingyouasuitablepartner</option>
                                            <option value="shaadiexpopakistanwhatItisallabout" {{($seoTool->page_url=='shaadiexpopakistanwhatItisallabout') ? 'selected' : ''}} data-foo="{{route('shaadiexpopakistanwhatItisallabout')}}">Blog shaadiexpopakistanwhatItisallabout</option>
                                            <option value="shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings" {{($seoTool->page_url=='shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings') ? 'selected' : ''}} data-foo="{{route('shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings')}}">Blog shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings</option>
                                            <option value="theroleofshaadiwebsitesinpakistaniculture" {{($seoTool->page_url=='theroleofshaadiwebsitesinpakistaniculture') ? 'selected' : ''}} data-foo="{{route('theroleofshaadiwebsitesinpakistaniculture')}}">Blog theroleofshaadiwebsitesinpakistaniculture</option>
                                            <option value="theultimateguidetosettingtherightbeautyregimenforradiantbeauty" {{($seoTool->page_url=='theultimateguidetosettingtherightbeautyregimenforradiantbeauty') ? 'selected' : ''}} data-foo="{{route('theultimateguidetosettingtherightbeautyregimenforradiantbeauty')}}">Blog theultimateguidetosettingtherightbeautyregimenforradiantbeauty</option>
                                            <option value="thingseverygirlmustdobeforeherbigday" {{($seoTool->page_url=='thingseverygirlmustdobeforeherbigday') ? 'selected' : ''}} data-foo="{{route('thingseverygirlmustdobeforeherbigday')}}">Blog thingseverygirlmustdobeforeherbigday</option>
                                            <option value="thingstoavoidinmarriage" {{($seoTool->page_url=='thingstoavoidinmarriage') ? 'selected' : ''}} data-foo="{{route('thingstoavoidinmarriage')}}">Blog thingstoavoidinmarriage</option>
                                            <option value="thingsyouneedtoknowaboutelitematrimonialservice" {{($seoTool->page_url=='thingsyouneedtoknowaboutelitematrimonialservice') ? 'selected' : ''}} data-foo="{{route('thingsyouneedtoknowaboutelitematrimonialservice')}}">Blog thingsyouneedtoknowaboutelitematrimonialservice</option>
                                            <option value="tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws" {{($seoTool->page_url=='tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws') ? 'selected' : ''}} data-foo="{{route('tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws')}}">Blog tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws</option>
                                            <option value="topadvantagesofpakistanrishtasites" {{($seoTool->page_url=='topadvantagesofpakistanrishtasites') ? 'selected' : ''}} data-foo="{{route('topadvantagesofpakistanrishtasites')}}">Blog topadvantagesofpakistanrishtasites</option>
                                            <option value="whatthetopmatrimonialservicesinpakistanpromisetodeliver" {{($seoTool->page_url=='whatthetopmatrimonialservicesinpakistanpromisetodeliver') ? 'selected' : ''}} data-foo="{{route('whatthetopmatrimonialservicesinpakistanpromisetodeliver')}}">Blog whatthetopmatrimonialservicesinpakistanpromisetodeliver</option>
                                            <option value="whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices" {{($seoTool->page_url=='whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices') ? 'selected' : ''}} data-foo="{{route('whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices')}}">Blog whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices</option>
                                            <option value="about.us" {{($seoTool->page_url=='about.us') ? 'selected' : ''}} data-foo="{{route('about.us')}}">About Us</option>
                                            <option value="our.vision" {{($seoTool->page_url=='our.vision') ? 'selected' : ''}} data-foo="{{route('our.vision')}}">Our Vision</option>
                                            <option value="we.care" {{($seoTool->page_url=='we.care') ? 'selected' : ''}} data-foo="{{route('we.care')}}">We Care</option>
                                            <option value="donation" {{($seoTool->page_url=='donation') ? 'selected' : ''}} data-foo="{{route('donation')}}">Donation</option>
                                            <option value="why.us" {{($seoTool->page_url=='why.us') ? 'selected' : ''}} data-foo="{{route('why.us')}}">Why Us</option>
                                            <option value="leadership" {{($seoTool->page_url=='leadership') ? 'selected' : ''}} data-foo="{{route('leadership')}}">Leadership</option>
                                            <option value="wedding.planning.services" {{($seoTool->page_url=='wedding.planning.services') ? 'selected' : ''}} data-foo="{{route('wedding.planning.services')}}">Wedding Planning Services</option>
                                            <option value="support.marriage" {{($seoTool->page_url=='support.marriage') ? 'selected' : ''}} data-foo="{{route('support.marriage')}}">Support Marriage</option>
                                            <option value="special.cases" {{($seoTool->page_url=='special.cases') ? 'selected' : ''}} data-foo="{{route('special.cases')}}">Special Cases</option>
                                            <option value="safety.security" {{($seoTool->page_url=='safety.security') ? 'selected' : ''}} data-foo="{{route('safety.security')}}">Safety Security</option>
                                            <option value="brides.guide" {{($seoTool->page_url=='brides.guide') ? 'selected' : ''}} data-foo="{{route('brides.guide')}}">Brides Guide</option>
                                            <option value="groom.guide" {{($seoTool->page_url=='groom.guide') ? 'selected' : ''}} data-foo="{{route('groom.guide')}}">Groom Guide</option>
                                            <option value="our.affiliates" {{($seoTool->page_url=='our.affiliates') ? 'selected' : ''}} data-foo="{{route('our.affiliates')}}">Our Affiliates</option>
                                            <option value="free.rishta.services" {{($seoTool->page_url=='free.rishta.services') ? 'selected' : ''}} data-foo="{{route('free.rishta.services')}}">Free Rishta Services</option>
                                            <option value="elite.matrimonial.service" {{($seoTool->page_url=='elite.matrimonial.service') ? 'selected' : ''}} data-foo="{{route('elite.matrimonial.service')}}">Elite Matrimonial Service</option>
                                            <option value="my.marriage.consultant" {{($seoTool->page_url=='my.marriage.consultant') ? 'selected' : ''}} data-foo="{{route('my.marriage.consultant')}}">My Marriage Consultant</option>
                                            <option value="authentic.profile" {{($seoTool->page_url=='authentic.profile') ? 'selected' : ''}} data-foo="{{route('authentic.profile')}}">Authentic Profile</option>
                                            <option value="our.events" {{($seoTool->page_url=='our.events') ? 'selected' : ''}} data-foo="{{route('our.events')}}">Our Events</option>
                                            <option value="social.connections" {{($seoTool->page_url=='social.connections') ? 'selected' : ''}} data-foo="{{route('social.connections')}}">Social Connections</option>
                                            <option value="media.room" {{($seoTool->page_url=='media.room') ? 'selected' : ''}} data-foo="{{route('media.room')}}">Media Room</option>
                                            <option value="faqs" {{($seoTool->page_url=='faqs') ? 'selected' : ''}} data-foo="{{route('faqs')}}">Faqs</option>
                                            <option value="contact.us" {{($seoTool->page_url=='contact.us') ? 'selected' : ''}} data-foo="{{route('contact.us')}}">Contact Us</option>
                                            <option value="affiliate.program" {{($seoTool->page_url=='affiliate.program') ? 'selected' : ''}} data-foo="{{route('affiliate.program')}}">Affiliate Program</option>
                                            <option value="advertise.with.us" {{($seoTool->page_url=='advertise.with.us') ? 'selected' : ''}} data-foo="{{route('advertise.with.us')}}">Advertise With Us</option>
                                            <option value="privacy.policy" {{($seoTool->page_url=='privacy.policy') ? 'selected' : ''}} data-foo="{{route('privacy.policy')}}">Privacy Policy</option>
                                            <option value="terms.of.services" {{($seoTool->page_url=='terms.of.services') ? 'selected' : ''}} data-foo="{{route('terms.of.services')}}">Terms of Services</option>
                                            <option value="picture.policy" {{($seoTool->page_url=='picture.policy') ? 'selected' : ''}} data-foo="{{route('picture.policy')}}">Picture Policy</option>
                                            <option value="disclaimer" {{($seoTool->page_url=='disclaimer') ? 'selected' : ''}} data-foo="{{route('disclaimer')}}">Disclaimer</option>
                                            <option value="report.misuse" {{($seoTool->page_url=='report.misuse') ? 'selected' : ''}} data-foo="{{route('report.misuse')}}">Report Misuse</option>
                                            <option value="safety.tips" {{($seoTool->page_url=='safety.tips') ? 'selected' : ''}} data-foo="{{route('safety.tips')}}">Safety Tips</option>
                                            <option value="rishta.guests" {{($seoTool->page_url=='rishta.guests') ? 'selected' : ''}} data-foo="{{route('rishta.guests')}}">Rishta Guests</option>
                                            <option value="rishta.pakistan.office" {{($seoTool->page_url=='rishta.pakistan.office') ? 'selected' : ''}} data-foo="{{route('rishta.pakistan.office')}}">Rishta Pakistan Office</option>
                                            <option value="family.rishta.meeting" {{($seoTool->page_url=='family.rishta.meeting') ? 'selected' : ''}} data-foo="{{route('family.rishta.meeting')}}">Family Rishta Meeting</option>
                                            <option value="public.notices" {{($seoTool->page_url=='public.notices') ? 'selected' : ''}} data-foo="{{route('public.notices')}}">Public Notices</option>
                                            <option value="career" {{($seoTool->page_url=='career') ? 'selected' : ''}} data-foo="{{route('career')}}">Career</option>
                                            <option value="confirm.customer.account" {{($seoTool->page_url=='confirm.customer.account') ? 'selected' : ''}} data-foo="{{route('confirm.customer.account',['info@DoosriBiwi.com'])}}">Confirm Customer Account</option>
                                            <option value="auth.verify" {{($seoTool->page_url=='auth.verify') ? 'selected' : ''}} data-foo="{{route('auth.verify')}}">Auth Verify</option>
                                            <option value="education.form" {{($seoTool->page_url=='education.form') ? 'selected' : ''}} data-foo="{{route('education.form')}}">Education Form</option>
                                            <option value="personal.form" {{($seoTool->page_url=='personal.form') ? 'selected' : ''}} data-foo="{{route('personal.form')}}">Personal Form</option>
                                            <option value="religion.form" {{($seoTool->page_url=='religion.form') ? 'selected' : ''}} data-foo="{{route('religion.form')}}">Religion Form</option>
                                            <option value="expectation.form" {{($seoTool->page_url=='expectation.form') ? 'selected' : ''}} data-foo="{{route('expectation.form')}}">Expectation Form</option>
                                            <option value="profile.image.form" {{($seoTool->page_url=='profile.image.form') ? 'selected' : ''}} data-foo="{{route('profile.image.form')}}">Profile Image Form</option>
                                            <option value="customer.dashboard" {{($seoTool->page_url=='customer.dashboard') ? 'selected' : ''}} data-foo="{{route('customer.dashboard')}}">Customer Dashboard</option>
                                            <option value="edit.personal.profile" {{($seoTool->page_url=='edit.personal.profile') ? 'selected' : ''}} data-foo="{{route('edit.personal.profile')}}">Edit Personal Profile</option>
                                            <option value="edit.profile" {{($seoTool->page_url=='edit.profile') ? 'selected' : ''}} data-foo="{{route('edit.profile')}}">Edit Profile</option>
                                            <option value="edit.photo" {{($seoTool->page_url=='edit.photo') ? 'selected' : ''}} data-foo="{{route('edit.photo')}}">Edit Photo</option>
                                            <option value="customer.like.save" {{($seoTool->page_url=='customer.like.save') ? 'selected' : ''}} data-foo="{{route('customer.like.save')}}">Customer Like & View</option>
                                            <option value="change.email.password" {{($seoTool->page_url=='change.email.password') ? 'selected' : ''}} data-foo="{{route('change.email.password')}}">Change Email Password</option>
                                            <option value="get.customer.block" {{($seoTool->page_url=='get.customer.block') ? 'selected' : ''}} data-foo="{{route('get.customer.block')}}">Get Customer Block</option>
                                            <option value="messenger" {{($seoTool->page_url=='messenger') ? 'selected' : ''}} data-foo="{{route('messenger')}}">Messenger</option>
                                            <option value="customer.profile.detail" {{($seoTool->page_url=='customer.profile.detail') ? 'selected' : ''}} data-foo="Customer Profile Detail">Customer Profile Detail</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 data--Profile" style="display: none;">
                                    <div class="form-group">
                                        <label for="customer_id">*Customer</label>
                                        <select class="multiple-select" name="customer_id" id="customer_id">
                                            <option value="" data-foo="Select at least one"> -- Select -- </option>
                                            @foreach($customers as $key => $val)
                                                <option value="{{$val->id}}" data-foo="{{$val->name.' - '.$val->email}}"
                                                        {{($seoTool->customer_id==$val->id) ? 'selected' : ''}}>
                                                    {{$val->fullname}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="site_name">*Site Name</label>
                                        <input type="text" name="site_name" id="site_name" class="form-control" value="{{$seoTool->site_name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title">*Title</label>
                                        <textarea name="title" id="title" rows="5" class="form-control">{{$seoTool->title}}</textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">*Description</label>
                                        <textarea name="description" id="description" rows="5" class="form-control">{{$seoTool->description}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="schema_script">*Schema Script</label>
                                        <textarea name="schema_script" id="schema_script" rows="20" class="form-control">{{$seoTool->schema_script}}</textarea>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button onclick="selectImageModal()" class="btn btn-info mb-2 btn--select-image" type="button">Select Image</button>
                                    <input type="hidden" name="image" id="image" value="{{$seoTool->image}}">
                                    <div class="card cardImageDiv" style="display: block;">
                                        <img src="{{$seoTool->image}}" class="card-img-top" alt="Selected Image">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Buttons --}}
                            <div class="row">
                                <div class="col-12">
                                    <button onclick="saveRecord(this)" type="button" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                    <a href="{{route('admin.customer.portal.seo.tool')}}" type="button" class="btn btn-secondary px-5 float-end">Cancel</a>
                                </div>
                            </div>
                        </form>
                    @else
                        <form action="{{route('admin.create.update.portal.seo.tool')}}" id="addEditForm" class="row g-3">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">*Type</label>
                                        <select onchange="checkType()" class="form-control" name="type" id="type">
                                            <option value=""> -- Select -- </option>
                                            <option value="Page">Page</option>
                                            <option value="Profile">Profile</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 data--Page" style="display: none;">
                                    <div class="form-group">
                                        <label for="page_url">*Page Url</label>
                                        <select class="multiple-select" name="page_url" id="page_url">
                                            <option value="" data-foo="Select at least one"> -- Select -- </option>
                                            <option value="landing.page" data-foo="{{route('landing.page')}}">Home</option>
                                            <option value="view.login" data-foo="{{route('view.login')}}">Login</option>
                                            <option value="view.register" data-foo="{{route('view.register')}}">Register</option>
                                            <option value="view.forgot.password" data-foo="{{route('view.forgot.password')}}">Forgot Password</option>
                                            <option value="forget.password.confirm" data-foo="{{route('forget.password.confirm',['info@DoosriBiwi.com'])}}">Reset Password</option>
                                            <option value="customer.search" data-foo="{{route('customer.search')}}">Customer Search</option>
                                            <option value="payment.options" data-foo="{{route('payment.options')}}">Payment Option</option>
                                            <option value="blog" data-foo="{{route('blog')}}">Blog Main</option>
                                            <option value="secretstoahappymarriedlife" data-foo="{{route('secretstoahappymarriedlife')}}">Blog secretstoahappymarriedlife</option>
                                            <option value="besthoneymoondestinationsinpakistan" data-foo="{{route('besthoneymoondestinationsinpakistan')}}">Blog besthoneymoondestinationsinpakistan</option>
                                            <option value="bestmarriagebureauinkarachishaadiorganizationpakistan" data-foo="{{route('bestmarriagebureauinkarachishaadiorganizationpakistan')}}">Blog bestmarriagebureauinkarachishaadiorganizationpakistan</option>
                                            <option value="howmatrimonialsitescanhelpyoufindarishtaintheusa" data-foo="{{route('howmatrimonialsitescanhelpyoufindarishtaintheusa')}}">Blog howmatrimonialsitescanhelpyoufindarishtaintheusa</option>
                                            <option value="howtodealwithdifferencesinamarriage" data-foo="{{route('howtodealwithdifferencesinamarriage')}}">Blog howtodealwithdifferencesinamarriage</option>
                                            <option value="howtofindthebestauthenticshaadiwebsitesinpakistan" data-foo="{{route('howtofindthebestauthenticshaadiwebsitesinpakistan')}}">Blog howtofindthebestauthenticshaadiwebsitesinpakistan</option>
                                            <option value="howtofindyourideallifepartner" data-foo="{{route('howtofindyourideallifepartner')}}">Blog howtofindyourideallifepartner</option>
                                            <option value="howtofindyourperfectbrideintodaysmodernera" data-foo="{{route('howtofindyourperfectbrideintodaysmodernera')}}">Blog howtofindyourperfectbrideintodaysmodernera</option>
                                            <option value="howtoliveyourhappilyeveafter" data-foo="{{route('howtoliveyourhappilyeveafter')}}">Blog howtoliveyourhappilyeveafter</option>
                                            <option value="howtolookforaperfectrishtainpakistan" data-foo="{{route('howtolookforaperfectrishtainpakistan')}}">Blog howtolookforaperfectrishtainpakistan</option>
                                            <option value="howtolookfortheperfectgroominpakistan" data-foo="{{route('howtolookfortheperfectgroominpakistan')}}">Blog howtolookfortheperfectgroominpakistan</option>
                                            <option value="howtoplanaweddinginpakistanwhilestayingonbudget" data-foo="{{route('howtoplanaweddinginpakistanwhilestayingonbudget')}}">Blog howtoplanaweddinginpakistanwhilestayingonbudget</option>
                                            <option value="howtoseekyourlifepartnerthroughshaadiwebsites" data-foo="{{route('howtoseekyourlifepartnerthroughshaadiwebsites')}}">Blog howtoseekyourlifepartnerthroughshaadiwebsites</option>
                                            <option value="marriagetrendsinpakistanthenvsnow" data-foo="{{route('marriagetrendsinpakistanthenvsnow')}}">Blog marriagetrendsinpakistanthenvsnow</option>
                                            <option value="onlinemarriagesitesthebestwaytofindtherightpartner" data-foo="{{route('onlinemarriagesitesthebestwaytofindtherightpartner')}}">Blog onlinemarriagesitesthebestwaytofindtherightpartner</option>
                                            <option value="pakistaniweddingpreparationthingstonotleavetothelastminute" data-foo="{{route('pakistaniweddingpreparationthingstonotleavetothelastminute')}}">Blog pakistaniweddingpreparationthingstonotleavetothelastminute</option>
                                            <option value="premarriagetodolistforbrides" data-foo="{{route('premarriagetodolistforbrides')}}">Blog premarriagetodolistforbrides</option>
                                            <option value="reasonstoInvestinamatrimonialserviceprovider" data-foo="{{route('reasonstoInvestinamatrimonialserviceprovider')}}">Blog reasonstoInvestinamatrimonialserviceprovider</option>
                                            <option value="reasonswhydesiweddingsarethebest" data-foo="{{route('reasonswhydesiweddingsarethebest')}}">Blog reasonswhydesiweddingsarethebest</option>
                                            <option value="reasonswhyyoushouldhirematchmakers" data-foo="{{route('reasonswhyyoushouldhirematchmakers')}}">Blog reasonswhyyoushouldhirematchmakers</option>
                                            <option value="roleofkarachimatrimonialservicesinfindingyouasuitablepartner" data-foo="{{route('roleofkarachimatrimonialservicesinfindingyouasuitablepartner')}}">Blog roleofkarachimatrimonialservicesinfindingyouasuitablepartner</option>
                                            <option value="shaadiexpopakistanwhatItisallabout" data-foo="{{route('shaadiexpopakistanwhatItisallabout')}}">Blog shaadiexpopakistanwhatItisallabout</option>
                                            <option value="shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings" data-foo="{{route('shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings')}}">Blog shaadiorganizationpakistanmatchmakingeventstofacilitatenewbeginnings</option>
                                            <option value="theroleofshaadiwebsitesinpakistaniculture" data-foo="{{route('theroleofshaadiwebsitesinpakistaniculture')}}">Blog theroleofshaadiwebsitesinpakistaniculture</option>
                                            <option value="theultimateguidetosettingtherightbeautyregimenforradiantbeauty" data-foo="{{route('theultimateguidetosettingtherightbeautyregimenforradiantbeauty')}}">Blog theultimateguidetosettingtherightbeautyregimenforradiantbeauty</option>
                                            <option value="thingseverygirlmustdobeforeherbigday" data-foo="{{route('thingseverygirlmustdobeforeherbigday')}}">Blog thingseverygirlmustdobeforeherbigday</option>
                                            <option value="thingstoavoidinmarriage" data-foo="{{route('thingstoavoidinmarriage')}}">Blog thingstoavoidinmarriage</option>
                                            <option value="thingsyouneedtoknowaboutelitematrimonialservice" data-foo="{{route('thingsyouneedtoknowaboutelitematrimonialservice')}}">Blog thingsyouneedtoknowaboutelitematrimonialservice</option>
                                            <option value="tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws" data-foo="{{route('tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws')}}">Blog tipsthatwillhelpyoubuildagoodrelationshipwithyourinlaws</option>
                                            <option value="topadvantagesofpakistanrishtasites" data-foo="{{route('topadvantagesofpakistanrishtasites')}}">Blog topadvantagesofpakistanrishtasites</option>
                                            <option value="whatthetopmatrimonialservicesinpakistanpromisetodeliver" data-foo="{{route('whatthetopmatrimonialservicesinpakistanpromisetodeliver')}}">Blog whatthetopmatrimonialservicesinpakistanpromisetodeliver</option>
                                            <option value="whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices" data-foo="{{route('whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices')}}">Blog whychoosepakistanmatrimonialsitesfortopnotchmatchmakingservices</option>
                                            <option value="about.us" data-foo="{{route('about.us')}}">About Us</option>
                                            <option value="our.vision" data-foo="{{route('our.vision')}}">Our Vision</option>
                                            <option value="we.care" data-foo="{{route('we.care')}}">We Care</option>
                                            <option value="donation" data-foo="{{route('donation')}}">Donation</option>
                                            <option value="why.us" data-foo="{{route('why.us')}}">Why Us</option>
                                            <option value="leadership" data-foo="{{route('leadership')}}">Leadership</option>
                                            <option value="wedding.planning.services" data-foo="{{route('wedding.planning.services')}}">Wedding Planning Services</option>
                                            <option value="support.marriage" data-foo="{{route('support.marriage')}}">Support Marriage</option>
                                            <option value="special.cases" data-foo="{{route('special.cases')}}">Special Cases</option>
                                            <option value="safety.security" data-foo="{{route('safety.security')}}">Safety Security</option>
                                            <option value="brides.guide" data-foo="{{route('brides.guide')}}">Brides Guide</option>
                                            <option value="groom.guide" data-foo="{{route('groom.guide')}}">Groom Guide</option>
                                            <option value="our.affiliates" data-foo="{{route('our.affiliates')}}">Our Affiliates</option>
                                            <option value="free.rishta.services" data-foo="{{route('free.rishta.services')}}">Free Rishta Services</option>
                                            <option value="elite.matrimonial.service" data-foo="{{route('elite.matrimonial.service')}}">Elite Matrimonial Service</option>
                                            <option value="my.marriage.consultant" data-foo="{{route('my.marriage.consultant')}}">My Marriage Consultant</option>
                                            <option value="authentic.profile" data-foo="{{route('authentic.profile')}}">Authentic Profile</option>
                                            <option value="our.events" data-foo="{{route('our.events')}}">Our Events</option>
                                            <option value="social.connections" data-foo="{{route('social.connections')}}">Social Connections</option>
                                            <option value="media.room" data-foo="{{route('media.room')}}">Media Room</option>
                                            <option value="faqs" data-foo="{{route('faqs')}}">Faqs</option>
                                            <option value="contact.us" data-foo="{{route('contact.us')}}">Contact Us</option>
                                            <option value="affiliate.program" data-foo="{{route('affiliate.program')}}">Affiliate Program</option>
                                            <option value="advertise.with.us" data-foo="{{route('advertise.with.us')}}">Advertise With Us</option>
                                            <option value="privacy.policy" data-foo="{{route('privacy.policy')}}">Privacy Policy</option>
                                            <option value="terms.of.services" data-foo="{{route('terms.of.services')}}">Terms of Services</option>
                                            <option value="picture.policy" data-foo="{{route('picture.policy')}}">Picture Policy</option>
                                            <option value="disclaimer" data-foo="{{route('disclaimer')}}">Disclaimer</option>
                                            <option value="report.misuse" data-foo="{{route('report.misuse')}}">Report Misuse</option>
                                            <option value="safety.tips" data-foo="{{route('safety.tips')}}">Safety Tips</option>
                                            <option value="rishta.guests" data-foo="{{route('rishta.guests')}}">Rishta Guests</option>
                                            <option value="rishta.pakistan.office" data-foo="{{route('rishta.pakistan.office')}}">Rishta Pakistan Office</option>
                                            <option value="family.rishta.meeting" data-foo="{{route('family.rishta.meeting')}}">Family Rishta Meeting</option>
                                            <option value="public.notices" data-foo="{{route('public.notices')}}">Public Notices</option>
                                            <option value="career" data-foo="{{route('career')}}">Career</option>
                                            <option value="confirm.customer.account" data-foo="{{route('confirm.customer.account',['info@DoosriBiwi.com'])}}">Confirm Customer Account</option>
                                            <option value="auth.verify" data-foo="{{route('auth.verify')}}">Auth Verify</option>
                                            <option value="education.form" data-foo="{{route('education.form')}}">Education Form</option>
                                            <option value="personal.form" data-foo="{{route('personal.form')}}">Personal Form</option>
                                            <option value="religion.form" data-foo="{{route('religion.form')}}">Religion Form</option>
                                            <option value="expectation.form" data-foo="{{route('expectation.form')}}">Expectation Form</option>
                                            <option value="profile.image.form" data-foo="{{route('profile.image.form')}}">Profile Image Form</option>
                                            <option value="customer.dashboard" data-foo="{{route('customer.dashboard')}}">Customer Dashboard</option>
                                            <option value="edit.personal.profile" data-foo="{{route('edit.personal.profile')}}">Edit Personal Profile</option>
                                            <option value="edit.profile" data-foo="{{route('edit.profile')}}">Edit Profile</option>
                                            <option value="edit.photo" data-foo="{{route('edit.photo')}}">Edit Photo</option>
                                            <option value="customer.like.save" data-foo="{{route('customer.like.save')}}">Customer Like & View</option>
                                            <option value="change.email.password" data-foo="{{route('change.email.password')}}">Change Email Password</option>
                                            <option value="get.customer.block" data-foo="{{route('get.customer.block')}}">Get Customer Block</option>
                                            <option value="messenger" data-foo="{{route('messenger')}}">Messenger</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 data--Profile" style="display: none;">
                                    <div class="form-group">
                                        <label for="customer_id">*Customer</label>
                                        <select class="multiple-select" name="customer_id" id="customer_id">
                                            <option value="" data-foo="Select at least one"> -- Select -- </option>
                                            @foreach($customers as $key => $val)
                                                <option value="{{$val->id}}" data-foo="{{$val->name.' - '.$val->email}}">{{$val->fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="site_name">*Site Name</label>
                                        <input type="text" name="site_name" id="site_name" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title">*Title</label>
                                        <textarea name="title" id="title" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">*Description</label>
                                        <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="schema_script">*Schema Script</label>
                                        <textarea name="schema_script" id="schema_script" rows="20" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button onclick="selectImageModal()" class="btn btn-info mb-2 btn--select-image" type="button">Select Image</button>
                                    <input type="hidden" name="image" id="image">
                                    <div class="card cardImageDiv" style="display: none;">
                                        <img src="" class="card-img-top" alt="Selected Image">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Buttons --}}
                            <div class="row">
                                <div class="col-12">
                                    <button onclick="saveRecord(this)" type="button" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                    <a href="{{route('admin.customer.portal.seo.tool')}}" type="button" class="btn btn-secondary px-5 float-end">Cancel</a>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <hr/>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imagesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="imagesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagesModalLabel">Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body data--main-content"></div>
                <div class="modal-footer">
                    <button onclick="selectImage(this)" type="button" class="btn btn-primary">Select</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('shaadi-admin/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        $(function () {
            checkType()
        });

        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
            matcher: matchCustom,
            templateResult: formatCustom
        });
        
        function checkType() {
            let type = $(':input[name="type"] option:selected').val();
            $(`.data--Profile`).hide();
            $(`.data--Page`).hide();
            if (type) {
                $(`.data--${type}`).show('slow');
            }
        }
        
        function selectImageModal() {
            $('button.btn--select-image').attr('disabled',true);
            let type = $(':input[name="type"] option:selected').val();
            let customerId = $(':input[name="customer_id"] option:selected').val();
            if (type=='') {
                alertyFy('Please select any type*','warning',3000);
                $('button.btn--select-image').attr('disabled',false);
                return false;
            }
            if (type=='Profile' && customerId=='') {
                alertyFy('Please select any customer*','warning',3000);
                $('button.btn--select-image').attr('disabled',false);
                return false;
            }

            axios.post("{{route('admin.fetch.seo.related.images')}}", {
                type:type,
                customer_id:customerId
            }).then(function (res) {
                $('#imagesModal .data--main-content').empty();
                if (res.data) {
                    $('#imagesModal .data--main-content').html(res.data);
                    setTimeout(function () {
                        $('#imagesModal').modal('show');
                    },1000)
                }
                $('button.btn--select-image').attr('disabled',false);
            }).catch(function (error) {
                alertyFy('There is something wrong','warning',3000);
                $('button.btn--select-image').attr('disabled',false);
            });
        }
        
        function selectImage(input) {
            $(input).attr('disabled',true);
            $('.cardImageDiv').hide();
            let newImageUrl = $(':input[name="seo_image"]:checked').val();
            if (!newImageUrl) {
                alertyFy('Please select an image*','warning',3000);
                $(input).attr('disabled',false);
                return false;
            }
            $('#addEditForm input[name="image"]').val(newImageUrl);
            $('.cardImageDiv img').attr('src',newImageUrl);
            $('.cardImageDiv').show('slow');
            $(input).attr('disabled',false);
            $('#imagesModal').modal('hide');
        }

        function stringMatch(term, candidate) {
            return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
        }

        function matchCustom(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }
            if (typeof data.text === 'undefined') {
                return null;
            }
            if (stringMatch(params.term, data.text)) {
                return data;
            }
            if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
                return data;
            }
            return null;
        }

        function formatCustom(state) {
            return $(
                '<div><div>' + state.text + '</div><div class="foo">'
                + $(state.element).attr('data-foo')
                + '</div></div>'
            );
        }

        function saveSeoImages(input){
            $(input).attr('disabled',true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            let newImage = '';
            if ($('input[id="seo_images"]').val()) {
                newImage = document.getElementById('seo_images').files;
            }
            let formData = new FormData();
            if (newImage && newImage.length > 0) {
                $.each(newImage, function (k, v) {
                    formData.append('seo_images[]', v);
                });
            } else {
                formData.append('seo_images[]', newImage);
            }

            axios.post("{{route('admin.seo.photos.save')}}", formData).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    selectImageModal();
                }
                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $(':input[id="seo_images"]').addClass("has-error");
                    $.each(error.response.data.errors, function (k, v) {
                        $(':input[id="seo_images"]').after("<span class='text-danger d-block'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

        function saveRecord(input) {
            $(input).attr('disabled',false);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            axios.post($('#addEditForm').attr('action'), $('#addEditForm').serialize()).then(function (res) {
                alertyFy(res.data.msg,res.data.status,3000);
                if (res.data.status=='success') {
                    console.log('Response', res.data);
                    setTimeout(function () {
                        location.href = "{{route('admin.customer.portal.seo.tool')}}";
                    },3000);
                }

                $(input).attr('disabled',false);
            }).catch(function (error) {
                $(input).attr('disabled',false);
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $('#addEditForm :input[name="' + k + '"]').addClass("has-error");
                        $('#addEditForm :input[name="' + k + '"]').after("<span class='text-danger'>" + v[0] + "</span>");
                    });
                } else {
                    alertyFy('There is something wrong','warning',3000);
                }
            });
        }

    </script>
@endpush
