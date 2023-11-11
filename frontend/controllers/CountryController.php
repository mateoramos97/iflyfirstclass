<?php

namespace frontend\controllers;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\repository\landing\models\City;
use common\sys\repository\landing\models\Continent;
use common\sys\repository\landing\models\Country;
use yii\web\HttpException;
use yii;

class CountryController extends BaseController
{
    public function actionIndex()
    {
        $alias = Yii::$app->request->getQueryParam('alias');

        $country = Country::find()
            ->where(['alias' => $alias])
            ->one();

        if(!$country)
            throw new HttpException(404, 'Page not found');

        $images = Image::find()
            ->where([
                'content_id' => $country->id,
                'content_type_id' => AppConfig::Image_ContentType_Country,
                'content_field_id' => AppConfig::Image_ContentField_Country,
            ])
            ->orderBy(['queue' => SORT_ASC])
            ->asArray()
            ->all();

        $this->bodyClass = "country-page landing-page flight-request-max";
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $country->description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $country->keywords,
        ]);

        //sections
        $continents = Continent::find()
            ->select(['name', 'alias'])
            ->all();

        $cities = City::find()
            ->select(['name', 'alias'])
            ->where(['country_id' => $country->id])
            ->all();

        return $this->render('index', [
            'country_model' => $country,
            'images' => $images,
            'continents' => $continents,
            'cities' => $cities,
        ]);
    }
}