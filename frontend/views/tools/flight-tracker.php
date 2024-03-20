<?php

/* @var $this yii\web\View */

use \yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Flight tracker';

$date_now = new DateTime();
$before_date = new DateTime();
$before_date->modify('-1 day');
$after_date = new DateTime();
$after_date->modify('+1 day');
?>
<div class="container mx-auto xl:px-12 px-4">
	<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
</div>

<div class="container mx-auto xl:px-12 px-4 flight-tracker-title">
    <h1>Flight tracker</h1>
</div>
<div class="container mx-auto xl:px-12 px-4 form-tracker">
    <div class="form-request">
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'action' => 'https://www.flightstats.com/go/FlightTracker/flightTracker.do',
            'fieldConfig' => [
                'template' => "{input}",
            ]
        ]) ?>
            <div class="row row-1">
                <div class="component-wrapper">
                    <input type="text" name="airline" class="component component-airline airline-autocomplete ui-autocomplete-input bg-white w-full" autocomplete="off" placeholder="Airline">
                </div>
                <div class="component-wrapper">
                    <input type="text" name="flightNumber" class="component component-flightnum bg-white" placeholder="Flight Number">
                </div>
                <div class="component-wrapper">
                    <select name="departureDate" class="component component-depdate bg-white">
                        <option disabled="disabled">Departure Date</option>
                        <option value="<?php echo  $before_date->format('Y-m-d'); ?>">
                            <?php echo $before_date->format('F-j-Y'); ?>
                        </option>
                        <option value="<?php echo  $date_now->format('Y-m-d'); ?>" selected="selected">
                            <?php echo $date_now->format('F-j-Y'); ?>
                        </option>
                        <option value="<?php echo  $after_date->format('Y-m-d'); ?>">
                            <?php echo $after_date->format('F-j-Y'); ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="row row-2">
                If you do not know the flight number, specify the airline and the departure and/or arrival airports to view a list of flights
                <div class="texture"></div>
            </div>
            <div class="row row-3">
                <div class="component-wrapper">
                    <input type="text" name="departure" class="component component-depairport airport-autocomplete ui-autocomplete-input bg-white" autocomplete="off" placeholder="Departure Airport (Optional)">
                </div>
                <div class="component-wrapper">
                    <input type="text" name="arrival" class="component component-arrairport airport-autocomplete ui-autocomplete-input bg-white" autocomplete="off" placeholder="Arrival Airport (Optional)">
                </div>
            </div>
            <div class="row row-4">
                <input type="submit" value="Track" class="button-submit">
            </div>
            <div class="row row-5">
                <p>Want to check out the Flight Tracker but don't have a flight number ?</p>
                <a href="http://www.flightstats.com/go/FlightTracker/flightTracker.do?randomFlight=true" class="button-1">Track Random Flight</a>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
