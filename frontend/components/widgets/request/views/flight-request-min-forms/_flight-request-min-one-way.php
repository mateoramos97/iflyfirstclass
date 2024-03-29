<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\FlightRequestMax */

use app\components\AppConfig;
use yii\helpers\Html;
?>

<div class="form-request-tab tab-one-way box-border" data-tab-form="<?= AppConfig::Type_Trip_One_Way ?>" v-if="activeForm == <?= AppConfig::Type_Trip_One_Way ?>">
	<div class="field-row from relative autocomplete-wrapper">
		<i class="input-prefix icon-airplan-fly text-gray bottom-4"></i>
		<?= $form->field($model, 'from[]')->textInput([
				'placeholder' => 'Where from ?',
				'id' => 'flightrequestmin_from_one_way',
				'class' => 'has-prefix has-suffix from field-from required-field autocomplete-value-input bg-white'
		]) ?>
		<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
		<div class="autocomplete-enter-input-wrapper">
			<i class="input-prefix icon-airplan-fly text-orange bottom-4"></i>
			<input class="has-prefix autocomplete" placeholder="Where from ?">
		</div>
	</div>
	<div class="field-row to relative mt-5 autocomplete-wrapper">
		<i class="input-prefix icon-airplan-land text-gray bottom-4"></i>
		<?= $form->field($model, 'to[]')->textInput([
				'placeholder' =>  'Where to ?',
				'id' => 'flightrequestmin_to_one_way',
				'class' => 'has-prefix has-suffix to field-to required-field autocomplete-value-input bg-white'
		]) ?>
		<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
		<div class="autocomplete-enter-input-wrapper">
			<i class="input-prefix icon-airplan-land text-orange bottom-4"></i>
			<input class="has-prefix autocomplete" placeholder="Where to ?">
		</div>
	</div>
	<div class="field-row to relative mt-5">
		<i class="input-prefix icon-calendar text-gray top-3 text-lg"></i>
		<datepicker
				name="FlightRequestMax[dep_date][]"
				placeholder="Departure"
				id="dep-date-one-way"
				class-name="has-prefix has-suffix bg-white"
		></datepicker>
		<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
	</div>
	<div class="form-group field-row email-field mt-5 hidden-field" v-if="showHiddenFields">
		<i class="input-prefix icon-mail text-gray top-4"></i>
		<?= $form->field($model, 'email')->textInput([
				'placeholder' => 'Email',
				'id' => 'flightrequestmax_email_multi_city',
				'class' => 'has-prefix bg-white'
		]) ?>
	</div>
	<div class="form-group name-field mt-5 hidden-field" v-if="showHiddenFields">
		<i class="input-prefix icon-person-card text-gray bottom-3 text-lg"></i>
		<?= $form->field($model, 'name')->textInput([
				'placeholder' => 'Name',
				'id' => 'flightrequestmax_name_multi_city',
				'class' => 'has-prefix bg-white'
		]) ?>
	</div>
	<div class="form-group field-row phone-field mt-5 hidden-field" v-if="showHiddenFields">
		<i class="input-prefix icon-phone text-gray bottom-3 text-lg"></i>
		<?= $form->field($model, 'phone')->textInput([
				'type' => 'number',
				'placeholder' => 'Phone',
				'id' => 'flightrequestmax_phone_multi_city',
				'class' => 'has-prefix bg-white'
		]) ?>
	</div>
	<div class="split-input-group field-row field-data xl:hidden flex mt-5">
		<div class="form-group w-1/2">
			<i class="input-prefix icon icon-person top-3 text-lg"></i>
			<?= $form->field($model, 'people_number')->dropDownList(($number_persones), [
					'id' => 'flightrequestmin_number_persones_one_way',
					'class' => 'has-prefix has-suffix border-none tom-select w-auto'
			]); ?>
			<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
		</div>
		<i class="input-divider"></i>
		<div class="form-group w-1/2">
			<i class="input-prefix icon-business text-gray top-3 text-lg"></i>
			<?= $form->field($model, 'cabin_class_name')->dropDownList(($cabin_class), [
					'id' => 'flightrequestmin_cabin_class_name_one_way',
					'class' => 'has-prefix has-suffix border-none tom-select w-auto'
			]); ?>
			<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
		</div>
	</div>
	<div class="form-group form-action mt-6">
		<?= Html::submitButton('Search Flight Now', ['class' => 'btn btn-primary submit form-action-button search-flights w-full py-5 !text-base-2', 'name' => 'flyght-button']) ?>
	</div>
</div>