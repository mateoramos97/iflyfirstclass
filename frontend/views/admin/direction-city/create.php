<?php
use yii\widgets\ActiveForm;
use app\components\widgets\adminimagemanager\AdminImageFormWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $direction_city_model \common\sys\repository\landing\models\DirectionCityModel */
?>
Create Direction City
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'continent_crate',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($direction_city_model, 'id')->hiddenInput()->label(false) ?>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'name') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'browser_title') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'description')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'keywords')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($direction_city_model, 'alias') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($direction_city_model, 'title') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($direction_city_model, 'sub_title') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'first_class_price')->textInput([
            'type' => 'number'
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'first_class_old_price')->textInput([
            'type' => 'number'
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'business_class_price')->textInput([
            'type' => 'number'
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($direction_city_model, 'business_class_old_price')->textInput([
            'type' => 'number'
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($direction_city_model, 'summary')->textarea(['rows' => 10]) ?>
    </div>

    <?= $form->field($direction_city_model, 'body')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

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

