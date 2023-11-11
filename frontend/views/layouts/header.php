<?php
use \yii\helpers\Url;

use app\components\widgets\custom\LandingHeaderMenu;

$path_logo =  Url::base().'/design/iffc-logo.svg';

?>
<div id="header-wrapper" class="header-wrapper">
    <div class="header p-relative flex flex-row">
        <div itemscope="" itemtype="http://schema.org/Organization" id="logo" class="logo">
            <a itemprop="url" href="<?= Url::home(true); ?>">
                <img itemprop="logo" src="<?= $path_logo ?>" alt="">
            </a>
        </div>
        <div class="header-inner flex flex-column">
            <div class="info flex flex-justify-end flex-align-center" itemscope="" itemtype="http://schema.org/Organization">
                <div class="phone flex flex-align-center">
                    <div class="icon-phone"></div>
                    <span class="title">Call for an exclusive deals!&nbsp;</span>
                    <span itemprop="telephone">1 888 347 7817</span>
                </div>
                <div class="country flex flex-align-center">
                    US Based Company
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAYCAYAAACFms+HAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAALqADAAQAAAABAAAAGAAAAAB882kiAAACkUlEQVRYCdWXS2gTURSG/7GTxgYyTZM0DzGPWpLaBJFiBKENXQQRIShYdRcXgi0NoltxIeJCBXfqRqol4EZdKIj4WLWpLU1ExTalBloIKLQblRasNs9x7g2TJoaAlrkDOYvw5WT4z50z5zHhjvRHxZ1tWmz+zoLYdvlcLgM9ClSD9ceB2zew4xenwckzR7HZ0grCQ5Eyb4Cv4yyvhez/m0WOY33eGn1uoP+CSDx+vxtGk4C3U/OUTWYBU/F5+PwudJoNiMfn4PNJ3LnFFosBk5NzVPDps2vSb+014iy/cMGBi2Io1Ifp6RSKxRIGB/c35JmZBRQKRXpNNZPD37t8AiaDjuVZK9rCXg94URSxuvoDuVwBer2uwoJQz9lsHrK/msnNvD9/CfpiuU8qERjBodgdqZAlS6e/wOt1wGjUI5n8DI9nN0ipJBP1bDa3I5FYpNfITDQcQ2F0aFsIMre2XTbQGo9Gj2Ns7AXy+SJGo8fw4P5L+gT+hx89vqJujcvN6XJZ4XJbaUM6nRZ0ddlpQ1azw2FBd7edNmQ1kxRfD9pVy7g7cqqc8UDAi+XlFak5i+jpcdTw0tIKSqWyvxGnUhmc/ZpQv8Y1Gh5raz+h02nB87W8vr7lb8SkUQN3b6o7Vchjnp1drJvX8owms1vm3l4nbDYjJiY+oZqJRkffPpjUnOOkxkdGwhgff0Wb8194eDiMWOw1bWCZRzfSEMQ8uQfmRlY+R95VNK088tIcJ7ZdVvtdhZMWEF35zNOkcAD++7uPCkuylyMrn3u+J9B0Gacrvytymn2KFI5AV37T1vjC1VsK54O9HFn5fObhE/aRFI5gDQXBfUt+aLrmpFOlWWuce3PwcNNlnP7LV7j8VJP7AwY7h/EZk11HAAAAAElFTkSuQmCC" alt="">
                </div>
            </div>
            <div class="main-nav nav flex flex-justify-center">
                <ul class="container-wrapper flex flex-row">
                    <li>
                        <span id="menu-service" data-menu="menu-service"
                            class="<?php echo in_array($this->context->route, [
                                'service/first-class', 'service/business-class', 'service/hotel'
                            ]) ? 'menu current-page' : 'menu'; ?>"
                        >
                            Services
                        </span>
                    </li>
                    <li>
                        <a href="<?= Url::to(['static-page/last-minute-deals']); ?>"
                            class="<?php echo $this->context->route == 'static-page/last-minute-deals' ? 'current-page' : ''; ?>">
                            Last minute deals
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['static-page/corporate-account']); ?>"
                            class="<?php echo $this->context->route == 'static-page/corporate-account' ? 'current-page' : ''; ?>">
                           Corporate accounts
                        </a>
                    </li>
                    <li>
                        <span id="menu-tools" data-menu="menu-tools"
                            class="<?php echo in_array($this->context->route, [
                                'tools/flight-tracker', 'tools/visa', 'tools/request-quote'
                            ]) ? 'menu current-page' : 'menu'; ?>"
                        >
                            Tools
                        </span>
                    </li>
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
                    <span id="menu-cc" class="menu" data-menu="menu-cc">
                        Cities & Countries
                    </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="p-relative menu-sub-wrapper">
        <div id="menu-service-sub" class="menu-sub" data-menu="menu-service">
            <div class="menu-content container-wrapper border-box">
                <ul class="flex flex-row">
                    <li>
                        <a href="<?= Url::to(['service/first-class']); ?>">First Class</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/business-class']); ?>">Business Class</a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['service/hotel']); ?>">Hotels</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="menu-tools-sub" class="menu-sub" data-menu="menu-tools">
            <div class="menu-content container-wrapper border-box">
                <ul class="flex flex-row">
                    <li>
                        <a href="<?= Url::to(['tools/flight-tracker']); ?>">
                           Flight Tracker
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['tools/visa']); ?>">
                            Visa
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['tools/request-quote']); ?>">
                           Request Quote
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="menu-cc-sub" class="menu-sub menu-cc-sub" data-menu="menu-cc">
            <?= LandingHeaderMenu::widget() ?>
        </div>
    </div>
</div>