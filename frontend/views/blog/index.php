<?php
/* @var $this yii\web\View */

/* @var $blog_article_model \common\sys\repository\blog\models\BlogArticles */

use yii\helpers\Html;
use \yii\helpers\Url;

use app\components\widgets\custom\BlogSidebarRight;

$this->title = $blog_article_model->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $blog_article_model->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $blog_article_model->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/public/images/' . $images[0]['alias']]);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$path_img = Url::base() . '/public/images/';
$path_img_thumbs = Url::base() . '/public/images/thumbs/';

$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => Url::to(['blog/list'])];
$this->params['breadcrumbs'][] = Html::encode($blog_article_model['title']);

?>
<div class="page-content">
    <div class="container-wrapper flex flex-justify-between border-box">
        <div class="content">
            <div class="blog-poster-wrapper">
                <img
                        src="<?= $path_img . Html::encode($images[0]['alias']) ?>"
                        title="<?= Html::encode($images[0]['title']) ?>"
                        alt="<?= Html::encode($images[0]['title']) . " - IFlyFirstClass" ?>">
                <div class="blog-title border-box">
                    <h1><?= Html::encode($blog_article_model['title']) ?></h1>
                </div>
                <div class="grd-title"></div>
            </div>
            <div class="actions flex flex-justify-between flex-align-center border-box">
                <div class="column-1">
                    Enjoy The Best Service and <span>Save Thousands</span>
                </div>
                <div class="column-2 flex flex-align-center">
                    <div class="share-facebook">
                        <!-- Load Facebook SDK for JavaScript -->
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v5.0"></script>
                        <div class="fb-share-button" data-href="<?= Url::base(true) . Yii::$app->request->url ?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a></div>
                    </div>
                    <div class="book-flight">
                        <a href="">Book Flight Now</a>
                    </div>
                </div>
            </div>
            <div class="summary border-box">
                <?= Html::encode($blog_article_model['summary']) ?>
            </div>
            <div class="body">
                <div class="columns flex flex-justify-between">
                    <div class="column">
                        <?php echo $blog_article_model->body_column_1; ?>
                    </div>
                    <div class="column">
                        <?php echo $blog_article_model->body_column_2; ?>
                    </div>
                </div>
            </div>
        </div>
        <?= BlogSidebarRight::widget() ?>
    </div>
</div>