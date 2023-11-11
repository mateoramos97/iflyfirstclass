<?php
/* @var $this yii\web\View */
/* @var $travel_tips_model \common\sys\repository\traveltips\models\TravelTips */

use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\custom\BlogSidebarRight;

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';

$this->title = $travel_tips_model->browser_title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $travel_tips_model->browser_title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $travel_tips_model->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/public/images/' . $images[0]['alias']]);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = ['label' => 'Travel tips', 'url' => Url::to(['travel-tips/list'])];
$this->params['breadcrumbs'][] = Html::encode($travel_tips_model['title']);

?>

<div class="page-content">
    <div class="container-wrapper flex flex-justify-between border-box">
        <div class="content">
            <h1><?= Html::encode($travel_tips_model->title); ?></h1>
            <div class="items">
                <?php foreach($travel_tips_attactions as $item): ?>
                    <div class="item">
                        <h3 class="title">
                            <?= Html::encode($item['title']) ?>
                        </h3>
                        <div class="img-poster">
                            <img
                                    src="<?= $path_img. Html::encode($item['images'][0]['alias']); ?>"
                                    title="<?= Html::encode($item['images'][0]['title']) ?>"
                                    alt="<?= Html::encode($item['images'][0]['title']) . " - IFlyFirstClass" ?>">
                        </div>
                        <div class="body">
                            <?php echo $item['body']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?= BlogSidebarRight::widget() ?>
    </div>
</div>