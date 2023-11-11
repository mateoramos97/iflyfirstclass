<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $request_hotel common\sys\models\request\RequestHotel */

?>
<p>New Hotel Request</p>
<p>
    <strong>Hotel Checkin</strong> : <?= Html::encode($request_hotel->hotel_checkin); ?>
</p>
<p>
    <strong>Check In</strong> : <?= Html::encode($request_hotel->check_in); ?>
</p>
<p>
    <strong>Check Out</strong> : <?= Html::encode($request_hotel->check_out); ?>
</p>
<p>
    <strong>Rooms</strong> : <?= Html::encode($request_hotel->rooms_number); ?>
</p>
<p>
    <strong>Adults</strong> : <?= Html::encode($request_hotel->adults_number); ?>
</p>
<p>
    <strong>Children</strong> : <?= Html::encode($request_hotel->children_number); ?>
</p>
<p>
    <strong>Name</strong> : <?= Html::encode($request_hotel->name); ?>
</p>
<p>
    <strong>Email</strong> : <?= Html::encode($request_hotel->email); ?>
</p>
<p>
    <strong>Phone</strong> : <?= Html::encode($request_hotel->phone); ?>
</p>