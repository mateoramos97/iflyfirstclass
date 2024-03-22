<?php

use app\components\widgets\request\RequestHotel;
use yii\helpers\Html;
use \yii\helpers\Url;

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/img-poster-hotel.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);
$this->registerLinkTag(['rel' => 'preload', 'href' => '/design/photo/img-poster-hotel.jpg']);

$this->params['breadcrumbs'][] = ['label' => 'Service', 'template' => '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">{link}<meta itemprop="position" content="2"></li>'];
$this->params['breadcrumbs'][] = 'Hotels';

?>
<div class="welcome-block-wrapper hotels-page mb-20">
    <div class="back-slide">
		<div class="container mx-auto welcome-block container-wrapper grid grid-cols-12 items-center">
			<div class="content xl:flex flex-col hidden align-center pt-8 px-12 col-span-5">
				<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
				<h6 class="border-b-2 border-white mt-28 w-fit text-white">Hotel bookings</h6>
				<div class="title-form font-silk-serif-medium text-white 2xl:text-5xl xl:text-4xl text-2xl mt-3">
					<span>The Lowest Prices on Business & First class Guaranteed</span>
				</div>
				<div class="mt-20 mb-12">
					<span class="text-white bg-black px-3 pt-3 pb-1 font-gilroy-semibold">Call US Now to Book Your Flight️</span>
					<div class="flex items-center bg-black p-2 w-fit">
						<img class="mr-2 scale-75" src="/public/img/phone-operator.svg" alt="operator-icon" width="40" height="40">
						<a class="font-gilroy-semibold text-3xl pr-2" href="tel:+18883477817">
							<span class="text-orange mr-1">+1</span> <span class="text-white">888 347 7817</span>
						</a>
					</div>
				</div>
			</div>
			<div class="form-block-wrapper xl:p-12 p-6 xl:col-span-7 col-span-12">
				<?= RequestHotel::widget() ?>
			</div>
		</div>
    </div>
</div>