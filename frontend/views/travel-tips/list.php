<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use \yii\helpers\Url;

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' =>  '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Travel tips';

?>
<div class="welcome-block-wrapper flex flex-align-center">
    <div class="welcome-block-inner container-wrapper flex flex-column flex-align-start">
        <h1>Travel Tips</h1>
        <div class="sub-title">The best travel news</div>
    </div>
</div>
<div class="page-content">
    <div class="page-content-inner border-box">
        <?php
        echo ListView::widget([
            'dataProvider' => $travel_tips_list,
            'options' => [
                'tag' => 'div',
                'class' => 'travel-tips-list container-wrapper',
                'id' => 'travel_tips_list',
            ],
            'layout' => "<div class='items'>{items}</div><div class='clearfix'></div>\n{pager}",
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