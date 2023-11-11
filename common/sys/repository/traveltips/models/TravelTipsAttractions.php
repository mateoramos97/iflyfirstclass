<?php

namespace common\sys\repository\traveltips\models;

use Yii;

/**
 * This is the model class for table "travel_tips_attractions".
 *
 * @property integer $id
 * @property integer $travel_tips_id
 * @property string $title
 * @property string $body
 * @property string $created_date
 * @property string $update_date
 */
class TravelTipsAttractions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'travel_tips_attractions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['travel_tips_id', 'title', 'body'], 'required'],
            [['travel_tips_id'], 'integer'],
            [['created_date', 'update_date'], 'safe'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'travel_tips_id' => 'Travel Tips ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
        ];
    }
}
