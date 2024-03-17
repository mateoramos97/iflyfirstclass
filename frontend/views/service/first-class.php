<?php

/* @var $this yii\web\View */

/* @var $continents \common\sys\repository\landing\models\Continent */

use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\request\FlightRequestMax;
use app\components\widgets\custom\LandingSidebarRight;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/first-class.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'First Class';

$path_img = Url::base() . '/public/images/';
$path_img_thumbs = Url::base() . '/public/images/thumbs/';
?>

<div class="container mx-auto welcome-block-wrapper first-class-page">
    <div class="back-slide">
		<div class="welcome-block container-wrapper grid grid-cols-11 items-center">
			<div class="content xl:flex flex-col hidden align-center pt-8 px-12 col-span-5">
				<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
				<div class="title-form font-silk-serif-medium text-white 2xl:text-8xl xl:text-7xl md:text-xl mt-36">
					<span>First class flights</span>
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
				<?= FlightRequestMax::widget() ?>
			</div>
		</div>
    </div>
</div>
<div class="page-content mt-16">
    <div class="container mx-auto xl:px-10 px-2 grid grid-cols-12 xl:gap-5 gap-1 box-border">
        <div class="content xl:col-span-9 col-span-12 xl:pr-16 pr-0">
            <h4 class="specialsup-banner box-border">
                With IFlyFirstClass You Can Save Up to 70% on Your Next Trip in First Class
            </h4>
            <div class="body mt-10 text-justify">
                <div class="xl:columns-2 columns-1 gap-10">
                    <div class="column">
                        <p class="text-gray-2">
                            Experience incomparable luxury while traveling to enticing destinations with deeply
                            discounted fares and last minute first class flights from I Fly First Class. You'll save
                            thousands of dollars on premium flights aboard the world's most acclaimed airlines and enjoy
                            unrivaled luxuries designed to cater to your every need before, during and after your
                            flight.
                        </p>
                        <h5 class="my-4">Airline Partners</h5>
                        <p class="text-gray-2">
                            I Fly First Class is proud to offer deeply discounted fares aboard today's most revered
                            international airlines. Our reduced premium fares place you aboard award-winning first class
                            cabins operated by airlines such as Etihad Airways, Cathay Pacific, Virgin Atlantic, British
                            Airways, All Nippon Airways, Qantas and United Airlines. Whether you are planning your first
                            class flight well in advance or seeking a last minute first class deal, our discounted fares
                            on top airlines provide you with the pampering you expect at the cheapest prices available.
                        </p>
						<h5 class="my-4">On The Ground</h5>
                        <p class="text-gray-2">
                            Nothing but the best is available to our first class travelers. For many airlines, the
                            indulgent first class service begins with complimentary chauffeur transport to the airline
                            or valet parking at specially designated first class airport terminals. Concierges and
                            personal assistants welcome travelers to exclusive airport lounges where passengers delight
                            in salon services, business centers, elaborate buffets and a la carte meals and bountiful
                            entertainment. Enjoy a pre-flight cocktail while mingling with other successful
                            professionals and well-traveled passengers. Relax between flights with a calming massage,
                            refresh with an invigorating shower in beautifully appointed private shower suites or
                            re-charge in a quiet, personal sleeping space.
                        </p>
                    </div>
                    <div class="column">
                        <p class="text-gray-2">
                            Whatever your need, your exclusive first class airport lounge is sure to accommodate and
                            surpass every expectation.
                        </p>
                        <h5 class="my-4">In The Air</h5>
                        <p class="text-gray-2">
                            Even more extravagant luxuries are available to first class passengers in flight. Offering
                            the ultimate in privacy, serenity, pampering and service, first class flights excel at
                            anticipating every whim and necessity. Supple leather seats recline at the touch of a
                            button. Personal on-demand entertainment systems present movies, television shows,
                            interactive features and even language courses to help you make the most of your flight
                            time. Meals designed by some of the globe's most famous chefs are presented on fine bone
                            china and linens. Free-flowing champagne and exquisitely selected wines accentuate
                            delectable culinary choices. Luscious toiletries created by today's favorite designers fill
                            complimentary amenity kits. Fresh and crisp pajamas, slippers and eye masks help passengers
                            settle in for tranquil in-flight slumber atop hedonistic bedding. All of these favors are
                            expertly created and provided so that you can arrive at your destination feeling as rested
                            and satisfied as possible.
                        </p>
                        <h5 class="my-4">The I Fly First Class Advantage</h5>
                        <p class="text-gray-2">
                            I Fly First Class makes it possible for busy professionals and savvy travelers to enjoy
                            unforgettable luxury at the cheapest available prices. Our expert travel professionals excel
                            at unearthing unheard-of deals to top destinations, all while providing superior service
                            that endures throughout your travels. Accessing remarkable first class fares and last minute
                            first class flights has never been easier with the stellar deals from I Fly First Class.
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
