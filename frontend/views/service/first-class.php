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
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/first-class.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'First Class';

$path_img = Url::base() . '/public/images/';
$path_img_thumbs = Url::base() . '/public/images/thumbs/';
?>

<div class="welcome-block-wrapper">
    <div class="back-slide">
        <div class="back-slide-inner">
            <img src="<?= Url::base(true) . '/design/photo/first-class.jpg' ?>" alt="">
        </div>
        <div class="texture"></div>
    </div>
    <div class="welcome-block container-wrapper flex flex-justify-between">
        <div class="content flex flex-align-center">
            <div>
                <h1>First class flights</h1>
            </div>
        </div>
        <div>
            <?= FlightRequestMax::widget() ?>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-wrapper flex flex-justify-between border-box">
        <div class="content">
            <div class="specialsup-banner border-box">
                With IFlyFirstClass You Can Save Up to 70% on Your Next Trip in First Class
            </div>
            <div class="body">
                <div class="columns flex flex-justify-between">
                    <div class="column">
                        <p>
                            Experience incomparable luxury while traveling to enticing destinations with deeply
                            discounted fares and last minute first class flights from I Fly First Class. You'll save
                            thousands of dollars on premium flights aboard the world's most acclaimed airlines and enjoy
                            unrivaled luxuries designed to cater to your every need before, during and after your
                            flight.
                        </p>
                        <h3>Airline Partners</h3>
                        <p>
                            I Fly First Class is proud to offer deeply discounted fares aboard today's most revered
                            international airlines. Our reduced premium fares place you aboard award-winning first class
                            cabins operated by airlines such as Etihad Airways, Cathay Pacific, Virgin Atlantic, British
                            Airways, All Nippon Airways, Qantas and United Airlines. Whether you are planning your first
                            class flight well in advance or seeking a last minute first class deal, our discounted fares
                            on top airlines provide you with the pampering you expect at the cheapest prices available.
                        </p>
                        <h3>On The Ground</h3>
                        <p>
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
                        <p>
                            Whatever your need, your exclusive first class airport lounge is sure to accommodate and
                            surpass every expectation.
                        </p>
                        <h3>In The Air</h3>
                        <p>
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
                        <h3>The I Fly First Class Advantage</h3>
                        <p>
                            I Fly First Class makes it possible for busy professionals and savvy travelers to enjoy
                            unforgettable luxury at the cheapest available prices. Our expert travel professionals excel
                            at unearthing unheard-of deals to top destinations, all while providing superior service
                            that endures throughout your travels. Accessing remarkable first class fares and last minute
                            first class flights has never been easier with the stellar deals from I Fly First Class.
                        </p>
                    </div>
                </div>
            </div>
            <a href="#" class="send-request-link-form">Send Request</a>
        </div>
        <?= LandingSidebarRight::widget(['summary_sidebar' => '']) ?>
    </div>
    <div class="sections border-box">
        <div class="container-wrapper flex">
            <div class="continents column">
                <div class="title">Continent</div>
                <ul>
                    <?php foreach ($continents as $item): ?>
                        <li>
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
