@extends('front.layouts.master')
@section('title','Groom Guide')
@section('description', 'Our Trusted Matchmaking Services Can Assist You In Finding Qualified, Courteous And Caring Pakistani Grooms For Your Pakistani Daughters.')

@push('style')
	{{--Style--}}
@endpush

@section('content')

<main>
	<div class="container-xxl">
		<br>
        <h2 class="align-center font-weight-600"> Groom Guide </h2>
       	<img class="img-align-center heading-border" src="{{asset('home_page/heading-border.png')}}">

		<div class="row">
		    <div class="col-md-9">
		        <div class="card about-height-hero">
		            {{--<h5 class="card-header">Pakistan’s Most Trusted Matchmakers At Your Service</h5>--}}
		            <div class="card-body">
		                <p>Are you having a tough day as you’re searching for a Groom caption all day and still failed to find the perfect one? If this is the case then let us solve this problem. Above we’ve mentioned the beautiful Caption for your phenomenal pictures. Doosri Biwi helps people in finding a perfect match. For this purpose we have a 100% Free Online Matrimonial website Shaadi.org.pk based on purely eastern values. With hundreds of monthly satisfied customers, we are progressing through the heights of success and generating more happiness than anyone else in this industry. We are not a commercial marriage bureau which runs purely on profit. We are an organization and our motive is to help people. To achieve this purpose we are offering many free services to people such as this 100% Free Online Rishta Pakistani Website, free rishta meetings, free place for engagement, free place for nikkah, support for simple nikkah, etc. We only charge fee from those who want to hire us for personalized matchmaking in which our time and energy is spend to find a good match. This personalized matchmaking is a time taking process but it saves time of our client so we only charge fee for this service. </p>
		            </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		    <div class="col-md-3">
		        <div class="card about-height-hero">
		            <div class="card-body">
		                <img src="{{asset('customPages/normal/26697.png')}}" class="event-thumb" alt="">	
		            </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		</div>
		<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-body">

                        <h2>The Perfect&nbsp;Pakistani Groom</h2>

                        <p>Every woman wants her husband to be the best man on the planet. From looks&nbsp;and personality grace, soft-heartedness as well as graciousness as a king, they want their hubbies to be their savior knight! Although there is no harm in dreaming, but you have got to keep your expectations realistic. A good husband is skin deep. Where the macho who might be reciting poems for you may look handsome, the perfect man for you might be the one who is a bit older than you, more well established and soft spoken but very caring. There is a good man out there just for you! Here are some pointers on how to find a good&nbsp;<em><strong>Pakistani groom</strong></em>&nbsp;for marriage.</p>

                        <h2><strong>Characteristics of a Perfect Pakistani Groom</strong></h2>

                        <p>A good man is one who treats women respectfully, follows principles, shows kindness, care and someone who has integrity and knows what loyalty is. Money may come and go, a person’s face might change over time; but these are the qualities that he will possess for life. A good groom is one who knows how to give respect, is ready to take on responsibility and knows how to pamper you while keeping his savings for the future family.</p>

                        <p><strong>Does Salary Define the Individual?</strong></p>

                        <p>Many women feel that a perfect<em>&nbsp;<strong>Pakistani groom</strong></em>&nbsp;or potential husband is one who has a six-figure salary and killer looks. Whereas, there are many men out there who possess neither of these two qualities and yet they qualify as very good potential life partners. Salary as it is believed in the subcontinent is through the fate&nbsp;of a woman. Whereas, in a more rational world, salary is merely the product of a good opportunity and hard work.</p>

                        <p>You might be looking for a man with six-figure salary but are you ready to compromise on romantic night outs and daily entertainment. The man would be working so much that you would simply not get time for other fantasies. On the contrary, if you do not consider a low salary an issue, you should be ready to work side by side to pull your family weight; while you would have all the time in the world with your hubby and can acquire a perfect lifestyle.</p>

                        <p>Either the case, experienced people will tell you that nature of an individual has nothing to do with his pocket. So choose wisely and understand one another through our&nbsp;<em><strong>online rishtey</strong></em>&nbsp;chat portal before you come to a decision.</p>

                        <p><strong>Be Yourself at all Times</strong></p>

                        <p>When meeting someone for the very first time, it is natural that you would want to make a good first impression. Make a good impression but do not get carried away in the quest to be so perfect that you start acting as someone you are not.</p>

                        <p>That is the biggest mistake you can make because it indicates that you have a weak personality and you are not proud of who you are. Always remember honesty is the best policy. Stay true to your nature and do not hide your likes and dislikes; sometimes, mere differences can make the relationships grow apart. When you browse through a profile, make sure to read carefully the information before you contact the guy. Also, see if their family lifestyle suits yours before you make a choice. Marriage&nbsp;is not only honeymoon, it’s a complete life. So choose well.</p>

                        <p>Shaadi.org.pk&nbsp;<em><strong>matchmaking</strong></em>&nbsp;services offer to bring two people together who are similar and can prove to be a perfect match in life. You can become a member too and be entitled to a host of services to make this a more informed decision.</p>

                        <p><a href="{{route('search.by.slug',['male-rishta'])}}" target="_self"><em>&nbsp;</em>&nbsp; Find a Perfect Groom</a></p>
                    </div>
		        </div>
		        <!-- /.card-icon-component -->
		    </div>
		    <!-- /.col -->
		</div>
	</div>
</main>

@endsection

@push('script')

@endpush