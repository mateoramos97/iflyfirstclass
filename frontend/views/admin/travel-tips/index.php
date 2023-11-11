<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\admincontentfilter\AdminContentFilterWidget;
?>
<a href="<?php echo Url::to(['admin/travel-tips/create']); ?>" class="btn btn-success btn-lg" style="margin-bottom:30px">Add New</a>

<?= AdminContentFilterWidget::widget([
    'page' => \app\components\AdminAppConfig::Filter_Travel_Tips_Page,
    'filter_values' => $filter_values,
    'parametrs' => array(),
]) ?>

<?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php foreach($messages as $message): ?>
        <div class="alert alert-<?= $type ?>" role="alert"><?= $message ?></div>
    <?php endforeach ?>
<?php endforeach ?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Continent List</div>
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
                Title
            </th>
            <th>
                Alias
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
            'itemView' => '_travel_tips_list',
            'itemOptions' => [
                'tag' => false,
            ],
        ]);
        ?>
</div>
