<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" prefix="og: http://ogp.me/ns#">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WXFPQ7N');</script>
<!-- End Google Tag Manager -->
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '793532022476125');
    fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=793532022476125&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3V6TN8EEX1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3V6TN8EEX1');
</script>
<meta name="google-site-verification" content="kjkFTFXluay_uZWB18_0Wzu1-8pFiXNIua1DJx3VAXU" />

<!-- Vibe Tracking Scripts -->
<script>
  !function(v,i,b,e,c,o){if(!v[c]){var s=v[c]=function(){s.process?s.process.apply(s,arguments):s.queue.push(arguments)};s.queue=[],s.b=1*new Date;var t=i.createElement(b);t.async=!0,t.src=e;var n=i.getElementsByTagName(b)[0];n.parentNode.insertBefore(t,n)}}(window,document,"script","https://s.vibe.co/vbpx.js","vbpx");
  vbpx('init','0g0UNZ');
  vbpx('event', 'page_view');
  <?php if (Yii::$app->controller->id === 'request' && Yii::$app->controller->action->id === 'flight-request-accepted'): ?>
  vbpx('event', 'lead');
  console.log('Vibe lead event fired on flight confirmation page');
  <?php endif; ?>
  console.log('Vibe tracking loaded - Controller: <?= Yii::$app->controller->id ?>, Action: <?= Yii::$app->controller->action->id ?>');
</script>
<!-- End Vibe Tracking Scripts --> 
</head>
<body class="<?= $this->context->bodyClass; ?>">
<?php $this->beginBody() ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WXFPQ7N"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page-wrapper">
    <?= $this->render('@app/views/layouts/header') ?>
    <?= $this->render('@app/views/layouts/_header-mobile') ?>
    <div id="page">
        <?= $this->render('@app/views/layouts/_breadcrumbs') ?>
        <?= $this->render('@app/views/layouts/_all-flashes') ?>
        <?= $content ?>
        <div class="push"></div>
    </div>
</div>
<?= $this->render('@app/views/layouts/footer') ?>
<?php // Support chat disabled - $this->render('@app/views/layouts/_support-chat') ?>
<script type="text/javascript">
        var dispop_pixel_id = "3ad067416e8b9df40ee91a10d958e804";
        var dispop_advertiser_id = "cebe1eff0954d86b5ed95b37efa7acbb";
        var dispop_service_url = "//dispop.com/view/tags";
        (function () {
            var oldonload = window.onload;
            window.onload = function () {
                var script = document.createElement('script');
                script.src = dispop_service_url + "/track.js";
                script.type = "text/javascript";
                document.body.appendChild(script);
                if (oldonload) { oldonload() }
            };
        }());
</script>
<!-- Botsonic chatbot widget disabled
<script>
	(function (w, d, s, o, f, js, fjs) {
		w["botsonic_widget"] = o;
		w[o] =
			w[o] ||
			function () {
				(w[o].q = w[o].q || []).push(arguments);
			};
		(js = d.createElement(s)), (fjs = d.getElementsByTagName(s)[0]);
		js.id = o;
		js.src = f;
		js.async = 1;
		fjs.parentNode.insertBefore(js, fjs);
	})(window, document, "script", "Botsonic", "https://widget.writesonic.com/CDN/botsonic.min.js");
	Botsonic("init", {
		serviceBaseUrl: "https://api.botsonic.ai",
		token: "ac827286-2531-4632-a0de-43e1cc0b3463",
	});
</script>
-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
