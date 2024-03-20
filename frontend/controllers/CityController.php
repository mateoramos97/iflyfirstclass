<?php

namespace frontend\controllers;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\core\landing\AirlineInfoService;
use common\sys\core\landing\CityInfoService;
use common\sys\core\landing\CountryInfoService;
use common\sys\repository\landing\models\City;
use common\sys\repository\landing\models\Continent;
use common\sys\repository\landing\models\Country;
use common\sys\repository\blog\models\BlogArticles;
use yii\web\HttpException;
use yii;

class CityController extends BaseController
{
    public function actionIndex()
    {
        $alias = Yii::$app->request->getQueryParam('alias');

        $city = City::find()
            ->where(['alias' => $alias])
            ->one();

        if(!$city)
            throw new HttpException(404, 'Page not found');

        $images = Image::find()
            ->where([
                'content_id' => $city->id,
                'content_type_id' => AppConfig::Image_ContentType_City,
                'content_field_id' => AppConfig::Image_ContentField_City,
            ])
            ->orderBy(['queue' => SORT_ASC])
            ->asArray()
            ->all();

        $this->bodyClass = "city-page landing-page";
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $city->description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $city->keywords,
        ]);

        $airline_info_service = new AirlineInfoService();
        $country_info_service = new CountryInfoService();
        $city_info_service = new CityInfoService();
        $airlines = $airline_info_service->get_airlines_list();
        $countries = $country_info_service->get_countries_list();
        $cities = $city_info_service->get_cities_list();

        $last_artical = BlogArticles::find()
            ->select(['id', 'alias', 'title', 'summary'])
            ->where(['is_top' => 1])
            ->one();
        $last_artical_img = Image::findOne([
            'content_id' => $last_artical->id,
            'content_type_id' => AppConfig::Image_ContentType_BlogArticle,
            'content_field_id' => AppConfig::Image_ContentField_BlogArticle,
        ]);

        return $this->render('index', [
            'city_model' => $city,
            'images' => $images,
            'airlines' => $airlines,
            'countries' => $countries,
            'cities' => $cities,
            'last_artical' => $last_artical,
            'last_artical_img' => $last_artical_img,
        ]);
    }
}