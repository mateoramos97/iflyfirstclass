<?php
use yii\widgets\ActiveForm;
use app\components\widgets\adminimagemanager\AdminImageFormWidget;
use yii\helpers\Html;

/* @var $travel_tips_model \common\sys\repository\traveltips\models\TravelTips */
?>
Create Travel Tip
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'continent_crate',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($travel_tips_model, 'id')->hiddenInput()->label(false) ?>
    <div class="col-md-4">
        <?= $form->field($travel_tips_model, 'description')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($travel_tips_model, 'keywords')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($travel_tips_model, 'title') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($travel_tips_model, 'browser_title') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($travel_tips_model, 'alias') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($travel_tips_model, 'summary')->textarea(['rows' => 10]) ?>
    </div>

    <div class="uploads_photo">
        <p class="center_data upload_title">Image</p>
        <?= AdminImageFormWidget::widget(
            [
                'config' => $img_params_poster['config'],
                'images' => $img_params_poster['images'],
            ]
        ); ?>
    </div>
    <?php echo is_countable($errors) && count($errors) != 0 && isset($errors['image']) ? $errors['image'][0] : '' ; ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

