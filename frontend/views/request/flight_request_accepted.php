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

?>

<div class="container mx-auto welcome-block-wrapper relative home xl:mt-0 mt-20">
    <div class="back-slide">
		<div class="welcome-block container-wrapper">
			<div class="tickets-holder-wrapper relative flex items-center justify-center">
				<div class="tickets-holder-inner box-border">
					<div class="header ticket-grid box-border">
						<div class="site flex items-center">www.iflyfirstclass.com</div>
						<div class="ticket-number ticket-separator-line">
							<div>Reference number</div>
							<div class="num">IFFCN-<?= Html::encode($request_form_users['request_number']) ?></div>
						</div>
					</div>
					<div class="content ticket-grid box-border">
						<div class="column-1">
							<div class="top-info flex justify-between">

								<div>
									<div class="name-passenger">
										<?= Html::encode($request_form_users['name']) ?>
									</div>
									<div class="people-number">
										<?= Html::encode($request_form_users['people_number']) ?> Person(s)
									</div>
								</div>

								<div class="phone-wrapper">
									<div class="phone flex items-center">
										<div class="icon-phone"></div>
										<span class="title">Call for an exclusive deals!&nbsp;</span>
										<span itemprop="telephone">1 888 347 7817</span>
									</div>
								</div>

							</div>

							<?php if ($request_form_users['type_trip'] == AppConfig::Type_Trip_Multi_City) { ?>
								<?php foreach ($request_form_user_info as $key => $item): ?>
									<div class="from-to flex justify-between items-center">
                                <span class="from">
                                    <span class="detail">
                                        <?= Html::encode($item['from_air']) ?>
                                    </span>
                                </span>
										<div class="icon"></div>
										<span class="to">
                                    <span class="detail">
                                        <?= Html::encode($item['to_air']) ?>
                                    </span>
                                </span>
									</div>
								<?php endforeach; ?>
							<?php } else { ?>
								<div class="from-to flex justify-between items-center">
                                <span class="from">
                                    <span class="detail">
                                        <?= Html::encode($request_form_user_info[0]['from_air']) ?>
                                    </span>
                                </span>
									<div class="icon"></div>
									<span class="to">
                                    <span class="detail">
                                        <?= Html::encode($request_form_user_info[0]['to_air']) ?>
                                    </span>
                                </span>
								</div>
							<?php } ?>
							<div class="ticket-info">
								Our Luxury Travel Specialists will process your request and contact you as soon as possible <br>
								or you can call us at <span>888 347 7817</span>
							</div>
						</div>
						<div class="column-2 ticket-separator-line">
							<div class="cabin-holder">
								<div class="ttl">Cabin class</div>
								<div class="cabin">
									<?php echo $request_form_users['cabin_class_name'] == '1' ? 'Business' : 'First' ?>
								</div>
							</div>
							<?php if ($request_form_users['type_trip'] == AppConfig::Type_Trip_Multi_City) { ?>
								<?php foreach ($request_form_user_info as $key => $item): ?>
									<div class="date-holder">
										<div class="ttl">Depart Date</div>
										<div class="date"><?= Html::encode($item['departure']) ?></div>
									</div>
								<?php endforeach; ?>
							<?php } else { ?>
								<div class="date-holder">
									<div class="ttl">Depart Date</div>
									<div class="date"><?= Html::encode($request_form_user_info[0]['departure']) ?></div>
								</div>
							<?php } ?>
							<?php if ($request_form_user_info[0]['arrival']) { ?>
								<div class="date-holder">
									<div class="ttl">Return Date</div>
									<div class="date"><?= Html::encode($request_form_user_info[0]['arrival']) ?></div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="tickets-holder-inner-mobile">
					<div class="header flex justify-center box-border">
						<div class="site flex items-center">www.iflyfirstclass.com</div>
					</div>
					<div class="content">
						<div class="column-1 box-border">
							<div class="name-passenger">
								<?= Html::encode($request_form_users['name']) ?>
							</div>
							<div class="people-number">
								<?= Html::encode($request_form_users['people_number']) ?> Person(s)
							</div>

							<?php if ($request_form_users['type_trip'] == AppConfig::Type_Trip_Multi_City) { ?>
								<?php foreach ($request_form_user_info as $key => $item): ?>
									<div class="from-to">
										<div class="from">
                                    <span class="detail">
                                        <?= Html::encode($item['from_air']) ?>
                                    </span>
										</div>
										<div class="icon"></div>
										<div class="to">
                                    <span class="detail">
                                        <?= Html::encode($item['to_air']) ?>
                                    </span>
										</div>
									</div>
								<?php endforeach; ?>
							<?php } else { ?>
								<div class="from-to">
									<div class="from">
                                    <span class="detail">
                                        <?= Html::encode($request_form_user_info[0]['from_air']) ?>
                                    </span>
									</div>
									<div class="icon"></div>
									<div class="to">
                                    <span class="detail">
                                        <?= Html::encode($request_form_user_info[0]['to_air']) ?>
                                    </span>
									</div>
								</div>
							<?php } ?>
							<div class="ticket-info">
								Our Luxury Travel Specialists will process your request and contact you as soon as possible <br>
								or you can call us at <span>888 347 7817</span>
							</div>
						</div>
						<div class="ticket-number box-border">
							<div>Reference number</div>
							<div class="num">IFFCN-<?= Html::encode($request_form_users['request_number']) ?></div>
						</div>
						<div class="column-2">
							<div class="cabin-holder">
								<div class="ttl">Cabin class</div>
								<div class="cabin">
									<?php echo $request_form_users['cabin_class_name'] == '1' ? 'Business' : 'First' ?>
								</div>
							</div>
							<?php if ($request_form_users['type_trip'] == AppConfig::Type_Trip_Multi_City) { ?>
								<?php foreach ($request_form_user_info as $key => $item): ?>
									<div class="date-holder">
										<div class="ttl">Depart Date</div>
										<div class="date"><?= Html::encode($item['departure']) ?></div>
									</div>
								<?php endforeach; ?>
							<?php } else { ?>
								<div class="date-holder">
									<div class="ttl">Depart Date</div>
									<div class="date"><?= Html::encode($request_form_user_info[0]['departure']) ?></div>
								</div>
							<?php } ?>
							<?php if ($request_form_user_info[0]['arrival']) { ?>
								<div class="date-holder">
									<div class="ttl">Return Date</div>
									<div class="date"><?= Html::encode($request_form_user_info[0]['arrival']) ?></div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="container mx-auto xl:px-16 px-4 recently-flights-wrapper container-wrapper">
    <div class="recently-flights-wrapper container-wrapper">
        <div class="head-block flex justify-between">
            <div class="flex items-center"><h3>Best Deals</h3></div>
            <div class="flex">
                <div class="shopper-approved flex items-center">
                    <a href="https://www.shopperapproved.com/reviews/iflyfirstclass.com" target="_blank">
                        <img src="<?= $path_icons . 'shopper-approved-color-logo.svg' ?>" alt="">
                    </a>
                    <span>5.0</span>
                    <img src="<?= $path_icons . 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons . 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons . 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons . 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons . 'rating-star.svg' ?>" class="star" alt="">
                </div>
                <div class="separate-line flex items-center"></div>
                <div class="flex items-center">
                    <img src="<?= $path_icons . 'bitmap_3.png' ?>" alt="">
                </div>
            </div>
        </div>
        <div class="cities-block">
            <?php foreach ($random_cities as $city_item): ?>
                <div class="item">
                    <a href="<?= Url::to(['city/index', 'alias' => $city_item['alias']]); ?>">
                        <div class="city-item">
                            <img class="photo-img" src="<?= $path_img . Html::encode($city_item['image_alias']) ?>"
                                    title="<?= Html::encode($city_item['image_title']) ?>"
                                    alt="<?= Html::encode($city_item['image_title']) . " - IFlyFirstClass" ?>">
                            <div class="body box-border">
                                <div class="flex justify-between items-center">
                                    <div class="title">
                                        <?= Html::encode($city_item['name']) ?>
                                    </div>
                                    <div class="rating flex">
                                        <img src="<?= $path_icons . 'rating-star.svg' ?>" class="star" alt="">
                                        <span>5.0</span>
                                    </div>
                                </div>
                                <div class="cabin-class">
                                    Round trip / Business class
                                </div>
                                <div class="price-block flex justify-between items-center">
                                    <div class="new-price">
                                        $<?= Html::encode($city_item['business_class_price']) ?>
                                    </div>
                                    <div class="old-price">
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
</div>
<div class="container mx-auto xl:px-16 px-4 contact-info-wrapper container-wrapper flex justify-between">
    <div class="column">
        <p>
            <span>We welcome all</span> comments, suggestions, and indeed all feedback from our customers and visitors.
        </p>
        <p>
            Many of the changes and additions on here have been as a result of feedback from our customers and visitors
            and we appreciate the time taken to contact us.
        </p>
        <p>
            Simply email or call us and we will be happy to respond to any questions you may have or consider any
            suggestions you would like to make.
        </p>
    </div>
    <div class="column">
        <p>
            For General Questions, Comments & Suggestions please:
        </p>
        <p>
            Call Us Now : <span>1 888 347 7817</span>
        </p>
        <p>
            Our Email : <span>info@iFlyFirstClass.com</span>
        </p>
        <p>
            Our Mailing Address: 980 N Michigan Ave #1587, Chicago, IL 60611
        </p>
    </div>
</div>
