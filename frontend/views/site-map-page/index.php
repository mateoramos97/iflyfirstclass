<?php

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = "Sitemap";

// print_r($site_map_list->getModels());
$newarray = [];
foreach($site_map_list->getModels() as $key => $value){
    $newarray[$value['category']][$key] = $value;
}

?>
<div class="site-map-wrapper page-content container-wrapper flex">
    <div class="column-1 border-box">
        <div class="menu-wrapper">
            <div class="link">
                <a href="/">iflyfirstclass.com</a>
            </div>
            <div class="catgory-wrapper">
                <div class="category-name">Services:</div>
                <ul>
                    <li>
                        <a href="<?= Url::to(['service/first-class']); ?>">First Class</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/business-class']); ?>">Business Class</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/hotel']); ?>">Hotels</a>
                    </li>
                </ul>
            </div>
            <div class="link">
                <a href="<?= Url::to(['static-page/last-minute-deals']); ?>">Last minute deals</a>
            </div>
            <div class="link">
                <a href="<?= Url::to(['static-page/corporate-account']); ?>">Corporate accounts</a>
            </div>
            <div class="link">
                <a href="<?= Url::to(['blog/list']); ?>">Blog</a>
            </div>
            <div class="link">
                <a href="<?= Url::to(['travel-tips/list']); ?>">Travel Tips</a>
            </div>
            <div class="catgory-wrapper">
                <div class="category-name">Tools:</div>
                <ul>
                    <li>
                        <a href="<?= Url::to(['tools/flight-tracker']); ?>">Flight Tracker</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['tools/visa']); ?>">Visa</a>
                    </li>
                </ul>
            </div>
            <div class="link">
                <a href="<?= Url::to(['static-page/testimonials']); ?>">Testimonials</a>
            </div>
            <div class="link">
                <a href="<?= Url::to(['static-page/about']); ?>">About Us</a>
            </div>
        </div>
    </div>
    <div class="column-2">
            <?php if (isset($newarray['country'])) { ?>
                <div class="category-wrapper category-country">
                    <div class="category-title">Countries</div>
                    <? foreach($newarray['country'] as $country): ?>
                        <div class="link">
                            <a href="<?= Url::to(['country/index', 'alias' => $country['alias']]); ?>"><?= Html::encode($country['title']) ?></a>
                        </div>
                    <? endforeach; ?>
                </div>
            <?php } ?>
            <?php if (isset($newarray['city'])) { ?>
                <div class="category-wrapper category-city">
                    <div class="category-title">Cities</div>
                    <? foreach($newarray['city'] as $country): ?>
                        <div class="link">
                            <a href="<?= Url::to(['city/index', 'alias' => $country['alias']]); ?>"><?= Html::encode($country['title']) ?></a>
                        </div>
                    <? endforeach; ?>
                </div>
            <?php } ?>
            <?php if (isset($newarray['airline'])) { ?>
                <div class="category-wrapper category-airline">
                    <div class="category-title">Airlines</div>
                    <? foreach($newarray['airline'] as $country): ?>
                        <div class="link">
                            <a href="<?= Url::to(['airline/index', 'alias' => $country['alias']]); ?>"><?= Html::encode($country['title']) ?></a>
                        </div>
                    <? endforeach; ?>
                </div>
            <?php } ?>
            <?php if (isset($newarray['directions_cities'])) { ?>
                <div class="category-wrapper category-directions-cities">
                    <div class="category-title">Directions Cities</div>
                    <? foreach($newarray['directions_cities'] as $country): ?>
                        <div class="link">
                            <a href="<?= Url::to(['direction-city/index', 'alias' => $country['alias']]); ?>"><?= Html::encode($country['title']) ?></a>
                        </div>
                    <? endforeach; ?>
                </div>
            <?php } ?>
            <?php
                echo ListView::widget([
                    'dataProvider' => $site_map_list,
                    'options' => [
                        'tag' => 'div',
                        'class' => 'site-map-list-list',
                        'id' => 'site_map_list_list',
                    ],
                    'layout' => "<div class='items'></div>\n{pager}",
                    'itemView' => '_list',
                    'itemOptions' => [
                        'tag' => false,
                        //'class' => 'item'
                    ],
                    'pager' => [
                        'prevPageLabel' => 'Back',
                        'nextPageLabel' => 'Next',
                        'maxButtonCount' => 3
                    ],
                ]);
            ?>
        </div>
</div>