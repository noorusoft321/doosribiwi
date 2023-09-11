@extends('front.layouts.master')

@section('title','Shaadi - Tips and Articles')
@section('description', 'Browse through our informative blogs and articles to get enlightened with valuable and supportive tips related to online marriage in Pakistan.')

@push('style')
	<style>
		.card-body p {
			padding: 10px 0px 10px 0px;
		}
	</style>
@endpush

@section('content')
	<div class="container-xxl py-60">
		<div class="card">
			<h5 class="card-header">6 Secrets to a Happy Married Life</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Pakistan-Rishta-Sites.jpg" alt="" class="full-width">
				<div>
					<p>
						6 Secrets to a Happy Married Life Usually, during the first few months of marriage, everything goes smoothly. But after marriage, conflicts between the couples tend to arise. What causes them? Well, the most major reason is that people start taking their soul-mates for granted. Being a married person, you love and respect your partner […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="{{Route('secretstoahappymarriedlife')}}" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">7 Things to Avoid in Marriage</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/7-Things-to-Avoid-in-Marriage.jpg" alt="" class="full-width">
				<div>
					<p>
						7 Things to Avoid in Marriage It is a fact that there are no “perfect relationships.” The little things change us. But at the end of the day, having each other’s back in married life is what really matters. Keep in mind that the ultimate goals should be happiness, satisfaction, and fulfilment. The beginning of […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="7-things-to-avoid-in-marriage" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Best Honeymoon Destinations in Pakistan</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Best-Honeymoon-Destinations-in-Pakistan.jpg" alt="" class="full-width">
				<div>
					<p>
						7 Things to Avoid in Marriage It is a fact that there are no “perfect relationships.” The little things change us. But at the end of the day, having each other’s back in married life is what really matters. Keep in mind that the ultimate goals should be happiness, satisfaction, and fulfilment. The beginning of […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="best-honeymoon-destinations-in-pakistan" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Pre-Marriage To-Do List for Brides</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Best-Honeymoon-Destinations-in-Pakistan.jpg" alt="" class="full-width">
				<div>
					<p>
						Pre-Marriage To-Do List for Brides Everyone goes through different stages in life. Marriage happens to be one of them. It is the name of another life phase that cuts you off from your prior single life. Though all the phases of life are beautiful and worthy at their own place, marriage is the one which […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="pre-marriage-to-do-list-for-brides" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		{{--<div class="card">
			<h5 class="card-header">The role of shaadi websites in Pakistani culture</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Best-Honeymoon-Destinations-in-Pakistan.jpg" alt="" class="full-width">
				<div>
					<p>
						“I created you from one soul, and from the soul, I created its mate so that you may live in harmony and love” (Al-Quran) Marriage is a heavenly event in which two individuals tie a beautiful and lovely knot, promising to be with each other forever. The importance of marriages is mentioned in both the […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="the-role-of-shaadi-websites-in-pakistani-culture" >Read More</a>
                    </span>
				</div>
			</div>
		</div>--}}

		<div class="card">
			<h5 class="card-header">The role of shaadi websites in Pakistani culture</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/The-role-of-shaadi-websites-in-Pakistani-culture.jpg" alt="" class="full-width">
				<div>
					<p>
						“I created you from one soul, and from the soul, I created its mate so that you may live in harmony and love” (Al-Quran) Marriage is a heavenly event in which two individuals tie a beautiful and lovely knot, promising to be with each other forever. The importance of marriages is mentioned in both the […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="the-role-of-shaadi-websites-in-pakistani-culture" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">How to Seek Your Life Partner Through Shaadi Websites?</h5>
			<div class="card-body">
				<div>
					<p>
						When you complete your education and get settled in your job, your family and friends start to force you to get married. There is a time for everything, that’s why it is good to fulfil this responsibility at the right time. Traditionally speaking, the process of finding the right person starts with asking your relatives […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-to-seek-your-life-partner-through-shaadi-websites" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">How to Find the Best & Authentic Shaadi Websites in Pakistan?</h5>
			<div class="card-body">
				<div>
					<p>
						There comes a time in every individual’s life when he/she needs to find a life partner to spend the rest of the life happily and peacefully with own family. The future life heavily depends on which type of person you choose as your spouse, as life with the right person is always perfect! With the […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-to-find-the-best-authentic-shaadi-websites-in-pakistan" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">7 Reasons Why Desi Weddings Are the Best</h5>
			<div class="card-body">
				<div>
					<p>
						You can have family members or relatives that got married abroad in a non-traditional ceremony or foreign friends whose weddings you attended to support them on their big day but one thing is for sure – you have never attended a wedding as great as the traditional kind that happens in Pakistan. With tens of […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="7-reasons-why-desi-weddings-are-the-best" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Pakistani Wedding Preparation – 5 Things to Not Leave to the Last Minute</h5>
			<div class="card-body">
				<div>
					<p>
						Wedding season in Pakistan has just begun again with a bang and we couldn’t be more excited! Whether you have had a wedding in the family, planned your own or helped a relative or friend with all their arrangements, you must be all too familiar with the months and months of preparation that go into […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="pakistani-wedding-preparation-5-things-to-not-leave-to-the-last-minute" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Shaadi Expo Pakistan – What It Is All About!</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/shaadi-expo-pakistan.jpg" alt="" class="full-width">
				<div>
					<p>
						If your wedding is coming up, then you must be feeling on top of the world but what you need to realize is that your dream wedding can turn into a total nightmare if you leave the shopping till the eleventh hour. If you truly want to turn your dream wedding into a reality, a […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="shaadi-expo-pakistan-what-it-is-all-about" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Shaadi Expo Pakistan – What It Is All About!</h5>--}}
		{{--<div class="card-body">--}}
		{{--<img src="{{asset('blogs-images')}}/shaadi-expo-pakistan.jpg" alt="" class="full-width">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--If your wedding is coming up, then you must be feeling on top of the world but what you need to realize is that your dream wedding can turn into a total nightmare if you leave the shopping till the eleventh hour. If you truly want to turn your dream wedding into a reality, a […]--}}
		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		<div class="card">
			<h5 class="card-header">How to Find Your Ideal Life Partner</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/find-ideal-life-partner.jpg" alt="" class="full-width">
				<div>
					<p>
						Admit it or not, everyone, at some point or the other, starts to look for the love of their life. We always look for someone with whom we can spend the rest of our lives and be happy, loved, and at peace – a person who stands by our side no matter how good or […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-to-find-your-ideal-life-partner" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">What the Top Matrimonial Services in Pakistan Promise to Deliver</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/matching-partner.jpg" alt="" class="full-width">
				<div>
					<p>
						Nobody can deny the fact that marriage is one of the most important decisions in one’s life. Your future life is based on this one decision which is why everyone wishes to find a good spouse for themselves. These days, matrimonial websites are getting increasingly popular among a large number of people who are genuinely […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="what-the-top-matrimonial-services-in-pakistan-promise-to-deliver" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Top 6 Advantages of Pakistan Rishta Sites</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Pakistan-Rishta-Sites.jpg" alt="" class="full-width">
				<div>
					<p>
						Searching for a suitable partner to live a successful married life with is hard. However, it can become even more difficult for you if you don’t have a large social circle. This is the reason why a majority of people decide to go for Pakistan Rishta sites in order to find the perfect match. Understandably, […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="top-6-advantages-of-pakistan-rishta-sites" >Read More</a>
                    </span>
				</div>
			</div>
		</div>


		<div class="card">
			<h5 class="card-header">Why Choose Pakistan Matrimonial Sites for Top-Notch Matchmaking Services</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Pakistan-Matrimonial.jpg" alt="" class="full-width">
				<div>
					<p>
						Marriage is something that requires a lot of consideration. Choosing a perfect life partner on your own is one of the most difficult tasks of one’s life. You cannot afford to choose a toxic life partner because you will eventually be forced to regret your decision your entire life. Chances are, you will never forgive […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="why-choose-pakistan-matrimonial-sites-for-top-notch-matchmaking-services" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Things You Need to Know about Elite Matrimonial Service</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/elite-matrimonial-service-banner.jpg" alt="" class="full-width">
				<div>
					<p>
						Many people believe that having a lot of money can automatically solve all your problems in life but that is not the case. In fact, that is far from the truth. When it comes to selecting a perfect match for yourself, for example, people who belong to the privileged class generally come across gold diggers […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="things-you-need-to-know-about-elite-matrimonial-service" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Best Marriage Bureau in Karachi – Doosri Biwi</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Best-Marriage-Bureau.jpg" alt="" class="full-width">
				<div>
					<p>
						Marriage is believed to be the union of two souls, an arrangement in which they come together to share their joys and sorrows with each other and stick together no matter what life throws at them. Different people find their partners based on different criteria. Many individuals prefer to select their partners from the same […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="best-marriage-bureau-in-karachi-shaadi-organization-pakistan" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Online Marriage Sites – The Best Way to Find the Right Partner</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Online-MArriage-Sites-938x527.jpg" alt="" class="full-width">
				<div>
					<p>
						In this modern age, the traditional ways of finding a partner have been rejected by individuals looking to get married as they are more likely to find their perfect match from a reliable online platform. As time has passed, parents have moved past the practice of asking their friends, relatives, and marriage brokers and have […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="online-marriage-sites-the-best-way-to-find-the-right-partner" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">How Matrimonial Sites Can Help You Find a Rishta in the USA</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Perfect-Rishta-Pakistan.jpg" alt="" class="full-width">
				<div>
					<p>
						The percentage of Pakistani Muslims residing in almost all parts of the world is increasing day by day. When it comes to marriage, the Pakistanis living in different parts of the world like in the USA, UK, and UAE always prefer to marry someone from the same community, ethnicity, and religion because they look for […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-matrimonial-sites-can-help-you-find-a-rishta-in-the-usa" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Role of Karachi Matrimonial Services in Finding You a Suitable Partner</h5>
			<div class="card-body">
				<div>
					<p>
						Karachi is the largest and most overcrowded metropolitan city of Pakistan. Due to the rapid growth of this city, its population has reached up to 23 million people. And finding the perfect match for yourself or a loved one from among so many people is like finding a needle in a haystack. With every passing […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="role-of-karachi-matrimonial-services-in-finding-you-a-suitable-partner" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		{{--<div class="card">--}}
		{{--<h5 class="card-header">How to Live Your ‘Happily Ever After’</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--For some people, finding the love of their life and getting married to them is one of the most desired goals in life because fairy tales have made them believe that if you end up with your true love, everything else will fall into place itself. But what they fail to realize is that life […]--}}
		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		<div class="card">
			<h5 class="card-header"> ‘4 Reasons to Invest in a Matrimonial Service Provider’</h5>
			<div class="card-body">
				<div>
					<p>
						There’s no denying the fact that marriage is one the most wonderful aspects of one’s life, where two people come together to tie the knot and promise to spend the rest of their lives together, in sickness and in health. They say that Allah has already created the pairs in heaven but how far we […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="4-reasons-to-invest-in-a-matrimonial-service-provider" >Read More</a>
                    </span>
				</div>
			</div>
		</div>



		<div class="card">
			<h5 class="card-header">How to Look for a Perfect Rishta in Pakistan’</h5>
			<div class="card-body">
				<div>
					<p>
						‘You have completed your education and now it’s high time you got married,’ says every mother when a Pakistani girl accomplishes her top-priority goals that she had set as a kid – graduating university or finding her place in the corporate world among other possibilities. It is the time when a girl’s mother starts looking […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-to-look-for-a-perfect-rishta-in-pakistan" >Read More</a>
                    </span>
				</div>
			</div>
		</div>


		<div class="card">
			<h5 class="card-header">How to Find Your Perfect Bride in Today’s Modern Era’</h5>
			<div class="card-body">
				<div>
					<p>
						Marriage is one of the biggest commitments of one’s life and you need to give it a great deal of consideration before making a final decision. Finding the right partner holds a lot of importance because if you make the wrong decision, your whole life will be no less than a nightmare. The opportunity to […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-to-find-your-perfect-bride-in-todays-modern-era" >Read More</a>
                    </span>
				</div>
			</div>
		</div>


		<div class="card">
			<h5 class="card-header">How to Look for the Perfect Groom in Pakistan</h5>
			<div class="card-body">
				<img src="{{asset('blogs-images')}}/Perfect-Groom.jpg" alt="" class="full-width">
				<div>
					<p>
						Every girl dreams about her big day and her future husband from a very young age. In the process, she develops a checklist of qualities that he should possess. It is believed by many males in the Pakistani society that women have an unattainable checklist of traits and things that they look for in their […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-to-look-for-the-perfect-groom-in-pakistan" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">5 Things Every Girl Must Do Before Her Big Day</h5>
			<div class="card-body">
				<div>
					<p>
						Whether you are going to get married in the next couple of months or in a few weeks, you will find yourself running here and there till the very last moment because of the endless things on your to-do list. And you are not alone in this – almost everyone has to get through the […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="5-things-every-girl-must-big-day" >Read More</a>
                    </span>
				</div>
			</div>
		</div>


		<div class="card">
			<h5 class="card-header">Doosri Biwi – Matchmaking Events to Facilitate New Beginnings</h5>
			<div class="card-body">
				<div>
					<p>
						Gone are the days when people used to agree to a marriage proposal after a single glance at a picture of the prospect. Today, we are slowly moving on from such conservative trends. Nowadays, everyone wants to get married to the person they truly love – someone they know well. Many, however, are not able […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="shaadi-organization-pakistan-matchmaking-events-facilitate-new-beginnings" >Read More</a>
                    </span>
				</div>
			</div>
		</div>


		<div class="card">
			<h5 class="card-header">How to Plan a Wedding in Pakistan While Staying on Budget</h5>
			<div class="card-body">
				<div>
					<p>
						Most of us dream of a fancy, luxurious, and glamorous wedding since it is the most important day of our lives and we cherish the memories that we make on this day, forever. It is to be kept in mind, though, that if you go for your dream wedding, chances are you might end up […]
					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="plan-wedding-pakistan-staying-budget" >Read More</a>
                    </span>
				</div>
			</div>
		</div>


		<div class="card">
			<h5 class="card-header">5 Reasons Why You Should Hire Matchmakers</h5>
			<div class="card-body">
				<div>
					<p>
						When it comes to finding the perfect partner, the person you’ll spend the rest of your life with, many of us experience anxiety and worry since it is difficult to find a perfect match for yourself and make such a big decision on your own. The search process is a challenging task, especially if one […]

					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="5-reasons-hire-matchmakers" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">How to Deal with Differences in a Marriage </h5>
			<div class="card-body">
				<div>
					<p>
						When one gets married, they have incredibly high expectations from their spouse. This is because all their life, they fantasize about the ideal marriage to the extent where they start to believe that everything will just fall into place right after getting married and life will be perfect. The reality, however, is very different and […]

					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="how-to-deal-with-differences-in-a-marriage" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">Marriage Trends in Pakistan – Then Vs Now </h5>
			<div class="card-body">
				<div>
					<p>
						In recent times, the Pakistani society has seen many cultural and social changes due to an increase in education, the development of technology, and the media. The most prominent change among these is the drastic transformation of the institution of marriage and the trends related to it. The challenges people encountered in previous years and […]

					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="marriage-trends-in-pakistan-then-vs-now" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">The Ultimate Guide to Setting the Right Beauty Regimen for Radiant Beauty</h5>
			<div class="card-body">
				<div>
					<p>
						Every woman dreams of looking breathtakingly beautiful at her wedding. But planning a wedding and micromanaging everything to the last detail; from the makeup to the trousseau to the décor of the wedding hall and catering is no cakewalk which is why most brides have no time left to spend on pre-wedding beauty rituals. Nowadays, […]




					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="the-ultimate-guide-to-setting-the-right-beauty-regimen-for-radiant-beauty" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		<div class="card">
			<h5 class="card-header">10 Tips That Will Help You Build a Good Relationship with Your In-laws</h5>
			<div class="card-body">
				<div>
					<p>
						Marriage comes with big responsibilities that require you to develop courage, patience, and stamina to tackle with the challenging situations and make your marriage a successful relationship. In-laws play a very important role in every marriage; they are responsible for good and bad impact on this relationship. To avoid the bad impact on your marriage […]

					</p>
				</div>
				<br>
				<div class="col-12 text-center">
                    <span class="ms-auto">
                        <a class="btn btn-outline-primary" href="10-tips-that-will-help-you-build-a-good-relationship-with-your-in-laws" >Read More</a>
                    </span>
				</div>
			</div>
		</div>

		{{--<div class="card">--}}
		{{--<h5 class="card-header">5 Easy Steps to Have Beautiful Hands and Feet before Your Big Day</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Do you want to look beautiful from head to toe on your wedding day? Are you worried that your hands and feet will not look as fresh and radiant as your face? Too much of wedding preparations and shopping has made your hands and feet dull and dry? Are you looking for the best tips […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--Next Pages which is not completed--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Pepper your Wedding with a Unique Touch</h5>--}}
		{{--<div class="card-body">--}}
		{{--<img src="{{asset('blogs-images')}}/Soft-Skin-Shaadi.org_.pk_-938x625.jpg" alt="" class="full-width">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Do you want your wedding to be memorable, unique, and entertaining? Coming up with a perfect setting for wedding festive can be challenging. There are a larger number of places to select from. The number of possibilities depends on your budget, the number of guests you are planning to invite and also the time of […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Simple DIY Makeup Tips Every Bride Must Know About</h5>--}}
		{{--<div class="card-body">--}}
		{{--<img src="{{asset('blogs-images')}}/makeup_display_counterfeit-938x380.jpg" alt="" class="full-width">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Are you one of those daring brides-to-be who love to experiment with their look for their wedding day? Or are you on a tight budget and cannot afford to have your bridal makeup done from a high-end beauty parlor? Well, let us face it; if you are a pro at doing makeup yourself then you […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Simple DIY Makeup Tips Every Bride Must Know About – Part II--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Young brides these days prefer to do bridal makeup themselves on their wedding day for various reasons. Some are on a tight budget while others have steely confidence in their makeup skills enough to make them want to do their hair and makeup on their big day all by themselves. Now, you may have stellar […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Do not Fret over the Small Things in Love: 6 Tips for a Successful Married Life</h5>--}}
		{{--<div class="card-body">--}}
		{{--<img src="{{asset('blogs-images')}}/Ring.jpg" alt="" class="full-width">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Couples are usually on their best behavior during the courtship period but once they are married, they start taking their better half for granted and troubles arise in marital paradise. Wait, then you see couples who have been together for years and they still stick together like lovebirds. Well, not many couples know the unwritten […]--}}
		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">The Secrets of Successful Marriages</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Ready to ‘Tie the Knot’? Read the Success Secrets of a Marriage Have you ever heard someone say: ‘I want my first marriage to be the last one?’ That is because they want to have a successful marriage, that will not end up with God Forbid divorce or separation. Having a blooming married life comprises […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">An Insight to Women’s Likes and Dislikes</h5>--}}
		{{--<div class="card-body">--}}
		{{--<img src="{{asset('blogs-images')}}/blog_slider_02.jpg" alt="" class="full-width">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Wanting to marry soon? Understand the mystery, Women! Have you ever tried to solve a mystery? Well, think again, we are talking about women! Women are no less than a puzzle want to solve it? Easy solution, try to learn about them. As you will now know about her problems, responses and how you should react […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">Reliving Special Moments – Tips on Choosing the Right Wedding Photographer--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Your wedding photographer will basically act as your wedding journalist – writing the news and the story of your wedding day which will be published for your record and review for the rest of the years – so make sure you choose wisely! Your wedding day is a day you have been dreaming about since […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">For a Happy Start Enter your Marriage with These Positive Thinking Tips</h5>--}}
		{{--<div class="card-body">--}}
		{{--<img src="{{asset('blogs-images')}}/Happy-Marriage-Life-1.jpg" alt="" class="full-width">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Whether you are entering a love marriage or an arranged one, you cannot predict in its entirety as to how your life after marriage will be. Will your daily routines match with each other? Will your eating habits be complimentary with each other? Will they like how you dress? Will they be supportive of your […]--}}


		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">5 Homemade Beauty Masks Every Bride Must Try</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Every bride-to-be wishes to look absolutely stunning on her big day and for that, many brides undergo expensive beauty treatments to achieve the perfect pre-wedding glow. But what if we told you that the secret to spotless glowing skin lies in the simple ingredients present in your kitchen? Yes, you can get spotless glowing skin […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Is It The Time To Get Married?</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Nothing is more teasing than a relative or poking friend inquiring that when you will get married. Sometimes, it’s really difficult to realize that you are not sure about the time that you would be able to adjust to the changes that come with marriage. Surely, you should decide whether you’re ready to move on […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">Building Strong Relationship with Your Life Partner</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Building Strong Relationship with Your Life Partner How do you respond to a slight error of your life partner? How often do you feel worried when you have to solve a family issue? Do you get easily disappointed things don not happen according to your anticipation? If you will fail in controlling your sentiments, you […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">5 Tips For Properly Making Use Of A Matrimonial Website--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--There was a time when the ‘rishtay wali aunties’ use to find rishta for males and females in our Muslim society with their huge community network resources or the matrimonial section in the newspaper played an important role for rishtay. But in this internet-oriented age, these trends have been subsided greatly, as in today’s date, […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">Choose Your Wedding Color Scheme Wisely--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Wedding is the most precious and beautiful time for both men and women. It is a lifetime moment, which once experienced is then cherished and craved to be relived. Wedding planning involves catering countless matters and could fan numerous flaming issues. Starting from penning down the list of guest to finalizing the menu of the […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">Concept of Online Marriage in the Muslim World--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Every religion has different rituals and traditions regarding marriage that are accustomed to it, so it is Islam. Arranged marriages were the practice in Muslim tradition until only few years ago, which were distinguished as of great significance and respect, but this in many cases, left the frustration of perceiving the ideal life partner. Nowadays, […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}


		{{--<div class="card">--}}
		{{--<h5 class="card-header">5 Things to Ask for When Booking your Makeup Artist--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Choosing a make-up artist for your big day might be a tedious task. With the numerous options available and everyone promising the best services, it often gets difficult for the bride-to-be to find the best one in town.  Here are 5 things that you must look for before hiring your makeup artist in order to […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret to a Stunning DIY Bridal Makeup--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Whether you have got a flair for doing makeup or you are on a tight budget and wish to do your bridal makeup yourself, you have come to the right place. We have got some professional tips lined up for you that can make bridal makeup for marriage seem like a piece of cake. Blot […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret to Getting Slim & Fit before the Wedding--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--As the big shaadi day comes to a close, Pakistani brides-to-be start freaking out and go on crash diets. Crash diets can be very counterproductive because nutritional deprivations can lead to severe vitamin deficiencies, low blood sugar, dizziness and what not. But that does not mean you cannot lose a few extra pounds in a […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">How to Make Your Mehndi Function the Talk of the Town This Summer--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Any bride-to-be would want her pre-nuptial ceremonies to be celebrated in a grand and pompous manner. Out of all the pre marriage ceremonies, the Mehndi Ceremony has a charm of its own and is celebrated with much fanfare. It is believed that the Mehndi ceremony brings good luck and prosperity to the happy couple. This ceremony […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Points To Ponder When Searching For Your Pakistani Prince Charming--}}

		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Are you a young romantic looking for true love or are you searching for the man of your dreams to tie the knot with? This blog is dedicated to all the questions you should deliberate upon before saying ‘I do’. You may have to go through many heart breaks before you find the one you […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Shaadi Ka Ladu – Jo Khae Wo Bhi Pachtaye Jo Na Khae Wo Bhi Pachtaye--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Shaadi ka shauq to taqreeban sabko hi hota hai aur jo ye kehtay hain ke unhe ye shauq nahi unhe darasal ye shauq sabse ziada hota hai. Phele zamanay mai tou kaha jata tha ke larkian apni shaadi ka khuwaab bohat kam umar se hi dekhne lagti hain. Magar ajkal ka haal to ye hai […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Hilarious Things About Pakistani Weddings--}}

		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Ok so all that you must have heard about Pakistani yet, might be the extra spicy and tantalizing dishes that it’s famous for, its premium quality and extraordinary sports goods, or simply the daunting Taliban surrounding it. But let me tell you, that if you are unaware of the culture and tradition of a Pakistani marriage then […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret – Finding the Perfect Life Partner--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Whether you have gone through a heart crushing breakup and given up on love or you are a hopeless romantic person wandering aimlessly in the quest for true love, here are some pointers that indicate whether the one you wish for or the one you are dating is appropriate marriage material or not. After all, […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secrets – Things to Remember When Planning a Perfect Wedding--}}

		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--For a Pakistani bride, it is never too soon to start planning her big day. Sometimes even when you begin planning an event six months before the actual date, you feel that nothing is going your way and everything is not planned to the very last detail. Well, planning a shaadi is nothing less than an […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret Homemade Remedies for Glowing Skin--}}

		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Not all brides have enough time to spare at beauty salons for elaborate and expensive beauty treatments to look gorgeous on their big day. But every bride dreams of having that glowing skin that would turn heads. If your shaadi is right around the corner and you have got a restrained budget or you are a […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret to a Happily Ever After--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--As soon as the marriage and honeymoon phase is over and you get on with your hectic daily routines, couples tend to get a little cranky and outbursts are inevitable. But what about loving and caring for your significant other till death does your part? Go through some of these tips from a seasoned relationship […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret to a Successful Married Life--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--They say marriage needs a lot of work. Well, they are not wrong. When you get married, you have to dedicate the rest of your life to understanding each other. Here are some tips you might want to keep in mind to have a long lasting successful marriage. Trust is a Two Way Street There […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret to Selecting Saris according to Different Body Types--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--You can never go wrong with saris especially when you have just gotten married and you have to attend after shaadi functions almost every other day. Sari is probably one of the oldest and elegant looking outfits ever because it can make a woman look so graceful and yet stunning at the same time. If you […]--}}

		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">A Pakistani Bride’s Secret to Selecting Saris according to Different Body Types--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--You can never go wrong with saris especially when you have just gotten married and you have to attend after shaadi functions almost every other day. Sari is probably one of the oldest and elegant looking outfits ever because it can make a woman look so graceful and yet stunning at the same time. If you […]--}}


		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Guests You Should Never Invite To Your Pakistani Wedding--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Every bride wishes for a drama free marriage celebration with lots of guests but that becomes a far cry from the situation when you invite the wrong kind of people to your marriage celebrations that end up ruining your big day for you. Here is a list of the kind of people you should avoid inviting in […]--}}


		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">How to Plan a Low Budget Pakistani Style Bridal Shower--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Times have changed nowadays and men and women both have their 9-5 jobs to go to. Working brides-to-be are almost in a race against time and can barely spare a few hours to go on leisurely bridal trousseau hunting trips, last minute errands to the jewelry stores, salons, stylists and whatnot; seems like having a […]--}}


		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}

		{{--<div class="card">--}}
		{{--<h5 class="card-header">Rules Every Pakistani Bride Should Break--}}
		{{--</h5>--}}
		{{--<div class="card-body">--}}
		{{--<div>--}}
		{{--<p>--}}
		{{--Getting engaged is an overwhelming moment for every bride. As soon as you let your near and dear ones know that you are getting married, an avalanche of advices floods your mind and you feel like nothing is going your way. Well, rules are meant to be broken and these are some of the rules […]--}}


		{{--</p>--}}
		{{--</div>--}}
		{{--<br>--}}
		{{--<div class="col-12 text-center">--}}
		{{--<span class="ms-auto">--}}
		{{--<a class="btn btn-outline-primary" href="#" >Read More</a>--}}
		{{--</span>--}}
		{{--</div>--}}
		{{--</div>--}}
		{{--</div>--}}
	</div>
@endsection

@push('script')
	<script></script>
@endpush