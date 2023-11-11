<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\models\request\RequestHotel */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>
<div class="form-block-wrapper border-box">
    <h3>Going to</h3>
    <?php $form = ActiveForm::begin([
        'id' => 'request_hotel',
        'enableClientValidation' => true,
        'action' => '/request/hotel',
        'fieldConfig' => [
            'template' => "{input}",
        ],
    ]) ?>

    <div class="row row-1 hotel-checkin">
        <?= $form->field($model, 'hotel_checkin')->textInput([
            'placeholder' => 'City, airport, landmark, or address',
            'class' => 'border-radius-left border-radius-right'
        ]) ?>
    </div>
    <div class="row row-2 flex">
        <div class="field-row flex">
            <?= $form->field($model, 'check_in')->textInput(['placeholder' => 'Check in', 'class' => 'border-radius-left datepicker']) ?>
            <?= $form->field($model, 'check_out')->textInput(['placeholder' => 'Check out', 'class' => 'border-radius-right datepicker']) ?>
        </div>
        <div class="field-row flex flex-grows-1">
            <?= $form->field($model, 'rooms_number')->dropDownList(($rooms), ['prompt' => 'Rooms', 'class' => 'border-radius-left']); ?>
            <?= $form->field($model, 'adults_number')->dropDownList(($adults), ['prompt' => 'Adults']); ?>
            <?= $form->field($model, 'children_number')->dropDownList(($children), ['prompt' => 'Children', 'class' => 'border-radius-right']); ?>
        </div>
    </div>
    <div class="row row-3 flex">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Name*', 'class' => 'border-radius-left']) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email*']) ?>
        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Phone/Mobile*', 'class' => 'border-radius-right']) ?>
    </div>

    <div class="form-group form-action">
        <?= Html::submitButton('Get quote now', ['class' => 'submit', 'name' => 'hotel-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>