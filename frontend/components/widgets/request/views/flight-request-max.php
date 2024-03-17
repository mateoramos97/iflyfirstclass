<?php
use yii\widgets\ActiveForm;

/* @var $model \common\sys\models\request\FlightRequestMax */
/* @var $form yii\widgets\ActiveForm */
?>

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
<div class="form-flight-request-max-wrapper form-flight-request border-box xl:bg-white xl:p-10 rounded-2xl pt-20">
    <h4 class="xl:inline-block hidden">Book Flight</h4>
    <h4 class="xl:hidden block text-white text-center font-silk-serif-bold">A Philosophy of Travel</h4>
    <div class="form-nav xl:mt-2 mt-5">
		<ul class="head-menu gap-3 flex-wrap xl:flex hidden">
			<li class="form-group head-menu-item flex items-center">
				<i class="input-prefix icon icon-arrows"></i>
				<?= $form->field($model, 'cabin_class_name')->dropDownList(($trip_variants), [
						'id' => 'flightrequestmax_trip_variants_name_round_trip',
						'class' => 'has-prefix has-suffix border-none tom-select w-auto'
				]); ?>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
			<li class="form-group head-menu-item flex items-center">
				<i class="input-prefix icon icon-person"></i>
				<?= $form->field($model, 'people_number')->dropDownList(($number_persones), [
					'id' => 'flightrequestmax_people_number_round_trip1',
					'class' => 'has-prefix has-suffix border-none tom-select w-auto'
				]); ?>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
			<li class="form-group head-menu-item flex items-center">
				<i class="input-prefix icon icon-business"></i>
				<?= $form->field($model, 'cabin_class_name')->dropDownList(($cabin_class), [
						'id' => 'flightrequestmax_cabin_class_name_round_trip1',
						'class' => 'has-prefix has-suffix border-none tom-select w-auto'
				]); ?>
				<i class="input-suffix icon-chevron text-ns"></i>
			</li>
		</ul>
		<div class="tab-menu xl:hidden block">
			<ul class="flex gap-5 flex-wrap justify-center">
				<li class="flex items-center ">
					<a href="javascript:void(0)" class="active " data-tab-li-id="tab-1">Round trip</a>
				</li>
				<li class="flex items-center">
					<a href="javascript:void(0)" data-tab-li-id="tab-2">One-way</a>
				</li>
				<li class="flex items-center">
					<a href="javascript:void(0)" data-tab-li-id="tab-3">Multi-City</a>
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
	<div class="xl:hidden items-center flex justify-center mt-8">
		<a class="flex" href="https://www.shopperapproved.com/reviews/iflyfirstclass.com" target="_blank">
			<img class="scale-110" src="/public/img/shopper-approved-white.svg" alt="">
			<img class="ml-6" src="/public/img/stars.svg" alt="">
		</a>
	</div>
</div>
<?php ActiveForm::end(); ?>