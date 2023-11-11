<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $static_page_model \common\sys\repository\seo\models\StaticPage */
?>
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'static_page_edit',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($static_page_model, 'id')->hiddenInput()->label(false) ?>
    <?= $form->field($static_page_model, 'admin_title')->hiddenInput()->label(false) ?>
    <div class="col-md-6">
        <?= $form->field($static_page_model, 'title') ?>
    </div>
    <div class="col-md-6 .col-md-offset-4">
        <?= $form->field($static_page_model, 'description')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($static_page_model, 'keywords')->textarea(['rows' => 4]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
