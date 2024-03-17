<?php
use yii\helpers\Html;
use \yii\helpers\Url;
?>
<div class="flex justify-between gap-10">
    <div>
        <h4 class="mb-8">
            Top Destination Countries
        </h4>
		<ul class="grid grid-cols-4 gap-y-5 gap-x-10">
			<?php foreach($countries as $item): ?>
				<li><a href="<?= Url::to(['country/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
			<?php endforeach; ?>
		</ul>
    </div>
    <div>
		<h4 class="mb-7">
            Top Destination Cities
        </h4>
		<ul class="grid grid-cols-5 gap-y-5 gap-x-10">
			<?php foreach($cities as $item): ?>
				<li><a href="<?= Url::to(['city/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
			<?php endforeach; ?>
		</ul>
    </div>
</div>