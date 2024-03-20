<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use \yii\helpers\StringHelper;

$path_img =  Url::base().'/public/images/';
$path_img_thumbs =  Url::base().'/public/images/thumbs/';
?>
<div class="blog-sidebar-right">
	<?php foreach ($reviews as $review): ?>
		<div class="bg-secondary rounded-xl p-8 flex flex-col justify-between mb-8">
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
	<?php endforeach; ?>
</div>