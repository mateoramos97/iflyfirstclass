<?php

namespace common\sys\repository\landing;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\repository\landing\models\Country;
use yii;
use yii\db\Expression;

class CountryRepository
{
    public function add_item($params, $images)
    {
        $item_model = new Country();

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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Country)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Country)
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
            $item_model = Country::findOne($params->id);
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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Country)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Country)
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
            $item = Country::findOne($id);
            $item->delete();

            $sql = "DELETE FROM image
                WHERE content_id = :content_id AND content_type_id = :content_type_id AND
                  content_field_id = :content_field_id";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':content_id', $id)
                ->bindValue(':content_type_id', AppConfig::Image_ContentType_Country)
                ->bindValue(':content_field_id', AppConfig::Image_ContentField_Country)
                ->execute();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return true;
    }

    public function get_country_by_alias($alias)
    {
        $item_model = new Country();
        return $item_model::find()->where([
            'alias' => $alias,
        ])->one();
    }

    public function get_country_by_id($id)
    {
        $item_model = new Country();
        return $item_model::find()->where(['id' => $id])->one();
    }

    public function get_country_images($country_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $country_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_Country)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_Country)
            ->queryAll();

        return $query;
    }

    public function select_country_to_form()
    {
        $country = new Country();
        return $country::find()->select(['id' => 'id', 'name' => 'name'])->asArray()->all();
    }

    public function get_countries_list() {
        $country = new Country();
        return $country::find()->select(['alias' => 'alias', 'name' => 'name'])->all();
    }

    public function get_random_country($limit) {
        $country = new Country();
        $countries =  $country::find()
            ->select([
                'name' => 'name',
                'first_class_price' => 'first_class_price',
                'business_class_price' => 'business_class_price',
                'first_class_old_price' => 'first_class_old_price',
                'business_class_old_price' => 'business_class_old_price'
            ])
            ->orderBy(new Expression('rand()'))
            ->limit($limit);

        return $limit == 1 ? $countries->one() : $countries->all();
    }

    public function CountryDataProvider($params)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_Country,
            ':content_field_id' => AppConfig::Image_ContentField_Country,
        );

        $sql_continent = '';
        if (isset($params['continent_id']))
        {
            $sql_continent = "`country`.`continent_id` = :continent_id AND ";
            $data_provider_params_temp = array(
                ':continent_id' => $params['continent_id'],
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }
        else
        {
            $sql_continent = '';
            $data_provider_params = [
                ':content_type_id' => AppConfig::Image_ContentType_Country,
                ':content_field_id' => AppConfig::Image_ContentField_Country,
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
            $sql_part_name = "`country`.`name` like :name AND ";
            $data_provider_params_temp = array(
                ':name' => '%'.$params['name'].'%',
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }

        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM country, image
            WHERE '.$sql_continent.$sql_part_name.'`country`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `country`.`id` '.$sql_order_by.'
            ', $data_provider_params)->queryScalar();

        $sql = "SELECT `country`.`id`, `country`.`alias`, `country`.`name`, `country`.`title`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM country, image
            WHERE ".$sql_continent.$sql_part_name."`country`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `country`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/country/index',
            ],
        ]);

        return $dataProvider;
    }
}