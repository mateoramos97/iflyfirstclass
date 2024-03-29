<?php

/* @var $this yii\web\View */
/* @var $top_articles_in_list array */
/* @var $travel_tips array */
/* @var $reviews array */

use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\request\FlightRequestMax;

$this->title = $head_title;


$this->registerLinkTag(['rel' => 'preload', 'href' => '/public/img/home-banner.webp']);
$path_icons =  Url::base().'/design/icons/';
$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';
foreach ($random_cities as $city_item) {
	$this->registerLinkTag(['rel' => 'preload', 'href' => $path_img. Html::encode($city_item['image_alias'])]);
}
?>

<div class="welcome-block-wrapper home xl:mt-0 mt-20">
    <div class="back-slide">
		<div class="container mx-auto welcome-block container-wrapper grid grid-cols-11">
			<div class="content xl:flex hidden align-center pt-28 px-12 col-span-5">
				<div>
					<div class="title-form font-gilroy-semibold text-white 2xl:text-4.8xl xl:text-4xl md:text-xl">
						The lowest prices on <br> Business & First class <br> <span class="text-orange">Guaranteed</span>
					</div>
					<p class="font-gilroy-semibold text-lg text-hover">First and Business class flights</p>
					<div class="mt-10 pt-6 pl-4 pr-6 pb-4 bg-black-light w-fit rounded-tl-lg rounded-bl-3xl rounded-r-3xl border border-slate-500">
						<span class="text-white">Call US Now to Book Your Flight 🌴️</span>
						<div class="flex items-center mt-4">
							<img class="mr-3" src="/public/img/phone-with-bg.png" alt="phone" width="40" height="40">
							<a href="tel:+18883477817">
								<span class="text-orange text-lg mr-2 font-semibold">+1</span> <span class="text-white text-lg font-semibold">888 347 7817</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="form-block-wrapper xl:p-12 p-6 xl:col-span-6 col-span-11">
				<?= FlightRequestMax::widget() ?>
			</div>
		</div>
    </div>
