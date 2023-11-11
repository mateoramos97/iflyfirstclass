<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\sys\models\request\RequestCorporateAccounts */

?>
<p>New Corporate Account Message</p>
<p>
    <strong>Name</strong> : <?= Html::encode($model->name); ?>
</p>
<p>
    <strong>Cell Phone</strong> : <?= Html::encode($model->cell_phone); ?>
</p>
<p>
    <strong>Work Phone</strong> : <?= Html::encode($model->work_phone); ?>
</p>
<p>
    <strong>Email</strong> : <?= Html::encode($model->email); ?>
</p>
<p>
    <strong>From</strong> : <?= Html::encode($model->from); ?>
</p>
<p>
    <strong>To</strong> : <?= Html::encode($model->to); ?>
</p>
<p>
    <strong>Departure Date</strong> : <?= Html::encode($model->dep_date); ?>
</p>
<p>
    <strong>Return Date</strong> : <?= Html::encode($model->arr_date); ?>
</p>
<p>
    <strong>Best Fare Quoted ($)</strong> : <?= Html::encode($model->fare); ?>
</p>
<p>
    <strong>Message</strong> : <?= Html::encode($model->message); ?>
</p>