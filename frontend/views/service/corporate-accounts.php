<?php
/* @var $this yii\web\View */

use app\components\widgets\request\RequestCorporateAcoounts;

$this->title = $head_title;
?>
<div class="welcome-block-wrapper">
    <?= $this->render('@app/views/layouts/_header') ?>
    <div class="img-section" style="background-image:url('/design/corporate-accounts-poster.jpg')"></div>
    <div class="welcome-block-inner">
        <div class="texture"></div>
        <div class="content-block-wrapper">
            <div class="content-block-inner border-box">
                <h1>
                    We handle travel planning while you take care of your company...
                </h1>
                <?= RequestCorporateAcoounts::widget() ?>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="page-content-inner border-box">
        <div class="columns">
            <div class="column column-1">
                <div class="title">
                    Corporate Accounts
                </div>
                <div class="description">
                    When your job takes you to foreign cities, our job is to find you deals on affordable flights
                    with all the benefits of first class air travel. When last-minute travel plans would have you
                    scrambling for tickets, you can take comfort in knowing that we’ve got you covered. Forging positive
                    relationships with CEOs and businesses is important to us.
                </div>
            </div>
            <div class="column column-2">
                <div class="title">
                    Small Business:
                </div>
                <div class="description">
                    When it comes to working with small business, we know that your time and money are precious.
                    That’s why we handle the travel planning while you take care of your company. Our philosophy
                    is to find you inexpensive flights and discounts with several leading airline companies, so
                    you can enjoy the full CEO treatment on your travels. No business is a small business in our
                    eyes when it comes to first class treatment, and we offer free limo service within 30 miles of the airport.
                </div>
            </div>
            <div class="column column-3">
                <div class="title">
                    Corporations:
                </div>
                <div class="description">
                    We also cater to big businesses with busy schedules and ever-changing itineraries.
                    When you’re swamped with conferences, we’re committed to finding you discounts on
                    business class flights that will make your travel experiences as smooth as possible.
                    Whether you’re booking a flight for a last-minute meeting or a conference that’s months away,
                    we’re here to take much of the expense and all of the hassle out of finding long-haul flights
                    to cities across the globe.
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="bottom-block-wrapper">
        <div class="texture"></div>
        <div class="bottom-block-inner border-box">
            <div class="inner">
                <div class="title">
                    Search Business &amp; First Class Now
                </div>
                <a href="/" class="search-now">Search now</a>
            </div>
        </div>
    </div>
</div>