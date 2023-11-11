<?php
use yii\helpers\Html;
use \app\components\AppConfig;
?>

<div>
    <table class="table">
        <tr>
            <td>
                Reference Number: <strong>IFFCN-<?= Html::encode($request['request_number']) ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                Name: <strong><?= Html::encode($request['name']) ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                Telephone: <strong><?= Html::encode($request['phone']) ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                Email: <strong><?= Html::encode($request['email']) ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                Class: <strong><?php echo $request['cabin_class_name'] == '2' ? 'First Class' : 'Business Class'; ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                Number of Passengers: <strong><?= Html::encode($request['people_number']) ?></strong>
            </td>
        </tr>

        <?php if ($request['type_trip'] != AppConfig::Type_Trip_Multi_City) { ?>
            <tr>
                <td colspan="2" style="font-size:24px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:30px;padding-top:20px;">
                    Flight details
                </td>
            </tr>
        <?php } else { ?>
            <tr>
                <td colspan="2" style="font-size:24px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:30px;padding-top:20px;">
                    MULTICITY FLIGHT DETAILS:
                </td>
            </tr>
        <?php } ?>

        <?php foreach ($details as $key => $item) { ?>
            <?php if ($request['type_trip'] == AppConfig::Type_Trip_Multi_City) { ?>
                <tr>
                    <td colspan="2" style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                        DESTINATION #<?php echo $key + 1; ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                    From: <strong><?= Html::encode($item['from_air']) ?></strong>
                </td>
            </tr>
            <tr>
                <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                    To: <strong><?= Html::encode($item['to_air']) ?></strong>
                </td>
            </tr>
            <tr>
                <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                    Departure Date: <strong><?= Html::encode($item['departure']) ?></strong>
                </td>
            </tr>
            <?php if ($item['arrival'] != null) { ?>
                <tr>
                    <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                        Return Date: <strong><?= Html::encode($item['arrival']) ?></strong>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>

    
</div>