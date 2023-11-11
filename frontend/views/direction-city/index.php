<?php

/* @var $this yii\web\View */
/* @var $direction_city_model \common\sys\repository\landing\models\DirectionCityModel */

use app\components\widgets\custom\LandingSidebarRight;
use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\request\FlightRequestMax;

$this->title = $direction_city_model->browser_title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $direction_city_model->browser_title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $direction_city_model->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/public/images/' . $images[0]['alias']]);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = Html::encode($direction_city_model['name']);

$path_img = Url::base() . '/public/images/';
$path_img_thumbs = Url::base() . '/public/images/thumbs/';
?>

<div itemscope="" itemtype="http://schema.org/Product">
    <div class="welcome-block-wrapper">
        <div class="back-slide">
            <div class="back-slide-inner">
                <img
                    itemprop="image"
                    src="<?= $path_img . Html::encode($images[0]['alias']) ?>"
                    title="<?= Html::encode($images[0]['title']) ?>"
                    alt="<?= Html::encode($images[0]['title']) . " - IFlyFirstClass" ?>">
            </div>
            <div class="texture"></div>
        </div>
        <div class="welcome-block container-wrapper flex flex-justify-between">
            <div class="content flex flex-align-center">
                <div>
                    <div class="title-form">First and Business class flights</div>
                    <h1>
                        <span itemprop="name">Flights to <?= Html::encode($direction_city_model['name']) ?></span>
                    </h1>
                    <div class="phone">
                        Call US Now to Book Your Flight
                        <div class="flex flex-align-center">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAGKADAAQAAAABAAAAGAAAAADiNXWtAAACiElEQVRIDbVWTWhTQRD+5uWpiAhapdRWSjAVgwRB0IPgQRAFLdR6sQF7iQfFi5AKoghqT4IgngOVXhSql2IxXkTwZIs/eBIsVBGVIjloQaWoTdaZ3ebt2+Y170XswAszuzPf7M7OTwhNSJ3s2YoqjgGql78MFHVqdVKzAL3jr4wUHtDdmc/LwVDUhsrv6IRaGGbQAu+nonRCa1V2NAryr9LYNDt2qcGByvf0Qak7DL7eVY2T6DuIBmlsZiKs6YUFlc+cA2rjrYMLihyoNm4wLGpwA31yAVdwnFrVhByhBnjH6zfRDhZj/jY4+Y0y0J01iPM/gcv9wOz7hB5ETcLlZ+VNzGnNg9qYt3VYsLXrgOxeKyfiOFwak++iU9FkizX9VrG8cF0ZV04kqYJgeybPl6Ri5aMLsbnLlZNJKcHmEEkRLaHXT+2C4jebemTlljjVKw4a7//yCS8r/hi8dAmY5Ef/J1IZLyj/MMAcv8Gzh8Cf38CbqfBOazy3FpNFUWb3bnIKcJc4NcxZF5RLlGbTNQ+6cUXoVD4B928Buw8AA+cjFBIsMXbqWq7tKKtuj1SffgV0pIHDg4C/msM1adX2c5MdGAK25YBNW4Bf88CPObsvHNFzn3/5BdURdycklS4aof8skN4J3L4C5PYBp6+7oZOKL+wKGQpLZdKFtlD7wBIHvAn1nQFOFLmfcXdetcYFr5vlnYSswvfSnhkW3M/jaKIEDB0CXjyO01zcp1HBjm52cRAb2oE9B00CtHcDG1n++gW4UK9Z2+yC/Fupdh3UgenfVITu53FXWGZf21KxPgtEK7hB3WRFR6b2KDOVhwX7HmGZUyaWZOiPmAHjzmOxbLhBGO5//G35C/0v3OPMg3n2AAAAAElFTkSuQmCC
    " alt="">
                                <span>1 888 347 7817</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-block-wrapper">
                <?= FlightRequestMax::widget() ?>
            </div>
        </div>
    </div>
    <div class="highlight-block-wrapper">
        <div class="container-wrapper flex flex-justify-between flex-align-center">
            <div class="specials-block">
                <div class="title">
                    Special offer to <?= Html::encode($direction_city_model['name']) ?>
                </div>
                <div class="columns flex">
                    <div class="column column-1">
                        <div class="subtitle">Business Class</div>
                        <div class="price-old">
                            Price:
                            <span>$<?= Html::encode($direction_city_model['business_class_old_price']) ?></span>
                        </div>
                        <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="price-new">
                            <meta itemprop="priceCurrency" content="USD">
                                Now:
                                <span>$</span>
                                <span
                                    itemprop="price"><?= Html::encode($direction_city_model['business_class_price']) ?></span>
                        </div>
                    </div>
                    <div class="column column-2">
                        <div class="subtitle">First Class</div>
                        <div class="price-old">
                            Price:
                            <span>$<?= Html::encode($direction_city_model['first_class_old_price']) ?></span>
                        </div>
                        <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="price-new">
                            <meta itemprop="priceCurrency" content="USD">
                                Now:
                                <span>$</span>
                                <span itemprop="price"><?= Html::encode($direction_city_model['first_class_price']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery flex flex-justify-between">
                <img
                    itemprop="image"
                    src="<?= $path_img_thumbs . Html::encode($images[1]['alias']) ?>"
                    title="<?= Html::encode($images[1]['title']) ?>"
                    alt="<?= Html::encode($images[1]['title']) . " - IFlyFirstClass" ?>">
                    <img
                        itemprop="image"
                        src="<?= $path_img_thumbs . Html::encode($images[2]['alias']) ?>"
                        title="<?= Html::encode($images[2]['title']) ?>"
                        alt="<?= Html::encode($images[2]['title']) . " - IFlyFirstClass" ?>">
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container-wrapper flex flex-justify-between border-box">
            <div class="content">
                <div class="body">
                    <h2><?= Html::encode($direction_city_model['sub_title']) ?></h2>
                    <div class="columns">
                        <?php echo $direction_city_model->body; ?>
                    </div>
                </div>
                <a href="#" class="send-request-link-form">Send Request</a>
            </div>
            <?= LandingSidebarRight::widget(['summary_sidebar' => $direction_city_model->summary]) ?>
        </div>
    </div>
</div>
