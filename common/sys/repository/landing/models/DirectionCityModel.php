<?php

namespace common\sys\repository\landing\models;

use Yii;

/**
 * This is the model class for table "airline".
 *
 * @property integer $id
 * @property string $description
 * @property string $keywords
 * @property string $name
 * @property string $alias
 * @property string $title
 * @property string $summary
 * @property string $body
 * @property integer $first_class_price
 * @property integer $business_class_price
 * @property integer $first_class_old_price
 * @property integer $business_class_old_price
 * @property string $created_date
 * @property string $update_date
 * @property string $browser_title
 * @property string $sub_title
 */
class DirectionCityModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'directions_cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'description',
                'keywords',
                'name',
                'alias',
                'title',
                'summary',
                'body',
                'browser_title',
                'first_class_price',
                'business_class_price',
                'first_class_old_price',
                'business_class_old_price'
            ], 'required'],
            [['description', 'keywords', 'summary', 'body', 'body'], 'string'],
            [['created_date', 'update_date'], 'safe'],
            [[
                'first_class_price',
                'business_class_price',
                'first_class_old_price',
                'business_class_old_price'
            ], 'integer'],
            [['name', 'alias', 'browser_title'], 'string', 'max' => 100],
            [['title', 'sub_title'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'alias' => 'Alias',
            'title' => 'Title',
            'summary' => 'Summary',
            'body' => 'Body Column',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
            'browser_title' => 'Browser Title',
            'sub_title' => 'Sub Title',
            'first_class_price' => 'First Class Price',
            'business_class_price' => 'Business Class Price',
            'first_class_old_price' => 'First Class Old Price',
            'business_class_old_price' => 'Business Class Old Price',
        ];
    }
}
