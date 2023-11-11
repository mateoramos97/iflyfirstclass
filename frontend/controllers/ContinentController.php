<?php

namespace frontend\controllers;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
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

        //sections
        $countries = Country::find()
            ->select(['name', 'alias'])
            ->where(['continent_id' => $continent->id])
            ->all();

        $continents = Continent::find()
            ->select(['name', 'alias'])
            ->all();

        return $this->render('index', [
            'continent_model' => $continent,
            'images' => $images,
            'countries' => $countries,
            'continents' => $continents,
        ]);
    }
}