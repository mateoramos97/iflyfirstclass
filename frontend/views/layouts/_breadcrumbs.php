<?php

use \yii\helpers\Url;
use app\components\widgets\breadcrumbs\BreadcrumbsMicrodata;

?>

<?php if (isset($this->params['breadcrumbs'])) { ?>
    <div class="bread-crumbs-wrapper flex items-center">
        <?= BreadcrumbsMicrodata::widget([
            'options' => [
                'class' => 'breadcrumb container-wrapper',
            ],
            'homeLink' => [
                'label' => Yii::t('yii', 'iflyfirstclass.com'),
                'url' => Url::home(true),
                'class' => 'home',
                'template' => '<li>{link}</li>',
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'itemTemplate' => '<li>{link}</li>',
            'activeItemTemplate' => '<li class="active link">{link}</li>',
            'tag' => 'ul',
            'encodeLabels' => false
        ]); ?>
    </div>
<?php } ?>