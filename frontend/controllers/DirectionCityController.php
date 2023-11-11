<?php

namespace frontend\controllers;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\repository\landing\models\City;
use common\sys\repository\landing\models\Continent;
use common\sys\repository\landing\models\DirectionCityModel;
use yii\web\HttpException;
use yii;

class DirectionCityController extends BaseController
{
    public function actionIndex()
    {
        $alias = Yii::$app->request->getQueryParam('alias');

        $direction_city = DirectionCityModel::find()
            ->where(['alias' => $alias])
            ->one();

        if(!$direction_city)
            throw new HttpException(404, 'Page not found');

        $images = Image::find()
            ->where([
                'content_id' => $direction_city->id,
                'content_type_id' => AppConfig::Image_ContentType_DirectionsCities,
                'content_field_id' => AppConfig::Image_ContentField_DirectionsCities,
            ])
            ->orderBy(['queue' => SORT_ASC])
            ->asArray()
            ->all();

        $this->bodyClass = "direction-city-page landing-page flight-request-max";
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $direction_city->description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $direction_city->keywords,
        ]);

        return $this->render('index', [
            'direction_city_model' => $direction_city,
            'images' => $images
        ]);
    }
}