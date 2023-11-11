<?php
use yii\widgets\ActiveForm;
use app\components\widgets\adminimagemanager\AdminImageFormWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $testimonials_model \common\sys\repository\testimonials\models\Testimonials */

?>
Create Testimonial
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'blog_article_crate',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($testimonials_model, 'id')->hiddenInput()->label(false) ?>
    <div class="col-md-6">
        <?= $form->field($testimonials_model, 'shopperapproved_id') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($testimonials_model, 'author') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($testimonials_model, 'address') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($testimonials_model, 'field_created_date') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($testimonials_model, 'body')->textarea(['rows' => 10]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($testimonials_model, 'rating')->dropDownList(
            [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5'
            ]
        ); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($testimonials_model, 'is_top')->checkbox(['uncheck' => '0'], false)->label('Show in Home Page') ?>
    </div>

    <div class="uploads_photo">
        <p class="center_data upload_title">Image</p>
        <?= AdminImageFormWidget::widget(
            [
                'config' => $img_params['config'],
                'images' => $img_params['images'],
            ]
        ); ?>
    </div>
    <?php echo is_countable($errors) && count($errors) != 0 && isset($errors['image']) ? $errors['image'][0] : '' ; ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>