<?php
use \yii\helpers\Url;
?>

<header class="header-mobile-wrapper xl:hidden  box-border">
    <div class="header-head relative pl-5 py-2 pr-2 flex justify-center w-full">
		<div class="open-menu"></div>
		<div class="logo">
			<a href="<?= Url::home(true); ?>">
				<img src="/public/img/mobile-logo.png" alt="mobile-logo" width="215" height="52">
			</a>
		</div>
		<a class="icon-phone-link" href="tel:+18883477817"><i class="icon-phone text-lg text-brown"></i></a>
	</div>
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