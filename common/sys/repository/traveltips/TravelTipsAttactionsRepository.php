<?php

namespace common\sys\repository\traveltips;

use app\components\AppConfig;
use yii;
use common\sys\repository\traveltips\models\TravelTipsAttractions;

class TravelTipsAttactionsRepository
{
    public function add_item($params, $images)
    {
        $item_model = new TravelTipsAttractions();

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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTipsAttactions)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTipsAttactions)
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
            $item_model = TravelTipsAttractions::findOne($params->id);
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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTipsAttactions)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTipsAttactions)
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

    public function get_travel_tip_attaction_by_id($id)
    {
        $travel_tips_attactions = new TravelTipsAttractions();
        return $travel_tips_attactions::find()->where(['id' => $id])->one();
    }

    public function get_travel_tip_attaction_images($travel_tip_attaction_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $travel_tip_attaction_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTipsAttactions)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTipsAttactions)
            ->queryAll();

        return $query;
    }

    public function delete_item($id)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $item = TravelTipsAttractions::findOne($id);
            $item->delete();

            $sql = "DELETE FROM image
                WHERE content_id = :content_id AND content_type_id = :content_type_id AND
                  content_field_id = :content_field_id";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':content_id', $id)
                ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTipsAttactions)
                ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTipsAttactions)
                ->execute();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return true;
    }

    public function get_travel_tips_attctions_by_travel_tip_id($travel_tip_id)
    {
        $item_model = new TravelTipsAttractions();
        return $item_model::find()->where(['travel_tips_id' => $travel_tip_id])->asArray()->all();
    }
}