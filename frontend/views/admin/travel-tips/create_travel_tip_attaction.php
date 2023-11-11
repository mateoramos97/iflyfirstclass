<?php
use yii\widgets\ActiveForm;
use app\components\widgets\adminimagemanager\AdminImageFormWidget;
use yii\helpers\Html;

/* @var $travel_tips_attaction_model \common\sys\repository\traveltips\models\TravelTipsAttractions */
?>
Create Travel Tip
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'continent_crate',
        'enableClientValidation' => true,
    ]) ?>

    <?= $form->field($travel_tips_attaction_model, 'id')->hiddenInput()->label(false) ?>
    <?= $form->field($travel_tips_attaction_model, 'travel_tips_id')->hiddenInput(['value' => $travel_tip_id])->label(false) ?>
    <div class="col-md-6">
        <?= $form->field($travel_tips_attaction_model, 'title') ?>
    </div>

    <?= $form->field($travel_tips_attaction_model, 'body')->widget(\dosamigos\ckeditor\CKEditor::className(), [
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

