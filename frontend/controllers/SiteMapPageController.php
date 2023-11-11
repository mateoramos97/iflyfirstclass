<?php
namespace frontend\controllers;

use Yii;
use common\sys\core\sitemappage\SiteMapPageInfoService;

/**
 * SiteMapPage controller
 */
class SiteMapPageController extends BaseController
{
    public function actionIndex()
    {
        $this->bodyClass = "site-map-page";
        
        $site_map_info_service = new SiteMapPageInfoService();

        // print_r($site_map_info_service->get_site_map(24));

        $site_map_list = $site_map_info_service->get_site_map(139);

        return $this->render('index', [
            'site_map_list' => $site_map_list
        ]);
    }
}