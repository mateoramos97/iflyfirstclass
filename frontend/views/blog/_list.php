<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use \yii\helpers\Url;
use \yii\helpers\StringHelper;

$path_img = Url::base() . '/public/images/';
$path_img_thumbs = Url::base() . '/public/images/thumbs/';
?>
<div class="item border-box">
    <div class="item-inner">
        <div class="photo">
            <div class="back-slide">
                <div class="back-slide-inner">
                    <a href="<?= Url::to(['blog/index', 'alias' => $model['alias']]); ?>">
                        <img
                            src="<?= $path_img_thumbs . Html::encode($model['image_alias']) ?>"
                            title="<?= Html::encode($model['image_title']) ?>"
                            alt="<?= Html::encode($model['image_title']) . " - IFlyFirstClass" ?>"
							width="405"	height="310"
						>
                    </a>
                </div>
            </div>
        </div>
        <div class="inner border-box">
            <a href="<?= Url::to(['blog/index', 'alias' => $model['alias']]); ?>" class="title">
                <?= Html::encode($model['title']) ?>
            </a>
            <div class="summary">
                <?= StringHelper::truncate($model['summary'], 225, '...') ?>
            </div>
        </div>
    </div>
</div>