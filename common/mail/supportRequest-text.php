<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SupportForm */

?>
New Message Request
Name : <?= Html::encode($model->name); ?>
Email: <?= Html::encode($model->email); ?>
Message: <?= Html::encode($model->message); ?>