<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" prefix="og: http://ogp.me/ns#">
<head>
	<?= $this->render('@app/views/layouts/_head') ?>
</head>
<body class="<?= $this->context->bodyClass; ?>">
<?php $this->beginBody() ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WXFPQ7N"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="flex flex-col h-full relative" id="app" v-cloak">
	<?= $this->render('@app/views/layouts/header') ?>
	<?= $this->render('@app/views/layouts/_header-mobile') ?>
	<div id="page-wrapper flex-auto">
		<div id="page">
			<?= $this->render('@app/views/layouts/_all-flashes') ?>
			<?= $content ?>
			<div class="push"></div>
		</div>
	</div>
	<?= $this->render('@app/views/layouts/footer') ?>
	<?= $this->render('@app/views/layouts/_support-chat') ?>
</div>
<?= $this->render('@app/views/layouts/_scripts') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
