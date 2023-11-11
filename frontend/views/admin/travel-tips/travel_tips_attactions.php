<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use \yii\helpers\Url;
use app\components\widgets\admincontentfilter\AdminContentFilterWidget;
?>

<a href="<?php echo Url::to(['adminarea/travel-tips/'.$travel_tips_id]).'/create-travel-tips-attaction'; ?>" class="btn btn-success btn-lg" style="margin-bottom:30px">Add New</a>

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
            <th class="last-child">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($travel_tips_attactions as $key => $item) { ?>
        <tr>
            <th>
                <?= Html::encode($item['id']) ?>
            </th>
            <td>
                <?= Html::encode($item['title']) ?>
            </td>
            <td class="last-child">
                <div style="display: inline-block;">
                    <a href="<?php echo Url::to(['adminarea/travel-tips/']).'/'.Html::encode($item['travel_tips_id']).'/edit-travel-tips-attaction/'.$item['id']; ?>" class="btn btn-primary">Edit</a>
                </div>
                <div style="display: inline-block;">
                    <form action="<?php echo Url::to(['adminarea/travel-tips/']).'/'.Html::encode($item['travel_tips_id']).'/delete-travel-tips-attaction/'.$item['id']; ?>" method="post">
                        <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php } ?>
        </tbody>
</div>