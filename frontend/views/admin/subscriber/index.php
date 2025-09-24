<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>

<div class="subscriber-index">
    <h1>Flight Request Users</h1>
    
    <div class="mb-3">
        <?= Html::a('Download CSV', ['download-csv'], [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            'phone',
            'request_number',
            [
                'attribute' => 'cabin_class_name',
                'label' => 'Cabin Class',
                'value' => function($model) {
                    return $model->cabin_class_name == '1' ? 'Business' : 'First';
                }
            ],
            'people_number',
            [
                'attribute' => 'created_date',
                'label' => 'Created Date',
                'value' => function($model) {
                    return $model->created_date;
                }
            ],
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'headerRowOptions' => ['class' => 'thead-dark'],
    ]); ?>
</div>

<style>
.subscriber-index {
    padding: 20px;
}
.btn {
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 10px;
}
.btn-success {
    background-color: #28a745;
    color: white;
    border: 1px solid #28a745;
}
.btn-success:hover {
    background-color: #218838;
    color: white;
}
.table {
    width: 100%;
    border-collapse: collapse;
}
.table th, .table td {
    padding: 8px 12px;
    text-align: left;
    border: 1px solid #ddd;
}
.thead-dark th {
    background-color: #343a40;
    color: white;
}
.table-striped tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}
.mb-3 {
    margin-bottom: 1rem;
}
h1 {
    margin-bottom: 20px;
    color: #333;
}
</style>
