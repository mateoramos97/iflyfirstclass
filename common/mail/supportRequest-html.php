<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SupportForm */

?>
<p>New Message Request</p>
<p>
    <strong>Name</strong> : <?= Html::encode($model->name); ?>
</p>
<p>
    <strong>Email</strong> : <?= Html::encode($model->email); ?>
</p>
<p>
    <strong>Message</strong> : <?= Html::encode($model->message); ?>
</p>