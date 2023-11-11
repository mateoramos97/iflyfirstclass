<?php
use \yii\helpers\Url;
use app\components\widgets\request\RequestSubscriber;

$path_icons =  Url::base().'/design/icons/';
?>
<footer class="footer border-box">
    <div class="container-wrapper">
        <div class="row row-1">
            <div class="flex flex-justify-between">
                <div class="column column-1 flex flex-column">
                    <div class="title">
                        Connect with iFlyFirstClass
                    </div>
                    <div class="facebook flex flex-align-center">
                        <div class="column-left">
                            <a rel="nofollow" href="https://www.facebook.com/pages/I-Fly-First-Class/350113835017059" onMouseOver="document.getElementById('imgSocialFB').src='<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>';" onMouseOut="document.getElementById('imgSocialFB').src='<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>';"><img src="<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>" id="imgSocialFB" alt="facebook"></a>
                        </div>
                        <div class="column-right">
                            <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FI-Fly-First-Class%2F350113835017059&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;locale=en_US" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
                        </div>
                    </div>
                    <div class="copyright-protected">
                        <img src="<?= $path_icons . 'copyrigcht-protected.svg' ?>" alt="">
                    </div>
                </div>
                <div class="column column-2 flex flex-column">
                    <div class="title">
                        Email Subscription
                    </div>
                    <div class="sub-title">
                        Receive monthly cool ideas, inspiring stories,<br /> great reviews and offers
                    </div>
                    <div class="subscription p-relative">
                        <form action="" class="request-subscriber">
                            <input type="hidden" class="check-subscription-request-subscriber" name="check_subscription" value="">
                            <input type="email" name="email" class="border-box required" placeholder="Your email address" required="">
                            <button type="submit" class="p-absolute">Submit</button>
                            <div class="result border-box"></div>
                        </form>
                    </div>
                    <div class="shopperapproved">
                        <a href="http://www.shopperapproved.com/reviews/iflyfirstclass.com/" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; var certheight=screen.availHeight-90; window.open(this.href,'shopperapproved','location='+nonwin+',scrollbars=yes,width=620,height='+certheight+',menubar=no,toolbar=no'); return false;"><img src="https://c683207.ssl.cf2.rackcdn.com/12885-m.gif" style="border: 0" alt="" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 '+d.getFullYear()+'.'); return false;" /></a>
                    </div>
                </div>
                <div class="column column-3">
                    <div class="flex flex-justify-between">
                        <div class="menu">
                            <div class="title">
                                Site Map
                            </div>
                            <ul>
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['static-page/corporate-account']); ?>">Corporate accounts</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['blog/list']); ?>">Blog</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['static-page/testimonials']); ?>">Testimonials</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['static-page/about']); ?>">About Us</a>
                                </li>
                                <li>
                                   <!-- <a href="<?= Url::to(['site-map-page/index']); ?>">Sitemap</a> -->
                                     <a href="/sitemap.xml">Sitemap</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu services">
                            <div class="title">
                                Services
                            </div>
                            <ul>
                                <li>
                                    <a href="<?= Url::to(['service/first-class']); ?>">First class</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['service/business-class']); ?>">Business</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['service/hotel']); ?>">Hotels</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu tools">
                            <div class="title">
                                Tools
                            </div>
                            <ul>
                                <li>
                                    <a href="<?= Url::to(['tools/flight-tracker']); ?>">Flight tracker</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['tools/visa']); ?>">Visa</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['tools/request-quote']); ?>">Request quote</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bootom">
        <div class="container-wrapper flex flex-justify-between flex-align-center">
            <img src="<?= $path_icons . 'GineeX.svg' ?>" alt="">
            <p>
                © 2022 IFlyFirstClass. All rights Reserved. Registered in accordance to California State regulations # 2107775-40. Use of this Web site constitutes acceptance of the <a href="javascript:void(0);" class="terms-conditions-link" onclick="openTermsConditions(this)">Terms of Service</a> and Privacy Policy. Designated trademarks and brands are the property of their respective owners.
            </p>
            <img src="<?= $path_icons . 'footer-cred-logo-white.png' ?>" alt="">
            <?= $this->render('_footer-terms-conditions') ?>
        </div>
    </div>
</footer>