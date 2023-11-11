<?php
use yii\helpers\Url;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/about-top.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'About Us';

?>
<div class="welcome-block-wrapper top contact-us p-relative">
    <div class="back-slide">
        <div class="back-slide-inner">
            <img src="<?= Url::base(true) . '/design/photo/about-top.jpg' ?>" alt>
        </div>
    </div>
    <div class="welcome-block container-wrapper p-relative flex flex-align-center">
        <div class="content flex flex-column flex-align-start">
            <div class="title">Contact Us</div>
            <p>We welcome all comments, suggestions, and indeed all feedback from our customers and visitors.</p>
        </div>
    </div>
</div>
<div class="content-wrapper container-wrapper flex flex-justify-between">
    <div class="column contacts">
        <p class="title">
            For General Questions, Comments & Suggestions please:
        </p>
        <div itemscope="" itemtype="http://schema.org/Organization">
            <p itemprop="name">IFlyFirstClass</p>
            <p>Call Us Now: <span itemprop="telephone" class="telephone">1 888 347 7817</span></p>
            <p>Our Email: <span itemprop="email" class="email">info@flyfirst.com</span></p>
            <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                <p>
                    Our Mailing Address: <span itemprop="streetAddress">980 N Michigan Ave, #1587 </span> <span itemprop="addressLocality">Chicago, IL,</span> <span itemprop="postalCode">60611</span>
                </p>
            </div>
        </div>
        <p>For Media Inquiries: <span>Alexa Helms, Alexa@stormpr.com</span></p>
    </div>
    <div class="column">
        <p>
            Many of the changes and additions on here have been as a result of feedback from our customers and visitors and we appreciate the time taken to contact us.
        </p>
        <p class="last-child">
            Simply email or call us and we will be happy to respond to any questions you may have or consider any suggestions you would like to make.
        </p>
    </div>
</div>
<div class="welcome-block-wrapper about-us p-relative">
    <div class="back-slide">
        <div class="back-slide-inner">
            <img src="<?= Url::base(true) . '/design/photo/about-bottom.jpg' ?>" alt>
        </div>
    </div>
</div>
<div class="content-wrapper container-wrapper">
    <div class="title">About us</div>
    <div class="flex flex-justify-between">
        <div class="column">
            <p>
                Business and First class flights can be notoriously expensive, but with I Fly First Class, that's never a problem. Use our flight consolidator database to find reduced-fare flights for corporate business travel, and you'll save up to 60% over conventional published corporate airfares! With our business class international flights, you'll enjoy all the comforts of pricey premium air travel, but you won't pay an arm and a leg for it.
            </p>
            <p class="last-child">
                Discounted business and first class seats are available for all international and domestic US destinations. Find low-cost business class airfares on all major US and international airlines.
            </p>
        </div>
        <div class="column">
            <p>
                Get access to affordable business class tickets for round-trip, one-way, round-the-world, even complex itineraries. Seats can be preassigned, and many tickets are changeable and refundable, although certain restrictions may apply.
            </p>
            <p class="last-child">
                I Fly First Class is your personal travel concierge. We're at your service 24/7 to meet all your travel needs. Our professional staff is dedicated to saving you time and money. We'll sort out even the most complex travel itineraries in minutes, getting you the best but least costly business class airfares. Our business flight booking division is always at your service!
            </p>
        </div>
    </div>
</div>