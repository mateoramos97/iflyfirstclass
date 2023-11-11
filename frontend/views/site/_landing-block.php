<?php
use yii\helpers\Html;
use \yii\helpers\Url;

$path_icons =  Url::base().'/design/icons/';
?>

<div class="landing-block-wrapper border-box">
    <div class="container-wrapper">
        <div class="landing-columns flex flex-justify-between">
            <div class="column">
                <div class="title">
                    Top Destination Countries
                </div>
                <ul>
                    <?php foreach($countries as $item): ?>
                        <li><a href="<?= Url::to(['country/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="column">
                <div class="title">
                    Top Destination Cities
                </div>
                <ul>
                    <?php foreach($cities as $item): ?>
                        <li><a href="<?= Url::to(['city/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="column">
                <div class="title">
                    Top airline deals
                </div>
                <ul>
                    <?php foreach($airlines as $item): ?>
                        <li><a href="<?= Url::to(['airline/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="landing-more-link flex flex-justify-center">
            <a href="javascript:void(0)" class="flex flex-align-center" onclick="readMoreLanding(this)">
                <span>Show More</span>
                <img src="<?= $path_icons . 'arrow-show-more.svg' ?>" alt="">
            </a>
            <script type="text/javascript">
                function readMoreLanding(elem) {
                    var content = document.getElementsByClassName("landing-columns"),
                        landingMoreLink = document.getElementsByClassName("landing-more-link");
                    landingMoreLink[0].classList.add('disable');
                    content[0].classList.add("open");
                }
            </script>
        </div>
    </div>
</div>
