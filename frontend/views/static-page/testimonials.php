<?php
use yii\helpers\Url;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);
?>
<div class="container mx-auto xl:px-20 p-4 my-20">
    <div class="content">
        <h1>Reviews</h1>
        <div class="rows">
            <script type="text/javascript"> var sa_review_count = 20; var sa_date_format = 'F j, Y'; function saLoadScript(src) { var js = window.document.createElement("script"); js.src = src; js.type = "text/javascript"; document.getElementsByTagName("head")[0].appendChild(js); } saLoadScript('//www.shopperapproved.com/merchant/12885.js'); </script><div id="shopper_review_page"><div id="review_header"></div><div id="merchant_page"></div><div id="review_image"><a href="https://www.shopperapproved.com/reviews/iflyfirstclass.com/" target="_blank" rel="nofollow"></a></div></div>
        </div>
    </div>
</div>