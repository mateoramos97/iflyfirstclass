<?php
use yii\helpers\Url;
?>
<div class="menu-block-wrapper sliderbar-menu">
    <div class="menu-header">
        <a href="<?php echo Url::to(['admin/home/index']); ?>">
            <img src="/admin/design/admin-logo-menu.png" alt="">
        </a>
    </div>
    <div class="menu-block-inner">
        <div class="nav">
            <ul>
                <li class="sub-menu-block li-link-menu border-box">
                    <a href="<?php echo Url::to(['admin/request-flight/index']); ?>" class="link-menu">Requests</a>
                </li>
                <li class="sub-menu-block border-box">
                    <a href="#" class="sub-menu border-box">
                        Landing
                        <span class="icon"></span>
                    </a>
                    <ul class="nav-menu-block active">
                        <li>
                            <a href="<?php echo Url::to(['admin/continent/index']); ?>" class="link border-box">
                                Continents
                            </a>
                            <a href="<?php echo Url::to(['admin/continent/create']); ?>" class="add-new border-box">Add New</a>
                        </li>
                        <li>
                            <a href="<?php echo Url::to(['admin/country/index']); ?>" class="link border-box">
                                Countries
                            </a>
                            <a href="<?php echo Url::to(['admin/country/create']); ?>" class="add-new">Add New</a>
                        </li>
                        <li>
                            <a href="<?php echo Url::to(['admin/city/index']); ?>" class="link border-box">
                                City
                            </a>
                            <a href="<?php echo Url::to(['admin/city/create']); ?>" class="add-new">Add New</a>
                        </li>
                        <li>
                            <a href="<?php echo Url::to(['admin/airline/index']); ?>" class="link border-box">
                                Airline
                            </a>
                            <a href="<?php echo Url::to(['admin/airline/create']); ?>" class="add-new">Add New</a>
                        </li>
                        <li>
                            <a href="<?php echo Url::to(['admin/direction-city/index']); ?>" class="link border-box">
                                Directions Cities
                            </a>
                            <a href="<?php echo Url::to(['admin/direction-city/create']); ?>" class="add-new">Add New</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-menu-block li-link-menu border-box">
                    <a href="<?php echo Url::to(['admin/blog/index']); ?>" class="link-menu">Blog</a>
                    <a href="<?php echo Url::to(['admin/blog/create']); ?>" class="add-new">Add New</a>
                </li>
                <li class="sub-menu-block li-link-menu border-box">
                    <a href="<?php echo Url::to(['admin/travel-tips/index']); ?>" class="link-menu">Travel Tips</a>
                    <a href="<?php echo Url::to(['admin/travel-tips/create']); ?>" class="add-new">Add New</a>
                </li>
                <li class="sub-menu-block li-link-menu border-box">
                    <a href="<?php echo Url::to(['admin/testimonials/index']); ?>" class="link-menu">Testimonials</a>
                    <a href="<?php echo Url::to(['admin/testimonials/create']); ?>" class="add-new">Add New</a>
                </li>
                <li class="sub-menu-block li-link-menu border-box">
                    <a href="<?php echo Url::to(['admin/static-page/index']); ?>" class="link-menu">Static Pages</a>
                </li>
                <li class="sub-menu-block border-box">
                    <a href="#" class="sub-menu border-box">
                        Emails
                        <span class="icon"></span>
                    </a>
                    <ul class="nav-menu-block active">
                        <li>
                            <a href="<?php echo Url::to(['admin/subscriber/index']); ?>" class="link border-box">Subscribers</a>
                        </li>
                        <li>
                            <a href="<?php echo Url::to(['admin/request-form-user/flight-emails']); ?>" class="link border-box">Request Form</a>
                        </li>
                        <li>
                            <a href="<?php echo Url::to(['admin/blocked-email/index']); ?>" class="link border-box">Blocked Emails</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
