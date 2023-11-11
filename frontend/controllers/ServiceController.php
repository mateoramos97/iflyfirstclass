<?php

namespace frontend\controllers;

use app\components\AppConfig;
use common\sys\repository\landing\models\Continent;
use common\sys\repository\landing\models\Country;
use common\sys\core\seo\StaticPageInfoService;
use yii;

class ServiceController extends BaseController
{
    public function actionHotel()
    {
        $this->bodyClass = "hotels-page";

        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Hotels_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        return $this->render('hotel', [
            'static_page' => $static_page
        ]);
    }

    public function actionCorporateAccount()
    {
        $this->bodyClass = "corporate-accounts-page";
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
        return $this->render('corporate-accounts', [
            'head_title' => $static_page->title,
        ]);
    }

    public function actionFirstClass()
    {
        $this->bodyClass = "service-page landing-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::First_Class_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        //sections
        $continents = Continent::find()
            ->select(['name', 'alias'])
            ->all();

        return $this->render('first-class', [
            'static_page' => $static_page,
            'continents' => $continents
        ]);
    }

    public function actionBusinessClass()
    {
        $this->bodyClass = "service-page landing-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Business_Class_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        //sections
        $continents = Continent::find()
            ->select(['name', 'alias'])
            ->all();

        return $this->render('business-class', [
            'static_page' => $static_page,
            'continents' => $continents
        ]);
    }
}