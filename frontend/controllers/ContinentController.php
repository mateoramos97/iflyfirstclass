<?php

namespace frontend\controllers;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\core\landing\AirlineInfoService;
use common\sys\core\landing\CityInfoService;
use common\sys\core\landing\CountryInfoService;
use common\sys\repository\landing\models\Continent;
use common\sys\repository\landing\models\Country;
use yii\web\HttpException;
use yii;

class ContinentController extends BaseController
{
    public function actionIndex()
    {
        $alias = Yii::$app->request->getQueryParam('alias');

        $continent = Continent::find()
            ->where(['alias' => $alias])
            ->one();
        if(!$continent)
            throw new HttpException(404, 'Page not found');

        $images = Image::find()
            ->where([
                'content_id' => $continent->id,
                'content_type_id' => AppConfig::Image_ContentType_Continent,
                'content_field_id' => AppConfig::Image_ContentField_Continent,
            ])
            ->orderBy(['queue' => SORT_ASC])
            ->asArray()
            ->all();

        $this->bodyClass = "continent-page landing-page flight-request-max";
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $continent->description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $continent->keywords,
        ]);

        $airline_info_service = new AirlineInfoService();
        $country_info_service = new CountryInfoService();
        $city_info_service = new CityInfoService();
        $airlines = $airline_info_service->get_airlines_list();
        $countries = $country_info_service->get_countries_list();
        $cities = $city_info_service->get_cities_list();

        return $this->render('index', [
            'continent_model' => $continent,
            'images' => $images,
            'airlines' => $airlines,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }
}