<?php

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' =>  '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Blog';

?>

<div class="welcome-block-wrapper bg-blue-white-gradient pb-12 xl:mt-0 mt-20">
	<div class="flex items-center justify-center border-b border-gray-light-3">
		<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
	</div>
    <div class="container mx-auto xl:px-12 px-4 mt-10">
        <h1 class="xl:text-9xl lg:text-8xl text-5xl font-silk-serif-bold text-center drop-shadow-2xl">Travel Blog</h1>
    </div>
</div>
<div class="page-content container mx-auto xl:px-12 px-4">
    <div class="page-content-inner border-box">
            <?php
                echo ListView::widget([
                    'dataProvider' => $blog_articles,
                    'options' => [
                        'tag' => 'div',
                        'class' => 'blog-list container-wrapper',
                        'id' => 'blog_list',
                    ],
                    'layout' => "<div class='items'>{items}</div>\n{pager}",
                    'itemView' => '_list',
                    'itemOptions' => [
                        'tag' => false,
                        //'class' => 'item'
                    ],
                    'pager' => [
                        'maxButtonCount' => 10,
						'prevPageLabel' => '',
						'nextPageLabel' => '',
                    ],
                ]);
            ?>
    </div>
</div>