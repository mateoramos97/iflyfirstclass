<?php
use yii\helpers\Html;
use \yii\helpers\Url;
$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';
?>
<?php foreach($cities_random as $city_item): ?>
    <li class="city-item">
        <a href="<?= Url::to(['city/index', 'alias' => $city_item['alias']]); ?>">
            <div class="cities-li-inner">
                <div class="photo">
                    <div class="back-slide">
                        <div class="back-slide-inner">
                            <img src="<?= $path_img_thumbs. Html::encode($city_item['image_alias']) ?>" alt="<?= Html::encode($city_item['image_title']) ?>">
                        </div>
                    </div>
                </div>
                <div class="city-inner border-box">
                    <div class="title">
                        <?= Html::encode($city_item['name']) ?>
                    </div>
                    <div class="sub-title">
                        Round trip / Business class
                    </div>
                    <div class="price-block">
                        <div class="old">
                            $5,729
                        </div>
                        <div class="new">
                            $2,395
                        </div>
                    </div>
                </div>
                <div class="texture"></div>
            </div>
        </a>
    </li>
<?php endforeach; ?>
