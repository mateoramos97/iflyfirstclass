<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use \yii\helpers\Url;
?>
<a href="<?php echo Url::to(['adminarea/blocked-email/create']); ?>" class="btn btn-success btn-lg" style="margin-bottom:30px">Add Email</a>

<?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php foreach($messages as $message): ?>
        <div class="alert alert-<?= $type ?>" role="alert"><?= $message ?></div>
    <?php endforeach ?>
<?php endforeach ?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Blocked Email List</div>
    <div class="all_content">

    </div>
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Email
                </th>
                <th class="last-child">
                    Actions
                </th>
            </tr>
        </thead>
        <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                ],
                'layout' => "<tbody>{items}</tbody></table></div><div style='clear: both;'></div>\n{pager}\n{summary}",
                'itemView' => '_list',
                'itemOptions' => [
                    'tag' => false,
                ],
            ]);
        ?>

</div>
