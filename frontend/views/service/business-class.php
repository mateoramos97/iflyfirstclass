<?php

/* @var $this yii\web\View */

/* @var $continents \common\sys\repository\landing\models\Continent */

use yii\helpers\Html;
use \yii\helpers\Url;
use \yii\helpers\StringHelper;
use app\components\widgets\request\FlightRequestMax;
use app\components\widgets\custom\LandingSidebarRight;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/business-class.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Business Class';

$path_img = Url::base() . '/public/images/';
$path_img_thumbs = Url::base() . '/public/images/thumbs/';
?>

<div class="welcome-block-wrapper business-class-page xl:mt-0 mt-20">
    <div class="back-slide">
		<img src="/design/photo/business-class.jpg" class="hidden" width="1496" height="592">
		<div class="container mx-auto welcome-block container-wrapper grid grid-cols-11 items-center">
			<div class="content xl:flex flex-col hidden align-center pt-8 px-12 col-span-5">
				<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
				<div class="title-form font-silk-serif-medium text-white 2xl:text-8xl xl:text-7xl md:text-xl mt-36">
					<span>Business class flights</span>
				</div>
				<div class="my-16">
					<span class="text-white bg-black px-3 pt-3 pb-1 font-gilroy-semibold">Call US Now to Book Your Flight️</span>
					<div class="flex items-center bg-black p-2 w-fit">
						<img class="mr-2 scale-75" src="/public/img/phone-operator.svg" alt="">
						<a class="font-gilroy-semibold text-3xl pr-2" href="tel:+18883477817">
							<span class="text-orange mr-1">+1</span> <span class="text-white">888 347 7817</span>
						</a>
					</div>
				</div>
			</div>
			<div class="form-block-wrapper xl:p-12 p-6 xl:col-span-6 col-span-11">
				<?= FlightRequestMax::widget(['shortHead' => 'Business class flights']) ?>
			</div>
		</div>
    </div>
</div>
<div class="page-content mt-16">
	<div class="container mx-auto xl:px-10 px-2 grid grid-cols-12 xl:gap-5 gap-1 box-border">
		<div class="content xl:col-span-9 col-span-12 xl:pr-16 pr-0">
			<h4 class="specialsup-banner box-border">
                With IFlyFirstClass You Can Save Up to 70% on Your Next Trip in Business Class
            </h4>
			<div class="body mt-10 text-justify">
				<div class="xl:columns-2 columns-1 gap-10">
                    <div class="column">
						<p class="text-gray-2">
                            Relish the spaciousness and luxury of premium travel with I Fly First Class’ outstanding
                            discounts on business class seats and last minute business class fares. You’ll save
                            thousands of dollars on high-end travel that provides you with the space and amenities you
                            need to make your flight time productive and restful. Wherever you need to go, I Fly First
                            Class can get you there at the cheapest rates aboard the best-rated business class cabins.
                        </p>
                        <h5 class="my-4">Enjoy World-Class Airlines</h5>
						<p class="text-gray-2">
                            I Fly First Class’ unique travel partnerships give you access to the world’s top airlines,
                            the most popular domestic and international destinations and some of the choicest business
                            class amenities. We offer coveted routes on all of today’s acclaimed airlines, including:
                        </p>
                        <ul class="text-gray-2 list-disc p-4">
                            <li>Qatar Airways,</li>
                            <li>Oman Air,</li>
                            <li>Swiss International Air Lines,</li>
                            <li>Singapore Airlines,</li>
                            <li>Cathay Pacific,</li>
                            <li>Qantas,</li>
                            <li>Etihad Airways and,</li>
                            <li>Emirates.</li>
                        </ul>
                        <h5 class="my-4">On The Ground</h5>
						<p class="text-gray-2">
                            The magnificent service and amenities of premium travel begin at the airport where you'll be
                            welcomed into some of the finest, exclusive international airport lounges. On-site
                            concierges can assist you with checking in, destination information, on-ground
                            transportation issues and dozens of other issues. You'll appreciate expedited check-in,
                            security and customs queues that get you to your destination more quickly and easily.
                        </p>
                    </div>
                    <div class="column">
						<p class="text-gray-2">
                            Dine on gourmet fare, sip a cocktail or two, take advantage of fully equipped business
                            centers and relax in cushioned chairs and sofas in beautifully appointed business class
                            lounges. State-of-the-art business class programs showcase unrivaled service. Qatar
                            Airlines, for example, provides business class travelers with a premium airport terminal at
                            Doha International Airport. There travelers enjoy dessert bars, sushi platters, sumptuous
                            massage chairs and a 24-hour clinic.
                        </p>
                        <h5 class="my-4">In The Air</h5>
						<p class="text-gray-2">
                            The amenities on today's business class flights rival the extraordinary offerings of the
                            most lavish first class cabins. Here, you'll experience the ultimate in business
                            convenience, from ample storage space and extra work surfaces to abundant connectivity and
                            power ports. Business class seats and all of their many luxuries are designed to help you
                            make the most of your time in the air, whether you choose to sleep, relax, work or enjoy a
                            movie. As a business class traveler, you'll relish meals designed by world-famous chefs and
                            carefully selected wine lists and cocktails. Stretch out in supple seats that recline to
                            varying positions and enjoy the many offerings of personal on-demand entertainment systems
                            and extra-wide LCD monitors. Some international flights even feature private business class
                            seats in suite-like configurations and in-air lounges and bars.
                        </p>
                        <h5 class="my-4">The I Fly First Class Advantage</h5>
						<p class="text-gray-2">
                            At I Fly First Class, we are dedicated to helping you make the most out of your business and
                            pleasure travel by providing spectacular discounts on premium business travel. Our travel
                            professionals are adept at presenting superior service and incomparable route and travel
                            options. With deals like ours, you can't afford not to travel in the spacious luxury of
                            discounted business class seats and last minute business class fares.
                        </p>
                    </div>
                </div>
            </div>
			<div class="mt-10 xl:p-8 p-4 text-gray-2 flex flex-wrap gap-2 rounded-2xl border border-gray-light-2 items-start xl:justify-between justify-center">
				<p class="xl:w-3/4 text-justify">IFlyFirstClass offers cheap Business Class flights to New Zeland, save thousands on last minute Business Class tickets. Best deals on Business Class.  Special fares on Business and First Class tickets. Discounted First & Business Class airline tickets. First Class & Business Class travel deals.</p>
				<a href="#" class="btn btn-primary send-request-link-form ml-5">Book Flight Now</a>
			</div>
        </div>
		<div class="col-span-3 xl:block hidden">
       		<?= LandingSidebarRight::widget(['summary_sidebar' => '']) ?>
		</div>
    </div>
	<div class="container mx-auto xl:px-10 px-4 box-border mt-16 mb-20">
        <div class="flex">
            <div class="continents">
				<h5 class="title">Continent</h5>
                <ul>
                    <?php foreach ($continents as $item): ?>
						<li class="my-3">
                            <a href="<?= Url::to(['continent/index', 'alias' => $item['alias']]); ?>">
                                <?= Html::encode($item['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