</div>
<div class="page-content mt-16">
    <div class="container mx-auto xl:px-16 px-4 recently-flights-wrapper">
        <div class="head-block flex justify-between items-center">
            <div class="flex flex-align-center"><h4 class="font-gilroy-semibold text-black">Best Deals</h4></div>
            <div class="flex">
                <div class="shopper-approved xl:flex items-center hidden">
                    <a class="flex" href="https://www.shopperapproved.com/reviews/iflyfirstclass.com" target="_blank">
                        <img src="/public/img/shopper-approved.svg" alt="shopper-approved-icon" width="203" height="32">
                        <img class="ml-6" src="/public/img/stars.svg" alt="stars-icon" width="45" height="20">
                    </a>
                </div>
                <div class="border-r border-gray-light h-10 mx-10 xl:block hidden"></div>
				<div class="flex xl:gap-10 gap-4 items-center xl:scale-100 scale-85">
					<img src="/public/img/bbb.svg" width="32" height="48" alt="bbb">
					<img src="/public/img/asta.svg" width="41" height="42" alt="astra">
					<img src="/public/img/db.svg" width="62" height="32" alt="db">
				</div>
            </div>
        </div>
        <div class="cities-block mt-4 grid lg:grid-cols-4 grid-cols-2 gap-6">
            <!-- Images Start -->
            <?php foreach($random_cities as $city_item): ?>
                <div class="item">
                    <a href="<?= Url::to(['city/index', 'alias' => $city_item['alias']]); ?>">
                        <div class="city-item mt-4">
							<div class="rounded-lg w-full pt-[100%] transition-all duration-1000 bg-100 hover:bg-110 bg-center "
								 style="background-image: url(<?= $path_img. Html::encode($city_item['image_alias']) ?>)">
							</div>
                            <div class="body box-border mt-5">
                                <div class="flex justify-between item-center">
                                    <h5 class="title text-xl">
                                        <?= Html::encode($city_item['name']) ?>
                                    </h5>
                                    <div class="rating flex">
                                        <img src="/public/img/stars.svg" class="star" alt="star-icon" width="44" height="19">
                                    </div>
                                </div>
                                <div class="cabin-class text-sm mt-2">
                                    Round trip / Business class
                                </div>
                                <div class="price-block flex items-center mt-3">
                                    <h5 class="text-black new-price text-xl">
                                        $<?= Html::encode($city_item['business_class_price']) ?>
                                    </h5>
                                    <div class="ml-3 text-sm line-through old-price">
                                        $<?= Html::encode($city_item['business_class_old_price']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <!-- Images End -->
        </div>
		<div class="mt-10 text-center">
			<a href="/" class="mx-auto show-more-btn show-more-deals">
				<i class="icon-download"></i>
				<p class="font-semibold grow px-5">Show More Deals</p>
			</a>
		</div>
    </div>
    <div class="container mx-auto xl:px-16 px-2 mt-12 dealth-block-wrapper box-border">
        <div class="dealth-block-inner grid xl:grid-cols-2 grid-cols-1 gap-2">
			<div class="relative video-container rounded-l-3xl rounded-r-3xl xl:rounded-r-lg flex items-center justify-center">
				<img src="/public/img/play-btn.png" class="play-btn cursor-pointer">
			</div>
			<div class="bg-brown-light flex flex-col rounded-r-3xl rounded-l-3xl xl:rounded-l-lg xl:pt-22 xl:py-[105px] py-14 xl:px-16 px-6 shadow-md xl:mt-0 -mt-12">
                <div class="font-gilroy-semibold text-brown text-center xl:text-left">Top Rated Luxury Travel Agency</div>
                <h3 class="xl:mt-4 mt-3 text-center xl:text-left">
                    Enjoy our Great Deals <br> on First & Business class
                </h3>
                <div class="description grid xl:grid-cols-2 grid-cols-1 gap-10 xl:mt-10 mt-6">
					<p>I Fly First Class is your personal travel concierge. We're at your service 24/7 to meet all your travel needs. Our professional staff is dedicated to saving you time and money. </p>
					<p class="xl:block hidden">We'll sort out even the most complex travel itineraries in minutes, getting you the best but least costly business class airfares. Our business flight booking division is always at your service! </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto xl:px-16 px-4 book-with-confidence box-border mt-24">
        <div class="book-with-confidence-inner container-wrapper">
			<p class="text-center">Performance and entertainment</p>
            <h2 class="font-silk-serif-bold text-center mt-5">
                Book With Confidence
            </h2>
			<div class="grid lg:grid-cols-3 grid-cols-1 gap-6 mt-12">
				<div class="item pb-10 bg-secondary rounded-3xl lg:text-left text-center">
					<div class="p-6 flex xl:justify-between justify-center">
						<div class="w-[56px] h-[56px] bg-white flex items-center justify-center rounded-xl p-[10px]">
							<img src="/public/img/gold-pig.svg" alt="gold-pig-icon" width="52" height="48">
						</div>
					</div>
					<div class="px-8">
						<h6>
							Unpublished Fares
						</h6>
						<div class="mt-4 text-sm leading-6">
							We offer discounted unpublished fares for First and Business Class Travel.
						</div>
					</div>
				</div>
				<div class="item pb-10 bg-secondary rounded-3xl lg:text-left text-center">
					<div class="p-6 flex xl:justify-between justify-center">
						<div class="w-[56px] h-[56px] bg-white flex items-center justify-center rounded-xl p-[10px]">
							<img src="/public/img/team-gold.svg" alt="gold-team-icon" width="55" height="44">
						</div>
					</div>
					<div class="px-8">
						<h6>
							Expert Travel Team
						</h6>
						<div class="mt-4 text-sm leading-6">
							Our Experts are ready to help you with any travel plans.
						</div>
					</div>
				</div>
				<div class="item pb-10 bg-secondary rounded-3xl lg:text-left text-center">
					<div class="p-6 flex xl:justify-between justify-center">
						<div class="w-[56px] h-[56px] bg-white flex items-center justify-center rounded-xl p-[10px]">
							<img src="/public/img/support-gold.svg" alt="gold-support-icon" width="51" height="46">
						</div>
					</div>
					<div class="px-8">
						<h6>
							24/7 Customer Suport
						</h6>
						<div class="mt-4 text-sm leading-6">
							Your personal travel councierge available to assist you 24/7 with any travel needs.
						</div>
					</div>
				</div>
				<div class="item pb-10 bg-secondary rounded-3xl lg:text-left text-center">
					<div class="p-6 flex xl:justify-between justify-center">
						<div class="w-[56px] h-[56px] bg-white flex items-center justify-center rounded-xl p-[10px]">
							<img src="/public/img/security-gold.svg" alt="gold-security-icon" width="44" height="50">
						</div>
					</div>
					<div class="px-8">
						<h6>Credibility & Reliability</h6>
						<div class="mt-4 text-sm leading-6">
							More then 10 years on the luxury travel market, member of Asta, Nacta, California Seller of Travel and BBB accredited.
						</div>
					</div>
				</div>
				<div class="item pb-10 bg-secondary rounded-3xl lg:text-left text-center">
					<div class="p-6 flex xl:justify-between justify-center">
						<div class="w-[56px] h-[56px] bg-white flex items-center justify-center rounded-xl p-[10px]">
							<img src="/public/img/flight-gold.svg" alt="gold-flight-icon" width="51" height="44">
						</div>
					</div>
					<div class="px-8">
						<h6>
							Travel protection & flexibility
						</h6>
						<div class="mt-4 text-sm leading-6">
							Our tickets offer a Trip Protection to protect your travel investment and come with the most flexible fare rules.
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	<div class="container mx-auto xl:px-16 px-4 book-with-confidence box-border xl:mt-24 mt-20">
		<h3 class="font-silk-serif-bold text-center mt-5">
			As seen on
		</h3>
		<div class="grid xl:grid-cols-6 grid-cols-2 gap-6 mt-8">
			<img class="block m-auto" src="/public/img/cnn.svg" alt="cnn-img" width="169" height="112">
			<img class="block m-auto" src="/public/img/cbsnews.svg" alt="cbsnews-img" width="151" height="120">
			<img class="block m-auto" src="/public/img/fox.svg" alt="fox-img" width="168" height="106">
			<img class="block m-auto" src="/public/img/nbc.svg" alt="nbc-img" width="120" height="120">
			<img class="block m-auto" src="/public/img/san-francisco-cr.svg" alt="san-francisco-cr-img" width="208" height="117">
			<img class="block m-auto" src="/public/img/y.svg" alt="y-img" width="141" height="112">
		</div>
	</div>
    <div class="news-block-wrapper bg-secondary xl:mt-22 mt-20">
        <div class="news-inner">
			<h2 class="font-silk-serif-bold text-center pt-20 xl:pb-20 py-14">
				Travel <span class="xl:inline-block hidden">& Flight</span> <span class="text-brown">News</span>
			</h2>
			<div class="news-block pb-20 px-0">
                <div class="rows swiper">
					<div class="swiper-wrapper">
						<?php foreach($top_articles_in_list as $item): ?>
							<div class="swiper-slide">
								<?php if(isset($item['posted'])): ?>
									<div class="grid grid-cols-7 gap-2 h-full">
										<div class="p-10 bg-black-light-2 rounded-l-3xl rounded-r-lg col-span-4">
											<p class="font-gilroy-semibold text-gold-gradient border-b border-gold-gradient w-fit">Business</p>
											<a class="font-gilroy-semibold xl:text-3xl text-2xl text-white block mt-12" href="<?= Url::to(['blog/index', 'alias' => $item['alias']]); ?>">
												<?= Html::encode($item['title']) ?>
											</a>
											<p class="text-white mt-8"><?= substr(Html::encode($item['summary']), 0, 150) ?>...</p>
										</div>
										<div class="col-span-3 h-full bg-cover bg-center rounded-r-3xl rounded-l-lg" style="background-image: url(<?= $path_img_thumbs. Html::encode($item['image_alias']) ?>)">
										</div>
									</div>
								<?php else: ?>
									<div class="grid grid-cols-7 gap-2 h-full">
										<div class="p-10 bg-brown-light-2 rounded-l-3xl rounded-r-lg col-span-4">
											<p class="font-gilroy-semibold text-gold-gradient-2 border-b border-gold-gradient-2 w-fit">Travel</p>
											<a class="font-gilroy-semibold xl:text-3xl text-2xl text-primary block mt-12" href="<?= Url::to(['blog/index', 'alias' => $item['alias']]); ?>">
												<?= Html::encode($item['title']) ?>
											</a>
											<p class="text-primary mt-8"><?= substr(Html::encode($item['summary']), 0, 150) ?>...</p>
										</div>
										<div class="col-span-3 h-full bg-cover bg-center rounded-r-3xl rounded-l-lg" style="background-image: url(<?= $path_img_thumbs. Html::encode($item['image_alias']) ?>)">
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-scrollbar"></div>
                </div>
            </div>
        </div>
		<div class="mx-auto px-4 box-border pt-6 pb-[40px]">
			<div>
				<p class="text-center">Customer Reviews</p>
				<h2 class="font-silk-serif-bold text-center mt-5">
					Reviews our Clients
				</h2>
				<a class="flex mt-8 items-center justify-center" href="http://www.shopperapproved.com/reviews/iflyfirstclass.com/" target="_blank" rel="nofollow">
					<img class="block" src="/public/img/shopper-star.svg" alt="see-on-shopper-approved-img" width="28" height="28">
					<span class="text-orange font-proxima-nova-medium ml-2 text-base-2 pt-1 hover:underline">See on ShopperApproved</span>
				</a>
			</div>
			<div class="mt-[72px] reviews-wrapper">
				<div class="flex flex-wrap gap-5 justify-center">
				<?php foreach($reviews as $index => $review): ?>
					<div class="bg-white rounded-xl p-8 flex flex-col justify-between max-w-[464px] h-[324px]">
						<div>
							<div class="flex items-center">
								<div class="w-12 h-12 rounded-full flex justify-center items-center" style="background-color:<?= $review['initials-color'] ?>">
									<p class="text-white text-lg font-bold"><?= $review['initials'] ?></p>
								</div>
								<div class="ml-5">
									<h6><?= $review['author'] ?></h6>
									<span class="mt-2 text-sm"><?= $review['address'] ?></span>
								</div>
							</div>
							<div class="mt-8 mb-4">
								<?= substr($review['body'], 0, 300) ?><?= strlen($review['body']) > 300 ? '...' : '' ?>
							</div>
						</div>
						<div class="flex justify-between items-center">
							<img src="/public/img/shopper-approved.svg" alt="shopper-approved-img" width="205" height="32">
							<img src="/public/img/stars.svg" alt="stars-img" width="50" height="20">
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
			<div class="mt-[48px] text-center">
				<div class="mx-auto show-more-btn show-more-reviews" id="show-more-reviews" onclick="readMoreReviews()">
					<i class="icon-download"></i>
					<p class="font-semibold grow px-5">Show More Reviews</p>
				</div>
			</div>
		</div>
    </div>
	<div class="container mx-auto xl:px-16 px-4 box-border xl:mt-[128px] mt-20">
		<p class="text-center">Top Airlines</p>
		<h3 class="font-silk-serif-bold text-center mt-5">
			We work with All major Airlines
		</h3>
		<div class="grid xl:grid-cols-9 grid-cols-2 gap-y-12 gap-x-6 mt-[86px] pb-[80px] border-b border-gray-light">
			<img class="block mr-auto my-auto col-span-1" src="/public/img/emirates.svg" alt="emirates-img"  width="106" height="72">
			<img class="block m-auto xl:col-span-2 col-span-1" src="/public/img/british-airways.svg" alt="british-airways-img"  width="235" height="36">
			<img class="block m-auto xl:col-span-2 col-span-1" src="/public/img/delta.svg" alt="delta-img"  width="183" height="28">
			<img class="block m-auto xl:col-span-2 col-span-1" src="/public/img/cathay-pacific.svg" alt="cathay-pacific-img"  width="259" height="36">
			<img class="block ml-auto my-auto xl:col-span-2 col-span-1" src="/public/img/lufthansa.svg" alt="lufthansa-img"  width="217" height="38">
		</div>
	</div>
    <div class="container mx-auto xl:px-16 px-6 box-border xl:mt-24 mt-20 pb-24">
		<div class="title">
			<h5>Our Philosophy</h5>
		</div>
		<div class="grid xl:grid-cols-2 grid-cols-1 text-sm text-gray xl:gap-20 gap-10 mt-10">
			<div class="text-justify">
				<p>
					Flying across the world comfortably and economically takes some effort, especially if you want to enjoy the flight amid the luxury of first or business class cabins. With IFlyFirstClass, you can forget those endless, confusing internet searches for the cheapest business and first class flights. IFFC specializes in unearthing the very lowest prices available on international airfare on all the top-rated airlines. The result is a hassle-free travel experience that offers you excellent savings, premium airfare and outstanding service.
				</p>
				<p>
					Plenty of discounted business class tickets are out there, and IFFC travel experts know all the hidden places to find those deals. With the savings offered by IFFC discounts, international business class seats are accessible to all people, not just elite or affluent travelers. Many of the world’s best air carriers also offer astonishingly cheap first class tickets. These special, discounted first and business class tickets give nearly everyone a chance to enjoy the ease and comfort of premium travel. While you could spend hours searching for these deals yourself, IFFC experts find them in mere minutes. We’ll also give provide you with several premium flight deals. This variety of flight deals gives you the freedom to choose the most convenient, affordable option for your trip without sacrificing your comfort or your budget.
				</p>
				<h6 class="mb-6 mt-8">The Low-Down on First, Business and Economy Class Seats</h6>
				<p>
					In domestic and international travel, the differences between first and business class are wide-ranging. While the assumption is often that first class is always far more luxurious than business class, that’s not always the case. In fact, on routes where first class is not offered, business class seats often rival first class accommodations. Still, where both options are available, first class is usually significantly more opulent than business class. First class seats are generally more spacious and they usually recline to a fully flat position. First class fliers also often enjoy more deluxe meals, complimentary cocktails, more personalized in-flight service and better amenities. Services at first class airport lounges are generally more elaborate than business class lounge amenities as well.
				</p>
				<p>
					On lengthy international flights, the differences between first and business classes are even more marked. Most first class cabins now feature lie-flat seats with bed turndown service and greater privacy; some even offer completely private first class suites. IFlyFirstClass gives you entree to all the best business and first class deals to popular Asian routes, including China, Hong Kong, Malaysia, Singapore, Taiwan, Thailand, South Korea and Japan. Our deals also include routes to Australian cities such as Melbourne, Sydney and Brisbane and New Zealand destinations like Auckland and Wellington. Of course, IFFC is also the specialist on cheap first class and business class deals to European routes, including the U.K., France, Germany, Switzerland, Belgium and the Netherlands as well as Middle Eastern destinations like Dubai and Abu Dhabi.
				</p>
			</div>
			<div class="">
				<p>
					The most notable differences in flight classes are found between coach and business class seating, where the disparities are large. As a business class traveler, you enjoy a variety of amenities that will make your journey pleasurable, beginning with extra-wide seats and extended leg room. The in-flight service in business class cabins is attentive and designed to give you the most comfortable flight possible. That comfort usually includes more private seating, extra storage space, an extensive culinary menu, a large selection of beverages and cocktails and access to additional data and electrical ports. The business class entertainment offerings often include a wide variety of movies, music and games so you can enjoy a little downtime during your flight.
				</p>
				<p>
					In contrast to business class seats, economy seats are often smaller and much less private, frequently requiring extra fees for additional legroom, checked baggage, cocktails, meals and entertainment. Business class fliers often have access to well-appointed airport lounges and expedited security checkpoints, while economy class travelers must contend with lengthy checkpoint lines and overcrowded public waiting rooms.
				</p>
				<p>
					Wherever and whenever you need to travel, IFFC is here to provide the cheapest luxury flights available. Customer service is our ultimate goal so we offer you discounted first and business class tickets on convenient routes operated by the most dependable airlines. This ensures that you have a travel experience that is comfortable, reliable and filled with the industry’s most hospitable services.
				</p>
				<h6 class="mb-6 mt-8">Last Minute Luxury for Less</h6>
				<p>
					Our IFFC expert services are also available for last minute flights, giving you peace of mind that you can fly safely and comfortably, even if your travel arises unexpectedly. Whether you need to travel to deal with a sudden business issue or just want to take an impromptu holiday, we can find cheap business class deals to Europe, Asia, Africa and Oceania at a moment’s notice. This ensures that you won’t fall prey to the usual last minute flight charges and price increases.
				</p>
				<h6 class="mb-6 mt-8">Getting First Class and Business Class Flight Deals</h6>
				<p>
					Accessing our deals is easy. Simply go to our website, type in your travel dates and destination, and we will provide you a quick, free quote.
				</p>
			</div>
		</div>
    </div>
	<div class="wave"></div>
	<div class="container mx-auto xl:px-16 px-4 box-border xl:mt-24 mt-20 pb-24">
		<?= $this->render('_landing-block', [
				'countries' => $countries,
				'cities' => $cities,
				'airlines' => $airlines,
		]) ?>
	</div>

</div>