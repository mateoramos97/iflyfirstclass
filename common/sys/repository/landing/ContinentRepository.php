<?php

namespace common\sys\repository\landing;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use common\sys\repository\landing\models\Continent;
use yii;

class ContinentRepository
{
    public function add_continent($params, $images)
    {
        $continent = new Continent();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $continent->attributes = $params->attributes;
            $continent->created_date = date("Y-m-d H:i:s");
            $continent->update_date = date("Y-m-d H:i:s");
            $continent->save(false);

            $continent_id = $continent->id;

            foreach($images as $key => $image)
            {
                $sql = "INSERT INTO image (alias, content_type_id, content_id, content_field_id, queue, title)
                VALUES (:alias, :content_type_id, :content_id, :content_field_id, :queue, :title)";

                Yii::$app->db->createCommand($sql)
                    ->bindValue(':content_id', $continent_id)
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Continent)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Continent)
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

        return $continent;
    }

    public function update_continent($params, $images)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $continent = Continent::findOne($params->id);
            $created_date = $continent->created_date;
            $continent->attributes = $params->attributes;
            $continent->created_date = $created_date;
            $continent->update_date = date("Y-m-d H:i:s");
            $continent->save(false);

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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Continent)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Continent)
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

        return $continent;
    }

    public function delete_item($id)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $item = Continent::findOne($id);
            $item->delete();

            $sql = "DELETE FROM image
                WHERE content_id = :content_id AND content_type_id = :content_type_id AND
                  content_field_id = :content_field_id";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':content_id', $id)
                ->bindValue(':content_type_id', AppConfig::Image_ContentType_Continent)
                ->bindValue(':content_field_id', AppConfig::Image_ContentField_Continent)
                ->execute();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return true;
    }

    public function get_continent_by_alias($alias)
    {
        $continent = new Continent();
        return $continent::find()->where([
            'alias' => $alias,
        ])->one();
    }

    public function get_continent_by_id($id)
    {
        $continent = new Continent();
        return $continent::find()->where(['id' => $id])->one();
    }

    public function get_continent_images($continent_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $continent_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_Continent)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_Continent)
            ->queryAll();

        return $query;
    }

    public function select_continent_to_form()
    {
        $continent = new Continent();
        return $continent::find()->select(['id' => 'id', 'name' => 'name'])->asArray()->all();
    }

    public function ContinentDataProvider($params)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_Continent,
            ':content_field_id' => AppConfig::Image_ContentField_Continent,
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
            $sql_part_name = "`continent`.`name` like :name AND ";
            $data_provider_params_temp = array(
                ':name' => '%'.$params['name'].'%',
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }

        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM continent, image
            WHERE '.$sql_part_name.'`continent`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `continent`.`id` '.$sql_order_by.'
            ', $data_provider_params)->queryScalar();

        $sql = "SELECT `continent`.`id`, `continent`.`alias`, `continent`.`name`, `continent`.`title`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM continent, image
            WHERE ".$sql_part_name."`continent`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `continent`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/continent/index',
            ],
        ]);

        return $dataProvider;
    }
}