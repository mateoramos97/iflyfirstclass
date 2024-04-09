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
$this->registerLinkTag(['rel' => 'preload', 'href' =>  Url::base(true) . '/design/photo/last-minyte-deals.jpg']);

$this->params['breadcrumbs'][] = 'Last minute deals';

?>

<div class="welcome-block-wrapper last-minute-deals-page">
    <div class="back-slide">
		<div class="container mx-auto welcome-block container-wrapper grid grid-cols-11 items-center">
			<div class="content xl:flex flex-col hidden align-center pt-8 px-12 col-span-5">
				<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
				<h6 class="border-b-2  border-white mt-28 w-fit text-white">Unbeatable Last Minute Prices</h6>
				<div class="title-form font-silk-serif-medium text-white 2xl:text-8xl xl:text-7xl md:text-2xl mt-3">
					<span>Last Minute Flights</span>
				</div>
				<div class="my-16">
					<span class="text-white bg-black px-3 pt-3 pb-1 font-gilroy-semibold">Call US Now to Book Your Flight️</span>
					<div class="flex items-center bg-black p-2 w-fit">
						<img class="mr-2 scale-75" src="/public/img/phone-operator.svg" alt="">
						<a class="font-gilroy-semibold text-3xl pr-2" href="tel:+18883477817">
							<span class="text-orange mr-1">+1</span> <span class="text-white">888 347 7817</span>
						</a>
					</div>
				</div>
			</div>
			<div class="form-block-wrapper xl:p-12 p-6 xl:col-span-6 col-span-11">
				<?= FlightRequestMax::widget() ?>
			</div>
		</div>
		<?= $this->render('@app/views/layouts/_support-chat') ?>
    </div>
</div>
<div class="page-content my-16">
	<div class="container mx-auto xl:px-10 px-2 grid grid-cols-12 xl:gap-5 gap-1 box-border">
		<div class="content xl:col-span-9 col-span-12 xl:pr-16 pr-0">
            <h4 class="specialsup-banner border-box">
                With IFlyFirstClass You Can Save Up to 70% on Your Last Minute Booking
            </h4>
			<div class="body mt-10 text-justify">
				<div class="column">
					<p class="text-gray-2">
						Premium travel is becoming at once more luxurious and more complicated. Billion-dollar
						aircraft upgrades, luxurious new in-air services and elaborate new exclusive lounges have
						made business and first class rates climb. At the same time, airlines are constantly
						revamping and tightening their loyalty programs and upgrade systems, forcing business class
						ticket prices and first class fares to escalate even more.
					</p>
					<p class="text-gray-2">
						To find the best last minute deals and avoid these booming costs, travelers often have to
						navigate a nerve-wracking labyrinthine network of airline points, mileage upgrades, loyalty
						clubs and alert systems. Simplifying this process and maximizing travel dollars is what I
						Fly First Class does best, so it's offering consumers a few tips and solutions for finding
						the very best last minute travel prices on business class seats and first class fares.
					</p>
					<p class="text-gray-2">
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
					<p class="text-gray-2">
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
					<p class="text-gray-2">
						Timing is especially problematic for travelers who are searching for last minute seats on
						business or first class flights. Studies show that booking a flight about 52 days prior to
						departure provides the best value, but last minute travelers don't have that flexibility. In
						these cases, consumers have three choices: pay the high rack rates, search through dozens of
						online resources for the best rate or count on a premium travel service that specializes in
						last minute first class and business class tickets.
					</p>
					<p class="text-gray-2">
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
					<p class="text-gray-2">
						Making the most of a travel budget takes single-minded determination, research and know-how.
						Consumers can find additional help with last minute first class deals and business class
						fares at IFlyFirstClass.com.
					</p>
				</div>
			</div>
			<div class="mt-10 xl:p-8 p-4 text-gray-2 flex flex-wrap gap-2 rounded-2xl border border-gray-light-2 items-start xl:justify-between justify-center">
				<p class="xl:w-3/4 text-justify">IFlyFirstClass offers cheap Business Class flights to New Zeland, save thousands on last minute Business Class tickets. Best deals on Business Class.  Special fares on Business and First Class tickets. Discounted First & Business Class airline tickets. First Class & Business Class travel deals.</p>
				<a href="#" class="btn btn-primary send-request-link-form ml-5">Book Flight Now</a>
			</div>
        </div>
		<div class="col-span-3 xl:block hidden">
        	<?= LandingSidebarRight::widget(['summary_sidebar' => '']) ?>
		</div>
    </div>
</div>
