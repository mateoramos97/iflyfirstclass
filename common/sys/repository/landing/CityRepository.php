<?php

namespace common\sys\repository\landing;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\repository\landing\models\City;
use yii;

class CityRepository
{
    public function add_item($params, $images)
    {
        $item_model = new City();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $item_model->attributes = $params->attributes;
            $item_model->created_date = date("Y-m-d H:i:s");
            $item_model->update_date = date("Y-m-d H:i:s");
            $item_model->save(false);

            $item_id = $item_model->id;

            foreach($images as $key => $image)
            {
                $sql = "INSERT INTO image (alias, content_type_id, content_id, content_field_id, queue, title)
                VALUES (:alias, :content_type_id, :content_id, :content_field_id, :queue, :title)";

                Yii::$app->db->createCommand($sql)
                    ->bindValue(':content_id', $item_id)
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_City)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_City)
                    ->bindValue(':title', $image['title'])
                    ->bindValue(':alias', $image['alias'])
                    ->bindValue(':queue', $image['queue'])
                    ->execute();
            }

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $item_model;
    }

    public function update_item($params, $images)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $item_model = City::findOne($params->id);
            $created_date = $item_model->created_date;
            $item_model->attributes = $params->attributes;
            $item_model->created_date = $created_date;
            $item_model->update_date = date("Y-m-d H:i:s");
            $item_model->save(false);

            $q = 0;
            foreach($images as $key => $image)
            {
                $q = $image['queue'];
                $sql = "UPDATE image
                SET alias = :alias, title = :title, queue = :queue
                WHERE content_type_id = :content_type_id
                    AND content_id = :content_id AND content_field_id = :content_field_id
                    AND queue = :q";

                Yii::$app->db->createCommand($sql)
                    ->bindValue(':content_id', $params->id)
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_City)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_City)
                    ->bindValue(':title', $image['title'])
                    ->bindValue(':alias', $image['alias'])
                    ->bindValue(':queue', $image['queue'])
                    ->bindValue(':q', $q)
                    ->execute();
            }
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $item_model;
    }

    public function delete_item($id)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $item = City::findOne($id);
            $item->delete();

            $sql = "DELETE FROM image
                WHERE content_id = :content_id AND content_type_id = :content_type_id AND
                  content_field_id = :content_field_id";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':content_id', $id)
                ->bindValue(':content_type_id', AppConfig::Image_ContentType_City)
                ->bindValue(':content_field_id', AppConfig::Image_ContentField_City)
                ->execute();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return true;
    }

    public function get_city_by_alias($alias)
    {
        $item_model = new City();
        return $item_model::find()->where([
            'alias' => $alias,
        ])->one();
    }

    public function get_city_by_id($id)
    {
        $item_model = new City();
        return $item_model::find()->where(['id' => $id])->one();
    }

    public function get_cities_list() {
        $city = new City();
        return $city::find()->select(['alias' => 'alias', 'name' => 'name'])->all();
    }

    public function get_city_images($city_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $city_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_City)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_City)
            ->queryAll();

        return $query;
    }

    public function get_random_cities($count = "")
    {
        if ($count)
            $count_sql= " LIMIT 0, :count";
        $sql = "SELECT `city`.`id`, `city`.`alias`, `city`.`name`, `city`.`first_class_price`,
                  `city`.`business_class_price`, `city`.`first_class_old_price`, `city`.`business_class_old_price`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
                FROM `city`, `image`
                WHERE `image`.`content_id` = `city`.`id`
                  AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                  AND `image`.`queue` = 3
                ORDER BY RAND()".$count_sql;
        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':count', $count)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_City)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_City)
            ->queryAll();
        return $query;
    }

    public function get_cities_info_by_continent_id($continent_id)
    {
        $sql = "SELECT `city`.`id`, `city`.`alias`, `city`.`name`, `city`.`first_class_price`,
                  `city`.`business_class_price`, `image`.`alias` as image_alias, `image`.`title` as image_title
                FROM `city`, `image`
                WHERE `city`.`continent_id` = :continent_id
                  AND `image`.`content_id` = `city`.`id`
                  AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                  AND `image`.`queue` = 0
                ORDER BY RAND() LIMIT 20";
        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':continent_id', $continent_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_City)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_City)
            ->queryAll();

        return $query;
    }

    public function CityDataProvider($params)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_City,
            ':content_field_id' => AppConfig::Image_ContentField_City,
        );
        $sql_continent = '';
        if (isset($params['continent_id']) && isset($params['country_id']))
        {
            $sql_continent = "`city`.`continent_id` = :continent_id AND `city`.`country_id` = :country_id AND ";
            $data_provider_params_temp = array(
                ':continent_id' => $params['continent_id'],
                ':country_id' => $params['country_id'],
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }
        elseif (isset($params['continent_id']) && empty($params['country_id']))
        {
            $sql_continent = "`city`.`continent_id` = :continent_id AND ";
            $data_provider_params_temp = array(
                ':continent_id' => $params['continent_id'],
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }
        elseif (empty($params['continent_id']) && isset($params['country_id']))
        {
            $sql_continent = "`city`.`country_id` = :country_id AND ";
            $data_provider_params_temp = array(
                ':country_id' => $params['country_id'],
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }
        elseif (empty($params['continent_id']) && empty($params['country_id']))
        {
            $sql_continent = '';
            $data_provider_params = [
                ':content_type_id' => AppConfig::Image_ContentType_City,
                ':content_field_id' => AppConfig::Image_ContentField_City,
            ];
        }
        $sql_order_by = '';
        if(isset($params['order_by_id']) && $params['order_by_id'] == 'DESC')
        {
            $sql_order_by = 'DESC';
        }
        elseif (isset($params['order_by_id']) && $params['order_by_id'] == 'ASC')
        {
            $sql_order_by = 'ASC';
        }
        else {
            $sql_order_by = 'DESC';
        }

        $sql_part_name = '';
        if (isset($params['name']))
        {
            $sql_part_name = "`city`.`name` like :name AND ";
            $data_provider_params_temp = array(
                ':name' => '%'.$params['name'].'%',
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }

        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM city, image WHERE '.$sql_continent.$sql_part_name.'`city`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0 ORDER BY `city`.`id` '.$sql_order_by.'
            ', $data_provider_params)->queryScalar();

        $sql = "SELECT `city`.`id`, `city`.`alias`, `city`.`name`, `city`.`title`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM city, image
            WHERE ".$sql_continent.$sql_part_name."`city`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `city`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/city/index',
            ],
        ]);

        return $dataProvider;
    }
}