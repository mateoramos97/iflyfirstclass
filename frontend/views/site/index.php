<?php

/* @var $this yii\web\View */
/* @var $top_articles_in_list \common\sys\repository\blog\models\BlogArticles */

use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\custom\LandingListWidget;
use app\components\widgets\request\FlightRequestMax;

$this->title = $head_title;

$path_icons =  Url::base().'/design/icons/';
$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';

?>

<div class="welcome-block-wrapper">
    <div class="back-slide">
        <div class="back-slide-inner">
            <img src="<?= Url::base().'/design/front-back.jpg' ?>" alt="">
        </div>
        <div class="texture"></div>
    </div>
    <div class="welcome-block container-wrapper flex flex-justify-between">
        <div class="content flex flex-align-center">
            <div>
                <div class="title-form">
                    The <span>Lowest Prices</span> on Business & First class <span class="guarantee">Guaranteed</span>
                </div>
                <h1>First and Business class flights</h1>
                <div class="phone">
                    Call US Now to Book Your Flight
                    <div class="flex flex-align-center">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAGKADAAQAAAABAAAAGAAAAADiNXWtAAACiElEQVRIDbVWTWhTQRD+5uWpiAhapdRWSjAVgwRB0IPgQRAFLdR6sQF7iQfFi5AKoghqT4IgngOVXhSql2IxXkTwZIs/eBIsVBGVIjloQaWoTdaZ3ebt2+Y170XswAszuzPf7M7OTwhNSJ3s2YoqjgGql78MFHVqdVKzAL3jr4wUHtDdmc/LwVDUhsrv6IRaGGbQAu+nonRCa1V2NAryr9LYNDt2qcGByvf0Qak7DL7eVY2T6DuIBmlsZiKs6YUFlc+cA2rjrYMLihyoNm4wLGpwA31yAVdwnFrVhByhBnjH6zfRDhZj/jY4+Y0y0J01iPM/gcv9wOz7hB5ETcLlZ+VNzGnNg9qYt3VYsLXrgOxeKyfiOFwak++iU9FkizX9VrG8cF0ZV04kqYJgeybPl6Ri5aMLsbnLlZNJKcHmEEkRLaHXT+2C4jebemTlljjVKw4a7//yCS8r/hi8dAmY5Ef/J1IZLyj/MMAcv8Gzh8Cf38CbqfBOazy3FpNFUWb3bnIKcJc4NcxZF5RLlGbTNQ+6cUXoVD4B928Buw8AA+cjFBIsMXbqWq7tKKtuj1SffgV0pIHDg4C/msM1adX2c5MdGAK25YBNW4Bf88CPObsvHNFzn3/5BdURdycklS4aof8skN4J3L4C5PYBp6+7oZOKL+wKGQpLZdKFtlD7wBIHvAn1nQFOFLmfcXdetcYFr5vlnYSswvfSnhkW3M/jaKIEDB0CXjyO01zcp1HBjm52cRAb2oE9B00CtHcDG1n++gW4UK9Z2+yC/Fupdh3UgenfVITu53FXWGZf21KxPgtEK7hB3WRFR6b2KDOVhwX7HmGZUyaWZOiPmAHjzmOxbLhBGO5//G35C/0v3OPMg3n2AAAAAElFTkSuQmCC
    " alt="">
                        <span>1 888 347 7817</span>
                    </div>
                </div>
                <img src="<?= $path_icons. 'as-seen-on.png' ?>" alt="">
            </div>
        </div>
        <div class="form-block-wrapper">
            <?= FlightRequestMax::widget() ?>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="recently-flights-wrapper container-wrapper">
        <div class="head-block flex flex-justify-between">
            <div class="flex flex-align-center"><h3>Best Deals</h3></div>
            <div class="flex">
                <div class="shopper-approved flex flex-align-center">
                    <a href="https://www.shopperapproved.com/reviews/iflyfirstclass.com" target="_blank">
                        <img src="<?= $path_icons. 'shopper-approved-color-logo.svg' ?>" alt="">
                    </a>
                    <span>5.0</span>
                    <img src="<?= $path_icons. 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons. 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons. 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons. 'rating-star.svg' ?>" class="star" alt="">
                    <img src="<?= $path_icons. 'rating-star.svg' ?>" class="star" alt="">
                </div>
                <div class="separate-line flex flex-align-center"></div>
                <div class="flex flex-align-center">
                    <img src="<?= $path_icons. 'bitmap_3.png' ?>" alt="">
                </div>
            </div>
        </div>
        <div class="cities-block">
            <!-- Images Start -->
            <?php foreach($random_cities as $city_item): ?>
                <div class="item">
                    <a href="<?= Url::to(['city/index', 'alias' => $city_item['alias']]); ?>">
                        <div class="city-item">
                            <img class="photo-img" src="<?= $path_img. Html::encode($city_item['image_alias']) ?>" title="<?= Html::encode($city_item['image_title']) ?>" alt="<?= Html::encode($city_item['image_title'])." - IFlyFirstClass" ?>">
                            <div class="body border-box">
                                <div class="flex flex-justify-between flex-align-center">
                                    <div class="title">
                                        <?= Html::encode($city_item['name']) ?>
                                    </div>
                                    <div class="rating flex">
                                        <img src="<?= $path_icons. 'rating-star.svg' ?>" class="star" alt="">
                                        <span>5.0</span>
                                    </div>
                                </div>
                                <div class="cabin-class">
                                    Round trip / Business class
                                </div>
                                <div class="price-block flex flex-justify-between flex-align-center">
                                    <div class="new-price">
                                        $<?= Html::encode($city_item['business_class_price']) ?>
                                    </div>
                                    <div class="old-price">
                                        $<?= Html::encode($city_item['business_class_old_price']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <script src="<?=  Url::base().'/js/lazysizes.min.js' ?>" async></script>
            <!-- Images End -->
        </div>
    </div>
    <div class="dealth-block-wrapper border-box">
        <div class="dealth-block-inner container-wrapper flex flex-justify-between flex-align-center">
            <div class="content flex flex-column flex-align-start">
                <div class="sub-title">Top Rated Luxury Travel Agency</div>
                <h2>
                    Enjoy our Great Deals on First & Business class
                </h2>
                <div class="description">
                    I Fly First Class is your personal travel concierge. We're at your service 24/7 to meet all your travel needs. Our professional staff is dedicated to saving you time and money. We'll sort out even the most complex travel itineraries in minutes, getting you the best but least costly business class airfares. Our business flight booking division is always at your service!
                </div>
            </div>
            <div class="video-block">
                <video controls="" height="100%" width="100%" poster="<?=  Url::base().'/design/video/video-poster.jpg' ?>">
                    <source src="<?=  Url::base().'/design/video/movie.mp4' ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
    <div class="book-with-confidence border-box">
        <div class="book-with-confidence-inner container-wrapper">
            <div class="title">
                Book With Confidence
            </div>
            <div class="flex flex-justify-between">
                <div class="confidence-items">
                    <div class="item">
                        <img src="<?= $path_icons. 'book-confidence-1.svg' ?>" alt="">
                        <div class="title">
                            Unpublished Fares
                        </div>
                        <div class="body">
                            We offer discounted unpublished fares for First and Business Class Travel.
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?= $path_icons. 'book-confidence-2.svg' ?>" alt="">
                        <div class="title">
                            Expert Travel Team
                        </div>
                        <div class="body">
                            Our Experts are ready to help you with any travel plans.
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?= $path_icons. 'book-confidence-3.svg' ?>" alt="">
                        <div class="title">
                            24/7 Customer Suport
                        </div>
                        <div class="body">
                            Your peronal travel councierge available to assist you 24/7 with any travel needs.
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?= $path_icons. 'book-confidence-4.svg' ?>" alt="">
                        <div class="title">
                            Credibility & Reliability
                        </div>
                        <div class="body">
                            More then 10 years on the luxury travel market, member of Asta, Nacta, California Seller of Travel and BBB accredited.
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?= $path_icons. 'book-confidence-5.svg' ?>" alt="">
                        <div class="title">
                            Travel protection & flexibility
                        </div>
                        <div class="body">
                            Our tickets offer a Trip Protection to protect your travel investment and come with the most flexible fare rules in the industry.
                        </div>
                    </div>
                </div>
                <div class="testimonials-block">
                    <div class="shopper-approved p-relative">
                        <div style="min-height: 100px; overflow: hidden;" class="shopperapproved_widget sa_rotate sa_vertical sa_count1 sa_showdate sa_jMY sa_rounded sa_hidelinks sa_large sa_bgBlue sa_colorWhite sa_borderWhite sa_fixed"></div>
                        <script type="text/javascript" async>
                            var sa_interval = 10000; function saLoadScript(src) { var js = window.document.createElement('script'); js.src = src; js.type = 'text/javascript'; document.getElementsByTagName("head")[0].appendChild(js); } if (typeof (shopper_first) == 'undefined') saLoadScript('//www.shopperapproved.com/widgets/testimonial/3.0/12885.js'); shopper_first = true;
                        </script>
                        <div style="text-align:right;"><a href="http://www.shopperapproved.com/reviews/iflyfirstclass.com/" target="_blank" rel="nofollow" class="sa_footer"><img class="sa_widget_footer" alt="" src="https://www.shopperapproved.com/widgets/widgetfooter-darklogo.png" style="border: 0;"></a></div>
                        <div class="shopperapproved p-absolute">
                            <a href="http://www.shopperapproved.com/reviews/iflyfirstclass.com/" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; var certheight=screen.availHeight-90; window.open(this.href,'shopperapproved','location='+nonwin+',scrollbars=yes,width=620,height='+certheight+',menubar=no,toolbar=no'); return false;"><img src="https://c683207.ssl.cf2.rackcdn.com/12885-m.gif" style="border: 0" alt="" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 '+d.getFullYear()+'.'); return false;" /></a>
                        </div>
                    </div>
                    <div class="as-seen-on">
                        <div>As seen on</div>
                        <img src="<?= $path_icons. 'bitmap_2.png' ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="news-block-wrapper">
        <div class="news-inner container-wrapper flex flex-justify-between">
            <div class="news-block">
                <div class="title">
                    Our news
                </div>
                <div class="rows">
                    <?php foreach($top_articles_in_list as $item): ?>
                        <div class="row">
                            <a href="<?= Url::to(['blog/index', 'alias' => $item->alias]); ?>">
                                <?= Html::encode($item->title) ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="travel-tip-block">
                <div class="title">
                    <?= Html::encode($random_travel_tips[0]['title']) ?>
                </div>
                <div class="body">
                <img src="<?= $path_img_thumbs. Html::encode($random_travel_tips[0]['image_alias']) ?>" title="<?= Html::encode($random_travel_tips[0]['image_title']) ?>" alt="<?= Html::encode($random_travel_tips[0]['image_title'])." - IFlyFirstClass" ?>">
                    <?= Html::encode($random_travel_tips[0]['summary']) ?>
                </div>
                <div class="action">
                    <a href="<?= Url::to(['travel-tips/index', 'alias' => $random_travel_tips[0]['alias']]); ?>">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="our-philosophy-block">
        <div class="container-wrapper">
            <div class="title">
                <h3>Our Philosophy</h3>
            </div>
            <div class="columns flex flex-justify-between">
                <div class="column column-1">
                    <p>
                        Flying across the world comfortably and economically takes some effort, especially if you want to enjoy the flight amid the luxury of first or business class cabins. With IFlyFirstClass, you can forget those endless, confusing internet searches for the cheapest business and first class flights. IFFC specializes in unearthing the very lowest prices available on international airfare on all the top-rated airlines. The result is a hassle-free travel experience that offers you excellent savings, premium airfare and outstanding service.
                    </p>
                    <p>
                        Plenty of discounted business class tickets are out there, and IFFC travel experts know all the hidden places to find those deals. With the savings offered by IFFC discounts, international business class seats are accessible to all people, not just elite or affluent travelers. Many of the world’s best air carriers also offer astonishingly cheap first class tickets. These special, discounted first and business class tickets give nearly everyone a chance to enjoy the ease and comfort of premium travel. While you could spend hours searching for these deals yourself, IFFC experts find them in mere minutes. We’ll also give provide you with several premium flight deals. This variety of flight deals gives you the freedom to choose the most convenient, affordable option for your trip without sacrificing your comfort or your budget.
                    </p>
                    <h4>The Low-Down on First, Business and Economy Class Seats</h4>
                    <p>
                        In domestic and international travel, the differences between first and business class are wide-ranging. While the assumption is often that first class is always far more luxurious than business class, that’s not always the case. In fact, on routes where first class is not offered, business class seats often rival first class accommodations. Still, where both options are available, first class is usually significantly more opulent than business class. First class seats are generally more spacious and they usually recline to a fully flat position. First class fliers also often enjoy more deluxe meals, complimentary cocktails, more personalized in-flight service and better amenities. Services at first class airport lounges are generally more elaborate than business class lounge amenities as well.
                    </p>
                    <p>
                        On lengthy international flights, the differences between first and business classes are even more marked. Most first class cabins now feature lie-flat seats with bed turndown service and greater privacy; some even offer completely private first class suites. IFlyFirstClass gives you entree to all the best business and first class deals to popular Asian routes, including China, Hong Kong, Malaysia, Singapore, Taiwan, Thailand, South Korea and Japan. Our deals also include routes to Australian cities such as Melbourne, Sydney and Brisbane and New Zealand destinations like Auckland and Wellington. Of course, IFFC is also the specialist on cheap first class and business class deals to European routes, including the U.K., France, Germany, Switzerland, Belgium and the Netherlands as well as Middle Eastern destinations like Dubai and Abu Dhabi.
                    </p>
                </div>
                <div class="column column-2">
                    <p>
                        The most notable differences in flight classes are found between coach and business class seating, where the disparities are large. As a business class traveler, you enjoy a variety of amenities that will make your journey pleasurable, beginning with extra-wide seats and extended leg room. The in-flight service in business class cabins is attentive and designed to give you the most comfortable flight possible. That comfort usually includes more private seating, extra storage space, an extensive culinary menu, a large selection of beverages and cocktails and access to additional data and electrical ports. The business class entertainment offerings often include a wide variety of movies, music and games so you can enjoy a little downtime during your flight.
                    </p>
                    <p>
                        In contrast to business class seats, economy seats are often smaller and much less private, frequently requiring extra fees for additional legroom, checked baggage, cocktails, meals and entertainment. Business class fliers often have access to well-appointed airport lounges and expedited security checkpoints, while economy class travelers must contend with lengthy checkpoint lines and overcrowded public waiting rooms.
                    </p>
                    <p>
                        Wherever and whenever you need to travel, IFFC is here to provide the cheapest luxury flights available. Customer service is our ultimate goal so we offer you discounted first and business class tickets on convenient routes operated by the most dependable airlines. This ensures that you have a travel experience that is comfortable, reliable and filled with the industry’s most hospitable services.
                    </p>
                    <h4>Last Minute Luxury for Less</h4>
                    <p>
                        Our IFFC expert services are also available for last minute flights, giving you peace of mind that you can fly safely and comfortably, even if your travel arises unexpectedly. Whether you need to travel to deal with a sudden business issue or just want to take an impromptu holiday, we can find cheap business class deals to Europe, Asia, Africa and Oceania at a moment’s notice. This ensures that you won’t fall prey to the usual last minute flight charges and price increases.
                    </p>
                    <h4>Getting First Class and Business Class Flight Deals</h4>
                    <p>
                        Accessing our deals is easy. Simply go to our website, type in your travel dates and destination, and we will provide you a quick, free quote.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('_airlines-logo') ?>
    <?= $this->render('_landing-block', [
        'countries' => $countries,
        'cities' => $cities,
        'airlines' => $airlines,
    ]) ?>
    <?= $this->render('_guarantee-info') ?>
</div>