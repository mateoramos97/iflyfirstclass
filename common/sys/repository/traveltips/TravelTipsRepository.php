<?php

namespace common\sys\repository\traveltips;

use app\components\AppConfig;
use common\sys\repository\traveltips\models\TravelTips;
use yii;

class TravelTipsRepository
{
    public function add_item($params, $images)
    {
        $item_model = new TravelTips();

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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTips)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTips)
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
            $item_model = TravelTips::findOne($params->id);
            $item_model->attributes = $params->attributes;
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
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTips)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTips)
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
            $item = TravelTips::findOne($id);
            $item->delete();

            $sql = "DELETE FROM image
                WHERE content_id = :content_id AND content_type_id = :content_type_id AND
                  content_field_id = :content_field_id";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':content_id', $id)
                ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTips)
                ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTips)
                ->execute();

            $sql_attactions = "DELETE `travel_tips_attractions`, `image`
                FROM `travel_tips_attractions`
                INNER JOIN `image`
                WHERE `travel_tips_attractions`.`id`= `image`.`content_id` AND `image`.`content_type_id` = :content_type_id AND
                  `image`.`content_field_id` = :content_field_id AND
                  `travel_tips_attractions`.`travel_tips_id` = :travel_tips_id";

            Yii::$app->db->createCommand($sql_attactions)
                ->bindValue(':travel_tips_id', $id)
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

    public function get_travel_tip_by_alias($alias)
    {
        $travel_tips = new TravelTips();
        return $travel_tips::find()->where([
            'alias' => $alias,
        ])->one();
    }

    public function get_travel_tip_by_id($id)
    {
        $travel_tips = new TravelTips();
        return $travel_tips::find()->where(['id' => $id])->one();
    }

    public function get_travel_tip_images($travel_tip_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $travel_tip_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTips)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTips)
            ->queryAll();

        return $query;
    }

    public function random_travel_tips($count)
    {
        if ($count)
            $count_sql= " LIMIT :count";
        $sql = "SELECT `travel_tips`.`id`, `travel_tips`.`alias`, `travel_tips`.`title`, `travel_tips`.`summary`,
                `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM travel_tips, image
            WHERE `travel_tips`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY RAND()".$count_sql;

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':count', $count)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_TravelTips)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_TravelTips)
            ->queryAll();

        return $query;
    }

    public function TravelTipsListDataProvider($pageSize)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_TravelTips,
            ':content_field_id' => AppConfig::Image_ContentField_TravelTips,
        );
        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM travel_tips, image
            WHERE `travel_tips`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `travel_tips`.`id` DESC', $data_provider_params)->queryScalar();

        $sql = "SELECT `travel_tips`.`id`, `travel_tips`.`alias`, `travel_tips`.`title`,  `travel_tips`.`summary`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM travel_tips, image
            WHERE `travel_tips`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `travel_tips`.`id` DESC";

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => $pageSize,
                'route' => 'travel-tips/list',
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);

        return $dataProvider;
    }

    public function TravelTipsDataProvider($params)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_TravelTips,
            ':content_field_id' => AppConfig::Image_ContentField_TravelTips,
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

        $sql_part_title = '';
        if (isset($params['title']))
        {
            $sql_part_title = "`travel_tips`.`title` like :title AND ";
            $data_provider_params_temp = array(
                ':title' => '%'.$params['title'].'%',
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }
        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM travel_tips
            ')->queryScalar();

        $sql = "SELECT `travel_tips`.`id`, `travel_tips`.`alias`, `travel_tips`.`title`,
                  `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM travel_tips, image
            WHERE ".$sql_part_title."`travel_tips`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `travel_tips`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/travel-tips/index',
            ],
        ]);

        return $dataProvider;
    }
}