<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use \yii\helpers\StringHelper;
use app\components\widgets\request\FlightRequestMin;

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';
?>
<div class="blog-sidebar-right">
    <?= FlightRequestMin::widget() ?>
    <div class="testimonials-block">
        <div style="min-height: 100px; overflow: hidden;" class="shopperapproved_widget sa_rotate sa_vertical sa_count1 sa_showdate sa_jMY sa_rounded sa_hidelinks sa_large sa_bgBlue sa_colorWhite sa_borderWhite sa_fixed"></div>
        <script type="text/javascript">                                                                                                                                                                                                                                               var sa_interval = 10000; function saLoadScript(src) { var js = window.document.createElement('script'); js.src = src; js.type = 'text/javascript'; document.getElementsByTagName("head")[0].appendChild(js); } if (typeof (shopper_first) == 'undefined') saLoadScript('//www.shopperapproved.com/widgets/testimonial/3.0/12885.js'); shopper_first = true; </script><div style="text-align:right;"><a href="http://www.shopperapproved.com/reviews/iflyfirstclass.com/" target="_blank" rel="nofollow" class="sa_footer"><img class="sa_widget_footer" alt="" src="https://www.shopperapproved.com/widgets/widgetfooter-darklogo.png" style="border: 0;"></a></div>
        <div class="shopperapproved">
            <a href="http://www.shopperapproved.com/reviews/iflyfirstclass.com/" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; var certheight=screen.availHeight-90; window.open(this.href,'shopperapproved','location='+nonwin+',scrollbars=yes,width=620,height='+certheight+',menubar=no,toolbar=no'); return false;"><img src="https://c683207.ssl.cf2.rackcdn.com/12885-m.gif" style="border: 0" alt="" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 '+d.getFullYear()+'.'); return false;" /></a>
        </div>
    </div>
    <div class="news-sidebar-block">
        <div class="title">
            Our news
        </div>
        <div class="news">
            <a href="<?= Url::to(['blog/index', 'alias' => $last_artical['alias']]); ?>">
                <img src="<?= $path_img_thumbs. Html::encode($last_artical_img['alias']) ?>"
                     title="<?= Html::encode($last_artical_img['title']) ?>"
                     alt="<?= Html::encode($last_artical_img['title'])." - IFlyFirstClass" ?>">
            </a>
            <a href="<?= Url::to(['blog/index', 'alias' => $last_artical['alias']]); ?>" class="title">
                <?= Html::encode($last_artical['title']) ?>
            </a>
            <p>
                <?= StringHelper::truncate($last_artical['summary'],225,'...') ?>
            </p>
        </div>
    </div>
</div>