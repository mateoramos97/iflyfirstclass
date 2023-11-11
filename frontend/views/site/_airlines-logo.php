<?php
use \yii\helpers\Url;

$path_icons =  Url::base().'/design/icons/';
?>

<div class="airlines-block-wrapper border-box">
    <div class="container-wrapper">
        <div class="title">
            We work with All major Airlines
        </div>
        <div class="line-separator"></div>
        <div class="flex flex-justify-between">
            <a rel="nofollow" href="http://www.emirates.com" onmouseover="document.getElementById('imgAirlineEmirates').src='<?= $path_icons . 'emirates.svg' ?>';" onmouseout="document.getElementById('imgAirlineEmirates').src='<?= $path_icons . 'emirates.svg' ?>';">
                <img src="<?= $path_icons.'emirates.svg' ?>" id="imgAirlineEmirates" alt="emirates">
            </a>
            <a rel="nofollow" href="http://BA.com" onmouseover="document.getElementById('imgAirlineBritish').src='<?= $path_icons . 'british.svg' ?>';" onmouseout="document.getElementById('imgAirlineBritish').src='<?= $path_icons . 'british.svg' ?>';">
                <img src="<?= $path_icons.'british.svg' ?>" id="imgAirlineBritish" alt="British airways">
            </a>
            <a rel="nofollow" href="http://www.delta.com" onmouseover="document.getElementById('imgAirlineDelta').src='<?= $path_icons . 'delta.svg' ?>';" onmouseout="document.getElementById('imgAirlineDelta').src='<?= $path_icons . 'delta.svg' ?>';">
                <img src="<?= $path_icons . 'delta.svg' ?>" id="imgAirlineDelta" alt="delta">
            </a>
            <a rel="nofollow" href="http://www.cathaypacific.com" onmouseover="document.getElementById('imgAirlineCathay').src='<?= $path_icons . 'cathay-pacific.svg' ?>';" onmouseout="document.getElementById('imgAirlineCathay').src='<?= $path_icons . 'cathay-pacific.svg' ?>';">
                <img src="<?= $path_icons . 'cathay-pacific.svg' ?>" id="imgAirlineCathay" alt="Cathay Pacific">
            </a>
            <a rel="nofollow" href="http://www.lufthansa.com" onmouseover="document.getElementById('imgAirlineLufthansa').src='<?= $path_icons . 'lufthansa.svg' ?>';" onmouseout="document.getElementById('imgAirlineLufthansa').src='<?= $path_icons . 'lufthansa.svg' ?>';">
                <img src="<?= $path_icons . 'lufthansa.svg' ?>" id="imgAirlineLufthansa" alt="Lufthansa">
            </a>
        </div>
        <div class="bottom-content flex flex-justify-center">and many more ...</div>
    </div>
</div>