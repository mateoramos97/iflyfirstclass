<?php

namespace frontend\controllers;

use app\components\AppConfig;
use common\sys\core\seo\StaticPageInfoService;
use yii;

class ToolsController extends BaseController
{
    public function actionFlightTracker()
    {
        $this->bodyClass = "flight-tracker-page";

        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Flight_Tracker_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('flight-tracker', [
            'static_page' => $static_page
        ]);
    }

    public function actionVisa()
    {
        $this->bodyClass = "visa-page";

        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Visa_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('visa', [
            'static_page' => $static_page
        ]);
    }

    public function actionRequestQuote()
    {
        $this->bodyClass = "request-quote-page";

        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Request_Quote_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('request-quote', [
            'static_page' => $static_page
        ]);
    }
}