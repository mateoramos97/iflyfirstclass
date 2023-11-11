<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model \common\sys\repository\blockedEmails\models\BlockedEmails */

?>
Add email
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'block_email',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <div class="col-md-6">
        <?= $form->field($model, 'email') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg', 'name' => 'block-email-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>