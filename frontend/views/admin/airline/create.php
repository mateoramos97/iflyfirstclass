<?php
use yii\widgets\ActiveForm;
use app\components\widgets\adminimagemanager\AdminImageFormWidget;
use yii\helpers\Html;

/* @var $airline_model \common\sys\repository\landing\models\Airline */

?>
create Airline
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'blog_article_crate',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($airline_model, 'id')->hiddenInput()->label(false) ?>
    <div class="col-md-4">
        <?= $form->field($airline_model, 'name') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($airline_model, 'browser_title') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($airline_model, 'description')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($airline_model, 'keywords')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($airline_model, 'title') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($airline_model, 'sub_title') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($airline_model, 'alias') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($airline_model, 'summary')->textarea(['rows' => 10]) ?>
    </div>

    <?= $form->field($airline_model, 'body_column_1')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>
    <?= $form->field($airline_model, 'body_column_2')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <div class="uploads_photo">
        <p class="center_data upload_title">Image to Poster</p>
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