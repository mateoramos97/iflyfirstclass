<?php

namespace common\sys\repository\traveltips\models;

use Yii;

/**
 * This is the model class for table "travel_tips".
 *
 * @property integer $id
 * @property string $description
 * @property string $keywords
 * @property string $alias
 * @property string $title
 * @property string $browser_title
 * @property string $summary
 * @property string $created_date
 * @property string $update_date
 */
class TravelTips extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'travel_tips';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'description', 'keywords', 'title', 'browser_title', 'summary'], 'required'],
            [['description', 'keywords', 'summary'], 'string'],
            [['created_date', 'update_date'], 'safe'],
            [['alias', 'browser_title'], 'string', 'max' => 100],
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
            'description' => '[SEO] Description',
            'keywords' => '[SEO] Keywords',
            'alias' => 'Alias',
            'title' => 'Title',
            'browser_title' => 'Browser Title',
            'summary' => 'Summary',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
        ];
    }
}
