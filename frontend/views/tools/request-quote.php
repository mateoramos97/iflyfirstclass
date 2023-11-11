<?php

/* @var $this yii\web\View */

use \yii\helpers\Url;
use yii\helpers\Html;
use app\components\widgets\request\RequestQuoteForm;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Request Quote';

?>

<div class="request-quote-title">
    <h1>Request Quote</h1>
</div>
<div class="form-request-wrapper">
    <div class="form-request">
        <?= RequestQuoteForm::widget() ?>
    </div>
</div>
