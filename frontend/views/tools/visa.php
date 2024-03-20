<?php

/* @var $this yii\web\View */

use \yii\helpers\Url;

$this->title = $static_page->title;
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $static_page->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $static_page->description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true) . Yii::$app->request->url,]);
$this->registerMetaTag(['property' => 'og:image', 'content' => '']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . Yii::$app->request->url]);

$this->params['breadcrumbs'][] = 'Visa';

?>

<div class="container mx-auto xl:px-12 px-4">
	<?= $this->render('@app/views/layouts/_breadcrumbs') ?>
</div>
<div class="container mx-auto xl:px-12 px-4 visa-page-title container-wrapper">
    <h1>Apply for visa online</h1>
</div>
<div class="container mx-auto xl:px-12 px-4 page-content-wrapper">
    <div id="columns" class="container-wrapper">
        <div id="content" class="column">
            <div class="columns">
                <div class="column column-1">
                    <div class="title">Travel visa requirements</div>
                    <div class="description">
                        <script type="text/javascript">
                            visahq_widget_residency_country = "US";
                            visahq_widget_affiliate_id = "vaff5288";
                            visahq_widget_residency_domain = "visahq.com";
                        </script>
                        <script src="https://www.visahq.com/scripts/widget/widget_v.js" type="text/javascript"></script>
                    </div>
                </div>
                <div class="column column-2">
                    <div class="title">Travel visas</div>
                    <div class="description">
                        <script type="text/javascript">
                            visas_visahq_widget_affiliate_id = "vaff5288";
                            f_host = "";
                            f_cit = "0";
                            f_locid = "0";
                            f_destid = "0";
                        </script>
                        <script src="https://www.visahq.com/scripts/new/visas.js"></script>
                    </div>
                </div>
                <div class="column column-3">
                    <div class="title">U.S. Passports</div>
                    <div class="description">
                        <script type="text/javascript">
                            psp_visahq_widget_affiliate_id = "vaff5288";
                            f_host = "";
                            f_psp_type = "1";
                        </script>
                        <script src="https://www.visahq.com/scripts/new/psp_widget.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
