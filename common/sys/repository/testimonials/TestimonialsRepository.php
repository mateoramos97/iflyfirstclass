<?php

namespace common\sys\repository\testimonials;

use app\components\AppConfig;
use common\sys\repository\testimonials\models\Testimonials;
use yii;

class TestimonialsRepository
{
    public function add_item($params, $images)
    {
        $item_model = new Testimonials();

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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Testimonials)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Testimonials)
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
            $item_model = Testimonials::findOne($params->id);
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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_Testimonials)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_Testimonials)
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
            $item = Testimonials::findOne($id);
            $item->delete();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return true;
    }

    public function get_testimonials_is_top($count)
    {
        //return Testimonials::find()->where(['is_top' => 1])->limit($count)->asArray()->all();
        if ($count)
            $count_sql= " LIMIT 0, :count";
        $sql = "SELECT `testimonials`.`id`, `testimonials`.`shopperapproved_id`, `testimonials`.`author`,
                  `testimonials`.`address`, `testimonials`.`field_created_date`, `testimonials`.`body`,
                  `testimonials`.`rating`, `testimonials`.`is_top`, `testimonials`.`created_date`,
                  `testimonials`.`update_date`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
                FROM `testimonials`, `image`
                WHERE `testimonials`.`is_top` = 1
                  AND `image`.`content_id` = `testimonials`.`id`
                  AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                  AND `image`.`queue` = 0
                ORDER BY RAND()".$count_sql;
        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':count', $count)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_Testimonials)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_Testimonials)
            ->queryAll();
        return $query;
    }

    public function get_testimonials_by_id($id)
    {
        $testimonials = new Testimonials();
        return $testimonials::find()->where(['id' => $id])->one();
    }

    public function get_testimonials_images($content_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $content_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_Testimonials)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_Testimonials)
            ->queryAll();

        return $query;
    }

    public function TestimonialsDataProvider($params)
    {
        $data_provider_params = array();

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
            $sql_part_name = "WHERE `testimonials`.`author` like :name ";
            $data_provider_params_temp = array(
                ':name' => '%'.$params['name'].'%',
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }
        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM testimonials
            ')->queryScalar();

        $sql = "SELECT `id`, `author`, `shopperapproved_id`, `address`,
                  `field_created_date`, `body`, `rating`
            FROM testimonials
            ".$sql_part_name."
            ORDER BY `testimonials`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/testimonials/index',
            ],
        ]);

        return $dataProvider;
    }
}