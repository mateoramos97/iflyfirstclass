<?php

/* @var $this yii\web\View */

use \yii\helpers\Url;
use app\components\widgets\request\RequestCorporateAcoounts;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Corporate accounts';

?>
<div class="flex items-center justify-center border-t border-b border-gray-light-2 xl:mt-0 mt-20">
	<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
</div>
<div class="request-corporate-account-title container mx-auto xl:px-12 px-4 mt-8 mb-10 text-center">
    <h1 class="font-silk-serif-bold xl:text-7xl lg:text-6xl text-2xl">Corporate flights</h1>
</div>
<div class="form-request-wrapper bg-secondary xl:py-20 py-10 container mx-auto xl:px-12 px-4">
    <div class="flex justify-between">
		<?= RequestCorporateAcoounts::widget() ?>
    </div>
</div>
<div class="container mx-auto xl:px-20 px-4 xl:my-20 my-10">
	<div class="grid xl:grid-cols-3 grid-cols-1 xl:gap-20 gap-4">
		<div>
			<h5>Corporate Accounts</h5>
			<p class="text-gray-2 mt-5">
				When your job takes you to foreign cities, our job is to find you deals on affordable flights with all the benefits of <span class="bold-tag">first class</span> air travel. When last-minute travel plans would have you scrambling for tickets, you can take comfort in knowing that we’ve got you covered. Forging positive
			</p>
		</div>
		<div>
			<h5>Small Business</h5>
			<p class="text-gray-2 mt-5">
				When it comes to working with small business, we know that your time and money are precious. That’s why we handle the travel planning while you take care of your company. Our philosophy is to find you inexpensive flights and discounts with several leading airline companies, so you can enjoy the full CEO treatment on your travels. No business is a small business in our eyes when it comes to <span class="bold-tag">first class</span> treatment, and we offer free
			</p>
		</div>
		<div>
			<h5>Corporations</h5>
			<p class="text-gray-2 mt-5">
				We also cater to big businesses with busy schedules and ever-changing itineraries. When you’re swamped with conferences, we’re committed to finding you discounts on business class flights that will make your travel experiences as smooth as possible. Whether you’re booking a flight for a last-minute meeting or a
			</p>
		</div>
	</div>
</div>
