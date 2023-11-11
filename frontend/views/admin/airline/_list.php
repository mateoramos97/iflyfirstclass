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
        <?= Html::encode($model['name']) ?>
    </td>
    <td>
        <?= Html::encode($model['alias']) ?>
    </td>
    <td class="last-child">
        <div style="display: inline-block;">
            <a href="<?php echo Url::to(['adminarea/airline/edit']).'/'.Html::encode($model['id']); ?>" class="btn btn-primary">Edit</a>
        </div>
        <div style="display: inline-block;">
            <form action="<?php echo Url::to(['adminarea/airline/delete/']).'/'.Html::encode($model['id']); ?>" method="post">
                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</button>
            </form>
        </div>
    </td>
</tr>