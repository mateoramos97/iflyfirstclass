<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use \yii\helpers\StringHelper;

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';
?>
<div class="landing-sidebar-right">
	<div class="bg-secondary rounded-xl p-8 flex flex-col justify-between">
		<div>
			<div class="flex items-center">
				<div class="w-12 h-12 rounded-full flex justify-center items-center" style="background-color:<?= $review['initials-color'] ?>">
					<p class="text-white text-lg font-bold"><?= $review['initials'] ?></p>
				</div>
				<div class="ml-5">
					<h6><?= $review['author'] ?></h6>
					<span class="mt-2 text-sm"><?= $review['address'] ?></span>
				</div>
			</div>
			<div class="my-8">
				<?= $review['body'] ?>
			</div>
		</div>
		<a class="flex justify-between items-center" href="http://www.shopperapproved.com/reviews/iflyfirstclass.com/" target="_blank" rel="nofollow">
			<img src="/public/img/shopper-approved-small.svg" alt="">
		</a>
	</div>
    <div itemprop="description" class="summary-sidebar-block">
        <?php echo $summary_sidebar; ?>
    </div>
    <div class="news-sidebar-block mt-7">
        <p class="font-silk-serif-medium text-3xl mt-4">
            Blog
        </p>
        <div class="news mt-4">
            <a class="w-full" href="<?= Url::to(['blog/index', 'alias' => $last_artical['alias']]); ?>">
                <img class="rounded-xl w-full aspect-square object-cover " src="<?= $path_img_thumbs. Html::encode($last_artical_img['alias']) ?>"
                     title="<?= Html::encode($last_artical_img['title']) ?>"
                     alt="<?= Html::encode($last_artical_img['title'])." - IFlyFirstClass" ?>">
            </a>
            <a class="font-gilroy-semibold text-xl block mt-5" href="<?= Url::to(['blog/index', 'alias' => $last_artical['alias']]); ?>" class="title">
                <?= Html::encode($last_artical['title']) ?>
            </a>
            <p class="text-gray-2 text-xs mt-3">
                <?= StringHelper::truncate($last_artical['summary'],225,'...') ?>
            </p>
        </div>
    </div>
</div>