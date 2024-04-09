<?php
use yii\helpers\Url;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/about-top.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);
$this->registerLinkTag(['rel' => 'preload', 'href' =>  Url::base(true) . '/design/photo/about-top.jpg' ]);

$this->params['breadcrumbs'][] = 'About Us';

?>
<div class="welcome-block-wrapper contact-us xl:mt-0 mt-20">
    <div class="back-slide">
		<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
		<div class="container mx-auto welcome-block container-wrapper flex flex-col items-center">
			<div class="content flex flex-col items-center pb-20 pt-16 xl:px-24 px-6">
				<p class="px-6 py-3 text-lg bg-black rounded-tl-3xl rounded-bl-lg rounded-r-3xl text-white font-semibold">Contact Us</p>
				<h1 class="text-white text-center xl:text-5xl lg:text-4xl text-3xl mt-4 leading-10 px-10">
					We welcome all comments, <br> suggestions, and indeed all feedback from our customers and visitors.
				</h1>
			</div>
		</div>
		<?= $this->render('@app/views/layouts/_support-chat') ?>
    </div>
</div>
<div class="container mx-auto mt-20 mb-10 xl:px-12 p-4">
    <h2 class="text-center"> For General Questions,<br> Comments & Suggestions please</h2>
	<p class="text-center text-mute my-10">Simply email or call us and we will be happy to respond to any questions you may have or consider <br> any suggestions you would like to make.</p>
	<div class="contacts border border-gray-light-2 xl:p-10 p-4 grid grid-cols-12 rounded-3xl" itemscope="" itemtype="http://schema.org/Organization">
		<div class="xl:col-span-5 col-span-12 xl:pr-20">
			<div class="flex items-center">
				<i class="icon-phone-fill min-w-10 min-h-10 rounded-xl text-brown-2 bg-secondary flex items-center justify-center text-sm"></i>
				<p class="ml-3 flex justify-between items-end dotted-separator grow">
					<span class="text-brown-2 text-base-2">Call Us Now</span>
					<span itemprop="telephone" class="telephone text-lg font-gilroy-semibold">1 888 347 7817</span>
				</p>
			</div>
			<div class="mt-6 flex items-center">
				<i class="icon-mail-fill min-w-10 min-h-10 rounded-xl text-brown-2 bg-secondary flex items-center justify-center before:!ml-0 text-sm"></i>
				<p class="ml-3 flex justify-between items-end dotted-separator grow">
					<span class="text-brown-2 text-base-2">Our Email</span>
					<span itemprop="email" class="email text-base-2 font-gilroy-semibold">info@flyfirst.com</span>
				</p>
			</div>
		</div>
		<div class="xl:col-span-7 col-span-12 xl:mt-0 mt-6">
			<div class="flex items-center">
				<i class="icon-location-fill min-w-10 min-h-10 rounded-xl text-brown-2 bg-secondary flex items-center justify-center text-sm"></i>
				<p class="ml-3 flex justify-between items-end dotted-separator grow" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
					<span class="text-brown-2 text-base-2">Our Mailing Address</span>
					<span class="text-base-2 font-gilroy-semibold text-end"><span itemprop="streetAddress">980 N Michigan Ave, #1587 </span> <span itemprop="addressLocality">Chicago, IL,</span> <span itemprop="postalCode">60611</span></span>
				</p>
			</div>
			<div class="mt-6 flex items-center">
				<i class="icon-person-fill min-w-10 min-h-10 rounded-xl text-brown-2 bg-secondary flex items-center justify-center text-sm"></i>
				<p class="ml-3 flex justify-between items-end dotted-separator grow">
					<span class="text-brown-2 text-base-2">For Media Inquiries</span>
					<span class="text-base-2 font-gilroy-semibold text-end">Alexa Helms, Alexa@stormpr.com</span>
				</p>
			</div>
		</div>
	</div>
	<p class="text-center text-mute mt-10">Many of the changes and additions on here have been as a result of feedback from our customers and visitors and we appreciate the time taken to contact us.</p>
</div>
<div class="xl:p-14 p-4 bg-gray-gradient mb-20">
	<div class="container mx-auto grid xl:grid-cols-2 grid-cols-1 items-center">
		<div>
			<img src="/public/img/about-us-first-img.png" alt="image" width="748" height="748">
		</div>
		<div class="xl:pl-24 xl:mt-0 mt-10">
<!--			<h4 class="xl:text-4xl">Some kind of title for this section</h4>-->
			<p class="text-gray mt-8">
				Business and First class flights can be notoriously expensive, but with I Fly First Class, that's never a problem. Use our flight consolidator database to find reduced-fare flights for corporate business travel, and you'll save up to 60% over conventional published corporate airfares! With our business class international flights, you'll enjoy all the comforts of pricey premium air travel, but you won't pay an arm and a leg for it.
			</p>
			<p class="text-gray mt-4">
				Discounted business and first class seats are available for all international and domestic US destinations. Find low-cost business class airfares on all major US and international airlines.
			</p>
		</div>
	</div>
	<div class="container mx-auto grid xl:grid-cols-2 grid-cols-1 items-center justify-items-end mt-12">
		<div class="xl:pr-24">
<!--			<h4 class="xl:text-4xl">Some kind of title for this section.</h4>-->
			<p class="text-gray mt-8">
				Get access to affordable business class tickets for round-trip, one-way, round-the-world, even complex itineraries. Seats can be preassigned, and many tickets are changeable and refundable, although certain restrictions may apply.
			</p>
			<p class="text-gray mt-4">
				I Fly First Class is your personal travel concierge. We're at your service 24/7 to meet all your travel needs. Our professional staff is dedicated to saving you time and money. We'll sort out even the most complex travel itineraries in minutes, getting you the best but least costly business class airfares. Our business flight booking division is always at your service!
			</p>
		</div>
		<div class="xl:mt-0 mt-10">
			<img src="/public/img/about-us-second-img.png" alt="image" width="748" height="748">
		</div>
	</div>
</div>