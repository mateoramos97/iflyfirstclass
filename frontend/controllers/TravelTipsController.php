<?php

namespace frontend\controllers;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\core\seo\StaticPageInfoService;
use common\sys\core\traveltips\TravelTipsAttactionsInfoService;
use common\sys\repository\traveltips\models\TravelTips;
use common\sys\repository\traveltips\models\TravelTipsAttractions;
use yii;
use common\sys\core\traveltips\TravelTipsInfoService;
use yii\web\HttpException;

class TravelTipsController extends BaseController
{
    private $travel_tips_info_repo;
    private $travel_tips_attactions_info_repo;
    private function get_travel_tips_info_repo()
    {
        if($this->travel_tips_info_repo != null)
            return $this->travel_tips_info_repo;
        $this->travel_tips_info_repo = new TravelTipsInfoService();
        return $this->travel_tips_info_repo;
    }
    private function get_travel_tips_attactions_info_repo()
    {
        if($this->travel_tips_attactions_info_repo != null)
            return $this->travel_tips_attactions_info_repo;
        $this->travel_tips_attactions_info_repo = new TravelTipsAttactionsInfoService();
        return $this->travel_tips_attactions_info_repo;
    }

    public function actionIndex()
    {
        $alias = Yii::$app->request->getQueryParam('alias');

        $travel_tips = TravelTips::find()
            ->where(['alias' => $alias])
            ->one();

        if(!$travel_tips)
            throw new HttpException(404, 'Page not found');

        $images = Image::find()
            ->where([
                'content_id' => $travel_tips->id,
                'content_type_id' => AppConfig::Image_ContentType_TravelTips,
                'content_field_id' => AppConfig::Image_ContentField_TravelTips,
            ])
            ->asArray()
            ->all();

        $this->bodyClass = "travel-tips-attactions-page";
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $travel_tips->description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $travel_tips->keywords,
        ]);

        $travel_tips_attactions = TravelTipsAttractions::find()
            ->where(['travel_tips_id' => $travel_tips->id])
            ->asArray()
            ->all();

        foreach($travel_tips_attactions as &$item) {
            $item['images'] = $this->get_travel_tips_attactions_info_repo()->get_travel_tip_attaction_images($item['id']);
        }

        $random_travel_tips = $this->get_travel_tips_info_repo()->random_travel_tips(7);

        return $this->render('index', [
            'travel_tips_model' => $travel_tips,
            'images' => $images,
            'travel_tips_attactions' => $travel_tips_attactions,
            'random_travel_tips' => $random_travel_tips,
        ]);
    }

    public function actionList()
    {
        $this->bodyClass = "travel-tips-page";
        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Travel_Tips_Page);
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        $travel_tips_list = $this->get_travel_tips_info_repo()->TravelTipsListDataProvider(24);

        return $this->render('list', [
            'static_page' => $static_page,
            'travel_tips_list' => $travel_tips_list
        ]);
    }
}