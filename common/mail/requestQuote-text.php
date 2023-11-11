<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\sys\models\request\RequestCorporateAccounts */

?>
New Corporate Account Message
Name : <?= Html::encode($model->name); ?>
Cell Phone : <?= Html::encode($model->cell_phone); ?>
Work Phone : <?= Html::encode($model->work_phone); ?>
Email : <?= Html::encode($model->email); ?>
From : <?= Html::encode($model->from); ?>
To : <?= Html::encode($model->to); ?>
Departure Date : <?= Html::encode($model->dep_date); ?>
Return Date : <?= Html::encode($model->arr_date); ?>
Best Fare Quoted ($) : <?= Html::encode($model->fare); ?>
Message : <?= Html::encode($model->message); ?>