<?php

/* @var $this yii\web\View */

use \yii\helpers\Url;
use yii\helpers\Html;
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

<div class="request-corporate-account-title container-wrapper">
    <h1>Corporate flights</h1>
</div>
<div class="form-request-wrapper">
    <div class="container-wrapper flex flex-justify-between">
        <div class="form-request">
            <?= RequestCorporateAcoounts::widget() ?>
        </div>
        <div class="info-block">
        <h3>Corporate Accounts</h3>
        <p>
            When your job takes you to foreign cities, our job is to find you deals on affordable flights with all the benefits of <span class="bold-tag">first class</span> air travel. When last-minute travel plans would have you scrambling for tickets, you can take comfort in knowing that we’ve got you covered. Forging positive
        </p>
        <h3>Small Business:</h3>
        <p>
            When it comes to working with small business, we know that your time and money are precious. That’s why we handle the travel planning while you take care of your company. Our philosophy is to find you inexpensive flights and discounts with several leading airline companies, so you can enjoy the full CEO treatment on your travels. No business is a small business in our eyes when it comes to <span class="bold-tag">first class</span> treatment, and we offer free
        </p>
        <h3>Corporations:</h3>
        <p>
            We also cater to big businesses with busy schedules and ever-changing itineraries. When you’re swamped with conferences, we’re committed to finding you discounts on business class flights that will make your travel experiences as smooth as possible. Whether you’re booking a flight for a last-minute meeting or a
        </p>
        </div>
    </div>
</div>
