<?php
use \yii\helpers\Url;

$path_logo =  Url::base().'/design/iffc-logo.svg';
?>

<div class="header-mobile-wrapper flex flex-justify-between flex-align-center border-box">
    <div class="open-menu"></div>
    <div class="logo">
        <a href="<?= Url::home(true); ?>">
            <img src="<?= $path_logo ?>" alt="">
        </a>
    </div>
    <div class="tel"><a href="tel:+18883477817"></a></div>
    <div class="left-menu">
        <div class="left-menu-inner border-box">
            <div class="close-menu"></div>
            <div class="nav-menu">
                <ul>
                    <li>
                        <a href="<?= Url::to(['blog/list']); ?>"
                           class="<?php echo $this->context->route == 'blog/list' ? 'current-page' : ''; ?>">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['travel-tips/list']); ?>"
                           class="<?php echo $this->context->route == 'travel-tips/list' ? 'current-page' : ''; ?>">
                            Travel Tips
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['static-page/about']); ?>"
                           class="<?php echo $this->context->route == 'static-page/about' ? 'current-page' : ''; ?>">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/first-class']); ?>"
                            class="<?php echo $this->context->route == 'service/first-class' ? 'current-page' : ''; ?>">
                            First Class
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/business-class']); ?>"
                            class="<?php echo $this->context->route == 'service/business-class' ? 'current-page' : ''; ?>">
                            Business Class
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tel-menu">
                <span>Call Us Now</span>
                <br />
                <a href="tel:+18003851359">1 800 385 1359</a>
            </div>
        </div>
    </div>
</div>