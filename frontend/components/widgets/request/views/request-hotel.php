<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\RequestHotel */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="border-box xl:bg-white xl:p-10 rounded-2xl pt-20">
    <h4 class="text-white xl:text-primary text-center xl:text-left">Going to</h4>
    <?php $form = ActiveForm::begin([
        'id' => 'request_hotel',
        'enableClientValidation' => true,
        'action' => '/request/hotel',
        'fieldConfig' => [
            'template' => "{input}",
        ],
    ]) ?>

    <div class="row row-1 hotel-checkin mt-5">
        <?= $form->field($model, 'hotel_checkin')->textInput([
            'placeholder' => 'City, airport, landmark, or address',
            'class' => 'bg-white'
        ]) ?>
    </div>
    <div class="grid mt-5 xl:grid-cols-6 grid-cols-1 xl:gap-2 gap-5">
		<div class="split-input-group flex col-span-3">
			<div class="form-group w-1/2">
            	<?= $form->field($model, 'check_in')->textInput(['placeholder' => 'Check in', 'class' => 'bg-white datepicker']) ?>
			</div>
			<i class="input-divider"></i>
			<div class="form-group w-1/2">
            	<?= $form->field($model, 'check_out')->textInput(['placeholder' => 'Check out', 'class' => 'bg-white datepicker']) ?>
			</div>
        </div>
		<div class="split-input-group flex col-span-3">
			<div class="form-group w-1/3">
				<?= $form->field($model, 'rooms_number')->dropDownList(($rooms), [
						'class' => 'tom-select'
				]); ?>
			</div>
			<i class="input-divider"></i>
			<div class="form-group w-1/3">
            	<?= $form->field($model, 'adults_number')->dropDownList(($adults), ['class' => 'tom-select']); ?>
			</div>
			<i class="input-divider"></i>
			<div class="form-group w-1/3">
            	<?= $form->field($model, 'children_number')->dropDownList(($children), ['class' => 'tom-select']); ?>
			</div>
        </div>
    </div>
    <div class="grid xl:grid-cols-3 grid-cols-1 xl:gap-2 mt-5 gap-5">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Name*', 'class' => 'bg-white']) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email*', 'class' => 'bg-white']) ?>
        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Phone/Mobile*', 'class' => 'bg-white']) ?>
    </div>

    <div class="form-group form-action mt-6">
		<?= Html::submitButton('Get quote now', ['class' => 'btn btn-primary submit xl:w-1/2 w-full', 'name' => 'hotel-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>