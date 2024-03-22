<?php
use yii\helpers\Html;
use \yii\helpers\Url;

$path_icons =  Url::base().'/design/icons/';
?>

<div class="box-border">
	<div class="landing-columns grid xl:grid-cols-3 grid-cols-1 xl:gap-32 gap-20">
		<div class="column">
			<h5 class="title">
				Top Destination Countries
			</h5>
			<ul class="mt-8 columns-3">
				<?php foreach($countries as $item): ?>
					<li class="mb-6"><a href="<?= Url::to(['country/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="column">
			<h5 class="title">
				Top Destination Cities
			</h5>
			<ul class="mt-8 columns-3">
				<?php foreach($cities as $item): ?>
					<li class="mb-6"><a href="<?= Url::to(['city/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="column">
			<h5 class="title">
				Top airline deals
			</h5>
			<ul class="mt-8 columns-2">
				<?php foreach($airlines as $item): ?>
					<li class="mb-6"><a href="<?= Url::to(['airline/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="landing-more-link w-full">
		<div class="mt-10 text-center">
			<a href="javascript:void(0)" class="mx-auto rounded-full py-2 px-2 bg-secondary xl:w-fit w-full flex items-center" onclick="readMoreLanding(this)">
				<img src="/public/img/download-fill.svg" alt="download-img" width="40" height="40">
				<p class="font-semibold grow px-5">Show More Destination</p>
			</a>
		</div>
	</div>
</div>
