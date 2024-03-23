<?php
/* @var $this yii\web\View */
/* @var $travel_tips_model \common\sys\repository\traveltips\models\TravelTips */

use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\custom\BlogSidebarRight;
use app\components\widgets\request\FlightRequestMin;

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
	<div class="flex items-center justify-center bg-secondary">
		<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
	</div>
	<div>
		<div class="container mx-auto box-border xl:mt-10 xl:px-32 px-4 text-center mt-28 mb-10">
			<h1 class="font-silk-serif-bold"><?= Html::encode($travel_tips_model->title);  ?></h1>
		</div>
		<div class="blog-poster-wrapper">
			<div class="back-slide" style="background-image: url(<?= $path_img . Html::encode($images[0]['alias']) ?>); background-position: center">
				<div class="container mx-auto welcome-block container-wrapper grid grid-cols-12 items-center">
					<div class="content xl:flex flex-col hidden align-center pt-8 px-12 xl:col-span-7 justify-end h-full">
						<div class="my-16 text-3.2xl font-semibold">
							<p class="text-white bg-black px-5 pt-5 pb-1 font-gilroy-regular w-fit">Enjoy The Best Service</p>
							<p class="text-white bg-black px-5 pb-5 font-gilroy-regular w-fit">and Save Thousands</span></p>
							<div class="share-facebook bg-black w-fit px-5 pb-5">
								<div id="fb-root"></div>
								<div class="fb-share-button" data-href="<?= Url::base(true) . Yii::$app->request->url ?>" data-layout="button" data-size="large">
									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
										<img src="/public/img/fb-share.svg" alt="fb-share" width="100" height="60">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-block-wrapper xl:p-12 p-6 xl:col-span-5 col-span-12">
						<?= FlightRequestMin::widget() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container mx-auto container-wrapper box-border mt-20 mb-10">
		<div class="grid grid-cols-12 px-10">
			<div class="content xl:col-span-9 col-span-12 xl:pr-20 pr-0">
				<div class="items">
					<?php foreach($travel_tips_attactions as $index => $item): ?>
						<div class="item">
							<h3 class="title font-silk-serif-bold xl:text-4.8xl my-8">
								<?= Html::encode($item['title']) ?>
							</h3>
							<div class="img-poster">
								<img
										src="<?= $path_img. Html::encode($item['images'][0]['alias']); ?>"
										title="<?= Html::encode($item['images'][0]['title']) ?>"
										alt="<?= Html::encode($item['images'][0]['title']) . " - IFlyFirstClass" ?>">
							</div>
							<div class="body mt-14">
								<?php echo $item['body']; ?>
							</div>
							<?php if($index + 1 < count($travel_tips_attactions)): ?>
								<hr class="my-5">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-span-3 xl:block hidden">
       			 <?= BlogSidebarRight::widget() ?>
			</div>
		</div>
		<div class="px-10 mt-10">
			<hr>
		</div>
		<div class="mt-14 xl:block hidden">
			<div class="flex items-center justify-between px-10">
				<h2 class="font-silk-serif-bold">News</h2>
				<div class="flex gap-3">
					<i class="swiper-button icon-arrow-left p-4 border border-gray-light rounded swiper-prev"></i>
					<i class="swiper-button icon-arrow-right p-4 border border-gray-light rounded swiper-next"></i>
				</div>
			</div>
			<div class="blog-list mt-3 swiper">
				<div class="items swiper-wrapper">
					<?php foreach($blog_articles as $article): ?>
						<div class="swiper-slide">
							<?= $this->render('@app/views/blog/_list', ['model' => $article]) ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
    </div>
</div>