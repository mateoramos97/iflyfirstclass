<?php
use yii\helpers\Html;
use \yii\helpers\Url;

?>

<?php foreach (Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php foreach ($messages as $message): ?>
        <div class="alert alert-<?= $type ?>" role="alert"><?= $message ?></div>
    <?php endforeach ?>
<?php endforeach ?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Blog List</div>
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
                Admin Title
            </th>
            <th class="last-child">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($static_pages as $key => $item): ?>
            <tr>
                <th>
                    <?= Html::encode($item['id']) ?>
                </th>
                <td>
                    <?= Html::encode($item['title']) ?>
                </td>
                <td>
                    <?= Html::encode($item['admin_title']) ?>
                </td>
                <td class="last-child">
                    <div style="display: inline-block;">
                        <a href="<?php echo Url::to(['adminarea/static-page/edit']) . '/' . Html::encode($item['id']); ?>"
                           class="btn btn-primary">
                            Edit
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>