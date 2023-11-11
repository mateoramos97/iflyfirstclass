<?php
use yii\helpers\Html;
use \yii\helpers\Url;
?>
<div class="columns container-wrapper flex flex-justify-between border-box">
    <div class="column column-1 flex-1">
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
    <div class="column column-2 flex-1">
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
</div>