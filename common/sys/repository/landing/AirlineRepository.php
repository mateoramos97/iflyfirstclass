<?php

namespace common\sys\repository\landing;

use app\components\AppConfig;
use yii;
use common\sys\repository\landing\models\Airline;

class AirlineRepository
{
    public function add_item($params, $images)
    {
        $item_model = new Airline();

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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Airline)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Airline)
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
            $item_model = Airline::findOne($params->id);
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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Airline)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Airline)
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
            $item = Airline::findOne($id);
            $item->delete();

            $sql = "DELETE FROM image
                WHERE content_id = :content_id AND content_type_id = :content_type_id AND
                  content_field_id = :content_field_id";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':content_id', $id)
                ->bindValue(':content_type_id', AppConfig::Image_ContentType_Airline)
                ->bindValue(':content_field_id', AppConfig::Image_ContentField_Airline)
                ->execute();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return true;
    }

    public function get_airline_by_alias($alias)
    {
        $item_model = new Airline();
        return $item_model::find()->where([
            'alias' => $alias,
        ])->one();
    }

    public function get_airline_by_id($id)
    {
        $item_model = new Airline();
        return $item_model::find()->where(['id' => $id])->one();
    }

    public function get_airlines_list() {
        $airline = new Airline();
        return $airline::find()->select(['alias' => 'alias', 'name' => 'name'])->all();
    }

    public function get_airline_images($country_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $country_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_Airline)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_Airline)
            ->queryAll();

        return $query;
    }

    public function AirlineDataProvider($params)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_Airline,
            ':content_field_id' => AppConfig::Image_ContentField_Airline,
        );

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
            $sql_part_name = "`airline`.`name` like :name AND ";
            $data_provider_params_temp = array(
                ':name' => '%'.$params['name'].'%',
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }

        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM airline, image
            WHERE '.$sql_part_name.'`airline`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `airline`.`id` '.$sql_order_by.'
            ', $data_provider_params)->queryScalar();

        $sql = "SELECT `airline`.`id`, `airline`.`alias`, `airline`.`name`, `airline`.`title`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM airline, image
            WHERE ".$sql_part_name."`airline`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `airline`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/airline/index',
            ],
        ]);

        return $dataProvider;
    }
}