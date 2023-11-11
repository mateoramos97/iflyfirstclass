<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $request_hotel common\sys\models\request\RequestHotel */

?>
New Hotel Request
Hotel Checkin : <?= Html::encode($request_hotel->hotel_checkin); ?>
Check In: <?= Html::encode($request_hotel->check_in); ?>
Check Out : <?= Html::encode($request_hotel->check_out); ?>
Rooms : <?= Html::encode($request_hotel->rooms_number); ?>
Adults : <?= Html::encode($request_hotel->adults_number); ?>
Children : <?= Html::encode($request_hotel->children_number); ?>
Email : <?= Html::encode($request_hotel->email); ?>
Phone : <?= Html::encode($request_hotel->phone); ?>