<?php
use yii\helpers\Html;
use common\components\AppConfig;
?>

<center>
    <img src="https://www.iflyfirstclass.com/design/mail/iffc-mail-img.jpg" width="640" height="198" alt="IFlyFirstClass" style="display:block;">
    <table border="0" cellpadding="0" cellspacing="0" style="width:640px;margin:0;padding:40px;">
        <tr>
            <td colspan="2" style="font-size:24px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:30px;">
                Quote Request Confirmation
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:30px;">
                Reference Number
                <div style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#ffffff;width:130px;height:26px;background-color:#fb8c00;text-align:center;line-height:26px;border-radius:3px; margin-top:15px;">
                    IFFCN-<?= Html::encode($data['request_number']) ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:24px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:30px;">
                Contact info
            </td>
        </tr>
        <tr>
            <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                Name:
            </td>
            <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                <?= Html::encode($data['flight_request']['name']) ?>
            </td>
        </tr>
        <tr>
            <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                Telephone:
            </td>
            <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                <?= Html::encode($data['flight_request']['phone']) ?>
            </td>
        </tr>
        <tr>
            <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                Email:
            </td>
            <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                <?= Html::encode($data['flight_request']['email']) ?>
            </td>
        </tr>
        <?php if ($data['flight_request']['type_trip'] != AppConfig::Type_Trip_Multi_City) { ?>
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
        <?php foreach ($data['trips'] as $key => $item) { ?>
            <?php if ($data['flight_request']['type_trip'] == AppConfig::Type_Trip_Multi_City) { ?>
                <tr>
                    <td colspan="2" style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                        DESTINATION #<?php echo $key + 1; ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                    From:
                </td>
                <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                    <?= Html::encode($item['from']) ?>
                </td>
            </tr>
            <tr>
                <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                    To:
                </td>
                <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                    <?= Html::encode($item['to']) ?>
                </td>
            </tr>
            <tr>
                <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                    Departure Date:
                </td>
                <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                    <?= Html::encode($item['dep_date']) ?>
                </td>
            </tr>
            <?php if ($item['arr_date'] != null) { ?>
                <tr>
                    <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                        Return Date:
                    </td>
                    <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#212121;padding-bottom:20px;">
                        <?= Html::encode($item['arr_date']) ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        <tr>
            <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                Class:
            </td>
            <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#1976d2;padding-bottom:20px;">
                <?php echo $data['flight_request']['cabin_class_name'] == '2' ? 'First Class' : 'Business Class'; ?>
            </td>
        </tr>
        <tr>
            <td style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#757575;padding-bottom:20px;">
                Number of Passengers:
            </td>
            <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#1976d2;padding-bottom:20px;">
                <?= Html::encode($data['flight_request']['people_number']) ?>
            </td>
        </tr>
    </table>
    <div style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#757575;width:640px;background-color:#eeeeee;padding:20px 0px 20px 0px;line-height:24px;">
        Thank you! You will be contacted by our representative.<br>
        This email is sent via Fast Free Quote Form on IFlyFirstClass.com
    </div>
</center>