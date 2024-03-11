<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\FlightRequestMax */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form-request-tab tab-one-way border-box" data-tab-form="tab-2">
    <?php $form = ActiveForm::begin([
        'id' => 'flight_request_max_one_way',
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
        'value' => \app\components\AppConfig::Type_Trip_One_Way,
        'id' => 'flightrequestmax_type_trip_one_way',
    ]) ?>
    <div class="form-column form-column-1 flex">
        <div class="field-row from">
            <?= $form->field($model, 'from[]')->textInput([
                'placeholder' => 'From Airport or City*',
                'id' => 'flightrequestmax_from_one_way',
                'class' => 'from field-from border-radius-left required-field autocomplete'
            ]) ?>
        </div>
        <div class="field-row to">
            <?= $form->field($model, 'to[]')->textInput([
                'placeholder' => 'To Airport or City*',
                'id' => 'flightrequestmax_to_one_way',
                'class' => 'to field-to border-radius-right border-left-none required-field autocomplete'
            ]) ?>
        </div>
    </div>
    <div class="form-column form-column-2 flex">
        <div class="date-field field-row field-data flex">
            <?= $form->field($model, 'dep_date[]')->textInput([
                'placeholder' => 'Depart',
                'class' => 'border-radius-left datepicker',
                'id' => 'dep-date-one-way',
                'readonly' => 'readonly'
            ]) ?>
        </div>
        <div class="field-row cabin-class persones flex flex-grows-1 border-box">
            <?= $form->field($model, 'cabin_class_name')->dropDownList(($cabin_class), [
                'id' => 'flightrequestmax_cabin_class_name_one_way',
                'class' => 'border-radius-left'
            ]); ?>
            <?= $form->field($model, 'people_number')->dropDownList(($number_persones), [
                'id' => 'flightrequestmax_number_persones_one_way',
                'class' => 'border-radius-right border-left-none'
            ]); ?>
        </div>
    </div>
    <div class="contact-block-wrapper">
        <h4>Contacts</h4>
        <div class="flex contact-block-inner">
            <div class="field-row name-field">
                <?= $form->field($model, 'name')->textInput([
                    'placeholder' => 'Name*',
                    'id' => 'flightrequestmax_name_one_way',
                    'class' => 'border-radius-left border-right-none'
                ]) ?>
            </div>
            <div class="field-row email-field">
                <?= $form->field($model, 'email')->textInput([
                    'placeholder' => 'Email*',
                    'id' => 'flightrequestmax_email_one_way',
                ]) ?>
            </div>
            <div class="field-row phone-field">
                <?= $form->field($model, 'phone')->textInput([
                    'type' => 'number',
                    'placeholder' => 'Phone*',
                    'id' => 'flightrequestmax_phone_one_way',
                    'class' => 'border-radius-right border-left-none'
                ]) ?>
            </div>
        </div>
    </div>
	<div class="form-group form-action flex flex-justify-between flex-align-center">
        <?= Html::submitButton('Search Flight Now', ['class' => 'submit form-action-button search-flights', 'name' => 'flyght-button']) ?>
		<button
				class="tools-ringme-ringmeLink form-action-button flex flex-justify-center flex-align-center call-us"
				id="tools-ringme-ringmeLink"
				data-test-automation-id="ringmeLink"
				tabindex="0"
				role="button"
				type="button"
				onclick='setTimeout(() => window.open("https://service.ringcentral.com/ringme/?uc=BD5DE3D086F9F9B2ABA3DC248F54530E5783399000016,0,,1,0&s=no&v=2&s_=1210", "Callback_RingMe", "resizable=no,width=500,height=635"), 0);return false;'>
			<span>RingMe</span>
		</button>
	</div>
    <div class="form-request-notify flex flex-align-center">
        <div class="icon"></div>
        <div class="content">
            <div class="title">Thank you for your request!</div>
            <p>
                Unfortunately <span>we don’t do domestic flights.</span>
            </p>
			<p>
				But let us know next time you travel internationally and we will be happy to help!
			</p>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>