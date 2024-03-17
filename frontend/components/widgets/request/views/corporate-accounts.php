<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\RequestCorporateAccounts */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form-block-wrapper w-full px-16">
    <?php $form = ActiveForm::begin([
        'id' => 'request_corporate_accounts',
        'enableClientValidation' => true,
        'action' => '/request/corporate-account',
        'fieldConfig' => [
            'template' => "{input}",
        ],
    ]) ?>

    <div class="grid xl:grid-cols-3 grid-cols-1 xl:gap-14 gap-5 items-start">
        <div class="grid grid-cols-1 gap-5">
			<div class="form-group name-field">
				<i class="input-prefix icon-person-card text-gray bottom-3 text-lg"></i>
				<?= $form->field($model, 'name')->textInput([
						'placeholder' => 'Name',
						'class' => 'component component-name bg-white has-prefix'
				]) ?>
			</div>
			<div class="form-group phone-field">
				<i class="input-prefix icon-phone text-gray bottom-3 text-lg"></i>
				<?= $form->field($model, 'cell_phone')->textInput([
						'type' => 'number',
						'placeholder' => 'Phone',
						'id' => 'flightrequestmax_phone_round_trip',
						'class' => 'component component-cellphone has-prefix bg-white'
				]) ?>
			</div>
<!--            --><?php //= $form->field($model, 'work_phone')->textInput(
//                [
//                    'class' => 'component component-workphone',
//                    'placeholder' => 'Work Phone'
//                ]
//            ) ?>
			<div class="field-row email-field grow relative">
				<i class="input-prefix icon-mail text-gray top-4"></i>
				<?= $form->field($model, 'email')->textInput([
						'placeholder' => 'Email',
						'class' => 'component component-email has-prefix bg-white'
				]) ?>
			</div>
			<?= Html::submitButton('Request a Quote', ['class' => 'submit btn btn-primary mt-6', 'name' => 'request-quote-button']) ?>
        </div>
		<div class="grid grid-cols-1 gap-5">
			<div class="form-group from">
				<i class="input-prefix icon-airplan-fly text-gray bottom-4"></i>
				<?= $form->field($model, 'from')->textInput([
						'placeholder' => 'Where form ?',
						'class' => 'component component-from has-prefix has-suffix from field-from required-field autocomplete bg-white'
				]) ?>
				<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			</div>
			<div class="form-group to">
				<i class="input-prefix icon-airplan-land text-gray bottom-4"></i>
				<?= $form->field($model, 'to')->textInput([
						'placeholder' =>  'Where to ?',
						'class' => 'component component-to has-prefix has-suffix to field-to required-field autocomplete bg-white'
				]) ?>
				<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
			</div>
			<div class="split-input-group flex">
				<div class="form-group w-1/2">
					<i class="input-prefix icon-calendar text-gray top-3 text-lg"></i>
					<?= $form->field($model, 'dep_date')->textInput([
							'placeholder' => 'Departure',
							'class' => 'has-prefix has-suffix datepicker component component-depdate datepicker bg-white',
							'id' => 'dep-date-round-trip',
							'readonly' => 'readonly'
					]) ?>
					<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
				</div>
				<i class="input-divider"></i>
				<div class="form-group w-1/2">
					<?= $form->field($model, 'arr_date')->textInput([
							'placeholder' => 'Return',
							'class' => 'has-suffix required-field datepicker component component-arrdate datepicker bg-white',
							'id' => 'arr-date-round-trip',
							'readonly' => 'readonly'
					]) ?>
					<i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
				</div>
			</div>
<!--            --><?php //= $form->field($model, 'fare')->textInput(
//                [
//                    'class' => 'component component-fare bg-white',
//                    'placeholder' => 'Best Fare Quoted ($)'
//                ]
//            ) ?>
        </div>
		<div class="grid grid-cols-1 gap-5">
			<?= $form->field($model, 'message')->textarea(
					[
							'cols' => 20,
							'rows' => 7,
							'class' => 'component component-message bg-white',
							'placeholder' => 'Your Message'
					]
			) ?>
		</div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
