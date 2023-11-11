<?php
/* @var $model \common\sys\models\request\FlightRequestMax */
?>

<div class="form-flight-request-max-wrapper form-flight-request border-box">
    <h3>Flight Search</h3>
    <div class="form-nav">
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
    <div class="clearfix"></div>
    <div class="form-flight-request-max-inner">
        <?= $this->render('flight-request-max-forms/_flight-request-max-round-trip', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model
        ]) ?>
        <?= $this->render('flight-request-max-forms/_flight-request-max-one-way', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model
        ]) ?>
        <?= $this->render('flight-request-max-forms/_flight-request-max-multi-city', [
            'cabin_class' => $cabin_class,
            'number_persones' => $number_persones,
            'model' => $model
        ]) ?>
    </div>
</div>