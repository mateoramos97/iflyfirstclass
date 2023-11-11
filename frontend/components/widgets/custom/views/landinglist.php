<?php
use yii\helpers\Html;
use \yii\helpers\Url;
?>
<div class="columns">
    <div class="column column-1">
        <div class="title">
            Top destination Countries
        </div>
        <div class="body">
            <ul>
                <?php foreach($countries as $item): ?>
                    <li><a href="<?= Url::to(['country/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="column column-3">
        <div class="title">
            Top airline deals
        </div>
        <div class="body">
            <ul>
                <?php foreach($airline as $item): ?>
                    <li><a href="<?= Url::to(['airline/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="column column-2">
        <div class="title">
            Top destination Cities
        </div>
        <div class="body">
            <ul>
                <?php foreach($cities as $item): ?>
                    <li><a href="<?= Url::to(['city/index', 'alias' => $item->alias]); ?>"><?= Html::encode($item->name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>