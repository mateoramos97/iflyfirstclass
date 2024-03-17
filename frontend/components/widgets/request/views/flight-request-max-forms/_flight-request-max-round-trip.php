<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\FlightRequestMax */

use yii\helpers\Html;
?>

<div class="form-request-tab tab-round-trip box-border mt-3 active" data-tab-form="tab-1">
    <input type="hidden" name="check_subscription" class="check-subscription" value="">
    <?= $form->field($model, 'type_trip')->hiddenInput([
        'value' => \app\components\AppConfig::Type_Trip_Round_Trip,
        'id' => 'flightrequestmax_type_trip_round_trip',
    ]) ?>
    <div class="split-input-group flex items-center">
        <div class="field-row from grow relative">
			<i class="input-prefix icon-airplan-fly text-gray bottom-4"></i>
            <?= $form->field($model, 'from[]')->textInput([
                'placeholder' => 'Where form ?',
                'id' => 'flightrequestmax_from_round_trip',
                'class' => 'has-prefix has-suffix from field-from required-field autocomplete'
            ]) ?>
			<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
        </div>
		<i class="input-divider"></i>
        <div class="field-row to grow relative">
			<i class="input-prefix icon-airplan-land text-gray bottom-4"></i>
            <?= $form->field($model, 'to[]')->textInput([
                'placeholder' =>  'Where to ?',
                'id' => 'flightrequestmax_to_round_trip',
                'class' => 'has-prefix has-suffix to field-to required-field autocomplete'
            ]) ?>
			<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
        </div>
    </div>
    <div class="grid xl:grid-cols-2 grid-cols-1 xl:gap-4 gap-5 mt-5">
        <div class="split-input-group field-row field-data flex grow">
			<div class="relative w-1/2">
				<i class="input-prefix icon-calendar text-gray top-3 text-lg"></i>
				<?= $form->field($model, 'dep_date[]')->textInput([
						'placeholder' => 'Departure',
						'class' => 'has-prefix has-suffix datepicker component-depdate',
						'id' => 'dep-date-round-trip',
						'readonly' => 'readonly'
				]) ?>
				<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			</div>
			<i class="input-divider"></i>
			<div class="relative w-1/2">
				<?= $form->field($model, 'arr_date[]')->textInput([
						'placeholder' => 'Return',
						'class' => 'has-suffix required-field datepicker component-arrdate',
						'id' => 'arr-date-round-trip',
						'readonly' => 'readonly'
				]) ?>
				<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			</div>
        </div>
		<div class="split-input-group field-row field-data xl:hidden flex grow">
			<div class="form-group w-1/2">
				<i class="input-prefix icon icon-person top-3 text-lg"></i>
				<?= $form->field($model, 'people_number')->dropDownList(($number_persones), [
						'id' => 'flightrequestmax_people_number_round_trip',
						'class' => 'has-prefix has-suffix border-none tom-select w-auto'
				]); ?>
				<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			</div>
			<i class="input-divider"></i>
			<div class="form-group w-1/2">
				<i class="input-prefix icon-business text-gray top-3 text-lg"></i>
				<?= $form->field($model, 'cabin_class_name')->dropDownList(($cabin_class), [
						'id' => 'flightrequestmax_cabin_class_name_round_trip1',
						'class' => 'has-prefix has-suffix border-none tom-select w-auto'
				]); ?>
				<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			</div>
		</div>
		<div class="field-row email-field grow relative">
			<i class="input-prefix icon-mail text-gray top-4"></i>
			<?= $form->field($model, 'email')->textInput([
					'placeholder' => 'Email',
					'id' => 'flightrequestmax_email_round_trip',
					'class' => 'has-prefix bg-white'
			]) ?>
		</div>
    </div>
    <div class="contact-block-wrapper grid xl:grid-cols-2 lg:grid-cols-1 xl:gap-4 gap-5 mt-5">
		<div class="field-row name-field relative">
			<i class="input-prefix icon-person-card text-gray bottom-3 text-lg"></i>
			<?= $form->field($model, 'name')->textInput([
					'placeholder' => 'Name',
					'id' => 'flightrequestmax_name_round_trip',
					'class' => 'has-prefix bg-white'
			]) ?>
		</div>
		<div class="field-row phone-field relative">
			<i class="input-prefix icon-phone text-gray bottom-3 text-lg"></i>
			<?= $form->field($model, 'phone')->textInput([
					'type' => 'number',
					'placeholder' => 'Phone',
					'id' => 'flightrequestmax_phone_round_trip',
					'class' => 'has-prefix bg-white'
			]) ?>
		</div>
    </div>
    <div class="form-group form-action grid xl:grid-cols-2 lg:grid-cols-1 gap-5 mt-6">
        <?= Html::submitButton('Request a Quote', ['class' => 'xl:block hidden btn btn-primary submit form-action-button search-flights', 'name' => 'flyght-button']) ?>
        <?= Html::submitButton('Search Flight Now', ['class' => 'xl:hidden block btn btn-warning submit form-action-button search-flights', 'name' => 'flyght-button']) ?>
		<button
				class="btn btn-secondary tools-ringme-ringmeLink form-action-button xl:flex hidden justify-center items-center"
				id="tools-ringme-ringmeLink"
				data-test-automation-id="ringmeLink"
				tabindex="0"
				role="button"
				type="button"
				onclick='setTimeout(() => window.open("https://service.ringcentral.com/ringme/?uc=BD5DE3D086F9F9B2ABA3DC248F54530E5783399000016,0,,1,0&s=no&v=2&s_=1210", "Callback_RingMe", "resizable=no,width=500,height=635"), 0);return false;'>
			<span class="flex w-full items-center">
				<i class="icon-phone-ring text-lg"></i>
				<span class="divider"></span>
				<span class="grow">RingMe</span>
			</span>
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
</div>