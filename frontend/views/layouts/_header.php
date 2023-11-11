<?php
use \yii\helpers\Url;

?>
<div id="header-top" class="header-top border-box">
    <div class="logo">
        <a href="/">
            <div class="icon"></div>
            <span>FlyFirst</span>
        </a>
    </div>
    <div class="nav-menu header-nav-menu border-box">
        <ul>
            <li class="drop">
                <a href="javascript:void(0)">Services <span class="bar"></span></a>
                <ul>
                    <li>
                        <a href="<?= Url::to(['service/business-class']); ?>">Business Class</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/first-class']); ?>">First Class</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/corporate-account']); ?>">Corporate accounts</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/hotel']); ?>">Hotels</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= Url::to(['blog/list']); ?>"
                   class="<?php echo \Yii::$app->controller->id == 'blog' ? 'active' : ''; ?>">
                    Blog <span class="bar"></span>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['travel-tips/list']); ?>"
                   class="<?php echo \Yii::$app->controller->id == 'travel-tips' ? 'active' : ''; ?>">
                    Travel tips <span class="bar"></span>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['static-page/about']); ?>"
                   class="<?php echo \Yii::$app->controller->id == 'static-page' ? 'active' : ''; ?>">
                    About Us <span class="bar"></span>
                </a>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>