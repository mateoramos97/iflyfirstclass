<?php
/* @var $model \common\sys\models\request\FlightRequestMax */
?>

<div class="form-flight-request-min-wrapper form-flight-request p-relative border-box">
    <div class="form-nav border-box">
        <div class="tab-menu">
            <ul class="flex border-box">
                <li class="border-box">
                    <a href="javascript:void(0)" class="active border-box" data-tab-li-id="tab-1">Round-trip</a>
                </li>
                <li class="border-box">
                    <a href="javascript:void(0)" data-tab-li-id="tab-2">One-way</a>
                </li>
                <li class="border-box">
                    <a href="javascript:void(0)" data-tab-li-id="tab-3">Multi-City</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="form-flight-request-min-inner">
        <?= $this->render('flight-request-min-forms/_flight-request-min-round-trip', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model
        ]) ?>
        <?= $this->render('flight-request-min-forms/_flight-request-min-one-way', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model
        ]) ?>
        <?= $this->render('flight-request-min-forms/_flight-request-min-multi-city', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model
        ]) ?>
    </div>
</div>