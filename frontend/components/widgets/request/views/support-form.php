<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\SupportForm */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>
<div class="message-support-wrapper border-box">
    <div class="message-support-inner">
        <div class="top-block">
            <div class="close">Close</div>
        </div>
        <div class="title">
            Send A Message
        </div>
        <div class="form-block border-box">
            <?php $form = ActiveForm::begin([
                'id' => 'request_support_message',
                'enableClientValidation' => true,
                'action' => '/request/support-message',
                'fieldConfig' => [
                    'template' => "{label}\n{input}",
                ],
            ]) ?>
                <input type="hidden" name="check_subscription" class="check-subscription" value="">
                <?= $form->field($model, 'name')->textInput() ?>
                <?= $form->field($model, 'email')->textInput() ?>
                <?= $form->field($model, 'message')->textarea(['cols' => 20, 'rows' => 2]) ?>
                <?= Html::submitButton('Send', ['class' => 'submit', 'name' => 'support_message_button']) ?>
                <div class="bottom-block">
                    Required items indicated with *
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>