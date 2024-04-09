<?php

use app\components\AppConfig;
use yii\widgets\ActiveForm;

/* @var $model \common\sys\models\request\FlightRequestMax */
/* @var $form yii\widgets\ActiveForm */
/* @var array $trip_variants */
?>

<div id="form-request" class="form-flight-request-max-wrapper form-flight-request border-box xl:bg-white xl:px-10 xl:pt-10 xl:pb-6 rounded-3xl" v-cloak>
	<?php $form = ActiveForm::begin([
			'id' => 'flight_request_max_form',
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
    <h4 class="xl:inline-block hidden font-gilroy-semibold pl-2">Book Flight</h4>
    <h4 class="xl:hidden block text-white text-center font-silk-serif-medium text-3.2xl font-normal pt-4"><?= $shortHead ?? 'A Philosophy of Travel' ?></h4>
    <div class="form-nav xl:mt-5 mt-8">
		<ul class="head-menu gap-3 flex-wrap xl:flex hidden">
			<li class="form-group head-menu-item flex items-center">
				<i class="input-prefix icon icon-arrows"></i>
				<select class="has-prefix has-suffix border-none tom-select w-auto" @change="changeActiveForm($event)">
					<?php foreach ($trip_variants as $value => $label): ?>
						<option value="<?= $value ?>"><?= $label ?></option>
					<?php endforeach; ?>
				</select>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
			<li class="form-group head-menu-item flex items-center">
				<i class="input-prefix icon icon-person"></i>
				<select class="has-prefix has-suffix border-none tom-select w-auto"
						name="FlightRequestMax[people_number]" v-model="peopleNumber">
					<?php foreach ($number_persones as $value => $label): ?>
						<option value="<?= $value ?>"><?= $label ?></option>
					<?php endforeach; ?>
				</select>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
			<li class="form-group head-menu-item flex items-center">
				<i class="input-prefix icon icon-business"></i>
				<select class="has-prefix has-suffix border-none tom-select w-auto"
						name="FlightRequestMax[cabin_class_name]" v-model="cabinClassName">
					<?php foreach ($cabin_class as $value => $label): ?>
						<option value="<?= $value ?>"><?= $label ?></option>
					<?php endforeach; ?>
				</select>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
		</ul>
		<div class="tab-menu xl:hidden flex justify-center">
			<ul class="flex justify-center">
				<li class="flex items-center ">
					<a href="javascript:void(0)" :class="{active: activeForm == <?= AppConfig::Type_Trip_Round_Trip ?>}"
					   @click="setActiveForm(<?= AppConfig::Type_Trip_Round_Trip ?>)">Round trip</a>
				</li>
				<li class="flex items-center">
					<a href="javascript:void(0)" :class="{active: activeForm == <?= AppConfig::Type_Trip_One_Way ?>}"
					   @click="setActiveForm(<?= AppConfig::Type_Trip_One_Way ?>)">One-way</a>
				</li>
				<li class="flex items-center">
					<a href="javascript:void(0)" :class="{active: activeForm == <?= AppConfig::Type_Trip_Multi_City ?>}"
					   @click="setActiveForm(<?= AppConfig::Type_Trip_Multi_City ?>)">Multi-City</a>
				</li>
			</ul>
		</div>
    </div>
    <div class="clearfix"></div>
    <div class="form-flight-request-max-inner">
        <?= $this->render('flight-request-max-forms/_flight-request-max-round-trip', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model,
			'form' => $form
        ]) ?>
        <?= $this->render('flight-request-max-forms/_flight-request-max-one-way', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model,
			'form' => $form
        ]) ?>
        <?= $this->render('flight-request-max-forms/_flight-request-max-multi-city', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model,
			'form' => $form
        ]) ?>
    </div>
	<?php ActiveForm::end(); ?>
	<div class="xl:hidden items-center flex justify-center mt-8">
		<a class="flex" href="https://www.shopperapproved.com/reviews/iflyfirstclass.com" target="_blank">
			<img class="scale-110" src="/public/img/shopper-approved-white.svg" alt="">
			<img class="ml-6" src="/public/img/stars.svg" alt="">
		</a>
	</div>
</div>
