<?php

/* @var $this yii\web\View */

use \yii\helpers\Url;
use app\components\widgets\request\FlightRequestMax;
use app\components\widgets\custom\LandingSidebarRight;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::base(true) . '/design/photo/last-minyte-deals.jpg']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Last minute deals';

?>

<div class="welcome-block-wrapper">
    <div class="back-slide">
        <div class="back-slide-inner">
            <img src="<?= Url::base(true) . '/design/photo/last-minyte-deals.jpg' ?>" alt="">
        </div>
        <div class="texture"></div>
    </div>
    <div class="welcome-block container-wrapper flex flex-justify-between">
        <div class="content flex flex-align-center">
            <div>
                <h1>Last minute flights</h1>
                <div class="sub-title">
                    Unbeatable Last Minute Prices
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
        </div>
        <div>
            <?= FlightRequestMax::widget() ?>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container-wrapper flex flex-justify-between border-box">
        <div class="content">
            <div class="specialsup-banner border-box">
                With IFlyFirstClass You Can Save Up to 70% on Your Last Minute Booking
            </div>
            <div class="body">
                <div class="columns flex flex-justify-between">
                    <div class="column">
                        <p>
                            Premium travel is becoming at once more luxurious and more complicated. Billion-dollar
                            aircraft upgrades, luxurious new in-air services and elaborate new exclusive lounges have
                            made business and first class rates climb. At the same time, airlines are constantly
                            revamping and tightening their loyalty programs and upgrade systems, forcing business class
                            ticket prices and first class fares to escalate even more.
                        </p>
                        <p>
                            To find the best last minute deals and avoid these booming costs, travelers often have to
                            navigate a nerve-wracking labyrinthine network of airline points, mileage upgrades, loyalty
                            clubs and alert systems. Simplifying this process and maximizing travel dollars is what I
                            Fly First Class does best, so it's offering consumers a few tips and solutions for finding
                            the very best last minute travel prices on business class seats and first class fares.
                        </p>
                        <p>
                            Recent changes in Delta's elite traveler upgrade policy caused a stir among corporate and
                            high-end leisure travelers, denying them the complimentary business and first class seat
                            upgrades they had come to expect. "Delta's change reminds us all that airline loyalty
                            programs can and do change all the time, so it doesn't always pay to put all your travel
                            eggs in one basket," says I Fly First Class Public Relations Director Julia Stiles.
                            "Companies with big annual travel spends are better served by shopping for the best fares
                            flight-to-flight using a discount premium travel service like I Fly First Class. Or, they
                            might want to try to leverage their existing elite loyalty status with other airlines
                            through status matching programs."
                        </p>
                        <p>
                            For small businesses and leisure travelers, the complications seem even more exaggerated.
                            Without a corporate travel department or a personal travel agent, finding the best last
                            minute business class airfare deals or the cheapest first class flights seems even more
                            daunting. For those situations, I Fly First Class recommends that consumers check out the
                            savings and point accumulation perks of travel credit cards. When properly researched, cards
                            like the Chase Sapphire Preferred, Capital One Venture and Barclaycard Arrival Plus products
                            can help consumers accumulate points that can be easily transferred to an airline or hotel
                            when they're needed.
                        </p>
                    </div>
                    <div class="column">
                        <p>
                            Timing is especially problematic for travelers who are searching for last minute seats on
                            business or first class flights. Studies show that booking a flight about 52 days prior to
                            departure provides the best value, but last minute travelers don't have that flexibility. In
                            these cases, consumers have three choices: pay the high rack rates, search through dozens of
                            online resources for the best rate or count on a premium travel service that specializes in
                            last minute first class and business class tickets.
                        </p>
                        <p>
                            If consumers are set on booking last minute flights themselves, I Fly First Class has a few
                            extra tips to help them find the best first class deals and cheapest last minute business
                            class fares. First, travelers should book their airfare during weekdays, preferably on a
                            Tuesday or Wednesday. Airlines file fares to reservation systems four times a day during the
                            week, but only once on weekend days. Most airlines' special sales usually launch on Monday
                            evenings, making Tuesday morning the best time to search for a last minute business class
                            deal. Second, travelers should consider non-direct flights. Recent surveys show that adding
                            one stop to a flight can save passengers as much as 50 percent, particularly on last minute
                            flights. And, as I Fly First Class always recommends, consumers should look at routes at
                            alternate airports near the departure/destination.
                        </p>
                        <p>
                            Making the most of a travel budget takes single-minded determination, research and know-how.
                            Consumers can find additional help with last minute first class deals and business class
                            fares at IFlyFirstClass.com.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?= LandingSidebarRight::widget(['summary_sidebar' => '']) ?>
    </div>
</div>
