<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\sys\repository\subscribers\models\Subscribers */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form-block">
    <form action="" class="request-subscriber">
        <input type="hidden" class="check-subscription-request-subscriber" name="check_subscription" value="">
        <input type="email" name="email" class="required" placeholder="Your email address" required>
        <button type="submit">Subscribe</button>
        <div class="result border-box"></div>
    </form>
</div>
