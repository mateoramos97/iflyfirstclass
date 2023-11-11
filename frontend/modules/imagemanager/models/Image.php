<?php

namespace app\modules\imagemanager\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property string $alias
 * @property integer $content_id
 * @property integer $content_type_id
 * @property integer $content_field_id
 * @property string $title
 * @property integer $queue
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'content_id', 'content_type_id', 'content_field_id', 'title', 'queue'], 'required'],
            [['content_id', 'content_type_id', 'content_field_id', 'queue'], 'integer'],
            [['alias'], 'string', 'max' => 120],
            [['title'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alias' => 'Alias',
            'content_id' => 'Content ID',
            'content_type_id' => 'Content Type ID',
            'content_field_id' => 'Content Field ID',
            'title' => 'Title',
            'queue' => 'Queue',
        ];
    }

    public function imageValidation($img)
    {
        foreach($img as $key => $item)
        {
            if($item == null)
            {
                return false;
            }
            else {
                continue;
            }
        }
        return true;
    }

    /*  sql query  */

    public function get_image_by_alias($content_id, $content_type_id, $content_field_id, $alias)
    {
        $sql = "SELECT * FROM `image`
		        WHERE `image`.`content_id` = :content_id AND `image`.`content_field_id` = :content_field_id
		            AND `image`.`alias` = :alias AND content_type_id = :content_type_id";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':alias', $alias)
            ->bindValue(':content_id', $content_id)
            ->bindValue(':content_type_id', $content_type_id)
            ->bindValue(':content_field_id', $content_field_id)
            ->queryOne();

        return $query;
    }

    public function add_image($content_id, $content_type_id, $content_field_id, $alias, $queue, $title)
    {
        $sql = "INSERT INTO image (content_id, content_type_id, content_field_id, alias, queue, title)
                VALUES (:content_id, :content_type_id, :content_field_id, :alias, :queue, :title)";

        Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $content_id)
            ->bindValue(':content_type_id', $content_type_id)
            ->bindValue(':content_field_id', $content_field_id)
            ->bindValue(':alias', $alias)
            ->bindValue(':queue', $queue)
            ->bindValue(':title', $title)
            ->execute();
    }

    public function delete_image($content_id, $content_type_id, $content_field_id, $alias_to_remove)
    {
        $sql = "DELETE FROM image
                WHERE alias = :alias AND content_type_id = :content_type_id
                	AND content_id = :content_id AND content_field_id = :content_field_id";

        Yii::$app->db->createCommand($sql)
            ->bindValue(':alias', $alias_to_remove)
            ->bindValue(':content_id', $content_id)
            ->bindValue(':content_type_id', $content_type_id)
            ->bindValue(':content_field_id', $content_field_id)
            ->execute();
    }

    public function update_order_of_image($content_id, $content_type_id, $content_field_id, $alias, $queue)
    {
        $sql = "UPDATE image
                SET queue = :queue
                WHERE alias = :alias AND content_type_id = :content_type_id
                    AND content_id = :content_id AND content_field_id = :content_field_id";

        Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $content_id)
            ->bindValue(':content_type_id', $content_type_id)
            ->bindValue(':content_field_id', $content_field_id)
            ->bindValue(':alias', $alias)
            ->bindValue(':queue', $queue)
            ->execute();
    }

    public function get_images_of_content_id($content_id, $content_type_id, $content_field_id)
    {
        $sql = "SELECT * FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_field_id` = :content_field_id
                    AND content_type_id = :content_type_id";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $content_id)
            ->bindValue(':content_type_id', $content_type_id)
            ->bindValue(':content_field_id', $content_field_id)
            ->queryOne();

        return $query;
    }

    public function update_order($content_id, $content_type_id, $content_field_id, $start_index = 0)
    {
        $sql_set = "SET @ind = :start_index;";
        Yii::$app->db->createCommand($sql_set)
            ->bindValue(':start_index', $start_index - 1)
            ->execute();

        $sql = "UPDATE image SET queue = (@ind:=@ind+1)
                WHERE content_type_id = :content_type_id
                    AND content_id = :content_id AND content_field_id = :content_field_id
                ORDER BY queue";

        Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $content_id)
            ->bindValue(':content_type_id', $content_type_id)
            ->bindValue(':content_field_id', $content_field_id)
            ->execute();
    }
}
