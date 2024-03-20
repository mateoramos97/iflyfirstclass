<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\RequestQuote */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>
<div class="form-block-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'request_quote',
        'enableClientValidation' => true,
        'action' => '/request/request-quote',
        'fieldConfig' => [
            'template' => "{input}",
        ],
    ]) ?>

    <div class="flex justify-between">
        <div class="column column-1">
            <?= $form->field($model, 'name')->textInput(
                [
                    'class' => 'component component-name',
                    'placeholder' => 'Your Name*'
                ]
            ) ?>
            <?= $form->field($model, 'cell_phone')->textInput(
                [
                    'class' => 'component component-cellphone',
                    'placeholder' => 'Cell Phone'
                ]
            ) ?>
            <?= $form->field($model, 'work_phone')->textInput(
                [
                    'class' => 'component component-workphone',
                    'placeholder' => 'Work Phone'
                ]
            ) ?>
            <?= $form->field($model, 'email')->textInput(
                [
                    'class' => 'component component-email',
                    'placeholder' => 'Your Email*'
                ]
            ) ?>
            <?= $form->field($model, 'message')->textarea(
                [
                    'cols' => 20,
                    'rows' => 2,
                    'class' => 'component component-message',
                    'placeholder' => 'Your Message'
                ]
            ) ?>
        </div>
        <div class="column column-2">
            <?= $form->field($model, 'from')->textInput(
                [
                    'class' => 'component component-from airport-autocomplete ui-autocomplete-input',
                    'placeholder' => 'From'
                ]
            ) ?>
            <?= $form->field($model, 'to')->textInput(
                [
                    'class' => 'component component-to airport-autocomplete ui-autocomplete-input',
                    'placeholder' => 'To'
                ]
            ) ?>
            <?= $form->field($model, 'dep_date')->textInput(
                [
                    'class' => 'component component-depdate datepicker',
                    'placeholder' => 'Departure Date'
                ]
            ) ?>
            <?= $form->field($model, 'arr_date')->textInput(
                [
                    'class' => 'component component-arrdate datepicker',
                    'placeholder' => 'Return Date'
                ]
            ) ?>
            <?= $form->field($model, 'fare')->textInput(
                [
                    'class' => 'component component-fare',
                    'placeholder' => 'Best Fare Quoted ($)'
                ]
            ) ?>
            <?= Html::submitButton('Submit a Quote Request', ['class' => 'submit', 'name' => 'request-quote-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>