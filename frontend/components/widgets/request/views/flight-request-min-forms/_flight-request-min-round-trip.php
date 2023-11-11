<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\FlightRequestMax */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>

<div class="form-request-tab tab-round-trip border-box active" data-tab-form="tab-1">
    <?php $form = ActiveForm::begin([
        'id' => 'flight_request_min_round_trip',
        'enableClientValidation' => true,
        'action' => '/request/flight',
        'fieldConfig' => [
            'template' => "{input}",
        ],
        'options' => [
            'class' => 'form-request-airline'
        ]
    ]) ?>
    <input type="hidden" name="check_subscription" class="check-subscription" value="">
    <?= $form->field($model, 'type_trip')->hiddenInput([
        'value' => \app\components\AppConfig::Type_Trip_Round_Trip,
        'id' => 'flightrequestmin_type_trip_round_trip',
    ]) ?>
    <div class="field-row from">
        <?= $form->field($model, 'from[]')->textInput([
            'placeholder' => 'From Airport or City*',
            'id' => 'flightrequestmin_from_round_trip',
            'class' => 'border-radius-left required-field autocomplete'
        ]) ?>
    </div>
    <div class="field-row to">
        <?= $form->field($model, 'to[]')->textInput([
            'placeholder' => 'To Airport or City*',
            'id' => 'flightrequestmin_to_round_trip',
            'class' => 'border-radius-right border-left-none required-field autocomplete'
        ]) ?>
    </div>
    <div class="form-column-2 flex">
        <div class="field-row field-data flex">
            <?= $form->field($model, 'dep_date[]')->textInput([
                'placeholder' => 'Depart',
                'class' => 'depart-date border-radius-left datepicker',
                'id' => 'dep-date-round-trip',
                'readonly' => 'readonly'
            ]) ?>
            <?= $form->field($model, 'arr_date[]')->textInput([
                'placeholder' => 'Return',
                'class' => 'return-date border-radius-right border-left-none required-field datepicker',
                'id' => 'arr-date-round-trip',
                'readonly' => 'readonly'
            ]) ?>
        </div>
    </div>
    <div class="form-column-3 flex">
        <div class="field-row cabin-class persones flex flex-grows-1 border-box">
            <?= $form->field($model, 'cabin_class_name')->dropDownList(($cabin_class), [
                'id' => 'flightrequestmin_cabin_class_name_round_trip',
                'class' => 'border-radius-left'
            ]); ?>
            <?= $form->field($model, 'people_number')->dropDownList(($number_persones), [
                'id' => 'flightrequestmin_people_number_round_trip',
                'class' => 'border-radius-right border-left-none'
            ]); ?>
        </div>
    </div>
    <div class="contact-block-wrapper">
        <div class="field-row name-field">
            <?= $form->field($model, 'name')->textInput([
                'placeholder' => 'Name*',
                'id' => 'flightrequestmin_name_round_trip',
                'class' => 'border-radius-left border-right-none'
            ]) ?>
        </div>
        <div class="field-row email-field">
            <?= $form->field($model, 'email')->textInput([
                'placeholder' => 'Email*',
                'id' => 'flightrequestmin_email_round_trip',
            ]) ?>
        </div>
        <div class="field-row phone-field">
            <?= $form->field($model, 'phone')->textInput([
                'placeholder' => 'Phone*',
                'id' => 'flightrequestmin_phone_round_trip',
                'class' => 'border-radius-right border-left-none'
            ]) ?>
        </div>
    </div>
    <div class="form-group form-action">
        <?= Html::submitButton('Request a Quote Now', ['class' => 'submit', 'name' => 'flyght-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>