<?php

namespace frontend\controllers;

use app\components\AppConfig;
use common\sys\core\seo\StaticPageInfoService;
use common\sys\repository\landing\models\Continent;
use yii;

class StaticPageController extends BaseController
{
    public function actionAbout()
    {
        $this->bodyClass = "about-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::About_Us_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('about', [
            'static_page' => $static_page,
        ]);
    }

    public function actionLastMinuteDeals()
    {
        $this->bodyClass = "last-minute-deals service-page landing-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Last_Minute_Deals);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('last-minute-deals', [
            'static_page' => $static_page
        ]);
    }

    public function actionCorporateAccount()
    {
        $this->bodyClass = "corporate-account-page";

        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Corporate_Accounts_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('corporate-account', [
            'static_page' => $static_page
        ]);
    }

    public function actionTestimonials()
    {
        $this->bodyClass = "testimonials-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Testimonials_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('testimonials', [
            'static_page' => $static_page,
        ]);
    }
}