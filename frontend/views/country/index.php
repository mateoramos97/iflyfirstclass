<?php

/* @var $this yii\web\View */
/* @var $city_model \common\sys\repository\landing\models\City */

use app\components\widgets\custom\LandingSidebarRight;
use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\request\FlightRequestMax;

$this->title = $country_model->browser_title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $country_model->browser_title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $country_model->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' =>  Url::base(true) . '/public/images/' . $images[0]['alias']]);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = Html::encode($country_model['name']);

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';
?>

<div itemscope="" itemtype="http://schema.org/Product">
	<div class="welcome-block-wrapper relative z-10">
		<img src="<?= $path_img . Html::encode($images[0]['alias']) ?>" class="hidden" width="1496" height="592">
		<div class="back-slide" style="background-image: url(<?= $path_img . Html::encode($images[0]['alias']) ?>); background-position: center">
			<div class="container mx-auto welcome-block container-wrapper grid grid-cols-11 items-center">
				<div class="content flex flex-col align-center xl:p-12 p-6 xl:col-span-5 col-span-11 justify-between h-full">
					<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
					<div class="xl:text-left text-center">
						<h4 class="border-b-2 border-white mt-28 xl:w-fit text-white">Flights to</h4>
						<h1 class="title-form font-silk-serif-medium text-white 2xl:text-8xl xl:text-7xl md:text-2xl mt-3">
							<span itemprop="name"><?= Html::encode($country_model['name']) ?></span>
						</h1>
						<h6 class="text-white">First & Business Class Flights</h6>
					</div>
					<div class="mt-16 xl:block hidden">
						<span class="text-white bg-black px-3 pt-3 pb-1 font-gilroy-semibold">Call US Now to Book Your Flight️</span>
						<div class="flex items-center bg-black p-2 w-fit">
							<img class="mr-2 scale-75" src="/public/img/phone-operator.svg" alt="">
							<a class="font-gilroy-semibold text-3xl pr-2" href="tel:+18883477817">
								<span class="text-orange mr-1">+1</span> <span class="text-white">888 347 7817</span>
							</a>
						</div>
					</div>
				</div>
				<div class="form-block-wrapper xl:p-12 p-6 xl:col-span-6 col-span-11 h-full">
					<?= FlightRequestMax::widget() ?>
				</div>
			</div>
		</div>
    </div>
	<div class="container mx-auto xl:px-12 px-4 highlight-block-wrapper pt-20 pb-8 bg-secondary -mt-10">
		<div class="title text-2xl mt-2 font-gilroy-regular">
			<span>Special offer to</span> <span class="font-semibold"><?= Html::encode($country_model['name']) ?></span>
		</div>
		<div class="container-wrapper grid xl:grid-cols-2 grid-cols-1 gap-6 mt-8">
			<div class="grid grid-cols-8 items-center bg-white rounded-2xl gap-2">
				<div class="col-span-3 h-full">
					<img
							class="rounded-l-2xl h-full object-cover"
							itemprop="image"
							src="<?= $path_img_thumbs. Html::encode($images[1]['alias']) ?>"
							title="<?= Html::encode($images[1]['title']) ?>"
							alt="<?= Html::encode($images[1]['title'])." - IFlyFirstClass" ?>">
				</div>
				<div class="col-span-5 px-10 py-8">
					<p class="font-gilroy-bold text-lg">Business Class</p>
					<p class="text-mute text-xs mt-1">Round Trip</p>
					<div class="flex justify-between mt-8">
						<p itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="price-new">
							<meta itemprop="priceCurrency" content="USD">
							Now
							<span class="font-gilroy-semibold text-orange text-lg">
								<span>$</span><span itemprop="price"><?= Html::encode($country_model['business_class_price']) ?></span>
							</span>
						</p>
						<p class="price-old">
							Old price <span class="line-through">$<?= Html::encode($country_model['business_class_old_price']) ?></span>
						</p>
					</div>
				</div>
			</div>
			<div class="grid grid-cols-8 items-center bg-white rounded-2xl gap-2">
				<div class="col-span-3 h-full">
					<img
							class="rounded-l-2xl h-full object-cover"
							itemprop="image"
							src="<?= $path_img_thumbs. Html::encode($images[2]['alias']) ?>"
							title="<?= Html::encode($images[2]['title']) ?>"
							alt="<?= Html::encode($images[2]['title'])." - IFlyFirstClass" ?>">
				</div>
				<div class="col-span-5 px-10 py-8">
					<p class="font-gilroy-bold text-lg">First Class</p>
					<p class="text-mute text-xs mt-1">Round Trip</p>
					<div class="flex justify-between mt-8">
						<p itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="price-new">
							<meta itemprop="priceCurrency" content="USD">
							Now:
							<span class="font-gilroy-semibold text-orange text-lg">
								<span>$</span><span itemprop="price"><?= Html::encode($country_model['first_class_price']) ?></span>
							</span>
						</p>
						<p class="price-old">
							Old price <span class="line-through">$<?= Html::encode($country_model['first_class_old_price']) ?></span>
						</p>
					</div>
				</div>
			</div>
		</div>
    </div>
	<div class="page-content xl:my-20 my-10">
		<div class="container mx-auto xl:px-10 px-2 grid grid-cols-12 xl:gap-5 gap-1 box-border">
			<div class="content xl:col-span-9 col-span-12 xl:pr-16 pr-0">
				<h3>
					<?= Html::encode($country_model['sub_title']) ?>
				</h3>
				<p class="text-gray-2 my-12 font-proxima-nova-light"><?= $country_model->summary ?></p>
				<div class="body">
					<?php echo $country_model->body_column_1; ?>
					<?php echo $country_model->body_column_2; ?>
				</div>
				<div class="mt-10 xl:p-8 p-4 text-gray-2 flex flex-wrap gap-2 rounded-2xl border border-gray-light-2 items-start xl:justify-between justify-center">
					<p class="xl:w-3/4 text-justify">IFlyFirstClass offers cheap Business Class flights to <?= Html::encode($country_model['name']) ?>, save thousands on last minute Business Class tickets. Best deals on Business Class. Special fares on Business and First Class tickets. Discounted First & Business Class airline tickets. First Class & Business Class travel deals.</p>
					<a href="#" class="btn btn-primary send-request-link-form ml-5">Book Flight Now</a>
				</div>
			</div>
			<div class="col-span-3 xl:block hidden">
				<?= LandingSidebarRight::widget(['summary_sidebar' => '']) ?>
			</div>
        </div>
	</div>
	<div class="container mx-auto wave w-full px-14"></div>
	<div class="container mx-auto xl:px-16 px-4 box-border xl:mt-14 mt-10 pb-24">
		<?= $this->render('@app/views/site/_landing-block', [
				'countries' => $countries,
				'cities' => $cities,
				'airlines' => $airlines,
		]) ?>
	</div>
</div>
