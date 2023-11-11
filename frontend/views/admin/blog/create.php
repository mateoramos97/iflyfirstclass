<?php
use yii\widgets\ActiveForm;
use app\components\widgets\adminimagemanager\AdminImageFormWidget;
use yii\helpers\Html;

/* @var $blog_article_model \common\sys\repository\blog\models\BlogArticles */

?>
create blog
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'blog_article_crate',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($blog_article_model, 'id')->hiddenInput()->label(false) ?>
    <?= $form->field($blog_article_model, 'posted')->hiddenInput()->label(false) ?>
    <div class="col-md-6">
        <?= $form->field($blog_article_model, 'browser_title') ?>
    </div>
    <div class="col-md-4 .col-md-offset-4">
        <?= $form->field($blog_article_model, 'description')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($blog_article_model, 'keywords')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($blog_article_model, 'title') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($blog_article_model, 'alias') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($blog_article_model, 'summary')->textarea(['rows' => 10]) ?>
    </div>

    <?= $form->field($blog_article_model, 'body_column_1')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($blog_article_model, 'body_column_2')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($blog_article_model, 'is_top')
        ->checkbox(['uncheck' => '0'], false)->label('Is Top (Right Side)') ?>
    <?= $form->field($blog_article_model, 'is_top_list')
        ->checkbox(['uncheck' => '0'], false)->label('Is Top (Home Page - Left Side)') ?>

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