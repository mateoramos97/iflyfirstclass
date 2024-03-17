<?php
use \yii\helpers\Url;
?>

<header class="header-mobile-wrapper xl:hidden flex justify-between items-center box-border pl-4 py-3 pr-2 shadow">
    <div class="open-menu"></div>
    <div class="logo">
        <a href="<?= Url::home(true); ?>">
            <img class="scale-85" src="/public/img/logo.svg" alt="">
        </a>
    </div>
    <div class="tel bg-secondary rounded-xl p-3"><a href="tel:+18883477817"></a><i class="icon-phone text-lg text-brown"></i></div>
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
                <a href="tel:+18883477817">+1 888 347 7817</a>
            </div>
        </div>
    </div>
</header>