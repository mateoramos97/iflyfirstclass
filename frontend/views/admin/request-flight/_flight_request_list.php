<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use \yii\helpers\Url;
?>
<tr>
    <th>
        <?= Html::encode($model['id']) ?>
    </th>
    <td>
        <?= Html::encode($model['email']) ?>
    </td>
    <td>
        <?= Html::encode($model['request_number']) ?>
    </td>
    <td>
        <?= Html::encode($model['created_date']) ?>
    </td>
    <td class="last-child">
        <div style="display: inline-block;">
            <a href="<?php echo Url::to(['adminarea/request-flight/'.$model['id']]).'/request-flight-details'; ?>" class="btn btn-success">Details</a>
        </div>
    </td>
</tr>