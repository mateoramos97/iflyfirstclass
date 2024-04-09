<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\FlightRequestMax */

use app\components\AppConfig;
use yii\helpers\Html;
?>

<div class="form-request-tab tab-round-trip box-border mt-4" data-tab-form="<?= AppConfig::Type_Trip_Round_Trip ?>" v-if="activeForm == <?= AppConfig::Type_Trip_Round_Trip ?>">
    <div class="split-input-group flex items-center">
        <div class="field-row from grow relative autocomplete-wrapper">
			<i class="input-prefix icon-airplan-fly text-gray bottom-4"></i>
            <?= $form->field($model, 'from[]')->textInput([
                'placeholder' => 'Where from ?',
                'id' => 'flightrequestmax_from_round_trip',
                'class' => 'has-prefix has-suffix from field-from required-field autocomplete-value-input'
            ]) ?>
			<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			<div class="autocomplete-enter-input-wrapper">
				<i class="input-prefix icon-airplan-fly text-orange bottom-4"></i>
				<input class="has-prefix autocomplete" placeholder="Where from ?">
			</div>
        </div>
		<i class="input-divider"></i>
        <div class="field-row to grow relative autocomplete-wrapper">
			<i class="input-prefix icon-airplan-land text-gray bottom-4"></i>
            <?= $form->field($model, 'to[]')->textInput([
                'placeholder' =>  'Where to ?',
                'id' => 'flightrequestmax_to_round_trip',
                'class' => 'has-prefix has-suffix to field-to required-field autocomplete-value-input'
            ]) ?>
			<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			<div class="autocomplete-enter-input-wrapper">
				<i class="input-prefix icon-airplan-land text-orange bottom-4"></i>
				<input class="has-prefix autocomplete" placeholder="Where to ?">
			</div>
        </div>
    </div>
    <div class="grid xl:grid-cols-2 grid-cols-1 xl:gap-4 gap-5 xl:mt-6 mt-5">
        <div class="split-input-group field-row field-data flex grow">
			<div class="relative w-1/2">
				<i class="input-prefix icon-calendar text-gray top-[14px] text-lg"></i>
				<datepicker
					name="FlightRequestMax[dep_date][]"
					placeholder="Departure"
					id="dep-date-round-trip"
					class-name="has-prefix has-suffix required-field"
				></datepicker>
				<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			</div>
			<i class="input-divider"></i>
			<div class="relative w-1/2">
				<datepicker
					name="FlightRequestMax[arr_date][]"
					placeholder="Return"
					id="arr-date-round-trip"
					class-name="has-suffix required-field"
				></datepicker>
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
		<div class="field-row email-field grow relative xl:block hidden">
			<i class="input-prefix icon-mail text-gray top-[17px]"></i>
			<?= $form->field($model, 'email')->textInput([
					'placeholder' => 'Email',
					'id' => 'flightrequestmax_email_round_trip',
					'class' => 'has-prefix bg-white',
					'required' => false
			]) ?>
		</div>
    </div>
    <div class="contact-block-wrapper grid xl:grid-cols-2 lg:grid-cols-1 xl:gap-4 xl:mt-6 mt-5">
		<div class="field-row email-field grow relative xl:hidden block">
			<i class="input-prefix icon-mail text-gray top-[17px]"></i>
			<?= $form->field($model, 'email')->textInput([
					'placeholder' => 'Email',
					'id' => 'flightrequestmax_email_round_trip',
					'class' => 'has-prefix bg-white xl:rounded-b-xl rounded-b-none',
					'required' => false
			]) ?>
		</div>
		<div class="field-row name-field relative">
			<i class="input-prefix icon-person-card text-gray bottom-4 text-lg"></i>
			<?= $form->field($model, 'name')->textInput([
					'placeholder' => 'Name',
					'id' => 'flightrequestmax_name_round_trip',
					'class' => 'has-prefix bg-white xl:rounded-xl rounded-none'
			]) ?>
		</div>
		<div class="field-row phone-field relative">
			<i class="input-prefix icon-phone text-gray bottom-4 text-lg"></i>
			<?= $form->field($model, 'phone')->textInput([
					'type' => 'number',
					'placeholder' => 'Phone',
					'id' => 'flightrequestmax_phone_round_trip',
					'class' => 'has-prefix bg-white xl:rounded-t-xl rounded-t-none'
			]) ?>
		</div>
    </div>
    <div class="form-group form-action grid xl:grid-cols-2 lg:grid-cols-1 gap-5 mt-9">
        <?= Html::submitButton('Search Flight Now', ['class' => 'xl:block hidden btn btn-primary submit form-action-button search-flights text-[17px]', 'name' => 'flyght-button']) ?>
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