<?php
use yii\helpers\Html;
use \yii\helpers\Url;
?>
<div class="flex justify-between gap-10">
    <div>
        <h5 class="mb-[47px]">
            Top Destination Countries
        </h5>
		<ul class="grid grid-cols-4 gap-y-5 gap-x-14">
			<?php foreach($countries as $item): ?>
				<li><a class="link" href="<?= Url::to(['country/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
			<?php endforeach; ?>
		</ul>
    </div>
    <div class="ml-[60px]">
		<h5 class="mb-[47px]">
            Top Destination Cities
        </h5>
		<ul class="grid grid-cols-5 gap-y-5 gap-x-14">
			<?php foreach($cities as $item): ?>
				<li><a class="link" href="<?= Url::to(['city/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
			<?php endforeach; ?>
		</ul>
    </div>
</div>