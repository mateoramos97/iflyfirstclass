<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use \yii\helpers\Url;
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Requests</div>
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
            <th>
                Request number
            </th>
            <th>
                Created
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
            'itemView' => '_flight_request_list',
            'itemOptions' => [
                'tag' => false,
            ],
        ]);
        ?>
</div>
