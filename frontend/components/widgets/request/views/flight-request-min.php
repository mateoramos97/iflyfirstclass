<?php

use app\components\AppConfig;
use yii\widgets\ActiveForm;

/* @var $model \common\sys\models\request\FlightRequestMax */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="form-request" class="form-flight-request-min-wrapper form-flight-request border-box xl:p-10 rounded-3xl pt-5 shadow">
	<?php $form = ActiveForm::begin([
			'id' => 'flight_request_min_form',
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
	<input type="hidden" name="FlightRequestMax[type_trip]" class="type-trip" :value="activeForm">
	<h5 class="px-2 xl:text-left text-center xl:text-primary text-white">Book Flight</h5>
	<div class="form-nav xl:mt-3 mt-5 text-black">
		<ul class="head-menu gap-2 flex-wrap xl:flex hidden">
			<li class="form-group head-menu-item flex items-center">
				<select class="has-suffix border-none tom-select w-auto" @change="changeActiveForm($event)">
					<?php foreach ($trip_variants as $value => $label): ?>
						<option value="<?= $value ?>"><?= $label ?></option>
					<?php endforeach; ?>
				</select>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
			<li class="form-group head-menu-item flex items-center">
				<?= $form->field($model, 'people_number')->dropDownList(($number_persones), [
						'id' => 'flightrequestmax_people_number_round_trip1',
						'class' => 'has-suffix tom-select w-auto'
				]); ?>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
			<li class="form-group head-menu-item flex items-center">
				<?= $form->field($model, 'cabin_class_name')->dropDownList(($cabin_class), [
						'id' => 'flightrequestmax_cabin_class_name_round_trip1',
						'class' => 'has-suffix tom-select w-auto',
				]); ?>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
		</ul>
		<div class="tab-menu xl:hidden block">
			<ul class="flex gap-5 flex-wrap justify-center">
				<li class="flex items-center ">
					<a href="javascript:void(0)" :class="{active: activeForm == <?= AppConfig::Type_Trip_Round_Trip ?>}"
					   @click="activeForm = <?= AppConfig::Type_Trip_Round_Trip ?>">Round trip</a>
				</li>
				<li class="flex items-center">
					<a href="javascript:void(0)" :class="{active: activeForm == <?= AppConfig::Type_Trip_One_Way ?>}"
					   @click="activeForm = <?= AppConfig::Type_Trip_One_Way ?>">One-way</a>
				</li>
				<li class="flex items-center">
					<a href="javascript:void(0)" :class="{active: activeForm == <?= AppConfig::Type_Trip_Multi_City ?>}"
					   @click="activeForm = <?= AppConfig::Type_Trip_Multi_City ?>">Multi-City</a>
				</li>
			</ul>
		</div>
	</div>
    <div class="form-flight-request-min-inner mt-3">
        <?= $this->render('flight-request-min-forms/_flight-request-min-round-trip', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model,
			'form' => $form
        ]) ?>
        <?= $this->render('flight-request-min-forms/_flight-request-min-one-way', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model,
			'form' => $form,
        ]) ?>
        <?= $this->render('flight-request-min-forms/_flight-request-min-multi-city', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model,
			'form' => $form
        ]) ?>
    </div>
	<?php ActiveForm::end(); ?>
</div>
