@extends('front.layouts.master')
@section('title','Careers Opportunities')
@section('description', 'Careers Opportunities - Doosri Biwi')

@push('style')
	{{--Style--}}
@endpush

@section('content')

	<main class="main">

		<div class="mt-xl-43"></div>
		<div class="d-grid w-md-50 w-xl-80 mx-auto gap-12">
			<h2 class="heading-section-3 text-dark text-center mb-0">Careers Opportunities</h2>
			<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">
		</div>
		<br>

		<div class="container-xxl py-60">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="about-image mx-auto">
						<iframe width="100%" height="450px" src="https://www.youtube.com/embed/1CkHpI4BNXw" title="Career Opportunities For Females | Hiring at Doosri Biwi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
				</div>
			</div>

			<div class="card">
				<h5 class="card-header">Career at Doosri Biwi</h5>
				<div class="card-body">
					<p class="text-justify">Discover a world of thrilling possibilities for women! Embrace the remarkable career opportunities offered by Doosri Biwi - the unrivaled Matrimonial Organization in Pakistan. Prepare to be empowered through comprehensive training, skill enhancement programs, personal grooming sessions, enlightening lectures, and captivating sessions. Not only will you witness a significant increase in your income, but you'll also experience remarkable career advancements.</p>
					<p class="text-justify">Imagine a future where you break free from societal constraints and soar towards your dreams. At Doosri Biwi, we believe in unleashing the untapped potential within every woman. We understand that by providing you with the necessary tools, knowledge, and support, you can conquer any challenge that comes your way.</p>
					<p class="text-justify">Through our extensive training programs, you'll acquire the skills that will transform you into an unstoppable force. Be prepared to immerse yourself in a world of learning, where you'll gain valuable insights, master new techniques, and cultivate a mindset that radiates confidence.</p>
					<p class="text-justify">But it doesn't stop there. We go beyond empowering you professionally. Our team of experts will guide you through personal grooming sessions, helping you enhance your presence and exude self-assurance in every situation. Embrace your true beauty, both inside and out, and witness the transformative power it holds.</p>
					<p class="text-justify">Step into our inspiring lectures and captivating sessions, where you'll connect with like-minded individuals and immerse yourself in a community that supports and uplifts one another. Together, we will redefine societal norms and shatter glass ceilings, creating a world where women are celebrated for their remarkable achievements.</p>
					<p class="text-justify">As you embark on this exhilarating journey, brace yourself for a significant increase in your income. We firmly believe that your hard work and dedication deserve substantial rewards. With the doors of opportunity wide open, you'll witness a remarkable transformation in your financial well-being, providing you with the means to create a life of abundance and fulfillment.</p>
					<p class="text-justify">Don't settle for anything less than what you deserve. Join Doosri Biwi today and unlock a future filled with thrilling career opportunities. Together, let's pave the way for a new era of empowered women who fearlessly chase their dreams and achieve unprecedented success.</p>
				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">Very Important Message</h5>
				<div class="card-body">
					<p class="text-justify">Doosri Biwi have a fast-paced work environment.</p>

					<p class="text-justify">We emphasis on high quality service based on truth, honesty, integrity and perfection.</p>

					<p class="text-justify">Career/job at Doosri Biwi is not an ordinary job. Our clients trust us. They gave a very important decision of their life in our hands. It is a very big responsibility and we take this very seriously.</p>

					<p class="text-justify">Therefore, we only hire people who always speak the trust irrespective of results, who do not hide facts from us and from our clients, who always fulfill their commitments with us and with our clients, who have high moral and ethical standards, who refrain from any type of internal politics or groupism, who treat every person and our clients with love and care, who are passionate and want to bring chance in their life and also in the lives of our clients, who have keen interest in making everyone’s life happy and beautiful especially our clients and willing to go an extra mile for that.</p>

					<p class="text-justify"><strong>Above points are so much important for us that we have made it mandatory for every team member to sign a ‘Hulf Nama’ and take Oath which contains above points. </strong></p>
					<p class="text-center"><strong><span class="text-theme">Those looking for an easy job please DO NOT APPLY.</span></strong></p>
				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">Organizational Structure</h5>
				<div class="card-body">
					<img src="{{asset('assets/img/shaadi-organization-pakistan-organizational-structure.jpg')}}" alt="Organizational Structure" width="100%" height="100%">
				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">Package / Benefits</h5>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							@foreach($packagesBenifits as $result)
								<tr>
									@foreach($result as $val)
										<td>{{$val}}</td>
									@endforeach
								</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">Life at Doosri Biwi</h5>
				<div class="card-body">
					<div class="career_slider">
						<img src="{{asset('career_image/01.jpg')}}" alt="Event 1" width="100%">
						<img src="{{asset('career_image/02.jpg')}}" alt="Event 2" width="100%">
						<img src="{{asset('career_image/03.jpg')}}" alt="Event 3" width="100%">
						<img src="{{asset('career_image/04.jpg')}}" alt="Event 4" width="100%">
						<img src="{{asset('career_image/05.jpg')}}" alt="Event 5" width="100%">
						<img src="{{asset('career_image/06.jpg')}}" alt="Event 6" width="100%">
						<img src="{{asset('career_image/07.jpg')}}" alt="Event 7" width="100%">
						<img src="{{asset('career_image/08.jpg')}}" alt="Event 8" width="100%">
						<img src="{{asset('career_image/09.jpg')}}" alt="Event 9" width="100%">
						<img src="{{asset('career_image/10.jpg')}}" alt="Event 10" width="100%">
						<img src="{{asset('career_image/11.jpg')}}" alt="Event 11" width="100%">
					</div>

					<div class="career_slider">
						<img src="{{asset('career_image/12.jpg')}}" alt="Event 12" width="100%">
						<img src="{{asset('career_image/13.jpg')}}" alt="Event 13" width="100%">
						<img src="{{asset('career_image/14.jpg')}}" alt="Event 14" width="100%">
						<img src="{{asset('career_image/15.png')}}" alt="Event 15" width="100%">
						<img src="{{asset('career_image/16.png')}}" alt="Event 16" width="100%">
						<img src="{{asset('career_image/17.png')}}" alt="Event 17" width="100%">
						<img src="{{asset('career_image/18.png')}}" alt="Event 18" width="100%">
						<img src="{{asset('career_image/19.png')}}" alt="Event 19" width="100%">
						<img src="{{asset('career_image/20.png')}}" alt="Event 20" width="100%">
						<img src="{{asset('career_image/21.png')}}" alt="Event 21" width="100%">
						<img src="{{asset('career_image/22.png')}}" alt="Event 22" width="100%">
						<img src="{{asset('career_image/23.png')}}" alt="Event 23" width="100%">
					</div>

				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">How to Apply</h5>
				<div class="card-body">
					<p class="text-justify">If you are a career oriented person with passion, creativity, and seeking a challenging career then feel free to drop your CV at <strong class="text-theme">HR WhatsApp: "<a
					href="https://api.whatsapp.com/send?phone=923323050498&amp;text=Hi%20Shaadi.org.pk%2C%20I%20need%20more%20information.">03323050498</a>"</strong>. Mention job post name in WhatsApp message. Please send a voice message explaining
					why you are the perfect candidate for the position. Make sure your CV is up-to-date, have a recent photo on top, mention percentage and grade of your academic qualification, and mention job details which you have done along with start and end dates. We verify all the details so make sure all the information in your CV is accurate and verifiable.</p>

				</div>
			</div>
			<br>
			{{--<div class="card">--}}
				{{--<h5 class="card-header">Office Manager / Administrator</h5>--}}
				{{--<div class="card-body">--}}
					{{--Job Type:--}}
					{{--<ul>--}}
						{{--<li>Full-time, Permanent, Office Based, Six Days A Week </li>--}}
					{{--</ul>--}}

					{{--Location:--}}
					{{--<ul>--}}
						{{--<li>Block 10, Behind Aziz Bhatti Park, Gulshan-e-Iqbal, Karachi.</li>--}}
						{{--<li>Block D, Main Five Star Chowrangi, North Nazimabad, Karachi.</li>--}}
					{{--</ul>--}}

					{{--Experience:--}}
					{{--<ul>--}}
						{{--<li>8+ Year in matchmaking or in a multinational company</li>--}}
					{{--</ul>--}}

					{{--Roles and Responsibilities:--}}
					{{--<ul>--}}
						{{--<li>Complete Office Management and Administration</li>--}}
						{{--<li>Staff Hiring, Training and Staff Management</li>--}}
						{{--<li>Vendor Management</li>--}}
						{{--<li>Supervising the daily operations</li>--}}
						{{--<li>Collaborate with other departments</li>--}}
						{{--<li>Arrange in-office events and meetings</li>--}}
						{{--<li>Prioritize and delegate work tasks for self and the team focusing on customer needs and performance targets of customer care.</li>--}}
						{{--<li>Meet and exceed established goals, targets and expectations.</li>--}}
						{{--<li>Take part in marketing activities</li>--}}
					{{--</ul>--}}

					{{--Requirement:--}}
					{{--<ul>--}}
						{{--<li> Must be a female and resident of Karachi</li>--}}
						{{--<li> At least Graduate prefer Masters</li>--}}
						{{--<li> Must have own conveyance</li>--}}
						{{--<li> Ability to manage office independently</li>--}}
						{{--<li> Highly Responsible, Punctual</li>--}}
						{{--<li> Eye for Details</li>--}}
						{{--<li> High level of honesty and integrity</li>--}}
						{{--<li> Must be able to provide references</li>--}}
						{{--<li> Excellent skills in Computer, Internet, Word, Excel, English</li>--}}
						{{--<li> Excellent Written and Verbal skills in English and Urdu</li>--}}
						{{--<li> Excellent Interpersonal Communication</li>--}}
						{{--<li> Problem-solving skills and someone who is consistently thinking outside the box</li>--}}
						{{--<li> Result-Driven, Action-Oriented, and Self-Motivated Mindset</li>--}}
						{{--<li> Intelligent, Energetic, Sharp Mind, Good Memory, Good Personality</li>--}}
						{{--<li> Ability to site late and ensure the best quality service from the start of day until close of day.</li>--}}
					{{--</ul>--}}

					{{--Package:--}}
					{{--<ul>--}}
						{{--<li>Total package depends on education, experience, performance in interview, test, and demo. Package include all the points as mentioned above in the Package / Benefits sections.</li>--}}
					{{--</ul>--}}
				{{--</div>--}}
			{{--</div>--}}
			<br>
			<div class="card">
				<h5 class="card-header">Manager Customer Service</h5>
				<div class="card-body">
					Job Type:
					<ul>
						<li>Full-time, Permanent, Office Based, Six Days A Week </li>
					</ul>

					Location:
					<ul>
						<li>Block 10, Behind Aziz Bhatti Park, Gulshan-e-Iqbal, Karachi.</li>
						<li>Block D, Main Five Star Chowrangi, North Nazimabad, Karachi.</li>
					</ul>

					Roles and Responsibilities:
					<ul>
						<li> Hiring, Coaching and Development of the Call Center Team, Customer Service Team, and Digital Media Teams </li>
						<li> Assign tasks to all teams </li>
						<li> Supervising the daily operations of 20 to 25 people </li>
						<li> Collaborate with other departments </li>
						<li> Arrange in-office events and meetings </li>
						<li> Provide exceptional service to customers during events </li>
						<li> Prioritize and delegate work tasks for self and the team focusing on customer needs and performance targets of customer care. </li>
						<li> Provide suggestions or alternatives for improving Customer Service Quality to meet and exceed customer’s expectations. </li>
						<li> Meet and exceed established goals, targets and expectations. </li>
						<li> Take part in marketing activities </li>
					</ul>

					Requirement:
					<ul>
						<li> Graduate or Masters (16 years of education)</li>
						<li> Minimum 8 years post qualification relevant experience. </li>
						<li> Ability to manage team of 20 to 25 people </li>
						<li> Excellent command and speed on computer, MS Office, and social media. </li>
						<li> Excellent Written and Verbal skills in English and Urdu </li>
						<li> Excellent Interpersonal Communication </li>
						<li> Outgoing, Friendly and Positive Attitude </li>
						<li> Problem-solving skills and someone who is consistently thinking outside the box </li>
						<li> Result-Driven, Action-Oriented, and Self-Motivated Mindset </li>
						<li> Intelligent, Energetic, Sharp Mind, Good Memory, Good Personality </li>
						<li> Ability to site late and ensure the best quality service from the start of day until close of day. </li>
					</ul>

					Package:
					<ul>
						<li>Total package depends on education, experience, performance in interview, test, and demo. Package include all the points as mentioned above in the Package / Benefits sections.</li>
					</ul>
				</div>
			</div>
			<br>
			{{--<div class="card">--}}
				{{--<h5 class="card-header">Manager Marketing</h5>--}}
				{{--<div class="card-body">--}}
					{{--Job Type:--}}
					{{--<ul>--}}
						{{--<li>Full-time, Permanent, Office Based, Six Days A Week </li>--}}
					{{--</ul>--}}

					{{--Location:--}}
					{{--<ul>--}}
						{{--<li>Block 10, Behind Aziz Bhatti Park, Gulshan-e-Iqbal, Karachi.</li>--}}
						{{--<li>Block D, Main Five Star Chowrangi, North Nazimabad, Karachi.</li>--}}
					{{--</ul>--}}

					{{--Roles and Responsibilities:--}}
					{{--<ul>--}}
						{{--<li> Conducting all kinds of outdoor marketing activities (Seminars, Expos, BTL, Door to Door, B2B, B2C, Road Shows)</li>--}}
						{{--<li> Hiring, Coaching and Development of the outdoor marketing staff</li>--}}
						{{--<li> Assign tasks to all teams</li>--}}
						{{--<li> Supervising the daily operations of all marketing staff</li>--}}
						{{--<li> Collaborate with other departments</li>--}}
						{{--<li> Coordinating with vendors</li>--}}
						{{--<li> Arrange in-office and outdoor events and meetings</li>--}}
						{{--<li> Provide exceptional service to customers</li>--}}
						{{--<li> Prioritize and delegate work tasks for self and the team</li>--}}
						{{--<li> Focusing on customer needs and performance targets of marketing</li>--}}
						{{--<li> Provide suggestions or alternatives for getting more leads and customers.</li>--}}
						{{--<li> Meet and exceed established goals, targets and expectations. </li>--}}
					{{--</ul>--}}

					{{--Requirement:--}}
					{{--<ul>--}}
						{{--<li> Graduate or Masters</li>--}}
						{{--<li> Minimum 5 years post qualification marketing experience.</li>--}}
						{{--<li> Ability to manage team</li>--}}
						{{--<li> Good contacts with vendors, merchants, marketing teams, BTL teams, Brand Ambassadors, Hotels, Expo and Convention centers</li>--}}
						{{--<li> Excellent command and speed on computer and MS Office.</li>--}}
						{{--<li> Excellent Written and Verbal skills in English and Urdu</li>--}}
						{{--<li> Excellent Interpersonal Communication</li>--}}
						{{--<li> Outgoing, Friendly and Positive Attitude</li>--}}
						{{--<li> Problem-solving skills and someone who is consistently thinking outside the box</li>--}}
						{{--<li> Result-Driven, Action-Oriented, and Self-Motivated Mindset</li>--}}
						{{--<li> Intelligent, Energetic, Sharp Mind, Good Memory, Good Personality</li>--}}
						{{--<li> Ability to give more time to get the best leads throughout the day </li>--}}
					{{--</ul>--}}

					{{--Package:--}}
					{{--<ul>--}}
						{{--<li>Total package depends on education, experience, performance in interview, test, and demo. Package include all the points as mentioned above in the Package / Benefits sections.</li>--}}
					{{--</ul>--}}
				{{--</div>--}}
			{{--</div>--}}
			<br>
			<div class="card">
				<h5 class="card-header">Female Matchmaker</h5>
				<div class="card-body">
					Job Type:
					<ul>
						<li>Full-time, Permanent, Office Based, Six Days A Week</li>
						<li>Timing: 11 am to 8 pm | 12 pm to 9 pm | 1 pm to 10 pm</li>
					</ul>

					Location:
					<ul>
						<li>Block 10, Behind Aziz Bhatti Park, Gulshan-e-Iqbal, Karachi.</li>
						<li>Block D, Main Five Star Chowrangi, North Nazimabad, Karachi.</li>
					</ul>

					Roles and Responsibilities:
					<ul>
						<li> Provide Matchmaker related Customer Services (Show Rishta/Proposals) to Clients. </li>
						<li> Communication with families and other matchmakers </li>
						<li> Family Rishta Meeting Arrangements in the office. </li>
						<li> Participate in Family Rishta Meeting in the office. </li>
					</ul>

					Requirement:
					<ul>
						<li>Female Only </li>
						<li>Graduate or Masters </li>
						<li>2+ Year Experience in Customer Service </li>
						<li>Very Good Command and Speed on Computer </li>
						<li>Sharp Mind, Good Memory, Friendly Attitude, Energetic, Presentable </li>
					</ul>

					Package:
					<ul>
						<li>Total package depends on education, experience, performance in interview, test, and demo. Package include all the points as mentioned above in the Package / Benefits sections.</li>
					</ul>
				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">Female Call Center Officer</h5>
				<div class="card-body">
					Job Type:
					<ul>
						<li>Full-time, Permanent, Office Based, Six Days A Week</li>
						<li>Timing: 11 am to 8 pm | 12 pm to 9 pm | 1 pm to 10 pm</li>
					</ul>

					Location:
					<ul>
						<li>Block 10, Behind Aziz Bhatti Park, Gulshan-e-Iqbal, Karachi.</li>
						<li>Block D, Main Five Star Chowrangi, North Nazimabad, Karachi.</li>
					</ul>

					Roles and Responsibilities:
					<ul>
						<li> Outbound / Inbound Calls to Leads </li>
						<li> Guide the leads about matchmaking process. </li>
						<li> Convert the leads into paid clients </li>
					</ul>

					Requirements:
					<ul>
						<li> Females Only </li>
						<li> 1+ Year Outbound Calls / Outbound Call Center Experience </li>
						<li> Excellent Communication Skills &amp; Power to Convince People </li>
						<li> Good Command on Computer </li>
						<li> Talkative and Good Voice </li>
						<li> Friendly Attitude and Energetic </li>
						<li> Sharp &amp; Active Mind, Good Memory and Good Personality </li>
					</ul>

					Package:
					<ul>
						<li>Total package depends on education, experience, performance in interview, test, and demo. Package include all the points as mentioned above in the Package / Benefits sections.</li>
					</ul>
				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">Female Admin Officers</h5>
				<div class="card-body">
					Job Type:
					<ul>
						<li>Full-time, Permanent, Office Based, Six Days A Week</li>
						<li>Timing: 11 am to 8 pm | 12 pm to 9 pm | 1 pm to 10 pm</li>
					</ul>

					Office Locations:
					<ul>
						<li> Block 10, Behind Aziz Bhatti Park, Gulshan-e-Iqbal, Karachi. </li>
						<li>Block D, Main Five Star Chowrangi, North Nazimabad, Karachi.</li>
					</ul>

					Requirements (Very Important):
					<ul>
						<li>Female Only</li>
						<li>Age: 25+</li>
						<li>2+ Year Experience in Admin, Customer Service</li>
						<li>Inter, Graduate or Masters</li>
						<li>Must have very good command on computer: Typing with both hands, Word, Excel, Browsing, Searching, etc.</li>
						<li>Highly Motivated, Talented, Independent, Career Oriented, Friendly Attitude, Energetic, Hardworking, Sharp & Active Mind, Good Memory.</li>
					</ul>

					Job Description:
					<ul>
						<li>Provide customer service through Computer and Applications to the clients.</li>
						<li>Pre and Post Counseling</li>
					</ul>

					Goal:
					<ul>
						<li>Providing the Best Customer Service Experience for our clients is our Number One goal and this is what drives us, we hope this is a motivator for you also.</li>
					</ul>

					Package:
					<ul>
						<li>Basic Salary: Rs. 40,000 to 50,000 per Month </li>
						<li>Other benefits and allowances as mentioned above in the Package / Benefits sections.</li>
					</ul>
				</div>
			</div>
			<br>
			<div class="card">
				<h5 class="card-header">Female Data Entry Executive</h5>
				<div class="card-body">
					Job Type:
					<ul>
						<li>Full-time, Permanent, Office Based, Six Days A Week </li>
						<li> Timing: 11 am to 8 pm | 12 pm to 9 pm | 1 pm to 10 pm</li>
					</ul>

					Office Locations:
					<ul>
						<li>Block 10, Behind Aziz Bhatti Park, Gulshan-e-Iqbal, Karachi.</li>
						<li>Block D, Main Five Star Chowrangi, North Nazimabad, Karachi.</li>
					</ul>

					Requirements (Very Important):
					<ul>
						<li>Female Only</li>
						<li>Age: 23+</li>
						<li>1+ Year Experience in Data Entry</li>
						<li>Inter, Graduate</li>
						<li>Must have very good command on computer: Typing with both hands, Word, Excel, Browsing, Searching, etc.</li>
						<li>Highly Motivated, Talented, Independent, Career Oriented, Friendly Attitude, Energetic, Hardworking, Sharp & Active Mind, Good Memory.</li>
					</ul>

					Job Description:
					<ul>
						<li>Enter data in our CRM and Data Base Management System with accuracy</li>
						<li>Any other duties assigned</li>
					</ul>

					Goal:
					<ul>
						<li>Providing the Best Customer Service Experience for our clients is our Number One goal and this is what drives us, we hope this is a motivator for you also.</li>
					</ul>

					Package:
					<ul>
						<li>Basic Salary: Rs. 35,000 to 45,000 per Month</li>
						<li>Other benefits and allowances as mentioned above in the Package / Benefits sections.</li>
					</ul>
				</div>
			</div>
			<br>
			<p style="text-align: justify;font-weight: bold;">Doosri Biwi have a fast-paced work environment. We emphasis on high quality service based on truth, honesty, integrity and perfection. <strong class="text-theme">Those looking for an easy job please DO NOT APPLY.</strong></p>
		</div>

		<div class="mt-xl-43"></div>

	</main>

@endsection

@push('script')
	<script type="text/javascript">
        $('.career_slider').slick({
            dots: false,
            infinite: true,
            speed: 600,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            arrows: false,
            responsive: [{
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
                {
                    breakpoint: 400,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
        });
	</script>
@endpush