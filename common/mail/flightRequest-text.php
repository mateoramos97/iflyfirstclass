<?php
use yii\helpers\Html;
use \app\components\AppConfig;
?>
    CONTACT INFO:
    Name: <?= Html::encode($data['flight_request']['name']) ?>
    Telephone: <?= Html::encode($data['flight_request']['phone']) ?>
    Email: <?= Html::encode($data['flight_request']['email']) ?>
<?php if ($data['flight_request']['type_trip'] != AppConfig::Type_Trip_Multi_City) { ?>
    FLIGHT DETAILS:
<?php } else { ?>
    MULTICITY FLIGHT DETAILS:
<?php } ?>
    <br/>
<?php foreach ($data['trips'] as $key => $item) { ?>
    From: <?= Html::encode($item['from']) ?>
    To: <?= Html::encode($item['to']) ?>
    Departure Date: <?= Html::encode($item['dep_date']) ?>
    <?php if ($item['arr_date'] != null) { ?>
        Return Date: <?= Html::encode($item['arr_date']) ?>
    <?php } ?>
<?php } ?>
    Class: <?php echo $data['flight_request']['cabin_class_name'] == '2' ?
    'First Class' : 'Business Class'; ?>
    Number of Passengers: <?= Html::encode($data['flight_request']['people_number']) ?>
Thank you! You will be contacted by our representative.
This mail is sent via Fast Free Quote Form on <a href="#">FlyFirst.com</a>
