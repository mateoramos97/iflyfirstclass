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

<div class="welcome-block-wrapper">
    <div class="back-slide">
        <div class="back-slide-inner">
            <img src="<?= Url::base(true) . '/design/photo/business-class.jpg' ?>" alt="">
        </div>
        <div class="texture"></div>
    </div>
    <div class="welcome-block container-wrapper flex flex-justify-between">
        <div class="content flex flex-align-center">
            <div>
                <h1>Business class flights</h1>
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
                With IFlyFirstClass You Can Save Up to 70% on Your Next Trip in Business Class
            </div>
            <div class="body">
                <div class="columns flex flex-justify-between">
                    <div class="column">
                        <p>
                            Relish the spaciousness and luxury of premium travel with I Fly First Class’ outstanding
                            discounts on business class seats and last minute business class fares. You’ll save
                            thousands of dollars on high-end travel that provides you with the space and amenities you
                            need to make your flight time productive and restful. Wherever you need to go, I Fly First
                            Class can get you there at the cheapest rates aboard the best-rated business class cabins.
                        </p>
                        <h3>Enjoy World-Class Airlines</h3>
                        <p>
                            I Fly First Class’ unique travel partnerships give you access to the world’s top airlines,
                            the most popular domestic and international destinations and some of the choicest business
                            class amenities. We offer coveted routes on all of today’s acclaimed airlines, including:
                        </p>
                        <ul>
                            <li>Qatar Airways,</li>
                            <li>Oman Air,</li>
                            <li>Swiss International Air Lines,</li>
                            <li>Singapore Airlines,</li>
                            <li>Cathay Pacific,</li>
                            <li>Qantas,</li>
                            <li>Etihad Airways and,</li>
                            <li>Emirates.</li>
                        </ul>
                        <h3>On The Ground</h3>
                        <p>
                            The magnificent service and amenities of premium travel begin at the airport where you'll be
                            welcomed into some of the finest, exclusive international airport lounges. On-site
                            concierges can assist you with checking in, destination information, on-ground
                            transportation issues and dozens of other issues. You'll appreciate expedited check-in,
                            security and customs queues that get you to your destination more quickly and easily.
                        </p>
                    </div>
                    <div class="column">
                        <p>
                            Dine on gourmet fare, sip a cocktail or two, take advantage of fully equipped business
                            centers and relax in cushioned chairs and sofas in beautifully appointed business class
                            lounges. State-of-the-art business class programs showcase unrivaled service. Qatar
                            Airlines, for example, provides business class travelers with a premium airport terminal at
                            Doha International Airport. There travelers enjoy dessert bars, sushi platters, sumptuous
                            massage chairs and a 24-hour clinic.
                        </p>
                        <h3>In The Air</h3>
                        <p>
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
                        <h3>The I Fly First Class Advantage</h3>
                        <p>
                            At I Fly First Class, we are dedicated to helping you make the most out of your business and
                            pleasure travel by providing spectacular discounts on premium business travel. Our travel
                            professionals are adept at presenting superior service and incomparable route and travel
                            options. With deals like ours, you can't afford not to travel in the spacious luxury of
                            discounted business class seats and last minute business class fares.
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
