<?php

namespace common\sys\repository\sitemappage;

use yii;

class SiteMapPageRepository
{
    public function get_site_map($pageSize)
    {
        $sql_c = "SELECT COUNT(*)
            FROM (
                SELECT `country`.`alias` as country_alias
                FROM country
                union all
                SELECT `city`.`alias` as city_alias
                FROM city
                union all
                SELECT `airline`.`alias` as airline_alias
                FROM airline
                union all
                SELECT `directions_cities`.`alias` as directions_cities_alias
                FROM directions_cities
            ) x";

        $count = Yii::$app->db->createCommand($sql_c)->queryScalar();

        $sql = "SELECT `country`.`alias` as alias, `country`.`title` as title, 'country' as category
            FROM country
            union
            SELECT `city`.`alias` as alias, `city`.`title` as title, 'city' as category
            FROM city
            union
            SELECT `airline`.`alias` as alias, `airline`.`title` as title, 'airline' as category
            FROM airline
            union
            SELECT `directions_cities`.`alias` as alias, `directions_cities`.`title` as title, 'directions_cities' as category
            FROM directions_cities";

        $dataProvider = new yii\data\SqlDataProvider([
        'sql' => $sql,
        'totalCount' => $count,
        'params' => '',
        'pagination' => [
            'pageSize' => $pageSize,
            'route' => 'site-map-page/index',
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ],
        ]);

        return $dataProvider;
    }
}