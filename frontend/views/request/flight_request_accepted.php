<?php

use yii\helpers\Html;
use app\components\AppConfig;
use yii\helpers\Url;

$path_icons = Url::base() . '/design/icons/';
$path_img = Url::base() . '/public/images/';
$path_img_thumbs = Url::base() . '/public/images/thumbs/';

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

function getAirportCode($airportInfo) {
	return preg_replace('/^\(([A-Z]{3,5})\)\s(.*)/', '$1', $airportInfo);
}

?>

<div class="welcome-block-wrapper relative flight-request-accepted-page xl:mt-0 mt-20">
    <div class="back-slide">
		<div class="container mx-auto  welcome-block container-wrapper">
			<div class="tickets-holder-wrapper relative flex items-center justify-center">
				<div class="tickets-holder-inner box-border">
					<div class="header ticket-grid box-border">
						<div class="flex items-center xl:pl-8 flex-wrap justify-center xl:justify-start">
							<img src="/public/img/flight-gold.svg" alt="gold-flight-icon" width="40" height="28">
							<span class="text-white font-proxima-nova-medium text-xl ml-5">Reference number</span>
							<span class="num ml-4 text-gold-gradient font-gilroy-semibold text-2xl">IFFCN-<?= Html::encode($request_form_users['request_number']) ?></span>
						</div>
						<div class="ticket-separator-line">
							<div class="text-white xl:pl-10 pt-4 xl:pt-0 flex items-center h-full font-proxima-nova-light justify-center xl:justify-start">iflyfirstclass.com</div>
						</div>
					</div>
					<div class="content ticket-grid box-border person-info">
						<div class="column-1">
							<div class="top-info flex justify-between items-center flex-col xl:flex-row">
								<div>
									<div class="name-passenger">
										<?= Html::encode($request_form_users['name']) ?>
									</div>
									<div class="people-number">
										<?= Html::encode($request_form_users['people_number']) ?> Person(s)
									</div>
								</div>
								<div class="phone-wrapper mt-4 xl:mt-0">
									<div class="phone flex items-center">
										<i class="icon-phone-fill"></i>
										<span itemprop="telephone" class="text-xl pl-5">888 347 7817</span>
									</div>
								</div>
							</div>
						</div>
						<div class="column-2 ticket-separator-line mx-auto xl:m-0">
							<div class="cabin-holder">
								<div class="ttl font-proxima-nova-medium ">Cabin class</div>
								<div class="cabin font-proxima-nova-semibold">
									<i class="icon-business"></i>
									<?php echo $request_form_users['cabin_class_name'] == '1' ? 'Business' : 'First' ?>
								</div>
							</div>
						</div>
					</div>
					<div class="content ticket-grid box-border flight-info">
						<div class="column-1">
							<div class="airport-info">
								<?php if ($request_form_users['type_trip'] == AppConfig::Type_Trip_Multi_City): ?>
									<?php foreach ($request_form_user_info as $key => $item): ?>
										<div class="from-to flex justify-between items-center pt-5 dotted-separator">
											<span class="from airport-code"><?= getAirportCode($item['from_air']) ?></span>
											<div class="icon-airplane"></div>
											<span class="to airport-code"><?= getAirportCode($item['from_air']) ?></span>
										</div>
										<div class="from-to flex justify-between mt-6">
											<span class="from">
												<span class="detail">
													<?= Html::encode($item['from_air']) ?>
												</span>
											</span>
											<span class="to">
												<span class="detail">
													<?= Html::encode($item['from_air']) ?>
												</span>
											</span>
										</div>
									<?php endforeach; ?>
								<?php else: ?>
									<div class="from-to flex justify-between items-center pt-5 dotted-separator flex-col xl:flex-row">
										<span class="from airport-code"><?= getAirportCode($request_form_user_info[0]['from_air']) ?></span>
										<div class="icon-airplane"></div>
										<span class="to airport-code"><?= getAirportCode($request_form_user_info[0]['to_air']) ?></span>
									</div>
									<div class="from-to flex justify-between mt-6">
										<span class="from">
											<span class="detail">
												<?= Html::encode($request_form_user_info[0]['from_air']) ?>
											</span>
										</span>
										<span class="to">
											<span class="detail">
												<?= Html::encode($request_form_user_info[0]['to_air']) ?>
											</span>
                                		</span>
									</div>
								<?php endif; ?>
							</div>
							<div class="ticket-info">
								<p>Our Luxury Travel Specialists will process your request and contact you as soon as possible</p>
							</div>
						</div>
						<div class="column-2 ticket-separator-line mx-auto xl:m-0">
							<?php if ($request_form_users['type_trip'] == AppConfig::Type_Trip_Multi_City): ?>
								<?php foreach ($request_form_user_info as $key => $item): ?>
									<div class="date-holder">
										<div class="ttl">Depart Date</div>
										<div class="date from"><?= Html::encode($item['departure']) ?></div>
									</div>
								<?php endforeach; ?>
							<?php else: ?>
								<div class="date-holder">
									<div class="ttl">Depart Date</div>
									<div class="date from"><?= Html::encode($request_form_user_info[0]['departure']) ?></div>
								</div>
							<?php endif; ?>
							<?php if ($request_form_user_info[0]['arrival']): ?>
								<div class="date-holder">
									<div class="ttl">Return Date</div>
									<div class="date to"><?= Html::encode($request_form_user_info[0]['arrival']) ?></div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="container mx-auto xl:px-16 px-4 recently-flights-wrapper mt-16 pb-24">
	<div class="head-block flex justify-between items-center">
		<div class="flex flex-align-center"><h4 class="font-gilroy-semibold text-black">Recently Flights</h4></div>
		<div class="flex">
			<div class="shopper-approved xl:flex items-center hidden">
				<a class="flex" href="https://www.shopperapproved.com/reviews/iflyfirstclass.com" target="_blank">
					<img src="/public/img/shopper-approved.svg" alt="shopper-approved-icon" width="203" height="32">
					<img class="ml-6" src="/public/img/stars.svg" alt="stars-icon" width="45" height="20">
				</a>
			</div>
		</div>
	</div>
	<div class="cities-block mt-8 grid lg:grid-cols-4 grid-cols-2 gap-6">
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
	</div>
</div>
<div class="wave"></div>
<div class="container mx-auto xl:px-16 px-4 box-border xl:mt-24 mt-20 pb-24">
	<?= $this->render('@app/views/site/_landing-block', [
			'countries' => $countries,
			'cities' => $cities,
			'airlines' => $airlines,
	]) ?>
</div>
