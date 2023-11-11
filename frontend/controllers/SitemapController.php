<?php
namespace frontend\controllers;

use Yii;
use common\sys\repository\blog\models\BlogArticles;
use common\sys\repository\traveltips\models\TravelTips;
use common\sys\repository\landing\models\DirectionCityModel;
use common\sys\repository\landing\models\Continent;
use common\sys\repository\landing\models\Country;
use common\sys\repository\landing\models\City;
use common\sys\repository\landing\models\Airline;

/**
 * Sitemap controller
 */
class SitemapController extends BaseController
{
    public function actionIndex()
    {    
        // Yii::$app->cache->delete('sitemap'); //delete cache
        if (!$xml_sitemap = Yii::$app->cache->get('sitemap')) {
            $urls = array();

            //pages
            $urls[] = array('loc' => '');
            $urls[] = array('loc' => '/blog');
            $urls[] = array('loc' => '/travel-tips');
            $urls[] = array('loc' => '/page/about-us-best-deals-business-first-tickets');
            $urls[] = array('loc' => '/page/last-minute-deals');
            $urls[] = array('loc' => '/page/best-business-class-deals-cheap');
            $urls[] = array('loc' => '/page/testimonials-business-first-class-tickets');

            //services
            $urls[] = array('loc' => '/service/first-class-specials');
            $urls[] = array('loc' => '/service/one-way-business-class-tickets');
            $urls[] = array('loc' => '/service/cheap-hotels-book-discount');

            //toolses
            $urls[] = array('loc' => '/tools/flight-tracker');
            $urls[] = array('loc' => '/tools/first-class-cheap-business');
            $urls[] = array('loc' => '/tools/request-cheap-business-quote');

            //blog articles
            $articles = BlogArticles::find()->all();
            foreach ($articles as $article) {
                $urls[] = array(
                    'loc' => '/blog/' . $article->alias
                );
            }

            //Travel tips
            $travel_tips = TravelTips::find()->all();
            foreach ($travel_tips as $item) {
                $urls[] = array(
                    'loc' => '/travel-tips/' . $item->alias
                );
            }

            //Directions cities
            $directions_cities = DirectionCityModel::find()->all();
            foreach ($directions_cities as $item) {
                $urls[] = array(
                    'loc' => '/' . $item->alias
                );
            }

            //Continents
            $continents = Continent::find()->all();
            foreach ($continents as $item) {
                $urls[] = array(
                    'loc' => '/continent/' . $item->alias
                );
            }

            //Countries
            $countries = Country::find()->all();
            foreach ($countries as $item) {
                $urls[] = array(
                    'loc' => '/country/' . $item->alias
                );
            }

            //Cities
            $cities = City::find()->all();
            foreach ($cities as $item) {
                $urls[] = array(
                    'loc' => '/city/' . $item->alias
                );
            }

            //Airlines
            $airlines = Airline::find()->all();
            foreach ($airlines as $item) {
                $urls[] = array(
                    'loc' => '/airline/' . $item->alias
                );
            }

            $xml_sitemap = $this->renderPartial('index', array(
                'host' => Yii::$app->request->hostInfo,
                'urls' => $urls,
            ));
            Yii::$app->cache->set('sitemap', $xml_sitemap, 60*60*12); // cache 12 hours
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');
 
        return $xml_sitemap;
    }
}