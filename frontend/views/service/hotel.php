<?php

use app\components\widgets\request\RequestHotel;
use yii\helpers\Html;
use \yii\helpers\Url;

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/img-poster-hotel.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = ['label' => 'Service', 'template' => '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">{link}<meta itemprop="position" content="2"></li>'];
$this->params['breadcrumbs'][] = 'Hotels';

?>
<div class="welcome-block-wrapper">
    <div class="back-slide">
        <div class="back-slide-inner">
            <img src="<?= Url::base(true) . '/design/photo/img-poster-hotel.jpg' ?>" alt="" />
        </div>
    </div>
    <div class="welcome-block container-wrapper flex flex-justify-between">
    <div class="content flex flex-column flex-align-start">
            <h1>Hotel bookings</h1>
            <div class="title-form">
                The Lowest Prices on Business & First class Guaranteed
            </div>
            <div class="phone">
                Call US Now to Book Your Flight
                <div class="flex flex-align-center">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAGKADAAQAAAABAAAAGAAAAADiNXWtAAACiElEQVRIDbVWTWhTQRD+5uWpiAhapdRWSjAVgwRB0IPgQRAFLdR6sQF7iQfFi5AKoghqT4IgngOVXhSql2IxXkTwZIs/eBIsVBGVIjloQaWoTdaZ3ebt2+Y170XswAszuzPf7M7OTwhNSJ3s2YoqjgGql78MFHVqdVKzAL3jr4wUHtDdmc/LwVDUhsrv6IRaGGbQAu+nonRCa1V2NAryr9LYNDt2qcGByvf0Qak7DL7eVY2T6DuIBmlsZiKs6YUFlc+cA2rjrYMLihyoNm4wLGpwA31yAVdwnFrVhByhBnjH6zfRDhZj/jY4+Y0y0J01iPM/gcv9wOz7hB5ETcLlZ+VNzGnNg9qYt3VYsLXrgOxeKyfiOFwak++iU9FkizX9VrG8cF0ZV04kqYJgeybPl6Ri5aMLsbnLlZNJKcHmEEkRLaHXT+2C4jebemTlljjVKw4a7//yCS8r/hi8dAmY5Ef/J1IZLyj/MMAcv8Gzh8Cf38CbqfBOazy3FpNFUWb3bnIKcJc4NcxZF5RLlGbTNQ+6cUXoVD4B928Buw8AA+cjFBIsMXbqWq7tKKtuj1SffgV0pIHDg4C/msM1adX2c5MdGAK25YBNW4Bf88CPObsvHNFzn3/5BdURdycklS4aof8skN4J3L4C5PYBp6+7oZOKL+wKGQpLZdKFtlD7wBIHvAn1nQFOFLmfcXdetcYFr5vlnYSswvfSnhkW3M/jaKIEDB0CXjyO01zcp1HBjm52cRAb2oE9B00CtHcDG1n++gW4UK9Z2+yC/Fupdh3UgenfVITu53FXWGZf21KxPgtEK7hB3WRFR6b2KDOVhwX7HmGZUyaWZOiPmAHjzmOxbLhBGO5//G35C/0v3OPMg3n2AAAAAElFTkSuQmCC
" alt="">
                    <span>1 888 347 7817</span>
                </div>
            </div>
        </div>
        <?= RequestHotel::widget() ?>
    </div>
</div>